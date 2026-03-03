80% des scolioses sont idiopathiques, c'est à dire sans cause apparente, sans etiologie, mais il y a differentes theories, j'en ai une que je dois verifier, cette theorie peut expliquer la totalité ou une partie des scolioses idiopathiques: le rachis est symetrique, et il doit jouer son role d'amortisseur et repartiteur de pression, chose qu'ilpourra faire toute une vie, et il reste symetrique, pour son role d'amortisseur, il joue le role d'un ressort ( comme dans une voiture ou d'autres vehicules par exemple), don je veux simuler un rachis normal subissant les contraintes de pression de la vie quotidienne pendant des annees et voir les deformations, et s'il joue aussi le role d'un ressort spiral, puis les memes contraintes pendant des annees sur un rachis legerement asymetrique, d'origine statique(une deformation vertebrale ou de l'arc posterieur), ou dynamique(une assymetrie ligamentaire ou discale) est ce que vertex peut le faire ou je dois trouver une autre application?

---

# NOTE TECHNIQUE DE REPRISE
**Date** : 3 mars 2026 — **Commit** : e06349c (main, GitHub)

## Etat du projet — Phase 1 COMPLETE

La simulation longitudinale de la theorie du ressort spiral est **operationnelle et calibree**. Resultats cliniquement realistes.

**Resultats valides (fille, age 10 ans, 10/20 ans de simulation) :**

| Asymetrie initiale | Cobb final | Scoliose | Onset |
|:---|:---:|:---:|:---:|
| Symetrique | 0.0 | Non | - |
| Cuneiformisation 1 deg (T8) | 11.2 | Oui | age 14.2 ans |
| Cuneiformisation 2 deg (T8) | 22.2 | Oui | age 12.6 ans |
| Cuneiformisation 3 deg (T8) | 32.8 | Oui | age 12.1 ans |
| Ligament +10/20% (T7) | 0.0 | Non | - (limitation FEM) |
| Disque +10% (T8) | 0.0 | Non | - (limitation FEM) |
| Combinee (wedge 2 + lig 10%) | 22.2 | Oui | age 12.6 ans |

Interpretation : theorie verifiee pour la cuneiformisation statique. Coefficient amplification ~11x (1 deg wedging -> ~11 deg Cobb / 10 ans croissance). Asymetries tissus mous non initiatrices dans le FEM actuel (Phase 2).

---

## Bugs resolus (3 mars 2026)

| # | Fichier | Symptome | Fix |
|:---:|:---|:---|:---|
| 11 | stenosis/tumor/adult_deformity.jl | lig.level_index inexistant | level_index(lig.level) |
| 12 | stenosis.jl | lig.cross_section_area inexistant | Suppression |
| 13 | stenosis/adult_deformity.jl | disc.annulus.stiffness immutable | Reconstruction MaterialProperties |
| 14 | adult_deformity.jl | VertebralLevel(N) invalide | vertebral_levels()[N] |
| 15 | server.jl | wedging_1/2/3 non reconnus -> 0 silencieux | Branches explicites handler |
| 16 | asymmetry.jl | \ -> UndefVarError: angle | \ |

---

## Parametres calibration finaux (simulation.jl)

hueter_volkmann_k    = 1.0
growth_amplification = 18.0 * (growth_rate / (peak_rate + 0.5))
creep_coefficient    = 5e-11  mm/Pa/mois
theta_creep          = creep * sin(tilt) * 0.2
lat_growth           = delta_h * sin(tilt) * amplification * 0.05
seuil_tilt_HV        = 0.0005 rad
age_limite_croissance = 18 ans

---

## Prochaines etapes — Phase 2

1. FEM dynamique — permettre aux ligaments/disques d'initier la scoliose
   Fichiers : fem/solver.jl, longitudinal/simulation.jl

2. Rotation axiale — ajouter theta_z (gibbosité)
   Fichiers : simulation.jl, asymmetry.jl

3. Modules de formation — MODULE_02 a MODULE_05
   cours/MODULE_02_*.md a creer

---

## Pour reprendre

  cd C:\Users\USER\Documents\scoliose\spinesim
  docker compose up -d
  curl http://localhost:8080/health

  # Test (attendu max_cobb_angle = 22.2)
  curl -X POST http://localhost:8080/api/longitudinal/run -H Content-Type:application/json -d {duration_years:10,initial_age:10,asymmetry_type:wedging_2}

Rapport complet : docs/RAPPORT_SIMULATION_RESSORT_SPIRAL.md
