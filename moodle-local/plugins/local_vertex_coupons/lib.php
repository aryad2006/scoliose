<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Génère un code coupon unique.
 */
function vertex_coupons_generate_code(): string {
    return 'VTX-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4))
         . '-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4))
         . '-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
}

/**
 * Crée un coupon.
 */
function vertex_coupons_create(string $email, int $duration_days, string $fullname = '',
                                string $courses = '', string $note = '', int $created_by = 0): object {
    global $DB, $USER;

    $coupon = new stdClass();
    $coupon->code = vertex_coupons_generate_code();
    $coupon->email = strtolower(trim($email));
    $coupon->fullname = trim($fullname);
    $coupon->duration_days = $duration_days;
    $coupon->courses = $courses;
    $coupon->status = 'active';
    $coupon->created_by = $created_by ?: $USER->id;
    $coupon->timecreated = time();
    $coupon->timemodified = time();

    $coupon->id = $DB->insert_record('vertex_coupons', $coupon);
    return $coupon;
}

/**
 * Utilise un coupon — inscrit l'utilisateur aux cours.
 */
function vertex_coupons_redeem(string $code, int $userid): array {
    global $DB;

    $coupon = $DB->get_record('vertex_coupons', ['code' => strtoupper(trim($code)), 'status' => 'active']);
    if (!$coupon) {
        // Essayer sans majuscules
        $coupon = $DB->get_record('vertex_coupons', ['code' => trim($code), 'status' => 'active']);
    }
    if (!$coupon) {
        return ['success' => false, 'message' => get_string('invalid_coupon', 'local_vertex_coupons')];
    }

    // Vérifier que l'email correspond
    $user = $DB->get_record('user', ['id' => $userid]);
    if ($coupon->email && strtolower($user->email) !== strtolower($coupon->email)) {
        return ['success' => false, 'message' => 'Ce coupon est réservé à une autre adresse email.'];
    }

    // Marquer comme utilisé
    $coupon->status = 'used';
    $coupon->used_by = $userid;
    $coupon->used_at = time();
    $coupon->expires_at = time() + ($coupon->duration_days * 86400);
    $coupon->timemodified = time();
    $DB->update_record('vertex_coupons', $coupon);

    // Inscrire aux cours
    $enrolplugin = enrol_get_plugin('manual');
    $enrolled_courses = [];

    if (!empty($coupon->courses)) {
        $courseids = explode(',', $coupon->courses);
    } else {
        // Tous les cours VERTEX
        $courses = $DB->get_records_select('course', "shortname LIKE 'VERTEX-%'", null, '', 'id');
        $courseids = array_keys($courses);
    }

    foreach ($courseids as $courseid) {
        $courseid = intval(trim($courseid));
        if ($courseid <= 1) continue;

        $course = $DB->get_record('course', ['id' => $courseid]);
        if (!$course) continue;

        $instances = $DB->get_records('enrol', ['courseid' => $courseid, 'enrol' => 'manual']);
        $instance = reset($instances);

        if (!$instance) {
            // Créer une instance d'inscription manuelle
            $instanceid = $enrolplugin->add_instance($course);
            $instance = $DB->get_record('enrol', ['id' => $instanceid]);
        }

        // Inscrire avec date de fin
        $enrolplugin->enrol_user($instance, $userid, 5, time(), $coupon->expires_at);
        $enrolled_courses[] = $course->fullname;
    }

    return [
        'success' => true,
        'message' => get_string('coupon_redeemed', 'local_vertex_coupons'),
        'courses' => $enrolled_courses,
        'expires' => $coupon->expires_at,
    ];
}

/**
 * Envoie le coupon par email au bénéficiaire.
 * Retourne true si envoyé, false sinon.
 */
