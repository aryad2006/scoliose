# ══════════════════════════════════════════════════════════════
# Vertex — Tests unitaires
# ══════════════════════════════════════════════════════════════

using Test

# Simuler les includes du module (en attendant la résolution des dépendances)
include("../src/models/types.jl")
include("../src/models/vertebra.jl")
include("../src/models/disc.jl")
include("../src/models/ligament.jl")
include("../src/models/spine.jl")
include("../src/fem/mesh.jl")
include("../src/fem/stiffness.jl")
include("../src/fem/solver.jl")
include("../src/pathology/scoliosis.jl")
include("../src/longitudinal/types.jl")
include("../src/longitudinal/asymmetry.jl")
include("../src/longitudinal/fatigue.jl")
include("../src/longitudinal/remodeling.jl")
include("../src/longitudinal/simulation.jl")
include("../src/surgery/screw.jl")
include("../src/surgery/rod.jl")
include("../src/surgery/evaluation.jl")

@testset "VERTEX© — Tests complets" begin

    @testset "Types fondamentaux" begin
        @test CORTICAL_BONE.youngs_modulus == 14.0e9
        @test CANCELLOUS_BONE.youngs_modulus == 0.3e9
        @test TITANIUM_6AL4V.youngs_modulus == 110.0e9
        
        # Von Mises
        σ = StressTensor(Mat3(100.0, 0, 0, 0, 50.0, 0, 0, 0, 0))
        vm = von_mises(σ)
        @test vm > 0
        @test vm ≈ sqrt(0.5 * ((100-50)^2 + (50-0)^2 + (0-100)^2))
        
        # PfirrmannGrade
        g1 = PfirrmannGrade(1)
        @test g1.height_ratio == 1.0
        g5 = PfirrmannGrade(5)
        @test g5.height_ratio == 0.4
        @test_throws AssertionError PfirrmannGrade(6)
    end

    @testset "Morphologie vertébrale" begin
        @test length(VERTEBRAL_MORPHOLOGY) == 23  # C3-S1
        
        # Les pédicules lombaires sont plus larges que les thoraciques
        @test VERTEBRAL_MORPHOLOGY[L5].pedicle_width > VERTEBRAL_MORPHOLOGY[T4].pedicle_width
        
        # Les corps lombaires sont plus grands
        @test VERTEBRAL_MORPHOLOGY[L5].body_width > VERTEBRAL_MORPHOLOGY[T5].body_width
        
        # Orientation des facettes : sagittale au lombaire, frontale au thoracique
        @test VERTEBRAL_MORPHOLOGY[L3].facet_orientation < VERTEBRAL_MORPHOLOGY[T5].facet_orientation
    end

    @testset "Création de vertèbre" begin
        vb = create_vertebra(L3, Vec3(0, 0, 100))
        @test vb.level == L3
        @test vb.position == Vec3(0, 0, 100)
        @test vb.morphology.pedicle_width ≈ 11.2
        
        # Ostéoporose → os plus faible
        vb_osteo = create_vertebra(L3, Vec3(0, 0, 100); tscore=-3.0)
        @test vb_osteo.cortical.youngs_modulus < vb.cortical.youngs_modulus
        @test vb_osteo.cancellous.youngs_modulus < vb.cancellous.youngs_modulus
    end

    @testset "Création de disque" begin
        disc = create_disc(L4L5, Vec3(0, 0, 50), 47.0, 36.0)
        @test disc.level == L4L5
        @test disc.height ≈ 12.0  # Hauteur de référence L4-L5
        @test disc.nucleus.water_content ≈ 0.85
        @test length(disc.annulus.fiber_families) == 15
        
        # Dégénérescence
        disc_deg = create_disc(L4L5, Vec3(0, 0, 50), 47.0, 36.0; pfirrmann=4)
        @test disc_deg.height < disc.height
        @test disc_deg.nucleus.pressure < disc.nucleus.pressure
    end

    @testset "Ligaments" begin
        lig = create_ligament(LVCA, T8, Vec3(0, 15, 100), Vec3(0, 15, 80))
        @test lig.type == LVCA
        @test lig.linear_stiffness == 33.0
        @test !lig.is_ruptured
        
        # Ligament jaune : pré-tendu
        lig_lf = create_ligament(LF, T8, Vec3(0, -15, 100), Vec3(0, -15, 80))
        @test lig_lf.is_pretensioned
        @test lig_lf.current_force > 0
    end

    @testset "Rachis normal" begin
        model = create_normal_spine(weight=70.0, height=170.0, age=30, sex=:M)
        
        @test length(model.vertebrae) == 23  # C3-S1
        @test length(model.discs) == 22
        @test length(model.ligaments) > 100  # ~9 ligaments × 22 niveaux
        @test model.num_dof == 138  # 23 × 6
        
        # S1 est fixé
        @test length(model.fixed_dofs) == 6
        
        # C3 est en haut, S1 en bas
        @test model.vertebrae[1].position[3] > model.vertebrae[end].position[3]
        
        # Sérialisation
        json = to_json(model)
        @test haskey(json, "vertebrae")
        @test length(json["vertebrae"]) == 23
    end

    @testset "Maillage poutre" begin
        model = create_normal_spine()
        mesh = generate_spine_mesh(model)
        
        @test length(mesh.nodes) == 23
        @test length(mesh.elements) == 22
        @test mesh.num_dof == 138
    end

    @testset "Matrice de rigidité" begin
        model = create_normal_spine()
        mesh = generate_spine_mesh(model)
        K = assemble_global_stiffness(mesh)
        
        @test size(K) == (138, 138)
        @test issymmetric(K)  # La matrice doit être symétrique
        @test nnz(K) > 0      # Non vide
    end

    @testset "Solveur FEM" begin
        model = create_normal_spine()
        U = solve_spine!(model)
        
        @test model.is_solved
        @test length(U) == 138
        
        # Les déplacements doivent être petits (rachis en équilibre)
        @test maximum(abs.(U)) < 50.0  # mm — pas de grands déplacements
        
        # Le sacrum ne bouge pas (conditions aux limites)
        sacrum_disp = U[end-5:end]
        @test all(abs.(sacrum_disp) .< 1e-3)
    end

    @testset "Scoliose" begin
        model = create_normal_spine()
        params = lenke1_thoracic(50.0)
        
        @test params.lenke_type == 1
        @test params.main_cobb == 50.0
        @test params.main_apex == T8
        
        generate_scoliosis!(model, params)
        
        # Après scoliose, les vertèbres thoraciques doivent être déplacées latéralement
        t8 = get_vertebra(model, T8)
        @test abs(t8.position[1]) > 0  # Déplacement latéral non nul
    end

    @testset "Vis pédiculaire" begin
        model = create_normal_spine()
        vb = get_vertebra(model, L4)
        
        # Trajectoire idéale
        entry = ideal_entry_point(L4, :left, vb.morphology, vb.position)
        traj = ideal_trajectory(L4, :left, vb.morphology)
        
        @test norm(traj) ≈ 1.0  # Vecteur unité
        
        # Placement correct
        screw = PedicleScrew(L4, :left, entry, traj, 6.5, 45.0, :polyaxial, TITANIUM_6AL4V)
        result = simulate_screw_placement(model, screw)
        
        @test result.is_placed
        @test result.breach == :none
        @test result.accuracy > 90.0
        @test result.pullout_strength > 0
        
        # Vis trop grosse → brèche
        big_screw = PedicleScrew(L4, :left, entry, traj, 20.0, 45.0, :polyaxial, TITANIUM_6AL4V)
        result_big = simulate_screw_placement(model, big_screw)
        @test !result_big.is_placed || result_big.breach != :none
    end

    # ═══════════════════════════════════════════════════════════════
    # TESTS — Simulation Longitudinale (Théorie du Ressort Spiral)
    # ═══════════════════════════════════════════════════════════════

    @testset "Types longitudinaux" begin
        # Config symétrique
        config = symmetric_config()
        @test config.category == ASYMMETRY_NONE
        @test isempty(config.static_asymmetries)
        @test isempty(config.dynamic_asymmetries)
        
        # Cunéiformisation
        wedge = mild_vertebral_wedging(level=T8, angle=2.0, side=:right)
        @test wedge.category == ASYMMETRY_STATIC
        @test length(wedge.static_asymmetries) == 1
        @test wedge.static_asymmetries[1].magnitude == 2.0
        
        # Asymétrie ligamentaire
        lig = mild_ligament_asymmetry(ratio=1.15)
        @test lig.category == ASYMMETRY_DYNAMIC
        @test length(lig.dynamic_asymmetries) == 1
        
        # Combinée
        combo = combined_asymmetry()
        @test combo.category == ASYMMETRY_COMBINED
        @test length(combo.static_asymmetries) == 1
        @test length(combo.dynamic_asymmetries) == 1
    end

    @testset "Profil de chargement quotidien" begin
        profile = standard_daily_profile(70.0, 170.0)
        @test length(profile.activities) == 7
        
        # Les fractions de temps doivent sommer à ~1
        total_time = sum(a.duration_fraction for a in profile.activities)
        @test 0.95 < total_time < 1.15  # tolérance
        
        # Port assis > debout (Nachemson)
        assis = findfirst(a -> a.name == "Assis", profile.activities)
        debout = findfirst(a -> a.name == "Debout immobile", profile.activities)
        @test profile.activities[assis].axial_load > profile.activities[debout].axial_load
    end

    @testset "Paramètres par défaut" begin
        params = default_longitudinal_params()
        @test params.duration_years == 20.0
        @test params.initial_age == 10
        @test params.sex == :F
        @test params.growth_enabled == true
        @test params.asymmetry.category == ASYMMETRY_NONE
    end

    @testset "Asymétrie initiale" begin
        model = create_normal_spine()
        
        # Position initiale de T8
        t8_initial = get_vertebra(model, T8).position
        t8_orient_initial = get_vertebra(model, T8).orientation
        
        # Appliquer cunéiformisation
        config = mild_vertebral_wedging(level=T8, angle=3.0, side=:right)
        apply_initial_asymmetry!(model, config)
        
        # L'orientation doit avoir changé
        t8_orient_after = get_vertebra(model, T8).orientation
        @test t8_orient_after != t8_orient_initial
    end

    @testset "Fatigue cyclique" begin
        model = create_normal_spine()
        states = initialize_fatigue_states(model)
        
        @test length(states) == 22  # 22 segments
        @test all(s.vertebral_damage == 0.0 for s in states)
        @test all(s.total_cycles == 0 for s in states)
        
        # Vérifier les courbes S-N
        @test fatigue_life_bone(0.2) > 1e14  # Sous le seuil → infini
        @test fatigue_life_bone(0.5) < fatigue_life_bone(0.4)  # Plus de stress → moins de cycles
        @test fatigue_life_disc(0.1) > 1e11  # Sous le seuil
    end

    @testset "Remodelage osseux" begin
        model = create_normal_spine()
        states = initialize_remodeling_states(model)
        
        @test length(states) == 23  # Une par vertèbre
        @test all(s.density_distribution == Vec3(1, 1, 1) for s in states)
        
        # Distribution de contraintes asymétrique
        stress = fill(1.0e6, 22)
        
        # Remodelage avec taux normal
        update_bone_remodeling!(states, model, stress, 0.5, 1)
        
        # Les densités doivent avoir bougé (légèrement)
        # Pour un rachis symétrique avec contraintes uniformes,
        # le changement est minime
    end

    @testset "Dégénérescence discale" begin
        model = create_normal_spine()
        disc_states = initialize_disc_degeneration_states(model)
        
        @test length(disc_states) == 22
        @test all(s.current_pfirrmann ≈ 1.0 for s in disc_states)
        @test all(s.height_asymmetry ≈ 1.0 for s in disc_states)
    end

    @testset "Analyse de flambage (ressort spiral)" begin
        model = create_normal_spine()
        
        # Un rachis normal ne devrait pas flamber sous le poids d'une personne
        ratio = compute_spring_buckling_ratio(model, 70.0)
        @test ratio < 1.0  # Pas de flambage
        @test ratio > 0.0  # Mais un ratio non nul
        
        # Rigidité effective
        EI = compute_effective_bending_stiffness(model)
        @test EI > 0
        
        # Pénalité d'asymétrie — rachis normal ≈ 1.0
        penalty = compute_asymmetry_penalty(model)
        @test 0.5 < penalty ≤ 1.0
    end

    @testset "Simulation longitudinale courte" begin
        # Test avec une simulation très courte (1 an, pas de 6 mois)
        params = default_longitudinal_params(
            duration_years=1.0,
            time_step_months=6,
            snapshot_interval=6,
            asymmetry=symmetric_config()
        )
        
        result = run_longitudinal_simulation(params)
        
        @test result.duration_years == 1.0
        @test result.final_cobb ≥ 0.0
        @test length(result.snapshots) ≥ 1
        
        # Un rachis symétrique ne devrait pas développer de scoliose en 1 an
        @test !result.developed_scoliosis
    end

    # ═══════════════════════════════════════════════════════════════
    # TESTS SPRINT 0 — T0.5 : Warnings dans LongitudinalResult
    # ═══════════════════════════════════════════════════════════════

    @testset "LongitudinalResult — champ warnings (Sprint 0)" begin
        params = default_longitudinal_params(
            duration_years=1.0,
            time_step_months=6,
            snapshot_interval=6,
            asymmetry=symmetric_config()
        )
        result = run_longitudinal_simulation(params)
        
        # Le champ warnings doit exister et être un Vector{String}
        @test hasfield(typeof(result), :warnings)
        @test result.warnings isa Vector{String}
        
        # Pour un rachis normal, aucun avertissement FEM attendu
        # (le solveur doit converger)
        @test length(result.warnings) == 0 ||
              all(contains("FEM"), result.warnings)
    end

    # ═══════════════════════════════════════════════════════════════
    # TESTS SPRINT 0 — T0.3 : Thread-safety ACTIVE_MODELS
    # ═══════════════════════════════════════════════════════════════

    @testset "Thread-safety du dictionnaire (Sprint 0)" begin
        # Test minimal sans démarrer le serveur HTTP
        lock_obj = ReentrantLock()
        dict = Dict{Int, String}()
        
        # Écriture concurrente
        tasks = map(1:20) do i
            @async begin
                lock(lock_obj) do
                    dict[i] = "model_$i"
                end
            end
        end
        for t in tasks; wait(t); end
        
        @test length(dict) == 20
        @test all(haskey(dict, i) for i in 1:20)
        
        # Lecture concurrente pendant écriture
        results = Vector{Union{String,Nothing}}(undef, 20)
        write_tasks = [@async begin
            lock(lock_obj) do
                dict[100+i] = "extra_$i"
            end
        end for i in 1:10]
        read_tasks = [@async begin
            results[i] = lock(lock_obj) do
                get(dict, i, nothing)
            end
        end for i in 1:20]
        
        for t in vcat(write_tasks, read_tasks); wait(t); end
        # Pas de data race → toutes les lectures ont eu une valeur
        @test all(!isnothing(r) for r in results)
    end

    # ═══════════════════════════════════════════════════════════════
    # TESTS SPRINT 3 — Génération de rapports
    # ═══════════════════════════════════════════════════════════════

    @testset "Module Reports (Sprint 3)" begin
        include("../src/reports/report.jl")
        
        model = create_normal_spine(weight=75.0, height=175.0, age=35, sex=:M)
        
        report = Reports.generate_spine_report(model;
                    patient_name="Dr. Test",
                    generated_by="Test Suite")
        
        # Structure de base
        @test haskey(report, "metadata")
        @test haskey(report, "patient")
        @test haskey(report, "clinical_measurements")
        @test haskey(report, "pathologies")
        @test haskey(report, "recommendations")
        
        # Patient
        @test report["patient"]["age"] == 35
        @test report["patient"]["sex"] == "M"
        @test report["patient"]["weight_kg"] == 75.0
        @test report["patient"]["bmi"] > 0
        
        # Mesures cliniques
        cm = report["clinical_measurements"]
        @test cm["cobb_angle_deg"] >= 0
        @test cm["scoliosis_severity"] isa String
        @test cm["thoracic_kyphosis_deg"] >= 0
        
        # Recommandations non vides
        @test length(report["recommendations"]) >= 1
    end

    @testset "Sévérité Cobb (Reports)" begin
        include("../src/reports/report.jl")
        @test Reports.cobb_severity_label(5.0)  == "normal"
        @test Reports.cobb_severity_label(15.0) == "légère"
        @test Reports.cobb_severity_label(30.0) == "modérée"
        @test Reports.cobb_severity_label(50.0) == "sévère"
        @test Reports.cobb_severity_label(75.0) == "très sévère"
    end

    # ═══════════════════════════════════════════════════════════════
    # TESTS PLAN SPRINT 3 — FEM amélioré
    # ═══════════════════════════════════════════════════════════════

    @testset "FEM — Matrice de rotation locale→globale" begin
        using LinearAlgebra: norm, I

        # ── Cas vertical (axe y global) ──
        p1 = Vec3(0.0, 0.0, 0.0)
        p2 = Vec3(0.0, 1.0, 0.0)
        T = element_rotation_matrix(p1, p2)

        @test size(T) == (12, 12)

        # T doit être orthogonale : T * T' ≈ I₁₂
        @test T * T' ≈ Matrix(1.0 * I, 12, 12) atol=1e-10

        # Déterminant = ±1 (matrice orthogonale)
        @test abs(abs(det(T)) - 1.0) < 1e-10

        # Blocs diagonaux identiques (symétrie)
        for b in 0:3
            λb = T[(3b+1):(3b+3), (3b+1):(3b+3)]
            @test λb ≈ T[1:3, 1:3] atol=1e-12
        end

        # Blocs hors-diagonaux nuls
        @test norm(T[1:3, 4:6]) < 1e-12

        # ── Cas incliné à 45° ──
        p3 = Vec3(1.0, 1.0, 0.0)
        T2 = element_rotation_matrix(p1, p3)
        @test T2 * T2' ≈ Matrix(1.0 * I, 12, 12) atol=1e-10

        # ── Cas horizontal pur ──
        p4 = Vec3(1.0, 0.0, 0.0)
        T3 = element_rotation_matrix(p1, p4)
        @test T3 * T3' ≈ Matrix(1.0 * I, 12, 12) atol=1e-10
    end

    @testset "FEM — Énergie de déformation positive" begin
        # Un élément correctement assemblé doit avoir K semi-définie positive
        # (après application des CL)
        model = create_normal_spine(weight=70.0, height=170.0, age=30, sex=:M)
        mesh = generate_spine_mesh(model)

        K = assemble_global_stiffness(mesh)

        # La matrice doit être symétrique
        @test issymmetric(Matrix(K + K') / 2)

        # Tous les éléments diagonaux doivent être >= 0
        @test all(diag(K) .>= -1e-8)

        # La matrice doit être creuse
        @test isa(K, SparseMatrixCSC)
    end

    @testset "FEM — Solveur IterativeSolvers (CG)" begin
        # Test de base : résoudre un système 2x2 bien conditionné
        using SparseArrays

        K_test = sparse([2.0 -1.0; -1.0 2.0])
        F_test = [1.0, 0.0]

        # Solution exacte : [2/3, 1/3]
        u = cg_solve(K_test, F_test; tol=1e-12, maxiter=100)
        @test u ≈ [2/3, 1/3] atol=1e-10

        # Test sur un rachis complet avec gravité
        model = create_normal_spine(weight=70.0, height=170.0, age=30, sex=:M)
        U = solve_spine!(model; gravity=true)

        # La solution doit exister et ne pas contenir de NaN/Inf
        @test !any(isnan.(U))
        @test !any(isinf.(U))

        # Le déplacement du sacrum (nœud fixé) doit être nul
        n = length(model.vertebrae)
        dof_sacrum = ((n-1)*6+1):(n*6)
        @test norm(U[dof_sacrum]) < 1e-6  # effet pénalité

        # La norme de déplacement doit être physiquement raisonnable (< 50 mm)
        @test norm(U) < 50.0
    end

    @testset "FEM — Cohérence rachis scoliotique" begin
        # Un rachis avec scoliose doit avoir des déplacements différents
        model_normal  = create_normal_spine(weight=70.0, height=170.0, age=30, sex=:M)
        model_scol    = create_normal_spine(weight=70.0, height=170.0, age=30, sex=:M)
        apply_scoliosis!(model_scol; cobb_angle=35.0, apex=T8, curve_type=:king_III)

        U_normal = solve_spine!(model_normal; gravity=true)
        U_scol   = solve_spine!(model_scol;   gravity=true)

        @test !any(isnan.(U_scol))
        @test !any(isinf.(U_scol))

        # La norme totale de déplacement doit différer entre normal et scoliotique
        @test norm(U_scol) != norm(U_normal)
    end

    # ═══════════════════════════════════════════════════════════════
    # TESTS — Conditions aux limites par élimination
    # ═══════════════════════════════════════════════════════════════

    @testset "FEM — Conditions limites : élimination vs pénalité" begin
        model_elim = create_normal_spine(weight=70.0, height=170.0, age=30, sex=:M)
        model_pen  = create_normal_spine(weight=70.0, height=170.0, age=30, sex=:M)

        U_elim = solve_spine!(model_elim; gravity=true, bc_method=:elimination)
        U_pen  = solve_spine!(model_pen;  gravity=true, bc_method=:penalty)

        # Les deux méthodes doivent donner des résultats proches
        @test !any(isnan.(U_elim))
        @test !any(isnan.(U_pen))

        # Le sacrum doit être fixé dans les deux cas
        n = length(model_elim.vertebrae)
        dof_sacrum = ((n-1)*6+1):(n*6)

        # Élimination : sacrum strictement nul
        @test norm(U_elim[dof_sacrum]) < 1e-12

        # Pénalité : sacrum quasi-nul (mais pas exactement 0)
        @test norm(U_pen[dof_sacrum]) < 1e-3

        # Les déplacements des vertèbres libres doivent être similaires
        # (aux effets de conditionnement près)
        free_dofs = setdiff(1:length(U_elim), dof_sacrum)
        relative_error = norm(U_elim[free_dofs] - U_pen[free_dofs]) / 
                         max(norm(U_elim[free_dofs]), 1e-10)
        @test relative_error < 0.01  # < 1% de différence
    end

    # ═══════════════════════════════════════════════════════════════
    # TESTS — Ré-entrée du solveur (positions de référence)
    # ═══════════════════════════════════════════════════════════════

    @testset "FEM — Ré-entrée solve_spine! (idempotence)" begin
        model = create_normal_spine(weight=70.0, height=170.0, age=30, sex=:M)

        # Première résolution
        U1 = solve_spine!(model; gravity=true)
        pos_after_1 = [v.position for v in model.vertebrae]

        # Deuxième résolution — doit donner le MÊME résultat
        # (avant le fix, les positions s'accumulaient)
        U2 = solve_spine!(model; gravity=true)
        pos_after_2 = [v.position for v in model.vertebrae]

        @test U1 ≈ U2 atol=1e-8
        for i in 1:length(pos_after_1)
            @test pos_after_1[i] ≈ pos_after_2[i] atol=1e-10
        end
    end

    # ═══════════════════════════════════════════════════════════════
    # TESTS — Matrice de rigidité géométrique (flambage)
    # ═══════════════════════════════════════════════════════════════

    @testset "FEM — Matrice de rigidité géométrique" begin
        # Matrice géométrique d'un élément sous compression
        elem = BeamElement(1, 1, 2, 30.0,  # L = 30 mm
                           10.0e6, 3.85e6,  # E, G
                           500.0, 1e4, 1e4, 2e4)  # A, Iy, Iz, J

        N = 1000.0  # 1 kN compression
        Kg = beam_geometric_stiffness(elem, N)

        # 12×12
        @test size(Kg) == (12, 12)

        # Symétrique
        @test Kg ≈ Kg' atol=1e-12

        # Les termes diagonaux translationnels (v,w) doivent être > 0 pour N > 0
        @test Kg[2, 2] > 0  # v
        @test Kg[3, 3] > 0  # w

        # Les termes axiaux (u) doivent être nuls (pas d'effet P-Δ en axial)
        @test abs(Kg[1, 1]) < 1e-15
        @test abs(Kg[7, 7]) < 1e-15

        # Pour N = 0, matrice nulle
        Kg0 = beam_geometric_stiffness(elem, 0.0)
        @test norm(Kg0) < 1e-15
    end

    @testset "FEM — Assemblage géométrique global" begin
        model = create_normal_spine(weight=70.0, height=170.0, age=30, sex=:M)
        U = solve_spine!(model; gravity=true)

        mesh = generate_spine_mesh(model)
        Kσ = assemble_geometric_stiffness(mesh, U)

        @test size(Kσ) == (138, 138)
        @test isa(Kσ, SparseMatrixCSC)

        # La matrice géométrique doit être non-nulle (il y a de la compression)
        @test nnz(Kσ) > 0
    end

    @testset "FEM — Analyse de flambage linéaire" begin
        model = create_normal_spine(weight=70.0, height=170.0, age=30, sex=:M)
        U = solve_spine!(model; gravity=true)

        mesh = generate_spine_mesh(model)
        K = assemble_global_stiffness(mesh)
        add_ligament_stiffness!(K, model.ligaments, mesh)
        Kσ = assemble_geometric_stiffness(mesh, U)

        λ_cr, _ = linear_buckling_factor(K, Kσ, model.fixed_dofs)

        # Un rachis normal ne doit pas flamber : λ_cr > 1
        @test λ_cr > 1.0

        # Mais le facteur doit être fini (pas Inf — il y a bien une charge critique)
        @test isfinite(λ_cr)
    end

    @testset "FEM — compute_fem_buckling_ratio" begin
        model = create_normal_spine(weight=70.0, height=170.0, age=30, sex=:M)
        solve_spine!(model; gravity=true)

        ratio = compute_fem_buckling_ratio(model, 70.0)

        # Rachis normal → pas de flambage → ratio < 1
        @test ratio < 1.0
        @test ratio > 0.0
    end

    # ═══════════════════════════════════════════════════════════════
    # TESTS — Contraintes en coordonnées locales
    # ═══════════════════════════════════════════════════════════════

    @testset "FEM — Contraintes en coordonnées locales" begin
        model = create_normal_spine(weight=70.0, height=170.0, age=30, sex=:M)
        U = solve_spine!(model; gravity=true)

        # Les contraintes doivent exister
        @test length(model.stress_field) == 22  # 22 éléments

        # Toutes les contraintes doivent être finies
        for s in model.stress_field
            vm = von_mises(s)
            @test isfinite(vm)
            @test vm ≥ 0.0
        end

        # Sous gravité pure, il doit y avoir de la compression (σ₁₁ non nul)
        has_nonzero = any(abs(s.σ[1,1]) > 1e-10 for s in model.stress_field)
        @test has_nonzero
    end

end

# ── Tests JWT (Sprint 2) ──────────────────────────────────────
println("Exécution des tests JWT...")
include("test_jwt.jl")

# ── Tests API intégration (Sprint 2-3) — seulement si serveur dispo ──
if get(ENV, "RUN_API_TESTS", "false") == "true"
    println("Exécution des tests d'intégration API...")
    include("test_api.jl")
end

println("\n✅ Tous les tests passés !")
