<?php
/**
 * ============================================================================
 *  IMPORT MODULE 1 — ANATOMIE DU RACHIS
 *  Formation Scoliose avec SpineSim© — Moodle 4.5
 * ============================================================================
 *
 *  Ce script crée un cours Moodle complet avec un formatage professionnel :
 *  - Design médical moderne (gradients, encadrés, icônes)
 *  - 28 marqueurs médias positionnés avec placeholders visuels
 *  - 5 sections pédagogiques complètes
 *  - Objectifs d'apprentissage, tableaux cliniques, points clés
 *  - Bibliographie avec 15 références
 *
 *  Usage :
 *    docker exec moodle-app php /var/www/html/import_module1.php
 *
 * ============================================================================
 */

define('CLI_SCRIPT', true);
require(__DIR__ . '/config.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/lib/modinfolib.php');
require_once($CFG->dirroot . '/mod/page/lib.php');
require_once($CFG->libdir . '/pagelib.php');
require_once($CFG->libdir . '/accesslib.php');

global $DB, $CFG;

// ============================================================================
//  STYLES CSS GLOBAUX — Design professionnel médical
// ============================================================================

$CSS = <<<'CSS'
<style>
/* ===== PALETTE DE COULEURS MÉDICALE ===== */
:root {
    --primary: #1E3A5F;
    --primary-light: #2C5282;
    --primary-dark: #1A2F4B;
    --accent: #F59E0B;
    --accent-light: #FCD34D;
    --success: #10B981;
    --danger: #EF4444;
    --warning: #F97316;
    --info: #3B82F6;
    --bg-light: #F8FAFC;
    --bg-card: #FFFFFF;
    --border: #E2E8F0;
    --text: #1E293B;
    --text-light: #64748B;
    --gradient-primary: linear-gradient(135deg, #1E3A5F 0%, #2C5282 100%);
    --gradient-accent: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
    --gradient-success: linear-gradient(135deg, #10B981 0%, #059669 100%);
    --gradient-hero: linear-gradient(135deg, #0F172A 0%, #1E3A5F 50%, #2C5282 100%);
}

/* ===== CONTENEUR PRINCIPAL ===== */
.scoliose-module {
    font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
    color: var(--text);
    line-height: 1.7;
    max-width: 960px;
    margin: 0 auto;
}

/* ===== HERO BANNER ===== */
.hero-banner {
    background: var(--gradient-hero);
    color: #fff;
    padding: 48px 40px;
    border-radius: 16px;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
}
.hero-banner::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 400px;
    height: 400px;
    border-radius: 50%;
    background: rgba(245, 158, 11, 0.08);
}
.hero-banner::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: rgba(59, 130, 246, 0.06);
}
.hero-banner .badge {
    display: inline-block;
    background: rgba(245, 158, 11, 0.2);
    color: var(--accent-light);
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 16px;
}
.hero-banner h1 {
    font-size: 36px;
    font-weight: 800;
    margin: 0 0 8px 0;
    letter-spacing: -0.5px;
}
.hero-banner .subtitle {
    font-size: 18px;
    opacity: 0.85;
    font-weight: 400;
    margin-bottom: 24px;
}
.hero-meta {
    display: flex;
    gap: 24px;
    flex-wrap: wrap;
    margin-top: 20px;
}
.hero-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    opacity: 0.9;
}
.hero-meta-item .icon {
    font-size: 18px;
}

