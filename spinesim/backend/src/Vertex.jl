"""
    Vertex

VERTEX© — Virtual Environment for Rachis Training and EXploration
Application de simulation biomécanique du rachis et chirurgie virtuelle.
Module principal — Point d'entrée.
"""
module Vertex

# ── Dépendances standard ──
using LinearAlgebra
using SparseArrays
using StaticArrays
using UUIDs
using Dates

# ── Sous-modules ──
include("models/types.jl")
include("models/vertebra.jl")
include("models/disc.jl")
include("models/ligament.jl")
include("models/spine.jl")
include("fem/mesh.jl")
include("fem/stiffness.jl")
include("fem/solver.jl")
include("pathology/scoliosis.jl")
include("pathology/fracture.jl")
include("pathology/hernia.jl")
include("pathology/spondylolisthesis.jl")
include("pathology/stenosis.jl")
include("pathology/tumor.jl")
include("pathology/adult_deformity.jl")
include("longitudinal/types.jl")
include("longitudinal/asymmetry.jl")
include("longitudinal/fatigue.jl")
include("longitudinal/remodeling.jl")
include("longitudinal/simulation.jl")
include("surgery/screw.jl")
include("surgery/rod.jl")
include("surgery/evaluation.jl")
include("api/server.jl")

# ── Exports ──
export SpineModel, create_normal_spine, solve_spine!
export VertebralBody, VertebralMorphology, MaterialProperties
export IntervertebralDisc, NucleusPulposus, AnnulusFibrosus
export SpinalLigament, LigamentType

# Pathologies
export ScoliosisParameters, generate_scoliosis!
export FractureType, FractureParameters, generate_fracture!, compute_tlics
export HerniaType, HerniaLocation, HerniaParameters, generate_hernia!
export MeyerdingGrade, SpondyloEtiology, SpondyloParameters, generate_spondylolisthesis!
export StenosisLocation, SchizasGrade, StenosisType, StenosisParameters, generate_stenosis!
export TumorCompartment, TumorParameters, generate_tumor!, TokuhashiScore, TomitaScore, SINSScore
export AdultDeformityType, SRSSchwabCurveType, AdultDeformityParameters, generate_adult_deformity!
export SagittalBalance, PILLModifier, PTModifier, SVAModifier

# FEM avancé (Sprint 3+)
export beam_geometric_stiffness, assemble_geometric_stiffness
export linear_buckling_factor, apply_boundary_conditions
export compute_fem_buckling_ratio

# Simulation longitudinale (théorie du ressort spiral)
export AsymmetryCategory, StaticAsymmetryType, DynamicAsymmetryType
export StaticAsymmetry, DynamicAsymmetry, AsymmetryConfig
export symmetric_config, mild_vertebral_wedging, mild_ligament_asymmetry
export mild_disc_asymmetry, combined_asymmetry
export LongitudinalParams, LongitudinalResult, SpineSnapshot
export run_longitudinal_simulation, run_comparison_study, summarize_results
export DailyLoadProfile, DailyActivity, standard_daily_profile

# Chirurgie
export PedicleScrew, RodPlacement, SurgicalEvaluation
export CorrectionManeuver, ScrewResult
export start_server

end # module Vertex
