<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
global $DB;

$pages = $DB->get_records('page');

// First, let's see what's actually in the page content around "gibbosité"
foreach ($pages as $page) {
    if (strpos($page->content, 'gibbosit') !== false) {
        echo "=== Page ID=" . $page->id . " (" . $page->name . ") ===\n";
        // Extract 200 chars around each match
        $pos = 0;
        while (($pos = strpos($page->content, 'gibbosit', $pos)) !== false) {
            $start = max(0, $pos - 100);
            $len = min(300, strlen($page->content) - $start);
            echo "--- Match at pos $pos ---\n";
            echo substr($page->content, $start, $len) . "\n\n";
            $pos += 10;
        }
    }
}
