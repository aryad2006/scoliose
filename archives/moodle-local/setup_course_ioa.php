#!/usr/bin/env php
<?php
/**
 * VERTEX© — Setup complet du cours "Infections Ostéo-Articulaires" (VERTEX-IOA)
 *
 * Ce script :
 *  1. Nettoie le cours existant (suppression sections > 0 et activités)
 *  2. Crée 12 sections (0-11) avec les bons noms
 *  3. Importe les questions depuis le XML (77 questions)
 *  4. Crée les activités "page" (contenu MD→HTML) dans chaque section
 *  5. Crée les quiz par module (M01-M09) + quiz final
 *  6. Assigne les questions aux quiz par tag Module
 *
 * Usage : sudo -u www-data php setup_course_ioa.php
 *         (ou depuis Docker : docker exec moodle-local-moodle-1 php /var/www/html/setup_course_ioa.php)
 *
 * Prérequis : le cours VERTEX-IOA (id=4) doit exister.
 *             Les fichiers MD et XML doivent être copiés dans le répertoire Moodle.
 *
 * @copyright 2026 VERTEX©
 * @license   Propriétaire
 */

define('CLI_SCRIPT', true);

// ── Chemins ──
$moodledir = dirname(__FILE__);
require_once($moodledir . '/config.php');
require_once($CFG->libdir . '/accesslib.php');
require_once($CFG->libdir . '/questionlib.php');
require_once($CFG->libdir . '/modinfolib.php');
require_once($CFG->libdir . '/datalib.php');
require_once($CFG->libdir . '/gradelib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/mod/page/lib.php');
require_once($CFG->dirroot . '/mod/quiz/lib.php');
require_once($CFG->dirroot . '/question/format.php');
require_once($CFG->dirroot . '/question/format/xml/format.php');

// ── Admin user (obligatoire pour les opérations CLI Moodle 4.x) ──
global $USER, $DB, $CFG;
$USER = $DB->get_record('user', ['id' => 2]);
\core\session\manager::set_user($USER);

// ══════════════════════════════════════════════════════════════════
//  CONFIGURATION
// ══════════════════════════════════════════════════════════════════

$COURSE_ID       = 4;
$COURSE_SHORTNAME = 'VERTEX-IOA';

// Fichiers sources (relatifs au répertoire Moodle)
$CONTENT_DIR = $moodledir;  // les fichiers MD/XML doivent être dans le même répertoire

// Mapping modules → fichiers MD
$MODULE_FILES = [
    1 => 'CDC_IOA_01_HISTOIRE_FONDAMENTAUX.md',
    2 => 'CDC_IOA_02_IMMUNOLOGIE_TERRAIN.md',
    3 => 'CDC_IOA_03_DIAGNOSTIC.md',
    4 => 'CDC_IOA_04_ANTIBIOTHERAPIE.md',
    5 => 'CDC_IOA_05_OSTEOMYELITE.md',
    6 => 'CDC_IOA_06_ARTHRITE_PERIPROTHETIQUE.md',
    7 => 'CDC_IOA_07_INFECTIONS_SPECIFIQUES.md',
    8 => 'CDC_IOA_08_CHIRURGIE_RECONSTRUCTION.md',
    9 => 'CDC_IOA_09_PREVENTION_INNOVATIONS.md',
];

// Cas cliniques
$CASE_FILES = [
    ['file' => 'CAS_CLINIQUES_IOA.md', 'name' => 'Cas cliniques progressifs (20 cas)'],
];

// Noms des sections
$SECTIONS = [
    0  => 'Bienvenue',
    1  => 'M01 — Histoire et fondamentaux',
    2  => 'M02 — Immunologie et terrain',
    3  => 'M03 — Diagnostic',
    4  => 'M04 — Antibiothérapie',
    5  => 'M05 — Ostéomyélite',
    6  => 'M06 — Arthrite et infection périprothétique',
    7  => 'M07 — Infections spécifiques',
    8  => 'M08 — Chirurgie et reconstruction',
    9  => 'M09 — Prévention et innovations',
    10 => 'Cas cliniques progressifs',
    11 => 'Quiz final — Évaluation complète',
];

// Noms des quiz par module
$QUIZ_NAMES = [
    1 => 'Quiz M01 — Histoire et fondamentaux',
    2 => 'Quiz M02 — Immunologie et terrain',
    3 => 'Quiz M03 — Diagnostic',
    4 => 'Quiz M04 — Antibiothérapie',
    5 => 'Quiz M05 — Ostéomyélite',
    6 => 'Quiz M06 — Arthrite et infection périprothétique',
    7 => 'Quiz M07 — Infections spécifiques',
    8 => 'Quiz M08 — Chirurgie et reconstruction',
    9 => 'Quiz M09 — Prévention et innovations',
];

