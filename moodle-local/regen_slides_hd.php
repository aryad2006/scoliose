<?php
/**
 * Régénération des images du slider en haute résolution (Retina)
 * 2400x1000 pixels, qualité 95, dégradés nets
 */

define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
require_once($CFG->libdir . '/filelib.php');
global $DB, $CFG;

echo "\n=== REGENERATION IMAGES SLIDER HD ===\n\n";

$width = 2400;
$height = 1000;

// Données des 3 slides
$slides = [
    1 => [
        'file' => 'slide_formation.jpg',
        'color1' => [0, 60, 120],      // Bleu nuit
        'color2' => [0, 102, 204],      // Bleu médical
        'color3' => [0, 150, 255],      // Bleu clair
        'accent' => [255, 255, 255],
    ],
    2 => [
        'file' => 'slide_spinesim.jpg',
        'color1' => [0, 80, 80],        // Teal foncé
        'color2' => [0, 128, 128],      // Teal
        'color3' => [0, 200, 180],      // Turquoise
        'accent' => [255, 255, 255],
    ],
    3 => [
        'file' => 'slide_certification.jpg',
        'color1' => [40, 0, 80],        // Violet foncé
        'color2' => [80, 0, 160],       // Violet
        'color3' => [120, 60, 200],     // Violet clair
        'accent' => [255, 255, 255],
    ],
];

