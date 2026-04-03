<?php
// This file is part of Moodle - http://moodle.org/
defined('MOODLE_INTERNAL') || die();

// ─────────────────────────────────────────────────────────────────────────────
// Fonctions standard Moodle (module API)
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Ajoute une instance VERTEX dans la base de données Moodle.
 */
function vertex_add_instance(stdClass $vertex, mod_vertex_mod_form $mform = null): int {
    global $DB;
    $vertex->timecreated  = time();
    $vertex->timemodified = time();
    $vertex->id = $DB->insert_record('vertex', $vertex);
    vertex_grade_item_update($vertex);
    return $vertex->id;
}

/**
 * Met à jour une instance VERTEX existante.
 */
function vertex_update_instance(stdClass $vertex, mod_vertex_mod_form $mform = null): bool {
    global $DB;
    $vertex->timemodified = time();
    $vertex->id = $vertex->instance;
    $result = $DB->update_record('vertex', $vertex);
    vertex_grade_item_update($vertex);
    return $result;
}

/**
 * Supprime une instance VERTEX et ses données associées.
 */
function vertex_delete_instance(int $id): bool {
    global $DB;
    if (!$DB->record_exists('vertex', ['id' => $id])) {
        return false;
    }
    $DB->delete_records('vertex_submissions', ['vertex_id' => $id]);
    $DB->delete_records('vertex', ['id' => $id]);
    grade_update('mod/vertex', 0, 'mod', 'vertex', $id, 0, null, ['deleted' => 1]);
    return true;
}

/**
 * Renvoie l'information sur le module pour les listes d'activités.
 */
function vertex_get_coursemodule_info(cm_info $cm): cached_cm_info {
    global $DB;
    $info = new cached_cm_info();
    $vertex = $DB->get_record('vertex', ['id' => $cm->instance], 'id, name, mode');
    if (!$vertex) return $info;
    $info->name = $vertex->name;
    if ($vertex->mode === 'assessment') {
        $info->iconurl = new moodle_url('/mod/vertex/pix/icon_assessment.svg');
    }
    return $info;
}

// ─────────────────────────────────────────────────────────────────────────────
// Gradebook
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Crée ou met à jour l'élément de note dans le carnet de notes Moodle.
 */
function vertex_grade_item_update(stdClass $vertex, $grades = null): int {
    global $CFG;
    require_once($CFG->libdir . '/gradelib.php');

    $params = [
        'itemname' => $vertex->name,
        'gradetype' => GRADE_TYPE_VALUE,
        'grademax'  => (float) ($vertex->grade ?? 100),
        'gradepass' => (float) ($vertex->gradepass ?? 50),
    ];

    if ($grades === 'reset') {
        $params['reset'] = true;
        $grades = null;
    }

    return grade_update(
        'mod/vertex',
        $vertex->course,
        'mod', 'vertex',
        $vertex->id,
        0,
        $grades,
        $params
    );
}

/**
 * Met à jour la note d'un étudiant dans le carnet de notes.
 */
function vertex_update_grades(stdClass $vertex, int $userid = 0, bool $nullifnone = true): void {
    global $CFG, $DB;
    require_once($CFG->libdir . '/gradelib.php');

    if ($vertex->grade == 0) {
        vertex_grade_item_update($vertex);
    } else if ($grades = vertex_get_user_grades($vertex, $userid)) {
        vertex_grade_item_update($vertex, $grades);
    } else if ($userid && $nullifnone) {
        $grade = ['userid' => $userid, 'rawgrade' => null];
        vertex_grade_item_update($vertex, [$userid => $grade]);
    } else {
        vertex_grade_item_update($vertex);
    }
}

/**
 * Récupère les notes des étudiants depuis vertex_submissions.
 */
function vertex_get_user_grades(stdClass $vertex, int $userid = 0): array {
    global $DB;
    $params = ['vertex_id' => $vertex->id];
    if ($userid) $params['userid'] = $userid;

    $submissions = $DB->get_records('vertex_submissions', $params, 'timemodified DESC', 'userid, grade');
    $grades = [];
    foreach ($submissions as $s) {
        if (!isset($grades[$s->userid])) {
            $grades[$s->userid] = ['userid' => $s->userid, 'rawgrade' => $s->grade];
        }
    }
    return $grades;
}