$QUIZ_FINAL_NAME = 'Quiz final — Infections Ostéo-Articulaires';

$XML_FILE = $CONTENT_DIR . '/quiz_ioa.xml';

// ══════════════════════════════════════════════════════════════════
//  FONCTIONS UTILITAIRES
// ══════════════════════════════════════════════════════════════════

/**
 * Affiche un message de progression formaté.
 */
function out($msg, $prefix = '  ') {
    echo $prefix . $msg . "\n";
}

/**
 * Convertit du Markdown simplifié en HTML basique.
 * Gère : titres, gras, italique, tableaux, blockquotes, listes, paragraphes.
 */
function md_to_html($md) {
    $lines = explode("\n", $md);
    $html = '';
    $in_table = false;
    $in_thead = false;
    $in_ul = false;
    $in_ol = false;
    $in_blockquote = false;
    $paragraph = '';

    // Fonction pour fermer les blocs ouverts
    $close_blocks = function() use (&$html, &$in_ul, &$in_ol, &$in_blockquote, &$paragraph) {
        if ($paragraph !== '') {
            $html .= '<p>' . trim($paragraph) . "</p>\n";
            $paragraph = '';
        }
        if ($in_ul) { $html .= "</ul>\n"; $in_ul = false; }
        if ($in_ol) { $html .= "</ol>\n"; $in_ol = false; }
        if ($in_blockquote) { $html .= "</blockquote>\n"; $in_blockquote = false; }
    };

    foreach ($lines as $line) {
        $trimmed = trim($line);

        // Ligne vide
        if ($trimmed === '') {
            if ($in_table) {
                $html .= "</tbody></table>\n";
                $in_table = false;
                $in_thead = false;
            }
            if ($paragraph !== '') {
                $close_blocks();
            }
            if ($in_ul) { $html .= "</ul>\n"; $in_ul = false; }
            if ($in_ol) { $html .= "</ol>\n"; $in_ol = false; }
            if ($in_blockquote) { $html .= "</blockquote>\n"; $in_blockquote = false; }
            continue;
        }

        // Séparateur markdown (---)
        if (preg_match('/^-{3,}$/', $trimmed) || preg_match('/^\|?\s*-{2,}/', $trimmed)) {
            // Séparateur de tableau ou ligne horizontale
            if ($in_table) {
                // C'est le séparateur thead/tbody → on ferme thead, ouvre tbody
                $html .= "</thead><tbody>\n";
                $in_thead = false;
                continue;
            }
            if (preg_match('/^-{3,}$/', $trimmed)) {
                $close_blocks();
                $html .= "<hr>\n";
                continue;
            }
        }

        // Titres
        if (preg_match('/^(#{1,6})\s+(.+)$/', $trimmed, $m)) {
            $close_blocks();
            $level = strlen($m[1]);
            // Décaler : # → h2, ## → h3, ### → h4
            $hlevel = min($level + 1, 6);
            $text = inline_md($m[2]);
            $html .= "<h{$hlevel}>{$text}</h{$hlevel}>\n";
            continue;
        }

        // Tableau
        if (preg_match('/^\|(.+)\|$/', $trimmed)) {
            if ($paragraph !== '') { $close_blocks(); }

            // Vérifier si c'est un séparateur (|---|---|)
            if (preg_match('/^\|[\s\-:]+\|$/', $trimmed)) {
                if ($in_table) {
                    $html .= "</thead><tbody>\n";
                    $in_thead = false;
                }
                continue;
            }

            $cells = array_map('trim', explode('|', trim($trimmed, '|')));

            if (!$in_table) {
                $html .= "<table class=\"table table-striped table-bordered\">\n<thead>\n";
                $in_table = true;
                $in_thead = true;
                $html .= "<tr>";
                foreach ($cells as $cell) {
                    $html .= "<th>" . inline_md($cell) . "</th>";
                }
                $html .= "</tr>\n";
            } else {
                $html .= "<tr>";
                $tag = $in_thead ? 'th' : 'td';
                foreach ($cells as $cell) {
                    $html .= "<{$tag}>" . inline_md($cell) . "</{$tag}>";
                }
                $html .= "</tr>\n";
            }
            continue;
        }

        // Fermer le tableau si on sort
        if ($in_table && !preg_match('/^\|/', $trimmed)) {
            $html .= "</tbody></table>\n";
            $in_table = false;
            $in_thead = false;
        }

        // Blockquote
        if (preg_match('/^>\s*(.*)$/', $trimmed, $m)) {
            if ($paragraph !== '') { $close_blocks(); }
            if (!$in_blockquote) {
                $html .= "<blockquote>\n";
                $in_blockquote = true;
            }
            $html .= inline_md($m[1]) . "<br>\n";
            continue;
        }

        // Liste non ordonnée (- ou *)
        if (preg_match('/^[-*]\s+(.+)$/', $trimmed, $m)) {
            if ($paragraph !== '') { $close_blocks(); }
            if ($in_blockquote) { $html .= "</blockquote>\n"; $in_blockquote = false; }
            if (!$in_ul) {
                if ($in_ol) { $html .= "</ol>\n"; $in_ol = false; }
                $html .= "<ul>\n";
                $in_ul = true;
            }
            $html .= "<li>" . inline_md($m[1]) . "</li>\n";
            continue;
        }

        // Liste ordonnée (1. 2. etc.)
        if (preg_match('/^\d+\.\s+(.+)$/', $trimmed, $m)) {
            if ($paragraph !== '') { $close_blocks(); }
            if ($in_blockquote) { $html .= "</blockquote>\n"; $in_blockquote = false; }
            if (!$in_ol) {
                if ($in_ul) { $html .= "</ul>\n"; $in_ul = false; }
                $html .= "<ol>\n";
                $in_ol = true;
            }
            $html .= "<li>" . inline_md($m[1]) . "</li>\n";
            continue;
        }

        // Fermer les listes si on n'est plus dans une liste
        if ($in_ul && !preg_match('/^[-*]\s/', $trimmed)) {
            $html .= "</ul>\n"; $in_ul = false;
        }
        if ($in_ol && !preg_match('/^\d+\./', $trimmed)) {
            $html .= "</ol>\n"; $in_ol = false;
        }

        // Paragraphe courant (accumuler les lignes)
        $paragraph .= ($paragraph !== '' ? ' ' : '') . inline_md($trimmed);
    }

    // Fermer tout ce qui est ouvert
    if ($paragraph !== '') { $html .= '<p>' . trim($paragraph) . "</p>\n"; }
    if ($in_table)      { $html .= "</tbody></table>\n"; }
    if ($in_ul)         { $html .= "</ul>\n"; }
    if ($in_ol)         { $html .= "</ol>\n"; }
    if ($in_blockquote) { $html .= "</blockquote>\n"; }

    return $html;
}

