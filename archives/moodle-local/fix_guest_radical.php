<?php
/**
 * Solution radicale : remettre forcelogin=0 + empêcher le guest
 * 
 * Le mécanisme Moodle : quand forcelogin=0 et qu'un visiteur arrive
 * sur la frontpage, Moodle appelle require_login() avec le paramètre
 * $autologinguest=true sur la frontpage. Cela crée une session guest.
 * 
 * La VRAIE solution : modifier le fichier index.php de Moodle pour
 * passer $autologinguest=false à require_login() sur la frontpage.
 * Ou plus simple : utiliser un local plugin qui hook le before_require_login
 * 
 * Approche la plus simple et sans modification de code Moodle :
 * En fait, dans Moodle 4.5, le paramètre de la frontpage est géré
 * dans /index.php ligne ~40 : require_login(null, true/false);
 * Le 2è paramètre = autologinguest
 * 
 * On va patcher index.php pour mettre autologinguest=false
 */

define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
global $DB, $CFG;

echo "\n=== PATCH INDEX.PHP POUR DESACTIVER AUTO-GUEST ===\n\n";

// 1. Remettre forcelogin=0 (la frontpage doit rester accessible)
set_config('forcelogin', 0);
echo "✓ forcelogin = 0\n";

// 2. Supprimer toutes les sessions existantes 
$DB->delete_records('sessions');
echo "✓ Toutes les sessions supprimées\n";

// 3. Lire le fichier index.php
$indexfile = '/var/www/html/index.php';
$content = file_get_contents($indexfile);

// 4. Chercher l'appel require_login sur la frontpage
// Dans Moodle 4.5, c'est : require_login(null, true, ...
// Le 2ème paramètre 'true' = autologinguest
// On veut le mettre à 'false'
if (strpos($content, 'require_login') !== false) {
    echo "Fichier index.php :\n";
    
    // Trouver toutes les lignes avec require_login
    $lines = explode("\n", $content);
    foreach ($lines as $num => $line) {
        if (strpos($line, 'require_login') !== false) {
            echo "  Ligne " . ($num+1) . ": " . trim($line) . "\n";
        }
    }
}

// 5. Faire le patch : remplacer le 2ème argument de require_login 
// de true à false sur la frontpage
$patched = false;

// Pattern 1: require_login(null, true) ou require_login(null, true, ...)
if (preg_match('/require_login\s*\(\s*null\s*,\s*true/', $content)) {
    $new_content = preg_replace(
        '/require_login\s*\(\s*null\s*,\s*true/',
        'require_login(null, false',
        $content,
        1
    );
    $patched = true;
}

// Pattern 2: require_login(0, true) ou require_login(0, true, ...)  
elseif (preg_match('/require_login\s*\(\s*0\s*,\s*true/', $content)) {
    $new_content = preg_replace(
        '/require_login\s*\(\s*0\s*,\s*true/',
        'require_login(0, false',
        $content,
        1
    );
    $patched = true;
}

// Pattern 3: peut-être que le index.php n'appelle pas require_login directement
// Regardons isloggedin()
elseif (preg_match('/isloggedin\(\)/', $content)) {
    echo "\n  index.php utilise isloggedin() au lieu de require_login()\n";
    echo "  Approche alternative nécessaire\n";
}

if ($patched) {
    // Sauvegarder le fichier original
    copy($indexfile, $indexfile . '.bak');
    file_put_contents($indexfile, $new_content);
    echo "\n✓ index.php patché : autologinguest=false\n";
    echo "  Backup sauvé dans index.php.bak\n";
} else {
    echo "\n  Pattern require_login non trouvé dans index.php\n";
    echo "  Affichage des 60 premières lignes :\n";
    $lines = explode("\n", $content);
    for ($i = 0; $i < min(60, count($lines)); $i++) {
        echo "  " . ($i+1) . ": " . $lines[$i] . "\n";
    }
}

// 6. Purger les caches
$newrev = time();
set_config('themerev', $newrev);
set_config('jsrev', $newrev);
set_config('templaterev', $newrev);
purge_all_caches();
echo "\n✓ Caches purgés (rev=$newrev)\n";

echo "\n=== FAIT ===\n";
echo "  Ouvrez une fenêtre de navigation privée (Cmd+Shift+N)\n";
echo "  et allez sur http://localhost:8890/\n\n";
