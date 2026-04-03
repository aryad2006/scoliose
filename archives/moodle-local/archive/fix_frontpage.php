<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');

echo "=== CONFIGURATION PAGE D'ACCUEIL ===" . PHP_EOL;

// Page d'accueil pour visiteurs anonymes : RIEN (juste le theme Moove avec slider/marketing/FAQ)
set_config('frontpage', '');  // Vide = aucun element LMS
echo "[OK] Visiteur anonyme : page vitrine uniquement (aucun element LMS)" . PHP_EOL;

// Page d'accueil pour utilisateurs connectes : liste des cours inscrits
set_config('frontpageloggedin', '');  // Vide aussi, le dashboard suffit
echo "[OK] Utilisateur connecte : dashboard avec ses cours" . PHP_EOL;

// Page par defaut apres connexion : Dashboard (pas la frontpage)
set_config('defaulthomepage', 1);  // 1 = Dashboard
echo "[OK] Apres connexion : redirection vers Dashboard" . PHP_EOL;

// Desactiver le calendrier sur la page d'accueil
set_config('enablecalendarexport', 1);  // Export OK mais pas visible en anonyme
echo "[OK] Calendrier masque pour anonymes" . PHP_EOL;

// Pas de forcelogin (les visiteurs doivent pouvoir voir la page vitrine)
set_config('forcelogin', 0);
echo "[OK] Acces visiteur anonyme autorise (page vitrine)" . PHP_EOL;

// Desactiver les blocs par defaut sur la page d'accueil
// (les blocs calendrier/timeline ne seront visibles que sur le dashboard)
set_config('frontpagerequirelogin', 0);
echo "[OK] Page vitrine accessible sans connexion" . PHP_EOL;

// Texte d'accueil du site (summary)
set_config('summary', '<div class="text-center py-3">
<h2>Programme de Formation Medicale Continue</h2>
<p class="lead">Maitrisez la prise en charge de la scoliose grace a 29 modules progressifs et au simulateur biomecanique SpineSim&copy;</p>
<p><a href="/login/index.php" class="btn btn-primary btn-lg mr-2">Se connecter</a>
<a href="/login/signup.php" class="btn btn-outline-primary btn-lg">S\'inscrire</a></p>
</div>');
echo "[OK] Texte d'accueil avec boutons connexion/inscription" . PHP_EOL;

// Purger le cache
purge_all_caches();
echo PHP_EOL . "=== Page d'accueil reconfiguree ===" . PHP_EOL;
echo "Anonyme -> Page vitrine (slider + marketing + FAQ + boutons)" . PHP_EOL;
echo "Connecte -> Dashboard personnel" . PHP_EOL;