/**
 * Convertit le formatage inline Markdown → HTML.
 */
function inline_md($text) {
    // Gras : **texte**
    $text = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text);
    // Italique : *texte*
    $text = preg_replace('/\*(.+?)\*/', '<em>$1</em>', $text);
    // Code inline : `texte`
    $text = preg_replace('/`(.+?)`/', '<code>$1</code>', $text);
    return $text;
}

/**
 * Extrait le premier tag Module (M0X) du texte d'une question.
 * Retourne le numéro du module (1-9) ou 0 si non trouvé.
 */
function extract_module_tag($questiontext) {
    if (preg_match('/Module\s*:\s*M(\d{2})/', $questiontext, $m)) {
        return intval($m[1]);
    }
    return 0;
}

/**
 * Crée une activité "page" dans une section du cours.
 *
 * @param object $course   Le cours Moodle
 * @param int    $section  Numéro de section
 * @param string $name     Nom de la page
 * @param string $content  Contenu HTML
 * @return object|false    Le course_module créé ou false
 */
function create_page_activity($course, $section, $name, $content) {
    global $DB, $CFG;

    $moduleid = $DB->get_field('modules', 'id', ['name' => 'page']);
    if (!$moduleid) {
        out("[ERR] Module 'page' introuvable dans Moodle", '    ');
        return false;
    }

    // Créer l'enregistrement dans la table 'page'
    $page = new stdClass();
    $page->course       = $course->id;
    $page->name         = $name;
    $page->intro        = '<p>' . htmlspecialchars($name) . '</p>';
    $page->introformat  = FORMAT_HTML;
    $page->content       = $content;
    $page->contentformat = FORMAT_HTML;
    $page->display       = 5; // RESOURCELIB_DISPLAY_OPEN
    $page->timemodified  = time();

    $page->id = $DB->insert_record('page', $page);

    // Créer le course_module
    $cm = new stdClass();
    $cm->course     = $course->id;
    $cm->module     = $moduleid;
    $cm->instance   = $page->id;
    $cm->section    = get_section_id($course->id, $section);
    $cm->visible    = 1;
    $cm->added      = time();

    $cm->id = $DB->insert_record('course_modules', $cm);

    // Ajouter à la séquence de la section
    course_add_cm_to_section($course, $cm->id, $section);

    // Contexte du module
    context_module::instance($cm->id);

    return $cm;
}

/**
 * Récupère l'id de la table course_sections pour une section donnée.
 */
function get_section_id($courseid, $sectionnum) {
    global $DB;
    return $DB->get_field('course_sections', 'id', [
        'course'  => $courseid,
        'section' => $sectionnum,
    ]);
}

