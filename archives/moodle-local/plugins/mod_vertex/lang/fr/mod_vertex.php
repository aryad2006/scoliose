<?php
// This file is part of Moodle - http://moodle.org/
// Strings langue français pour mod_vertex
defined('MOODLE_INTERNAL') || die();

$string['pluginname']       = 'VERTEX — Simulateur Rachidien';
$string['modulename']       = 'VERTEX Simulation';
$string['modulenameplural'] = 'Simulations VERTEX';
$string['pluginadministration'] = 'Administration VERTEX';

// Description
$string['modulename_help'] = 'L\'activité VERTEX intègre le simulateur biomécanique du rachis dans votre cours Moodle. Les étudiants créent un patient, paramètrent une scoliose, simulent le comportement mécanique et planifient une correction chirurgicale. Le score de chirurgie (/100) est automatiquement reporté dans le carnet de notes.';

// Formulaire
$string['vertex_config']     = 'Configuration VERTEX';
$string['vertex_url']        = 'URL du simulateur VERTEX';
$string['vertex_url_help']   = 'URL de base de l\'application VERTEX (ex: https://vertex.mondomaine.fr). Laisser vide pour utiliser l\'URL par défaut configurée dans l\'administration du site.';
$string['spine_template']    = 'Rachis modèle';
$string['mode']              = 'Mode d\'activité';
$string['mode_student']      = 'Étudiant (sans assistance)';
$string['mode_demo']         = 'Démonstration (guidée)';
$string['mode_assessment']   = 'Évaluation (notation)';
$string['max_attempts']      = 'Nombre de tentatives maximum';
$string['completionsubmit']  = 'Requis pour complétion : soumettre au moins une simulation';

// Résultats
$string['last_attempt']      = 'Dernière tentative :';
$string['surgery_score']     = 'Score chirurgical';
$string['moodle_grade']      = 'Note Moodle';
$string['cobb_correction']   = 'Correction Cobb';

// Erreurs
$string['invalidurl']        = 'L\'URL fournie n\'est pas valide.';
$string['error_min_attempts']= 'Le nombre de tentatives doit être au moins 1.';

// Capabilities
$string['vertex:view']       = 'Afficher une simulation VERTEX';
$string['vertex:submit']     = 'Soumettre une simulation VERTEX';
$string['vertex:grade']      = 'Noter les simulations VERTEX';
$string['vertex:viewreports']= 'Voir les rapports VERTEX';

// Événements
$string['event_course_module_viewed'] = 'Simulation VERTEX consultée';
$string['event_submission_created']   = 'Simulation VERTEX soumise';
$string['event_grade_updated']        = 'Note VERTEX mise à jour';
