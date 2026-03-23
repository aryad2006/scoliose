#!/usr/bin/env php
<?php
/**
 * VERTEX© — Création de l'activité Quiz et rattachement des questions.
 * Les 76 questions sont déjà dans la banque. Ce script crée le Test.
 */

define('CLI_SCRIPT', true);

$moodledir = dirname(__FILE__);
require_once($moodledir . '/config.php');
require_once($CFG->libdir . '/accesslib.php');
require_once($CFG->libdir . '/questionlib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/mod/quiz/lib.php');
require_once($CFG->dirroot . '/mod/quiz/locallib.php');

// Forcer admin
$USER = $DB->get_record('user', ['id' => 2]);
\core\session\manager::set_user($USER);

echo "\n  ═══════════════════════════════════════════════════\n";
echo "  VERTEX© — Création Quiz Obésité-Orthopédie\n";
echo "  ═══════════════════════════════════════════════════\n\n";

// ── Trouver le cours ──
$course = $DB->get_record('course', ['id' => 6]);
if (!$course) {
    $course = $DB->get_record('course', ['shortname' => 'VERTEX-OBO']);
}
if (!$course) {
    echo "[ERR] Cours introuvable.\n";
    $all = $DB->get_records('course', null, 'id', 'id, shortname, fullname');
    foreach ($all as $c) echo "  id={$c->id} {$c->shortname} {$c->fullname}\n";
    exit(1);
}
echo "  [OK] Cours : {$course->fullname} (id={$course->id})\n";

$context = context_course::instance($course->id);

// ── Vérifier si le quiz existe déjà ──
$QUIZ_NAME = 'Quiz Obesite et Orthopedie - VERTEX';
$existing = $DB->get_record('quiz', ['course' => $course->id, 'name' => $QUIZ_NAME]);
if ($existing) {
    echo "  [OK] Quiz existant (id={$existing->id}), on passe au rattachement des questions.\n";
    $quizid = $existing->id;
} else {
    // ── Créer l'activité quiz ──
    echo "  [+] Création de l'activité Quiz...\n";

    $quiz = new stdClass();
    $quiz->course = $course->id;
    $quiz->name = $QUIZ_NAME;
    $quiz->intro = '<p>Quiz VERTEX© Obesite et Orthopedie — 76 questions reparties en 4 niveaux : Bronze (18), Argent (25), Or (19), Diamant (14).</p>';
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
    $quiz->grademethod = 1; // QUIZ_GRADEHIGHEST
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

    // Paramètres de review (afficher tout après soumission)
    $quiz->reviewattempt = 0x11110;
    $quiz->reviewcorrectness = 0x11110;
    $quiz->reviewmarks = 0x11110;
    $quiz->reviewspecificfeedback = 0x11110;
    $quiz->reviewgeneralfeedback = 0x11110;
    $quiz->reviewrightanswer = 0x11110;
    $quiz->reviewoverallfeedback = 0x11110;

    $quizid = $DB->insert_record('quiz', $quiz);
    echo "  [OK] Quiz créé (id=$quizid)\n";

    // ── Ajouter au cours comme module ──
    echo "  [+] Ajout comme activité dans le cours...\n";

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

    // Ajouter à la section 0 du cours
    course_add_cm_to_section($course, $cmid, 0);

    // Mettre à jour le context pour le module
    context_module::instance($cmid);

    echo "  [OK] Module ajouté au cours (cmid=$cmid)\n";
}

// ── Rattacher les questions au quiz ──
echo "\n  [*] Rattachement des questions au quiz...\n";

// Récupérer toutes les questions du cours
$allcats = $DB->get_records('question_categories', ['contextid' => $context->id]);
if (empty($allcats)) {
    echo "  [ERR] Aucune catégorie de questions trouvée pour ce cours.\n";
    exit(1);
}

$catids = array_keys($allcats);
list($insql, $params) = $DB->get_in_or_equal($catids);

