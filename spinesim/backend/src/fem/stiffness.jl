# ══════════════════════════════════════════════════════════════
# Vertex — Matrice de rigidité (poutre Euler-Bernoulli 3D)
# ══════════════════════════════════════════════════════════════

using LinearAlgebra: eigvals, det

"""
    beam_stiffness_matrix(elem::BeamElement) → Matrix{Float64}

Matrice de rigidité locale 12×12 d'une poutre 3D Euler-Bernoulli.
6 DOF par nœud : [u, v, w, θx, θy, θz]
- u, v, w : translations selon x, y, z
- θx, θy, θz : rotations autour de x, y, z
"""
function beam_stiffness_matrix(elem::BeamElement)
    L = elem.length
    E = elem.E
    G = elem.G
    A = elem.A
    Iy = elem.Iy
    Iz = elem.Iz
    J = elem.J
    
    L2 = L^2
    L3 = L^3
    
    # Rigidités élémentaires
    EA_L = E * A / L
    GJ_L = G * J / L
    
    EIy_L3 = E * Iy / L3
    EIy_L2 = E * Iy / L2
    EIy_L  = E * Iy / L
    
    EIz_L3 = E * Iz / L3
    EIz_L2 = E * Iz / L2
    EIz_L  = E * Iz / L
    
    K = zeros(12, 12)
    
    # ── Traction/compression (u) ──
    K[1,1] = EA_L;   K[1,7] = -EA_L
    K[7,7] = EA_L;   K[7,1] = -EA_L
    
    # ── Flexion plan XZ — cisaillement v, rotation θz ──
    K[2,2]   =  12EIz_L3
    K[2,6]   =   6EIz_L2
    K[2,8]   = -12EIz_L3
    K[2,12]  =   6EIz_L2
    
    K[6,2]   =   6EIz_L2
    K[6,6]   =   4EIz_L
    K[6,8]   =  -6EIz_L2
    K[6,12]  =   2EIz_L
    
    K[8,2]   = -12EIz_L3
    K[8,6]   =  -6EIz_L2
    K[8,8]   =  12EIz_L3
    K[8,12]  =  -6EIz_L2
    
    K[12,2]  =   6EIz_L2
    K[12,6]  =   2EIz_L
    K[12,8]  =  -6EIz_L2
    K[12,12] =   4EIz_L
    
    # ── Flexion plan XY — cisaillement w, rotation θy ──
    K[3,3]   =  12EIy_L3
    K[3,5]   =  -6EIy_L2
    K[3,9]   = -12EIy_L3
    K[3,11]  =  -6EIy_L2
    
    K[5,3]   =  -6EIy_L2
    K[5,5]   =   4EIy_L
    K[5,9]   =   6EIy_L2
    K[5,11]  =   2EIy_L
    
    K[9,3]   = -12EIy_L3
    K[9,5]   =   6EIy_L2
    K[9,9]   =  12EIy_L3
    K[9,11]  =   6EIy_L2
    
    K[11,3]  =  -6EIy_L2
    K[11,5]  =   2EIy_L
    K[11,9]  =   6EIy_L2
    K[11,11] =   4EIy_L
    
    # ── Torsion (θx) ──
    K[4,4]   =  GJ_L
    K[4,10]  = -GJ_L
    K[10,4]  = -GJ_L
    K[10,10] =  GJ_L
    
    return K
end

