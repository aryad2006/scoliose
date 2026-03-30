<?php
/**
 * VERTEX© Coupons — Interface d'administration.
 *
 * Permet à l'admin de :
 * - Créer des coupons individuels ou par lot
 * - Inscrire directement un praticien par email
 * - Voir et gérer tous les coupons
 * - Révoquer des accès
 */
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once(__DIR__ . '/lib.php');

require_login();
require_capability('local/vertex_coupons:manage', context_system::instance());

$action = optional_param('action', 'list', PARAM_ALPHA);

$PAGE->set_url(new moodle_url('/local/vertex_coupons/manage.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('VERTEX© — Gestion des accès');
$PAGE->set_heading('VERTEX© — Gestion des accès et coupons');
$PAGE->set_pagelayout('admin');

// Traitement des actions POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && confirm_sesskey()) {
    $action_post = required_param('formaction', PARAM_ALPHA);

    if ($action_post === 'create_coupon') {
        $email = required_param('email', PARAM_EMAIL);
        $fullname = optional_param('fullname', '', PARAM_TEXT);
        $duration = required_param('duration_days', PARAM_INT);
        $courses = optional_param('courses', '', PARAM_TEXT);
        $note = optional_param('note', '', PARAM_TEXT);

        $coupon = vertex_coupons_create($email, $duration, $fullname, $courses, $note);
        $send = optional_param('send_email', 0, PARAM_INT);

        $msg = "Coupon créé : {$coupon->code}";
        if ($send) {
            $sent = vertex_coupons_send_email($coupon);
            $msg .= $sent ? " — Email envoyé à {$email}" : " — Échec d'envoi email (vérifiez la config SMTP)";
        }

        redirect(new moodle_url('/local/vertex_coupons/manage.php', ['action' => 'created', 'code' => $coupon->code]),
            $msg, null, \core\output\notification::NOTIFY_SUCCESS);
    }

    if ($action_post === 'direct_enrol') {
        $email = required_param('email', PARAM_EMAIL);
        $fullname = optional_param('fullname', '', PARAM_TEXT);
        $duration = required_param('duration_days', PARAM_INT);
        $courses = optional_param('courses', '', PARAM_TEXT);
        $password = optional_param('password', '', PARAM_RAW);

        // Créer le compte s'il n'existe pas
        $user = $DB->get_record('user', ['email' => strtolower($email)]);
        if (!$user) {
            $nameParts = explode(' ', trim($fullname), 2);
            $user = new stdClass();
            $user->auth = 'manual';
            $user->confirmed = 1;
            $user->username = strtolower(str_replace(['@', '.', ' '], ['_', '_', ''], $email));
            $user->email = strtolower($email);
            $user->firstname = $nameParts[0] ?? 'Praticien';
            $user->lastname = $nameParts[1] ?? '';
            $user->mnethostid = $CFG->mnet_localhost_id;
            $user->password = $password ? hash_internal_user_password($password) : hash_internal_user_password('Vertex2026!');
            $user->timecreated = time();
            $user->timemodified = time();
            $user->id = $DB->insert_record('user', $user);
            $created_user = true;
        } else {
            $created_user = false;
        }

        // Créer un coupon et l'utiliser immédiatement
        $coupon = vertex_coupons_create($email, $duration, $fullname, $courses, 'Inscription directe par admin');
        $result = vertex_coupons_redeem($coupon->code, $user->id);

        $actual_password = $password ?: 'Vertex2026!';

        redirect(new moodle_url('/local/vertex_coupons/manage.php', [
            'action' => 'enrolled',
            'uid' => $user->id,
            'new' => $created_user ? 1 : 0,
            'pwd' => base64_encode($actual_password),
            'days' => $duration,
        ]), '', null, \core\output\notification::NOTIFY_SUCCESS);
    }

    if ($action_post === 'batch_create') {
        $emails_raw = required_param('emails', PARAM_TEXT);
        $duration = required_param('duration_days', PARAM_INT);
        $courses = optional_param('courses', '', PARAM_TEXT);

        $emails = array_filter(array_map('trim', explode("\n", $emails_raw)));
        $count = 0;
        foreach ($emails as $line) {
            $parts = array_map('trim', explode(',', $line));
            $email = $parts[0] ?? '';
            $name = $parts[1] ?? '';
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                vertex_coupons_create($email, $duration, $name, $courses, 'Lot du ' . date('d/m/Y'));
                $count++;
            }
        }
        redirect(new moodle_url('/local/vertex_coupons/manage.php'),
            "{$count} coupons créés", null, \core\output\notification::NOTIFY_SUCCESS);
    }

    if ($action_post === 'send_welcome') {
        $user_id = required_param('user_id', PARAM_INT);
        $password = optional_param('password', '', PARAM_RAW);
        $days = optional_param('days', 30, PARAM_INT);

        $user = $DB->get_record('user', ['id' => $user_id]);
        if ($user) {
            $admin = get_admin();
            $login_url = $CFG->wwwroot . '/login/';
            $duration_text = $days . ' jours';
            if ($days == 365) $duration_text = '1 an';
            if ($days == 180) $duration_text = '6 mois';
            if ($days == 90) $duration_text = '3 mois';

            $subject = 'VERTEX - Vos identifiants de connexion';
            $messagetext = "Bonjour " . fullname($user) . ",\n\nVotre compte VERTEX a ete cree.\n\nSite : {$login_url}\nIdentifiant : {$user->username}\nMot de passe : {$password}\nAcces : {$duration_text}\n\nCordialement,\nVERTEX - Formations Medicales";
            $messagehtml = "<div style='font-family:sans-serif;max-width:600px;margin:0 auto;'><div style='background:#1565C0;padding:25px;text-align:center;border-radius:12px 12px 0 0;'><h1 style='color:white;margin:0;'>VERTEX</h1></div><div style='background:white;padding:30px;border:1px solid #e0e0e0;border-top:none;border-radius:0 0 12px 12px;'><p>Bonjour <strong>" . fullname($user) . "</strong>,</p><p>Votre compte a ete cree sur la plateforme VERTEX.</p><div style='background:#E3F2FD;border:2px solid #1565C0;border-radius:12px;padding:20px;margin:20px 0;'><table style='width:100%;'><tr><td style='padding:5px 0;font-weight:600;'>Site</td><td><a href='{$login_url}'>{$login_url}</a></td></tr><tr><td style='padding:5px 0;font-weight:600;'>Identifiant</td><td><code>{$user->username}</code></td></tr><tr><td style='padding:5px 0;font-weight:600;'>Mot de passe</td><td><code>" . htmlspecialchars($password) . "</code></td></tr><tr><td style='padding:5px 0;font-weight:600;'>Acces</td><td>{$duration_text}</td></tr></table></div><p style='color:#888;font-size:0.9em;'>Cordialement,<br/>VERTEX - Formations Medicales</p></div></div>";

            $sent = email_to_user($user, $admin, $subject, $messagetext, $messagehtml);
            $msg = $sent ? "Email envoye a {$user->email}" : "Echec d envoi — verifiez la configuration SMTP";
            $type = $sent ? \core\output\notification::NOTIFY_SUCCESS : \core\output\notification::NOTIFY_ERROR;
            redirect(new moodle_url('/local/vertex_coupons/manage.php', [
                'action' => 'enrolled', 'uid' => $user->id, 'new' => 0,
                'pwd' => base64_encode($password), 'days' => $days,
            ]), $msg, null, $type);
        }
    }

    if ($action_post === 'send') {
        $coupon_id = required_param('coupon_id', PARAM_INT);
        $coupon = $DB->get_record('vertex_coupons', ['id' => $coupon_id]);
        if ($coupon) {
            $sent = vertex_coupons_send_email($coupon);
            $msg = $sent ? "Email envoyé à {$coupon->email}" : "Échec d'envoi — vérifiez la configuration SMTP dans Administration > Serveur > Courriel";
            $type = $sent ? \core\output\notification::NOTIFY_SUCCESS : \core\output\notification::NOTIFY_ERROR;
            redirect(new moodle_url('/local/vertex_coupons/manage.php', ['action' => 'created', 'code' => $coupon->code]),
                $msg, null, $type);
        }
    }

    if ($action_post === 'revoke') {
        $coupon_id = required_param('coupon_id', PARAM_INT);
        $DB->set_field('vertex_coupons', 'status', 'revoked', ['id' => $coupon_id]);
        $DB->set_field('vertex_coupons', 'timemodified', time(), ['id' => $coupon_id]);
        redirect(new moodle_url('/local/vertex_coupons/manage.php'),
            'Coupon révoqué', null, \core\output\notification::NOTIFY_WARNING);
    }
}

