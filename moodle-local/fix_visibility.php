<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
global $DB, $CFG;

// 1. Check course exists
$course = $DB->get_record('course', ['shortname' => 'SCOL-M01']);
if (!$course) {
    echo "ERREUR: Cours SCOL-M01 introuvable\n";
    exit(1);
}
echo "1. Cours trouve: ID=" . $course->id . " visible=" . $course->visible . "\n";

// 2. Make course visible
$course->visible = 1;
$course->visibleold = 1;
$DB->update_record('course', $course);
echo "2. Cours rendu visible: OK\n";

// 3. Make category visible
$cat = $DB->get_record('course_categories', ['id' => $course->category]);
if ($cat) {
    $cat->visible = 1;
    $cat->visibleold = 1;
    $DB->update_record('course_categories', $cat);
    echo "3. Categorie visible: OK (ID=" . $cat->id . ")\n";
}

// 4. Setup manual enrolment
require_once($CFG->libdir . '/enrollib.php');
$enrolplugin = enrol_get_plugin('manual');
$enrolinstance = $DB->get_record('enrol', ['courseid' => $course->id, 'enrol' => 'manual']);
if (!$enrolinstance) {
    $enrolplugin->add_instance($course);
    $enrolinstance = $DB->get_record('enrol', ['courseid' => $course->id, 'enrol' => 'manual']);
    echo "4. Instance inscription manuelle creee\n";
} else {
    echo "4. Instance inscription manuelle existe (ID=" . $enrolinstance->id . ")\n";
}

// 5. Enrol admin as editing teacher
$admin = $DB->get_record('user', ['username' => 'admin']);
$editingteacher = $DB->get_record('role', ['shortname' => 'editingteacher']);
if ($admin && $editingteacher && $enrolinstance) {
    $enrolplugin->enrol_user($enrolinstance, $admin->id, $editingteacher->id);
    echo "5. Admin inscrit comme enseignant: OK (user_id=" . $admin->id . ")\n";
} else {
    echo "5. ERREUR inscription admin\n";
}

// 6. Create student user
require_once($CFG->dirroot . '/user/lib.php');
$student = $DB->get_record('user', ['username' => 'etudiant1']);
if (!$student) {
    $student = new stdClass();
    $student->username = 'etudiant1';
    $student->password = hash_internal_user_password('Etudiant2026!');
    $student->firstname = 'Sophie';
    $student->lastname = 'Martin';
    $student->email = 'sophie.martin@scoliose.local';
    $student->confirmed = 1;
    $student->mnethostid = $CFG->mnet_localhost_id;
    $student->lang = 'fr';
    $student->auth = 'manual';
    $student->id = user_create_user($student, false);
    echo "6. Etudiant cree: etudiant1 / Etudiant2026! (ID=" . $student->id . ")\n";
} else {
    echo "6. Etudiant existe deja (ID=" . $student->id . ")\n";
}

// 7. Enrol student in course
$studentrole = $DB->get_record('role', ['shortname' => 'student']);
if ($student && $studentrole && $enrolinstance) {
    $enrolplugin->enrol_user($enrolinstance, $student->id, $studentrole->id);
    echo "7. Etudiant inscrit au cours: OK\n";
} else {
    echo "7. ERREUR inscription etudiant\n";
}

// 8. Configure front page to show enrolled courses
set_config('frontpage', '6');
set_config('frontpageloggedin', '6,0');
echo "8. Page d'accueil configuree\n";

// 9. Purge caches
purge_all_caches();
echo "9. Caches purgees\n";

echo "\n=== CONFIGURATION TERMINEE ===\n";
echo "URL cours: http://localhost:8890/course/view.php?id=" . $course->id . "\n";
echo "\nIdentifiants:\n";
echo "  Admin:    admin / ScolioseLMS2026\n";
echo "  Etudiant: etudiant1 / Etudiant2026!\n";
