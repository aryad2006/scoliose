<?php
/**
 * Générateur d'images slider avec photos Unsplash + typographie TTF
 * Photos libre de droits + overlays texte professionnels
 */
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
require_once($CFG->libdir . '/filelib.php');

$W = 2400;
$H = 1000;

$FONT_BOLD  = '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf';
$FONT_REG   = '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf';
$FONT_LIGHT = '/usr/share/fonts/truetype/liberation/LiberationSans-Regular.ttf';

// =====================================================================
// HELPERS
// =====================================================================

function overlay_darken($img, $w, $h, $opacity = 80) {
    $overlay = imagecolorallocatealpha($img, 0, 0, 0, $opacity);
    imagefilledrectangle($img, 0, 0, $w, $h, $overlay);
}

function overlay_gradient_left($img, $w, $h) {
    for ($x = 0; $x < (int)($w * 0.65); $x++) {
        $alpha = (int)(20 + ($x / ($w * 0.65)) * 90);
        $c = imagecolorallocatealpha($img, 0, 15, 50, min(127, $alpha));
        imageline($img, $x, 0, $x, $h, $c);
    }
}

function overlay_gradient_bottom($img, $w, $h) {
    $start = (int)($h * 0.4);
    for ($y = $start; $y < $h; $y++) {
        $progress = ($y - $start) / ($h - $start);
        $alpha = (int)(100 - $progress * 80);
        $c = imagecolorallocatealpha($img, 0, 10, 40, max(0, $alpha));
        imageline($img, 0, $y, $w, $y, $c);
    }
}

function draw_rounded_rect($img, $x1, $y1, $x2, $y2, $r, $color) {
    imagefilledrectangle($img, $x1+$r, $y1, $x2-$r, $y2, $color);
    imagefilledrectangle($img, $x1, $y1+$r, $x2, $y2-$r, $color);
    imagefilledellipse($img, $x1+$r, $y1+$r, $r*2, $r*2, $color);
    imagefilledellipse($img, $x2-$r, $y1+$r, $r*2, $r*2, $color);
    imagefilledellipse($img, $x1+$r, $y2-$r, $r*2, $r*2, $color);
    imagefilledellipse($img, $x2-$r, $y2-$r, $r*2, $r*2, $color);
}

function text_with_shadow($img, $size, $x, $y, $text, $color, $font, $shadow_offset = 2) {
    $shadow = imagecolorallocatealpha($img, 0, 0, 0, 60);
    imagettftext($img, $size, 0, $x + $shadow_offset, $y + $shadow_offset, $shadow, $font, $text);
    imagettftext($img, $size, 0, $x, $y, $color, $font, $text);
}

function text_centered($img, $size, $cx, $y, $text, $color, $font) {
    $bbox = imagettfbbox($size, 0, $font, $text);
    $tw = $bbox[2] - $bbox[0];
    $x = $cx - (int)($tw / 2);
    text_with_shadow($img, $size, $x, $y, $text, $color, $font);
}

function draw_accent_line($img, $x, $y, $width, $height, $color) {
    imagefilledrectangle($img, $x, $y, $x + $width, $y + $height, $color);
}

function draw_pill_badge($img, $x, $y, $text, $bg_color, $text_color, $font, $size = 16) {
    $bbox = imagettfbbox($size, 0, $font, $text);
    $tw = $bbox[2] - $bbox[0];
    $pad_x = 20;
    $pad_y = 8;
    $h = $size + $pad_y * 2;
    $w = $tw + $pad_x * 2;
    draw_rounded_rect($img, $x, $y, $x + $w, $y + $h, (int)($h/2), $bg_color);
    imagettftext($img, $size, 0, $x + $pad_x, $y + $size + $pad_y - 2, $text_color, $font, $text);
}

function draw_stat_card($img, $x, $y, $number, $label, $font_bold, $font_reg) {
    $bg = imagecolorallocatealpha($img, 255, 255, 255, 100);
    draw_rounded_rect($img, $x, $y, $x + 160, $y + 100, 12, $bg);
    $border = imagecolorallocatealpha($img, 255, 255, 255, 80);
    imagerectangle($img, $x, $y, $x + 160, $y + 100, $border);
    
    $white = imagecolorallocate($img, 255, 255, 255);
    $light = imagecolorallocate($img, 200, 220, 255);
    
    // Centrer le nombre
    $bbox = imagettfbbox(32, 0, $font_bold, $number);
    $nw = $bbox[2] - $bbox[0];
    imagettftext($img, 32, 0, $x + 80 - (int)($nw/2), $y + 45, $white, $font_bold, $number);
    
    // Centrer le label
    $bbox2 = imagettfbbox(14, 0, $font_reg, $label);
    $lw = $bbox2[2] - $bbox2[0];
    imagettftext($img, 14, 0, $x + 80 - (int)($lw/2), $y + 78, $light, $font_reg, $label);
}

