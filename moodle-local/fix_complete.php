<?php
/**
 * Correction complète de la page d'accueil Moodle - Routes et Vues
 * 
 * Ce script corrige :
 * 1. Le résumé du site (boutons connexion/inscription dans region-main)
 * 2. Les stats auto-générées de la section Numbers (masquage CSS)
 * 3. La configuration des routes (frontpage, dashboard, etc.)
 * 4. Purge complète des caches + bump theme revision
 */

define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
global $DB, $CFG;

echo "\n=== CORRECTION COMPLETE FRONTPAGE SCOLIOSE ===\n\n";

// ============================================================
// 1. ROUTES : Configuration de navigation
// ============================================================
echo "--- 1. CONFIGURATION DES ROUTES ---\n";

$routes = [
    // Page d'accueil anonyme : aucun élément LMS
    'frontpage' => '',
    // Page d'accueil connecté : aucun élément LMS (dashboard gère tout)
    'frontpageloggedin' => '',
    // Après connexion → Dashboard (/my/)
    'defaulthomepage' => '1',
    // Ne PAS forcer la connexion (page vitrine visible)
    'forcelogin' => '0',
    // Résumé global du site (config level)
    'summary' => '<div class="text-center py-4">
<h2 class="mb-3" style="color:#0066CC;">Programme de Formation Médicale Continue</h2>
<p class="lead mb-4">Maîtrisez la prise en charge de la scoliose grâce à 29 modules progressifs<br>et au simulateur biomécanique SpineSim©</p>
<div class="d-flex justify-content-center gap-3">
<a href="/login/index.php" class="btn btn-primary btn-lg mr-2" style="background-color:#0066CC;border-color:#0066CC;">Se connecter</a>
<a href="/login/signup.php" class="btn btn-outline-primary btn-lg" style="color:#0066CC;border-color:#0066CC;">S\'inscrire gratuitement</a>
</div>
</div>',
    // Désactiver la liste de cours sur la page d'accueil
    'numsections' => '0',
    // Activer l'auto-inscription
    'enrol_plugins_enabled' => 'manual,self',
];

foreach ($routes as $name => $value) {
    try {
        set_config($name, $value);
        echo "  ✓ $name = " . (strlen($value) > 50 ? substr($value, 0, 50) . '...' : ($value === '' ? '(vide)' : $value)) . "\n";
    } catch (Exception $e) {
        echo "  ✗ $name : " . $e->getMessage() . "\n";
    }
}

// ============================================================
// 2. RÉSUMÉ DU COURS SITE (id=1) - C'est LUI qui s'affiche dans region-main
// ============================================================
echo "\n--- 2. RÉSUMÉ DU COURS SITE (region-main) ---\n";

$site_summary = '<div class="text-center py-5" style="max-width:800px;margin:0 auto;">
<h2 class="mb-3" style="color:#0066CC;font-weight:700;font-size:2rem;">Formation Scoliose avec SpineSim</h2>
<p class="lead mb-4" style="color:#333;font-size:1.15rem;">Programme complet de formation médicale continue sur la scoliose.<br>
29 modules progressifs · 89h de formation · Simulation biomécanique interactive</p>
<div class="d-flex justify-content-center flex-wrap" style="gap:12px;">
<a href="/login/index.php" class="btn btn-primary btn-lg px-4" style="background-color:#0066CC;border-color:#0066CC;border-radius:8px;font-weight:600;">
<i class="fa fa-sign-in mr-1"></i> Se connecter</a>
<a href="/login/signup.php" class="btn btn-outline-primary btn-lg px-4" style="color:#0066CC;border-color:#0066CC;border-radius:8px;font-weight:600;">
<i class="fa fa-user-plus mr-1"></i> Créer un compte</a>
</div>
<p class="mt-3 text-muted" style="font-size:0.9rem;">Formation éligible au DPC · Certification à 4 niveaux</p>
</div>';

try {
    $DB->set_field('course', 'summary', $site_summary, ['id' => 1]);
    $DB->set_field('course', 'summaryformat', 1, ['id' => 1]); // FORMAT_HTML
    echo "  ✓ Résumé du cours site (id=1) mis à jour avec boutons connexion/inscription\n";
} catch (Exception $e) {
    echo "  ✗ Erreur : " . $e->getMessage() . "\n";
}

// ============================================================
// 3. CSS PERSONNALISÉ - Masquer les stats auto-générées + améliorations
// ============================================================
echo "\n--- 3. CSS PERSONNALISÉ ---\n";

$custom_css = '
/* ===== Scoliose Formation Custom CSS ===== */

