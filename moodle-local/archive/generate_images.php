<?php
/**
 * Generateur d'images pour la formation Scoliose
 * Logo + 3 slides de slider + favicon
 */

// === 1. LOGO (400x100) ===
echo "[1/5] Generation du logo..." . PHP_EOL;
$logo = imagecreatetruecolor(400, 100);
imagesavealpha($logo, true);
$transparent = imagecolorallocatealpha($logo, 0, 0, 0, 127);
imagefill($logo, 0, 0, $transparent);

// Cercle bleu medical
$blue = imagecolorallocate($logo, 0, 102, 204);
$darkblue = imagecolorallocate($logo, 0, 76, 153);
$white = imagecolorallocate($logo, 255, 255, 255);
$lightblue = imagecolorallocate($logo, 51, 153, 255);

// Fond cercle
imagefilledellipse($logo, 50, 50, 80, 80, $blue);
imagefilledellipse($logo, 50, 50, 70, 70, $darkblue);

// Spine stylisee (S courbe dans le cercle)
imagesetthickness($logo, 3);
$spine_white = imagecolorallocate($logo, 255, 255, 255);
// Dessiner une colonne vertebrale stylisee (series de petits rectangles)
for ($i = 0; $i < 7; $i++) {
    $y = 18 + $i * 9;
    $offset = (int)(sin(($i - 3) * 0.5) * 8);
    $w = 14 - abs($i - 3);
    imagefilledrectangle($logo, 50 + $offset - $w/2, $y, 50 + $offset + $w/2, $y + 6, $white);
    if ($i < 6) {
        $next_offset = (int)(sin(($i - 2) * 0.5) * 8);
        imageline($logo, 50 + $offset, $y + 6, 50 + $next_offset, $y + 9, $white);
    }
}

// Texte "SCOLIOSE" 
$text_dark = imagecolorallocate($logo, 0, 51, 102);
$text_light = imagecolorallocate($logo, 100, 140, 180);
imagestring($logo, 5, 100, 25, "SCOLIOSE", $blue);
imagestring($logo, 3, 100, 50, "FORMATION MEDICALE", $text_light);
imagestring($logo, 2, 100, 68, "avec SpineSim", $lightblue);

imagepng($logo, '/tmp/moodle_logo.png');
imagedestroy($logo);
echo "  [OK] Logo 400x100" . PHP_EOL;

// === 2. FAVICON (64x64) ===
echo "[2/5] Generation du favicon..." . PHP_EOL;
$fav = imagecreatetruecolor(64, 64);
imagesavealpha($fav, true);
$transparent = imagecolorallocatealpha($fav, 0, 0, 0, 127);
imagefill($fav, 0, 0, $transparent);
$blue = imagecolorallocate($fav, 0, 102, 204);
$darkblue = imagecolorallocate($fav, 0, 76, 153);
$white = imagecolorallocate($fav, 255, 255, 255);
imagefilledellipse($fav, 32, 32, 60, 60, $blue);
imagefilledellipse($fav, 32, 32, 52, 52, $darkblue);
for ($i = 0; $i < 6; $i++) {
    $y = 10 + $i * 8;
    $offset = (int)(sin(($i - 2.5) * 0.6) * 6);
    $w = 10 - abs($i - 2.5);
    imagefilledrectangle($fav, 32 + $offset - $w/2, $y, 32 + $offset + $w/2, $y + 5, $white);
}
imagepng($fav, '/tmp/moodle_favicon.png');
imagedestroy($fav);
echo "  [OK] Favicon 64x64" . PHP_EOL;

