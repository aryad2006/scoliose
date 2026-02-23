<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');

echo "=== AUDIT COMPLET DES ROUTES ET VUES ===" . PHP_EOL . PHP_EOL;

// 1. Config frontpage
echo "--- CONFIG FRONTPAGE ---" . PHP_EOL;
$keys = ['frontpage', 'frontpageloggedin', 'defaulthomepage', 'forcelogin',
         'enablecalendarexport', 'enabledashboard', 'frontpagerequirelogin'];
foreach ($keys as $k) {
    echo "  $k = " . var_export(get_config('', $k), true) . PHP_EOL;
}

// 2. Blocs sur la page d'accueil (course id=1 = site)
echo PHP_EOL . "--- BLOCS SUR LA FRONTPAGE (course=1) ---" . PHP_EOL;
$blocks = $DB->get_records_sql("
    SELECT bi.id, bi.blockname, bi.defaultregion, bi.defaultweight, bi.visible,
           bi.pagetypepattern, bp.contextid
    FROM {block_instances} bi
    LEFT JOIN {block_positions} bp ON bp.blockinstanceid = bi.id
    WHERE bi.parentcontextid = (SELECT id FROM {context} WHERE contextlevel = 50 AND instanceid = 1)
    ORDER BY bi.defaultregion, bi.defaultweight
");
foreach ($blocks as $b) {
    $vis = $b->visible ? 'VISIBLE' : 'CACHE';
    echo "  [$vis] $b->blockname | region=$b->defaultregion | pattern=$b->pagetypepattern" . PHP_EOL;
}

// 3. Blocs systeme (context system)
echo PHP_EOL . "--- BLOCS SYSTEME (context=1) ---" . PHP_EOL;
$sysblocks = $DB->get_records_sql("
    SELECT bi.id, bi.blockname, bi.defaultregion, bi.visible, bi.pagetypepattern
    FROM {block_instances} bi
    WHERE bi.parentcontextid = 1
    ORDER BY bi.defaultregion
");
foreach ($sysblocks as $b) {
    $vis = $b->visible ? 'VISIBLE' : 'CACHE';
    echo "  [$vis] $b->blockname | region=$b->defaultregion | pattern=$b->pagetypepattern" . PHP_EOL;
}

// 4. Blocs sur my-index (dashboard)
echo PHP_EOL . "--- BLOCS DASHBOARD (my-index) ---" . PHP_EOL;
$dashblocks = $DB->get_records_sql("
    SELECT bi.id, bi.blockname, bi.defaultregion, bi.visible, bi.pagetypepattern
    FROM {block_instances} bi
    WHERE bi.pagetypepattern LIKE '%my%'
    ORDER BY bi.defaultregion
");
foreach ($dashblocks as $b) {
    $vis = $b->visible ? 'VISIBLE' : 'CACHE';
    echo "  [$vis] $b->blockname | region=$b->defaultregion | pattern=$b->pagetypepattern" . PHP_EOL;
}

// 5. Roles et permissions pour guest
echo PHP_EOL . "--- ROLE GUEST ---" . PHP_EOL;
$guestrole = $DB->get_record('role', ['shortname' => 'guest']);
echo "  Guest role id = $guestrole->id" . PHP_EOL;

// Verifier si guest peut voir le calendrier, timeline etc
$caps = ['block/calendar_month:myaddinstance', 'block/timeline:myaddinstance',
         'block/recentlyaccessedcourses:myaddinstance', 'moodle/course:view'];
foreach ($caps as $cap) {
    $perm = $DB->get_record('role_capabilities', ['roleid' => $guestrole->id, 'capability' => $cap]);
    if ($perm) {
        echo "  $cap = $perm->permission" . PHP_EOL;
    } else {
        echo "  $cap = (non defini)" . PHP_EOL;
    }
}

// 6. Page summary
echo PHP_EOL . "--- SUMMARY SITE ---" . PHP_EOL;
$site = $DB->get_record('course', ['id' => 1]);
echo "  fullname: $site->fullname" . PHP_EOL;
echo "  shortname: $site->shortname" . PHP_EOL;
echo "  summary (100 premiers chars): " . substr(strip_tags($site->summary), 0, 100) . PHP_EOL;

echo PHP_EOL . "=== FIN AUDIT ===" . PHP_EOL;