"""
    element_rotation_matrix(p1::Vec3, p2::Vec3) → Matrix{Float64}

Calcule la matrice de transformation locale→globale 12×12 pour un élément
poutre 3D orienté de p1 vers p2.

La matrice λ (3×3) dont les lignes sont les bases locales dans le repère global :
- Ligne 1 : axe local x (axe de la poutre)
- Ligne 2 : axe local y (perpendiculaire dans un plan de référence)
- Ligne 3 : axe local z (produit vectoriel x × y)

T est bloc-diagonale : `blkdiag(λ, λ, λ, λ)` pour les 4 triplets de DOF.

La matrice de rigidité globale est alors : `Ke_global = T' * Ke_local * T`
"""
function element_rotation_matrix(p1::Vec3, p2::Vec3)::Matrix{Float64}
    d = p2 - p1
    L = norm(d)
    
    # Axe local x : direction de la poutre
    lx = d / L
    
    # Vecteur de référence non-colinéaire à lx
    ref = abs(lx[3]) < 0.9 ? Vec3(0.0, 0.0, 1.0) : Vec3(1.0, 0.0, 0.0)
    
    # Axe local y = ref × lx (normalisé) [sens main droite]
    ly_raw = Vec3(ref[2]*lx[3] - ref[3]*lx[2],
                  ref[3]*lx[1] - ref[1]*lx[3],
                  ref[1]*lx[2] - ref[2]*lx[1])
    ly = ly_raw / norm(ly_raw)
    
    # Axe local z = lx × ly
    lz = Vec3(lx[2]*ly[3] - lx[3]*ly[2],
              lx[3]*ly[1] - lx[1]*ly[3],
              lx[1]*ly[2] - lx[2]*ly[1])
    
    # Matrice de direction cosinus 3×3 (global→local : lignes = bases locales en global)
    λ = [lx[1] lx[2] lx[3];
         ly[1] ly[2] ly[3];
         lz[1] lz[2] lz[3]]
    
    # Matrice de transformation 12×12 (4 blocs 3×3)
    T = zeros(12, 12)
    for b in 0:3
        T[(3b+1):(3b+3), (3b+1):(3b+3)] = λ
    end
    
    return T
end

"""
    assemble_global_stiffness(mesh::SpineMesh) → SparseMatrixCSC

Assemble la matrice de rigidité globale par assemblage FEM classique.
La transformation locale→globale est appliquée à chaque élément :
`Ke_global = T' * Ke_local * T`
"""
function assemble_global_stiffness(mesh::SpineMesh)
    ndof = mesh.num_dof
    
    # Accumulation par triplets pour efficacité
    I = Int[]
    J = Int[]
    V = Float64[]
    
    for elem in mesh.elements
        Ke_local = beam_stiffness_matrix(elem)
        
        # Positions des nœuds pour la transformation de coordonnées
        p1 = mesh.nodes[elem.node1].position
        p2 = mesh.nodes[elem.node2].position
        
        # Matrice de rotation locale→globale
        T = element_rotation_matrix(p1, p2)
        
        # Rigidité dans le repère global : Ke_global = T' * Ke_local * T
        Ke = T' * Ke_local * T
        
        # Indices globaux des DOF de l'élément
        dof1 = ((elem.node1 - 1) * 6 + 1):(elem.node1 * 6)
        dof2 = ((elem.node2 - 1) * 6 + 1):(elem.node2 * 6)
        global_dofs = vcat(collect(dof1), collect(dof2))
        
        for i in 1:12
            for j in 1:12
                if abs(Ke[i, j]) > 1e-15
                    push!(I, global_dofs[i])
                    push!(J, global_dofs[j])
                    push!(V, Ke[i, j])
                end
            end
        end
    end
    
    return sparse(I, J, V, ndof, ndof)
end

# ══════════════════════════════════════════════════════════════
# Matrice de rigidité géométrique (stress stiffness)
# Pour l'analyse de flambage du « ressort spiral » rachidien
# ══════════════════════════════════════════════════════════════

