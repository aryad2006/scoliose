<?php
/**
 * Correction LLA/LLP → LVCA/LVCP dans Moodle
 * Les abréviations LLA et LLP n'existent pas en nomenclature médicale.
 * Correct : LVCA (lig. vertébral commun antérieur) / LVCP (lig. vertébral commun postérieur)
 */
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
global $DB;

$pages = $DB->get_records('page', [], '', 'id, name, content');
$updated = 0;

foreach ($pages as $page) {
    $content = $page->content;
    $original = $content;

    // Remplacer LLA par LVCA avec nom complet
    $content = str_replace(
        '<strong>LLA</strong>',
        '<strong>LVCA</strong><br><small>(lig. vertébral commun antérieur)</small>',
        $content
    );
    $content = str_replace(
        'LLA (vert)',
        'LVCA (vert)',
        $content
    );
    // Cas texte simple
    $content = preg_replace('/\bLLA\b(?!<)/', 'LVCA', $content);

    // Remplacer LLP par LVCP avec nom complet
    $content = str_replace(
        '<strong>LLP</strong>',
        '<strong>LVCP</strong><br><small>(lig. vertébral commun postérieur)</small>',
        $content
    );
    $content = str_replace(
        'LLP (rouge)',
        'LVCP (rouge)',
        $content
    );
    $content = preg_replace('/\bLLP\b(?!<)/', 'LVCP', $content);

    if ($content !== $original) {
        $DB->update_record('page', (object)[
            'id' => $page->id,
            'content' => $content,
            'timemodified' => time()
        ]);
        $updated++;
        echo "✅ Page {$page->id} ({$page->name}) mise à jour\n";
    }
}

echo "\n📊 Total : {$updated} page(s) corrigée(s)\n";
purge_all_caches();
echo "🔄 Caches purgés\n";
