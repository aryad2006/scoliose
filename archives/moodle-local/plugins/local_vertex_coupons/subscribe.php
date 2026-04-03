<?php
/**
 * VERTEX© — Page de souscription / paiement.
 */
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/lib.php');

$plan = required_param('plan', PARAM_ALPHA);
$region = optional_param('region', 'maroc', PARAM_ALPHA);

$all_plans = [
    'maroc' => [
        'monthly'  => ['name' => 'Découverte', 'duration' => 30, 'price' => 199, 'label' => '1 mois', 'currency' => 'MAD'],
        'semester' => ['name' => 'Semestriel', 'duration' => 180, 'price' => 799, 'label' => '6 mois', 'currency' => 'MAD'],
        'annual'   => ['name' => 'Annuel', 'duration' => 365, 'price' => 1299, 'label' => '12 mois', 'currency' => 'MAD'],
    ],
    'international' => [
        'monthly'  => ['name' => 'Découverte', 'duration' => 30, 'price' => 49, 'label' => '1 mois', 'currency' => '€'],
        'semester' => ['name' => 'Semestriel', 'duration' => 180, 'price' => 199, 'label' => '6 mois', 'currency' => '€'],
        'annual'   => ['name' => 'Annuel', 'duration' => 365, 'price' => 349, 'label' => '12 mois', 'currency' => '€'],
    ],
];

$plans = $all_plans[$region] ?? $all_plans['maroc'];

if (!isset($plans[$plan])) {
    redirect(new moodle_url('/local/vertex_coupons/pricing.php'));
}

$selected = $plans[$plan];

$PAGE->set_url(new moodle_url('/local/vertex_coupons/subscribe.php', ['plan' => $plan]));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('VERTEX© — Inscription ' . $selected['name']);
$PAGE->set_heading('Finaliser votre abonnement');
$PAGE->set_pagelayout('login');

// Traitement du formulaire
$message = '';
$msgtype = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && confirm_sesskey()) {
    $payment_method = required_param('payment_method', PARAM_ALPHA);
    $email = required_param('email', PARAM_EMAIL);
    $fullname = required_param('fullname', PARAM_TEXT);
    $phone = optional_param('phone', '', PARAM_TEXT);

    if ($payment_method === 'virement') {
        // Créer un coupon en attente
        $coupon = vertex_coupons_create($email, $selected['duration'], $fullname, '',
            "Virement en attente — Formule {$selected['name']} ({$selected['price']} MAD) — Tél: {$phone}");
        $coupon->status = 'pending';
        $DB->update_record('vertex_coupons', $coupon);

        // Envoyer email de confirmation avec instructions de virement
        $message = "<strong>Demande d'inscription enregistrée !</strong><br/><br/>
            Votre référence de paiement : <strong>{$coupon->code}</strong><br/><br/>
            Veuillez effectuer un virement de <strong>{$selected['price']} MAD</strong> avec la référence ci-dessus.<br/>
            Votre accès sera activé sous 24-48h après réception du paiement.<br/><br/>
            Un email de confirmation vous sera envoyé à <strong>{$email}</strong>.";
        $msgtype = 'success';

    } elseif ($payment_method === 'carte') {
        // Pour le paiement en ligne, on redirige vers la passerelle
        // Pour l'instant, on affiche un message
        $message = "<strong>Paiement en ligne</strong><br/><br/>
            La passerelle de paiement en ligne sera bientôt disponible.<br/>
            En attendant, veuillez utiliser le virement bancaire ou contacter l'administration.";
        $msgtype = 'info';
    }
}

echo $OUTPUT->header();

echo '<style>
.subscribe-container { max-width: 700px; margin: 30px auto; padding: 0 20px; font-family: "Segoe UI", Roboto, sans-serif; }