/* ===== OBJECTIFS D'APPRENTISSAGE ===== */
.objectives-box {
    background: linear-gradient(135deg, #EFF6FF 0%, #F0FDF4 100%);
    border: 2px solid #BFDBFE;
    border-radius: 12px;
    padding: 32px;
    margin: 28px 0;
}
.objectives-box h3 {
    color: var(--primary);
    font-size: 20px;
    font-weight: 700;
    margin: 0 0 20px 0;
    display: flex;
    align-items: center;
    gap: 10px;
}
.objectives-box ol {
    margin: 0;
    padding-left: 20px;
}
.objectives-box li {
    margin-bottom: 12px;
    padding-left: 8px;
    line-height: 1.6;
}
.objectives-box li strong {
    color: var(--primary);
}
.bloom-tag {
    display: inline-block;
    background: var(--primary);
    color: #fff;
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 10px;
    margin-left: 6px;
    font-weight: 600;
    vertical-align: middle;
}

/* ===== SECTIONS ===== */
.section-header {
    background: var(--gradient-primary);
    color: #fff;
    padding: 24px 32px;
    border-radius: 12px 12px 0 0;
    margin-top: 40px;
}
.section-header h2 {
    margin: 0;
    font-size: 24px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 12px;
}
.section-header .section-number {
    background: rgba(255,255,255,0.2);
    padding: 4px 14px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
}
.section-body {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-top: none;
    border-radius: 0 0 12px 12px;
    padding: 32px;
    margin-bottom: 8px;
}

/* ===== SOUS-SECTIONS ===== */
.subsection {
    margin: 28px 0;
    padding-bottom: 24px;
    border-bottom: 1px solid #F1F5F9;
}
.subsection:last-child {
    border-bottom: none;
    padding-bottom: 0;
}
.subsection h3 {
    color: var(--primary);
    font-size: 20px;
    font-weight: 700;
    margin: 0 0 16px 0;
    padding-bottom: 8px;
    border-bottom: 3px solid var(--accent);
    display: inline-block;
}
.subsection h4 {
    color: var(--primary-light);
    font-size: 17px;
    font-weight: 600;
    margin: 20px 0 12px 0;
}

/* ===== TABLEAUX MÉDICAUX ===== */
.medical-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin: 20px 0;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    font-size: 14px;
}
.medical-table thead th {
    background: var(--primary);
    color: #fff;
    padding: 12px 16px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.medical-table tbody td {
    padding: 11px 16px;
    border-bottom: 1px solid #F1F5F9;
    vertical-align: top;
}
.medical-table tbody tr:nth-child(even) {
    background: #F8FAFC;
}
.medical-table tbody tr:hover {
    background: #EFF6FF;
}
.medical-table tbody tr:last-child td {
    border-bottom: none;
}

/* ===== MARQUEURS MÉDIAS (PLACEHOLDERS PROFESSIONNELS) ===== */
.media-placeholder {
    border-radius: 12px;
    padding: 28px 24px;
    margin: 24px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.media-placeholder::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    opacity: 0.04;
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23000000' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
/* Modèle 3D */
.media-3d {
    background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 100%);
    border: 2px solid #334155;
    color: #94A3B8;
}
.media-3d .media-icon { font-size: 48px; margin-bottom: 12px; }
.media-3d .media-title { color: #E2E8F0; font-size: 16px; font-weight: 700; }
.media-3d .media-desc { color: #94A3B8; font-size: 13px; margin-top: 6px; }
.media-3d .media-badge {
    display: inline-block; background: #3B82F6; color: #fff;
    padding: 4px 12px; border-radius: 20px; font-size: 11px;
    font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;
}
/* Animation vidéo */
.media-video {
    background: linear-gradient(135deg, #1E1B4B 0%, #312E81 100%);
    border: 2px solid #4338CA;
    color: #A5B4FC;
}
.media-video .media-icon { font-size: 48px; margin-bottom: 12px; }
.media-video .media-title { color: #E0E7FF; font-size: 16px; font-weight: 700; }
.media-video .media-desc { color: #A5B4FC; font-size: 13px; margin-top: 6px; }
.media-video .media-badge {
    display: inline-block; background: #7C3AED; color: #fff;
    padding: 4px 12px; border-radius: 20px; font-size: 11px;
    font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;
}
/* Schéma / Diagramme */
.media-schema {
    background: linear-gradient(135deg, #F0FDF4 0%, #ECFDF5 100%);
    border: 2px dashed #6EE7B7;
    color: #065F46;
}
.media-schema .media-icon { font-size: 48px; margin-bottom: 12px; }
.media-schema .media-title { color: #065F46; font-size: 16px; font-weight: 700; }
.media-schema .media-desc { color: #047857; font-size: 13px; margin-top: 6px; }
.media-schema .media-badge {
    display: inline-block; background: #10B981; color: #fff;
    padding: 4px 12px; border-radius: 20px; font-size: 11px;
    font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;
}
/* Infographie */
.media-infographic {
    background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
    border: 2px dashed #FCD34D;
    color: #78350F;
}
.media-infographic .media-icon { font-size: 48px; margin-bottom: 12px; }
.media-infographic .media-title { color: #78350F; font-size: 16px; font-weight: 700; }
.media-infographic .media-desc { color: #92400E; font-size: 13px; margin-top: 6px; }
.media-infographic .media-badge {
    display: inline-block; background: #F59E0B; color: #fff;
    padding: 4px 12px; border-radius: 20px; font-size: 11px;
    font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;
}

/* ===== ENCADRÉS CLINIQUES ===== */
.clinical-box {
    background: linear-gradient(135deg, #FFF7ED 0%, #FEF3C7 100%);
    border-left: 5px solid var(--warning);
    border-radius: 0 10px 10px 0;
    padding: 20px 24px;
    margin: 20px 0;
}
.clinical-box h4 {
    color: #C2410C;
    font-size: 15px;
    font-weight: 700;
    margin: 0 0 10px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.clinical-box p, .clinical-box ul {
    margin: 8px 0;
    font-size: 14px;
    color: #7C2D12;
}

/* ===== BOÎTE CRITIQUE / DANGER ===== */
.danger-box {
    background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
    border-left: 5px solid var(--danger);
    border-radius: 0 10px 10px 0;
    padding: 20px 24px;
    margin: 20px 0;
}
.danger-box h4 {
    color: #991B1B;
    font-size: 15px;
    font-weight: 700;
    margin: 0 0 10px 0;
}
.danger-box p, .danger-box ul {
    margin: 8px 0;
    font-size: 14px;
    color: #7F1D1D;
}

/* ===== BOÎTE INFO ===== */
.info-box {
    background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
    border-left: 5px solid var(--info);
    border-radius: 0 10px 10px 0;
    padding: 20px 24px;
    margin: 20px 0;
}
.info-box h4 {
    color: #1E40AF;
    font-size: 15px;
    font-weight: 700;
    margin: 0 0 10px 0;
}

/* ===== POINTS CLÉS ===== */
.key-points {
    background: var(--gradient-success);
    color: #fff;
    border-radius: 12px;
    padding: 32px;
    margin: 32px 0;
}
.key-points h3 {
    color: #fff;
    font-size: 20px;
    font-weight: 700;
    margin: 0 0 20px 0;
}
.key-points ol {
    margin: 0;
    padding-left: 20px;
}
.key-points li {
    margin-bottom: 12px;
    line-height: 1.6;
}

/* ===== BIBLIOGRAPHIE ===== */
.bibliography {
    background: #F8FAFC;
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 28px 32px;
    margin-top: 32px;
}
.bibliography h3 {
    color: var(--primary);
    font-size: 18px;
    font-weight: 700;
    margin: 0 0 16px 0;
}
.bibliography ol {
    margin: 0;
    padding-left: 20px;
    font-size: 13px;
    color: var(--text-light);
    line-height: 1.8;
}
.bibliography li {
    margin-bottom: 6px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .hero-banner { padding: 28px 20px; }
    .hero-banner h1 { font-size: 24px; }
    .hero-meta { flex-direction: column; gap: 8px; }
    .section-body { padding: 20px 16px; }
    .medical-table { font-size: 12px; }
    .medical-table thead th, .medical-table tbody td { padding: 8px 10px; }
}
</style>
CSS;

// ============================================================================
//  FONCTIONS HELPERS — Génération des marqueurs médias HTML
// ============================================================================

function media_3d($id, $title, $desc) {
    return <<<HTML
<div class="media-placeholder media-3d">
    <div class="media-badge">🧊 Modèle 3D Interactif</div>
    <div class="media-icon">🧊</div>
    <div class="media-title">{$title}</div>
    <div class="media-desc">{$desc}</div>
    <div style="margin-top:12px; font-size:11px; color:#64748B;">📌 {$id} — Produit avec BioDigital Human / Three.js</div>
</div>
HTML;
}

function media_video($id, $title, $desc) {
    return <<<HTML
<div class="media-placeholder media-video">
    <div class="media-badge">🎬 Animation Vidéo</div>
    <div class="media-icon">▶️</div>
    <div class="media-title">{$title}</div>
    <div class="media-desc">{$desc}</div>
    <div style="margin-top:12px; font-size:11px; color:#818CF8;">📌 {$id} — Produit avec Runway ML / After Effects</div>
</div>
HTML;
}

function media_schema($id, $title, $desc) {
    return <<<HTML
<div class="media-placeholder media-schema">
    <div class="media-badge">📐 Schéma Anatomique</div>
    <div class="media-icon">📐</div>
    <div class="media-title">{$title}</div>
    <div class="media-desc">{$desc}</div>
    <div style="margin-top:12px; font-size:11px; color:#059669;">📌 {$id} — Produit avec BioRender</div>
</div>
HTML;
}

function media_infographic($id, $title, $desc) {
    return <<<HTML
<div class="media-placeholder media-infographic">
    <div class="media-badge">📊 Infographie</div>
    <div class="media-icon">📊</div>
    <div class="media-title">{$title}</div>
    <div class="media-desc">{$desc}</div>
    <div style="margin-top:12px; font-size:11px; color:#B45309;">📌 {$id} — Produit avec BioRender / Canva Pro</div>
</div>
HTML;
}

// ============================================================================
//  CONTENU DES SECTIONS
// ============================================================================

// --- SECTION 0 : HERO + OBJECTIFS ---
$section0_intro = $CSS . <<<'HTML'
<div class="scoliose-module">

<!-- ===== HERO BANNER ===== -->
<div class="hero-banner">
    <div class="badge">Partie I — Fondamentaux et Sciences de Base</div>
    <h1>🦴 Module 1 — Anatomie du Rachis</h1>
    <div class="subtitle">Bases anatomiques indispensables pour comprendre la scoliose et sa prise en charge chirurgicale</div>
    <div class="hero-meta">
        <div class="hero-meta-item"><span class="icon">⏱️</span> Durée : 2h30</div>
        <div class="hero-meta-item"><span class="icon">📚</span> Niveau : Fondamental</div>
        <div class="hero-meta-item"><span class="icon">📋</span> Prérequis : Anatomie générale (PACES/PASS)</div>
        <div class="hero-meta-item"><span class="icon">🎯</span> 5 objectifs • 28 médias • 15 références</div>
    </div>
</div>

<!-- ===== OBJECTIFS D'APPRENTISSAGE ===== -->
<div class="objectives-box">
    <h3>🎯 Objectifs d'apprentissage</h3>
    <p style="color:#64748B; font-size:14px; margin:0 0 16px 0;">À l'issue de ce module, l'apprenant sera capable de :</p>
    <ol>
        <li><strong>Décrire</strong> les caractéristiques morphologiques distinctives des vertèbres cervicales, thoraciques, lombaires et du sacrum <span class="bloom-tag">Connaissance</span></li>
        <li><strong>Expliquer</strong> le concept d'unité fonctionnelle rachidienne et le rôle de chaque composant (disque, facettes, ligaments) dans la stabilité segmentaire <span class="bloom-tag">Compréhension</span></li>
        <li><strong>Identifier</strong> les muscles érecteurs du rachis, les transversaires épineux et les muscles abdominaux, et leur contribution à l'équilibre rachidien <span class="bloom-tag">Connaissance</span></li>
        <li><strong>Analyser</strong> la vascularisation médullaire et ses implications pour la chirurgie de la scoliose, en particulier le rôle de l'artère d'Adamkiewicz <span class="bloom-tag">Analyse</span></li>
        <li><strong>Évaluer</strong> un profil sagittal sur une radiographie en mesurant les courbures physiologiques et les paramètres pelviens (PI, SS, PT) <span class="bloom-tag">Application</span></li>
    </ol>
</div>

</div>
HTML;

// --- SECTION 1 : ANATOMIE DESCRIPTIVE ---
$section1 = $CSS . '<div class="scoliose-module">';

$section1 .= <<<'HTML'
<div class="section-header">
    <h2><span class="section-number">1.1</span> Anatomie descriptive du rachis</h2>
</div>
<div class="section-body">

<div class="subsection">
<h3>Vue d'ensemble</h3>

<p>Le rachis humain est constitué de <strong>33 vertèbres</strong> réparties en 5 segments :</p>

<table class="medical-table">
<thead><tr><th>Segment</th><th>Vertèbres</th><th>Nombre</th><th>Mobilité</th><th>Fonction principale</th></tr></thead>
<tbody>
<tr><td><strong>Cervical</strong></td><td>C1–C7</td><td>7</td><td>+++</td><td>Rotation, flexion/extension de la tête</td></tr>
<tr><td><strong>Thoracique</strong></td><td>T1–T12</td><td>12</td><td>+</td><td>Protection viscérale, articulation costale</td></tr>
<tr><td><strong>Lombaire</strong></td><td>L1–L5</td><td>5</td><td>++</td><td>Port de charge, flexion/extension du tronc</td></tr>
<tr><td><strong>Sacré</strong></td><td>S1–S5</td><td>5 (fusionnées)</td><td>–</td><td>Transmission poids au bassin</td></tr>
<tr><td><strong>Coccygien</strong></td><td>Co1–Co4</td><td>3-5 (fusionnées)</td><td>–</td><td>Insertion musculaire (plancher pelvien)</td></tr>
</tbody></table>
HTML;

$section1 .= media_3d('M01-S01-001',
    'Rachis complet interactif C1-Coccyx',
    'Modèle 3D rotatif 360° — Vue antérieure, postérieure et latérale avec courbures physiologiques et étiquetage des régions');

$section1 .= <<<'HTML'
<div class="info-box">
<h4>💡 Le saviez-vous ?</h4>
<p>La longueur totale du rachis représente environ <strong>35% de la taille corporelle</strong> (70-75 cm). Les courbures alternées (lordose-cyphose-lordose) confèrent au rachis une résistance aux contraintes axiales <strong>10 fois supérieure</strong> à celle d'une colonne droite (formule de Delmas : R = N² + 1 = 10).</p>
</div>
</div><!-- /subsection -->

<!-- CERVICALES -->
<div class="subsection">
<h3>Vertèbres cervicales (C1-C7)</h3>

<h4>Vertèbre cervicale typique (C3-C6)</h4>
<ul>
<li><strong>Corps vertébral</strong> : petit, rectangulaire en vue latérale, concave en supérieur (uncus)</li>
<li><strong>Processus unciformes</strong> : crêtes latérales formant les articulations unco-vertébrales (de Luschka)</li>
<li><strong>Foramen transversaire</strong> : traversé par l'artère vertébrale (C6→C1)</li>
<li><strong>Processus épineux</strong> : court et bifide (C3-C5)</li>
<li><strong>Canal rachidien</strong> : triangulaire, large (rapport canal/corps ≥ 1)</li>
<li><strong>Facettes articulaires</strong> : orientées à ~45° dans le plan frontal</li>
</ul>
HTML;

$section1 .= media_schema('M01-S01-002',
    'Vertèbre cervicale typique (C3-C6)',
    'Vue supérieure et latérale — corps, pédicules, lames, processus épineux bifide, foramen transversaire, uncus • Couleurs distinctes par structure');

$section1 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Paramètre</th><th>C3</th><th>C4</th><th>C5</th><th>C6</th></tr></thead>
<tbody>
<tr><td>Largeur du corps (mm)</td><td>15</td><td>16</td><td>17</td><td>19</td></tr>
<tr><td>Hauteur du corps ant. (mm)</td><td>13</td><td>12</td><td>12</td><td>13</td></tr>
<tr><td>Diamètre AP canal (mm)</td><td>14</td><td>14</td><td>13</td><td>13</td></tr>
<tr><td>Diamètre pédicule (mm)</td><td>5,5</td><td>5,8</td><td>6,0</td><td>6,2</td></tr>
</tbody></table>

<h4>Atlas (C1) et Axis (C2) — Vertèbres atypiques</h4>

<p><strong>Atlas (C1)</strong> — Anneau osseux sans corps vertébral :</p>
<ul>
<li><strong>Masses latérales</strong> : surfaces articulaires supérieures concaves (condyles occipitaux)</li>
<li><strong>Arc antérieur</strong> : fovea dentis (cavité pour la dent de l'axis)</li>
<li><strong>Arc postérieur</strong> : sillon de l'artère vertébrale (risque chirurgical)</li>
<li><strong>Ligament transverse</strong> : maintient la dent de l'axis, essentiel pour la stabilité C1-C2</li>
</ul>

<p><strong>Axis (C2)</strong> — Vertèbre pivot :</p>
<ul>
<li><strong>Processus odontoïde (dent)</strong> : pivot de la rotation axiale (~50% de la rotation cervicale totale)</li>
<li><strong>Pédicules</strong> : larges et robustes, permettant les vis pédiculaires de C2</li>
<li><strong>Pars interarticularis</strong> : site de fracture du pendu (hangman's fracture)</li>
</ul>
HTML;

$section1 .= media_video('M01-S01-003',
    'Atlas (C1) et Axis (C2) — Animation 3D',
    'Particularités anatomiques, processus odontoïde, articulation atlanto-axiale, mouvement de rotation • Rotation de tête superposée');

$section1 .= <<<'HTML'
<div class="clinical-box">
<h4>🏥 Pertinence clinique pour la scoliose</h4>
<p>Dans les scolioses cervicothoraciques sévères (neurofibromatose, scoliose syndromique), l'instrumentation peut remonter jusqu'en C2, voire C1. La connaissance de l'anatomie C1-C2 est indispensable pour la pose de vis <strong>(technique de Harms)</strong>.</p>
</div>
</div><!-- /subsection -->

<!-- THORACIQUES -->
<div class="subsection">
<h3>Vertèbres thoraciques (T1-T12)</h3>

<p>La vertèbre thoracique se caractérise par ses <strong>articulations costales</strong> :</p>
<ul>
<li><strong>Facettes costales corporéales</strong> : supérieure et inférieure (articulation costo-corporéale)</li>
<li><strong>Facette costale transversaire</strong> : sur le processus transverse (articulation costo-transversaire)</li>
<li><strong>Corps vertébral</strong> : en forme de cœur, taille croissante de T1 à T12</li>
<li><strong>Canal rachidien</strong> : circulaire, plus étroit — zone critique pour la moelle</li>
<li><strong>Processus épineux</strong> : long et oblique vers le bas</li>
<li><strong>Facettes articulaires</strong> : orientation quasi frontale (~60°), autorisant la rotation</li>
</ul>
HTML;

$section1 .= media_schema('M01-S01-004',
    'Vertèbre thoracique typique',
    'Vue supérieure, latérale et postérieure — facettes costales, canal rachidien, processus épineux incliné • Comparaison avec cervicale');

$section1 .= media_video('M01-S01-005',
    'Articulations costo-vertébrales et respiration',
    'Côte articulée avec le corps vertébral et le processus transverse — mouvements pump-handle et bucket-handle • Impact respiratoire');

$section1 .= <<<'HTML'
<div class="clinical-box">
<h4>🏥 Pertinence scoliose — Thorax</h4>
<ul>
<li>La cage thoracique rigidifie le rachis → scolioses thoraciques plus structurales</li>
<li>Déformation vertébrale → déformation costale → <strong>gibbosité</strong> (signe clinique majeur)</li>
<li>La thoracoplastie corrige la gibbosité résiduelle</li>
</ul>
</div>
</div><!-- /subsection -->

<!-- LOMBAIRES -->
<div class="subsection">
<h3>Vertèbres lombaires (L1-L5)</h3>

<p>Les vertèbres lombaires sont les plus volumineuses, adaptées au port de charge :</p>
<ul>
<li><strong>Corps vertébral</strong> : massif, réniforme, hauteur ~25-30 mm</li>
<li><strong>Pédicules</strong> : épais et courts — voie d'insertion des vis pédiculaires</li>
<li><strong>Canal rachidien</strong> : triangulaire, contient la queue de cheval</li>
<li><strong>Facettes articulaires</strong> : orientation sagittale — autorisent flexion/extension, limitent la rotation</li>
<li><strong>Isthme (pars interarticularis)</strong> : zone de faiblesse, siège du spondylolyse (L5)</li>
</ul>
HTML;

$section1 .= media_schema('M01-S01-006',
    'Vertèbre lombaire typique',
    'Vue supérieure et latérale — corps massif, pédicules épais, canal triangulaire, processus épineux court et horizontal • Dimensions annotées');

$section1 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Niveau</th><th>Ø transversal (mm)</th><th>Ø sagittal (mm)</th><th>Angle convergence</th></tr></thead>
<tbody>
<tr><td><strong>L1</strong></td><td>8,7 ± 1,8</td><td>15,0 ± 2,1</td><td>11°</td></tr>
<tr><td><strong>L2</strong></td><td>9,2 ± 1,6</td><td>15,3 ± 2,0</td><td>13°</td></tr>
<tr><td><strong>L3</strong></td><td>11,1 ± 2,1</td><td>15,8 ± 1,9</td><td>15°</td></tr>
<tr><td><strong>L4</strong></td><td>13,4 ± 2,3</td><td>16,0 ± 2,0</td><td>17°</td></tr>
<tr><td><strong>L5</strong></td><td>17,5 ± 2,7</td><td>15,5 ± 2,2</td><td>28°</td></tr>
</tbody></table>
<p style="font-size:12px; color:#94A3B8; text-align:right;">Source : Zindrick et al., JBJS 1987 ; Ebraheim et al., Spine 1996</p>
</div><!-- /subsection -->

<!-- SACRUM -->
<div class="subsection">
<h3>Sacrum et coccyx</h3>

<p><strong>Sacrum</strong> — 5 vertèbres fusionnées formant un os triangulaire :</p>
<ul>
<li><strong>Promontoire sacré</strong> : repère pour la mesure de la pente sacrée</li>
<li><strong>Foramens sacrés</strong> : passage des racines S1-S4</li>
<li><strong>Aileron sacré</strong> : articulation sacro-iliaque</li>
<li><strong>Canal sacré</strong> : se termine au hiatus sacré (S5)</li>
</ul>
HTML;

$section1 .= media_schema('M01-S01-007',
    'Sacrum et coccyx (3 vues)',
    'Vues antérieure et postérieure — foramens sacrés, crête sacrée, promontoire, ailes, articulation sacro-iliaque, hiatus sacré • Coupe sagittale médiane');

$section1 .= <<<'HTML'
<div class="clinical-box">
<h4>🏥 Fixation sacrée</h4>
<p>L'instrumentation sacrée (vis S1, vis S2-alar-iliac) est le maillon faible des montages longs : risque de pseudarthrose L5-S1 = <strong>24%</strong>.</p>
</div>
</div><!-- /subsection -->

<!-- COMPARAISON -->
<div class="subsection">
<h3>Comparaison synthétique</h3>
HTML;

$section1 .= media_infographic('M01-S01-008',
    'Tableau comparatif des vertèbres cervicales, thoraciques et lombaires',
    'Comparaison visuelle side-by-side : taille, forme, orientation des facettes, canal rachidien • Dessins annotés');

$section1 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Critère</th><th>Cervical (C3-C6)</th><th>Thoracique</th><th>Lombaire</th></tr></thead>
<tbody>
<tr><td><strong>Forme du corps</strong></td><td>Petite, rectangle</td><td>Cœur, moyenne</td><td>Réniforme, massive</td></tr>
<tr><td><strong>Canal rachidien</strong></td><td>Triangulaire, large</td><td>Circulaire, étroit</td><td>Triangulaire</td></tr>
<tr><td><strong>Processus épineux</strong></td><td>Court, bifide</td><td>Long, oblique ↓</td><td>Court, horizontal</td></tr>
<tr><td><strong>Facettes</strong></td><td>45°, flex/rotation</td><td>60°, rotation/flex lat.</td><td>90°, flex/extension</td></tr>
<tr><td><strong>Particularité</strong></td><td>Foramen transversaire</td><td>Facettes costales</td><td>Pédicules massifs</td></tr>
<tr><td><strong>Contenu canalaire</strong></td><td>Moelle cervicale</td><td>Moelle thoracique</td><td>Queue de cheval</td></tr>
</tbody></table>
</div><!-- /subsection -->

<!-- VARIATIONS -->
<div class="subsection">
<h3>Variations anatomiques normales</h3>
HTML;

$section1 .= media_schema('M01-S01-009',
    'Variations anatomiques normales',
    'Lombalisation S1, sacralisation L5, côte cervicale, spina bifida occulta • Illustrations annotées');

$section1 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Variation</th><th>Prévalence</th><th>Signification clinique</th></tr></thead>
<tbody>
<tr><td><strong>Lombalisation de S1</strong></td><td>4-8%</td><td>S1 non fusionné, 6ᵉ vertèbre « lombaire » — erreur de comptage</td></tr>
<tr><td><strong>Sacralisation de L5</strong></td><td>6-17%</td><td>L5 fusionnée au sacrum — modifie le niveau d'instrumentation</td></tr>
<tr><td><strong>Côte cervicale</strong></td><td>0,5-1%</td><td>Côte surnuméraire C7, syndrome du défilé thoracique</td></tr>
<tr><td><strong>Spina bifida occulta</strong></td><td>10-20%</td><td>Arc postérieur S1 non fusionné, découverte fortuite</td></tr>
<tr><td><strong>Bloc vertébral congénital</strong></td><td>0,5-1%</td><td>Fusion de 2 vertèbres, limitation mobilité</td></tr>
</tbody></table>

<div class="danger-box">
<h4>⚠️ Point critique — Sécurité chirurgicale</h4>
<p>Toujours vérifier le nombre de vertèbres (radiographie du rachis entier ou IRM) pour éviter les erreurs de niveau opératoire (<em>wrong level surgery</em>).</p>
</div>

</div><!-- /subsection -->
</div><!-- /section-body -->
</div><!-- /scoliose-module -->
HTML;

// --- SECTION 2 : ANATOMIE FONCTIONNELLE ---
$section2 = $CSS . '<div class="scoliose-module">';
$section2 .= <<<'HTML'
<div class="section-header">
    <h2><span class="section-number">1.2</span> Anatomie fonctionnelle</h2>
</div>
<div class="section-body">

<div class="subsection">
<h3>Unité fonctionnelle rachidienne (Segment mobile de Junghans)</h3>

<p>Le <strong>segment mobile</strong> est l'unité fonctionnelle élémentaire du rachis. Il comprend :</p>
<ul>
<li>Deux vertèbres adjacentes + le disque intervertébral</li>
<li>Deux articulations zygapophysaires (facettes)</li>
<li>Les ligaments et muscles segmentaires</li>
<li>Les structures nerveuses (racine, ganglion dorsal)</li>
</ul>
HTML;

$section2 .= media_video('M01-S02-001',
    'Segment mobile de Junghans — Animation 3D',
    '2 vertèbres adjacentes avec disque, facettes, ligaments — décomposition du mouvement dans les 3 plans • Highlight de chaque composant');

$section2 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Composant</th><th>Fonction</th><th>Port de charge</th></tr></thead>
<tbody>
<tr><td><strong>Pilier antérieur</strong></td><td>Port de charge</td><td>80%</td></tr>
<tr><td><strong>Pilier postérieur</strong></td><td>Guidage du mouvement</td><td>20%</td></tr>
<tr><td><strong>Structures passives</strong></td><td>Stabilité (ligaments)</td><td>—</td></tr>
<tr><td><strong>Structures actives</strong></td><td>Stabilité dynamique (muscles)</td><td>—</td></tr>
</tbody></table>

<div class="info-box">
<h4>📖 Concept de Panjabi (1992) — Trois sous-systèmes de stabilité</h4>
<p><strong>1. Passif</strong> (vertèbres, disques, ligaments) → opérationnel en fin d'amplitude<br>
<strong>2. Actif</strong> (muscles, tendons) → contrôle dans la zone neutre<br>
<strong>3. Neural</strong> (proprioception) → coordination<br><br>
La <strong>zone neutre</strong> est l'amplitude de mouvement où la résistance est minimale. En scoliose, elle s'élargit → instabilité.</p>
</div>
</div><!-- /subsection -->

<div class="subsection">
<h3>Disque intervertébral</h3>
HTML;

$section2 .= media_video('M01-S02-002',
    'Structure du disque intervertébral',
    'Animation en coupe : nucleus pulposus, annulus fibrosus, plateaux cartilagineux — distribution des charges • Zoom progressif macro→micro');

$section2 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Composant</th><th>Composition</th><th>Fonction</th></tr></thead>
<tbody>
<tr><td><strong>Nucleus pulposus</strong></td><td>Gel mucoïde : 70-90% eau, protéoglycanes, collagène type II</td><td>Résistance à la compression</td></tr>
<tr><td><strong>Annulus fibrosus</strong></td><td>15-25 lamelles concentriques, collagène type I ±30°</td><td>Résistance traction/torsion</td></tr>
<tr><td><strong>Plateaux cartilagineux</strong></td><td>Cartilage hyalin (~1 mm)</td><td>Interface métabolique (disque avasculaire)</td></tr>
</tbody></table>

<div class="clinical-box">
<h4>🏥 Disque et scoliose</h4>
<p>Dans la scoliose, le disque se déforme en <strong>coin</strong> (wedging) du côté concave. La pression asymétrique chronique entraîne une dégénérescence précoce du côté concave — moteur principal de la progression chez l'adulte.</p>
</div>
</div><!-- /subsection -->

<div class="subsection">
<h3>Articulations zygapophysaires (facettaires)</h3>
HTML;

$section2 .= media_schema('M01-S02-003',
    'Orientation des facettes articulaires par niveau',
    'Sagittale au lombaire, frontale au thoracique, oblique au cervical — 3 schémas côte à côte avec flèches de mouvement');

$section2 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Région</th><th>Plan d'orientation</th><th>Mouvement principal</th><th>Mouvement limité</th></tr></thead>
<tbody>
<tr><td><strong>Cervicale</strong></td><td>45° oblique</td><td>Flexion/extension + rotation couplée</td><td>—</td></tr>
<tr><td><strong>Thoracique</strong></td><td>~60° frontal</td><td>Rotation axiale</td><td>Flexion/extension</td></tr>
<tr><td><strong>Lombaire</strong></td><td>~90° sagittal</td><td>Flexion/extension</td><td>Rotation axiale</td></tr>
<tr><td><strong>T12-L1</strong></td><td>Transition</td><td>Zone de transition mécanique</td><td>—</td></tr>
</tbody></table>

<div class="info-box">
<h4>💡 Pourquoi la scoliose thoracique tourne ?</h4>
<p>L'orientation des facettes thoraciques (plan frontal) autorise la rotation vertébrale — la rotation est le mécanisme de la <strong>gibbosité</strong>.</p>
</div>
</div><!-- /subsection -->

<div class="subsection">
<h3>Système ligamentaire</h3>
HTML;

$section2 .= media_video('M01-S02-004',
    'Système ligamentaire rachidien — Animation séquentielle',
    'Vue sagittale médiane : LLA (vert), LLP (rouge), ligaments jaunes, inter-épineux, supra-épineux — apparition séquentielle avec noms');

$section2 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Ligament</th><th>Position</th><th>Fonction</th><th>Résistance (N)</th><th>Chirurgie</th></tr></thead>
<tbody>
<tr><td><strong>LLA</strong></td><td>Face antérieure</td><td>Limite extension</td><td>500-1000</td><td>Préservé (post.), sectionné (ALIF)</td></tr>
<tr><td><strong>LLP</strong></td><td>Face post. (canal)</td><td>Limite flexion</td><td>300-600</td><td>Non touché</td></tr>
<tr><td><strong>Lig. jaune</strong></td><td>Entre les lames</td><td>Flexion + posture</td><td>200-400</td><td>Retiré lors laminectomie</td></tr>
<tr><td><strong>Inter-épineux</strong></td><td>Entre épineuses</td><td>Limite flexion</td><td>50-150</td><td>Coupé abord post.</td></tr>
<tr><td><strong>Supra-épineux</strong></td><td>Apex épineuses</td><td>Limite flexion</td><td>100-200</td><td>Coupé abord post.</td></tr>
<tr><td><strong>Intertransversaire</strong></td><td>Entre transverses</td><td>Limite flex. lat.</td><td>50-100</td><td>Abords postérolat.</td></tr>
<tr><td><strong>Capsule facettaire</strong></td><td>Autour zygapophyses</td><td>Limite rotation</td><td>150-300</td><td>Résection = instabilité</td></tr>
</tbody></table>
</div><!-- /subsection -->

<div class="subsection">
<h3>Canal rachidien et foramens intervertébraux</h3>
HTML;

$section2 .= media_schema('M01-S02-005',
    'Canal rachidien et foramens intervertébraux',
    'Coupe axiale : canal rachidien, récessus latéraux, foramens avec racines nerveuses, pédicules, ligaments jaunes • Zones de sténose annotées');

$section2 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Niveau</th><th>Ø AP (mm)</th><th>Ø transversal (mm)</th><th>Forme</th><th>Contenu</th></tr></thead>
<tbody>
<tr><td><strong>Cervical</strong></td><td>14-20</td><td>23-27</td><td>Triangulaire large</td><td>Moelle cervicale</td></tr>
<tr><td><strong>Thoracique</strong></td><td>12-15</td><td>16-20</td><td>Circulaire</td><td>Moelle thoracique</td></tr>
<tr><td><strong>Lombaire</strong></td><td>15-18</td><td>22-27</td><td>Triangulaire</td><td>Queue de cheval</td></tr>
</tbody></table>

<div class="clinical-box">
<h4>🏥 Scoliose et foramens</h4>
<p>La déformation scoliotique rétrécit les foramens du côté concave → risque de <strong>radiculopathie</strong>, surtout dans les scolioses lombaires dégénératives de l'adulte.</p>
</div>

</div><!-- /subsection -->
</div><!-- /section-body -->
</div><!-- /scoliose-module -->
HTML;

// --- SECTION 3 : MUSCULATURE ---
$section3 = $CSS . '<div class="scoliose-module">';
$section3 .= <<<'HTML'
<div class="section-header">
    <h2><span class="section-number">1.3</span> Musculature rachidienne</h2>
</div>
<div class="section-body">

<div class="subsection">
<h3>Muscles érecteurs du rachis (Erector Spinae)</h3>
HTML;

$section3 .= media_3d('M01-S03-001',
    'Muscles du rachis — Modèle 3D à couches pelables',
    'Vue postérieure en couches interactives : plan superficiel (iliocostal), intermédiaire (longissimus), profond (épineux) — origines et insertions');

$section3 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Muscle</th><th>Position</th><th>Étendue</th><th>Action principale</th></tr></thead>
<tbody>
<tr><td><strong>Iliocostal</strong></td><td>Latéral</td><td>Crête iliaque → C4</td><td>Extension + flexion latérale</td></tr>
<tr><td><strong>Longissimus</strong></td><td>Intermédiaire</td><td>Sacrum → mastoïde</td><td>Extension + rotation ipsi</td></tr>
<tr><td><strong>Épineux</strong></td><td>Médial</td><td>L2 → T1</td><td>Extension pure</td></tr>
</tbody></table>
</div><!-- /subsection -->

<div class="subsection">
<h3>Muscles transversaires épineux (couche profonde)</h3>
HTML;

$section3 .= media_schema('M01-S03-002',
    'Muscles transversaires épineux',
    'Vue postérieure détaillée — multifides (2-4 niveaux), rotateurs courts/longs, semi-épineux — vectorisation des forces • Code couleur');

$section3 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Muscle</th><th>Niveaux enjambés</th><th>Maximum en</th><th>Action</th></tr></thead>
<tbody>
<tr><td><strong>Semi-épineux</strong></td><td>4-6</td><td>Thoracique/cervical</td><td>Extension + rotation contrôlat.</td></tr>
<tr><td><strong>Multifides</strong></td><td>2-4</td><td><strong>Lombaire</strong></td><td>Stabilisation segmentaire ★</td></tr>
<tr><td><strong>Rotateurs</strong></td><td>1-2</td><td>Thoracique</td><td>Rotation + proprioception</td></tr>
</tbody></table>

<div class="danger-box">
<h4>⚠️ Multifides et chirurgie — Enjeu majeur</h4>
<p>L'abord médian postérieur (Hibbs) décolle les multifides → <strong>dénervation, atrophie, fibrose</strong>. La technique de Wiltse (abord intermusculaire entre multifides et longissimus) préserve ces muscles. Le renforcement des multifides est un pilier de la rééducation postopératoire.</p>
</div>
</div><!-- /subsection -->

<div class="subsection">
<h3>Muscles abdominaux et équilibre sagittal</h3>
HTML;

$section3 .= media_video('M01-S03-003',
    'Rôle des muscles abdominaux dans l\'équilibre sagittal',
    'Caisson abdominal (grand droit, obliques, transverse) et action sur la lordose lombaire • Vue latérale + frontale');

$section3 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Muscle</th><th>Action rachidienne</th><th>Rôle stabilisateur</th></tr></thead>
<tbody>
<tr><td><strong>Droit de l'abdomen</strong></td><td>Flexion du tronc</td><td>Fléchisseur sagittal principal</td></tr>
<tr><td><strong>Oblique externe</strong></td><td>Flexion + rotation contrôlat.</td><td>Contrôle rotation</td></tr>
<tr><td><strong>Oblique interne</strong></td><td>Flexion + rotation ipsilat.</td><td>Stabilisation latérale</td></tr>
<tr><td><strong>Transverse</strong></td><td>↑ pression intra-abdominale</td><td><strong>Stabilisateur principal</strong> (feedforward)</td></tr>
</tbody></table>

<div class="info-box">
<h4>📖 Mécanisme de la pression intra-abdominale</h4>
<p>Le transverse et les obliques créent un « coussin hydraulique » antérieur au rachis qui décharge les disques lombaires de <strong>20-40%</strong> de la contrainte axiale (Hodges & Richardson, 1996).</p>
</div>
</div><!-- /subsection -->

<div class="subsection">
<h3>Psoas et carré des lombes</h3>
HTML;

$section3 .= media_schema('M01-S03-004',
    'Psoas major et carré des lombes',
    'Insertions, trajet, action — le plexus lombaire (L1-L4) chemine dans l\'épaisseur du psoas • Vue antérieure et latérale');

$section3 .= <<<'HTML'
<div class="clinical-box">
<h4>🏥 Psoas et scoliose</h4>
<ul>
<li>Le <strong>plexus lombaire</strong> (L1-L4) chemine dans le psoas → risque de lésion en chirurgie latérale (XLIF/OLIF)</li>
<li>La contracture du psoas du côté concave contribue à la raideur de la courbure lombaire</li>
</ul>
</div>
</div><!-- /subsection -->

<div class="subsection">
<h3>Muscles respiratoires et scoliose</h3>
HTML;

$section3 .= media_video('M01-S03-005',
    'Muscles respiratoires et impact de la scoliose',
    'Diaphragme, intercostaux — asymétrie des coupoles dans la scoliose thoracique • Inspiration/expiration comparée normal vs scoliose');

$section3 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Angle de Cobb thoracique</th><th>CVF (% prédite)</th><th>Dyspnée</th></tr></thead>
<tbody>
<tr><td>&lt; 40°</td><td>&gt; 80%</td><td>Rare</td></tr>
<tr><td>40-60°</td><td>60-80%</td><td>À l'effort</td></tr>
<tr><td>60-90°</td><td>40-60%</td><td>Au quotidien</td></tr>
<tr><td style="color:#EF4444; font-weight:700;">&gt; 90°</td><td style="color:#EF4444; font-weight:700;">&lt; 40%</td><td style="color:#EF4444; font-weight:700;">Insuffisance respiratoire restrictive</td></tr>
</tbody></table>
<p style="font-size:12px; color:#94A3B8; text-align:right;">Weinstein et al. (JAMA 2003) ; Pehrsson et al. (1992)</p>

</div><!-- /subsection -->
</div><!-- /section-body -->
</div><!-- /scoliose-module -->
HTML;

// --- SECTION 4 : NEUROANATOMIE ---
$section4 = $CSS . '<div class="scoliose-module">';
$section4 .= <<<'HTML'
<div class="section-header">
    <h2><span class="section-number">1.4</span> Neuroanatomie rachidienne</h2>
</div>
<div class="section-body">

<div class="subsection">
<h3>Moelle épinière : topographie et segments</h3>
HTML;

$section4 .= media_schema('M01-S04-001',
    'Topographie médullaire',
    'Cône médullaire (L1-L2), queue de cheval, renflements cervical et lombaire, filum terminale — décalage vertébro-médullaire avec overlay');

$section4 .= <<<'HTML'
<p>La moelle épinière : cordon nerveux de ~45 cm, du foramen magnum au <strong>cône terminal</strong> (L1-L2 adulte, L3 nouveau-né).</p>

<table class="medical-table">
<thead><tr><th>Vertèbre</th><th>Segment médullaire</th><th>Décalage</th></tr></thead>
<tbody>
<tr><td>C1-C4</td><td>C1-C4</td><td>±0</td></tr>
<tr><td>C5-C7</td><td>C5-C8</td><td>+1</td></tr>
<tr><td>T1-T6</td><td>T1-T6</td><td>±0 à +1</td></tr>
<tr><td>T7-T9</td><td>T7-T12</td><td>+2 à +3</td></tr>
<tr><td style="font-weight:700;">T10-T12</td><td style="font-weight:700;">L1-L5</td><td style="font-weight:700;">+3 à +5</td></tr>
<tr><td>T12-L1</td><td>S1-S5 + Coccygien</td><td>+5 à +7</td></tr>
</tbody></table>

<div class="danger-box">
<h4>⚠️ Implication chirurgicale majeure</h4>
<p>Une lésion médullaire au niveau de la <strong>vertèbre T10</strong> endommage les segments L1-L3 → déficit moteur aux membres inférieurs. Ce décalage est essentiel pour l'interprétation du monitoring IONM (Module 20).</p>
</div>
</div><!-- /subsection -->

<div class="subsection">
<h3>Racines nerveuses et plexus</h3>
HTML;

$section4 .= media_video('M01-S04-002',
    'Racines nerveuses et plexus — Animation',
    'Émergence des racines (antérieure motrice, postérieure sensitive), formation du nerf spinal, plexus cervical→sacré • Trajet en couleur');

$section4 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Plexus</th><th>Racines</th><th>Territoire</th><th>Risque chirurgical scoliose</th></tr></thead>
<tbody>
<tr><td><strong>Cervical</strong></td><td>C1-C4</td><td>Cou, diaphragme (C3-C5)</td><td>Rarement instrumenté</td></tr>
<tr><td><strong>Brachial</strong></td><td>C5-T1</td><td>Membre supérieur</td><td>Scoliose cervicothoracique</td></tr>
<tr><td style="color:#EF4444; font-weight:700;">Lombaire</td><td style="color:#EF4444;">L1-L4</td><td>Face ant. cuisse</td><td style="color:#EF4444;"><strong>XLIF/OLIF — nerf fémoral dans le psoas</strong></td></tr>
<tr><td><strong>Sacré</strong></td><td>L4-S3</td><td>Face post. MI, pied</td><td>Vis iliaques, fixation sacrée</td></tr>
<tr><td><strong>Pudendal</strong></td><td>S2-S4</td><td>Périnée, sphincters</td><td>Chirurgie sacrée basse</td></tr>
</tbody></table>

<div class="info-box">
<h4>📖 Dermatomes clés pour la scoliose</h4>
<p><strong>T4</strong> = mamelon • <strong>T10</strong> = ombilic • <strong>L3</strong> = genou ant. • <strong>L4</strong> = malléole int. • <strong>L5</strong> = hallux • <strong>S1</strong> = bord latéral du pied</p>
</div>
</div><!-- /subsection -->

<div class="subsection">
<h3>Système nerveux autonome rachidien</h3>
HTML;

$section4 .= media_schema('M01-S04-003',
    'Système nerveux autonome rachidien',
    'Chaîne sympathique paravertébrale, rameaux communicants, ganglions — positions par rapport au rachis • Vue antérieure');

$section4 .= <<<'HTML'
<div class="clinical-box">
<h4>🏥 Risques autonomes en chirurgie</h4>
<ul>
<li><strong>Plexus hypogastrique supérieur</strong> (L5-S1) : éjaculation rétrograde chez l'homme (1-5% en ALIF) — consentement éclairé obligatoire</li>
<li><strong>Syndrome de Claude-Bernard-Horner</strong> : ptosis, myosis, anhidrose (0,5-2% des abords antérieurs thoraciques hauts)</li>
</ul>
</div>
</div><!-- /subsection -->

<div class="subsection">
<h3>Vascularisation médullaire — Artère d'Adamkiewicz</h3>
HTML;

$section4 .= media_video('M01-S04-004',
    'Artère d\'Adamkiewicz — CRITIQUE chirurgie',
    'Artères radiculaires, artère spinale antérieure, Adamkiewicz (T9-T12 gauche 80%) — territoire vasculaire, conséquence de la lésion');

$section4 .= <<<'HTML'
<div class="danger-box">
<h4>⚠️ SECTION CRITIQUE — Sécurité chirurgicale</h4>
<p>La vascularisation médullaire est le déterminant majeur du risque neurologique en chirurgie rachidienne.</p>
</div>

<table class="medical-table">
<thead><tr><th>Caractéristique</th><th>Détail</th></tr></thead>
<tbody>
<tr><td><strong>Localisation</strong></td><td>T9-T12 dans 75% des cas (T8-L2 dans 90%)</td></tr>
<tr><td><strong>Côté</strong></td><td style="color:#EF4444; font-weight:700;">Gauche dans 80% des cas</td></tr>
<tr><td><strong>Morphologie</strong></td><td>Forme en « épingle à cheveux » à l'angiographie</td></tr>
<tr><td><strong>Diamètre</strong></td><td>0,8-1,2 mm</td></tr>
<tr><td><strong>Territoire</strong></td><td>Renflement lombaire (L1-S3) → contrôle moteur MI</td></tr>
<tr><td><strong>Si lésée</strong></td><td style="color:#EF4444;"><strong>Paraplégie + troubles sphinctériens</strong></td></tr>
</tbody></table>

<div class="info-box">
<h4>📖 Précautions chirurgicales (5 règles)</h4>
<p>1. Angio-IRM préopératoire dans les cas à risque<br>
2. Ligature des vaisseaux segmentaires le plus latéralement possible<br>
3. Monitoring IONM continu (PES + PEM + EMG ± D-waves)<br>
4. PAM ≥ 80 mmHg pendant les manœuvres de correction<br>
5. Protocole de sauvetage si chute des potentiels (Module 20)</p>
</div>

<p style="font-size:13px; color:#64748B;">Incidence des complications neurologiques : <strong>0,5-1,5%</strong> (Reames et al., Spine 2011 — SRS database, 19 360 cas).</p>

</div><!-- /subsection -->
</div><!-- /section-body -->
</div><!-- /scoliose-module -->
HTML;

// --- SECTION 5 : COURBURES ET ÉQUILIBRE SAGITTAL ---
$section5 = $CSS . '<div class="scoliose-module">';
$section5 .= <<<'HTML'
<div class="section-header">
    <h2><span class="section-number">1.5</span> Courbures physiologiques et équilibre sagittal</h2>
</div>
<div class="section-body">

<div class="subsection">
<h3>Les courbures dans le plan sagittal</h3>

<table class="medical-table">
<thead><tr><th>Courbure</th><th>Type</th><th>Valeurs normales</th><th>Apparition</th></tr></thead>
<tbody>
<tr><td><strong>Lordose cervicale</strong></td><td>Lordose</td><td>20-40° (C2-C7)</td><td>Tenue de tête (3-4 mois)</td></tr>
<tr><td><strong>Cyphose thoracique</strong></td><td>Cyphose</td><td>20-45° (T4-T12)</td><td>Primaire (in utero)</td></tr>
<tr><td><strong>Lordose lombaire</strong></td><td>Lordose</td><td>40-60° (L1-S1)</td><td>Station debout (12-18 mois)</td></tr>
<tr><td><strong>Cyphose sacrée</strong></td><td>Cyphose</td><td>Fixe</td><td>Primaire</td></tr>
</tbody></table>
HTML;

$section5 .= media_schema('M01-S05-001',
    'Courbures sagittales normales avec arcs de mesure',
    'Vue latérale du rachis entier — lordose cervicale (20-40°), cyphose thoracique (20-45°), lordose lombaire (40-60°) • Radiographie annotée à côté');

$section5 .= <<<'HTML'
</div><!-- /subsection -->

<div class="subsection">
<h3>Paramètres pelviens</h3>
HTML;

$section5 .= media_video('M01-S05-002',
    'Paramètres pelviens — PI = SS + PT',
    'Animation 3D du bassin : incidence pelvienne (PI), pente sacrée (SS), version pelvienne (PT) — lignes de mesure animées');

$section5 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Paramètre</th><th>Définition</th><th>Type</th><th>Valeur normale</th></tr></thead>
<tbody>
<tr><td><strong>PI (Incidence pelvienne)</strong></td><td>⊥ plateau sacré → centre têtes fémorales</td><td style="color:#3B82F6; font-weight:700;">Anatomique (constant)</td><td>45-65° (moy. 52°)</td></tr>
<tr><td><strong>SS (Pente sacrée)</strong></td><td>Plateau sacré ↔ horizontale</td><td>Positionnel</td><td>30-45°</td></tr>
<tr><td><strong>PT (Version pelvienne)</strong></td><td>Verticale ↔ droite milieu S1 → têtes fémorales</td><td>Positionnel</td><td>10-20°</td></tr>
</tbody></table>

<div class="info-box" style="background: linear-gradient(135deg, #FFF7ED 0%, #FFEDD5 100%); border-color: #F59E0B;">
<h4 style="color:#92400E;">🔑 Relation fondamentale : PI = SS + PT</h4>
<p style="color:#78350F;">Si la lordose diminue → SS ↓ → <strong>PT ↑</strong> (rétroversion pelvienne compensatrice).<br>
<strong>PT &gt; 25°</strong> = compensation excessive → fatigue → décompensation sagittale.</p>
</div>
</div><!-- /subsection -->

<div class="subsection">
<h3>Équilibre sagittal global</h3>
HTML;

$section5 .= media_schema('M01-S05-003',
    'Équilibre sagittal global',
    'Téléradiographie latérale annotée — C7 plumb line, SVA, ligne de gravité — patient compensé vs décompensé côte à côte');

$section5 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Paramètre</th><th>Valeur normale</th><th>Seuil pathologique</th></tr></thead>
<tbody>
<tr><td><strong>SVA</strong> (Sagittal Vertical Axis)</td><td>&lt; 50 mm</td><td style="color:#EF4444;">&gt; 50 mm → déséquilibre</td></tr>
<tr><td><strong>T1 Pelvic Angle</strong> (TPA)</td><td>&lt; 14°</td><td style="color:#EF4444;">&gt; 20° → significatif</td></tr>
<tr><td><strong>PI-LL</strong> (mismatch)</td><td>&lt; ±10°</td><td style="color:#EF4444;">&gt; 10° → mismatch</td></tr>
<tr><td><strong>PT</strong> (version pelvienne)</td><td>&lt; 20°</td><td style="color:#EF4444;">&gt; 25° → compensation excessive</td></tr>
</tbody></table>

<div class="danger-box">
<h4>⚠️ Objectifs chirurgicaux de Schwab (scoliose adulte)</h4>
<p><strong>SVA &lt; 50 mm</strong> • <strong>PT &lt; 25°</strong> • <strong>PI-LL &lt; ±10°</strong></p>
</div>
</div><!-- /subsection -->

<div class="subsection">
<h3>Mécanismes de compensation sagittale</h3>
HTML;

$section5 .= media_video('M01-S05-004',
    'Cascade compensatoire sagittale',
    'Rétroversion pelvienne → flexion des genoux → extension chevilles → hyperlordose cervicale → décompensation • Patient progressif');

$section5 .= <<<'HTML'
<table class="medical-table">
<thead><tr><th>Ordre</th><th>Mécanisme</th><th>Limite</th></tr></thead>
<tbody>
<tr><td>1️⃣</td><td>Rétroversion pelvienne (PT ↑)</td><td>PT &gt; 25° → fatigue</td></tr>
<tr><td>2️⃣</td><td>Flexion des genoux</td><td>Épuisant, altère la marche</td></tr>
<tr><td>3️⃣</td><td>Extension des chevilles</td><td>Instabilité, risque de chute</td></tr>
<tr><td>4️⃣</td><td>Hyperlordose cervicale</td><td>Cervicalgies, myélopathie</td></tr>
<tr><td style="color:#EF4444; font-weight:700;">5️⃣</td><td style="color:#EF4444; font-weight:700;">Aucun mécanisme restant</td><td style="color:#EF4444; font-weight:700;">Décompensation sagittale = handicap sévère</td></tr>
</tbody></table>

<div class="info-box">
<h4>📖 Cascade compensatoire de Barrey (2011)</h4>
<p>Concept fondamental en chirurgie de la scoliose de l'adulte : la restauration de la lordose lombaire est l'<strong>objectif primaire</strong> de la correction chirurgicale (Module 10).</p>
</div>

</div><!-- /subsection -->
</div><!-- /section-body -->
HTML;

// --- POINTS CLÉS + BIBLIOGRAPHIE ---
$section5 .= <<<'HTML'

<!-- ===== POINTS CLÉS ===== -->
<div class="key-points">
    <h3>✅ Points clés à retenir</h3>
    <ol>
        <li><strong>33 vertèbres</strong> en 5 segments avec courbures alternées → résistance mécanique ×10</li>
        <li>L'unité fonctionnelle de <strong>Junghans</strong> repose sur 3 sous-systèmes : passif, actif, neural (Panjabi)</li>
        <li>L'orientation des <strong>facettes thoraciques</strong> (plan frontal) explique la rotation vertébrale et la gibbosité</li>
        <li>Les <strong>multifides</strong> sont les stabilisateurs segmentaires les plus importants — dénervation chirurgicale = enjeu majeur</li>
        <li>L'<strong>artère d'Adamkiewicz</strong> (T9-T12, gauche 80%) — sa lésion cause une paraplégie</li>
        <li>L'équilibre sagittal se mesure par <strong>SVA, PI-LL, PT</strong> — objectifs de Schwab pour la correction</li>
        <li>La <strong>cascade compensatoire</strong> (rétroversion → flexion genoux → décompensation) explique la symptomatologie adulte</li>
    </ol>
</div>

<!-- ===== BIBLIOGRAPHIE ===== -->
<div class="bibliography">
    <h3>📚 Références bibliographiques</h3>
    <ol>
        <li>Panjabi MM. The stabilizing system of the spine. Part I. <em>J Spinal Disord.</em> 1992;5(4):383-389.</li>
        <li>White AA, Panjabi MM. <em>Clinical Biomechanics of the Spine.</em> 2nd ed. Lippincott; 1990.</li>
        <li>Nachemson AL. The lumbar spine: an orthopedic challenge. <em>Spine.</em> 1976;1(1):59-71.</li>
        <li>Wilke HJ et al. New in vivo measurements of pressures in the intervertebral disc. <em>Spine.</em> 1999;24(8):755-762.</li>
        <li>Zindrick MR et al. Analysis of the morphometric characteristics of pedicles. <em>Spine.</em> 1987;12(2):160-166.</li>
        <li>Ebraheim NA et al. Projection of the lumbar pedicle. <em>Spine.</em> 1996;21(11):1296-1300.</li>
        <li>Mannion AF et al. Paraspinal muscle fibre type alterations in scoliosis. <em>Eur Spine J.</em> 1998;7(4):289-293.</li>
        <li>Hodges PW, Richardson CA. Inefficient muscular stabilization of the lumbar spine. <em>Spine.</em> 1996;21(22):2640-2650.</li>
        <li>Duval-Beaupère G et al. A barycentremetric study of the sagittal shape. <em>Ann Biomed Eng.</em> 1992;20(4):451-462.</li>
        <li>Legaye J et al. Pelvic incidence: a fundamental pelvic parameter. <em>Eur Spine J.</em> 1998;7(2):99-103.</li>
        <li>Schwab F et al. Adult spinal deformity — postoperative standing imbalance. <em>Spine.</em> 2010;35(25):2224-2231.</li>
        <li>Reames DL et al. Complications in 19,360 cases of pediatric scoliosis. <em>Spine.</em> 2011;36(18):1484-1491.</li>
        <li>Barrey C et al. Compensatory mechanisms for sagittal balance. <em>Eur Spine J.</em> 2013;22(S6):S834-S841.</li>
        <li>Weinstein SL et al. Untreated idiopathic scoliosis: 50-year natural history. <em>JAMA.</em> 2003;289(5):559-567.</li>
        <li>Adamkiewicz A. Die Blutgefässe des menschlichen Rückenmarkes. <em>Sitzungsber Akad Wiss Wien.</em> 1882;85:101-130.</li>
    </ol>
</div>

<div style="text-align:center; margin-top:32px; padding:20px; color:#94A3B8; font-size:13px;">
    <p style="margin:4px 0;">Module 1 — Anatomie du Rachis — Formation Scoliose avec SpineSim©</p>
    <p style="margin:4px 0;">Durée : ~2h30 | Niveau : Fondamental | Partie I</p>
    <p style="margin:4px 0;">Version 1.0 — Février 2026</p>
</div>

</div><!-- /scoliose-module -->
HTML;

// ============================================================================
//  CRÉATION DU COURS DANS MOODLE
// ============================================================================

echo "============================================================\n";
echo " IMPORT MODULE 1 — ANATOMIE DU RACHIS\n";
echo " Formation Scoliose avec SpineSim©\n";
echo "============================================================\n\n";

// 1. Vérifier ou créer la catégorie
echo "1. Création de la catégorie de cours...\n";
$category = $DB->get_record('course_categories', ['name' => 'Formation Scoliose']);
if (!$category) {
    $category = new stdClass();
    $category->name = 'Formation Scoliose';
    $category->description = 'Formation complète et certifiante sur la scoliose avec SpineSim©';
    $category->parent = 0;
    $category->sortorder = 999;
    $category->visible = 1;
    $category->depth = 1;
    $category->path = '';

    require_once($CFG->libdir . '/coursecatlib.php');
    if (class_exists('core_course_category')) {
        $cat = core_course_category::create($category);
        $categoryid = $cat->id;
    } else {
        // Fallback
        $categoryid = $DB->insert_record('course_categories', $category);
        $DB->set_field('course_categories', 'path', '/' . $categoryid, ['id' => $categoryid]);
    }
    echo "   ✅ Catégorie 'Formation Scoliose' créée (ID: {$categoryid})\n";
} else {
    $categoryid = $category->id;
    echo "   ✅ Catégorie existante (ID: {$categoryid})\n";
}

// 2. Créer le cours
echo "2. Création du cours Module 1...\n";

$existingcourse = $DB->get_record('course', ['shortname' => 'SCOL-M01']);
if ($existingcourse) {
    echo "   ⚠️ Le cours SCOL-M01 existe déjà (ID: {$existingcourse->id}). Suppression...\n";
    require_once($CFG->dirroot . '/course/lib.php');
    delete_course($existingcourse, false);
    echo "   🗑️  Ancien cours supprimé.\n";
}

$coursedata = new stdClass();
$coursedata->fullname = '🦴 Module 1 — Anatomie du Rachis';
$coursedata->shortname = 'SCOL-M01';
$coursedata->category = $categoryid;
$coursedata->summary = '<div style="font-family: Inter, sans-serif; max-width: 600px;">
<h3 style="color:#1E3A5F;">Module 1 — Anatomie du Rachis</h3>
<p style="color:#64748B;">Bases anatomiques indispensables pour comprendre la scoliose et sa prise en charge chirurgicale.</p>
<ul style="color:#334155;">
<li>📐 Anatomie descriptive : cervicale, thoracique, lombaire, sacrum</li>
<li>🔧 Anatomie fonctionnelle : disque, facettes, ligaments</li>
<li>💪 Musculature : érecteurs, multifides, abdominaux</li>
<li>🧠 Neuroanatomie : moelle, plexus, artère d\'Adamkiewicz</li>
<li>📏 Équilibre sagittal : courbures, PI-SS-PT, SVA</li>
</ul>
<p><strong>Durée :</strong> 2h30 | <strong>Niveau :</strong> Fondamental | <strong>Médias :</strong> 28</p>
</div>';
$coursedata->summaryformat = FORMAT_HTML;
$coursedata->format = 'topics';
$coursedata->numsections = 7;
$coursedata->visible = 1;
$coursedata->lang = 'fr';
$coursedata->enablecompletion = 1;

$course = create_course($coursedata);
echo "   ✅ Cours créé : '{$course->fullname}' (ID: {$course->id})\n";

// 3. Configurer les sections du cours
echo "3. Configuration des sections...\n";

$sections_config = [
    0 => ['name' => '🎯 Présentation et objectifs', 'summary' => 'Introduction au Module 1, objectifs d\'apprentissage selon la taxonomie de Bloom'],
    1 => ['name' => '1.1 — Anatomie descriptive du rachis', 'summary' => 'Vertèbres cervicales, thoraciques, lombaires, sacrum — morphologie comparée'],
    2 => ['name' => '1.2 — Anatomie fonctionnelle', 'summary' => 'Segment mobile de Junghans, disque intervertébral, facettes, ligaments, canal rachidien'],
    3 => ['name' => '1.3 — Musculature rachidienne', 'summary' => 'Érecteurs du rachis, transversaires épineux, abdominaux, psoas, muscles respiratoires'],
    4 => ['name' => '1.4 — Neuroanatomie rachidienne', 'summary' => 'Moelle épinière, racines nerveuses, plexus, système autonome, artère d\'Adamkiewicz'],
    5 => ['name' => '1.5 — Courbures et équilibre sagittal', 'summary' => 'Courbures physiologiques, paramètres pelviens (PI, SS, PT), SVA, cascade compensatoire'],
    6 => ['name' => '📝 Auto-évaluation', 'summary' => 'Quiz d\'autoévaluation (à venir)'],
    7 => ['name' => '📚 Ressources complémentaires', 'summary' => 'Bibliographie, liens, documents à télécharger'],
];

foreach ($sections_config as $sectionnum => $config) {
    $section = $DB->get_record('course_sections', [
        'course' => $course->id,
        'section' => $sectionnum
    ]);
    if ($section) {
        $section->name = $config['name'];
        $section->summary = $config['summary'];
        $section->summaryformat = FORMAT_HTML;
        $section->visible = 1;
        $DB->update_record('course_sections', $section);
    }
}
echo "   ✅ 8 sections configurées\n";

// 4. Ajouter les pages de contenu
echo "4. Ajout du contenu pédagogique (5 pages + intro)...\n";

$pages = [
    ['section' => 0, 'name' => '🎯 Présentation et objectifs — Module 1', 'content' => $section0_intro],
    ['section' => 1, 'name' => '1.1 — Anatomie descriptive du rachis', 'content' => $section1],
    ['section' => 2, 'name' => '1.2 — Anatomie fonctionnelle', 'content' => $section2],
    ['section' => 3, 'name' => '1.3 — Musculature rachidienne', 'content' => $section3],
    ['section' => 4, 'name' => '1.4 — Neuroanatomie rachidienne', 'content' => $section4],
    ['section' => 5, 'name' => '1.5 — Courbures et équilibre sagittal', 'content' => $section5],
];

foreach ($pages as $i => $pagedata) {
    $section = $DB->get_record('course_sections', [
        'course' => $course->id,
        'section' => $pagedata['section']
    ]);

    if (!$section) {
        echo "   ⚠️ Section {$pagedata['section']} introuvable, skip.\n";
        continue;
    }

    // Créer le module 'page'
    $module = $DB->get_record('modules', ['name' => 'page']);
    if (!$module) {
        echo "   ❌ Module 'page' non trouvé dans Moodle. Assurez-vous que le plugin page est installé.\n";
        continue;
    }

    // Insérer la page
    $page = new stdClass();
    $page->course = $course->id;
    $page->name = $pagedata['name'];
    $page->intro = '';
    $page->introformat = FORMAT_HTML;
    $page->content = $pagedata['content'];
    $page->contentformat = FORMAT_HTML;
    $page->display = 5; // RESOURCELIB_DISPLAY_OPEN
    $page->timemodified = time();

    $page->id = $DB->insert_record('page', $page);

    // Insérer le course_module
    $cm = new stdClass();
    $cm->course = $course->id;
    $cm->module = $module->id;
    $cm->instance = $page->id;
    $cm->section = $section->id;
    $cm->visible = 1;
    $cm->added = time();

    $cm->id = $DB->insert_record('course_modules', $cm);

    // Ajouter à la séquence de la section
    $section->sequence = trim($section->sequence . ',' . $cm->id, ',');
    $DB->update_record('course_sections', $section);

    // Ajouter au contexte
    $context = context_module::instance($cm->id);

    $sectionLabel = $pagedata['section'];
    echo "   ✅ Page créée : Section {$sectionLabel} — {$pagedata['name']} (ID: {$page->id})\n";
}

// 5. Purger les caches
echo "\n5. Purge des caches Moodle...\n";
purge_all_caches();
echo "   ✅ Caches purgées\n";

// 6. Résumé
echo "\n============================================================\n";
echo " ✅ IMPORT TERMINÉ AVEC SUCCÈS\n";
echo "============================================================\n";
echo " Cours    : {$course->fullname}\n";
echo " ID       : {$course->id}\n";
echo " Sections : 8 (intro + 5 contenus + quiz + ressources)\n";
echo " Pages    : 6 pages de contenu riche\n";
echo " Médias   : 28 marqueurs placés (placeholders professionnels)\n";
echo " URL      : http://localhost:8890/course/view.php?id={$course->id}\n";
echo "============================================================\n";
echo "\n🌐 Ouvrez http://localhost:8890 dans votre navigateur\n";
echo "   Identifiant : admin\n";
echo "   Mot de passe : ScolioseLMS2026\n\n";
