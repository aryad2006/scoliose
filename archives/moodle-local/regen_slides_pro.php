<?php
/**
 * Générateur d'images slider professionnelles pour la formation Scoliose
 * Images 2400x1000 avec illustrations médicales détaillées
 */
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
require_once($CFG->libdir . '/filelib.php');

$width = 2400;
$height = 1000;

// =====================================================================
// SLIDE 1 : Formation Scoliose avec SpineSim
// =====================================================================
function create_slide1($w, $h) {
    $img = imagecreatetruecolor($w, $h);
    imagealphablending($img, true);

    // Fond dégradé bleu profond → bleu ciel
    for ($y = 0; $y < $h; $y++) {
        $ratio = $y / $h;
        $r = (int)(8 + $ratio * 30);
        $g = (int)(40 + $ratio * 80);
        $b = (int)(120 + $ratio * 80);
        $c = imagecolorallocate($img, $r, $g, $b);
        imageline($img, 0, $y, $w, $y, $c);
    }

    // Motif hexagonal subtil (texture médicale)
    $hex_color = imagecolorallocatealpha($img, 255, 255, 255, 115);
    $hex_size = 40;
    for ($row = 0; $row < $h / $hex_size + 1; $row++) {
        for ($col = 0; $col < $w / ($hex_size * 1.7) + 1; $col++) {
            $cx = (int)($col * $hex_size * 1.7 + ($row % 2 ? $hex_size * 0.85 : 0));
            $cy = (int)($row * $hex_size * 1.5);
            draw_hexagon($img, $cx, $cy, $hex_size / 2, $hex_color);
        }
    }

    // Colonne vertébrale au centre-gauche - illustration détaillée
    draw_detailed_spine($img, (int)($w * 0.22), (int)($h * 0.08), (int)($h * 0.84), 14);

    // Panneau semi-transparent à droite pour le texte
    $panel = imagecolorallocatealpha($img, 0, 20, 60, 60);
    imagefilledrectangle($img, (int)($w * 0.42), (int)($h * 0.12), (int)($w * 0.92), (int)($h * 0.88), $panel);

    // Bordure du panneau
    $border = imagecolorallocatealpha($img, 100, 180, 255, 80);
    imagerectangle($img, (int)($w * 0.42), (int)($h * 0.12), (int)($w * 0.92), (int)($h * 0.88), $border);

    // Texte principal
    $white = imagecolorallocate($img, 255, 255, 255);
    $light_blue = imagecolorallocate($img, 130, 200, 255);
    $gold = imagecolorallocate($img, 255, 200, 80);

    // Titre
    draw_text_block($img, "FORMATION", (int)($w * 0.47), (int)($h * 0.25), $gold, 7);
    draw_text_block($img, "SCOLIOSE", (int)($w * 0.47), (int)($h * 0.36), $white, 7);
    draw_text_block($img, "avec SpineSim", (int)($w * 0.47), (int)($h * 0.46), $light_blue, 5);

    // Ligne séparatrice
    $sep = imagecolorallocate($img, 255, 200, 80);
    imagefilledrectangle($img, (int)($w * 0.47), (int)($h * 0.53), (int)($w * 0.67), (int)($h * 0.535), $sep);

    // Stats en ligne
    draw_stat_box($img, (int)($w * 0.47), (int)($h * 0.58), "29", "Modules", $white, $light_blue);
    draw_stat_box($img, (int)($w * 0.60), (int)($h * 0.58), "89h", "Formation", $white, $light_blue);
    draw_stat_box($img, (int)($w * 0.73), (int)($h * 0.58), "600+", "Quiz", $white, $light_blue);

    // Sous-titre
    draw_text_block($img, "Programme complet de formation", (int)($w * 0.47), (int)($h * 0.73), $white, 3);
    draw_text_block($img, "medicale continue sur la scoliose", (int)($w * 0.47), (int)($h * 0.78), $white, 3);

    // Badge DPC
    draw_badge($img, (int)($w * 0.77), (int)($h * 0.77), "DPC", $gold);

    // Cercles décoratifs
    $circle_color = imagecolorallocatealpha($img, 100, 180, 255, 100);
    imageellipse($img, (int)($w * 0.95), (int)($h * 0.1), 200, 200, $circle_color);
    imageellipse($img, (int)($w * 0.08), (int)($h * 0.9), 150, 150, $circle_color);

    return $img;
}

