# ══════════════════════════════════════════════════════════════
# Vertex — Simulation de Tige (Rod)
# ══════════════════════════════════════════════════════════════

"""
Tige d'instrumentation rachidienne.
"""
struct RodPlacement
    side::Symbol                        # :left ou :right
    upper_level::VertebralLevel         # extrémité supérieure
    lower_level::VertebralLevel         # extrémité inférieure
    material::MaterialProperties        # titane ou CoCr
    diameter::Float64                   # mm (5.5, 6.0, 6.35)
    contour_points::Vector{Vec3}        # points de cintrage (profil sagittal)
end

"""
Manœuvre de correction chirurgicale.
"""
struct CorrectionManeuver
    type::Symbol        # :rod_rotation, :translation, :compression, :distraction, :derotation
    upper::VertebralLevel
    lower::VertebralLevel
    force::Float64      # N
    direction::Vec3
end

"""
    create_rod(side, upper, lower; material=:titanium, diameter=5.5) → RodPlacement

Crée une tige d'instrumentation.
"""
function create_rod(side::Symbol, upper::VertebralLevel, lower::VertebralLevel;
                    material::Symbol=:titanium, diameter::Float64=5.5)
    mat = if material == :titanium
        TITANIUM_6AL4V
    elseif material == :CoCr
        COBALT_CHROME
    else
        TITANIUM_6AL4V
    end
    
    return RodPlacement(side, upper, lower, mat, diameter, Vec3[])
end

"""
    apply_correction!(model, rod, maneuver) → CorrectionResult

Applique une manœuvre de correction chirurgicale :
- **Rod rotation** : rotation de 90° de la tige pré-cintrée → restaure la lordose/cyphose
- **Translation** : poussée latérale sur la tige via les vis
- **Compression** : rapproche deux vis (côté concave)
- **Distraction** : écarte deux vis (côté convexe)
- **Dérotation en bloc** : dérotation vertébrale via les vis polyaxiales
"""
function apply_correction!(model::SpineModel, rod::RodPlacement, maneuver::CorrectionManeuver)
    upper_idx = level_index(maneuver.upper)
    lower_idx = level_index(maneuver.lower)
    
    if upper_idx >= lower_idx
        error("Le niveau supérieur doit être au-dessus du niveau inférieur")
    end
    
    n_levels = lower_idx - upper_idx + 1
    
    if maneuver.type == :rod_rotation
        # La tige est pré-cintrée en lordose → la rotation de 90° dans le plan sagittal
        # transforme la courbure sagittale en courbure coronale → correction de la scoliose
        for i in upper_idx:lower_idx
            t = (i - upper_idx) / (n_levels - 1)
            # Correction proportionnelle
            correction_angle = maneuver.force / 100.0 * sin(π * t)  # force = proxy de l'angle
            R = rotation_matrix(0.0, 0.0, -correction_angle * 0.02)
            model.vertebrae[i].orientation = R * model.vertebrae[i].orientation
            
            # Déplacement latéral (correction coronale)
            pos = model.vertebrae[i].position
            dx = -pos[1] * correction_angle * 0.01  # Rappel vers le centre
            model.vertebrae[i].position = Vec3(pos[1] + dx, pos[2], pos[3])
        end
        
    elseif maneuver.type == :translation
        for i in upper_idx:lower_idx
            t = (i - upper_idx) / (n_levels - 1)
            shift = maneuver.force * 0.1 * sin(π * t)  # mm
            dir = maneuver.direction / (norm(maneuver.direction) + 1e-10)
            pos = model.vertebrae[i].position
            model.vertebrae[i].position = pos + shift * dir
        end
        
    elseif maneuver.type == :compression
        # Rapproche les vertèbres → réduit la hauteur du côté concave
        for i in upper_idx:lower_idx
            t = (i - upper_idx) / (n_levels - 1)
            dz = -maneuver.force * 0.005 * sin(π * t)  # mm (compression)
            pos = model.vertebrae[i].position
            model.vertebrae[i].position = Vec3(pos[1], pos[2], pos[3] + dz)
        end
        
    elseif maneuver.type == :distraction
        for i in upper_idx:lower_idx
            t = (i - upper_idx) / (n_levels - 1)
            dz = maneuver.force * 0.005 * sin(π * t)  # mm (distraction)
            pos = model.vertebrae[i].position
            model.vertebrae[i].position = Vec3(pos[1], pos[2], pos[3] + dz)
        end
        
    elseif maneuver.type == :derotation
        for i in upper_idx:lower_idx
            t = (i - upper_idx) / (n_levels - 1)
            derot = -maneuver.force * 0.01 * sin(π * t)  # degrés
            R = rotation_matrix(deg2rad(derot), 0.0, 0.0)
            model.vertebrae[i].orientation = R * model.vertebrae[i].orientation
        end
    end
    
    return nothing
end