function draw_check_item($img, $x, $y, $text, $font, $size = 18) {
    $green = imagecolorallocate($img, 100, 255, 150);
    $white = imagecolorallocate($img, 240, 245, 255);
    
    // Checkmark circle
    imagefilledellipse($img, $x + 12, $y + 10, 22, 22, $green);
    $dark = imagecolorallocate($img, 0, 40, 20);
    imagettftext($img, 12, 0, $x + 5, $y + 15, $dark, $font, "✓");
    
    imagettftext($img, $size, 0, $x + 30, $y + 17, $white, $font, $text);
}

// =====================================================================
// SLIDE 1 : Formation Scoliose — photo médicale
// =====================================================================
function create_slide1($W, $H, $FONT_BOLD, $FONT_REG, $FONT_LIGHT) {
    // Charger la photo de fond
    $bg = imagecreatefromjpeg('/tmp/bg_medical.jpg');
    $img = imagecreatetruecolor($W, $H);
    imagealphablending($img, true);
    
    // Redimensionner le fond
    $bw = imagesx($bg);
    $bh = imagesy($bg);
    imagecopyresampled($img, $bg, 0, 0, 0, 0, $W, $H, $bw, $bh);
    imagedestroy($bg);
    
    // Overlay gradient sombre à gauche
    overlay_gradient_left($img, $W, $H);
    overlay_darken($img, $W, $H, 90);
    
    // Bande d'accent dorée à gauche
    $gold = imagecolorallocate($img, 255, 200, 70);
    imagefilledrectangle($img, 0, 0, 6, $H, $gold);
    
    // Couleurs
    $white = imagecolorallocate($img, 255, 255, 255);
    $light_blue = imagecolorallocate($img, 150, 200, 255);
    $gold_text = imagecolorallocate($img, 255, 210, 90);
    
    $left = 100;
    
    // Badge "FORMATION MÉDICALE CONTINUE"
    $badge_bg = imagecolorallocatealpha($img, 255, 200, 70, 30);
    $badge_dark = imagecolorallocate($img, 30, 20, 0);
    draw_pill_badge($img, $left, 120, "  FORMATION MÉDICALE CONTINUE  ", $badge_bg, $badge_dark, $FONT_BOLD, 14);
    
    // Titre principal
    text_with_shadow($img, 56, $left, 240, "Formation", $gold_text, $FONT_BOLD, 3);
    text_with_shadow($img, 56, $left, 310, "Scoliose", $white, $FONT_BOLD, 3);
    text_with_shadow($img, 36, $left, 370, "avec SpineSim", $light_blue, $FONT_LIGHT, 2);
    
    // Ligne d'accent
    draw_accent_line($img, $left, 400, 200, 4, $gold);
    
    // Description
    text_with_shadow($img, 20, $left, 450, "Programme complet de formation médicale", $white, $FONT_REG, 1);
    text_with_shadow($img, 20, $left, 480, "continue sur la prise en charge", $white, $FONT_REG, 1);
    text_with_shadow($img, 20, $left, 510, "de la scoliose.", $white, $FONT_REG, 1);
    
    // Stats cards
    draw_stat_card($img, $left, 560, "29", "Modules", $FONT_BOLD, $FONT_REG);
    draw_stat_card($img, $left + 180, 560, "89h", "Formation", $FONT_BOLD, $FONT_REG);
    draw_stat_card($img, $left + 360, 560, "600+", "Questions", $FONT_BOLD, $FONT_REG);
    draw_stat_card($img, $left + 540, 560, "130", "Références", $FONT_BOLD, $FONT_REG);
    
    // Boutons CTA en bas
    $btn_blue = imagecolorallocate($img, 0, 102, 204);
    draw_rounded_rect($img, $left, 720, $left + 260, 775, 28, $btn_blue);
    text_centered($img, 18, $left + 130, 755, "Découvrir le programme", $white, $FONT_BOLD);
    
    $btn_outline = imagecolorallocatealpha($img, 255, 255, 255, 90);
    draw_rounded_rect($img, $left + 290, 720, $left + 510, 775, 28, $btn_outline);
    $border_white = imagecolorallocatealpha($img, 255, 255, 255, 50);
    imagerectangle($img, $left + 290, 720, $left + 510, 775, $border_white);
    text_centered($img, 18, $left + 400, 755, "Se connecter", $white, $FONT_REG);
    
    // Badge DPC en bas à droite
    $dpc_bg = imagecolorallocate($img, 255, 200, 70);
    draw_rounded_rect($img, $W - 280, $H - 100, $W - 50, $H - 40, 20, $dpc_bg);
    $dark = imagecolorallocate($img, 30, 20, 0);
    text_centered($img, 16, $W - 165, $H - 62, "Éligible DPC", $dark, $FONT_BOLD);
    
    // Subtile ligne de copyright
    $dim = imagecolorallocatealpha($img, 255, 255, 255, 110);
    imagettftext($img, 9, 0, $W - 220, $H - 10, $dim, $FONT_LIGHT, "Photo: Unsplash (libre de droits)");
    
    return $img;
}