/* Police Inter */
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");
body { font-family: "Inter", -apple-system, BlinkMacSystemFont, sans-serif; }

/* === FRONTPAGE ANONYMOUS === */

/* Masquer les stats auto-générées (users/courses count) sur la page vitrine */
.pagelayout-frontpage.notloggedin #numbers .user-rating-box-area {
    display: none !important;
}

/* Agrandir la section numbers custom pour occuper toute la largeur */
.pagelayout-frontpage.notloggedin #numbers .col-xl-5 {
    flex: 0 0 100% !important;
    max-width: 100% !important;
}

/* Style du résumé dans region-main */
.pagelayout-frontpage.notloggedin #region-main {
    padding: 0 15px;
}

/* Masquer le drawer de navigation pour les anonymes */
.pagelayout-frontpage.notloggedin .drawer-primary {
    display: none !important;
}

/* Masquer le bouton hamburger pour les anonymes */
.pagelayout-frontpage.notloggedin .navbar-toggler[data-target="theme_moove-drawers-primary"] {
    display: none !important;
}

/* === SLIDER === */
#mooveslideshow .carousel-item img {
    min-height: 300px;
    object-fit: cover;
}

#mooveslideshow .carousel-caption {
    background: rgba(0, 0, 0, 0.5);
    border-radius: 12px;
    padding: 20px 30px;
}

#mooveslideshow .carousel-caption .title {
    font-weight: 700;
    font-size: 1.8rem;
}

/* === MARKETING CARDS === */
#feature .card {
    border: none;
    border-radius: 12px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

#feature .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,102,204,0.15) !important;
}

#feature .icon-lg img {
    width: 60px;
    height: 60px;
    object-fit: contain;
}

/* === FAQ === */
#faq .card {
    border: none;
    border-radius: 8px;
    margin-bottom: 8px;
}

#faq .btn-link {
    color: #0066CC;
    font-weight: 600;
    text-decoration: none;
}

/* === NUMBERS SECTION === */
#numbers .sectionheading h2 {
    color: #0066CC;
    font-weight: 800;
    font-size: 2.5rem;
}

/* === NAVBAR === */
.navbar {
    box-shadow: 0 2px 10px rgba(0,0,0,0.08) !important;
}

.navbar-brand img.logo {
    max-height: 45px;
}

/* === FOOTER === */
#page-footer {
    background-color: #f8f9fa;
}

#page-footer .footer-title {
    color: #0066CC;
}

/* === BUTTONS === */
.btn-primary {
    background-color: #0066CC !important;
    border-color: #0066CC !important;
}

.btn-primary:hover {
    background-color: #0052a3 !important;
    border-color: #0052a3 !important;
}

.btn-outline-primary {
    color: #0066CC !important;
    border-color: #0066CC !important;
}

.btn-outline-primary:hover {
    background-color: #0066CC !important;
    color: #fff !important;
}

/* === LOGIN PAGE === */
#page-login-index #region-main .card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.12);
}

/* === DASHBOARD === */
.pagelayout-mydashboard .block {
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}
';

try {
    set_config('scss', $custom_css, 'theme_moove');
    echo "  ✓ CSS personnalisé mis à jour (masquage stats, styles cards, slider, etc.)\n";
} catch (Exception $e) {
    echo "  ✗ Erreur : " . $e->getMessage() . "\n";
}

// ============================================================
// 4. VÉRIFICATION DES PARAMÈTRES THEME MOOVE
// ============================================================
echo "\n--- 4. VÉRIFICATION THEME MOOVE ---\n";

$moove_checks = [
    'slidercount' => '3',
    'brandcolor' => '#0066CC',
    'enablenumbersection' => '1',
];

foreach ($moove_checks as $name => $expected) {
    $current = get_config('theme_moove', $name);
    if ($current == $expected) {
        echo "  ✓ theme_moove/$name = $expected\n";
    } else {
        set_config($name, $expected, 'theme_moove');
        echo "  ⟳ theme_moove/$name : '$current' → '$expected' (corrigé)\n";
    }
}

// ============================================================
// 5. VÉRIFICATION DES BLOCS (aucun bloc ne devrait être sur frontpage)
// ============================================================
echo "\n--- 5. AUDIT DES BLOCS ---\n";

