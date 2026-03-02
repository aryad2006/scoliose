<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
global $DB;

// Fix page ID=3
$page = $DB->get_record('page', ['id' => 3]);

// Replace the old text about rotation
$oldText = 'autorise la rotation vertébrale — la rotation est le mécanisme de la <strong>gibbosité</strong>.';
$newText = 'La rotation vertébrale est présente dans <strong>toute</strong> scoliose (thoracique, lombaire, thoraco-lombaire) — c\'est le 3ᵉ plan de la déformation tridimensionnelle. Les facettes thoraciques (plan frontal) <strong>facilitent</strong> la rotation (souvent 20-40°), alors que les facettes lombaires (plan sagittal) la <strong>limitent</strong> (10-20°). Au thoracique, la rotation entraîne les côtes → <strong>gibbosité costale</strong> ; au lombaire, elle produit une <strong>voussure paravertébrale</strong> (bourrelet musculaire palpable à la flexion antérieure).';

if (strpos($page->content, $oldText) !== false) {
    $page->content = str_replace($oldText, $newText, $page->content);
    $DB->update_record('page', $page);
    echo "Page 3 corrigée: rotation/gibbosité\n";
} else {
    echo "Texte non trouvé dans page 3, tentative regex...\n";
    // Try broader match
    $page->content = preg_replace(
        '/autorise la rotation vert[^<]*<strong>gibbosit[^<]*<\/strong>\./u',
        $newText,
        $page->content,
        1,
        $count
    );
    if ($count > 0) {
        $DB->update_record('page', $page);
        echo "Page 3 corrigée via regex\n";
    } else {
        echo "ECHEC: pattern non trouvé\n";
    }
}

// Also fix page ID=6 which mentions facettes → gibbosité
$page6 = $DB->get_record('page', ['id' => 6]);
$old6 = 'explique la rotation vertébrale et la gibbosité';
$new6 = 'facilite la rotation vertébrale (mais la rotation existe aussi au lombaire, avec une voussure paravertébrale au lieu d\'une gibbosité costale)';
if (strpos($page6->content, $old6) !== false) {
    $page6->content = str_replace($old6, $new6, $page6->content);
    $DB->update_record('page', $page6);
    echo "Page 6 corrigée aussi\n";
}

purge_all_caches();
echo "Caches purgées.\n";