/**
 * Crée un quiz vide dans une section du cours.
 *
 * @param object $course      Le cours Moodle
 * @param int    $sectionnum  Numéro de section
 * @param string $name        Nom du quiz
 * @return object              Objet avec ->id (quiz.id) et ->cmid (course_modules.id)
 */
function create_quiz_activity($course, $sectionnum, $name) {
    global $DB, $CFG;

    $moduleid = $DB->get_field('modules', 'id', ['name' => 'quiz']);
    if (!$moduleid) {
        out("[ERR] Module 'quiz' introuvable dans Moodle", '    ');
        return false;
    }

    // Paramètres du quiz
    $quiz = new stdClass();
    $quiz->course           = $course->id;
    $quiz->name             = $name;
    $quiz->intro            = '<p>' . htmlspecialchars($name) . '</p>';
    $quiz->introformat      = FORMAT_HTML;
    $quiz->timeopen         = 0;        // Pas de date d'ouverture
    $quiz->timeclose        = 0;        // Pas de date de fermeture
    $quiz->timelimit        = 0;        // Pas de limite de temps
    $quiz->preferredbehaviour = 'deferredfeedback';
    $quiz->attempts         = 0;        // Tentatives illimitées
    $quiz->grademethod      = 1;        // Note la plus haute
    $quiz->questionsperpage = 1;        // 1 question par page
    $quiz->shuffleanswers   = 1;        // Mélanger les réponses
    $quiz->grade            = 100.0;
    $quiz->sumgrades        = 0.0;
    $quiz->timecreated      = time();
    $quiz->timemodified     = time();

    // Review options : tout montrer après soumission
    $review_show = 0x11110;
    $quiz->reviewattempt      = $review_show;
    $quiz->reviewcorrectness  = $review_show;
    $quiz->reviewmarks        = $review_show;
    $quiz->reviewspecificfeedback  = $review_show;
    $quiz->reviewgeneralfeedback   = $review_show;
    $quiz->reviewrightanswer       = $review_show;
    $quiz->reviewoverallfeedback   = $review_show;

    $quiz->id = $DB->insert_record('quiz', $quiz);

    // Créer l'entrée grade_item pour le quiz
    $quizobj = $DB->get_record('quiz', ['id' => $quiz->id]);
    quiz_grade_item_update($quizobj);

    // Créer le course_module
    $cm = new stdClass();
    $cm->course     = $course->id;
    $cm->module     = $moduleid;
    $cm->instance   = $quiz->id;
    $cm->section    = get_section_id($course->id, $sectionnum);
    $cm->visible    = 1;
    $cm->added      = time();

    $cm->id = $DB->insert_record('course_modules', $cm);

    // Ajouter à la séquence de la section
    course_add_cm_to_section($course, $cm->id, $sectionnum);

    // Contexte du module
    context_module::instance($cm->id);

    $result = new stdClass();
    $result->id   = $quiz->id;
    $result->cmid = $cm->id;

    return $result;
}

/**
 * Ajoute une question à un quiz (slot).
 * Compatible Moodle 4.x (question_bank_entries).
 *
 * @param int $quizid     ID du quiz
 * @param int $questionid ID de la question (dans la table question)
 * @param int $slot       Numéro de slot (position)
 * @param float $maxmark  Note maximale pour cette question
 */
function add_question_to_quiz($quizid, $questionid, $slot, $maxmark = 1.0) {
    global $DB;

    // Moodle 4.x : les slots référencent question_references et question_bank_entries
    $has_qbe = $DB->get_manager()->table_exists('question_bank_entries');

    if ($has_qbe) {
        // Moodle 4.x pathway
        // Trouver le question_bank_entry pour cette question
        $qbe = $DB->get_record('question_bank_entries', ['id' =>
            $DB->get_field('question_versions', 'questionbankentryid', ['questionid' => $questionid])
        ]);

        if (!$qbe) {
            out("[WARN] question_bank_entry introuvable pour question id=$questionid", '      ');
            return false;
        }

        // Créer le slot
        $slotrecord = new stdClass();
        $slotrecord->quizid              = $quizid;
        $slotrecord->slot                = $slot;
        $slotrecord->page                = $slot; // 1 question par page
        $slotrecord->requireprevious     = 0;
        $slotrecord->maxmark             = $maxmark;

        // Moodle 4.x : le champ peut être questionbankentryid ou non selon la sous-version
        $columns = $DB->get_columns('quiz_slots');
        if (isset($columns['questionbankentryid'])) {
            $slotrecord->questionbankentryid = $qbe->id;
        }

        $slotrecord->id = $DB->insert_record('quiz_slots', $slotrecord);

        // Moodle 4.x utilise question_references pour lier slot → question
        if ($DB->get_manager()->table_exists('question_references')) {
            // Trouver le contexte du quiz
            $cm = $DB->get_record('course_modules', [
                'instance' => $quizid,
                'module'   => $DB->get_field('modules', 'id', ['name' => 'quiz']),
            ]);

            if ($cm) {
                $context = context_module::instance($cm->id);

                $qref = new stdClass();
                $qref->usingcontextid    = $context->id;
                $qref->component         = 'mod_quiz';
                $qref->questionarea      = 'slot';
                $qref->itemid            = $slotrecord->id;
                $qref->questionbankentryid = $qbe->id;
                $qref->version           = null; // Toujours la dernière version

                $DB->insert_record('question_references', $qref);
            }
        }
    } else {
        // Moodle < 4.0 (fallback)
        $slotrecord = new stdClass();
        $slotrecord->quizid          = $quizid;
        $slotrecord->slot            = $slot;
        $slotrecord->questionid      = $questionid;
        $slotrecord->page            = $slot;
        $slotrecord->requireprevious = 0;
        $slotrecord->maxmark         = $maxmark;

        $slotrecord->id = $DB->insert_record('quiz_slots', $slotrecord);
    }

    return true;
}

