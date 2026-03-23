#!/usr/bin/env php
<?php
/**
 * VERTEX© — Import générique d'un quiz dans Moodle via CLI.
 *
 * Usage :
 *   php import_quiz_generic.php <xml_file> <course_id> <quiz_name>
 *
 * Exemple :
 *   php import_quiz_generic.php quiz_hta.xml 7 "Quiz HTA - VERTEX"
 */

define('CLI_SCRIPT', true);

if ($argc < 4) {
    echo "Usage : php import_quiz_generic.php <xml_file> <course_id> <quiz_name>\n";
    exit(1);
}

$xml_file   = $argv[1];
$course_id  = (int)$argv[2];
$quiz_name  = $argv[3];

$moodledir = dirname(__FILE__);
require_once($moodledir . '/config.php');
require_once($CFG->libdir . '/accesslib.php');
require_once($CFG->libdir . '/questionlib.php');
require_once($CFG->dirroot . '/question/format.php');
require_once($CFG->dirroot . '/question/format/xml/format.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/mod/quiz/lib.php');
require_once($CFG->dirroot . '/mod/quiz/locallib.php');

// Forcer admin
$USER = $DB->get_record('user', ['id' => 2]);
\core\session\manager::set_user($USER);

echo "\n  ═══════════════════════════════════════════════════\n";
echo "  VERTEX© — Import Quiz Générique\n";
echo "  ═══════════════════════════════════════════════════\n\n";

// ── Vérifications ──
$xml_path = $moodledir . '/' . $xml_file;
if (!file_exists($xml_path)) {
    echo "[ERR] Fichier XML introuvable : $xml_path\n";
    exit(1);
}
echo "  [OK] XML : $xml_file\n";

$course = $DB->get_record('course', ['id' => $course_id]);
if (!$course) {
    echo "[ERR] Cours id=$course_id introuvable.\n";
    $all = $DB->get_records('course', null, 'id', 'id, shortname, fullname');
    foreach ($all as $c) echo "  id={$c->id} | {$c->shortname} | {$c->fullname}\n";
    exit(1);
}
echo "  [OK] Cours : {$course->fullname} (id={$course->id})\n";

$context = context_course::instance($course->id);

// ── Étape 1 : Import des questions ──
echo "\n  [*] Import des questions...\n";

$category = question_get_default_category($context->id);
if (!$category) {
    question_make_default_categories(array($context));
    $category = question_get_default_category($context->id);
}

$qformat = new qformat_xml();
$qformat->setCategory($category);
$qformat->setContexts(array($context));
$qformat->setCourse($course);
$qformat->setFilename($xml_path);
$qformat->setRealfilename(basename($xml_path));
$qformat->setCatfromfile(true);
$qformat->setMatchgrades('nearest');
$qformat->setStoponerror(false);

$qformat->importpreprocess();
$lines = explode("\n", file_get_contents($xml_path));
$questions = $qformat->readquestions($lines);

if (empty($questions)) {
    echo "  [ERR] Aucune question parsée.\n";
    exit(1);
}

$nq = count(array_filter($questions, function($q) { return $q->qtype !== 'category'; }));
echo "  [OK] $nq questions parsées\n";
echo "  [*] Écriture en base...\n";
$qformat->importprocess($questions);
echo "  [OK] Questions importées\n";

