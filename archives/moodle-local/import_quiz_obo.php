#!/usr/bin/env php
<?php
/**
 * VERTEX© — Import simplifié du quiz Obésité-Orthopédie.
 * Utilise l'importeur XML natif de Moodle.
 */

define('CLI_SCRIPT', true);

$moodledir = dirname(__FILE__);
require_once($moodledir . '/config.php');
require_once($CFG->libdir . '/accesslib.php');
require_once($CFG->libdir . '/questionlib.php');

// Forcer l'exécution en tant qu'admin (id=2)
$USER = $DB->get_record('user', ['id' => 2]);
\core\session\manager::set_user($USER);
require_once($CFG->dirroot . '/question/format.php');
require_once($CFG->dirroot . '/question/format/xml/format.php');

echo "\n  ═══════════════════════════════════════════════════\n";
echo "  VERTEX© — Import Quiz Obésité-Orthopédie\n";
echo "  ═══════════════════════════════════════════════════\n\n";

// ── Fichier XML ──
$XML_FILE = $moodledir . '/import_obo_questions.xml';
if (!file_exists($XML_FILE)) {
    echo "[ERR] Fichier XML introuvable : $XML_FILE\n";
    exit(1);
}
echo "  [OK] Fichier XML trouvé\n";

// ── Trouver le cours VERTEX-OBO (déjà existant id=6) ──
$course = $DB->get_record('course', ['shortname' => 'VERTEX-OBO']);
if (!$course) {
    // Essayer par id
    $course = $DB->get_record('course', ['id' => 6]);
}
if (!$course) {
    // Chercher par nom partiel
    $course = $DB->get_record_select('course', "fullname LIKE '%Ob%sit%Orthop%die%'", null, '*', IGNORE_MULTIPLE);
}
if (!$course) {
    echo "[ERR] Cours Obésité-Orthopédie introuvable.\n";
    echo "       Listage des cours disponibles :\n";
    $courses = $DB->get_records('course', null, 'id ASC', 'id, shortname, fullname');
    foreach ($courses as $c) {
        echo "       id={$c->id} | {$c->shortname} | {$c->fullname}\n";
    }
    exit(1);
}
echo "  [OK] Cours : '{$course->fullname}' (id={$course->id})\n";

// ── Contexte du cours ──
$context = context_course::instance($course->id);

// ── Catégorie de questions par défaut du cours ──
$category = question_get_default_category($context->id);
if (!$category) {
    // Créer la catégorie par défaut
    $cats = question_make_default_categories(array($context));
    $category = question_get_default_category($context->id);
}
if (!$category) {
    echo "[ERR] Impossible de créer la catégorie de questions par défaut.\n";
    exit(1);
}
echo "  [OK] Catégorie de questions : '{$category->name}' (id={$category->id})\n";

// ── Import XML via qformat_xml ──
echo "\n  [*] Import des questions...\n";

$qformat = new qformat_xml();
$qformat->setCategory($category);
$qformat->setContexts(array($context));
$qformat->setCourse($course);
$qformat->setFilename($XML_FILE);
$qformat->setRealfilename(basename($XML_FILE));
$qformat->setCatfromfile(true);
$qformat->setMatchgrades('nearest');
$qformat->setStoponerror(false);

// Lire les questions
$qformat->importpreprocess();

// Moodle attend le contenu du fichier (lignes), pas le chemin
$filecontent = file_get_contents($XML_FILE);
$lines = explode("\n", $filecontent);
$questions = $qformat->readquestions($lines);

if (empty($questions)) {
    echo "  [ERR] Aucune question parsée.\n";
    exit(1);
}

$nq = count(array_filter($questions, function($q) { return $q->qtype !== 'category'; }));
echo "  [OK] $nq questions parsées\n";

// Importer dans Moodle
echo "  [*] Écriture en base de données...\n";

$qformat->importprocess($questions);

echo "  [OK] Import terminé !\n";

// ── Vérification ──
$countdb = $DB->count_records_select('question', "category IN (
    SELECT id FROM {question_categories} WHERE contextid = ?
)", [$context->id]);

echo "\n  ═══════════════════════════════════════════════════\n";
echo "  RÉSUMÉ\n";
echo "  ═══════════════════════════════════════════════════\n";
echo "  Cours     : {$course->fullname} (id={$course->id})\n";
echo "  Questions : $countdb dans la banque du cours\n";
echo "  URL       : {$CFG->wwwroot}/course/view.php?id={$course->id}\n";
echo "  Banque    : {$CFG->wwwroot}/question/edit.php?courseid={$course->id}\n";
echo "  ═══════════════════════════════════════════════════\n\n";

// Nettoyage
echo "  Pour créer le quiz, allez dans le cours et ajoutez une activité 'Test'.\n";
echo "  Puis ajoutez les questions depuis la banque de questions.\n\n";