/**
 * Met à jour le sumgrades d'un quiz après ajout de questions.
 */
function update_quiz_grades($quizid) {
    global $DB;

    $sumgrades = $DB->get_field_sql(
        "SELECT SUM(maxmark) FROM {quiz_slots} WHERE quizid = ?",
        [$quizid]
    );

    $DB->set_field('quiz', 'sumgrades', $sumgrades ?: 0, ['id' => $quizid]);

    // Mettre à jour le grade_item
    $quiz = $DB->get_record('quiz', ['id' => $quizid]);
    if ($quiz) {
        quiz_grade_item_update($quiz);
    }
}

/**
 * Supprime toutes les activités et sections > 0 d'un cours.
 */
function clean_course($course) {
    global $DB, $CFG;

    out("[*] Nettoyage du cours '{$course->fullname}' (id={$course->id})...");

    // Récupérer toutes les sections du cours
    $sections = $DB->get_records('course_sections', ['course' => $course->id], 'section ASC');

    $deleted_cm = 0;
    $deleted_sec = 0;

    foreach ($sections as $section) {
        if ($section->section == 0) {
            // Section 0 : supprimer les activités SAUF le forum Annonces
            $forum_module_id = $DB->get_field('modules', 'id', ['name' => 'forum']);
            if (!empty($section->sequence)) {
                $cmids = explode(',', $section->sequence);
                foreach ($cmids as $cmid) {
                    $cmid = trim($cmid);
                    if (empty($cmid)) continue;
                    $cm = $DB->get_record('course_modules', ['id' => $cmid]);
                    if (!$cm) continue;

                    // Garder le forum Annonces
                    if ($cm->module == $forum_module_id) {
                        $forum = $DB->get_record('forum', ['id' => $cm->instance]);
                        if ($forum && $forum->type === 'news') {
                            continue; // On garde ce forum
                        }
                    }

                    try {
                        course_delete_module($cmid);
                        $deleted_cm++;
                    } catch (Exception $e) {
                        out("[WARN] Impossible de supprimer le module cm=$cmid : " . $e->getMessage(), '    ');
                    }
                }
            }
            continue;
        }

        // Sections > 0 : supprimer toutes les activités
        if (!empty($section->sequence)) {
            $cmids = explode(',', $section->sequence);
            foreach ($cmids as $cmid) {
                $cmid = trim($cmid);
                if (empty($cmid)) continue;
                try {
                    course_delete_module($cmid);
                    $deleted_cm++;
                } catch (Exception $e) {
                    out("[WARN] Impossible de supprimer le module cm=$cmid : " . $e->getMessage(), '    ');
                }
            }
        }

        // Supprimer la section elle-même
        $DB->delete_records('course_sections', ['id' => $section->id]);
        $deleted_sec++;
    }

    out("[OK] $deleted_cm activités supprimées, $deleted_sec sections supprimées");
}

/**
 * Crée les sections du cours avec les noms définis.
 */
