<?php
/**
 * VERTEX© — Correction entrée dupliquée block_vertex_dashboard
 */
define('CLI_SCRIPT', true);
require(__DIR__ . '/config.php');

// Supprimer l'entrée insérée manuellement pour laisser Moodle upgrade la recréer proprement
$existing = $DB->get_record('block', ['name' => 'vertex_dashboard']);
if ($existing) {
    $DB->delete_records('block', ['name' => 'vertex_dashboard']);
    echo "[OK] Entrée supprimée de mdl_block (id={$existing->id})\n";
} else {
    echo "[INFO] Entrée déjà absente\n";
}

purge_all_caches();
echo "[OK] Cache vidé\n";
echo "\nMaintenant : recharger https://doctraining.ma/admin/index.php et cliquer Continuer\n";