.plan-summary { background: linear-gradient(135deg, #0D47A1, #1565C0); border-radius: 14px;
    padding: 25px 30px; color: white; margin-bottom: 25px; display: flex; justify-content: space-between;
    align-items: center; }
.plan-summary h2 { margin: 0; font-size: 1.4em; }
.plan-summary .plan-details { font-size: 0.9em; opacity: 0.85; margin-top: 5px; }
.plan-summary .plan-price { font-size: 2em; font-weight: 800; }
.plan-summary .plan-price small { font-size: 0.4em; opacity: 0.7; display: block; font-weight: 400; }

.subscribe-card { background: white; border-radius: 14px; padding: 30px; margin-bottom: 20px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08); border: 1px solid #e0e0e0; }
.subscribe-card h3 { color: #1565C0; margin-top: 0; font-size: 1.2em; margin-bottom: 20px;
    padding-bottom: 10px; border-bottom: 2px solid #E3F2FD; }

.form-group { margin-bottom: 18px; }
.form-group label { display: block; font-weight: 600; color: #333; margin-bottom: 6px; font-size: 0.93em; }
.form-group input, .form-group select { width: 100%; padding: 12px 15px; border: 2px solid #E0E0E0;
    border-radius: 10px; font-size: 1em; box-sizing: border-box; }
.form-group input:focus { border-color: #1565C0; outline: none; box-shadow: 0 0 0 3px rgba(21,101,192,0.1); }
.form-hint { font-size: 0.82em; color: #888; margin-top: 4px; }

.payment-choice { display: flex; gap: 15px; margin-bottom: 20px; }
.payment-option { flex: 1; border: 2px solid #E0E0E0; border-radius: 12px; padding: 20px;
    cursor: pointer; text-align: center; transition: all 0.3s; }
.payment-option:hover { border-color: #90CAF9; background: #F5F5F5; }
.payment-option.selected { border-color: #1565C0; background: #E3F2FD; }
.payment-option input[type="radio"] { display: none; }
.payment-option .payment-icon { font-size: 2em; margin-bottom: 8px; }
.payment-option .payment-label { font-weight: 600; color: #333; font-size: 0.95em; }
.payment-option .payment-desc { font-size: 0.8em; color: #888; margin-top: 5px; }

.bank-details { background: #FFF8E1; border: 1px solid #FFE082; border-radius: 10px;
    padding: 20px; margin: 15px 0; display: none; }
.bank-details.show { display: block; }
.bank-details h4 { margin-top: 0; color: #F57F17; }
.bank-details table { width: 100%; }
.bank-details td { padding: 5px 0; font-size: 0.93em; }
.bank-details td:first-child { font-weight: 600; color: #555; width: 40%; }

.submit-btn { width: 100%; padding: 15px; border: none; border-radius: 10px; font-size: 1.1em;
    font-weight: 700; cursor: pointer; transition: all 0.3s; margin-top: 10px; }
.submit-btn-pay { background: linear-gradient(135deg, #1565C0, #0D47A1); color: white; }
.submit-btn-pay:hover { box-shadow: 0 6px 20px rgba(21,101,192,0.35); transform: translateY(-2px); }

.msg-box { padding: 20px; border-radius: 12px; margin-bottom: 20px; }
.msg-success { background: #E8F5E9; color: #2E7D32; border: 1px solid #A5D6A7; }
.msg-info { background: #E3F2FD; color: #1565C0; border: 1px solid #90CAF9; }

.back-link { text-align: center; margin-top: 15px; }
.back-link a { color: #1565C0; text-decoration: none; font-weight: 500; }

@media (max-width: 600px) {
    .plan-summary { flex-direction: column; text-align: center; }
    .payment-choice { flex-direction: column; }
}
</style>';

echo '<div class="subscribe-container">';

// Résumé du plan
echo '<div class="plan-summary">';
echo '<div>';
echo "<h2>Formule {$selected['name']}</h2>";
echo "<div class='plan-details'>Accès à toutes les formations — {$selected['label']}</div>";
echo '</div>';
echo '<div class="plan-price">';
echo number_format($selected['price'], 0, ',', ' ') . ' <small>' . $selected['currency'] . '</small>';
echo '</div>';
echo '</div>';

if ($message) {
    echo "<div class='msg-box msg-{$msgtype}'>{$message}</div>";
    echo '<div class="back-link"><a href="' . $CFG->wwwroot . '/local/vertex_coupons/pricing.php">← Retour aux formules</a></div>';
} else {

    echo '<form method="post">';
    echo '<input type="hidden" name="sesskey" value="' . sesskey() . '">';

    // Coordonnées
    echo '<div class="subscribe-card">';
    echo '<h3>Vos coordonnées</h3>';
    echo '<div class="form-group"><label>Nom complet *</label>';
    echo '<input type="text" name="fullname" required placeholder="Dr. Nom Prénom"></div>';
    echo '<div class="form-group"><label>Email *</label>';
    echo '<input type="email" name="email" required placeholder="votre@email.com">';
    echo '<div class="form-hint">Votre email servira d\'identifiant de connexion</div></div>';
    echo '<div class="form-group"><label>Téléphone</label>';
    echo '<input type="tel" name="phone" placeholder="+212 6XX XXX XXX"></div>';
    echo '</div>';

    // Choix du paiement
    echo '<div class="subscribe-card">';
    echo '<h3>Mode de paiement</h3>';
    echo '<div class="payment-choice">';

    echo '<label class="payment-option" id="opt-carte" onclick="selectPayment(\'carte\')">';
    echo '<input type="radio" name="payment_method" value="carte">';
    echo '<div class="payment-icon">💳</div>';
    echo '<div class="payment-label">Carte bancaire</div>';
    echo '<div class="payment-desc">Activation immédiate</div>';
    echo '</label>';

    echo '<label class="payment-option" id="opt-virement" onclick="selectPayment(\'virement\')">';
    echo '<input type="radio" name="payment_method" value="virement">';
    echo '<div class="payment-icon">🏦</div>';
    echo '<div class="payment-label">Virement bancaire</div>';
    echo '<div class="payment-desc">Activation sous 24-48h</div>';
    echo '</label>';

    echo '</div>';

    // Détails virement (masqué par défaut)
    echo '<div class="bank-details" id="bank-details">';
    echo '<h4>Coordonnées bancaires</h4>';
    echo '<table>';
    echo '<tr><td>Banque</td><td>À préciser</td></tr>';
    echo '<tr><td>Titulaire</td><td>À préciser</td></tr>';
    echo '<tr><td>RIB</td><td>À préciser</td></tr>';
    echo '<tr><td>Montant</td><td><strong>' . number_format($selected['price'], 0, ',', ' ') . ' ' . $selected['currency'] . '</strong></td></tr>';
    echo '<tr><td>Objet</td><td>VERTEX ' . strtoupper($plan) . ' — [votre email]</td></tr>';
    echo '</table>';
    echo '</div>';

    echo '</div>'; // subscribe-card

    echo '<button type="submit" class="submit-btn submit-btn-pay">Valider mon inscription</button>';
    echo '</form>';

    echo '<div class="back-link"><a href="' . $CFG->wwwroot . '/local/vertex_coupons/pricing.php">← Modifier ma formule</a></div>';
}

echo '</div>'; // .subscribe-container

echo '<script>
function selectPayment(method) {
    document.querySelectorAll(".payment-option").forEach(function(el) { el.classList.remove("selected"); });
    document.getElementById("opt-" + method).classList.add("selected");
    document.querySelector("input[name=payment_method][value=" + method + "]").checked = true;
    document.getElementById("bank-details").classList.toggle("show", method === "virement");
}
</script>';

echo $OUTPUT->footer();
