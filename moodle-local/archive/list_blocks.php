<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
$r = $DB->get_records('block_instances', array(), 'id ASC', 'id,blockname,parentcontextid,pagetypepattern,defaultregion,visible');
foreach ($r as $b) {
    echo $b->id . ',' . $b->blockname . ',ctx=' . $b->parentcontextid . ',page=' . $b->pagetypepattern . ',region=' . $b->defaultregion . ',vis=' . $b->visible . "\n";
}
