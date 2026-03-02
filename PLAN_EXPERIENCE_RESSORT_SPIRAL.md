# PLAN EXPÉRIMENTAL — Théorie du Ressort Spiral
## Simulation longitudinale du rachis : asymétrie initiale et développement de la scoliose idiopathique

**Date** : Février 2026  
**Plateforme** : VERTEX© (SpineSim)  
**Investigateur** : [Votre nom]

---

## 1. HYPOTHÈSE

> Un rachis présentant une asymétrie initiale subtile (statique ou dynamique), 
> soumis aux contraintes mécaniques de la vie quotidienne pendant des années, 
> développe progressivement une scoliose par flambage du « ressort spiral » 
> rachidien. Un rachis parfaitement symétrique reste stable.

### 1.1 Fondements mécaniques

Le rachis n'est pas une colonne droite : ses courbures sagittales (lordose cervicale, cyphose thoracique, lordose lombaire) lui donnent une géométrie de **ressort hélicoïdal**. Sous compression axiale (gravité + charges), un ressort hélicoïdal peut flamber latéralement si :

- La charge dépasse la **charge critique d'Euler** : P_cr = π²EI / (KL)²
- Le ressort présente une **excentricité initiale** (asymétrie) qui abaisse ce seuil critique
- Les charges sont **cycliques** (fatigue) et dégradent progressivement les propriétés mécaniques

### 1.2 Prédictions testables

| Condition | Prédiction |
|:--|:--|
| Rachis symétrique | Stable — pas de scoliose même après 20 ans |
| Cunéiformisation vertébrale 1° | Pas de scoliose ou scoliose mineure (<10°) |
| Cunéiformisation vertébrale 2-3° | Scoliose progressive (Cobb > 10°) |
| Asymétrie ligamentaire 10-15% | Scoliose progressive |
| Asymétrie discale 10% | Scoliose progressive lente |
| Asymétrie combinée | Scoliose plus précoce et plus sévère |
| L'effet est amplifié pendant la croissance (pic pubertaire) | Oui (Hueter-Volkmann) |

---

## 2. PRÉREQUIS TECHNIQUES

### 2.1 Environnement

- **Docker** installé et fonctionnel
- **Julia 1.10+** avec les packages : StaticArrays, SparseArrays, HTTP, JSON3
- Environ **2-4 Go de RAM** libres (les simulations sont CPU-intensives)
- Temps d'exécution estimé : ~5-15 min par simulation de 20 ans, ~1-2h pour l'étude comparative complète

### 2.2 Fichiers du module longitudinal

Vérifier que ces fichiers existent :

```
spinesim/backend/src/longitudinal/
├── types.jl          ← Types, profils de charge, paramètres
├── asymmetry.jl      ← Application des asymétries initiales
├── fatigue.jl        ← Accumulation de dommage (Miner)
├── remodeling.jl     ← Remodelage osseux (Wolff) + dégénérescence discale
└── simulation.jl     ← Boucle temporelle + analyse de flambage
```

### 2.3 Vérification de l'intégration

Le fichier `SpineSim.jl` doit inclure les 5 fichiers ci-dessus et exporter les types/fonctions correspondants.

---

## 3. PROTOCOLE EXPÉRIMENTAL

### Phase 1 — Validation du modèle de base (1-2 jours)

**Objectif** : vérifier que le rachis normal se comporte correctement avant de lancer l'étude longitudinale.

#### Étape 1.1 : Lancer le serveur

```bash
cd spinesim
docker compose up --build
```

Ou en local (sans Docker) :

```bash
cd spinesim/backend
julia --project=. -e "include(\"src/SpineSim.jl\"); using .Vertex; start_server()"
```

#### Étape 1.2 : Créer un rachis normal et vérifier

```bash
# Créer un rachis normal
curl -X POST http://localhost:8080/api/spine/create \
  -H "Content-Type: application/json" \
  -d '{"weight": 70, "height": 170, "age": 30, "sex": "M"}'

# Vérifier que la résolution FEM fonctionne
curl -X POST http://localhost:8080/api/spine/{ID}/solve
```

**Critères de validation** :
- [ ] Le rachis a 23 vertèbres (C3-S1) et 22 disques
- [ ] La résolution FEM converge (déplacements < 50 mm)
- [ ] Le sacrum est immobile (conditions aux limites)
- [ ] Les contraintes de Von Mises sont réalistes (0.1 - 10 MPa)

