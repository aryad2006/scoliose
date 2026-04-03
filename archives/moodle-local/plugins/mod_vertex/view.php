<?php
// This file is part of Moodle - http://moodle.org/
require('../../config.php');
require_once($CFG->dirroot . '/mod/vertex/lib.php');

$id = optional_param('id', 0, PARAM_INT);  // Course module id
$v  = optional_param('v',  0, PARAM_INT);  // Vertex instance id

if ($id) {
    $cm      = get_coursemodule_from_id('vertex', $id, 0, false, MUST_EXIST);
    $course  = get_course($cm->course);
    $vertex  = $DB->get_record('vertex', ['id' => $cm->instance], '*', MUST_EXIST);
} else {
    $vertex = $DB->get_record('vertex', ['id' => $v], '*', MUST_EXIST);
    $course = get_course($vertex->course);
    $cm     = get_coursemodule_from_instance('vertex', $vertex->id, $course->id, false, MUST_EXIST);
}

require_login($course, true, $cm);

$context = context_module::instance($cm->id);
require_capability('mod/vertex:view', $context);

// Journalisation
$event = \mod_vertex\event\course_module_viewed::create([
    'objectid' => $vertex->id,
    'context'  => $context,
]);
$event->add_record_snapshot('course', $course);
$event->add_record_snapshot('vertex', $vertex);
$event->trigger();

// Complétion automatique (COMPLETION_TRACKS_VIEWS)
$completion = new completion_info($course);
$completion->set_module_viewed($cm);

// ── Titre & navigation ────────────────────────────────────────────────────────
$PAGE->set_url('/mod/vertex/view.php', ['id' => $cm->id]);
$PAGE->set_title($course->shortname . ': ' . format_string($vertex->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);
$PAGE->requires->css(new moodle_url('/mod/vertex/styles.css'));

// ── Construire les paramètres LTI pour l'iframe VERTEX ───────────────────────
$vertexUrl = rtrim($vertex->vertex_url ?: $CFG->vertex_url ?? 'http://localhost:5173', '/');
$token     = generate_lti_token($USER, $vertex, $cm, $context);

$iframeParams = [
    'token'    => $token,
    'spine'    => $vertex->spine_template,
    'mode'     => $vertex->mode,
    'userid'   => $USER->id,
    'courseid' => $course->id,
    'cmid'     => $cm->id,
    'callback' => (new moodle_url('/mod/vertex/callback.php'))->out(false),
    'lang'     => current_language(),
];
$iframeUrl = $vertexUrl . '/?' . http_build_query($iframeParams);

// ── Récupérer le résultat précédent de cet étudiant ──────────────────────────
$submission = $DB->get_record(
    'vertex_submissions',
    ['vertex_id' => $vertex->id, 'userid' => $USER->id],
    '*',
    IGNORE_MISSING
);

// ── Affichage ─────────────────────────────────────────────────────────────────
echo $OUTPUT->header();

// Description de l'activité
if ($vertex->intro) {
    echo $OUTPUT->box(format_module_intro('vertex', $vertex, $cm->id), 'generalbox mod_introbox', 'vertexintro');
}

// Résultat précédent si existant
if ($submission && $submission->status === 'submitted') {
    $scorePercent = round($submission->grade ?? 0);
    $gradeStr = grade_format_gradevalue($submission->grade, grade_get_grades($course->id, 'mod', 'vertex', $vertex->id)->items[0] ?? null);

    echo html_writer::div(
        html_writer::tag('strong', get_string('last_attempt', 'mod_vertex')) . ' ' .
        get_string('surgery_score', 'mod_vertex') . ': ' .
        html_writer::tag('b', $submission->surgery_score . '/100') . ' — ' .
        get_string('moodle_grade', 'mod_vertex') . ': ' .
        html_writer::tag('b', $scorePercent . '%') . ' — ' .
        get_string('cobb_correction', 'mod_vertex') . ': ' .
        html_writer::tag('b', $submission->cobb_correction_pct . '%'),
        'alert alert-info vertex-last-result'
    );
}

// L'iframe VERTEX
echo html_writer::tag(
    'div',
    html_writer::empty_tag('iframe', [
        'src'             => $iframeUrl,
        'class'           => 'vertex-iframe',
        'title'           => format_string($vertex->name),
        'allow'           => 'fullscreen; clipboard-write',
        'loading'         => 'lazy',
        'referrerpolicy'  => 'strict-origin',
    ]),
    ['class' => 'vertex-wrapper']
);

echo $OUTPUT->footer();

// ─────────────────────────────────────────────────────────────────────────────
// Génération du token JWT (simplicité : HMAC-SHA256 sans bibliothèque externe)
// ─────────────────────────────────────────────────────────────────────────────
function generate_lti_token(stdClass $user, stdClass $vertex, cm_info $cm, context $context): string {
    global $CFG;

    $secret = $CFG->vertex_jwt_secret ?? ($CFG->passwordsaltmain ?? 'vertex-dev-secret');

    $header  = base64url_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
    $payload = base64url_encode(json_encode([
        'iss'     => $CFG->wwwroot,
        'sub'     => (string) $user->id,
        'email'   => $user->email,
        'name'    => fullname($user),
        'role'    => has_capability('mod/vertex:grade', $context) ? 'instructor' : 'student',
        'cmid'    => $cm->id,
        'vinst'   => $vertex->id,
        'spine'   => $vertex->spine_template,
        'mode'    => $vertex->mode,
        'iat'     => time(),
        'exp'     => time() + 7200,
    ]));

    $sig = base64url_encode(hash_hmac('sha256', "$header.$payload", $secret, true));
    return "$header.$payload.$sig";
}

function base64url_encode(string $data): string {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