// Récupérer les cours VERTEX pour le sélecteur
$vertex_courses = $DB->get_records_select('course', "shortname LIKE 'VERTEX-%'", null, 'fullname', 'id, fullname, shortname');

echo $OUTPUT->header();

// CSS inline pour l'interface admin
echo '<style>
.vertex-admin { max-width: 1200px; margin: 0 auto; }
.vertex-tabs { display: flex; gap: 0; margin-bottom: 30px; border-bottom: 3px solid #1565C0; }
.vertex-tab { padding: 12px 25px; cursor: pointer; font-weight: 600; color: #666; border: 1px solid #ddd;
    border-bottom: none; border-radius: 8px 8px 0 0; background: #f5f5f5; text-decoration: none; }
.vertex-tab.active, .vertex-tab:hover { background: #1565C0; color: white; border-color: #1565C0; }
.vertex-card { background: white; border-radius: 12px; padding: 25px; margin-bottom: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08); border: 1px solid #e0e0e0; }
.vertex-card h3 { color: #1565C0; margin-top: 0; font-size: 1.3em; margin-bottom: 20px;
    padding-bottom: 10px; border-bottom: 2px solid #E3F2FD; }
.vertex-form-group { margin-bottom: 15px; }
.vertex-form-group label { display: block; font-weight: 600; color: #333; margin-bottom: 5px; }
.vertex-form-group input, .vertex-form-group select, .vertex-form-group textarea {
    width: 100%; padding: 10px 14px; border: 2px solid #E0E0E0; border-radius: 8px; font-size: 0.95em; }
.vertex-form-group input:focus, .vertex-form-group select:focus, .vertex-form-group textarea:focus {
    border-color: #1565C0; outline: none; box-shadow: 0 0 0 3px rgba(21,101,192,0.1); }
.vertex-btn { padding: 10px 25px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;
    font-size: 0.95em; transition: all 0.3s; }
.vertex-btn-primary { background: linear-gradient(135deg, #1565C0, #0D47A1); color: white; }
.vertex-btn-primary:hover { box-shadow: 0 4px 15px rgba(21,101,192,0.3); transform: translateY(-1px); }
.vertex-btn-success { background: linear-gradient(135deg, #2E7D32, #1B5E20); color: white; }
.vertex-btn-danger { background: #C62828; color: white; padding: 5px 12px; font-size: 0.85em; }
.vertex-table { width: 100%; border-collapse: collapse; }
.vertex-table th { background: #1565C0; color: white; padding: 10px 12px; text-align: left; font-size: 0.85em; }
.vertex-table td { padding: 8px 12px; border-bottom: 1px solid #E0E0E0; font-size: 0.9em; }
.vertex-table tr:hover { background: #E3F2FD; }
.vertex-badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 0.8em; font-weight: 600; }
.vertex-badge-active { background: #E8F5E9; color: #2E7D32; }
.vertex-badge-used { background: #E3F2FD; color: #1565C0; }
.vertex-badge-expired { background: #FFF3E0; color: #E65100; }
.vertex-badge-revoked { background: #FFEBEE; color: #C62828; }
.vertex-row { display: flex; gap: 20px; }
.vertex-col { flex: 1; }
.vertex-hint { font-size: 0.82em; color: #888; margin-top: 3px; }
</style>';

echo '<div class="vertex-admin">';

// Onglets
echo '<div class="vertex-tabs">';
$tabs = ['list' => 'Coupons', 'create' => 'Créer un coupon', 'direct' => 'Inscription directe', 'batch' => 'Lot'];
foreach ($tabs as $key => $label) {
    $active = ($action === $key) ? ' active' : '';
    echo "<a href='?action={$key}' class='vertex-tab{$active}'>{$label}</a>";
}
echo '</div>';

// === ONGLET : LISTE DES COUPONS ===
if ($action === 'list') {
    $coupons = $DB->get_records('vertex_coupons', null, 'timecreated DESC');

    echo '<div class="vertex-card">';
    echo '<h3>Liste des coupons (' . count($coupons) . ')</h3>';

    if (empty($coupons)) {
        echo '<p style="color: #888; text-align: center; padding: 40px;">Aucun coupon créé. Utilisez les onglets ci-dessus.</p>';
    } else {
        echo '<table class="vertex-table">';
        echo '<tr><th>Code</th><th>Email</th><th>Nom</th><th>Durée</th><th>Statut</th><th>Créé</th><th>Expire</th><th>Actions</th></tr>';
        foreach ($coupons as $c) {
            $badge_class = 'vertex-badge-' . $c->status;
            $status_label = $c->status;
            if ($c->status === 'active') $status_label = 'Actif';
            if ($c->status === 'used') $status_label = 'Utilisé';
            if ($c->status === 'expired') $status_label = 'Expiré';
            if ($c->status === 'revoked') $status_label = 'Révoqué';

            $expires = $c->expires_at ? date('d/m/Y', $c->expires_at) : '—';
            if ($c->status === 'used' && $c->expires_at && $c->expires_at < time()) {
                $badge_class = 'vertex-badge-expired';
                $status_label = 'Expiré';
            }

            echo '<tr>';
            echo "<td><code style='background:#f5f5f5; padding:3px 8px; border-radius:4px;'>{$c->code}</code></td>";
            echo "<td>{$c->email}</td>";
            echo "<td>{$c->fullname}</td>";
            echo "<td>{$c->duration_days}j</td>";
            echo "<td><span class='vertex-badge {$badge_class}'>{$status_label}</span></td>";
            echo "<td>" . date('d/m/Y', $c->timecreated) . "</td>";
            echo "<td>{$expires}</td>";
            echo "<td>";
            if ($c->status === 'active' || $c->status === 'used') {
                echo "<form method='post' style='display:inline;'>";
                echo "<input type='hidden' name='sesskey' value='" . sesskey() . "'>";
                echo "<input type='hidden' name='formaction' value='revoke'>";
                echo "<input type='hidden' name='coupon_id' value='{$c->id}'>";
                echo "<button type='submit' class='vertex-btn vertex-btn-danger' onclick='return confirm(\"Révoquer ce coupon ?\")'>Révoquer</button>";
                echo "</form>";
            }
            echo "</td>";
            echo '</tr>';
        }
        echo '</table>';
    }
    echo '</div>';
}

// === ONGLET : CRÉER UN COUPON ===
if ($action === 'create') {
    echo '<div class="vertex-card">';
    echo '<h3>Créer un coupon d\'accès gratuit</h3>';
    echo '<p style="color:#666;">Le praticien recevra un code à saisir pour activer son accès temporaire.</p>';
    echo '<form method="post">';
    echo '<input type="hidden" name="sesskey" value="' . sesskey() . '">';
    echo '<input type="hidden" name="formaction" value="create_coupon">';

    echo '<div class="vertex-row"><div class="vertex-col">';
    echo '<div class="vertex-form-group"><label>Email du bénéficiaire *</label>';
    echo '<input type="email" name="email" required placeholder="praticien@exemple.com"></div></div>';
    echo '<div class="vertex-col">';
    echo '<div class="vertex-form-group"><label>Nom complet</label>';
    echo '<input type="text" name="fullname" placeholder="Dr. Nom Prénom"></div></div></div>';

    echo '<div class="vertex-row"><div class="vertex-col">';
    echo '<div class="vertex-form-group"><label>Durée d\'accès *</label>';
    echo '<select name="duration_days">';
    echo '<option value="7">7 jours (essai)</option>';
    echo '<option value="14">14 jours</option>';
    echo '<option value="30" selected>30 jours (1 mois)</option>';
    echo '<option value="90">90 jours (3 mois)</option>';
    echo '<option value="180">180 jours (6 mois)</option>';
    echo '<option value="365">365 jours (1 an)</option>';
    echo '</select></div></div>';
    echo '<div class="vertex-col">';
    echo '<div class="vertex-form-group"><label>Formations</label>';
    echo '<select name="courses"><option value="">Toutes les formations</option>';
    foreach ($vertex_courses as $vc) {
        echo "<option value='{$vc->id}'>{$vc->fullname}</option>";
    }
    echo '</select></div></div></div>';

    echo '<div class="vertex-form-group"><label>Note interne</label>';
    echo '<input type="text" name="note" placeholder="Raison, contexte..."></div>';

    echo '<div class="vertex-form-group" style="margin-top: 15px;">';
    echo '<label><input type="checkbox" name="send_email" value="1" checked style="margin-right: 8px;">Envoyer automatiquement par email au bénéficiaire</label>';
    echo '</div>';

    echo '<button type="submit" class="vertex-btn vertex-btn-primary">Générer le coupon</button>';
    echo '</form></div>';
}

// === ONGLET : COUPON CRÉÉ (affichage + copie) ===
if ($action === 'created') {
    $code = required_param('code', PARAM_TEXT);
    $coupon = $DB->get_record('vertex_coupons', ['code' => $code]);

    if ($coupon) {
        $duration_text = $coupon->duration_days . ' jours';
        if ($coupon->duration_days == 365) $duration_text = '1 an';
        if ($coupon->duration_days == 180) $duration_text = '6 mois';
        if ($coupon->duration_days == 90) $duration_text = '3 mois';
        if ($coupon->duration_days == 30) $duration_text = '1 mois';

        $redeem_url = $CFG->wwwroot . '/local/vertex_coupons/redeem.php';

        echo '<div class="vertex-card" style="text-align: center;">';
        echo '<h3 style="border: none;">Coupon créé avec succès</h3>';
        echo "<p>Pour <strong>{$coupon->email}</strong>" . ($coupon->fullname ? " ({$coupon->fullname})" : "") . "</p>";
        echo "<p>Durée d'accès : <strong>{$duration_text}</strong></p>";

        echo '<div style="background: #E3F2FD; border: 2px solid #1565C0; border-radius: 12px; padding: 25px; margin: 25px auto; max-width: 400px;">';
        echo '<p style="color: #1565C0; font-size: 0.9em; margin: 0 0 10px; font-weight: 600;">CODE COUPON</p>';
        echo "<p id='coupon-code' style='font-size: 1.8em; font-weight: 700; color: #0D47A1; letter-spacing: 3px; margin: 0; font-family: monospace;'>{$coupon->code}</p>";
        echo '</div>';

        echo "<button onclick=\"navigator.clipboard.writeText('{$coupon->code}'); this.textContent='Copié !'; this.style.background='#2E7D32';\" class='vertex-btn vertex-btn-primary' style='margin: 5px;'>Copier le code</button>";

        // Bouton copier le message complet
        $full_msg = "Bonjour" . ($coupon->fullname ? " {$coupon->fullname}" : "") . ",\\n\\nVoici votre coupon d'accès VERTEX© :\\n\\nCode : {$coupon->code}\\nDurée : {$duration_text}\\n\\nActivez-le ici : {$redeem_url}\\n\\nCordialement,\\nVERTEX©";
        echo "<button onclick=\"navigator.clipboard.writeText('" . addslashes($full_msg) . "'.replace(/\\\\n/g, '\\n')); this.textContent='Message copié !'; this.style.background='#2E7D32';\" class='vertex-btn vertex-btn-primary' style='margin: 5px; background: #00838F;'>Copier le message complet</button>";

        // Bouton envoyer par email (si pas encore envoyé)
        echo "<form method='post' style='display: inline-block; margin: 5px;'>";
        echo "<input type='hidden' name='sesskey' value='" . sesskey() . "'>";
        echo "<input type='hidden' name='formaction' value='send'>";
        echo "<input type='hidden' name='coupon_id' value='{$coupon->id}'>";
        echo "<button type='submit' class='vertex-btn' style='background: #E65100; color: white;'>Envoyer par email</button>";
        echo "</form>";

        echo '<p style="margin-top: 20px;"><a href="?action=create">Créer un autre coupon</a> · <a href="?action=list">Voir tous les coupons</a></p>';
        echo '</div>';
    }
}

// === ONGLET : INSCRIPTION DIRECTE ===
if ($action === 'direct') {
    echo '<div class="vertex-card">';
    echo '<h3>Inscrire directement un praticien</h3>';
    echo '<p style="color:#666;">Crée le compte (si inexistant) et inscrit immédiatement le praticien aux formations choisies.</p>';
    echo '<form method="post">';
    echo '<input type="hidden" name="sesskey" value="' . sesskey() . '">';
    echo '<input type="hidden" name="formaction" value="direct_enrol">';

    echo '<div class="vertex-row"><div class="vertex-col">';
    echo '<div class="vertex-form-group"><label>Email *</label>';
    echo '<input type="email" name="email" required placeholder="praticien@exemple.com"></div></div>';
    echo '<div class="vertex-col">';
    echo '<div class="vertex-form-group"><label>Nom complet *</label>';
    echo '<input type="text" name="fullname" required placeholder="Dr. Nom Prénom"></div></div></div>';

    echo '<div class="vertex-row"><div class="vertex-col">';
    echo '<div class="vertex-form-group"><label>Mot de passe</label>';
    echo '<input type="text" name="password" placeholder="Laisser vide = Vertex2026!">';
    echo '<div class="vertex-hint">Mot de passe initial — le praticien pourra le changer</div></div></div>';
    echo '<div class="vertex-col">';
    echo '<div class="vertex-form-group"><label>Durée d\'accès *</label>';
    echo '<select name="duration_days">';
    echo '<option value="7">7 jours</option>';
    echo '<option value="30" selected>30 jours</option>';
    echo '<option value="90">90 jours</option>';
    echo '<option value="180">180 jours</option>';
    echo '<option value="365">365 jours</option>';
    echo '</select></div></div></div>';

    echo '<div class="vertex-form-group"><label>Formations</label>';
    echo '<select name="courses"><option value="">Toutes les formations</option>';
    foreach ($vertex_courses as $vc) {
        echo "<option value='{$vc->id}'>{$vc->fullname}</option>";
    }
    echo '</select></div>';

    echo '<button type="submit" class="vertex-btn vertex-btn-success">Créer le compte et inscrire</button>';
    echo '</form></div>';
}

// === ONGLET : CRÉATION PAR LOT ===
if ($action === 'batch') {
    echo '<div class="vertex-card">';
    echo '<h3>Création de coupons par lot</h3>';
    echo '<p style="color:#666;">Un email par ligne. Format : <code>email@exemple.com, Nom Complet</code> (le nom est optionnel).</p>';
    echo '<form method="post">';
    echo '<input type="hidden" name="sesskey" value="' . sesskey() . '">';
    echo '<input type="hidden" name="formaction" value="batch_create">';

    echo '<div class="vertex-form-group"><label>Emails (un par ligne) *</label>';
    echo '<textarea name="emails" rows="8" required placeholder="dr.dupont@hopital.fr, Dr. Jean Dupont
dr.martin@clinique.fr, Dr. Marie Martin
specialiste@cabinet.fr"></textarea></div>';

    echo '<div class="vertex-row"><div class="vertex-col">';
    echo '<div class="vertex-form-group"><label>Durée d\'accès *</label>';
    echo '<select name="duration_days">';
    echo '<option value="7">7 jours</option>';
    echo '<option value="30" selected>30 jours</option>';
    echo '<option value="90">90 jours</option>';
    echo '<option value="365">365 jours</option>';
    echo '</select></div></div>';
    echo '<div class="vertex-col">';
    echo '<div class="vertex-form-group"><label>Formations</label>';
    echo '<select name="courses"><option value="">Toutes les formations</option>';
    foreach ($vertex_courses as $vc) {
        echo "<option value='{$vc->id}'>{$vc->fullname}</option>";
    }
    echo '</select></div></div></div>';

    echo '<button type="submit" class="vertex-btn vertex-btn-primary">Créer les coupons</button>';
    echo '</form></div>';
}

// === ONGLET : CONFIRMATION INSCRIPTION ===
if ($action === 'enrolled') {
    $uid = required_param('uid', PARAM_INT);
    $is_new = optional_param('new', 0, PARAM_INT);
    $pwd_b64 = optional_param('pwd', '', PARAM_RAW);
    $days = optional_param('days', 30, PARAM_INT);
    $actual_pwd = base64_decode($pwd_b64);

    $user = $DB->get_record('user', ['id' => $uid]);

    if ($user) {
        $duration_text = $days . ' jours';
        if ($days == 365) $duration_text = '1 an';
        if ($days == 180) $duration_text = '6 mois';
        if ($days == 90) $duration_text = '3 mois';

        echo '<div class="vertex-card" style="text-align: center;">';
        echo '<h3 style="border: none; color: #2E7D32;">Inscription reussie</h3>';

        echo '<div style="background: #E8F5E9; border: 2px solid #2E7D32; border-radius: 12px; padding: 25px; margin: 20px auto; max-width: 500px; text-align: left;">';
        echo '<table style="width:100%;">';
        echo '<tr><td style="padding:6px 0;font-weight:600;width:40%;">Nom</td><td>' . fullname($user) . '</td></tr>';
        echo '<tr><td style="padding:6px 0;font-weight:600;">Email</td><td>' . $user->email . '</td></tr>';
        echo '<tr><td style="padding:6px 0;font-weight:600;">Identifiant</td><td><code>' . $user->username . '</code></td></tr>';
        if ($is_new && $actual_pwd) {
            echo '<tr><td style="padding:6px 0;font-weight:600;">Mot de passe</td><td><code>' . htmlspecialchars($actual_pwd) . '</code></td></tr>';
        }
        echo '<tr><td style="padding:6px 0;font-weight:600;">Acces</td><td>' . $duration_text . ' (toutes les formations)</td></tr>';
        echo '<tr><td style="padding:6px 0;font-weight:600;">Expiration</td><td>' . date('d/m/Y', time() + $days * 86400) . '</td></tr>';
        echo '</table>';
        echo '</div>';

        // Boutons
        $login_url = $CFG->wwwroot . '/login/';
        $copy_msg = "Bonjour " . fullname($user) . ",\\n\\nVotre compte VERTEX a ete cree :\\n\\nSite : {$login_url}\\nIdentifiant : {$user->username}\\nMot de passe : " . addslashes($actual_pwd) . "\\nAcces : {$duration_text}\\n\\nCordialement,\\nVERTEX";

        echo '<div style="margin-top: 20px;">';
        echo "<button onclick=\"navigator.clipboard.writeText('" . $copy_msg . "'.replace(/\\\\n/g, '\\n')); this.textContent='Copie !'; this.style.background='#2E7D32';\" class='vertex-btn vertex-btn-primary' style='margin:5px;'>Copier les identifiants</button>";

        // Bouton envoyer par email
        echo "<form method='post' style='display:inline-block; margin:5px;'>";
        echo "<input type='hidden' name='sesskey' value='" . sesskey() . "'>";
        echo "<input type='hidden' name='formaction' value='send_welcome'>";
        echo "<input type='hidden' name='user_id' value='{$user->id}'>";
        echo "<input type='hidden' name='password' value='" . htmlspecialchars($actual_pwd) . "'>";
        echo "<input type='hidden' name='days' value='{$days}'>";
        echo "<button type='submit' class='vertex-btn' style='background:#E65100;color:white;margin:5px;'>Envoyer par email</button>";
        echo "</form>";
        echo '</div>';

        echo '<p style="margin-top: 20px;"><a href="?action=direct">Inscrire un autre praticien</a> &middot; <a href="?action=list">Voir les coupons</a></p>';
        echo '</div>';
    }
}

echo '</div>'; // .vertex-admin
echo $OUTPUT->footer();
