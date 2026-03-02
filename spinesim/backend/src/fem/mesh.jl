# ══════════════════════════════════════════════════════════════
# Vertex — Maillage simplifié (Phase 0)
# ══════════════════════════════════════════════════════════════

"""
Nœud du maillage FEM.
"""
struct FENode
    id::Int
    position::Vec3
    is_fixed::Bool
end

"""
Élément poutre (beam) — modèle simplifié Phase 0.
Chaque segment intervertébral = 1 élément poutre Euler-Bernoulli à 12 DOF.
"""
struct BeamElement
    id::Int
    node1::Int          # index nœud supérieur
    node2::Int          # index nœud inférieur
    length::Float64     # longueur (mm)
    E::Float64          # module de Young effectif (Pa)
    G::Float64          # module de cisaillement (Pa)
    A::Float64          # section transversale (mm²)
    Iy::Float64         # moment d'inertie flexion sagittale (mm⁴)
    Iz::Float64         # moment d'inertie flexion coronale (mm⁴)
    J::Float64          # moment d'inertie torsion (mm⁴)
end

"""
Maillage poutre du rachis — Phase 0.
23 nœuds (C3–S1), 22 éléments poutre.
"""
mutable struct SpineMesh
    nodes::Vector{FENode}
    elements::Vector{BeamElement}
    num_dof::Int        # 6 DOF par nœud
end

"""
    generate_spine_mesh(model::SpineModel) → SpineMesh

Génère le maillage poutre simplifié à partir du modèle anatomique.
Chaque segment intervertébral = 1 poutre avec propriétés effectives
du complexe disque + ligaments + facettes.
"""
function generate_spine_mesh(model::SpineModel)
    n = length(model.vertebrae)
    
    # ── Nœuds ──
    nodes = FENode[]
    for (i, v) in enumerate(model.vertebrae)
        is_fixed = (i == n)  # Sacrum fixé
        push!(nodes, FENode(i, v.position, is_fixed))
    end
    
    # ── Éléments ──
    elements = BeamElement[]
    for i in 1:(n-1)
        upper = model.vertebrae[i]
        lower = model.vertebrae[i+1]
        disc = model.discs[i]
        
        len = norm(lower.position - upper.position)
        
        # Propriétés effectives du segment (disque + vertèbre)
        # Module de Young effectif — pondéré entre disque et os
        E_disc = 10.0e6  # Pa (rigidité axiale effective du disque)
        E_bone = upper.cortical.youngs_modulus
        E_eff = (E_disc * E_bone) / (E_disc + E_bone)  # Série
        
        # Rigidité diminue avec la dégénérescence discale
        E_eff *= disc.degeneration.annulus_stiffness_ratio
        
        # Module de cisaillement
        ν_eff = 0.3
        G_eff = E_eff / (2 * (1 + ν_eff))
        
        # Section transversale elliptique : A = π × a × b
        a = disc.width / 2.0   # demi-largeur (mm)
        b = disc.depth / 2.0   # demi-profondeur (mm)
        A = π * a * b
        
        # Moments d'inertie (section elliptique)
        Iy = π * a * b^3 / 4.0    # flexion sagittale (autour de x)
        Iz = π * a^3 * b / 4.0    # flexion coronale (autour de y)
        J = π * a * b * (a^2 + b^2) / 4.0  # torsion
        
        push!(elements, BeamElement(i, i, i+1, len, E_eff, G_eff, A, Iy, Iz, J))
    end
    
    return SpineMesh(nodes, elements, 6 * n)
end
