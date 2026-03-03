# ══════════════════════════════════════════════════════════════
# Vertex — Solveur FEM
# ══════════════════════════════════════════════════════════════

using IterativeSolvers
using LinearAlgebra: Diagonal, Symmetric

"""
    apply_boundary_conditions(K, F, fixed_dofs; method=:elimination)

Applique les conditions aux limites au système K·U = F.

Deux méthodes disponibles :
- `:elimination` (par défaut) — réduit le système en éliminant les DOF fixés.
  Meilleur conditionnement, résultats exacts. Retourne (K_ff, F_ff, free_dofs).
- `:penalty` — ajoute une rigidité massive (10¹⁵) sur les DOF fixés.
  Plus simple mais dégrade le nombre de condition de K.
"""
function apply_boundary_conditions(K::SparseMatrixCSC, F::Vector{Float64},
                                    fixed_dofs::Vector{Int};
                                    method::Symbol=:elimination)
    if method == :elimination
        n = size(K, 1)
        free_dofs = setdiff(1:n, fixed_dofs)
        K_ff = K[free_dofs, free_dofs]
        F_ff = F[free_dofs]
        return K_ff, F_ff, free_dofs
    else  # :penalty
        K_pen = copy(K)
        F_pen = copy(F)
        penalty = 1e15
        for dof in fixed_dofs
            K_pen[dof, dof] += penalty
            F_pen[dof] = 0.0
        end
        return K_pen, F_pen, collect(1:size(K, 1))
    end
end