"""
    beam_geometric_stiffness(elem::BeamElement, N::Float64) → Matrix{Float64}

Matrice de rigidité géométrique (stress stiffness) 12×12 pour une poutre 3D
soumise à un effort normal N (positif = compression).

Cette matrice capture l'effet « P-Δ » : la réduction de rigidité apparente
quand une poutre est comprimée. Quand det(K + Kσ) = 0, c'est le flambage.

Référence : Przemieniecki (1968), Theory of Matrix Structural Analysis, §11.3.

Pour un élément poutre Euler-Bernoulli avec effort axial N :
```
       ⌈ 0        0       0   0     0      0  ⌉
       |   6/5    0   0     0    L/10        |
       |       6/5   0  -L/10    0           |
Kσ = N/L × |           0     0      0           |
       |             2L²/15  0           |
       |                    2L²/15       |
       ⌊ (symétrique + couplage nœud 2)       ⌋
```
"""
function beam_geometric_stiffness(elem::BeamElement, N::Float64)
    L = elem.length
    L2 = L^2
    
    Kg = zeros(12, 12)
    
    coeff = N / L
    
    # ── Flexion plan XZ (DOF v=2,θz=6 / v=8,θz=12) ──
    Kg[2,2]   =  6.0/5.0 * coeff
    Kg[2,6]   =  L/10.0  * coeff
    Kg[2,8]   = -6.0/5.0 * coeff
    Kg[2,12]  =  L/10.0  * coeff
    
    Kg[6,2]   =  L/10.0  * coeff
    Kg[6,6]   =  2.0*L2/15.0 * coeff
    Kg[6,8]   = -L/10.0  * coeff
    Kg[6,12]  = -L2/30.0 * coeff
    
    Kg[8,2]   = -6.0/5.0 * coeff
    Kg[8,6]   = -L/10.0  * coeff
    Kg[8,8]   =  6.0/5.0 * coeff
    Kg[8,12]  = -L/10.0  * coeff
    
    Kg[12,2]  =  L/10.0  * coeff
    Kg[12,6]  = -L2/30.0 * coeff
    Kg[12,8]  = -L/10.0  * coeff
    Kg[12,12] =  2.0*L2/15.0 * coeff
    
    # ── Flexion plan XY (DOF w=3,θy=5 / w=9,θy=11) ──
    Kg[3,3]   =  6.0/5.0 * coeff
    Kg[3,5]   = -L/10.0  * coeff
    Kg[3,9]   = -6.0/5.0 * coeff
    Kg[3,11]  = -L/10.0  * coeff
    
    Kg[5,3]   = -L/10.0  * coeff
    Kg[5,5]   =  2.0*L2/15.0 * coeff
    Kg[5,9]   =  L/10.0  * coeff
    Kg[5,11]  = -L2/30.0 * coeff
    
    Kg[9,3]   = -6.0/5.0 * coeff
    Kg[9,5]   =  L/10.0  * coeff
    Kg[9,9]   =  6.0/5.0 * coeff
    Kg[9,11]  =  L/10.0  * coeff
    
    Kg[11,3]  = -L/10.0  * coeff
    Kg[11,5]  = -L2/30.0 * coeff
    Kg[11,9]  =  L/10.0  * coeff
    Kg[11,11] =  2.0*L2/15.0 * coeff
    
    return Kg
end

"""
    assemble_geometric_stiffness(mesh::SpineMesh, U::Vector{Float64}) → SparseMatrixCSC

Assemble la matrice de rigidité géométrique globale à partir des efforts
normaux dans chaque élément (calculés depuis le champ de déplacement U).

Utilisée pour :
1. Analyse de flambage linéaire : det(K + λ·Kσ) = 0 → λ_cr (charge critique)
2. Ratio de flambage du ressort spiral : λ_cr < 1 → flambage
"""
function assemble_geometric_stiffness(mesh::SpineMesh, U::Vector{Float64})
    ndof = mesh.num_dof
    
    I_idx = Int[]
    J_idx = Int[]
    V_val = Float64[]
    
    for elem in mesh.elements
        # Extraire les déplacements globaux de l'élément
        dof1 = ((elem.node1 - 1) * 6 + 1):(elem.node1 * 6)
        dof2 = ((elem.node2 - 1) * 6 + 1):(elem.node2 * 6)
        u_global = vcat(U[dof1], U[dof2])
        
        # Transformer en coordonnées locales
        p1 = mesh.nodes[elem.node1].position
        p2 = mesh.nodes[elem.node2].position
        T = element_rotation_matrix(p1, p2)
        u_local = T * u_global
        
        # Effort normal : N = EA × (u₇ - u₁) / L
        # Convention : N > 0 = compression (sens mécanique standard pour flambage)
        δu_axial = u_local[7] - u_local[1]
        N = -elem.E * elem.A * δu_axial / elem.length  # compression positive
        
        # Matrice géométrique locale
        Kg_local = beam_geometric_stiffness(elem, N)
        
        # Transformation vers le repère global
        Kg_global = T' * Kg_local * T
        
        # Assemblage
        global_dofs = vcat(collect(dof1), collect(dof2))
        for i in 1:12
            for j in 1:12
                if abs(Kg_global[i, j]) > 1e-15
                    push!(I_idx, global_dofs[i])
                    push!(J_idx, global_dofs[j])
                    push!(V_val, Kg_global[i, j])
                end
            end
        end
    end
    
    return sparse(I_idx, J_idx, V_val, ndof, ndof)
end