foreach ($slides as $num => $slide) {
    echo "Slide $num ({$slide['file']})...\n";
    
    $img = imagecreatetruecolor($width, $height);
    imagealphablending($img, true);
    
    // --- Dégradé de fond en 3 zones (plus riche) ---
    for ($y = 0; $y < $height; $y++) {
        $ratio = $y / $height;
        if ($ratio < 0.5) {
            $r2 = $ratio * 2;
            $r = (int)($slide['color1'][0] * (1 - $r2) + $slide['color2'][0] * $r2);
            $g = (int)($slide['color1'][1] * (1 - $r2) + $slide['color2'][1] * $r2);
            $b = (int)($slide['color1'][2] * (1 - $r2) + $slide['color2'][2] * $r2);
        } else {
            $r2 = ($ratio - 0.5) * 2;
            $r = (int)($slide['color2'][0] * (1 - $r2) + $slide['color3'][0] * $r2);
            $g = (int)($slide['color2'][1] * (1 - $r2) + $slide['color3'][1] * $r2);
            $b = (int)($slide['color2'][2] * (1 - $r2) + $slide['color3'][2] * $r2);
        }
        $color = imagecolorallocate($img, $r, $g, $b);
        imageline($img, 0, $y, $width - 1, $y, $color);
    }
    
    // --- Motif géométrique subtil (grille de points) ---
    $dotColor = imagecolorallocatealpha($img, 255, 255, 255, 115); // très transparent
    for ($x = 0; $x < $width; $x += 60) {
        for ($y = 0; $y < $height; $y += 60) {
            imagefilledellipse($img, $x, $y, 4, 4, $dotColor);
        }
    }
    
    // --- Colonne vertébrale stylisée (côté droit) ---
    $spineX = (int)($width * 0.82);
    $spineStartY = 80;
    $vertebraCount = 12;
    $vertebraSpacing = (int)(($height - 160) / $vertebraCount);
    
    for ($i = 0; $i < $vertebraCount; $i++) {
        $cy = $spineStartY + $i * $vertebraSpacing + $vertebraSpacing / 2;
        // Ondulation naturelle
        $offset = (int)(sin($i * 0.5) * 40);
        $cx = $spineX + $offset;
        
        // Taille variable (thoracique > cervicale/lombaire)
        $vw = 60 + (int)(sin(($i / $vertebraCount) * M_PI) * 40);
        $vh = (int)($vertebraSpacing * 0.55);
        
        // Corps vertébral (rectangle arrondi simulé)
        $vColor = imagecolorallocatealpha($img, 255, 255, 255, 90);
        $vBorder = imagecolorallocatealpha($img, 255, 255, 255, 60);
        
        // Rectangle principal
        imagefilledrectangle($img, $cx - $vw/2, $cy - $vh/2, $cx + $vw/2, $cy + $vh/2, $vColor);
        imagerectangle($img, $cx - $vw/2, $cy - $vh/2, $cx + $vw/2, $cy + $vh/2, $vBorder);
        
        // Coins arrondis (petits cercles)
        imagefilledellipse($img, $cx - $vw/2, $cy, $vh, $vh, $vColor);
        imagefilledellipse($img, $cx + $vw/2, $cy, $vh, $vh, $vColor);
        
        // Apophyses épineuses (petites lignes)
        $aColor = imagecolorallocatealpha($img, 255, 255, 255, 100);
        imagesetthickness($img, 3);
        // Gauche
        imageline($img, $cx - $vw/2 - 30, $cy - 8, $cx - $vw/2 - 5, $cy, $aColor);
        imageline($img, $cx - $vw/2 - 30, $cy + 8, $cx - $vw/2 - 5, $cy, $aColor);
        // Droite
        imageline($img, $cx + $vw/2 + 30, $cy - 8, $cx + $vw/2 + 5, $cy, $aColor);
        imageline($img, $cx + $vw/2 + 30, $cy + 8, $cx + $vw/2 + 5, $cy, $aColor);
        
        // Disque intervertébral
        if ($i < $vertebraCount - 1) {
            $discColor = imagecolorallocatealpha($img, 200, 220, 255, 105);
            $discY = $cy + $vh/2 + $vertebraSpacing * 0.22;
            imagefilledellipse($img, $cx, (int)$discY, $vw - 10, 12, $discColor);
        }
        
        imagesetthickness($img, 1);
    }
    
    // --- Cercles décoratifs (côté gauche) ---
    for ($i = 0; $i < 5; $i++) {
        $cx = 100 + $i * 180;
        $cy = $height - 120 + (int)(sin($i) * 40);
        $radius = 80 + $i * 20;
        $circColor = imagecolorallocatealpha($img, 255, 255, 255, 118);
        imageellipse($img, $cx, $cy, $radius, $radius, $circColor);
        $circColor2 = imagecolorallocatealpha($img, 255, 255, 255, 122);
        imageellipse($img, $cx, $cy, $radius + 20, $radius + 20, $circColor2);
    }
    
    // --- Ligne lumineuse diagonale ---
    $lineColor = imagecolorallocatealpha($img, 255, 255, 255, 110);
    imagesetthickness($img, 4);
    imageline($img, 0, $height * 0.7, $width * 0.6, 0, $lineColor);
    imagesetthickness($img, 1);
    
    // --- Sauvegarde JPEG qualité 95 ---
    $path = '/tmp/' . $slide['file'];
    imagejpeg($img, $path, 95);
    imagedestroy($img);
    
    $size = filesize($path);
    echo "  ✓ Généré : {$width}x{$height}, qualité 95, " . round($size/1024) . " Ko\n";
    
    // --- Upload dans Moodle ---
    $filearea = "sliderimage{$num}";
    $context = context_system::instance();
    $fs = get_file_storage();
    
    // Supprimer l'ancien fichier
    $fs->delete_area_files($context->id, 'theme_moove', $filearea);
    
    // Créer le nouveau
    $filerecord = [
        'contextid' => $context->id,
        'component' => 'theme_moove',
        'filearea'  => $filearea,
        'itemid'    => 0,
        'filepath'  => '/',
        'filename'  => $slide['file'],
    ];
    $fs->create_file_from_pathname($filerecord, $path);
    echo "  ✓ Uploadé dans theme_moove/$filearea\n";
    
    // Mettre à jour le config
    set_config("sliderimage{$num}", '/' . $slide['file'], 'theme_moove');
    
    unlink($path);
}

// --- Purger les caches ---
echo "\nPurge des caches...\n";
$newrev = time();
set_config('themerev', $newrev);
purge_all_caches();
echo "✓ Caches purgés (rev=$newrev)\n";

echo "\n=== TERMINÉ ===\n";
echo "Images slider régénérées en 2400x1000 (Retina-ready), qualité 95\n";
echo "Rechargez http://localhost:8890/ (Cmd+Shift+R)\n\n";