// =====================================================================
// SLIDE 2 : Simulateur SpineSim
// =====================================================================
function create_slide2($w, $h) {
    $img = imagecreatetruecolor($w, $h);
    imagealphablending($img, true);

    // Fond dégradé sombre tech (noir → bleu foncé)
    for ($y = 0; $y < $h; $y++) {
        $ratio = $y / $h;
        $r = (int)(5 + $ratio * 15);
        $g = (int)(10 + $ratio * 30);
        $b = (int)(30 + $ratio * 60);
        $c = imagecolorallocate($img, $r, $g, $b);
        imageline($img, 0, $y, $w, $y, $c);
    }

    // Grille 3D perspective (style simulation)
    draw_perspective_grid($img, $w, $h);

    // Colonne vertébrale 3D au centre avec scoliose
    draw_scoliosis_spine_3d($img, (int)($w * 0.5), (int)($h * 0.08), (int)($h * 0.84), 16);

    // Points de mesure / angles
    $cyan = imagecolorallocate($img, 0, 255, 255);
    $measure_pts = [
        [(int)($w * 0.48), (int)($h * 0.25)],
        [(int)($w * 0.55), (int)($h * 0.45)],
        [(int)($w * 0.47), (int)($h * 0.65)],
    ];
    for ($i = 0; $i < count($measure_pts) - 1; $i++) {
        imageline($img, $measure_pts[$i][0], $measure_pts[$i][1],
                  $measure_pts[$i+1][0], $measure_pts[$i+1][1], $cyan);
        imageellipse($img, $measure_pts[$i][0], $measure_pts[$i][1], 12, 12, $cyan);
    }
    imageellipse($img, $measure_pts[2][0], $measure_pts[2][1], 12, 12, $cyan);

    // Angle de Cobb simulé
    draw_text_block($img, "25.3", (int)($w * 0.56), (int)($h * 0.43), $cyan, 3);

    // Panneau gauche
    $panel = imagecolorallocatealpha($img, 0, 10, 40, 55);
    imagefilledrectangle($img, (int)($w * 0.05), (int)($h * 0.15), (int)($w * 0.38), (int)($h * 0.85), $panel);
    $border = imagecolorallocatealpha($img, 0, 200, 255, 80);
    imagerectangle($img, (int)($w * 0.05), (int)($h * 0.15), (int)($w * 0.38), (int)($h * 0.85), $border);

    $white = imagecolorallocate($img, 255, 255, 255);
    $cyan2 = imagecolorallocate($img, 0, 220, 255);
    $green = imagecolorallocate($img, 0, 255, 150);

    draw_text_block($img, "SIMULATEUR", (int)($w * 0.08), (int)($h * 0.22), $cyan2, 6);
    draw_text_block($img, "SpineSim", (int)($w * 0.08), (int)($h * 0.32), $white, 7);

    // Ligne séparatrice
    imagefilledrectangle($img, (int)($w * 0.08), (int)($h * 0.40), (int)($w * 0.25), (int)($h * 0.405), $cyan2);

    draw_text_block($img, "Simulation biomecanique", (int)($w * 0.08), (int)($h * 0.46), $white, 3);
    draw_text_block($img, "par elements finis", (int)($w * 0.08), (int)($h * 0.51), $white, 3);

    // Features list
    draw_feature_item($img, (int)($w * 0.08), (int)($h * 0.60), "Modeles 3D patient-specifiques", $green, $white);
    draw_feature_item($img, (int)($w * 0.08), (int)($h * 0.67), "Correction chirurgicale virtuelle", $green, $white);
    draw_feature_item($img, (int)($w * 0.08), (int)($h * 0.74), "Analyse Cobb en temps reel", $green, $white);

    // Panneau droit avec données
    $panel2 = imagecolorallocatealpha($img, 0, 10, 40, 55);
    imagefilledrectangle($img, (int)($w * 0.68), (int)($h * 0.15), (int)($w * 0.95), (int)($h * 0.50), $panel2);
    imagerectangle($img, (int)($w * 0.68), (int)($h * 0.15), (int)($w * 0.95), (int)($h * 0.50), $border);

    draw_text_block($img, "PARAMETRES", (int)($w * 0.71), (int)($h * 0.19), $cyan2, 3);
    draw_param_line($img, (int)($w * 0.71), (int)($h * 0.27), "Rigidite:", "0.85 GPa", $white, $cyan2);
    draw_param_line($img, (int)($w * 0.71), (int)($h * 0.33), "Courbure:", "25.3 deg", $white, $cyan2);
    draw_param_line($img, (int)($w * 0.71), (int)($h * 0.39), "Force:", "450 N", $white, $cyan2);
    draw_param_line($img, (int)($w * 0.71), (int)($h * 0.45), "Elements:", "12,480", $white, $cyan2);

    return $img;
}