"""
    linear_buckling_factor(K, Kσ, fixed_dofs; num_modes=1) → (λ_cr, mode_shape)

Analyse de flambage linéaire par valeurs propres généralisées :
    (K + λ·Kσ) · φ = 0

Retourne le plus petit facteur de charge critique λ_cr > 0 et le mode associé.
Si λ_cr > 1 → le rachis est stable sous les charges courantes.
Si λ_cr ≤ 1 → flambage (instabilité du ressort spiral).
"""
function linear_buckling_factor(K::SparseMatrixCSC, Kσ::SparseMatrixCSC,
                                 fixed_dofs::Vector{Int}; num_modes::Int=1)
    n = size(K, 1)
    free_dofs = setdiff(1:n, fixed_dofs)
    
    # Extraire les sous-matrices des DOF libres
    K_ff = K[free_dofs, free_dofs]
    Kg_ff = Kσ[free_dofs, free_dofs]
    
    # Rendre symétriques (sécurité numérique)
    K_ff = (K_ff + K_ff') / 2
    Kg_ff = (Kg_ff + Kg_ff') / 2
    
    # Résoudre le problème aux valeurs propres généralisé
    # K · φ = -λ · Kσ · φ  →  K⁻¹ · (-Kσ) · φ = (1/λ) · φ
    # On cherche les plus grandes valeurs propres de K⁻¹ · (-Kσ) → plus petits λ
    try
        # Méthode directe (fiable pour petits systèmes, ~130 DOF)
        K_dense = Matrix(K_ff)
        Kg_dense = Matrix(-Kg_ff)
        
        # Résoudre K · φ = μ · Kσ · φ → λ_cr = 1/μ_max
        eig_values = eigvals(K_dense, Kg_dense)
        
        # Filtrer les valeurs propres positives (modes de flambage physiques)
        positive_eigs = filter(λ -> isreal(λ) && real(λ) > 1e-6, eig_values)
        
        if isempty(positive_eigs)
            @warn "Aucun mode de flambage trouvé — rachis inconditionnellement stable"
            return Inf, zeros(length(free_dofs))
        end
        
        λ_cr = minimum(real.(positive_eigs))
        
        return λ_cr, zeros(length(free_dofs))  # mode shape simplifié pour Phase 0
        
    catch e
        @warn "Analyse de flambage échouée" exception=e
        return Inf, zeros(length(free_dofs))
    end
end

"""
    add_ligament_stiffness!(K, ligaments, mesh)

Ajoute la contribution des ligaments à la matrice de rigidité globale.
Chaque ligament = un ressort non-linéaire linéarisé entre ses attaches.
"""
function add_ligament_stiffness!(K::SparseMatrixCSC{Float64, Int},
                                  ligaments::Vector{SpinalLigament},
                                  mesh::SpineMesh)
    for lig in ligaments
        if lig.is_ruptured
            continue
        end
        
        # Trouver les nœuds les plus proches des attaches
        node1_id = find_nearest_node(mesh, lig.origin)
        node2_id = find_nearest_node(mesh, lig.insertion)
        
        if node1_id == node2_id
            continue
        end
        
        # Direction du ligament (unité)
        dir = lig.insertion - lig.origin
        L = norm(dir)
        if L < 1e-6
            continue
        end
        n = dir / L
        
        # Rigidité tangente du ligament
        k = lig.linear_stiffness  # N/mm → linéarisé
        
        # Matrice ke = k × n ⊗ n (3×3) → translationnel seulement
        ke = k * (n * n')
        
        # Assemblage dans les DOF translationnels
        for i in 1:3
            for j in 1:3
                gi = (node1_id - 1) * 6 + i
                gj = (node1_id - 1) * 6 + j
                K[gi, gj] += ke[i, j]
                
                gi2 = (node2_id - 1) * 6 + i
                gj2 = (node2_id - 1) * 6 + j
                K[gi2, gj2] += ke[i, j]
                
                # Couplage croisé
                K[(node1_id-1)*6+i, (node2_id-1)*6+j] -= ke[i, j]
                K[(node2_id-1)*6+i, (node1_id-1)*6+j] -= ke[i, j]
            end
        end
    end
end

"""
    find_nearest_node(mesh, point) → Int

Trouve le nœud du maillage le plus proche d'un point donné.
"""
function find_nearest_node(mesh::SpineMesh, point::Vec3)::Int
    min_dist = Inf
    min_id = 1
    for node in mesh.nodes
        d = norm(node.position - point)
        if d < min_dist
            min_dist = d
            min_id = node.id
        end
    end
    return min_id
end
