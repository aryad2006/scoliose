<?php
/**
 * Generer et uploader les icones marketing pour Moove
 */
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
require_once($CFG->libdir . '/filelib.php');

$fs = get_file_storage();
$syscontext = context_system::instance();

function create_marketing_icon($filename, $bg_r, $bg_g, $bg_b, $symbol) {
    $size = 200;
    $img = imagecreatetruecolor($size, $size);
    imagesavealpha($img, true);
    $transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
    imagefill($img, 0, 0, $transparent);
    
    // Cercle de fond
    $bg = imagecolorallocate($img, $bg_r, $bg_g, $bg_b);
    $bg_light = imagecolorallocate($img, min(255, $bg_r + 40), min(255, $bg_g + 40), min(255, $bg_b + 40));
    imagefilledellipse($img, $size/2, $size/2, $size - 10, $size - 10, $bg);
    imagefilledellipse($img, $size/2, $size/2, $size - 30, $size - 30, $bg_light);
    
    $white = imagecolorallocate($img, 255, 255, 255);
    
    switch ($symbol) {
        case 'book': // 29 Modules
            // Livre ouvert
            imagefilledrectangle($img, 55, 55, 95, 145, $white);
            imagefilledrectangle($img, 105, 55, 145, 145, $white);
            // Reliure
            $dark = imagecolorallocate($img, $bg_r, $bg_g, $bg_b);
            imagefilledrectangle($img, 96, 50, 104, 150, $dark);
            // Lignes de texte
            $gray = imagecolorallocate($img, 180, 180, 180);
            for ($i = 0; $i < 5; $i++) {
                imageline($img, 62, 70 + $i * 14, 88, 70 + $i * 14, $gray);
                imageline($img, 112, 70 + $i * 14, 138, 70 + $i * 14, $gray);
            }
            break;
            
        case 'sim': // SpineSim
            // Ecran
            imagefilledrectangle($img, 45, 45, 155, 115, $white);
            $dark = imagecolorallocate($img, $bg_r, $bg_g, $bg_b);
            imagefilledrectangle($img, 50, 50, 150, 110, $dark);
            // Pied
            imagefilledrectangle($img, 85, 115, 115, 130, $white);
            imagefilledrectangle($img, 70, 130, 130, 138, $white);
            // Colonne dans l'ecran
            $green = imagecolorallocate($img, 0, 255, 150);
            for ($i = 0; $i < 5; $i++) {
                $y = 58 + $i * 10;
                $offset = (int)(sin(($i - 2) * 0.6) * 6);
                imagefilledrectangle($img, 95 + $offset, $y, 105 + $offset, $y + 7, $green);
            }
            break;
            
        case 'cert': // Certification
            // Certificat
            imagefilledrectangle($img, 50, 45, 150, 130, $white);
            // Bordure decorative
            $gold = imagecolorallocate($img, 218, 165, 32);
            imagerectangle($img, 55, 50, 145, 125, $gold);
            imagerectangle($img, 58, 53, 142, 122, $gold);
            // Lignes de texte
            $gray = imagecolorallocate($img, 180, 180, 180);
            imageline($img, 70, 70, 130, 70, $gray);
            imageline($img, 75, 82, 125, 82, $gray);
            imageline($img, 80, 94, 120, 94, $gray);
            // Sceau
            imagefilledellipse($img, 130, 115, 30, 30, $gold);
            imagefilledellipse($img, 130, 115, 20, 20, imagecolorallocate($img, 255, 215, 0));
            // Ruban
            imageline($img, 122, 128, 115, 145, imagecolorallocate($img, 200, 0, 0));
            imageline($img, 138, 128, 145, 145, imagecolorallocate($img, 200, 0, 0));
            break;
            
        case 'users': // Communaute
            // 3 personnages
            $positions = [70, 100, 130];
            foreach ($positions as $idx => $px) {
                $py = ($idx == 1) ? 65 : 75;
                imagefilledellipse($img, $px, $py, 22, 22, $white);
                imagefilledellipse($img, $px, $py + 30, 30, 28, $white);
            }
            break;
    }
    
    imagepng($img, $filename);
    imagedestroy($img);
}

echo "=== GENERATION DES ICONES MARKETING ===" . PHP_EOL;

// Generer les 4 icones
create_marketing_icon('/tmp/icon_modules.png', 0, 102, 204, 'book');
echo "[OK] Icone 1: Modules" . PHP_EOL;

create_marketing_icon('/tmp/icon_spinesim.png', 0, 153, 136, 'sim');
echo "[OK] Icone 2: SpineSim" . PHP_EOL;

create_marketing_icon('/tmp/icon_cert.png', 153, 102, 0, 'cert');
echo "[OK] Icone 3: Certification" . PHP_EOL;

create_marketing_icon('/tmp/icon_community.png', 102, 51, 153, 'users');
echo "[OK] Icone 4: Communaute" . PHP_EOL;

// Upload dans Moove
echo PHP_EOL . "=== UPLOAD DANS MOOVE ===" . PHP_EOL;

$icons = [
    ['setting' => 'marketing1icon', 'file' => '/tmp/icon_modules.png', 'name' => 'icon_modules.png'],
    ['setting' => 'marketing2icon', 'file' => '/tmp/icon_spinesim.png', 'name' => 'icon_spinesim.png'],
    ['setting' => 'marketing3icon', 'file' => '/tmp/icon_cert.png', 'name' => 'icon_certification.png'],
    ['setting' => 'marketing4icon', 'file' => '/tmp/icon_community.png', 'name' => 'icon_community.png'],
];

foreach ($icons as $i => $icon) {
    // Supprimer l'ancien
    $existing = $fs->get_area_files($syscontext->id, 'theme_moove', $icon['setting'], 0, 'id', false);
    foreach ($existing as $file) {
        $file->delete();
    }
    
    $filerecord = new stdClass();
    $filerecord->contextid = $syscontext->id;
    $filerecord->component = 'theme_moove';
    $filerecord->filearea = $icon['setting'];
    $filerecord->itemid = 0;
    $filerecord->filepath = '/';
    $filerecord->filename = $icon['name'];
    $filerecord->mimetype = 'image/png';
    
    $fs->create_file_from_pathname($filerecord, $icon['file']);
    set_config($icon['setting'], '/' . $icon['name'], 'theme_moove');
    echo "[OK] " . $icon['setting'] . " uploade" . PHP_EOL;
}

// Purger le cache
theme_reset_all_caches();
echo PHP_EOL . "=== ICONES UPLOADEES - Cache purge ===" . PHP_EOL;