// =====================================================================
// SLIDE 3 : Certification DPC
// =====================================================================
function create_slide3($w, $h) {
    $img = imagecreatetruecolor($w, $h);
    imagealphablending($img, true);

    // Fond dégradé élégant (bleu foncé → doré)
    for ($y = 0; $y < $h; $y++) {
        $ratio = $y / $h;
        for ($x = 0; $x < $w; $x++) {
            $xratio = $x / $w;
            $r = (int)(15 + $xratio * 60 + $ratio * 40);
            $g = (int)(25 + $xratio * 30 + $ratio * 40);
            $b = (int)(80 - $xratio * 30 + $ratio * 20);
            $c = imagecolorallocate($img, min(255, $r), min(255, $g), min(255, $b));
            imagesetpixel($img, $x, $y, $c);
        }
    }

    // Motif de laurier / certificat au centre
    draw_laurel_wreath($img, (int)($w * 0.5), (int)($h * 0.45), 200);

    // Badge central
    $gold = imagecolorallocate($img, 255, 200, 80);
    $dark_gold = imagecolorallocate($img, 200, 160, 60);
    $white = imagecolorallocate($img, 255, 255, 255);

    imagefilledellipse($img, (int)($w * 0.5), (int)($h * 0.42), 180, 180, $dark_gold);
    imagefilledellipse($img, (int)($w * 0.5), (int)($h * 0.42), 160, 160, $gold);
    imageellipse($img, (int)($w * 0.5), (int)($h * 0.42), 170, 170, $white);
    draw_text_centered($img, "DPC", (int)($w * 0.5), (int)($h * 0.40), $white, 7);

    // Panneau gauche - Niveaux de certification
    $panel = imagecolorallocatealpha($img, 10, 20, 50, 55);
    imagefilledrectangle($img, (int)($w * 0.05), (int)($h * 0.12), (int)($w * 0.35), (int)($h * 0.88), $panel);

    $light_blue = imagecolorallocate($img, 150, 200, 255);
    draw_text_block($img, "CERTIFICATION", (int)($w * 0.08), (int)($h * 0.18), $gold, 5);
    draw_text_block($img, "4 NIVEAUX", (int)($w * 0.08), (int)($h * 0.27), $white, 6);

    imagefilledrectangle($img, (int)($w * 0.08), (int)($h * 0.34), (int)($w * 0.25), (int)($h * 0.345), $gold);

    // Niveaux
    $bronze = imagecolorallocate($img, 205, 127, 50);
    $silver = imagecolorallocate($img, 192, 192, 220);
    $gold_c = imagecolorallocate($img, 255, 215, 0);
    $diamond = imagecolorallocate($img, 185, 242, 255);

    draw_cert_level($img, (int)($w * 0.08), (int)($h * 0.40), "BRONZE", "Fondamentaux", $bronze, $white);
    draw_cert_level($img, (int)($w * 0.08), (int)($h * 0.50), "ARGENT", "Approfondissement", $silver, $white);
    draw_cert_level($img, (int)($w * 0.08), (int)($h * 0.60), "OR", "Expertise avancee", $gold_c, $white);
    draw_cert_level($img, (int)($w * 0.08), (int)($h * 0.70), "DIAMANT", "Maitrise complete", $diamond, $white);

    // Panneau droit - Avantages
    $panel2 = imagecolorallocatealpha($img, 10, 20, 50, 55);
    imagefilledrectangle($img, (int)($w * 0.65), (int)($h * 0.12), (int)($w * 0.95), (int)($h * 0.88), $panel2);

    draw_text_block($img, "AVANTAGES", (int)($w * 0.68), (int)($h * 0.18), $gold, 5);
    imagefilledrectangle($img, (int)($w * 0.68), (int)($h * 0.245), (int)($w * 0.82), (int)($h * 0.25), $gold);

    $green = imagecolorallocate($img, 100, 255, 150);
    draw_feature_item($img, (int)($w * 0.68), (int)($h * 0.30), "Eligible formation DPC", $green, $white);
    draw_feature_item($img, (int)($w * 0.68), (int)($h * 0.37), "Reconnue par les instances", $green, $white);
    draw_feature_item($img, (int)($w * 0.68), (int)($h * 0.44), "Certificat numerique", $green, $white);
    draw_feature_item($img, (int)($w * 0.68), (int)($h * 0.51), "Suivi de progression", $green, $white);
    draw_feature_item($img, (int)($w * 0.68), (int)($h * 0.58), "Badge competences", $green, $white);

    // Texte bottom
    draw_text_centered($img, "Formation eligible au Developpement Professionnel Continu", (int)($w * 0.5), (int)($h * 0.92), $light_blue, 4);

    return $img;
}

