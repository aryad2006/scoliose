# ══════════════════════════════════════════════════════════════
# Vertex — Asymétrie initiale du rachis
# Application des défauts structurels et fonctionnels
# ══════════════════════════════════════════════════════════════

"""
    apply_initial_asymmetry!(model::SpineModel, config::AsymmetryConfig)

Applique l'asymétrie initiale au rachis avant le début de la simulation
longitudinale. Les asymétries peuvent être subtiles (1-3°, quelques %) 
pour tester si elles s'amplifient en scoliose au fil du temps.
"""
function apply_initial_asymmetry!(model::SpineModel, config::AsymmetryConfig)
    if config.category == ASYMMETRY_NONE
        return model
    end
    
    # Asymétries statiques (structurelles)
    for sa in config.static_asymmetries
        apply_static_asymmetry!(model, sa)
    end
    
    # Asymétries dynamiques (fonctionnelles)
    for da in config.dynamic_asymmetries
        apply_dynamic_asymmetry!(model, da)
    end
    
    return model
end

"""
    apply_static_asymmetry!(model, asym::StaticAsymmetry)

Applique une asymétrie structurelle à une vertèbre.
"""
function apply_static_asymmetry!(model::SpineModel, asym::StaticAsymmetry)
    idx = level_index(asym.level)
    vb = model.vertebrae[idx]
    sign = asym.side == :left ? 1.0 : -1.0
    
    if asym.type == VERTEBRAL_WEDGING
        # Cunéiformisation dans le plan frontal
        # L'angle de cunéiformisation crée une inclinaison du plateau sup
        # Rotation autour de Y (axe antéro-postérieur) → tilt dans le plan XZ
        θy = deg2rad(asym.magnitude * sign)
        R = rotation_matrix(0.0, θy, 0.0)
        model.vertebrae[idx].orientation = R * vb.orientation
        
    elseif asym.type == POSTERIOR_ARCH_ASYMMETRY
        # L'asymétrie de l'arc postérieur (pédicule plus court d'un côté)
        # décale le centre de rotation et crée un couple asymétrique
        # Modélisé par un déplacement latéral subtil du centre vertébral
        offset = asym.magnitude * sign  # mm
        pos = vb.position
        model.vertebrae[idx].position = Vec3(pos[1] + offset, pos[2], pos[3])
        
    elseif asym.type == ENDPLATE_TILT
        # Inclinaison du plateau vertébral dans le plan frontal
        # Rotation autour de Y → tilt dans le plan XZ
        θy = deg2rad(asym.magnitude * sign * 0.5)
        R = rotation_matrix(0.0, θy, 0.0)
        model.vertebrae[idx].orientation = R * vb.orientation
    end
end

"""
    apply_dynamic_asymmetry!(model, asym::DynamicAsymmetry)

Applique une asymétrie fonctionnelle (tissus mous) à un segment.
"""
function apply_dynamic_asymmetry!(model::SpineModel, asym::DynamicAsymmetry)
    if asym.type == LIGAMENT_STIFFNESS_ASYMMETRY
        apply_ligament_asymmetry!(model, asym)
    elseif asym.type == DISC_ASYMMETRY
        apply_disc_asymmetry!(model, asym)
    elseif asym.type == MUSCLE_TONE_ASYMMETRY
        apply_muscle_asymmetry!(model, asym)
    end
end

"""
    apply_ligament_asymmetry!(model, asym)

Rend les ligaments asymétriques d'un côté : un côté plus rigide que l'autre.
Cela modifie la réponse du segment aux charges et peut initier
un déplacement préférentiel.
"""
function apply_ligament_asymmetry!(model::SpineModel, asym::DynamicAsymmetry)
    sign = asym.side == :left ? 1.0 : -1.0
    
    for lig in model.ligaments
        if lig.level == asym.level
            # Les ligaments du côté spécifié sont plus rigides
            # On identifie le côté par la position x de l'attache
            mid_x = (lig.origin[1] + lig.insertion[1]) / 2.0
            
            if mid_x * sign > 0  # Même côté que l'asymétrie
                lig.linear_stiffness *= asym.magnitude
                lig.failure_force *= asym.magnitude
            else
                # Côté opposé : légèrement plus souple (effet miroir)
                lig.linear_stiffness *= (2.0 - asym.magnitude)
                lig.failure_force *= (2.0 - asym.magnitude)
            end
        end
    end
end