// Moodle 4.x : question_bank_entries + question_versions
$has_qbe = $DB->get_manager()->table_exists('question_bank_entries');

if ($has_qbe) {
    // Moodle 4.x
    echo "  [*] Détection Moodle 4.x (question_bank_entries)...\n";

    $sql = "SELECT q.id, q.qtype, qbe.id as qbeid, qv.version
            FROM {question} q
            JOIN {question_versions} qv ON qv.questionid = q.id
            JOIN {question_bank_entries} qbe ON qbe.id = qv.questionbankentryid
            WHERE qbe.questioncategoryid $insql
            AND q.qtype != 'random'
            ORDER BY q.id ASC";
    $questions = $DB->get_records_sql($sql, $params);
} else {
    // Moodle 3.x
    $questions = $DB->get_records_select('question',
        "category $insql AND qtype != 'random'", $params, 'id ASC');
}

if (empty($questions)) {
    echo "  [ERR] Aucune question trouvée dans la banque du cours.\n";
    exit(1);
}

echo "  [OK] " . count($questions) . " questions trouvées dans la banque\n";

// Vérifier la structure de quiz_slots
$has_qbeid_col = false;
$slot_cols = $DB->get_columns('quiz_slots');
if (isset($slot_cols['questionbankentryid'])) {
    $has_qbeid_col = true;
}

$slot = 1;
$added = 0;
$skipped = 0;

foreach ($questions as $q) {
    // Vérifier si déjà rattaché
    if ($has_qbeid_col && isset($q->qbeid)) {
        $exists = $DB->record_exists('quiz_slots', [
            'quizid' => $quizid,
            'questionbankentryid' => $q->qbeid,
        ]);
    } else {
        $exists = $DB->record_exists_select('quiz_slots',
            "quizid = ? AND slot = ?", [$quizid, $slot]);
    }

    if ($exists) {
        $skipped++;
        $slot++;
        continue;
    }

    try {
        $slotdata = new stdClass();
        $slotdata->quizid = $quizid;
        $slotdata->slot = $slot;
        $slotdata->page = $slot; // 1 question par page
        $slotdata->maxmark = 1.0000000;

        if ($has_qbeid_col && isset($q->qbeid)) {
            // Moodle 4.x
            $slotdata->questionbankentryid = $q->qbeid;
            $slotdata->questionid = $q->id;
            if (isset($slot_cols['requireprevious'])) {
                $slotdata->requireprevious = 0;
            }
            if (isset($slot_cols['displaynumber'])) {
                $slotdata->displaynumber = null;
            }
        } else {
            // Moodle 3.x
            $slotdata->questionid = $q->id;
            if (isset($slot_cols['requireprevious'])) {
                $slotdata->requireprevious = 0;
            }
        }

        $DB->insert_record('quiz_slots', $slotdata);
        $added++;
        $slot++;
    } catch (Exception $e) {
        echo "  [WARN] Question {$q->id} : " . $e->getMessage() . "\n";
        $slot++;
    }
}

// Mettre à jour sumgrades
$DB->set_field('quiz', 'sumgrades', (float)$added, ['id' => $quizid]);

// Créer/mettre à jour le grade item
if (function_exists('quiz_update_grades')) {
    $quizobj = $DB->get_record('quiz', ['id' => $quizid]);
    quiz_update_grades($quizobj);
}

echo "\n  ═══════════════════════════════════════════════════\n";
echo "  RÉSUMÉ\n";
echo "  ═══════════════════════════════════════════════════\n";
echo "  Quiz    : $QUIZ_NAME (id=$quizid)\n";
echo "  Ajouté  : $added questions\n";
if ($skipped > 0) echo "  Ignoré  : $skipped (déjà rattachées)\n";
echo "  URL     : {$CFG->wwwroot}/mod/quiz/view.php?q=$quizid\n";
echo "  Cours   : {$CFG->wwwroot}/course/view.php?id={$course->id}\n";
echo "  ═══════════════════════════════════════════════════\n\n";