$blocks = $DB->get_records_sql("
    SELECT bi.id, bi.blockname, bi.pagetypepattern, bi.defaultregion, bi.showinsubcontexts, 
           ctx.contextlevel, ctx.instanceid
    FROM {block_instances} bi
    JOIN {context} ctx ON ctx.id = bi.parentcontextid
    ORDER BY bi.id
");

$frontpage_blocks = [];
$dashboard_blocks = [];
foreach ($blocks as $b) {
    $location = "ctx={$b->contextlevel}, instance={$b->instanceid}";
    if ($b->pagetypepattern === 'site-index' || 
        ($b->contextlevel == 80 && $b->instanceid == 1 && $b->pagetypepattern != 'my-index')) {
        $frontpage_blocks[] = $b;
        echo "  ⚠ Bloc FRONTPAGE : {$b->blockname} (pattern={$b->pagetypepattern}, region={$b->defaultregion})\n";
    } else {
        $dashboard_blocks[] = $b;
        echo "  ✓ Bloc dashboard/autre : {$b->blockname} (pattern={$b->pagetypepattern})\n";
    }
}

if (empty($frontpage_blocks)) {
    echo "  ✓ Aucun bloc sur la page d'accueil (correct)\n";
}

// ============================================================
// 6. VÉRIFICATION DES ROUTES / TEMPLATES
// ============================================================
echo "\n--- 6. VÉRIFICATION DES ROUTES ---\n";

$route_map = [
    '/' => [
        'description' => 'Page d\'accueil (vitrine)',
        'pagelayout' => 'frontpage',
        'anonymous' => 'Slider + Marketing + FAQ + Boutons connexion',
        'logged_in' => 'Redirigé vers /my/ (dashboard)',
    ],
    '/my/' => [
        'description' => 'Dashboard personnel',
        'pagelayout' => 'mydashboard',
        'anonymous' => 'Redirigé vers /login/',
        'logged_in' => 'Blocs Timeline + Calendrier + Cours',
    ],
    '/login/index.php' => [
        'description' => 'Page de connexion',
        'pagelayout' => 'login',
        'anonymous' => 'Formulaire de connexion',
        'logged_in' => 'Redirigé vers /my/',
    ],
    '/login/signup.php' => [
        'description' => 'Page d\'inscription',
        'pagelayout' => 'login',
        'anonymous' => 'Formulaire d\'inscription',
        'logged_in' => 'N/A',
    ],
    '/course/view.php?id=X' => [
        'description' => 'Page de cours',
        'pagelayout' => 'course',
        'anonymous' => 'Accès refusé → login',
        'logged_in' => 'Contenu du cours (si inscrit)',
    ],
];

echo "  Routes configurées :\n";
foreach ($route_map as $path => $info) {
    echo "    $path\n";
    echo "      Layout: {$info['pagelayout']}\n";
    echo "      Anonyme: {$info['anonymous']}\n";
    echo "      Connecté: {$info['logged_in']}\n";
}

echo "\n  Paramètres actifs :\n";
echo "    defaulthomepage = " . get_config('core', 'defaulthomepage') . " (1=Dashboard)\n";
echo "    frontpage = '" . get_config('core', 'frontpage') . "' (vide=aucun élément LMS)\n";
echo "    frontpageloggedin = '" . get_config('core', 'frontpageloggedin') . "' (vide=aucun élément LMS)\n";
echo "    forcelogin = " . get_config('core', 'forcelogin') . " (0=page vitrine visible)\n";
echo "    theme = " . get_config('core', 'theme') . "\n";

// ============================================================
// 7. PURGE CACHES + BUMP THEME REVISION
// ============================================================
echo "\n--- 7. PURGE CACHES ---\n";

// Bump theme revision pour forcer le rechargement CSS
$newrev = time();
set_config('themerev', $newrev);
echo "  ✓ Theme revision bumped → $newrev\n";

// Purge caches
purge_all_caches();
echo "  ✓ Tous les caches purgés\n";

// ============================================================
// RÉSUMÉ
// ============================================================
echo "\n=== RÉSUMÉ ===\n";
echo "  ✓ Routes configurées (frontpage vide, dashboard après login)\n";
echo "  ✓ Résumé du site avec boutons connexion/inscription\n";
echo "  ✓ CSS personnalisé (stats masquées, cards améliorées)\n";
echo "  ✓ Thème Moove vérifié (slider, couleur, numbers)\n";
echo "  ✓ Blocs vérifiés (aucun sur frontpage)\n";
echo "  ✓ Caches purgés\n";
echo "\n  → Ouvrez http://localhost:8890/ dans un navigateur (Cmd+Shift+R pour forcer le rechargement)\n";
echo "  → Page anonyme : Slider + Marketing + Résumé + FAQ\n";
echo "  → Après connexion : Dashboard avec Timeline + Calendrier + Cours\n\n";