function create_sections($course, $sections) {
    global $DB;

    out("[*] Création des sections...");

    foreach ($sections as $num => $name) {
        // Vérifier si la section existe déjà
        $existing = $DB->get_record('course_sections', [
            'course'  => $course->id,
            'section' => $num,
        ]);

        if ($existing) {
            // Mettre à jour le nom
            $DB->update_record('course_sections', (object)[
                'id'      => $existing->id,
                'name'    => $name,
                'summary' => '',
                'summaryformat' => FORMAT_HTML,
                'visible' => 1,
            ]);
        } else {
            // Créer la section
            $section = new stdClass();
            $section->course         = $course->id;
            $section->section        = $num;
            $section->name           = $name;
            $section->summary        = '';
            $section->summaryformat  = FORMAT_HTML;
            $section->visible        = 1;
            $section->sequence       = '';
            $section->timemodified   = time();

            $DB->insert_record('course_sections', $section);
        }

        out("[OK] Section $num : $name", '    ');
    }

    // Mettre à jour le nombre de sections du cours
    $numsections = max(array_keys($sections));
    $format_options = $DB->get_record('course_format_options', [
        'courseid' => $course->id,
        'name'     => 'numsections',
    ]);
    if ($format_options) {
        $DB->set_field('course_format_options', 'value', $numsections, ['id' => $format_options->id]);
    }

    // Rebuild course cache
    rebuild_course_cache($course->id, true);
}


// ══════════════════════════════════════════════════════════════════
//  SCRIPT PRINCIPAL
// ══════════════════════════════════════════════════════════════════

echo "\n";
echo "  ═══════════════════════════════════════════════════════════════\n";
echo "  VERTEX© — Setup cours Infections Ostéo-Articulaires (VERTEX-IOA)\n";
echo "  ═══════════════════════════════════════════════════════════════\n\n";

// ── 1. Trouver le cours ──
out("[*] Recherche du cours...");
$course = $DB->get_record('course', ['shortname' => $COURSE_SHORTNAME]);
if (!$course) {
    $course = $DB->get_record('course', ['id' => $COURSE_ID]);
}
if (!$course) {
    out("[ERR] Cours VERTEX-IOA (id=$COURSE_ID) introuvable !");
    out("      Cours disponibles :");
    $courses = $DB->get_records('course', null, 'id ASC', 'id, shortname, fullname');
    foreach ($courses as $c) {
        out("      id={$c->id} | {$c->shortname} | {$c->fullname}");
    }
    exit(1);
}
out("[OK] Cours trouvé : '{$course->fullname}' (id={$course->id})");
$context = context_course::instance($course->id);

// ── 2. Vérifier la présence des fichiers sources ──
out("\n[*] Vérification des fichiers sources...");

$files_ok = true;
foreach ($MODULE_FILES as $num => $file) {
    $path = $CONTENT_DIR . '/' . $file;
    if (!file_exists($path)) {
        out("[ERR] Fichier manquant : $path", '    ');
        $files_ok = false;
    }
}
foreach ($CASE_FILES as $cf) {
    $path = $CONTENT_DIR . '/' . $cf['file'];
    if (!file_exists($path)) {
        out("[ERR] Fichier manquant : $path", '    ');
        $files_ok = false;
    }
}
if (!file_exists($XML_FILE)) {
    out("[ERR] Fichier XML manquant : $XML_FILE", '    ');
    $files_ok = false;
}

if (!$files_ok) {
    out("\n[ERR] Fichiers manquants ! Les fichiers MD et XML doivent être");
    out("      copiés dans le répertoire Moodle ($CONTENT_DIR).");
    out("      Fichiers attendus :");
    foreach ($MODULE_FILES as $f) { out("        - $f"); }
    foreach ($CASE_FILES as $cf) { out("        - " . $cf['file']); }
    out("        - quiz_ioa.xml");
    exit(1);
}
out("[OK] Tous les fichiers sources sont présents");

// ── 3. Nettoyer le cours ──
echo "\n";
clean_course($course);
rebuild_course_cache($course->id, true);

// ── 4. Créer les sections ──
echo "\n";
create_sections($course, $SECTIONS);

// ── 5. Importer les questions depuis le XML ──
echo "\n";
out("[*] Import des questions depuis le XML...");

// Catégorie de questions du cours
$category = question_get_default_category($context->id);
if (!$category) {
    $cats = question_make_default_categories([$context]);
    $category = question_get_default_category($context->id);
}
if (!$category) {
    out("[ERR] Impossible de créer la catégorie de questions !");
    exit(1);
}
out("[OK] Catégorie de questions : '{$category->name}' (id={$category->id})", '    ');

// Supprimer les questions existantes dans cette catégorie
out("[*] Nettoyage des questions existantes...", '    ');

// Récupérer toutes les catégories de questions du cours
$all_cats = $DB->get_records('question_categories', ['contextid' => $context->id]);
$cat_ids = array_keys($all_cats);

