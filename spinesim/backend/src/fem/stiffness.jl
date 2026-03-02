# ══════════════════════════════════════════════════════════════
# Vertex — Matrice de rigidité (poutre Euler-Bernoulli 3D)
# ══════════════════════════════════════════════════════════════

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
    assemble_global_stiffness(mesh::SpineMesh) → SparseMatrixCSC

Assemble la matrice de rigidité globale par assemblage FEM classique.
"""
function assemble_global_stiffness(mesh::SpineMesh)
    ndof = mesh.num_dof
    
    # Accumulation par triplets pour efficacité
    I = Int[]
    J = Int[]
    V = Float64[]
    
    for elem in mesh.elements
        Ke = beam_stiffness_matrix(elem)
        
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
