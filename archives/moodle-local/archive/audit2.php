<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');

echo "=== AUDIT BLOCS ET VUES ===" . PHP_EOL . PHP_EOL;

// Tous les blocs
echo "--- TOUS LES BLOCS INSTALLES ---" . PHP_EOL;
$blocks = $DB->get_records_sql("
    SELECT bi.id, bi.blockname, bi.defaultregion, bi.defaultweight, bi.visible, 
           bi.pagetypepattern, bi.parentcontextid
    FROM {block_instances} bi
    ORDER BY bi.parentcontextid, bi.defaultregion, bi.defaultweight
");
foreach ($blocks as $b) {
    $vis = $b->visible ? 'VIS' : 'HID';
    echo "  [$vis] ctx=$b->parentcontextid | $b->blockname | region=$b->defaultregion | page=$b->pagetypepattern" . PHP_EOL;
}

echo PHP_EOL . "--- CONTEXTS ---" . PHP_EOL;
$contexts = $DB->get_records_sql("SELECT id, contextlevel, instanceid, path FROM {context} WHERE contextlevel IN (10, 50) ORDER BY id LIMIT 10");
foreach ($contexts as $c) {
    $level = $c->contextlevel == 10 ? 'SYSTEM' : 'COURSE';
    echo "  ctx=$c->id | $level | instance=$c->instanceid" . PHP_EOL;
}

echo PHP_EOL . "--- FRONTPAGE CONFIG ---" . PHP_EOL;
echo "  frontpage = '" . get_config('', 'frontpage') . "'" . PHP_EOL;
echo "  frontpageloggedin = '" . get_config('', 'frontpageloggedin') . "'" . PHP_EOL;
echo "  defaulthomepage = '" . get_config('', 'defaulthomepage') . "'" . PHP_EOL;

echo PHP_EOL . "=== FIN ===" . PHP_EOL;