// =====================================================================
// SLIDE 2 : Simulateur SpineSim — photo tech
// =====================================================================
function create_slide2($W, $H, $FONT_BOLD, $FONT_REG, $FONT_LIGHT) {
    $bg = imagecreatefromjpeg('/tmp/bg_tech.jpg');
    $img = imagecreatetruecolor($W, $H);
    imagealphablending($img, true);
    
    $bw = imagesx($bg);
    $bh = imagesy($bg);
    imagecopyresampled($img, $bg, 0, 0, 0, 0, $W, $H, $bw, $bh);
    imagedestroy($bg);
    
    overlay_darken($img, $W, $H, 75);
    
    // Bande cyan à gauche
    $cyan = imagecolorallocate($img, 0, 220, 255);
    imagefilledrectangle($img, 0, 0, 6, $H, $cyan);
    
    $white = imagecolorallocate($img, 255, 255, 255);
    $cyan_text = imagecolorallocate($img, 0, 220, 255);
    $green = imagecolorallocate($img, 80, 255, 160);
    
    $left = 100;
    
    // Badge
    $badge_bg = imagecolorallocatealpha($img, 0, 200, 255, 30);
    draw_pill_badge($img, $left, 120, "  SIMULATION BIOMÉCHANIQUE  ", $badge_bg, $white, $FONT_BOLD, 14);
    
    // Titre
    text_with_shadow($img, 56, $left, 240, "Simulateur", $cyan_text, $FONT_BOLD, 3);
    text_with_shadow($img, 56, $left, 310, "SpineSim", $white, $FONT_BOLD, 3);
    
    draw_accent_line($img, $left, 340, 180, 4, $cyan);
    
    // Description
    text_with_shadow($img, 22, $left, 390, "Simulation bioméchanique par", $white, $FONT_REG, 1);
    text_with_shadow($img, 22, $left, 420, "éléments finis pour la chirurgie", $white, $FONT_REG, 1);
    text_with_shadow($img, 22, $left, 450, "de la scoliose.", $white, $FONT_REG, 1);
    
    // Feature list avec checkmarks
    draw_check_item($img, $left, 500, "Modèles 3D patient-spécifiques", $FONT_REG);
    draw_check_item($img, $left, 540, "Correction chirurgicale virtuelle", $FONT_REG);
    draw_check_item($img, $left, 580, "Analyse angle de Cobb temps réel", $FONT_REG);
    draw_check_item($img, $left, 620, "Méthode éléments finis validée", $FONT_REG);
    draw_check_item($img, $left, 660, "Export rapport pré-opératoire", $FONT_REG);
    
    // Panneau de données à droite
    $panel_bg = imagecolorallocatealpha($img, 0, 20, 60, 50);
    draw_rounded_rect($img, $W - 550, 150, $W - 80, 550, 16, $panel_bg);
    $panel_border = imagecolorallocatealpha($img, 0, 200, 255, 80);
    imagerectangle($img, $W - 550, 150, $W - 80, 550, $panel_border);
    
    // Panneau titre
    $header_bg = imagecolorallocatealpha($img, 0, 150, 200, 50);
    draw_rounded_rect($img, $W - 550, 150, $W - 80, 200, 16, $header_bg);
    text_centered($img, 18, $W - 315, 185, "PARAMÈTRES BIOMÉCANIQUES", $cyan_text, $FONT_BOLD);
    
    // Paramètres
    $params = [
        ["Rigidité vertébrale", "0.85 GPa"],
        ["Angle de Cobb", "25.3°"],
        ["Force de correction", "450 N"],
        ["Éléments de maillage", "12,480"],
        ["Précision modèle", "97.8%"],
        ["Itérations FEM", "2,048"],
    ];
    
    $py = 230;
    foreach ($params as $p) {
        $dim_white = imagecolorallocatealpha($img, 200, 210, 230, 20);
        imagettftext($img, 15, 0, $W - 530, $py, $dim_white, $FONT_REG, $p[0]);
        imagettftext($img, 16, 0, $W - 250, $py, $cyan_text, $FONT_BOLD, $p[1]);
        
        // Ligne séparatrice
        $sep = imagecolorallocatealpha($img, 100, 150, 200, 100);
        imageline($img, $W - 530, $py + 15, $W - 100, $py + 15, $sep);
        $py += 52;
    }
    
    // Badge technologie en bas à droite
    $tech_bg = imagecolorallocate($img, 0, 180, 220);
    draw_rounded_rect($img, $W - 350, $H - 100, $W - 80, $H - 40, 20, $tech_bg);
    text_centered($img, 16, $W - 215, $H - 62, "Technologie FEM", $white, $FONT_BOLD);
    
    $dim = imagecolorallocatealpha($img, 255, 255, 255, 110);
    imagettftext($img, 9, 0, $W - 220, $H - 10, $dim, $FONT_LIGHT, "Photo: Unsplash (libre de droits)");
    
    return $img;
}