// =====================================================================
// FONCTIONS UTILITAIRES DE DESSIN
// =====================================================================

function draw_hexagon($img, $cx, $cy, $r, $color) {
    $points = [];
    for ($i = 0; $i < 6; $i++) {
        $angle = deg2rad(60 * $i - 30);
        $points[] = (int)($cx + $r * cos($angle));
        $points[] = (int)($cy + $r * sin($angle));
    }
    imagepolygon($img, $points, $color);
}

function draw_detailed_spine($img, $cx, $top_y, $spine_height, $num_vertebrae) {
    $vert_height = $spine_height / ($num_vertebrae * 1.3);
    $disc_height = $vert_height * 0.3;

    // Courbe en S subtile (scoliose légère)
    for ($i = 0; $i < $num_vertebrae; $i++) {
        $progress = $i / ($num_vertebrae - 1);
        $y = $top_y + $i * ($vert_height + $disc_height);

        // Courbe en S
        $offset = (int)(sin($progress * M_PI * 2) * 35);
        $x = $cx + $offset;

        // Largeur décroissante du haut vers le bas puis croissante
        $width_factor = 1.0 - abs($progress - 0.5) * 0.6;
        $vw = (int)(55 * $width_factor);
        $vh = (int)($vert_height);

        // Corps vertébral - dégradé
        for ($dy = 0; $dy < $vh; $dy++) {
            $shade = (int)(180 + ($dy / $vh) * 50);
            $alpha = (int)(40 + abs($dy - $vh/2) * 2);
            $alpha = min(100, $alpha);
            $c = imagecolorallocatealpha($img, $shade, $shade, min(255, $shade + 30), $alpha);
            imageline($img, $x - $vw, $y + $dy, $x + $vw, $y + $dy, $c);
        }

        // Contour vertébral
        $outline = imagecolorallocatealpha($img, 200, 220, 255, 60);
        imagerectangle($img, $x - $vw, $y, $x + $vw, $y + $vh, $outline);

        // Apophyses transverses
        $apo_color = imagecolorallocatealpha($img, 180, 200, 240, 70);
        $apo_len = (int)($vw * 0.7);
        $apo_y = $y + (int)($vh * 0.4);
        imagefilledrectangle($img, $x - $vw - $apo_len, $apo_y - 3, $x - $vw, $apo_y + 3, $apo_color);
        imagefilledrectangle($img, $x + $vw, $apo_y - 3, $x + $vw + $apo_len, $apo_y + 3, $apo_color);

        // Apophyse épineuse
        $spine_tip = $y + (int)($vh * 0.5);
        imageline($img, $x, $spine_tip, $x, $spine_tip + 12, $apo_color);

        // Disque intervertébral
        if ($i < $num_vertebrae - 1) {
            $disc_c = imagecolorallocatealpha($img, 100, 150, 220, 70);
            $disc_y = $y + $vh;
            imagefilledellipse($img, $x, $disc_y + (int)($disc_height / 2), $vw * 2 - 10, (int)($disc_height), $disc_c);
        }
    }
}

