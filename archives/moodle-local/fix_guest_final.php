<?php
/**
 * Correction définitive du problème "Vous êtes connecté anonymement"
 * 
 * Le problème : Moodle crée automatiquement une session "guest" pour les
 * visiteurs de la frontpage. Cette session persiste dans le navigateur.
 * 
 * Solution :
 * 1. Supprimer toutes les sessions guest
 * 2. Activer forcelogin=1 (empêche les sessions guest automatiques)
 * 3. La frontpage reste accessible sans login (comportement natif de forcelogin)
 * 4. Les visiteurs voient "Connexion" au lieu de "Connecté anonymement"
 */

define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
global $DB, $CFG;

echo "\n=== CORRECTION DEFINITIVE GUEST ===\n\n";

// 1. Supprimer TOUTES les sessions guest (userid=1)
$deleted = $DB->delete_records('sessions', ['userid' => 1]);
echo "✓ Sessions guest supprimées : $deleted\n";

// 2. Supprimer aussi les sessions sans userid (sessions mortes)
$deleted0 = $DB->delete_records('sessions', ['userid' => 0]);
echo "✓ Sessions sans utilisateur supprimées : $deleted0\n";

// 3. forcelogin=1 — Empêche Moodle de créer des sessions guest automatiques
// IMPORTANT: avec forcelogin=1, la FRONTPAGE reste accessible sans login
// C'est le comportement natif documenté de Moodle
set_config('forcelogin', 1);
echo "✓ forcelogin = 1 (plus de sessions guest auto)\n";

// 4. Garder les autres paramètres guest désactivés
set_config('guestloginbutton', 0);
set_config('autologinguests', 0);
set_config('allowguestmymoodle', 0);
echo "✓ guestloginbutton=0, autologinguests=0, allowguestmymoodle=0\n";

// 5. frontpage vide (pas de liste de cours etc.)
set_config('frontpage', '');
set_config('frontpageloggedin', '');
echo "✓ frontpage et frontpageloggedin = vide\n";

// 6. Dashboard après login
set_config('defaulthomepage', 1);
echo "✓ defaulthomepage = 1 (Dashboard après connexion)\n";

// 7. Purger tous les caches
$newrev = time();
set_config('themerev', $newrev);
set_config('jsrev', $newrev);
set_config('templaterev', $newrev);
set_config('langrev', $newrev);
purge_all_caches();
echo "✓ Tous les caches purgés (rev=$newrev)\n";

// Vérification
echo "\n--- VÉRIFICATION ---\n";
echo "forcelogin = " . get_config('core', 'forcelogin') . "\n";
echo "guestloginbutton = " . get_config('core', 'guestloginbutton') . "\n";
echo "autologinguests = " . get_config('core', 'autologinguests') . "\n";
echo "Sessions guest restantes = " . $DB->count_records('sessions', ['userid' => 1]) . "\n";
echo "Sessions totales = " . $DB->count_records('sessions') . "\n";

echo "\n=== IMPORTANT ===\n";
echo "Dans votre navigateur :\n";
echo "  1. Cmd+Shift+Suppr → Supprimer les cookies pour localhost:8890\n";
echo "  2. OU ouvrir une fenêtre de navigation privée (Cmd+Shift+N)\n";
echo "  3. Aller sur http://localhost:8890/\n";
echo "  Vous devrez voir 'Connexion' (pas 'connecté anonymement')\n\n";
