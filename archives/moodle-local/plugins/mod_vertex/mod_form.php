<?php
// This file is part of Moodle - http://moodle.org/
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/moodleform_mod.php');

/**
 * Formulaire de configuration d'une activité VERTEX.
 */
class mod_vertex_mod_form extends moodleform_mod {

    public function definition() {
        global $CFG;

        $mform = $this->_form;

        // ── Section générale ──────────────────────────────────────────────────
        $mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('text', 'name', get_string('modulename', 'mod_vertex'), ['size' => '64']);
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $this->standard_intro_elements();

        // ── Configuration VERTEX ──────────────────────────────────────────────
        $mform->addElement('header', 'vertex_config', get_string('vertex_config', 'mod_vertex'));

        $mform->addElement(
            'text', 'vertex_url',
            get_string('vertex_url', 'mod_vertex'),
            ['size' => '80', 'placeholder' => 'https://vertex.example.com']
        );
        $mform->setType('vertex_url', PARAM_URL);
        $mform->addHelpButton('vertex_url', 'vertex_url', 'mod_vertex');

        $spineTemplates = [
            'scoliosis_t8_l2'   => 'Scoliose thoracique (T8–L2)',
            'scoliosis_t4_t12'  => 'Scoliose thoracique haute (T4–T12)',
            'scoliosis_l1_l5'   => 'Scoliose lombaire (L1–L5)',
            'double_major'      => 'Double courbe majeure (T6–L4)',
            'adult_deformity'   => 'Déformité adulte (T10–S1)',
            'custom'            => 'Rachis personnalisé (patient saisi)',
        ];
        $mform->addElement(
            'select', 'spine_template',
            get_string('spine_template', 'mod_vertex'),
            $spineTemplates
        );
        $mform->setDefault('spine_template', 'scoliosis_t8_l2');

        $modes = [
            'student'    => get_string('mode_student', 'mod_vertex'),
            'demo'       => get_string('mode_demo',    'mod_vertex'),
            'assessment' => get_string('mode_assessment', 'mod_vertex'),
        ];
        $mform->addElement('select', 'mode', get_string('mode', 'mod_vertex'), $modes);
        $mform->setDefault('mode', 'student');

        $mform->addElement('text', 'max_attempts', get_string('max_attempts', 'mod_vertex'), ['size' => '6']);
        $mform->setType('max_attempts', PARAM_INT);
        $mform->setDefault('max_attempts', 3);

        // ── Notes ─────────────────────────────────────────────────────────────
        $this->standard_grading_coursemodule_elements();

        // ── Complétion ────────────────────────────────────────────────────────
        $mform->addElement(
            'advcheckbox', 'completionsubmit',
            get_string('completionsubmit', 'mod_vertex')
        );

        // ── Boutons standards ─────────────────────────────────────────────────
        $this->add_action_buttons();
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if (!empty($data['vertex_url']) && !filter_var($data['vertex_url'], FILTER_VALIDATE_URL)) {
            $errors['vertex_url'] = get_string('invalidurl', 'mod_vertex');
        }

        if (isset($data['max_attempts']) && $data['max_attempts'] < 1) {
            $errors['max_attempts'] = get_string('error_min_attempts', 'mod_vertex');
        }

        return $errors;
    }
}