function draw_scoliosis_spine_3d($img, $cx, $top_y, $spine_height, $num_vertebrae) {
    $vert_height = $spine_height / ($num_vertebrae * 1.25);
    $disc_height = $vert_height * 0.25;

    for ($i = 0; $i < $num_vertebrae; $i++) {
        $progress = $i / ($num_vertebrae - 1);
        $y = $top_y + $i * ($vert_height + $disc_height);

        // Courbure scoliotique prononcée
        $offset = (int)(sin($progress * M_PI * 1.8 - 0.3) * 60);
        $x = $cx + $offset;

        $width_factor = 0.7 + abs(sin($progress * M_PI)) * 0.3;
        $vw = (int)(40 * $width_factor);
        $vh = (int)($vert_height);

        // Corps vertébral avec effet 3D
        for ($dy = 0; $dy < $vh; $dy++) {
            $shade_r = (int)(40 + ($dy / $vh) * 40);
            $shade_g = (int)(80 + ($dy / $vh) * 60);
            $shade_b = (int)(150 + ($dy / $vh) * 50);
            $c = imagecolorallocatealpha($img, $shade_r, $shade_g, $shade_b, 30);
            imageline($img, $x - $vw, $y + $dy, $x + $vw, $y + $dy, $c);
        }

        // Glow néon autour de la vertèbre
        $glow = imagecolorallocatealpha($img, 0, 200, 255, 100);
        imagerectangle($img, $x - $vw - 1, $y - 1, $x + $vw + 1, $y + $vh + 1, $glow);

        // Apophyses transverses (style wireframe 3D)
        $wire = imagecolorallocatealpha($img, 0, 180, 255, 80);
        $apo_len = (int)($vw * 0.8);
        $apo_y = $y + (int)($vh * 0.45);
        imageline($img, $x - $vw, $apo_y, $x - $vw - $apo_len, $apo_y - 5, $wire);
        imageline($img, $x + $vw, $apo_y, $x + $vw + $apo_len, $apo_y - 5, $wire);
        imagefilledellipse($img, $x - $vw - $apo_len, $apo_y - 5, 8, 8, $wire);
        imagefilledellipse($img, $x + $vw + $apo_len, $apo_y - 5, 8, 8, $wire);

        // Disque intervertébral
        if ($i < $num_vertebrae - 1) {
            $disc_c = imagecolorallocatealpha($img, 0, 150, 200, 60);
            $disc_y = $y + $vh + (int)($disc_height / 2);
            imagefilledellipse($img, $x, $disc_y, $vw * 2 - 8, (int)($disc_height), $disc_c);
        }
    }
}

function draw_perspective_grid($img, $w, $h) {
    $grid_color = imagecolorallocatealpha($img, 0, 100, 200, 110);
    // Lignes horizontales
    for ($y = $h * 0.3; $y < $h; $y += 40) {
        imageline($img, 0, (int)$y, $w, (int)$y, $grid_color);
    }
    // Lignes verticales convergeant vers le haut
    $vanish_x = $w / 2;
    $vanish_y = $h * 0.1;
    for ($x = 0; $x < $w; $x += 80) {
        imageline($img, $x, $h, (int)$vanish_x, (int)$vanish_y, $grid_color);
    }
}

function draw_text_block($img, $text, $x, $y, $color, $size) {
    $font_size = $size * 4;
    // Use built-in font (1-5)
    $gd_font = min(5, max(1, $size));

    // Simulate large text by scaling
    if ($size >= 6) {
        // Draw each character larger
        $chars = str_split($text);
        $char_w = imagefontwidth(5) * 2;
        $char_h = imagefontheight(5) * 2;
        foreach ($chars as $i => $ch) {
            // Create temp image for char
            $tmp = imagecreatetruecolor($char_w, $char_h);
            $bg = imagecolorallocate($tmp, 0, 0, 0);
            imagefilledrectangle($tmp, 0, 0, $char_w, $char_h, $bg);
            imagecolortransparent($tmp, $bg);
            imagestring($tmp, 5, 0, 0, $ch, $color);
            $scaled = imagescale($tmp, $char_w, $char_h, IMG_NEAREST_NEIGHBOUR);
            imagecopy($img, $scaled, $x + $i * ($char_w - 4), $y, 0, 0, $char_w, $char_h);
            imagedestroy($tmp);
            imagedestroy($scaled);
        }
    } elseif ($size >= 4) {
        $char_w = (int)(imagefontwidth(5) * 1.5);
        $char_h = (int)(imagefontheight(5) * 1.5);
        $chars = str_split($text);
        foreach ($chars as $i => $ch) {
            $tmp = imagecreatetruecolor(imagefontwidth(5), imagefontheight(5));
            $bg = imagecolorallocate($tmp, 0, 0, 0);
            imagefilledrectangle($tmp, 0, 0, imagefontwidth(5), imagefontheight(5), $bg);
            imagecolortransparent($tmp, $bg);
            imagestring($tmp, 5, 0, 0, $ch, $color);
            $scaled = imagescale($tmp, $char_w, $char_h, IMG_NEAREST_NEIGHBOUR);
            imagecopy($img, $scaled, $x + $i * ($char_w - 2), $y, 0, 0, $char_w, $char_h);
            imagedestroy($tmp);
            imagedestroy($scaled);
        }
    } else {
        imagestring($img, $gd_font, $x, $y, $text, $color);
    }
}