// === FONCTION HELPER pour slides ===
function create_slide($filename, $w, $h, $title, $subtitle, $gradient_start, $gradient_end, $accent) {
    $img = imagecreatetruecolor($w, $h);
    
    // Degrade de fond
    $r1 = ($gradient_start >> 16) & 0xFF; $g1 = ($gradient_start >> 8) & 0xFF; $b1 = $gradient_start & 0xFF;
    $r2 = ($gradient_end >> 16) & 0xFF; $g2 = ($gradient_end >> 8) & 0xFF; $b2 = $gradient_end & 0xFF;
    
    for ($y = 0; $y < $h; $y++) {
        $ratio = $y / $h;
        $r = (int)($r1 + ($r2 - $r1) * $ratio);
        $g = (int)($g1 + ($g2 - $g1) * $ratio);
        $b = (int)($b1 + ($b2 - $b1) * $ratio);
        $color = imagecolorallocate($img, $r, $g, $b);
        imageline($img, 0, $y, $w, $y, $color);
    }
    
    // Motif geometrique (grille medicale)
    $grid = imagecolorallocatealpha($img, 255, 255, 255, 115);
    for ($x = 0; $x < $w; $x += 40) {
        imageline($img, $x, 0, $x, $h, $grid);
    }
    for ($y = 0; $y < $h; $y += 40) {
        imageline($img, 0, $y, $w, $y, $grid);
    }
    
    // Points lumineux decoratifs
    $dot = imagecolorallocatealpha($img, 255, 255, 255, 100);
    for ($i = 0; $i < 20; $i++) {
        $px = rand(0, $w);
        $py = rand(0, $h);
        $size = rand(3, 12);
        imagefilledellipse($img, $px, $py, $size, $size, $dot);
    }
    
    // Bande accent en bas
    $acc_r = ($accent >> 16) & 0xFF; $acc_g = ($accent >> 8) & 0xFF; $acc_b = $accent & 0xFF;
    $accent_color = imagecolorallocate($img, $acc_r, $acc_g, $acc_b);
    imagefilledrectangle($img, 0, $h - 6, $w, $h, $accent_color);
    
    // Colonne vertebrale stylisee (grand, cote droit)
    $spine_alpha = imagecolorallocatealpha($img, 255, 255, 255, 105);
    $cx = $w - 120;
    for ($i = 0; $i < 12; $i++) {
        $sy = 40 + $i * 30;
        $offset = (int)(sin(($i - 5.5) * 0.35) * 25);
        $sw = 30 - abs($i - 5.5) * 1.5;
        imagefilledrectangle($img, $cx + $offset - $sw/2, $sy, $cx + $offset + $sw/2, $sy + 22, $spine_alpha);
        // Disques intervertebraux
        if ($i < 11) {
            $next_offset = (int)(sin(($i - 4.5) * 0.35) * 25);
            $disc = imagecolorallocatealpha($img, 200, 220, 255, 110);
            imagefilledellipse($img, $cx + ($offset + $next_offset)/2, $sy + 26, $sw * 0.8, 6, $disc);
        }
    }
    
    // Zone semi-transparente pour le texte
    $overlay = imagecolorallocatealpha($img, 0, 0, 0, 80);
    imagefilledrectangle($img, 40, $h/2 - 70, $w - 200, $h/2 + 50, $overlay);
    
    // Texte titre
    $white = imagecolorallocate($img, 255, 255, 255);
    $light = imagecolorallocate($img, 200, 220, 240);
    
    // Titre en grand (utiliser imagestring pour rester compatible)
    $title_x = 60;
    $title_y = $h/2 - 50;
    // Simuler du gros texte avec imagestring (font 5 = la plus grande native)
    imagestring($img, 5, $title_x, $title_y, $title, $white);
    imagestring($img, 5, $title_x, $title_y + 2, $title, $white); // bold effect
    
    // Sous-titre
    imagestring($img, 4, $title_x, $title_y + 30, $subtitle, $light);
    
    imagejpeg($img, $filename, 92);
    imagedestroy($img);
}

// === 3. SLIDE 1 - Formation Scoliose ===
echo "[3/5] Generation Slide 1..." . PHP_EOL;
create_slide('/tmp/slide1.jpg', 1200, 500, 
    'Formation Scoliose avec SpineSim',
    '29 modules - 89h15 de formation intensive',
    0x001a33, 0x003366, 0x0099FF
);
echo "  [OK] Slide 1 (1200x500)" . PHP_EOL;

// === 4. SLIDE 2 - SpineSim ===
echo "[4/5] Generation Slide 2..." . PHP_EOL;
create_slide('/tmp/slide2.jpg', 1200, 500,
    'Simulateur SpineSim - Elements Finis',
    'Simulation biomecanique interactive 3D',
    0x0a1628, 0x1a3a5c, 0x00CCFF
);
echo "  [OK] Slide 2 (1200x500)" . PHP_EOL;

// === 5. SLIDE 3 - Certification ===
echo "[5/5] Generation Slide 3..." . PHP_EOL;
create_slide('/tmp/slide3.jpg', 1200, 500,
    'Certification DPC reconnue',
    'Bronze - Argent - Or - Diamant',
    0x1a0a2e, 0x2d1b69, 0x9966FF
);
echo "  [OK] Slide 3 (1200x500)" . PHP_EOL;

echo PHP_EOL . "=== Toutes les images generees ===" . PHP_EOL;
foreach (['/tmp/moodle_logo.png', '/tmp/moodle_favicon.png', '/tmp/slide1.jpg', '/tmp/slide2.jpg', '/tmp/slide3.jpg'] as $f) {
    echo $f . " : " . filesize($f) . " octets" . PHP_EOL;
}