if (!empty($cat_ids)) {
    // Supprimer via l'API Moodle si possible
    list($in_sql, $params) = $DB->get_in_or_equal($cat_ids);

    // Moodle 4.x : supprimer les question_bank_entries et question_versions
    if ($DB->get_manager()->table_exists('question_bank_entries')) {
        $qbe_ids = $DB->get_fieldset_select('question_bank_entries', 'id',
            "questioncategoryid $in_sql", $params);

        if (!empty($qbe_ids)) {
            list($qbe_in, $qbe_params) = $DB->get_in_or_equal($qbe_ids);

            // Récupérer les question IDs depuis question_versions
            $question_ids = $DB->get_fieldset_select('question_versions', 'questionid',
                "questionbankentryid $qbe_in", $qbe_params);

            // Supprimer question_references
            if ($DB->get_manager()->table_exists('question_references')) {
                $DB->delete_records_select('question_references',
                    "questionbankentryid $qbe_in", $qbe_params);
            }

            // Supprimer question_versions
            $DB->delete_records_select('question_versions',
                "questionbankentryid $qbe_in", $qbe_params);

            // Supprimer question_bank_entries
            $DB->delete_records_select('question_bank_entries',
                "id $qbe_in", $qbe_params);

            // Supprimer les réponses et les questions elles-mêmes
            if (!empty($question_ids)) {
                list($q_in, $q_params) = $DB->get_in_or_equal($question_ids);
                $DB->delete_records_select('question_answers', "question $q_in", $q_params);
                $DB->delete_records_select('question_hints', "questionid $q_in", $q_params);
                // Tables spécifiques aux types de questions
                foreach (['qtype_multichoice_options'] as $table) {
                    if ($DB->get_manager()->table_exists($table)) {
                        $DB->delete_records_select($table, "questionid $q_in", $q_params);
                    }
                }
                $DB->delete_records_select('question', "id $q_in", $q_params);
            }
        }
    } else {
        // Moodle < 4 fallback
        $DB->delete_records_select('question', "category $in_sql", $params);
    }

    // Supprimer les catégories sauf la défaut
    foreach ($all_cats as $cat) {
        if ($cat->id != $category->id) {
            $DB->delete_records('question_categories', ['id' => $cat->id]);
        }
    }
}
out("[OK] Questions existantes supprimées", '    ');

// Import XML via qformat_xml
$qformat = new qformat_xml();
$qformat->setCategory($category);
$qformat->setContexts([$context]);
$qformat->setCourse($course);
$qformat->setFilename($XML_FILE);
$qformat->setRealfilename(basename($XML_FILE));
$qformat->setCatfromfile(true);
$qformat->setMatchgrades('nearest');
$qformat->setStoponerror(false);

$qformat->importpreprocess();
$filecontent = file_get_contents($XML_FILE);
$lines = explode("\n", $filecontent);
$questions = $qformat->readquestions($lines);

if (empty($questions)) {
    out("[ERR] Aucune question parsée depuis le XML !");
    exit(1);
}

// Filtrer les catégories (qtype=category)
$real_questions = array_filter($questions, function($q) { return $q->qtype !== 'category'; });
$nq = count($real_questions);
out("[OK] $nq questions parsées", '    ');

// Sauvegarder en base
out("[*] Écriture des questions en base...", '    ');
$qformat->importprocess($questions);
out("[OK] Questions importées", '    ');

// ── 6. Mapper les questions par module ──
echo "\n";
out("[*] Mapping des questions par module...");

// Récupérer toutes les questions du cours (fraîchement importées)
$all_cats_fresh = $DB->get_records('question_categories', ['contextid' => $context->id]);
$cat_ids_fresh = array_keys($all_cats_fresh);

$all_questions = [];
if (!empty($cat_ids_fresh)) {
    if ($DB->get_manager()->table_exists('question_bank_entries')) {
        list($cat_in, $cat_params) = $DB->get_in_or_equal($cat_ids_fresh);
        $qbe_ids = $DB->get_fieldset_select('question_bank_entries', 'id',
            "questioncategoryid $cat_in", $cat_params);

        if (!empty($qbe_ids)) {
            list($qbe_in, $qbe_params) = $DB->get_in_or_equal($qbe_ids);
            $versions = $DB->get_records_select('question_versions',
                "questionbankentryid $qbe_in", $qbe_params);

            foreach ($versions as $v) {
                $q = $DB->get_record('question', ['id' => $v->questionid]);
                if ($q && $q->qtype !== 'random') {
                    $all_questions[] = $q;
                }
            }
        }
    } else {
        list($cat_in, $cat_params) = $DB->get_in_or_equal($cat_ids_fresh);
        $all_questions = $DB->get_records_select('question',
            "category $cat_in AND qtype != 'random'", $cat_params);
        $all_questions = array_values($all_questions);
    }
}

out("[OK] " . count($all_questions) . " questions en base", '    ');

// Classer les questions par module (premier tag M0X trouvé)
$questions_by_module = [];
for ($i = 1; $i <= 9; $i++) {
    $questions_by_module[$i] = [];
}
$all_for_final = []; // Toutes les questions pour le quiz final