function vertex_coupons_send_email(object $coupon): bool {
    global $CFG, $DB;

    $admin = get_admin();
    $recipient = new stdClass();
    $recipient->id = -1;
    $recipient->email = $coupon->email;
    $recipient->firstname = explode(' ', $coupon->fullname ?: 'Praticien')[0];
    $recipient->lastname = trim(substr($coupon->fullname ?: '', strlen($recipient->firstname)));
    if (empty($recipient->lastname)) $recipient->lastname = '';
    $recipient->maildisplay = 1;
    $recipient->mailformat = 1;
    $recipient->auth = 'manual';
    $recipient->suspended = 0;
    $recipient->deleted = 0;

    // Vérifier si l'utilisateur existe déjà
    $existing = $DB->get_record('user', ['email' => strtolower($coupon->email)]);
    if ($existing) {
        $recipient = $existing;
    }

    $siteurl = $CFG->wwwroot;
    $duration_text = $coupon->duration_days . ' jours';
    if ($coupon->duration_days == 365) $duration_text = '1 an';
    if ($coupon->duration_days == 180) $duration_text = '6 mois';
    if ($coupon->duration_days == 90) $duration_text = '3 mois';
    if ($coupon->duration_days == 30) $duration_text = '1 mois';

    $subject = "VERTEX© — Votre coupon d'accès aux formations médicales";

    $messagetext = "Bonjour" . ($coupon->fullname ? " {$coupon->fullname}" : "") . ",\n\n"
        . "Vous avez reçu un accès gratuit à la plateforme VERTEX© — Formations Médicales en Ligne.\n\n"
        . "Votre code coupon : {$coupon->code}\n"
        . "Durée d'accès : {$duration_text}\n\n"
        . "Pour activer votre accès :\n"
        . "1. Créez votre compte sur {$siteurl}/login/signup.php\n"
        . "2. Connectez-vous puis rendez-vous sur {$siteurl}/local/vertex_coupons/redeem.php\n"
        . "3. Saisissez votre code coupon : {$coupon->code}\n\n"
        . "Vous aurez alors accès à toutes les formations pendant {$duration_text}.\n\n"
        . "Cordialement,\n"
        . "L'équipe VERTEX©\n"
        . $siteurl;

    $messagehtml = "
<div style='font-family: Segoe UI, Roboto, sans-serif; max-width: 600px; margin: 0 auto; background: #f8f9fa; padding: 0;'>
    <div style='background: linear-gradient(135deg, #0D47A1, #1565C0); padding: 30px; text-align: center; border-radius: 12px 12px 0 0;'>
        <h1 style='color: white; margin: 0; font-size: 28px;'>VERTEX©</h1>
        <p style='color: #B3E5FC; margin: 5px 0 0; font-size: 14px;'>Formations Médicales en Ligne</p>
    </div>
    <div style='background: white; padding: 35px; border-radius: 0 0 12px 12px; border: 1px solid #e0e0e0; border-top: none;'>
        <p style='color: #333; font-size: 16px;'>Bonjour" . ($coupon->fullname ? " <strong>{$coupon->fullname}</strong>" : "") . ",</p>
        <p style='color: #555;'>Vous avez reçu un accès gratuit à la plateforme VERTEX©.</p>

        <div style='background: #E3F2FD; border: 2px solid #1565C0; border-radius: 12px; padding: 25px; text-align: center; margin: 25px 0;'>
            <p style='color: #1565C0; font-size: 14px; margin: 0 0 10px; font-weight: 600;'>VOTRE CODE COUPON</p>
            <p style='font-size: 28px; font-weight: 700; color: #0D47A1; letter-spacing: 3px; margin: 0; font-family: monospace;'>{$coupon->code}</p>
            <p style='color: #666; font-size: 13px; margin: 10px 0 0;'>Durée d'accès : <strong>{$duration_text}</strong></p>
        </div>

        <h3 style='color: #1565C0; font-size: 16px;'>Comment activer votre accès :</h3>
        <ol style='color: #555; line-height: 1.8;'>
            <li>Créez votre compte sur <a href='{$siteurl}/login/signup.php' style='color: #1565C0;'>la page d'inscription</a></li>
            <li>Connectez-vous à votre compte</li>
            <li>Rendez-vous sur <a href='{$siteurl}/local/vertex_coupons/redeem.php' style='color: #1565C0;'>la page d'activation</a></li>
            <li>Saisissez votre code coupon</li>
        </ol>

        <p style='color: #888; font-size: 13px; margin-top: 30px; border-top: 1px solid #eee; padding-top: 15px;'>
            Cet email a été envoyé automatiquement par la plateforme VERTEX©.<br/>
            <a href='{$siteurl}' style='color: #1565C0;'>{$siteurl}</a>
        </p>
    </div>
</div>";

    return email_to_user($recipient, $admin, $subject, $messagetext, $messagehtml);
}

/**
 * Ajoute le lien dans la navigation admin.
 */
function local_vertex_coupons_extend_navigation(global_navigation $nav) {
    // Rien ici — on utilise settings navigation.
}

function local_vertex_coupons_extend_settings_navigation(settings_navigation $nav, context $context) {
    if (!has_capability('local/vertex_coupons:manage', context_system::instance())) {
        return;
    }

    $siteadmin = $nav->find('siteadministration', navigation_node::TYPE_SITE_ADMIN);
    if (!$siteadmin) return;

    $node = $siteadmin->add(
        'VERTEX© Coupons',
        new moodle_url('/local/vertex_coupons/manage.php'),
        navigation_node::TYPE_CUSTOM,
        null, 'vertex_coupons',
        new pix_icon('i/settings', '')
    );
}
