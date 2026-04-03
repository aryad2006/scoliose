<?php
/**
 * VERTEX© — Page d'activation de coupon par le praticien.
 */
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/lib.php');

require_login();

$PAGE->set_url(new moodle_url('/local/vertex_coupons/redeem.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('VERTEX© — Activer un coupon');
$PAGE->set_heading('Activer votre coupon d\'accès');
$PAGE->set_pagelayout('standard');

$message = '';
$msgtype = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && confirm_sesskey()) {
    $code = required_param('code', PARAM_TEXT);
    $result = vertex_coupons_redeem($code, $USER->id);

    if ($result['success']) {
        $expires = date('d/m/Y', $result['expires']);
        $courses_list = implode(', ', $result['courses']);
        $message = "<strong>Coupon activé avec succès !</strong><br/>
            Vous avez accès aux formations suivantes jusqu'au <strong>{$expires}</strong> :<br/>
            {$courses_list}";
        $msgtype = 'success';
    } else {
        $message = $result['message'];
        $msgtype = 'error';
    }
}

echo $OUTPUT->header();

echo '<style>
.redeem-container { max-width: 500px; margin: 40px auto; }
.redeem-card { background: white; border-radius: 16px; padding: 35px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    border: 1px solid #e0e0e0; text-align: center; }
.redeem-card h2 { color: #1565C0; margin-bottom: 10px; }
.redeem-card p { color: #666; margin-bottom: 25px; }
.redeem-input { width: 100%; padding: 14px 18px; border: 2px solid #E0E0E0; border-radius: 10px;
    font-size: 1.2em; text-align: center; letter-spacing: 2px; font-weight: 600; text-transform: uppercase; }
.redeem-input:focus { border-color: #1565C0; outline: none; box-shadow: 0 0 0 3px rgba(21,101,192,0.1); }
.redeem-btn { width: 100%; padding: 14px; margin-top: 15px; border: none; border-radius: 10px;
    background: linear-gradient(135deg, #1565C0, #0D47A1); color: white; font-size: 1.1em;
    font-weight: 600; cursor: pointer; transition: all 0.3s; }
.redeem-btn:hover { box-shadow: 0 4px 15px rgba(21,101,192,0.3); transform: translateY(-2px); }
.redeem-msg { padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; }
.redeem-msg-success { background: #E8F5E9; color: #2E7D32; border: 1px solid #A5D6A7; }
.redeem-msg-error { background: #FFEBEE; color: #C62828; border: 1px solid #EF9A9A; }
</style>';

echo '<div class="redeem-container"><div class="redeem-card">';
echo '<h2>Activer un coupon</h2>';
echo '<p>Saisissez le code coupon qui vous a été communiqué pour accéder aux formations VERTEX©.</p>';

if ($message) {
    echo "<div class='redeem-msg redeem-msg-{$msgtype}'>{$message}</div>";
}

echo '<form method="post">';
echo '<input type="hidden" name="sesskey" value="' . sesskey() . '">';
echo '<input type="text" name="code" class="redeem-input" placeholder="VTX-XXXX-XXXX-XXXX" required autofocus>';
echo '<button type="submit" class="redeem-btn">Activer mon accès</button>';
echo '</form>';
echo '</div></div>';

echo $OUTPUT->footer();