// =====================================================================
// SLIDE 3 : Certification DPC
// =====================================================================
function create_slide3($W, $H, $FONT_BOLD, $FONT_REG, $FONT_LIGHT) {
    $bg = imagecreatefromjpeg('/tmp/bg_cert.jpg');
    $img = imagecreatetruecolor($W, $H);
    imagealphablending($img, true);
    
    $bw = imagesx($bg);
    $bh = imagesy($bg);
    imagecopyresampled($img, $bg, 0, 0, 0, 0, $W, $H, $bw, $bh);
    imagedestroy($bg);
    
    overlay_darken($img, $W, $H, 80);
    
    // Bande dorée
    $gold = imagecolorallocate($img, 255, 200, 70);
    imagefilledrectangle($img, 0, 0, 6, $H, $gold);
    
    $white = imagecolorallocate($img, 255, 255, 255);
    $gold_text = imagecolorallocate($img, 255, 210, 90);
    $light = imagecolorallocate($img, 200, 215, 240);
    
    $left = 100;
    
    // Badge
    $badge_bg = imagecolorallocatealpha($img, 255, 200, 70, 30);
    draw_pill_badge($img, $left, 120, "  CERTIFICATION RECONNUE  ", $badge_bg, imagecolorallocate($img, 30, 20, 0), $FONT_BOLD, 14);
    
    // Titre
    text_with_shadow($img, 56, $left, 240, "Certification", $gold_text, $FONT_BOLD, 3);
    text_with_shadow($img, 56, $left, 310, "DPC", $white, $FONT_BOLD, 3);
    
    draw_accent_line($img, $left, 340, 160, 4, $gold);
    
    text_with_shadow($img, 22, $left, 390, "Formation éligible au Développement", $white, $FONT_REG, 1);
    text_with_shadow($img, 22, $left, 420, "Professionnel Continu.", $white, $FONT_REG, 1);
    text_with_shadow($img, 22, $left, 450, "Certificat reconnu par les instances.", $white, $FONT_REG, 1);
    
    // 4 niveaux de certification
    $levels = [
        ["BRONZE",  "Fondamentaux",       [205, 127, 50]],
        ["ARGENT",  "Approfondissement",   [192, 192, 220]],
        ["OR",      "Expertise avancée",   [255, 215, 0]],
        ["DIAMANT", "Maîtrise complète",   [185, 242, 255]],
    ];
    
    $ly = 510;
    foreach ($levels as $lv) {
        $level_color = imagecolorallocate($img, $lv[2][0], $lv[2][1], $lv[2][2]);
        
        // Médaille
        imagefilledellipse($img, $left + 20, $ly + 12, 30, 30, $level_color);
        $medal_dark = imagecolorallocate($img, (int)($lv[2][0]*0.3), (int)($lv[2][1]*0.3), (int)($lv[2][2]*0.3));
        imagettftext($img, 10, 0, $left + 14, $ly + 16, $medal_dark, $FONT_BOLD, "★");
        
        // Nom du niveau
        imagettftext($img, 20, 0, $left + 50, $ly + 8, $level_color, $FONT_BOLD, $lv[0]);
        imagettftext($img, 15, 0, $left + 50, $ly + 30, $light, $FONT_REG, $lv[1]);
        
        $ly += 55;
    }
    
    // Panneau avantages à droite
    $panel_bg = imagecolorallocatealpha($img, 0, 20, 50, 50);
    draw_rounded_rect($img, $W - 600, 150, $W - 80, 680, 16, $panel_bg);
    $panel_border = imagecolorallocatealpha($img, 255, 200, 70, 80);
    imagerectangle($img, $W - 600, 150, $W - 80, 680, $panel_border);
    
    // Titre panneau
    $header_bg = imagecolorallocatealpha($img, 200, 160, 40, 50);
    draw_rounded_rect($img, $W - 600, 150, $W - 80, 200, 16, $header_bg);
    text_centered($img, 18, $W - 340, 185, "POURQUOI LA CERTIFICATION ?", $gold_text, $FONT_BOLD);
    
    // Avantages
    $advantages = [
        "Éligible formation DPC",
        "Reconnue par les instances médicales",
        "Certificat numérique sécurisé",
        "Suivi de progression détaillé",
        "Badges de compétences validés",
        "4 niveaux progressifs",
        "Attestation de 89h de formation",
        "Valorisation du parcours professionnel",
    ];
    
    $ay = 225;
    foreach ($advantages as $adv) {
        draw_check_item($img, $W - 580, $ay, $adv, $FONT_REG, 16);
        $ay += 52;
    }
    
    // Badge en bas à droite
    $dpc_bg = imagecolorallocate($img, 255, 200, 70);
    draw_rounded_rect($img, $W - 320, $H - 100, $W - 80, $H - 40, 20, $dpc_bg);
    $dark = imagecolorallocate($img, 30, 20, 0);
    text_centered($img, 16, $W - 200, $H - 62, "Certifié DPC", $dark, $FONT_BOLD);
    
    $dim = imagecolorallocatealpha($img, 255, 255, 255, 110);
    imagettftext($img, 9, 0, $W - 220, $H - 10, $dim, $FONT_LIGHT, "Photo: Unsplash (libre de droits)");
    
    return $img;
}