"""
    solve_spine!(model::SpineModel; gravity=true, loads=Load[], bc_method=:elimination)

Résout l'équilibre mécanique du rachis :
1. Sauvegarde les positions de référence (pour ré-entrée)
2. Génère le maillage
3. Assemble la matrice de rigidité K
4. Calcule le vecteur de forces F (gravité + charges externes)
5. Applique les conditions aux limites (sacrum fixé)
6. Résout K·U = F (CG + Jacobi, fallback décomposition directe)
7. Post-traite : contraintes, déplacements, rigidité géométrique
"""
function solve_spine!(model::SpineModel; gravity::Bool=true,
                      loads::Vector{Load}=Load[],
                      bc_method::Symbol=:elimination)
    # ── 0. Sauvegarder les positions de référence ──
    # Permet de ré-exécuter solve_spine! sans accumuler les déplacements
    reference_positions = [v.position for v in model.vertebrae]
    reference_orientations = [v.orientation for v in model.vertebrae]
    
    # ── 1. Maillage ──
    mesh = generate_spine_mesh(model)
    
    # ── 2. Matrice de rigidité globale ──
    K = assemble_global_stiffness(mesh)
    
    # Ajouter la contribution des ligaments
    add_ligament_stiffness!(K, model.ligaments, mesh)
    
    # ── 3. Vecteur de forces ──
    F = zeros(mesh.num_dof)
    
    if gravity
        # Gravité : force verticale (-z) pondérée par masse segmentaire
        segment_mass = model.patient_weight / length(model.vertebrae)
        g = 9.81  # m/s²
        
        for i in 1:length(model.vertebrae)
            # Force gravitaire en N sur le DOF z (index 3)
            F[(i-1)*6 + 3] -= segment_mass * g
        end
    end
    
    # Charges externes
    for load in loads
        node_id = find_nearest_node(mesh, load.point)
        dof_start = (node_id - 1) * 6
        F[dof_start + 1] += load.force[1]
        F[dof_start + 2] += load.force[2]
        F[dof_start + 3] += load.force[3]
        F[dof_start + 4] += load.moment[1]
        F[dof_start + 5] += load.moment[2]
        F[dof_start + 6] += load.moment[3]
    end
    
    # ── 4. Conditions aux limites ──
    K_bc, F_bc, active_dofs = apply_boundary_conditions(K, F, model.fixed_dofs;
                                                         method=bc_method)
    
    # ── 5. Résolution ──
    K_sym = (K_bc + K_bc') / 2
    
    diag_K = diag(K_sym)
    diag_K = max.(abs.(diag_K), 1e-10)
    Pl = Diagonal(1.0 ./ diag_K)
    
    U_reduced = try
        u, history = cg(K_sym, F_bc; Pl=Pl, tol=1e-8, maxiter=2000, log=true)
        if !history.isconverged
            @warn "CG : convergence non atteinte" iterations=history.iters residual=history.data[:resnorm][end]
        else
            model.solver_iterations = history.iters
            @info "CG convergé" iterations=history.iters
        end
        u
    catch e
        @warn "CG échoué, tentative décomposition directe" exception=e
        Symmetric(K_sym) \ F_bc
    end
    
    # ── 5b. Reconstruire le vecteur de déplacement complet ──
    U = zeros(mesh.num_dof)
    if bc_method == :elimination
        for (i, dof) in enumerate(active_dofs)
            U[dof] = U_reduced[i]
        end
    else
        U = U_reduced
    end
    
    # ── 6. Post-traitement ──
    model.displacement = U
    model.is_solved = true
    
    # Mettre à jour les positions depuis la RÉFÉRENCE (pas incrémental)
    for i in 1:length(model.vertebrae)
        dof_start = (i - 1) * 6
        dx = Vec3(U[dof_start+1], U[dof_start+2], U[dof_start+3])
        model.vertebrae[i].position = reference_positions[i] + dx
        
        # Rotation (petits angles, appliquée depuis l'orientation de référence)
        θx, θy, θz = U[dof_start+4], U[dof_start+5], U[dof_start+6]
        R = rotation_matrix(θx, θy, θz)
        model.vertebrae[i].orientation = R * reference_orientations[i]
    end
    
    # Mettre à jour les longueurs des ligaments
    for lig in model.ligaments
        node1 = find_nearest_node(mesh, lig.origin)
        node2 = find_nearest_node(mesh, lig.insertion)
        p1 = mesh.nodes[node1].position + Vec3(U[(node1-1)*6+1], U[(node1-1)*6+2], U[(node1-1)*6+3])
        p2 = mesh.nodes[node2].position + Vec3(U[(node2-1)*6+1], U[(node2-1)*6+2], U[(node2-1)*6+3])
        lig.current_length = norm(p2 - p1)
        compute_ligament_force!(lig)
    end
    
    # Calculer les contraintes dans les éléments
    model.stress_field = compute_element_stresses(mesh, U)
    
    # Stocker la matrice et le vecteur pour référence
    model.global_stiffness = K
    model.force_vector = F
    
    return U
end

"""
    rotation_matrix(θx, θy, θz) → Mat3

Matrice de rotation pour de petits angles (approximation linéaire).
"""
function rotation_matrix(θx::Float64, θy::Float64, θz::Float64)
    # Pour de petits angles : R ≈ I + skew(θ)
    return Mat3(
        1,   -θz,  θy,
        θz,   1,  -θx,
       -θy,  θx,   1
    )
end

"""
    compute_element_stresses(mesh, U) → Vector{StressTensor}

Calcule les contraintes dans chaque élément poutre.

**Important** : Les déplacements globaux U sont d'abord transformés en
coordonnées locales via la matrice de rotation T de l'élément, afin que
les déformations axiales, de flexion et de torsion soient correctement
calculées dans le repère de la poutre.

Formules (Euler-Bernoulli 3D) :
- σ_axial = E × (u₇ - u₁) / L
- σ_flex  = E × c × κ   où κ = courbure locale
- τ_torsion = G × c × (θx₂ - θx₁) / L
"""
function compute_element_stresses(mesh::SpineMesh, U::Vector{Float64})
    stresses = StressTensor[]
    
    for elem in mesh.elements
        dof1 = ((elem.node1 - 1) * 6 + 1):(elem.node1 * 6)
        dof2 = ((elem.node2 - 1) * 6 + 1):(elem.node2 * 6)
        
        # Déplacements globaux de l'élément (12 DOF)
        u_global = vcat(U[dof1], U[dof2])
        
        # ── Transformation globale → locale ──
        # T est la matrice de rotation (locale→globale formée dans stiffness.jl)
        # u_local = T * u_global  (T est orthogonale, T⁻¹ = T')
        p1 = mesh.nodes[elem.node1].position
        p2 = mesh.nodes[elem.node2].position
        T = element_rotation_matrix(p1, p2)
        u_local = T * u_global
        
        L = elem.length
        
        # Contrainte axiale : σ = E × ε = E × Δu_x / L
        δu = u_local[7] - u_local[1]
        σ_axial = elem.E * δu / L
        
        # Rayon effectif de la section (approximation circulaire)
        c = sqrt(elem.A / π)
        
        # Contrainte de flexion dans le plan XZ (rotation θy)
        # M_y = EIy × κ_y, σ_flex = M_y × c / Iy = E × c × κ_y
        # κ_y ≈ (θy₂ - θy₁) / L pour petits angles
        Δθy = u_local[11] - u_local[5]
        σ_flex_y = elem.E * c * Δθy / L
        
        # Contrainte de flexion dans le plan XY (rotation θz)
        Δθz = u_local[12] - u_local[6]
        σ_flex_z = elem.E * c * Δθz / L
        
        # Contrainte de torsion : τ = G × c × (θx₂ - θx₁) / L
        Δθx = u_local[10] - u_local[4]
        τ_torsion = elem.G * c * Δθx / L
        
        # Tenseur de Cauchy simplifié (poutre)
        # σ₁₁ = axial + flexion (fibre extrême)
        σ11 = σ_axial + abs(σ_flex_y) + abs(σ_flex_z)
        σ = Mat3(
            σ11,         τ_torsion, 0,
            τ_torsion,   0,         0,
            0,           0,         0
        )
        
        push!(stresses, StressTensor(σ))
    end
    
    return stresses
end

"""
    cg_solve(K, F; maxiter=2000, tol=1e-8) → Vector{Float64}

Solveur gradient conjugué via IterativeSolvers.jl avec préconditionneur Jacobi.
Remplace l'ancienne implémentation maison.
"""
function cg_solve(K, F; maxiter::Int=2000, tol::Float64=1e-8)
    diag_K = max.(abs.(diag(K)), 1e-10)
    Pl = Diagonal(1.0 ./ diag_K)
    u, history = cg(K, F; Pl=Pl, tol=tol, maxiter=maxiter, log=true)
    if !history.isconverged
        @warn "cg_solve : convergence non atteinte" iterations=history.iters
    end
    return u
end
