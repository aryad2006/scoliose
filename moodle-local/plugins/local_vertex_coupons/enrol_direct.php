<?php
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/lib.php');
require_login();
require_capability('local/vertex_coupons:manage', context_system::instance());

$PAGE->set_url(new moodle_url('/local/vertex_coupons/enrol_direct.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('VERTEX - Inscription directe');
$PAGE->set_pagelayout('admin');

$step = optional_param('step', 'form', PARAM_ALPHA);

if ($step === 'sendemail') {
    $uid = required_param('uid', PARAM_INT);
    $pwd = base64_decode(optional_param('pwd', '', PARAM_RAW));
    $days = optional_param('days', 30, PARAM_INT);

    $user = $DB->get_record('user', ['id' => $uid]);
    if ($user) {
        $admin = get_admin();
        $login_url = $CFG->wwwroot . '/login/';
        $duration_text = $days . ' jours';
        if ($days == 365) $duration_text = '1 an';
        if ($days == 180) $duration_text = '6 mois';
        if ($days == 90) $duration_text = '3 mois';
        if ($days == 30) $duration_text = '1 mois';

        $subject = 'VERTEX - Vos identifiants de connexion';
        $messagetext = "Bonjour " . fullname($user) . ",\n\nVotre compte VERTEX a ete cree.\n\nSite : {$login_url}\nIdentifiant : {$user->username}\nMot de passe : {$pwd}\nAcces : {$duration_text}\n\nCordialement,\nVERTEX - Formations Medicales";
        $messagehtml = "<div style='font-family:sans-serif;max-width:600px;margin:0 auto;'><div style='background:#1565C0;padding:25px;text-align:center;border-radius:12px 12px 0 0;'><h1 style='color:white;margin:0;'>VERTEX</h1></div><div style='background:white;padding:30px;border:1px solid #e0e0e0;border-top:none;border-radius:0 0 12px 12px;'><p>Bonjour <strong>" . fullname($user) . "</strong>,</p><p>Votre compte a ete cree sur la plateforme VERTEX.</p><div style='background:#E3F2FD;border:2px solid #1565C0;border-radius:12px;padding:20px;margin:20px 0;'><table style='width:100%;'><tr><td style='padding:5px 0;font-weight:600;'>Site</td><td><a href='{$login_url}'>{$login_url}</a></td></tr><tr><td style='padding:5px 0;font-weight:600;'>Identifiant</td><td><code>{$user->username}</code></td></tr><tr><td style='padding:5px 0;font-weight:600;'>Mot de passe</td><td><code>" . htmlspecialchars($pwd) . "</code></td></tr><tr><td style='padding:5px 0;font-weight:600;'>Acces</td><td>{$duration_text}</td></tr></table></div><p style='color:#888;font-size:0.9em;'>Cordialement,<br/>VERTEX - Formations Medicales</p></div></div>";

        $sent = email_to_user($user, $admin, $subject, $messagetext, $messagehtml);

        echo $OUTPUT->header();
        echo '<div style="max-width:600px;margin:30px auto;text-align:center;">';
        if ($sent) {
            echo '<div style="background:#E8F5E9;border:2px solid #2E7D32;border-radius:12px;padding:25px;">';
            echo '<h3 style="color:#2E7D32;">Email envoye avec succes</h3>';
            echo '<p>Les identifiants ont ete envoyes a <strong>' . $user->email . '</strong></p>';
        } else {
            echo '<div style="background:#FFEBEE;border:2px solid #C62828;border-radius:12px;padding:25px;">';
            echo '<h3 style="color:#C62828;">Echec de l\'envoi</h3>';
            echo '<p>Verifiez la configuration SMTP dans Administration > Serveur > Courriel</p>';
        }
        echo '</div>';
        echo '<a href="' . $CFG->wwwroot . '/local/vertex_coupons/enrol_direct.php" style="display:inline-block;margin-top:20px;background:#1565C0;color:white;padding:10px 25px;border-radius:8px;font-weight:600;text-decoration:none;">Inscrire un autre praticien</a>';
        echo '</div>';
        echo $OUTPUT->footer();
        exit;
    }
}

if ($step === 'confirm') {
    $email = required_param('email', PARAM_EMAIL);
    $fullname = required_param('fullname', PARAM_TEXT);
    $password = optional_param('password', 'Vertex2026!', PARAM_RAW);
    $days = required_param('days', PARAM_INT);

    $user = $DB->get_record('user', ['email' => strtolower($email)]);
    $created = false;
    if (!$user) {
        $parts = explode(' ', trim($fullname), 2);
        $user = new stdClass();
        $user->auth = 'manual';
        $user->confirmed = 1;
        $user->username = strtolower(str_replace(['@', '.', ' '], ['_', '_', ''], $email));
        $user->email = strtolower($email);
        $user->firstname = $parts[0];
        $user->lastname = $parts[1] ?? '';
        $user->mnethostid = $CFG->mnet_localhost_id;
        $user->password = hash_internal_user_password($password);
        $user->firstnamephonetic = '';
        $user->lastnamephonetic = '';
        $user->middlename = '';
        $user->alternatename = '';
        $user->timecreated = time();
        $user->timemodified = time();
        $user->id = $DB->insert_record('user', $user);
        $created = true;
    }

    $coupon = vertex_coupons_create($email, $days, $fullname, '', 'Inscription directe');
    vertex_coupons_redeem($coupon->code, $user->id);

    $duration_text = $days . ' jours';
    if ($days == 365) $duration_text = '1 an';
    if ($days == 180) $duration_text = '6 mois';
    if ($days == 90) $duration_text = '3 mois';
    if ($days == 30) $duration_text = '1 mois';

    echo $OUTPUT->header();
    echo '<div style="max-width:600px;margin:30px auto;text-align:center;">';
    echo '<div style="background:#E8F5E9;border:2px solid #2E7D32;border-radius:12px;padding:25px;margin:20px 0;">';
    echo '<h3 style="color:#2E7D32;margin-top:0;">Inscription reussie</h3>';
    echo '<table style="width:100%;text-align:left;margin:15px 0;">';
    echo '<tr><td style="padding:6px;font-weight:600;">Nom</td><td>' . fullname($user) . '</td></tr>';
    echo '<tr><td style="padding:6px;font-weight:600;">Email</td><td>' . $user->email . '</td></tr>';
    echo '<tr><td style="padding:6px;font-weight:600;">Identifiant</td><td><code>' . $user->username . '</code></td></tr>';
    if ($created) {
        echo '<tr><td style="padding:6px;font-weight:600;">Mot de passe</td><td><code>' . htmlspecialchars($password) . '</code></td></tr>';
    }
    echo '<tr><td style="padding:6px;font-weight:600;">Acces</td><td>' . $duration_text . '</td></tr>';
    echo '<tr><td style="padding:6px;font-weight:600;">Expiration</td><td>' . date('d/m/Y', time() + $days * 86400) . '</td></tr>';
    echo '</table></div>';

    $login_url = $CFG->wwwroot . '/login/';
    $copy_msg = "Bonjour " . fullname($user) . ",\\nVotre compte VERTEX :\\nSite: {$login_url}\\nIdentifiant: {$user->username}\\nMot de passe: " . addslashes($password) . "\\nAcces: {$duration_text}";
    echo '<button onclick="navigator.clipboard.writeText(\'' . $copy_msg . '\'.replace(/\\\\n/g, \'\\n\')); this.textContent=\'Copie !\'; this.style.background=\'#2E7D32\';" style="background:#1565C0;color:white;border:none;padding:10px 25px;border-radius:8px;font-weight:600;cursor:pointer;margin:5px;">Copier les identifiants</button>';

    echo ' <a href="' . $CFG->wwwroot . '/local/vertex_coupons/enrol_direct.php?step=sendemail&uid=' . $user->id . '&pwd=' . urlencode(base64_encode($password)) . '&days=' . $days . '" style="display:inline-block;background:#E65100;color:white;padding:10px 25px;border-radius:8px;font-weight:600;text-decoration:none;margin:5px;">Envoyer par email</a>';

    echo ' <a href="' . $CFG->wwwroot . '/local/vertex_coupons/enrol_direct.php" style="display:inline-block;background:#666;color:white;padding:10px 25px;border-radius:8px;font-weight:600;text-decoration:none;margin:5px;">Inscrire un autre</a>';
    echo '</div>';
    echo $OUTPUT->footer();
    exit;
}

echo $OUTPUT->header();
echo '<div style="max-width:600px;margin:30px auto;">';
echo '<div style="background:white;border-radius:12px;padding:30px;box-shadow:0 2px 12px rgba(0,0,0,0.08);border:1px solid #e0e0e0;">';
echo '<h3 style="color:#1565C0;margin-top:0;">Inscription directe d\'un praticien</h3>';
echo '<p style="color:#666;">Cree le compte et inscrit immediatement aux formations.</p>';

echo '<form action="' . $CFG->wwwroot . '/local/vertex_coupons/enrol_direct.php" method="get">';
echo '<input type="hidden" name="step" value="confirm">';
echo '<div style="margin-bottom:15px;"><label style="display:block;font-weight:600;margin-bottom:5px;">Email *</label>';
echo '<input type="email" name="email" required placeholder="praticien@exemple.com" style="width:100%;padding:10px;border:2px solid #E0E0E0;border-radius:8px;box-sizing:border-box;"></div>';
echo '<div style="margin-bottom:15px;"><label style="display:block;font-weight:600;margin-bottom:5px;">Nom complet *</label>';
echo '<input type="text" name="fullname" required placeholder="Dr. Prenom Nom" style="width:100%;padding:10px;border:2px solid #E0E0E0;border-radius:8px;box-sizing:border-box;"></div>';
echo '<div style="margin-bottom:15px;"><label style="display:block;font-weight:600;margin-bottom:5px;">Mot de passe</label>';
echo '<input type="text" name="password" placeholder="Laisser vide = Vertex2026!" style="width:100%;padding:10px;border:2px solid #E0E0E0;border-radius:8px;box-sizing:border-box;"></div>';
echo '<div style="margin-bottom:15px;"><label style="display:block;font-weight:600;margin-bottom:5px;">Duree d\'acces</label>';
echo '<select name="days" style="width:100%;padding:10px;border:2px solid #E0E0E0;border-radius:8px;box-sizing:border-box;">';
echo '<option value="7">7 jours</option><option value="30" selected>30 jours</option><option value="90">90 jours</option><option value="180">6 mois</option><option value="365">1 an</option>';
echo '</select></div>';
echo '<button type="submit" style="width:100%;background:linear-gradient(135deg,#2E7D32,#1B5E20);color:white;border:none;padding:14px;border-radius:10px;font-size:1.05em;font-weight:600;cursor:pointer;">Creer le compte et inscrire</button>';
echo '</form></div></div>';
echo $OUTPUT->footer();