function draw_text_centered($img, $text, $cx, $y, $color, $size) {
    $gd_font = min(5, max(1, $size));
    if ($size >= 6) {
        $char_w = imagefontwidth(5) * 2 - 4;
    } elseif ($size >= 4) {
        $char_w = (int)(imagefontwidth(5) * 1.5 - 2);
    } else {
        $char_w = imagefontwidth($gd_font);
    }
    $text_width = strlen($text) * $char_w;
    $x = $cx - (int)($text_width / 2);
    draw_text_block($img, $text, $x, $y, $color, $size);
}

function draw_stat_box($img, $x, $y, $number, $label, $num_color, $label_color) {
    // Cadre
    $border = imagecolorallocatealpha($img, 100, 180, 255, 80);
    imagefilledrectangle($img, $x, $y, $x + 100, $y + 80, imagecolorallocatealpha($img, 0, 30, 80, 70));
    imagerectangle($img, $x, $y, $x + 100, $y + 80, $border);

    draw_text_block($img, $number, $x + 15, $y + 10, $num_color, 6);
    draw_text_block($img, $label, $x + 15, $y + 50, $label_color, 2);
}

function draw_badge($img, $x, $y, $text, $color) {
    imagefilledellipse($img, $x, $y, 80, 80, $color);
    $dark = imagecolorallocate($img, 40, 30, 0);
    draw_text_centered($img, $text, $x, $y - 7, $dark, 5);
}

function draw_feature_item($img, $x, $y, $text, $bullet_color, $text_color) {
    imagefilledellipse($img, $x + 6, $y + 7, 10, 10, $bullet_color);
    imagestring($img, 4, $x + 18, $y, $text, $text_color);
}

function draw_param_line($img, $x, $y, $label, $value, $label_color, $value_color) {
    imagestring($img, 3, $x, $y, $label, $label_color);
    imagestring($img, 4, $x + 120, $y, $value, $value_color);
}

function draw_cert_level($img, $x, $y, $level, $desc, $level_color, $desc_color) {
    // Médaille
    imagefilledellipse($img, $x + 15, $y + 12, 25, 25, $level_color);
    // Texte niveau
    draw_text_block($img, $level, $x + 35, $y, $level_color, 4);
    // Description
    imagestring($img, 3, $x + 35, $y + 22, $desc, $desc_color);
}

function draw_laurel_wreath($img, $cx, $cy, $radius) {
    $leaf_color = imagecolorallocatealpha($img, 200, 180, 80, 80);
    for ($i = 0; $i < 24; $i++) {
        $angle = deg2rad($i * 15 + 10);
        $lx = (int)($cx + $radius * cos($angle));
        $ly = (int)($cy + $radius * sin($angle));
        // Feuille simple
        imagefilledellipse($img, $lx, $ly, 20, 8, $leaf_color);
    }
}

// =====================================================================
// GÉNÉRATION ET UPLOAD
// =====================================================================

echo "=== Generation des images slider professionnelles ===\n\n";

$slides = [
    1 => ['func' => 'create_slide1', 'file' => 'slide_formation.jpg'],
    2 => ['func' => 'create_slide2', 'file' => 'slide_spinesim.jpg'],
    3 => ['func' => 'create_slide3', 'file' => 'slide_certification.jpg'],
];

$fs = get_file_storage();
$context = context_system::instance();

foreach ($slides as $num => $slide) {
    echo "Slide $num: Generation...\n";

    // Créer l'image
    $func = $slide['func'];
    $img = $func($width, $height);

    // Sauvegarder en JPEG
    $tmpfile = tempnam(sys_get_temp_dir(), 'slide') . '.jpg';
    imagejpeg($img, $tmpfile, 95);
    imagedestroy($img);

    $filesize = filesize($tmpfile);
    echo "  Taille: " . round($filesize / 1024) . " Ko\n";

    // Supprimer l'ancien fichier
    $area = 'sliderimage' . $num;
    $old_files = $fs->get_area_files($context->id, 'theme_moove', $area, 0, 'id', false);
    foreach ($old_files as $f) {
        echo "  Suppression ancien: {$f->get_filename()}\n";
        $f->delete();
    }

    // Uploader le nouveau
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
    echo "  Upload OK: {$slide['file']}\n\n";
}

// Purger le cache du thème
echo "Purge du cache theme...\n";
theme_reset_all_caches();
purge_all_caches();

echo "\n=== TERMINE ===\n";
echo "Les 3 slides professionnels ont ete generes et uploades.\n";
echo "Rechargez la page: http://localhost:8890/\n";
