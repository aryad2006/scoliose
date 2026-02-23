<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');

echo "=== ACTIVATION DES FONCTIONNALITES NATIVES MOODLE ===" . PHP_EOL;

// 1. Content Bank et H5P
set_config('enablecontentbank', 1);
echo "[OK] Content Bank active" . PHP_EOL;

// 2. Badges
set_config('enablebadges', 1);
echo "[OK] Badges actives" . PHP_EOL;

// 3. Suivi d'achievement (completion tracking)
set_config('enablecompletion', 1);
echo "[OK] Suivi d achevement active" . PHP_EOL;

// 4. Competences
set_config('enablecompetencies', 1);
echo "[OK] Competences activees" . PHP_EOL;

// 5. Analytics
set_config('enableanalytics', 1);
echo "[OK] Analytics actives" . PHP_EOL;

// 6. Acces conditionnel
set_config('enableavailability', 1);
echo "[OK] Acces conditionnel active" . PHP_EOL;

// 7. Portfolios
set_config('enableportfolios', 1);
echo "[OK] Portfolios actives" . PHP_EOL;

// 8. Detection plagiat
set_config('enableplagiarism', 1);
echo "[OK] Detection plagiat activee" . PHP_EOL;

// 9. Web services (API REST / mobile / LTI)
set_config('enablewebservices', 1);
echo "[OK] Web services actives" . PHP_EOL;

// 10. Mobile web services
set_config('enablemobilewebservice', 1);
echo "[OK] Services mobiles actives" . PHP_EOL;

// 11. Inscription par email
set_config('registerauth', 'email');
echo "[OK] Inscription par email activee" . PHP_EOL;

// 12. SCORM
set_config('displaycoursestructure', 1, 'scorm');
echo "[OK] SCORM configure" . PHP_EOL;

// 13. Upload max 500MB
set_config('maxbytes', 524288000);
echo "[OK] Upload max: 500MB" . PHP_EOL;

// 14. Notifications
set_config('enablenotifications', 1);
echo "[OK] Notifications activees" . PHP_EOL;

// 15. Blogs
set_config('enableblogs', 1);
echo "[OK] Blogs actives" . PHP_EOL;

// 16. RSS
set_config('enablerssfeeds', 1);
echo "[OK] RSS active" . PHP_EOL;

// 17. Export calendrier
set_config('enablecalendarexport', 1);
echo "[OK] Export calendrier active" . PHP_EOL;

// 18. Securite - Politique mots de passe
set_config('minpasswordlength', 12);
set_config('minpassworddigits', 1);
set_config('minpasswordlower', 1);
set_config('minpasswordupper', 1);
set_config('minpasswordnonalphanum', 1);
echo "[OK] Politique mots de passe renforcee (12 char min)" . PHP_EOL;

// 19. Format de cours par defaut : Topics
set_config('format', 'topics', 'moodlecourse');
echo "[OK] Format de cours par defaut : Topics" . PHP_EOL;

// 20. Theme Boost
set_config('theme', 'boost');
echo "[OK] Theme Boost active" . PHP_EOL;

// 21. Filtres multimedia HTML5
set_config('filter_mediaplugin_enable_html5video', 1, 'filter_mediaplugin');
set_config('filter_mediaplugin_enable_html5audio', 1, 'filter_mediaplugin');
echo "[OK] Filtres multimedia HTML5 actives" . PHP_EOL;

// 22. Activer self-enrolment et manual enrolment
$DB->set_field('enrol_plugins', 'visible', 1, array('name' => 'self'));
echo "[OK] Auto-inscription activee" . PHP_EOL;

// 23. Nombre max de modules dans la navigation
set_config('navcourselimit', 50);
echo "[OK] Navigation : 50 cours max" . PHP_EOL;

// 24. Activer le messaging
set_config('messaging', 1);
echo "[OK] Messagerie activee" . PHP_EOL;

// 25. Activer la recycle bin
set_config('coursebinenable', 1, 'tool_recyclebin');
set_config('categorybinenable', 1, 'tool_recyclebin');
echo "[OK] Corbeille activee" . PHP_EOL;

// 26. Activer LTI
set_config('mod_lti_enabled', 1);
echo "[OK] LTI active (pour SpineSim futur)" . PHP_EOL;

// Purger tous les caches
purge_all_caches();
echo PHP_EOL . "=== CONFIGURATION TERMINEE - Cache purge ===" . PHP_EOL;
