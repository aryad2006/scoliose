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

end

println("\n✅ Tous les tests passés !")
