<?php
/**
 * Correction définitive : désactivation du compte invité + CSS
 * 
 * Problème : "Vous êtes connecté anonymement" sur la page visiteur
 * Cause : Moodle connecte automatiquement les visiteurs en tant que "guest"
 *         sur la page d'accueil même avec autologinguests=0
 * Solution : Désactiver complètement le bouton guest + l'accès guest au site
 */

define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
global $DB, $CFG;

echo "\n=== CORRECTION GUEST + CSS ===\n\n";

// ============================================================
// 1. DÉSACTIVER COMPLÈTEMENT L'ACCÈS INVITÉ
// ============================================================
echo "--- 1. DÉSACTIVATION ACCÈS INVITÉ ---\n";

// Désactiver le bouton "Se connecter en tant qu'invité" sur la page de login
set_config('guestloginbutton', 0);
echo "  ✓ guestloginbutton = 0 (plus de bouton invité sur /login/)\n";

// Désactiver l'auto-login en tant qu'invité
set_config('autologinguests', 0);
echo "  ✓ autologinguests = 0\n";

// Désactiver l'accès invité au dashboard
set_config('allowguestmymoodle', 0);
echo "  ✓ allowguestmymoodle = 0\n";

// Retirer l'inscription invité du cours site (id=1)
// Le plugin enrol_guest permet aux invités d'accéder au cours site
$enrol_guests = $DB->get_records('enrol', ['courseid' => 1, 'enrol' => 'guest']);
foreach ($enrol_guests as $eg) {
    $DB->set_field('enrol', 'status', 1, ['id' => $eg->id]); // 1 = désactivé
    echo "  ✓ enrol_guest (id={$eg->id}) désactivé pour le cours site\n";
}

// Vérifier s'il n'y a pas d'autres enrol guest actifs
$all_guest_enrol = $DB->get_records('enrol', ['enrol' => 'guest', 'status' => 0]);
foreach ($all_guest_enrol as $ge) {
    $DB->set_field('enrol', 'status', 1, ['id' => $ge->id]);
    echo "  ✓ enrol_guest (id={$ge->id}, course={$ge->courseid}) désactivé\n";
}

if (empty($enrol_guests) && empty($all_guest_enrol)) {
    echo "  ✓ Aucun enrol_guest actif trouvé\n";
}

echo "\n  Résultat : les visiteurs non connectés verront la page vitrine\n";
echo "  avec un lien 'Connexion' (pas 'Vous êtes connecté anonymement')\n";

// ============================================================
// 2. CSS PERSONNALISÉ (sans @import qui casse la compilation SCSS)
// ============================================================
echo "\n--- 2. CSS PERSONNALISÉ ---\n";

// Le champ 'scss' de Moove est compilé SCSS → CSS
// @import url() en CSS pur cause des erreurs de compilation silencieuses
// Solution : utiliser uniquement du SCSS/CSS valide, pas de @import
$custom_scss = '
/* ===== Scoliose Formation - CSS Custom ===== */

/* === FRONTPAGE ANONYMOUS === */

/* Masquer les stats auto-générées (users/courses count) */
.pagelayout-frontpage.notloggedin #numbers .user-rating-box-area {
    display: none !important;
}

/* Occuper toute la largeur pour les chiffres custom */
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

set_config('scss', $custom_scss, 'theme_moove');
echo "  ✓ SCSS personnalisé mis à jour (sans @import)\n";

// ============================================================
// 3. PURGE CACHES + BUMP THEME REVISION
// ============================================================
echo "\n--- 3. PURGE CACHES ---\n";

$newrev = time();
set_config('themerev', $newrev);
echo "  ✓ Theme revision → $newrev\n";

// Aussi bumper jsrev et templaterev pour être sûr
set_config('jsrev', $newrev);
set_config('templaterev', $newrev);
echo "  ✓ JS + Template revision → $newrev\n";

purge_all_caches();
echo "  ✓ Tous les caches purgés\n";

// ============================================================
// 4. VÉRIFICATION
// ============================================================
echo "\n--- 4. VÉRIFICATION ---\n";
echo "  guestloginbutton = " . get_config('core', 'guestloginbutton') . "\n";
echo "  autologinguests = " . get_config('core', 'autologinguests') . "\n";
echo "  allowguestmymoodle = " . get_config('core', 'allowguestmymoodle') . "\n";

$guest_enrol_active = $DB->count_records('enrol', ['enrol' => 'guest', 'status' => 0]);
echo "  enrol_guest actifs = $guest_enrol_active\n";

echo "\n=== TERMINÉ ===\n";
echo "  → Fermez votre navigateur complètement (Cmd+Q)\n";
echo "  → Rouvrez-le et allez sur http://localhost:8890/\n";
echo "  → Vous devriez voir 'Connexion' au lieu de 'Vous êtes connecté anonymement'\n\n";
