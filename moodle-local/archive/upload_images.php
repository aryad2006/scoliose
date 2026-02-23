<?php
/**
 * Upload des images dans les settings du theme Moove
 */
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
require_once($CFG->libdir . '/filelib.php');

$fs = get_file_storage();
$syscontext = context_system::instance();

/**
 * Upload un fichier dans les settings d'un theme
 */
function upload_theme_file($fs, $syscontext, $setting, $filepath, $filename, $mimetype) {
    // Supprimer l'ancien fichier s'il existe
    $existing = $fs->get_area_files($syscontext->id, 'theme_moove', $setting, 0, 'id', false);
    foreach ($existing as $file) {
        $file->delete();
    }
    
    $filerecord = new stdClass();
    $filerecord->contextid = $syscontext->id;
    $filerecord->component = 'theme_moove';
    $filerecord->filearea = $setting;
    $filerecord->itemid = 0;
    $filerecord->filepath = '/';
    $filerecord->filename = $filename;
    $filerecord->mimetype = $mimetype;
    
    $file = $fs->create_file_from_pathname($filerecord, $filepath);
    
    // Mettre a jour le setting avec le chemin du fichier
    set_config($setting, '/' . $filename, 'theme_moove');
    
    return $file;
}

echo "=== UPLOAD DES IMAGES DANS MOOVE ===" . PHP_EOL;

// 1. Logo
echo "[1/5] Upload logo..." . PHP_EOL;
upload_theme_file($fs, $syscontext, 'logo', '/tmp/moodle_logo.png', 'scoliose_logo.png', 'image/png');
echo "  [OK] Logo" . PHP_EOL;

// 2. Favicon
echo "[2/5] Upload favicon..." . PHP_EOL;
upload_theme_file($fs, $syscontext, 'favicon', '/tmp/moodle_favicon.png', 'scoliose_favicon.png', 'image/png');
echo "  [OK] Favicon" . PHP_EOL;

// 3. Slide 1
echo "[3/5] Upload slide 1..." . PHP_EOL;
upload_theme_file($fs, $syscontext, 'sliderimage1', '/tmp/slide1.jpg', 'slide_formation.jpg', 'image/jpeg');
echo "  [OK] Slide 1" . PHP_EOL;

// 4. Slide 2
echo "[4/5] Upload slide 2..." . PHP_EOL;
upload_theme_file($fs, $syscontext, 'sliderimage2', '/tmp/slide2.jpg', 'slide_spinesim.jpg', 'image/jpeg');
echo "  [OK] Slide 2" . PHP_EOL;

// 5. Slide 3
echo "[5/5] Upload slide 3..." . PHP_EOL;
upload_theme_file($fs, $syscontext, 'sliderimage3', '/tmp/slide3.jpg', 'slide_certification.jpg', 'image/jpeg');
echo "  [OK] Slide 3" . PHP_EOL;

// 6. Image de fond de la page de login
echo "[BONUS] Upload login background..." . PHP_EOL;
upload_theme_file($fs, $syscontext, 'loginbgimg', '/tmp/slide1.jpg', 'login_bg.jpg', 'image/jpeg');
echo "  [OK] Login background" . PHP_EOL;

// Purger le cache du theme
theme_reset_all_caches();
echo PHP_EOL . "=== IMAGES UPLOADEES - Cache theme purge ===" . PHP_EOL;
echo "Ouvrez http://localhost:8890 pour voir le resultat" . PHP_EOL;
