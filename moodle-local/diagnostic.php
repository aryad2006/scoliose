<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
require_once($CFG->libdir . '/filelib.php');

echo "=== DIAGNOSTIC COMPLET ===\n\n";

// 1. Vérifier les fichiers du slider
$fs = get_file_storage();
$context = context_system::instance();

for ($i = 1; $i <= 3; $i++) {
    $files = $fs->get_area_files($context->id, 'theme_moove', 'sliderimage'.$i, 0, 'id', false);
    if (empty($files)) {
        echo "Slider $i: AUCUN FICHIER!\n";
    } else {
        foreach ($files as $f) {
            echo "Slider $i: {$f->get_filename()} taille={$f->get_filesize()} mime={$f->get_mimetype()}\n";
        }
    }
}

// 2. Vérifier le logo
$files = $fs->get_area_files($context->id, 'theme_moove', 'logo', 0, 'id', false);
foreach ($files as $f) {
    echo "Logo: {$f->get_filename()} taille={$f->get_filesize()}\n";
}

// 3. Vérifier les icones marketing
for ($i = 1; $i <= 4; $i++) {
    $files = $fs->get_area_files($context->id, 'theme_moove', 'marketing'.$i.'icon', 0, 'id', false);
    if (empty($files)) {
        echo "Marketing icon $i: AUCUN FICHIER!\n";
    } else {
        foreach ($files as $f) {
            echo "Marketing icon $i: {$f->get_filename()} taille={$f->get_filesize()}\n";
        }
    }
}

// 4. Config critique
echo "\n=== CONFIG ===\n";
$keys = ['frontpage', 'frontpageloggedin', 'defaulthomepage', 'forcelogin', 'guestloginbutton', 'autologinguests'];
foreach ($keys as $k) {
    $v = get_config('core', $k);
    echo "$k = '$v'\n";
}

// 5. Theme Moove settings
echo "\n=== THEME MOOVE ===\n";
$moove_keys = ['slidercount', 'brandcolor', 'marketingheading', 'marketingcontent',
    'marketing1heading', 'marketing2heading', 'marketing3heading', 'marketing4heading',
    'slidertitle1', 'slidertitle2', 'slidertitle3',
    'numbersfrontpage', 'faqcount', 'enablefooterinfo'];
foreach ($moove_keys as $k) {
    $v = get_config('theme_moove', $k);
    echo "$k = '$v'\n";
}

// 6. Vérifier le thème actif
echo "\ntheme = '" . get_config('core', 'theme') . "'\n";

// 7. Vérifier le résumé du site
$site = get_site();
echo "\nSite summary: " . substr(strip_tags($site->summary), 0, 200) . "\n";

// 8. Vérifier index.php patch
$indexphp = file_get_contents('/var/www/html/index.php');
if (strpos($indexphp, 'require_course_login($SITE, false)') !== false) {
    echo "\nindex.php patch: OK (autologinguest=false)\n";
} else {
    echo "\nindex.php patch: MANQUANT!\n";
}

echo "\n=== FIN DIAGNOSTIC ===\n";
