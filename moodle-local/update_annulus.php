<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
global $DB;

// Find the page module that contains the annulus fibrosus text
$pages = $DB->get_records('page');
$updated = 0;

foreach ($pages as $page) {
    if (strpos($page->content, '±30°') !== false) {
        $page->content = str_replace(
            '15-25 lamelles concentriques, collagène type I ±30°</td><td>Résistance traction/torsion',
            '15-25 lamelles concentriques de collagène type I, fibres orientées en croisillon (alternance +30° / −30° d\'une lamelle à l\'autre, comme du contreplaqué)</td><td>Résistance à la traction, torsion, cisaillement',
            $page->content
        );
        $DB->update_record('page', $page);
        $updated++;
        echo "Page mise à jour: ID=" . $page->id . " (" . $page->name . ")\n";
    }
}

if ($updated == 0) {
    echo "Aucune page contenant '±30°' trouvée.\n";
} else {
    purge_all_caches();
    echo "Caches purgées. $updated page(s) corrigée(s).\n";
}
