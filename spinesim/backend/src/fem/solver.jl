# ══════════════════════════════════════════════════════════════
# Vertex — Solveur FEM
# ══════════════════════════════════════════════════════════════

"""
    solve_spine!(model::SpineModel; gravity=true, loads=Load[])

Résout l'équilibre mécanique du rachis :
1. Génère le maillage
2. Assemble la matrice de rigidité K
3. Calcule le vecteur de forces F (gravité + charges externes)
4. Applique les conditions aux limites (sacrum fixé)
5. Résout K·U = F
6. Post-traite : contraintes, déplacements
"""
function solve_spine!(model::SpineModel; gravity::Bool=true,
                      loads::Vector{Load}=Load[])
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
        g = 9810.0  # mm/s² (gravité en mm car coordonnées en mm)
        
        for i in 1:length(model.vertebrae)
            # Force gravitaire sur le DOF z (index 3)
            F[(i-1)*6 + 3] -= segment_mass * g / 1000.0  # → N
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
    
    # ── 4. Conditions aux limites (méthode de pénalité) ──
    penalty = 1e15
    for dof in model.fixed_dofs
        K[dof, dof] += penalty
        F[dof] = 0.0
    end
    
    # ── 5. Résolution ──
    # Rendre K symétrique (précaution numérique)
    K_sym = Symmetric((K + K') / 2)
    
    U = try
        K_sym \ F
    catch e
        @warn "Décomposition directe échouée, tentative itérative" exception=e
        # Fallback : gradient conjugué
        cg_solve(K, F, maxiter=500, tol=1e-8)
    end
    
    # ── 6. Post-traitement ──
    model.displacement = U
    model.is_solved = true
    
    # Mettre à jour les positions des vertèbres
    for i in 1:length(model.vertebrae)
        dof_start = (i - 1) * 6
        dx = Vec3(U[dof_start+1], U[dof_start+2], U[dof_start+3])
        model.vertebrae[i].position += dx
        
        # Rotation simplifiée (petits angles)
        θx, θy, θz = U[dof_start+4], U[dof_start+5], U[dof_start+6]
        R = rotation_matrix(θx, θy, θz)
        model.vertebrae[i].orientation = R * model.vertebrae[i].orientation
    end
    
    # Mettre à jour les longueurs des ligaments
    for lig in model.ligaments
        # Recalculer la longueur courante
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

Calcule les contraintes de von Mises dans chaque élément poutre.
"""
function compute_element_stresses(mesh::SpineMesh, U::Vector{Float64})
    stresses = StressTensor[]
    
    for elem in mesh.elements
        dof1 = ((elem.node1 - 1) * 6 + 1):(elem.node1 * 6)
        dof2 = ((elem.node2 - 1) * 6 + 1):(elem.node2 * 6)
        
        u_local = vcat(U[dof1], U[dof2])
        
        # Contrainte axiale
        δu = u_local[7] - u_local[1]  # déplacement axial relatif
        σ_axial = elem.E * δu / elem.length
        
        # Contrainte de flexion (moment max aux nœuds)
        # M = EI × κ (courbure)
        Δθy = u_local[11] - u_local[5]
        Δθz = u_local[12] - u_local[6]
        
        c_y = sqrt(elem.A / π)  # rayon effectif
        σ_flex_y = elem.E * elem.Iy * Δθy / (elem.length * elem.A) * c_y
        σ_flex_z = elem.E * elem.Iz * Δθz / (elem.length * elem.A) * c_y
        
        # Contrainte de torsion
        Δθx = u_local[10] - u_local[4]
        τ_torsion = elem.G * elem.J * Δθx / (elem.length * elem.A) * c_y
        
        # Tenseur simplifié
        σ11 = σ_axial + σ_flex_y + σ_flex_z
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
    cg_solve(K, F; maxiter=500, tol=1e-8) → Vector{Float64}

Solveur itératif gradient conjugué (fallback si décomposition directe échoue).
"""
function cg_solve(K, F; maxiter::Int=500, tol::Float64=1e-8)
    n = length(F)
    x = zeros(n)
    r = F - K * x
    p = copy(r)
    rsold = dot(r, r)
    
    for i in 1:maxiter
        Ap = K * p
        α = rsold / (dot(p, Ap) + 1e-30)
        x .+= α .* p
        r .-= α .* Ap
        rsnew = dot(r, r)
        
        if sqrt(rsnew) < tol
            return x
        end
        
        p = r + (rsnew / rsold) * p
        rsold = rsnew
    end
    
    @warn "CG n'a pas convergé en $maxiter itérations (résidu: $(sqrt(rsold)))"
    return x
end
