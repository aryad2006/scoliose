<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
global $DB;

$pages = $DB->get_records('page');
$updated = 0;

foreach ($pages as $page) {
    $old = 'la scoliose thoracique s';
    if (strpos($page->content, $old) !== false || strpos($page->content, 'autorise la rotation') !== false || strpos($page->content, 'mécanisme de la gibbosité') !== false) {
        // Replace the entire clinical relevance paragraph
        $oldText = '/Pertinence clinique[^<]*gibbosité\./u';
        $newText = 'Pertinence clinique — Rotation et scoliose : La rotation vertébrale est présente dans <strong>toute</strong> scoliose (thoracique, lombaire ou thoraco-lombaire) — c\'est le 3ᵉ plan de la déformation tridimensionnelle. Cependant, les facettes thoraciques (plan frontal) <strong>facilitent</strong> la rotation, qui atteint souvent 20-40° au thoracique contre 10-20° au lombaire (facettes sagittales plus restrictives). Au niveau thoracique, la rotation entraîne les côtes et produit la <strong>gibbosité costale</strong> ; au niveau lombaire, elle provoque une <strong>voussure paravertébrale</strong> (bourrelet musculaire palpable à la flexion antérieure).';
        
        $page->content = preg_replace($oldText, $newText, $page->content);
        $DB->update_record('page', $page);
        $updated++;
        echo "Page mise à jour: ID=" . $page->id . " (" . $page->name . ")\n";
    }
}

if ($updated == 0) {
    echo "Aucune page concernée trouvée.\n";
} else {
    purge_all_caches();
    echo "Caches purgées. $updated page(s) corrigée(s).\n";
}