// ── Étape 2 : Créer le quiz ──
$existing = $DB->get_record('quiz', ['course' => $course->id, 'name' => $quiz_name]);
if ($existing) {
    echo "  [OK] Quiz existant (id={$existing->id})\n";
    $quizid = $existing->id;
} else {
    echo "  [+] Création quiz '$quiz_name'...\n";

    $quiz = new stdClass();
    $quiz->course = $course->id;
    $quiz->name = $quiz_name;
    $quiz->intro = "<p>Quiz VERTEX© — $quiz_name</p>";
    $quiz->introformat = FORMAT_HTML;
    $quiz->timeopen = 0;
    $quiz->timeclose = 0;
    $quiz->timelimit = 0;
    $quiz->overduehandling = 'autosubmit';
    $quiz->graceperiod = 0;
    $quiz->preferredbehaviour = 'deferredfeedback';
    $quiz->canredoquestions = 0;
    $quiz->attempts = 0;
    $quiz->attemptonlast = 0;
    $quiz->grademethod = 1;
    $quiz->decimalpoints = 2;
    $quiz->questiondecimalpoints = -1;
    $quiz->questionsperpage = 1;
    $quiz->navmethod = 'free';
    $quiz->shuffleanswers = 1;
    $quiz->sumgrades = 0;
    $quiz->grade = 100;
    $quiz->timecreated = time();
    $quiz->timemodified = time();
    $quiz->password = '';
    $quiz->subnet = '';
    $quiz->browsersecurity = '-';
    $quiz->delay1 = 0;
    $quiz->delay2 = 0;
    $quiz->showuserpicture = 0;
    $quiz->showblocks = 0;
    $quiz->completionattemptsexhausted = 0;
    $quiz->completionminattempts = 0;
    $quiz->allowofflineattempts = 0;
    $quiz->reviewattempt = 0x11110;
    $quiz->reviewcorrectness = 0x11110;
    $quiz->reviewmarks = 0x11110;
    $quiz->reviewspecificfeedback = 0x11110;
    $quiz->reviewgeneralfeedback = 0x11110;
    $quiz->reviewrightanswer = 0x11110;
    $quiz->reviewoverallfeedback = 0x11110;

    $quizid = $DB->insert_record('quiz', $quiz);

    $moduleid = $DB->get_field('modules', 'id', ['name' => 'quiz']);
    $cm = new stdClass();
    $cm->course = $course->id;
    $cm->module = $moduleid;
    $cm->instance = $quizid;
    $cm->section = 0;
    $cm->visible = 1;
    $cm->visibleoncoursepage = 1;
    $cm->added = time();
    $cm->groupmode = 0;
    $cm->groupingid = 0;
    $cm->completion = 0;
    $cm->deletioninprogress = 0;
    $cmid = $DB->insert_record('course_modules', $cm);
    course_add_cm_to_section($course, $cmid, 0);
    context_module::instance($cmid);

    echo "  [OK] Quiz créé (id=$quizid, cmid=$cmid)\n";
}

// ── Étape 3 : Rattacher les questions ──
echo "  [*] Rattachement des questions...\n";

$allcats = $DB->get_records('question_categories', ['contextid' => $context->id]);
$catids = array_keys($allcats);
list($insql, $params) = $DB->get_in_or_equal($catids);

$has_qbe = $DB->get_manager()->table_exists('question_bank_entries');
if ($has_qbe) {
    $sql = "SELECT q.id, q.qtype, qbe.id as qbeid
            FROM {question} q
            JOIN {question_versions} qv ON qv.questionid = q.id
            JOIN {question_bank_entries} qbe ON qbe.id = qv.questionbankentryid
            WHERE qbe.questioncategoryid $insql AND q.qtype != 'random'
            ORDER BY q.id ASC";
    $dbquestions = $DB->get_records_sql($sql, $params);
} else {
    $dbquestions = $DB->get_records_select('question',
        "category $insql AND qtype != 'random'", $params, 'id ASC');
}

$slot_cols = $DB->get_columns('quiz_slots');
$has_qbeid_col = isset($slot_cols['questionbankentryid']);

$slot = 1;
$added = 0;

// Trouver le dernier slot existant
$maxslot = $DB->get_field_sql("SELECT MAX(slot) FROM {quiz_slots} WHERE quizid = ?", [$quizid]);
if ($maxslot) $slot = $maxslot + 1;

foreach ($dbquestions as $q) {
    if ($has_qbeid_col && isset($q->qbeid)) {
        $exists = $DB->record_exists('quiz_slots', [
            'quizid' => $quizid,
            'questionbankentryid' => $q->qbeid,
        ]);
    } else {
        $exists = $DB->record_exists('quiz_slots', [
            'quizid' => $quizid,
            'questionid' => $q->id,
        ]);
    }
    if ($exists) continue;

    try {
        $slotdata = new stdClass();
        $slotdata->quizid = $quizid;
        $slotdata->slot = $slot;
        $slotdata->page = $slot;
        $slotdata->maxmark = 1.0000000;
        if ($has_qbeid_col && isset($q->qbeid)) {
            $slotdata->questionbankentryid = $q->qbeid;
            $slotdata->questionid = $q->id;
        } else {
            $slotdata->questionid = $q->id;
        }
        if (isset($slot_cols['requireprevious'])) $slotdata->requireprevious = 0;
        if (isset($slot_cols['displaynumber'])) $slotdata->displaynumber = null;

        $DB->insert_record('quiz_slots', $slotdata);
        $added++;
        $slot++;
    } catch (Exception $e) {
        // skip
    }
}

$DB->set_field('quiz', 'sumgrades', (float)$added, ['id' => $quizid]);
if (function_exists('quiz_update_grades')) {
    quiz_update_grades($DB->get_record('quiz', ['id' => $quizid]));
}

echo "  [OK] $added questions rattachées au quiz\n";

echo "\n  ═══════════════════════════════════════════════════\n";
echo "  Quiz    : $quiz_name (id=$quizid)\n";
echo "  URL     : {$CFG->wwwroot}/mod/quiz/view.php?q=$quizid\n";
echo "  Cours   : {$CFG->wwwroot}/course/view.php?id={$course->id}\n";
echo "  ═══════════════════════════════════════════════════\n\n";