#### Étape 1.3 : Test rapide du module longitudinal

```bash
# Simulation courte (1 an) — rachis symétrique
curl -X POST http://localhost:8080/api/longitudinal/run \
  -H "Content-Type: application/json" \
  -d '{
    "duration_years": 1,
    "initial_age": 10,
    "sex": "F",
    "weight": 35,
    "height": 140,
    "asymmetry_type": "none"
  }'
```

**Critères de validation** :
- [ ] La simulation termine sans erreur
- [ ] Le Cobb final est < 5° (pas de scoliose en 1 an sans asymétrie)
- [ ] Au moins 1 snapshot est retourné
- [ ] Le ratio de flambage est < 1.0

---

### Phase 2 — Expérience principale : Étude comparative (1 jour)

**Objectif** : comparer 9 configurations d'asymétrie sur 20 ans de simulation.

#### Étape 2.1 : Lancer l'étude comparative complète

```bash
curl -X POST http://localhost:8080/api/longitudinal/comparison \
  -H "Content-Type: application/json" \
  -d '{
    "duration_years": 20,
    "initial_age": 10
  }'
```

Cette commande exécute **9 simulations** en séquence :

| # | Configuration | Description |
|:--|:--|:--|
| 1 | `1_symetrique` | Contrôle — rachis parfait |
| 2 | `2_wedging_1deg` | Cunéiformisation T8, 1° |
| 3 | `3_wedging_2deg` | Cunéiformisation T8, 2° |
| 4 | `4_wedging_3deg` | Cunéiformisation T8, 3° |
| 5 | `5_ligament_10pct` | Asymétrie ligamentaire T7, +10% |
| 6 | `6_ligament_20pct` | Asymétrie ligamentaire T7, +20% |
| 7 | `7_disc_10pct` | Asymétrie discale T8, +10% |
| 8 | `8_combined_mild` | Wedging 1.5° + ligament 10% |
| 9 | `9_combined_moderate` | Wedging 2.5° + ligament 20% |

**Durée estimée** : 1-2 heures (toutes les 9 simulations).

#### Étape 2.2 : Sauvegarder les résultats

Rediriger la sortie dans un fichier JSON :

```bash
curl -s -X POST http://localhost:8080/api/longitudinal/comparison \
  -H "Content-Type: application/json" \
  -d '{"duration_years": 20, "initial_age": 10}' \
  | python -m json.tool > resultats_experience.json
```

---

### Phase 3 — Simulations individuelles approfondies (1-2 jours)

**Objectif** : explorer des configurations spécifiques en détail.

#### Étape 3.1 : Varier le niveau vertébral de l'asymétrie

Tester si l'emplacement de l'asymétrie influence le type de scoliose :

```bash
# Asymétrie thoracique haute (T5)
curl -X POST http://localhost:8080/api/longitudinal/run \
  -H "Content-Type: application/json" \
  -d '{
    "duration_years": 20, "initial_age": 10, "sex": "F",
    "weight": 35, "height": 140,
    "asymmetry_type": "wedging",
    "asymmetry_level": "T5",
    "asymmetry_magnitude": 2.0,
    "asymmetry_side": "right"
  }'

# Asymétrie thoraco-lombaire (T12)
curl -X POST http://localhost:8080/api/longitudinal/run \
  -H "Content-Type: application/json" \
  -d '{
    "duration_years": 20, "initial_age": 10, "sex": "F",
    "weight": 35, "height": 140,
    "asymmetry_type": "wedging",
    "asymmetry_level": "T12",
    "asymmetry_magnitude": 2.0,
    "asymmetry_side": "right"
  }'

# Asymétrie lombaire (L3)
curl -X POST http://localhost:8080/api/longitudinal/run \
  -H "Content-Type: application/json" \
  -d '{
    "duration_years": 20, "initial_age": 10, "sex": "F",
    "weight": 35, "height": 140,
    "asymmetry_type": "wedging",
    "asymmetry_level": "L3",
    "asymmetry_magnitude": 2.0,
    "asymmetry_side": "right"
  }'
```

**Question** : est-ce que l'asymétrie thoracique donne une scoliose thoracique (Lenke 1) et l'asymétrie lombaire une scoliose lombaire (Lenke 5) ?