// ─────────────────────────────────────────────────────────────────────────────
// Completion
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Retourne les critères de complétion supportés par le module.
 */
function vertex_supports(string $feature): ?bool {
    switch ($feature) {
        case FEATURE_GROUPS:                  return true;
        case FEATURE_GROUPINGS:               return true;
        case FEATURE_MOD_INTRO:               return true;
        case FEATURE_COMPLETION_TRACKS_VIEWS: return true;
        case FEATURE_COMPLETION_HAS_RULES:    return true;
        case FEATURE_GRADE_HAS_GRADE:         return true;
        case FEATURE_GRADE_OUTCOMES:          return false;
        case FEATURE_BACKUP_MOODLE2:          return true;
        case FEATURE_SHOW_DESCRIPTION:        return true;
        case FEATURE_MOD_PURPOSE:             return MOD_PURPOSE_ASSESSMENT;
        default:                              return null;
    }
}

/**
 * Vérifie si la complétion est satisfaite pour un utilisateur donné.
 */
function vertex_get_completion_state(
    stdClass $course,
    cm_info $cm,
    int $userid,
    bool $type
): bool {
    global $DB;
    $vertex = $DB->get_record('vertex', ['id' => $cm->instance], '*', MUST_EXIST);

    if (!$vertex->completionsubmit) {
        return $type;
    }

    return $DB->record_exists('vertex_submissions', [
        'vertex_id' => $vertex->id,
        'userid'    => $userid,
        'status'    => 'submitted',
    ]);
}

// ─────────────────────────────────────────────────────────────────────────────
// LTI / API webhook
// ─────────────────────────────────────────────────────────────────────────────

/**
 * Reçoit un score depuis le backend VERTEX (webhook).
 * Appelé par callback.php après une simulation complète.
 *
 * @param int    $vertexid  ID de l'activité
 * @param int    $userid    ID de l'utilisateur Moodle
 * @param array  $data      ['surgery_score'=>int, 'cobb_correction_pct'=>float, ...]
 */
function vertex_receive_score(int $vertexid, int $userid, array $data): void {
    global $DB;

    $vertex = $DB->get_record('vertex', ['id' => $vertexid], '*', MUST_EXIST);

    // Calculer la note Moodle (0-100) depuis surgery_score
    $surgeryScore = $data['surgery_score'] ?? 0;
    $moodleGrade  = round($surgeryScore);

    $submission = $DB->get_record('vertex_submissions', [
        'vertex_id' => $vertexid,
        'userid'    => $userid,
    ], '*');

    $now = time();
    if ($submission) {
        $submission->timemodified       = $now;
        $submission->surgery_score      = $surgeryScore;
        $submission->cobb_correction_pct = $data['cobb_correction_pct'] ?? null;
        $submission->n_screws           = $data['n_screws'] ?? null;
        $submission->grade              = $moodleGrade;
        $submission->status             = 'submitted';
        $submission->payload            = json_encode($data);
        $DB->update_record('vertex_submissions', $submission);
    } else {
        $submission = (object) [
            'vertex_id'          => $vertexid,
            'userid'             => $userid,
            'attempt'            => 1,
            'timecreated'        => $now,
            'timemodified'       => $now,
            'spine_id'           => $data['spine_id'] ?? null,
            'cobb_angle'         => $data['cobb_angle'] ?? null,
            'surgery_score'      => $surgeryScore,
            'cobb_correction_pct' => $data['cobb_correction_pct'] ?? null,
            'n_screws'           => $data['n_screws'] ?? null,
            'grade'              => $moodleGrade,
            'status'             => 'submitted',
            'payload'            => json_encode($data),
        ];
        $DB->insert_record('vertex_submissions', $submission);
    }

    // Mettre à jour le carnet de notes
    vertex_update_grades($vertex, $userid);

    // Déclencher la complétion
    $cm = get_coursemodule_from_instance('vertex', $vertexid, $vertex->course, false, MUST_EXIST);
    $completion = new completion_info(get_course($vertex->course));
    if ($completion->is_enabled($cm)) {
        $completion->update_state($cm, COMPLETION_COMPLETE, $userid);
    }
}