// =====================================================================
// EXÉCUTION
// =====================================================================

echo "=== Génération des slides professionnels ===\n";
echo "Photos Unsplash + Typographie DejaVu TTF + FreeType\n\n";

$slides_config = [
    1 => ['func' => 'create_slide1', 'file' => 'slide_formation.jpg'],
    2 => ['func' => 'create_slide2', 'file' => 'slide_spinesim.jpg'],
    3 => ['func' => 'create_slide3', 'file' => 'slide_certification.jpg'],
];

$fs = get_file_storage();
$context = context_system::instance();

foreach ($slides_config as $num => $slide) {
    echo "Slide $num: Génération...";
    
    $func = $slide['func'];
    $img = $func($W, $H, $FONT_BOLD, $FONT_REG, $FONT_LIGHT);
    
    $tmpfile = tempnam(sys_get_temp_dir(), 'slide') . '.jpg';
    imagejpeg($img, $tmpfile, 92);
    imagedestroy($img);
    
    $filesize = filesize($tmpfile);
    echo " " . round($filesize / 1024) . " Ko";
    
    // Upload
    $area = 'sliderimage' . $num;
    $old_files = $fs->get_area_files($context->id, 'theme_moove', $area, 0, 'id', false);
    foreach ($old_files as $f) { $f->delete(); }
    
    $filerecord = [
        'contextid' => $context->id,
        'component' => 'theme_moove',
        'filearea' => $area,
        'itemid' => 0,
        'filepath' => '/',
        'filename' => $slide['file'],
    ];
    $fs->create_file_from_pathname($filerecord, $tmpfile);
    unlink($tmpfile);
    echo " ✓\n";
}

echo "\nPurge des caches...";
theme_reset_all_caches();
purge_all_caches();
echo " ✓\n";

echo "\n=== TERMINÉ ===\n";
echo "Rechargez: http://localhost:8890/\n";
