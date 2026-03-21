<?php
/**
 * VERTEX© — Page d'abonnement et tarifs.
 * Accessible sans connexion.
 * Détection automatique de la région (Maroc / International).
 */
require_once(__DIR__ . '/../../config.php');

$PAGE->set_url(new moodle_url('/local/vertex_coupons/pricing.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('VERTEX© — Abonnements');
$PAGE->set_heading('VERTEX© — Nos formules d\'abonnement');
$PAGE->set_pagelayout('login');

// Détection de la région via paramètre ou géolocalisation simplifiée
$region = optional_param('region', '', PARAM_ALPHA);
if (empty($region)) {
    // Détection par timezone du navigateur (sera affinée côté JS)
    // Par défaut on affiche les deux grilles
    $region = 'both';
}

// Grilles tarifaires
$plans = [
    'maroc' => [
        'currency' => 'MAD',
        'flag' => '🇲🇦',
        'label' => 'Maroc',
        'monthly'  => ['price' => 199, 'old' => null],
        'semester' => ['price' => 799, 'old' => 1194],
        'annual'   => ['price' => 1299, 'old' => 2388],
    ],
    'international' => [
        'currency' => '€',
        'flag' => '🌍',
        'label' => 'International',
        'monthly'  => ['price' => 49, 'old' => null],
        'semester' => ['price' => 199, 'old' => 294],
        'annual'   => ['price' => 349, 'old' => 588],
    ],
];

echo $OUTPUT->header();

echo '<style>
.pricing-container { max-width: 1200px; margin: 0 auto; padding: 30px 20px; font-family: "Segoe UI", Roboto, sans-serif; }
.pricing-header { text-align: center; margin-bottom: 30px; }
.pricing-header h1 { color: #1565C0; font-size: 2.2em; margin-bottom: 10px; }
.pricing-header p { color: #666; font-size: 1.15em; max-width: 600px; margin: 0 auto; }

/* Sélecteur de région */
.region-selector { display: flex; justify-content: center; gap: 12px; margin-bottom: 35px; }
.region-btn { padding: 10px 28px; border-radius: 25px; border: 2px solid #E0E0E0; background: white;
    cursor: pointer; font-size: 1em; font-weight: 600; color: #555; transition: all 0.3s; text-decoration: none; }
.region-btn:hover { border-color: #90CAF9; background: #F5F5F5; color: #333; }
.region-btn.active { border-color: #1565C0; background: #1565C0; color: white; }

/* Grille tarifaire */
.pricing-region { margin-bottom: 50px; }
.pricing-region-title { text-align: center; font-size: 1.3em; color: #333; margin-bottom: 25px;
    padding-bottom: 10px; border-bottom: 2px solid #E3F2FD; }
.pricing-region-title span { font-size: 1.3em; margin-right: 8px; }

.pricing-cards { display: flex; gap: 25px; justify-content: center; flex-wrap: wrap; margin-bottom: 30px; }

.pricing-card { background: white; border-radius: 16px; padding: 35px 30px; width: 300px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 2px solid #e0e0e0; text-align: center;
    transition: all 0.3s; position: relative; }
.pricing-card:hover { transform: translateY(-5px); box-shadow: 0 10px 40px rgba(0,0,0,0.12); }
.pricing-card.popular { border-color: #1565C0; transform: scale(1.03); }
.pricing-card.popular:hover { transform: scale(1.03) translateY(-5px); }

.pricing-badge { position: absolute; top: -12px; left: 50%; transform: translateX(-50%);
    background: linear-gradient(135deg, #1565C0, #0D47A1); color: white; padding: 5px 20px;
    border-radius: 20px; font-size: 0.8em; font-weight: 600; letter-spacing: 0.5px; white-space: nowrap; }

.pricing-card h2 { color: #333; font-size: 1.3em; margin: 15px 0 5px; }
.pricing-card .duration { color: #888; font-size: 0.9em; margin-bottom: 15px; }

.pricing-price { margin: 15px 0; }
.pricing-price .amount { font-size: 2.8em; font-weight: 800; color: #0D47A1; }
.pricing-price .currency { font-size: 0.45em; color: #1565C0; font-weight: 600; vertical-align: super; }
.pricing-price .period { color: #888; font-size: 0.85em; margin-top: 5px; }
.pricing-price .old-price { text-decoration: line-through; color: #bbb; font-size: 1em; }
.pricing-price .saving { color: #2E7D32; font-size: 0.85em; font-weight: 600; margin-top: 5px; }

.pricing-features { text-align: left; margin: 20px 0; padding: 0; list-style: none; }
.pricing-features li { padding: 7px 0; color: #555; font-size: 0.9em; border-bottom: 1px solid #f0f0f0; }
.pricing-features li::before { content: "✓"; color: #2E7D32; font-weight: 700; margin-right: 10px; }

.pricing-btn { display: block; width: 100%; padding: 13px; border: none; border-radius: 10px;
    font-size: 1em; font-weight: 600; cursor: pointer; text-decoration: none; text-align: center;
    transition: all 0.3s; box-sizing: border-box; }
.pricing-btn-primary { background: linear-gradient(135deg, #1565C0, #0D47A1); color: white; }
.pricing-btn-primary:hover { box-shadow: 0 4px 15px rgba(21,101,192,0.4); color: white; }
.pricing-btn-outline { background: white; color: #1565C0; border: 2px solid #1565C0; }
.pricing-btn-outline:hover { background: #E3F2FD; color: #1565C0; }

/* Paiement */
.payment-section { background: white; border-radius: 16px; padding: 35px; margin: 30px 0;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid #e0e0e0; }
.payment-section h2 { color: #1565C0; font-size: 1.4em; margin-bottom: 20px; text-align: center; }
.payment-methods { display: flex; gap: 25px; flex-wrap: wrap; justify-content: center; }
.payment-method { flex: 1; min-width: 260px; max-width: 450px; background: #f8f9fa; border-radius: 12px;
    padding: 22px; border: 1px solid #e0e0e0; }
.payment-method h3 { color: #333; font-size: 1.1em; margin-top: 0; margin-bottom: 12px;
    padding-bottom: 8px; border-bottom: 2px solid #E3F2FD; }
.payment-method p { color: #555; font-size: 0.9em; line-height: 1.7; }
.payment-method .bank-info { background: white; padding: 12px; border-radius: 8px;
    border: 1px solid #E0E0E0; margin-top: 10px; font-size: 0.88em; }

/* Garantie */
.guarantee { text-align: center; margin: 35px 0 20px; padding: 22px; background: #E8F5E9; border-radius: 12px; }
.guarantee h3 { color: #2E7D32; margin-top: 0; font-size: 1.1em; }
.guarantee p { color: #555; max-width: 500px; margin: 0 auto; font-size: 0.93em; }

/* FAQ */
.pricing-faq { margin: 35px 0; }
.pricing-faq h2 { color: #1565C0; text-align: center; margin-bottom: 20px; font-size: 1.4em; }
.faq-item { background: white; border-radius: 10px; padding: 18px; margin-bottom: 8px;
    border: 1px solid #e0e0e0; }
.faq-item h4 { color: #333; margin: 0 0 6px; font-size: 0.95em; }
.faq-item p { color: #666; margin: 0; font-size: 0.9em; }

@media (max-width: 768px) {
    .pricing-cards { flex-direction: column; align-items: center; }
    .pricing-card.popular { transform: none; }
    .payment-methods { flex-direction: column; }
    .region-selector { flex-direction: column; align-items: center; }
}
</style>';

echo '<div class="pricing-container">';

// En-tête
echo '<div class="pricing-header">';
echo '<h1>Accédez à toutes nos formations</h1>';
echo '<p>Choisissez la formule qui vous convient. Un seul abonnement pour accéder à l\'ensemble des spécialités médicales.</p>';
echo '</div>';

// Sélecteur de région
echo '<div class="region-selector">';
$active_both = ($region === 'both') ? ' active' : '';
$active_ma = ($region === 'maroc') ? ' active' : '';
$active_int = ($region === 'international') ? ' active' : '';
echo "<a href='?region=both' class='region-btn{$active_both}'>🌐 Toutes les régions</a>";
echo "<a href='?region=maroc' class='region-btn{$active_ma}'>🇲🇦 Maroc</a>";
echo "<a href='?region=international' class='region-btn{$active_int}'>🌍 International</a>";
echo '</div>';

// Fonction pour afficher une grille de prix
function render_pricing_grid($region_key, $region_data, $wwwroot) {
    $currency = $region_data['currency'];
    $flag = $region_data['flag'];
    $label = $region_data['label'];

    echo "<div class='pricing-region'>";
    echo "<h3 class='pricing-region-title'><span>{$flag}</span> Tarifs {$label}</h3>";
    echo '<div class="pricing-cards">';

    // Découverte (mensuel)
    $p = $region_data['monthly'];
    $monthly_equiv = $p['price'];
    echo '<div class="pricing-card">';
    echo '<h2>Découverte</h2>';
    echo '<div class="duration">1 mois</div>';
    echo '<div class="pricing-price">';
    echo "<div class='amount'>{$p['price']}<span class='currency'> {$currency}</span></div>";
    echo '<div class="period">par mois</div>';
    echo '</div>';
    echo '<ul class="pricing-features">';
    echo '<li>Accès à toutes les formations</li>';
    echo '<li>Cas cliniques progressifs</li>';
    echo '<li>Quiz d\'auto-évaluation</li>';
    echo '<li>Accès 24h/24, 7j/7</li>';
    echo '</ul>';
    echo "<a href='{$wwwroot}/local/vertex_coupons/subscribe.php?plan=monthly&region={$region_key}' class='pricing-btn pricing-btn-outline'>Choisir</a>";
    echo '</div>';

    // Annuel (populaire)
    $p = $region_data['annual'];
    $monthly_equiv = round($p['price'] / 12);
    $saving = $p['old'] ? round(100 - ($p['price'] / $p['old'] * 100)) : 0;
    echo '<div class="pricing-card popular">';
    echo '<div class="pricing-badge">Le plus avantageux</div>';
    echo '<h2>Annuel</h2>';
    echo '<div class="duration">12 mois</div>';
    echo '<div class="pricing-price">';
    if ($p['old']) echo "<div class='old-price'>" . number_format($p['old'], 0, ',', ' ') . " {$currency}</div>";
    echo "<div class='amount'>" . number_format($p['price'], 0, ',', ' ') . "<span class='currency'> {$currency}</span></div>";
    echo "<div class='period'>par an — soit {$monthly_equiv} {$currency}/mois</div>";
    if ($saving) echo "<div class='saving'>Économie de {$saving}%</div>";
    echo '</div>';
    echo '<ul class="pricing-features">';
    echo '<li>Accès à toutes les formations</li>';
    echo '<li>Cas cliniques progressifs</li>';
    echo '<li>Quiz d\'auto-évaluation</li>';
    echo '<li>Accès 24h/24, 7j/7</li>';
    echo '<li>Nouvelles formations incluses</li>';
    echo '</ul>';
    echo "<a href='{$wwwroot}/local/vertex_coupons/subscribe.php?plan=annual&region={$region_key}' class='pricing-btn pricing-btn-primary'>Choisir</a>";
    echo '</div>';

    // Semestriel
    $p = $region_data['semester'];
    $monthly_equiv = round($p['price'] / 6);
    $saving = $p['old'] ? round(100 - ($p['price'] / $p['old'] * 100)) : 0;
    echo '<div class="pricing-card">';
    echo '<h2>Semestriel</h2>';
    echo '<div class="duration">6 mois</div>';
    echo '<div class="pricing-price">';
    if ($p['old']) echo "<div class='old-price'>" . number_format($p['old'], 0, ',', ' ') . " {$currency}</div>";
    echo "<div class='amount'>" . number_format($p['price'], 0, ',', ' ') . "<span class='currency'> {$currency}</span></div>";
    echo "<div class='period'>pour 6 mois — soit {$monthly_equiv} {$currency}/mois</div>";
    if ($saving) echo "<div class='saving'>Économie de {$saving}%</div>";
    echo '</div>';
    echo '<ul class="pricing-features">';
    echo '<li>Accès à toutes les formations</li>';
    echo '<li>Cas cliniques progressifs</li>';
    echo '<li>Quiz d\'auto-évaluation</li>';
    echo '<li>Accès 24h/24, 7j/7</li>';
    echo '</ul>';
    echo "<a href='{$wwwroot}/local/vertex_coupons/subscribe.php?plan=semester&region={$region_key}' class='pricing-btn pricing-btn-outline'>Choisir</a>";
    echo '</div>';

    echo '</div>'; // .pricing-cards
    echo '</div>'; // .pricing-region
}

// Afficher les grilles selon la région sélectionnée
if ($region === 'both' || $region === 'maroc') {
    render_pricing_grid('maroc', $plans['maroc'], $CFG->wwwroot);
}
if ($region === 'both' || $region === 'international') {
    render_pricing_grid('international', $plans['international'], $CFG->wwwroot);
}

// Moyens de paiement
echo '<div class="payment-section">';
echo '<h2>Moyens de paiement acceptés</h2>';
echo '<div class="payment-methods">';

echo '<div class="payment-method">';
echo '<h3>💳 Paiement en ligne</h3>';
echo '<p>Payez par carte bancaire (Visa, Mastercard, CMI) de manière sécurisée. Votre accès est activé immédiatement après le paiement.</p>';
echo '<p style="color: #2E7D32; font-weight: 600; margin-top: 12px;">✓ Activation instantanée</p>';
echo '</div>';

echo '<div class="payment-method">';
echo '<h3>🏦 Virement bancaire</h3>';
echo '<p>Effectuez un virement vers notre compte bancaire. Votre accès sera activé sous 24-48h après réception du paiement.</p>';
echo '<div class="bank-info">';
echo '<strong>Banque :</strong> À préciser<br/>';
echo '<strong>Titulaire :</strong> À préciser<br/>';
echo '<strong>RIB :</strong> À préciser<br/>';
echo '<strong>Objet :</strong> Abonnement VERTEX© — [Votre email]';
echo '</div>';
echo '<p style="color: #E65100; font-weight: 600; margin-top: 12px;">⏳ Activation sous 24-48h</p>';
echo '</div>';

echo '</div>'; // .payment-methods
echo '</div>'; // .payment-section

// Garantie
echo '<div class="guarantee">';
echo '<h3>Satisfait ou remboursé — 7 jours</h3>';
echo '<p>Si la plateforme ne répond pas à vos attentes, nous vous remboursons intégralement dans les 7 jours suivant votre inscription.</p>';
echo '</div>';

// FAQ tarifs
echo '<div class="pricing-faq">';
echo '<h2>Questions fréquentes</h2>';

echo '<div class="faq-item"><h4>Pourquoi deux grilles tarifaires ?</h4>';
echo '<p>Nous proposons des tarifs adaptés au pouvoir d\'achat local. Les praticiens exerçant au Maroc bénéficient de tarifs préférentiels en dirhams (MAD). Les tarifs internationaux sont en euros (€).</p></div>';

echo '<div class="faq-item"><h4>Puis-je changer de formule en cours d\'abonnement ?</h4>';
echo '<p>Oui, vous pouvez passer à une formule supérieure à tout moment. La différence de tarif sera calculée au prorata.</p></div>';

echo '<div class="faq-item"><h4>L\'abonnement se renouvelle-t-il automatiquement ?</h4>';
echo '<p>Non, il n\'y a pas de renouvellement automatique. Vous choisissez de renouveler à l\'expiration de votre période.</p></div>';

echo '<div class="faq-item"><h4>Combien de formations sont incluses ?</h4>';
echo '<p>Toutes les formations disponibles sont incluses dans chaque formule, sans exception. Les nouvelles formations ajoutées pendant votre abonnement sont également accessibles.</p></div>';

echo '<div class="faq-item"><h4>Puis-je obtenir une facture ?</h4>';
echo '<p>Oui, une facture est émise automatiquement après chaque paiement et envoyée par email.</p></div>';

echo '</div>'; // .pricing-faq

echo '</div>'; // .pricing-container

echo $OUTPUT->footer();
