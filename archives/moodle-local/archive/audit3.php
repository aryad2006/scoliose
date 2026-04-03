<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');

$blocks = $DB->get_records_sql('SELECT bi.id, bi.blockname, bi.defaultregion, bi.visible, bi.pagetypepattern, bi.parentcontextid FROM {block_instances} bi ORDER BY bi.parentcontextid, bi.id');

echo "=== BLOCS ===" . PHP_EOL;
foreach ($blocks as $b) {
    $v = $b->visible ? 'VIS' : 'HID';
    echo "[$v] ctx=$b->parentcontextid | $b->blockname | region=$b->defaultregion | page=$b->pagetypepattern" . PHP_EOL;
}

echo PHP_EOL . "=== CONTEXTS ===" . PHP_EOL;
$ctxs = $DB->get_records_sql('SELECT id, contextlevel, instanceid FROM {context} WHERE contextlevel IN (10,50) ORDER BY id LIMIT 10');
foreach ($ctxs as $c) {
    $lvl = ($c->contextlevel == 10) ? 'SYSTEM' : 'COURSE';
    echo "ctx=$c->id | $lvl | instance=$c->instanceid" . PHP_EOL;
}

echo PHP_EOL . "=== SITE (course=1) ===" . PHP_EOL;
$site = $DB->get_record('course', array('id' => 1));
echo "fullname=$site->fullname" . PHP_EOL;
echo "format=$site->format" . PHP_EOL;
echo "summary=" . substr(strip_tags($site->summary), 0, 80) . PHP_EOL;
