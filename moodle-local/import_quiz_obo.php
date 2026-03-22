#!/usr/bin/env php
<?php
/**
 * VERTEX© — Import CLI du quiz Obésité-Orthopédie dans Moodle.
 *
 * Crée la formation (cours), la catégorie de questions,
 * importe les 76+ questions XML et crée l'activité quiz.
 *
 * Usage (depuis ~/sites/doctraining.ma/) :
 *   php import_quiz_obo.php
 */

define('CLI_SCRIPT', true);

// Charger Moodle
$moodledir = dirname(__FILE__);
if (!file_exists($moodledir . '/config.php')) {
    // Si le script n'est pas dans la racine Moodle, on cherche
    $moodledir = realpath($moodledir);
    if (!file_exists($moodledir . '/config.php')) {
        echo "[ERR] config.php introuvable. Placez ce script dans la racine Moodle.\n";
        exit(1);
    }
}
require_once($moodledir . '/config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->libdir . '/questionlib.php');
require_once($CFG->dirroot . '/question/format.php');
require_once($CFG->dirroot . '/question/format/xml/format.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/mod/quiz/lib.php');
require_once($CFG->libdir . '/modinfolib.php');
require_once($CFG->libdir . '/gradelib.php');

// ─────────────────────────────────────────────────────────────────────────
// Configuration
// ─────────────────────────────────────────────────────────────────────────

$COURSE_FULLNAME  = 'Obésité et Orthopédie — VERTEX©';
$COURSE_SHORTNAME = 'VERTEX-OBO';
$COURSE_CATEGORY  = 'VERTEX';  // Catégorie parente
$COURSE_SUMMARY   = '<p>Formation VERTEX© — Obésité et Orthopédie. '
    . '9 modules + 20 cas cliniques progressifs (Bronze/Argent/Or/Diamant). '
    . 'Quiz de 80 questions à 4 niveaux de difficulté.</p>';

$QUIZ_NAME    = 'Quiz Obésité et Orthopédie';
$QUIZ_INTRO   = '<p>Quiz VERTEX© — 76 questions réparties en 4 niveaux : '
    . '🥉 Bronze (18) · 🥈 Argent (25) · 🥇 Or (19) · 💎 Diamant (14).</p>';

$XML_FILE = $moodledir . '/import_obo_questions.xml';

echo "\n  ═══════════════════════════════════════════════════\n";
echo "  VERTEX© — Import Quiz Obésité-Orthopédie\n";
echo "  ═══════════════════════════════════════════════════\n\n";

// ─────────────────────────────────────────────────────────────────────────
// Étape 1 : Vérifier que le fichier XML existe
// ─────────────────────────────────────────────────────────────────────────

if (!file_exists($XML_FILE)) {
    echo "[ERR] Fichier XML introuvable : $XML_FILE\n";
    echo "      Assurez-vous que import_obo_questions.xml est dans la racine Moodle.\n\n";
    exit(1);
}
echo "  [OK] Fichier XML trouvé : " . basename($XML_FILE) . "\n";

// ─────────────────────────────────────────────────────────────────────────
// Étape 2 : Créer ou trouver la catégorie de cours VERTEX
// ─────────────────────────────────────────────────────────────────────────

$parentcat = $DB->get_record('course_categories', ['name' => $COURSE_CATEGORY]);
if (!$parentcat) {
    echo "  [+] Création catégorie de cours '$COURSE_CATEGORY'...\n";
    $catdata = new stdClass();
    $catdata->name = $COURSE_CATEGORY;
    $catdata->description = 'Formations VERTEX© — Plateforme médicale e-learning';
    $catdata->parent = 0;
    $catdata->sortorder = 999;
    $catdata->visible = 1;

    require_once($CFG->libdir . '/coursecatlib.php');
    if (class_exists('core_course_category')) {
        $parentcat = core_course_category::create($catdata);
        $parentcatid = $parentcat->id;
    } else {
        // Moodle < 3.6
        $parentcatid = $DB->insert_record('course_categories', $catdata);
    }
    echo "  [OK] Catégorie créée (id=$parentcatid)\n";
} else {
    $parentcatid = $parentcat->id;
    echo "  [OK] Catégorie '$COURSE_CATEGORY' existante (id=$parentcatid)\n";
}

// ─────────────────────────────────────────────────────────────────────────
// Étape 3 : Créer ou trouver le cours
// ─────────────────────────────────────────────────────────────────────────

$course = $DB->get_record('course', ['shortname' => $COURSE_SHORTNAME]);
if (!$course) {
    echo "  [+] Création du cours '$COURSE_SHORTNAME'...\n";
    $coursedata = new stdClass();
    $coursedata->fullname  = $COURSE_FULLNAME;
    $coursedata->shortname = $COURSE_SHORTNAME;
    $coursedata->category  = $parentcatid;
    $coursedata->summary   = $COURSE_SUMMARY;
    $coursedata->format    = 'topics';
    $coursedata->numsections = 10;
    $coursedata->visible   = 1;
    $coursedata->enablecompletion = 1;

    $course = create_course($coursedata);
    echo "  [OK] Cours créé : '{$course->fullname}' (id={$course->id})\n";
} else {
    echo "  [OK] Cours existant : '{$course->fullname}' (id={$course->id})\n";
}

// ─────────────────────────────────────────────────────────────────────────
// Étape 4 : Créer la catégorie de questions
// ─────────────────────────────────────────────────────────────────────────

$context = context_course::instance($course->id);

// Catégorie parente VERTEX
$qcatparent = $DB->get_record('question_categories', [
    'contextid' => $context->id,
    'name'      => 'VERTEX-Obésité-Orthopédie',
]);

if (!$qcatparent) {
    echo "  [+] Création catégorie de questions 'VERTEX-Obésité-Orthopédie'...\n";

    // Trouver la catégorie par défaut du cours (top)
    $defaultcat = question_get_default_category($context->id);

    $qcatdata = new stdClass();
    $qcatdata->name      = 'VERTEX-Obésité-Orthopédie';
    $qcatdata->contextid = $context->id;
    $qcatdata->info      = 'Quiz VERTEX© — Obésité et Orthopédie (80 questions, 4 niveaux)';
    $qcatdata->parent    = $defaultcat->id;
    $qcatdata->sortorder = 999;

    $qcatparent_id = $DB->insert_record('question_categories', $qcatdata);
    $qcatparent = $DB->get_record('question_categories', ['id' => $qcatparent_id]);
    echo "  [OK] Catégorie de questions créée (id=$qcatparent_id)\n";
} else {
    echo "  [OK] Catégorie de questions existante (id={$qcatparent->id})\n";
}

// Sous-catégories par niveau
$levels = ['Bronze', 'Argent', 'Or', 'Diamant'];
$level_catids = [];
foreach ($levels as $level) {
    $sublevel = "VERTEX-Obésité-Orthopédie/$level";
    $subcat = $DB->get_record('question_categories', [
        'contextid' => $context->id,
        'name'      => $level,
        'parent'    => $qcatparent->id,
    ]);
    if (!$subcat) {
        $subcatdata = new stdClass();
        $subcatdata->name      = $level;
        $subcatdata->contextid = $context->id;
        $subcatdata->info      = "Niveau $level — Quiz Obésité et Orthopédie";
        $subcatdata->parent    = $qcatparent->id;
        $subcatdata->sortorder = array_search($level, $levels);

        $subcat_id = $DB->insert_record('question_categories', $subcatdata);
        $level_catids[$level] = $subcat_id;
        echo "    [+] Sous-catégorie '$level' créée (id=$subcat_id)\n";
    } else {
        $level_catids[$level] = $subcat->id;
        echo "    [OK] Sous-catégorie '$level' existante (id={$subcat->id})\n";
    }
}

// ─────────────────────────────────────────────────────────────────────────
// Étape 5 : Importer les questions depuis le XML
// ─────────────────────────────────────────────────────────────────────────

echo "\n  [*] Import des questions depuis XML...\n";

$qformat = new qformat_xml();
$qformat->setCategory($qcatparent);
$qformat->setContexts([$context]);
$qformat->setCourse($course);
$qformat->setFilename($XML_FILE);
$qformat->setCatfromfile(true);    // Utiliser les catégories du fichier XML
$qformat->setMatchgrades('nearest');
$qformat->setStoponerror(false);

// Lire et parser le fichier
$qformat->importpreprocess();
$questions_imported = $qformat->readquestions($XML_FILE);

if (empty($questions_imported)) {
    echo "  [ERR] Aucune question parsée dans le fichier XML.\n";
    echo "        Vérifiez le format du fichier.\n";
    exit(1);
}

echo "  [OK] " . count($questions_imported) . " questions parsées depuis le XML\n";

// Importer dans la base
$count_ok = 0;
$count_err = 0;
foreach ($questions_imported as $q) {
    // Si c'est une entrée catégorie, on la traite
    if ($q->qtype == 'category') {
        // Parser le chemin de catégorie pour trouver le niveau
        $catpath = $q->category ?? '';
        $matched_level = null;
        foreach ($levels as $lvl) {
            if (stripos($catpath, $lvl) !== false) {
                $matched_level = $lvl;
                break;
            }
        }
        if ($matched_level && isset($level_catids[$matched_level])) {
            $qformat->setCategory($DB->get_record('question_categories',
                ['id' => $level_catids[$matched_level]]));
        }
        continue;
    }

    // Sauvegarder la question
    try {
        $q->category = $qformat->category->id;
        $q->createdby = 2; // admin
        $q->modifiedby = 2;
        $q->timecreated = time();
        $q->timemodified = time();
        $qformat->importprocess([$q]);
        $count_ok++;
    } catch (Exception $e) {
        $count_err++;
        // Silently continue
    }
}

// Alternative : utiliser importprocess en bloc si la méthode individuelle échoue
if ($count_ok == 0) {
    echo "  [*] Tentative d'import en bloc...\n";
    try {
        $qformat->setCategory($qcatparent);
        $qformat->importprocess($questions_imported);
        $count_ok = count(array_filter($questions_imported, function($q) {
            return $q->qtype != 'category';
        }));
        echo "  [OK] Import en bloc réussi\n";
    } catch (Exception $e) {
        echo "  [ERR] " . $e->getMessage() . "\n";
    }
}

echo "  [OK] $count_ok questions importées";
if ($count_err > 0) echo " ($count_err erreurs)";
echo "\n";

// ─────────────────────────────────────────────────────────────────────────
// Étape 6 : Créer l'activité Quiz dans le cours
// ─────────────────────────────────────────────────────────────────────────

echo "\n  [*] Création de l'activité Quiz...\n";

// Vérifier si un quiz existe déjà
$existing_quiz = $DB->get_record('quiz', ['course' => $course->id, 'name' => $QUIZ_NAME]);

if ($existing_quiz) {
    echo "  [OK] Quiz existant : '{$existing_quiz->name}' (id={$existing_quiz->id})\n";
    $quiz = $existing_quiz;
} else {
    // Créer le module quiz
    $quizdata = new stdClass();
    $quizdata->course          = $course->id;
    $quizdata->name            = $QUIZ_NAME;
    $quizdata->intro           = $QUIZ_INTRO;
    $quizdata->introformat     = FORMAT_HTML;
    $quizdata->timeopen        = 0;
    $quizdata->timeclose       = 0;
    $quizdata->timelimit       = 0;  // Pas de limite de temps
    $quizdata->grade           = 100;
    $quizdata->attempts        = 0;  // Tentatives illimitées
    $quizdata->grademethod     = QUIZ_GRADEHIGHEST;
    $quizdata->questionsperpage = 1;
    $quizdata->shuffleanswers  = 1;
    $quizdata->preferredbehaviour = 'deferredfeedback';
    $quizdata->reviewattempt   = 0x11110;
    $quizdata->reviewcorrectness = 0x11110;
    $quizdata->reviewmarks     = 0x11110;
    $quizdata->reviewspecificfeedback = 0x11110;
    $quizdata->reviewgeneralfeedback = 0x11110;
    $quizdata->reviewrightanswer = 0x11110;
    $quizdata->reviewoverallfeedback = 0x11110;
    $quizdata->visible         = 1;
    $quizdata->modulename      = 'quiz';
    $quizdata->section         = 0;  // Première section
    $quizdata->cmidnumber      = '';
    $quizdata->groupmode       = 0;

    // Ajouter le module au cours
    $quizdata->module = $DB->get_field('modules', 'id', ['name' => 'quiz']);

    // Utiliser course_modules + quiz tables
    try {
        $quiz = new stdClass();
        $quiz->course = $course->id;
        $quiz->name = $QUIZ_NAME;
        $quiz->intro = $QUIZ_INTRO;
        $quiz->introformat = FORMAT_HTML;
        $quiz->timeopen = 0;
        $quiz->timeclose = 0;
        $quiz->timelimit = 0;
        $quiz->grade = 100.0;
        $quiz->sumgrades = 0.0;
        $quiz->attempts = 0;
        $quiz->grademethod = 1;
        $quiz->questionsperpage = 1;
        $quiz->shuffleanswers = 1;
        $quiz->preferredbehaviour = 'deferredfeedback';
        $quiz->timecreated = time();
        $quiz->timemodified = time();

        $quiz->id = $DB->insert_record('quiz', $quiz);

        // Créer le module de cours
        $cm = new stdClass();
        $cm->course   = $course->id;
        $cm->module   = $DB->get_field('modules', 'id', ['name' => 'quiz']);
        $cm->instance = $quiz->id;
        $cm->section  = 0;
        $cm->visible  = 1;
        $cm->added    = time();

        $cm->id = $DB->insert_record('course_modules', $cm);

        // Ajouter à la section du cours
        course_add_cm_to_section($course, $cm->id, 0);

        echo "  [OK] Quiz créé : '$QUIZ_NAME' (id={$quiz->id})\n";
    } catch (Exception $e) {
        echo "  [WARN] Création quiz : " . $e->getMessage() . "\n";
        echo "         Vous pouvez créer le quiz manuellement depuis l'interface.\n";
    }
}

// ─────────────────────────────────────────────────────────────────────────
// Étape 7 : Ajouter les questions au quiz
// ─────────────────────────────────────────────────────────────────────────

if (isset($quiz->id)) {
    echo "\n  [*] Ajout des questions au quiz...\n";

    // Récupérer toutes les questions de la catégorie
    $allcatids = array_values($level_catids);
    $allcatids[] = $qcatparent->id;

    list($insql, $params) = $DB->get_in_or_equal($allcatids);
    $dbquestions = $DB->get_records_select('question', "category $insql", $params, 'id ASC');

    if (!empty($dbquestions)) {
        $slot = 1;
        $page = 0;
        $added = 0;

        foreach ($dbquestions as $dbq) {
            // Vérifier si déjà dans le quiz
            $exists = $DB->record_exists('quiz_slots', [
                'quizid'     => $quiz->id,
                'questionid' => $dbq->id,
            ]);
            if ($exists) continue;

            try {
                $slotdata = new stdClass();
                $slotdata->quizid     = $quiz->id;
                $slotdata->questionid = $dbq->id;
                $slotdata->slot       = $slot;
                $slotdata->page       = $page;
                $slotdata->maxmark    = 1.0;

                // Moodle 4.x utilise quiz_slots avec questionbankentryid
                if ($DB->get_columns('quiz_slots') &&
                    array_key_exists('questionbankentryid', $DB->get_columns('quiz_slots'))) {
                    // Moodle 4.x
                    $qbe = $DB->get_record('question_bank_entries', ['questionid' => $dbq->id]);
                    if ($qbe) {
                        $slotdata->questionbankentryid = $qbe->id;
                    }
                    $qv = $DB->get_record('question_versions', ['questionid' => $dbq->id]);
                    if ($qv) {
                        $slotdata->questionid = $dbq->id;
                    }
                }

                $DB->insert_record('quiz_slots', $slotdata);
                $slot++;
                $page++;
                $added++;
            } catch (Exception $e) {
                // Silently skip
            }
        }

        // Mettre à jour sumgrades
        $quiz->sumgrades = (float) $added;
        $DB->update_record('quiz', $quiz);

        echo "  [OK] $added questions ajoutées au quiz\n";
    } else {
        echo "  [WARN] Aucune question trouvée dans la banque.\n";
        echo "         L'import XML peut nécessiter un import manuel via l'interface.\n";
    }
}

// ─────────────────────────────────────────────────────────────────────────
// Résumé
// ─────────────────────────────────────────────────────────────────────────

echo "\n  ═══════════════════════════════════════════════════\n";
echo "  RÉSUMÉ\n";
echo "  ═══════════════════════════════════════════════════\n";
echo "  Cours     : $COURSE_FULLNAME (id={$course->id})\n";
echo "  Quiz      : $QUIZ_NAME\n";
echo "  Questions : $count_ok importées\n";
echo "  Catégorie : VERTEX-Obésité-Orthopédie\n";
echo "  URL       : {$CFG->wwwroot}/course/view.php?id={$course->id}\n";
echo "  ═══════════════════════════════════════════════════\n\n";
