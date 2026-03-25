<?php
/**
 * VERTEX© — Cache tous les cours sauf Scoliose (ID=2)
 * Scoliose est le seul cours avec du vrai contenu développé.
 */
define('CLI_SCRIPT', true);
require(__DIR__ . '/config.php');

// IDs à cacher (contenu CDC, pas encore développé)
$to_hide = [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];

foreach ($to_hide as $id) {
    $course = $DB->get_record('course', ['id' => $id], 'id, fullname, visible');
    if (!$course) {
        echo "[SKIP] ID=$id introuvable\n";
        continue;
    }
    if ($course->visible == 0) {
        echo "[INFO] ID=$id déjà caché — {$course->fullname}\n";
        continue;
    }
    $DB->set_field('course', 'visible', 0, ['id' => $id]);
    echo "[OK] Caché — {$course->fullname}\n";
}

// Confirmer que scoliose reste visible
$scol = $DB->get_record('course', ['id' => 2], 'id, fullname, visible');
echo "\n[CHECK] Scoliose (ID=2) visible={$scol->visible} — {$scol->fullname}\n";

purge_all_caches();
echo "\n=== Terminé : " . count($to_hide) . " cours cachés, scoliose en ligne ===\n";
