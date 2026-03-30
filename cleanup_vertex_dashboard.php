<?php
/**
 * VERTEX© — Nettoyage bloc vertex_dashboard cassé
 */
define('CLI_SCRIPT', true);
require(__DIR__ . '/config.php');

// Supprimer les entrées en base
$DB->delete_records('block', ['name' => 'vertex_dashboard']);
$DB->delete_records('block_instances', ['blockname' => 'vertex_dashboard']);
echo "[OK] Entrées base supprimées\n";

// Supprimer le répertoire du bloc
$block_dir = $CFG->dirroot . '/blocks/vertex_dashboard';
if (is_dir($block_dir)) {
    array_map('unlink', glob("$block_dir/lang/fr/*"));
    @rmdir("$block_dir/lang/fr");
    @rmdir("$block_dir/lang");
    array_map('unlink', glob("$block_dir/*"));
    @rmdir($block_dir);
    echo "[OK] Répertoire $block_dir supprimé\n";
} else {
    echo "[INFO] Répertoire déjà absent\n";
}

purge_all_caches();
echo "[OK] Cache vidé\n";
echo "=== Nettoyage terminé ===\n";