foreach ($all_questions as $q) {
    $module_num = extract_module_tag($q->questiontext);
    if ($module_num >= 1 && $module_num <= 9) {
        $questions_by_module[$module_num][] = $q;
    }
    // Toutes les questions vont dans le quiz final
    $all_for_final[] = $q;
}

for ($i = 1; $i <= 9; $i++) {
    $count = count($questions_by_module[$i]);
    out("    M0$i : $count questions");
}
out("    Final : " . count($all_for_final) . " questions");

// ── 7. Créer les activités Page (modules 1-9) ──
echo "\n";
out("[*] Création des pages de contenu (M01-M09)...");

foreach ($MODULE_FILES as $num => $file) {
    $path = $CONTENT_DIR . '/' . $file;
    $md_content = file_get_contents($path);

    // Convertir MD → HTML
    $html_content = md_to_html($md_content);

    // Nom de la page = nom de la section
    $page_name = $SECTIONS[$num];

    $cm = create_page_activity($course, $num, $page_name, $html_content);
    if ($cm) {
        out("[OK] Section $num : page '$page_name' créée (cm={$cm->id})", '    ');
    } else {
        out("[ERR] Section $num : échec de création de la page", '    ');
    }
}

// ── 8. Créer les quiz par module (M01-M09) ──
echo "\n";
out("[*] Création des quiz par module...");

foreach ($QUIZ_NAMES as $num => $quiz_name) {
    $quiz = create_quiz_activity($course, $num, $quiz_name);
    if (!$quiz) {
        out("[ERR] Section $num : échec de création du quiz", '    ');
        continue;
    }

    // Ajouter les questions du module
    $slot = 0;
    foreach ($questions_by_module[$num] as $q) {
        $slot++;
        $ok = add_question_to_quiz($quiz->id, $q->id, $slot, 1.0);
        if (!$ok) {
            out("[WARN] Question id={$q->id} non ajoutée au quiz", '      ');
        }
    }

    // Mettre à jour les notes
    update_quiz_grades($quiz->id);

    out("[OK] Section $num : quiz '$quiz_name' — $slot questions (quiz_id={$quiz->id})", '    ');
}

// ── 9. Créer les pages de cas cliniques (section 10) ──
echo "\n";
out("[*] Création des cas cliniques (section 10)...");

foreach ($CASE_FILES as $cf) {
    $path = $CONTENT_DIR . '/' . $cf['file'];
    $md_content = file_get_contents($path);
    $html_content = md_to_html($md_content);

    $cm = create_page_activity($course, 10, $cf['name'], $html_content);
    if ($cm) {
        out("[OK] Page '{$cf['name']}' créée (cm={$cm->id})", '    ');
    } else {
        out("[ERR] Échec : '{$cf['name']}'", '    ');
    }
}

// ── 10. Créer le quiz final (section 11) ──
echo "\n";
out("[*] Création du quiz final (section 11)...");

$quiz_final = create_quiz_activity($course, 11, $QUIZ_FINAL_NAME);
if (!$quiz_final) {
    out("[ERR] Échec de création du quiz final !");
    exit(1);
}

$slot = 0;
foreach ($all_for_final as $q) {
    $slot++;
    add_question_to_quiz($quiz_final->id, $q->id, $slot, 1.0);
}
update_quiz_grades($quiz_final->id);

out("[OK] Quiz final créé — $slot questions (quiz_id={$quiz_final->id})", '    ');

// ── 11. Rebuild cache final ──
echo "\n";
out("[*] Reconstruction du cache du cours...");
rebuild_course_cache($course->id, true);
out("[OK] Cache reconstruit");

// ══════════════════════════════════════════════════════════════════
//  RÉSUMÉ
// ══════════════════════════════════════════════════════════════════

echo "\n";
echo "  ═══════════════════════════════════════════════════════════════\n";
echo "  RÉSUMÉ — Setup terminé avec succès\n";
echo "  ═══════════════════════════════════════════════════════════════\n";
echo "  Cours       : {$course->fullname} (id={$course->id})\n";
echo "  Sections    : " . count($SECTIONS) . " (0-11)\n";
echo "  Pages       : " . (count($MODULE_FILES) + count($CASE_FILES)) . " activités page\n";
echo "  Quiz module : 9 quiz (M01-M09)\n";
echo "  Quiz final  : 1 quiz (" . count($all_for_final) . " questions)\n";
echo "  Questions   : " . count($all_questions) . " dans la banque\n";
echo "  ───────────────────────────────────────────────────────────────\n";
echo "  URL cours   : {$CFG->wwwroot}/course/view.php?id={$course->id}\n";
echo "  Banque Q    : {$CFG->wwwroot}/question/edit.php?courseid={$course->id}\n";
echo "  ═══════════════════════════════════════════════════════════════\n\n";