#### Étape 3.2 : Varier l'âge de début

Tester si l'âge de début influence la progression :

```bash
# Début à 5 ans (infantile)
curl -X POST ... -d '{"duration_years": 20, "initial_age": 5, ...}'

# Début à 10 ans (juvénile)
curl -X POST ... -d '{"duration_years": 20, "initial_age": 10, ...}'

# Début à 13 ans (adolescent, pic pubertaire)
curl -X POST ... -d '{"duration_years": 20, "initial_age": 13, ...}'

# Début à 25 ans (adulte — pas de croissance)
curl -X POST ... -d '{"duration_years": 20, "initial_age": 25, ...}'
```

**Prédiction** : la progression devrait être maximale pendant le pic de croissance pubertaire (10-14 ans) et faible/nulle chez l'adulte.

#### Étape 3.3 : Varier le sexe

```bash
# Fille (même asymétrie)
curl -X POST ... -d '{"sex": "F", "weight": 35, "height": 140, ...}'

# Garçon (même asymétrie)
curl -X POST ... -d '{"sex": "M", "weight": 40, "height": 145, ...}'
```

**Question** : est-ce que les différences de croissance M/F reproduisent le ratio 7F/1M observé en clinique ?

---

### Phase 4 — Analyse des résultats (2-3 jours)

#### Étape 4.1 : Extraire les courbes d'évolution

Pour chaque simulation, les **snapshots** contiennent l'évolution temporelle :

| Donnée | Signification |
|:--|:--|
| `cobb_angles` | Angles de Cobb par région (T5-T12, T10-L2, L1-L5) |
| `lateral_deviation_mm` | Déviation latérale maximale |
| `buckling_ratio` | Ratio P/P_critique (>1 = flambage) |
| `thoracic_kyphosis` | Cyphose thoracique |
| `lumbar_lordosis` | Lordose lombaire |

#### Étape 4.2 : Graphiques à produire

1. **Cobb vs Temps** (par configuration)
   - X = années, Y = angle de Cobb (°)
   - 9 courbes superposées
   - La courbe « symétrique » doit rester plate
   - Les courbes avec asymétrie doivent monter

2. **Ratio de flambage vs Temps**
   - X = années, Y = P/P_cr
   - Ligne horizontale à Y=1 (seuil de flambage)
   - Quand la courbe franchit Y=1 → initiation de la scoliose

3. **Cobb final vs Amplitude d'asymétrie initiale**
   - X = amplitude de l'asymétrie (0°, 1°, 2°, 3°)
   - Y = Cobb final (°)
   - Devrait montrer une relation non-linéaire (seuil)

4. **Âge d'apparition vs Type d'asymétrie**
   - Barplot : quelles asymétries causent une scoliose plus tôt ?

5. **Carte thermique du remodelage osseux**
   - Par vertèbre et par côté (gauche/droite)
   - Montrer la densification du côté concave

#### Étape 4.3 : Critères de succès de la théorie

La théorie du ressort spiral est **validée** si TOUTES ces conditions sont remplies :

- [  ] Le rachis symétrique (contrôle) reste avec Cobb < 5° après 20 ans
- [  ] Au moins 3 des 8 configurations asymétriques développent une scoliose (Cobb > 10°)
- [  ] L'amplitude de la scoliose est corrélée à l'amplitude de l'asymétrie initiale
- [  ] Le ratio de flambage franchit 1.0 AVANT l'apparition de la scoliose
- [  ] La progression est accélérée pendant le pic de croissance pubertaire
- [  ] La rotation vertébrale est couplée à l'inclinaison (comme en clinique)

La théorie est **partiellement validée** si 3-4 de ces critères sont remplis.  
La théorie est **réfutée** si le rachis symétrique développe aussi une scoliose (faux positif) ou si aucune asymétrie ne produit de scoliose.

---

## 4. PARAMÈTRES SENSIBLES À CALIBRER

Si les résultats ne sont pas réalistes, ajuster ces paramètres dans `default_longitudinal_params()` :

