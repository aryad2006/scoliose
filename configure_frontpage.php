<?php
/**
 * VERTEX© — Configure la page d'accueil pour afficher les cours
 */
define('CLI_SCRIPT', true);
require(__DIR__ . '/config.php');

// Constantes Moodle :
// 0 = actualités, 1 = cours inscrits, 2 = liste des cours, 3 = catégories, 4 = combo
// Valeur '2' = liste des cours
set_config('frontpage', '2');           // non connecté : liste des cours
set_config('frontpageloggedin', '1,2'); // connecté : cours inscrits + liste des cours

echo "[OK] frontpage = 2 (liste des cours)\n";
echo "[OK] frontpageloggedin = 1,2 (cours inscrits + liste)\n";

// Nombre de cours à afficher sur la page d'accueil
set_config('frontpagecourselimit', 20);
echo "[OK] frontpagecourselimit = 20\n";

// Résumé de la page d'accueil
$summary = '<div style="text-align:center;padding:24px 20px 10px;font-family:\'Segoe UI\',Arial,sans-serif;">
<h2 style="color:#1565C0;font-size:1.6em;margin-bottom:8px;">⚕️ VERTEX© — Formations Médicales en Ligne</h2>
<p style="color:#555;font-size:1em;max-width:680px;margin:0 auto 0;">
Formations continues pour praticiens confirmés · Chirurgie · Endocrinologie · Médecine Interne · AMP
</p>
</div>';

$site = $DB->get_record('course', ['id' => 1]);
$site->summary = $summary;
$site->summaryformat = FORMAT_HTML;
$DB->update_record('course', $site);
echo "[OK] Résumé mis à jour\n";

purge_all_caches();
echo "[OK] Cache vidé\n";
echo "\n=== Terminé — vérifier https://doctraining.ma/ ===\n";
