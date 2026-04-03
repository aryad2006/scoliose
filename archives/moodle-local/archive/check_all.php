<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');

echo "=== INVENTAIRE COMPLET MOODLE ===" . PHP_EOL . PHP_EOL;

// Version
echo "Version: " . get_config('', 'release') . PHP_EOL;
echo "DB: " . $CFG->dbtype . PHP_EOL;
echo "Langue: " . get_config('', 'lang') . PHP_EOL;
echo "Fuseau: " . get_config('', 'timezone') . PHP_EOL;
echo "Pays: " . get_config('', 'country') . PHP_EOL . PHP_EOL;

// Fonctionnalites natives
echo "=== FONCTIONNALITES NATIVES ===" . PHP_EOL;
$features = [
    'enablecontentbank' => 'Content Bank (H5P)',
    'enablebadges' => 'Badges',
    'enablecompletion' => 'Suivi achevement',
    'enablecompetencies' => 'Competences',
    'enableanalytics' => 'Analytics',
    'enableavailability' => 'Acces conditionnel',
    'enablewebservices' => 'Web Services (REST/LTI)',
    'enablemobilewebservice' => 'Services mobiles',
    'enableportfolios' => 'Portfolios',
    'enableplagiarism' => 'Detection plagiat',
    'enablenotifications' => 'Notifications',
    'enableblogs' => 'Blogs',
    'enablerssfeeds' => 'RSS',
    'messaging' => 'Messagerie',
];
foreach ($features as $key => $label) {
    $val = get_config('', $key);
    echo ($val ? '[ON] ' : '[OFF]') . " $label" . PHP_EOL;
}

echo PHP_EOL . "=== PLUGINS TIERS INSTALLES ===" . PHP_EOL;
$plugins = [
    '/var/www/html/mod/hvp' => 'mod_hvp (H5P Interactive Content)',
    '/var/www/html/mod/customcert' => 'mod_customcert (Certificats)',
    '/var/www/html/mod/attendance' => 'mod_attendance (Presences)',
    '/var/www/html/blocks/completion_progress' => 'block_completion_progress (Barre de progression)',
    '/var/www/html/admin/tool/log/store/xapi' => 'logstore_xapi (xAPI/Tin Can)',
];
foreach ($plugins as $path => $label) {
    echo (is_dir($path) ? '[OK] ' : '[--]') . " $label" . PHP_EOL;
}

echo PHP_EOL . "=== MODULES NATIFS ACTIFS ===" . PHP_EOL;
$mods = ['quiz', 'lesson', 'forum', 'glossary', 'workshop', 'wiki', 'feedback',
         'scorm', 'h5pactivity', 'lti', 'assign', 'book', 'page', 'url', 'label',
         'resource', 'choice', 'data', 'survey', 'chat', 'bigbluebuttonbn'];
foreach ($mods as $mod) {
    $rec = $DB->get_record('modules', ['name' => $mod]);
    if ($rec) {
        echo ($rec->visible ? '[ON] ' : '[OFF]') . " mod_$mod" . PHP_EOL;
    }
}

echo PHP_EOL . "=== SECURITE ===" . PHP_EOL;
echo "Mot de passe min: " . get_config('', 'minpasswordlength') . " chars" . PHP_EOL;
echo "Upload max: " . (get_config('', 'maxbytes') / 1048576) . " MB" . PHP_EOL;

echo PHP_EOL . "=== TOUT EST PRET ===" . PHP_EOL;