| Paramètre | Par défaut | Effet si augmenté |
|:--|:--|:--|
| `fatigue_sensitivity` | 0.5 | Plus de dommage cumulé → progression plus rapide |
| `remodeling_rate` | 0.5 | Remodelage osseux plus rapide → cunéiformisation adaptative |
| `disc_degeneration_rate` | 0.3 | Dégénérescence discale plus rapide → perte de hauteur |
| `growth_rate` | 6.0 cm/an | Croissance plus rapide → amplification par Hueter-Volkmann |
| `growth_peak_age` | 12.0 | Âge du pic pubertaire → influence le timing |

### Valeurs recommandées pour le calibrage

- **Si trop peu de scoliose se développe** : augmenter `fatigue_sensitivity` à 0.7, `remodeling_rate` à 0.7
- **Si trop de scoliose (contrôle aussi)** : diminuer `fatigue_sensitivity` à 0.3, vérifier que la charge n'est pas surestimée
- **Si la progression est trop lente** : augmenter `remodeling_rate` et `growth_rate`

---

## 5. INTERPRÉTATION ET PUBLICATION

### 5.1 Si la théorie est validée

Les implications sont majeures :
- **Étiologie** : la scoliose idiopathique a une cause mécanique simple (asymétrie initiale + flambage)
- **Dépistage** : chercher les micro-asymétries chez les pré-adolescents (scanner basse dose, EOS)
- **Prévention** : une correction précoce de l'asymétrie (orthèse ciblée) pourrait prévenir la scoliose
- **Prédiction** : le ratio de flambage pourrait devenir un biomarqueur prédictif

### 5.2 Limites du modèle

- Modèle FEM simplifié (poutres, pas de maillage 3D complet)
- Profil de charge identique pour tous les patients
- Pas de variabilité biologique (Monte-Carlo)
- Remodelage osseux simplifié (3 zones seulement)
- Pas de côtes (rôle stabilisateur important en thoracique)

### 5.3 Améliorations futures

1. **Ajouter les côtes** — elles rigidifient le rachis thoracique et changent le seuil de flambage
2. **Monte-Carlo** — varier aléatoirement les propriétés mécaniques pour étudier la variabilité
3. **Maillage 3D** — remplacer les poutres par un maillage tétraédrique
4. **Validation clinique** — comparer avec des données de suivi de patients scoliotiques (radiographies EOS annuelles)
5. **Muscles** — ajouter un modèle musculaire actif pour étudier l'effet du tonus

---

## 6. RÉSUMÉ DU PLAN

```
Semaine 1 : Phase 1 — Validation du modèle de base
            ├── Lancer le serveur
            ├── Créer/résoudre un rachis normal
            └── Test rapide simulation longitudinale (1 an)

Semaine 1 : Phase 2 — Étude comparative (9 configurations × 20 ans)
            ├── Lancer run_comparison_study()
            └── Sauvegarder les résultats JSON

Semaine 2 : Phase 3 — Simulations individuelles
            ├── Varier le niveau vertébral (T5, T8, T12, L3)
            ├── Varier l'âge de début (5, 10, 13, 25 ans)
            └── Varier le sexe (F, M)

Semaine 2-3 : Phase 4 — Analyse
            ├── Produire les graphiques
            ├── Évaluer les critères de validation
            └── Calibrer les paramètres si nécessaire

Semaine 3 : Rédaction des conclusions
```

---

## 7. COMMANDES RAPIDES (AIDE-MÉMOIRE)

```bash
# Démarrer le serveur
cd spinesim && docker compose up --build

# Test rapide (1 an, symétrique)
curl -s -X POST http://localhost:8080/api/longitudinal/run \
  -H "Content-Type: application/json" \
  -d '{"duration_years":1,"initial_age":10,"asymmetry_type":"none"}' | python -m json.tool

# Étude comparative complète
curl -s -X POST http://localhost:8080/api/longitudinal/comparison \
  -H "Content-Type: application/json" \
  -d '{"duration_years":20,"initial_age":10}' > resultats.json

# Simulation spécifique
curl -s -X POST http://localhost:8080/api/longitudinal/run \
  -H "Content-Type: application/json" \
  -d '{
    "duration_years":20,
    "initial_age":10,
    "sex":"F",
    "weight":35,
    "height":140,
    "asymmetry_type":"wedging",
    "asymmetry_level":"T8",
    "asymmetry_magnitude":2.0,
    "asymmetry_side":"right"
  }' | python -m json.tool
```