"""
    apply_disc_asymmetry!(model, asym)

Crée une asymétrie discale : nucleus pulposus légèrement décentré,
ou différence de rigidité annulaire gauche/droite.
Cela modifie la distribution de pression sur les plateaux vertébraux.
"""
function apply_disc_asymmetry!(model::SpineModel, asym::DynamicAsymmetry)
    idx = level_index(asym.level)
    
    # Le disque est entre la vertèbre idx et idx+1
    if idx ≤ length(model.discs)
        disc = model.discs[idx]
        sign = asym.side == :left ? 1.0 : -1.0
        
        # Décaler le nucleus — cela change la distribution de pression
        nucleus_shift = disc.width * 0.05 * (asym.magnitude - 1.0) * sign  # mm
        disc.nucleus.pressure *= asym.magnitude  # Pression asymétrique
        
        # Différencier la rigidité de l'annulus (les fibres d'un côté sont plus tendues)
        for (i, fiber) in enumerate(disc.annulus.fiber_families)
            side_factor = (i % 2 == 1) ? sign : -sign
            disc.annulus.fiber_families[i] = FiberFamily(
                fiber.orientation,
                fiber.stiffness * (1.0 + 0.1 * (asym.magnitude - 1.0) * side_factor),
                fiber.recruitment_strain
            )
        end
    end
end

"""
    apply_muscle_asymmetry!(model, asym)

Simule une asymétrie du tonus musculaire par une force latérale permanente.
Non implémentée directement dans le modèle FEM actuel — modélisée comme
une charge latérale constante appliquée au segment.
"""
function apply_muscle_asymmetry!(model::SpineModel, asym::DynamicAsymmetry)
    # Pour le Phase 0, cette asymétrie est traitée dans la boucle
    # de simulation comme une charge latérale additionnelle.
    # Le flag est stocké dans la config et lu par le simulateur.
end

# ═══════════════════════════════════════════════════════════════
# Configurations prédéfinies d'asymétrie pour tests
# ═══════════════════════════════════════════════════════════════

"""
    mild_vertebral_wedging(; level=T8, angle=2.0, side=:right) → AsymmetryConfig

Configuration : légère cunéiformisation vertébrale (2° par défaut).
Simule une vertèbre très légèrement asymétrique de naissance.
"""
function mild_vertebral_wedging(; level::VertebralLevel=T8,
                                  angle::Float64=2.0,
                                  side::Symbol=:right)
    return AsymmetryConfig(
        ASYMMETRY_STATIC,
        [StaticAsymmetry(VERTEBRAL_WEDGING, level, angle, side)],
        DynamicAsymmetry[],
        "Cunéiformisation vertébrale légère ($angle° en $level, côté $side)"
    )
end

"""
    mild_ligament_asymmetry(; level=T7, ratio=1.15, side=:right) → AsymmetryConfig

Configuration : légère asymétrie ligamentaire (15% par défaut).
Simule des ligaments plus rigides d'un côté.
"""
function mild_ligament_asymmetry(; level::VertebralLevel=T7,
                                   ratio::Float64=1.15,
                                   side::Symbol=:right)
    return AsymmetryConfig(
        ASYMMETRY_DYNAMIC,
        StaticAsymmetry[],
        [DynamicAsymmetry(LIGAMENT_STIFFNESS_ASYMMETRY, level, ratio, side)],
        "Asymétrie ligamentaire légère ($(Int(round((ratio-1)*100)))% en $level, côté $side)"
    )
end

"""
    mild_disc_asymmetry(; level=T8, ratio=1.10, side=:right) → AsymmetryConfig

Configuration : légère asymétrie discale (10% par défaut).
"""
function mild_disc_asymmetry(; level::VertebralLevel=T8,
                               ratio::Float64=1.10,
                               side::Symbol=:right)
    return AsymmetryConfig(
        ASYMMETRY_DYNAMIC,
        StaticAsymmetry[],
        [DynamicAsymmetry(DISC_ASYMMETRY, level, ratio, side)],
        "Asymétrie discale légère ($(Int(round((ratio-1)*100)))% en $level, côté $side)"
    )
end

"""
    combined_asymmetry(; wedge_level=T8, wedge_angle=1.5, lig_level=T7,
                         lig_ratio=1.10, side=:right) → AsymmetryConfig

Configuration combinée : cunéiformisation + asymétrie ligamentaire.
"""
function combined_asymmetry(; wedge_level::VertebralLevel=T8,
                              wedge_angle::Float64=1.5,
                              lig_level::VertebralLevel=T7,
                              lig_ratio::Float64=1.10,
                              side::Symbol=:right)
    return AsymmetryConfig(
        ASYMMETRY_COMBINED,
        [StaticAsymmetry(VERTEBRAL_WEDGING, wedge_level, wedge_angle, side)],
        [DynamicAsymmetry(LIGAMENT_STIFFNESS_ASYMMETRY, lig_level, lig_ratio, side)],
        "Asymétrie combinée (wedge $(wedge_angle)° + lig $(Int(round((lig_ratio-1)*100)))%)"
    )
end
