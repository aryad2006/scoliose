<?php
/**
 * VERTEX© — Configure la page d'accueil pour afficher les cours
 */
define('CLI_SCRIPT', true);
require(__DIR__ . '/config.php');

// Afficher la liste des cours sur la page d'accueil
set_config('frontpage', 'courselist');
set_config('frontpageloggedin', 'courselist');

// Titre et résumé de la page d'accueil
$summary = '<div style="text-align:center;padding:30px 20px;font-family:\'Segoe UI\',Arial,sans-serif;">
<h2 style="color:#1565C0;font-size:1.8em;margin-bottom:10px;">⚕️ VERTEX© — Formations Médicales en Ligne</h2>
<p style="color:#555;font-size:1.05em;max-width:700px;margin:0 auto;">
Formations continues pour praticiens confirmés · Chirurgie · Endocrinologie · Médecine Interne · AMP
</p>
</div>';

$site = $DB->get_record('course', ['id' => 1]);
$site->summary = $summary;
$site->summaryformat = FORMAT_HTML;
$DB->update_record('course', $site);

echo "[OK] Résumé page d'accueil mis à jour\n";
echo "[OK] Affichage : liste des cours\n";

purge_all_caches();
echo "[OK] Cache vidé\n";
echo "\n=== Page d'accueil configurée ===\n";
echo "Vérifier : https://doctraining.ma/\n";
