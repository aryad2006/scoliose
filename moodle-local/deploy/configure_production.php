<?php
/**
 * VERTEX© — Configuration complète de production (doctraining.ma)
 *
 * Usage depuis SSH Infomaniak :
 *   cd ~/sites/doctraining.ma
 *   php deploy/configure_production.php
 *
 * Ce script configure :
 *   1. Thème Moove (slider, marketing, FAQ, chiffres, footer)
 *   2. CSS custom VERTEX©
 *   3. SMTP Infomaniak
 *   4. Paramètres généraux du site
 *   5. Sécurité et performance
 */

define('CLI_SCRIPT', true);

// Adapter le chemin selon l'environnement
$configPath = __DIR__ . '/../config.php';
if (!file_exists($configPath)) {
    // Production Infomaniak
    $configPath = dirname(__DIR__) . '/config.php';
}
if (!file_exists($configPath)) {
    die("ERREUR: config.php introuvable. Lancez ce script depuis la racine Moodle.\n");
}
require($configPath);

echo "╔══════════════════════════════════════════════════════════════╗\n";
echo "║  VERTEX© — Configuration Production doctraining.ma         ║\n";
echo "╚══════════════════════════════════════════════════════════════╝\n\n";

// ═══════════════════════════════════════════════════════════════════
// 1. PARAMÈTRES GÉNÉRAUX DU SITE
// ═══════════════════════════════════════════════════════════════════
echo "── 1. PARAMÈTRES GÉNÉRAUX ──\n";

set_config('fullname', 'VERTEX© — Formations Médicales E-Learning');
set_config('shortname', 'VERTEX');
set_config('summary', 'Virtual Environment for Real-Time EXpertise — Plateforme de formations médicales continues multi-spécialités : orthopédie, endocrinologie, médecine interne, AMP.');
set_config('lang', 'fr');
set_config('country', 'MA');
set_config('timezone', 'Africa/Casablanca');
set_config('defaultcity', 'Casablanca');
set_config('supportemail', 'contact@doctraining.ma');
set_config('supportname', 'Support VERTEX©');
set_config('noreplyaddress', 'noreply@doctraining.ma');
echo "[OK] Paramètres généraux configurés\n";

// ═══════════════════════════════════════════════════════════════════
// 2. THÈME MOOVE — ACTIVATION
// ═══════════════════════════════════════════════════════════════════
echo "\n── 2. THÈME MOOVE ──\n";

set_config('theme', 'moove');
set_config('brandcolor', '#0D47A1', 'theme_moove');
set_config('secondarymenucolor', '#1A237E', 'theme_moove');
set_config('fontsite', 'Inter', 'theme_moove');
set_config('enablecourseindex', 1, 'theme_moove');
echo "[OK] Thème Moove activé (bleu VERTEX #0D47A1)\n";

// ═══════════════════════════════════════════════════════════════════
// 3. SLIDER — 3 SLIDES
// ═══════════════════════════════════════════════════════════════════
echo "\n── 3. SLIDER ──\n";

set_config('slidercount', 3, 'theme_moove');

// Slide 1 — Présentation générale
set_config('slidertitle1', 'VERTEX© — Formations Médicales d\'Excellence', 'theme_moove');
set_config('slidercap1', '13 formations multi-spécialités : orthopédie, endocrinologie, médecine interne, AMP. Programme complet avec cas cliniques progressifs et certification.', 'theme_moove');

// Slide 2 — Simulateur
set_config('slidertitle2', 'Simulateur Biomécanique 3D', 'theme_moove');
set_config('slidercap2', 'Simulation interactive par éléments finis — Pratiquez la correction chirurgicale en environnement virtuel sur des modèles patient-spécifiques.', 'theme_moove');

// Slide 3 — Certification
set_config('slidertitle3', 'Certification Progressive', 'theme_moove');
set_config('slidercap3', 'Évaluation à 4 niveaux (Bronze, Argent, Or, Diamant) — Quiz, cas cliniques et examens pratiques pour valider vos compétences.', 'theme_moove');

echo "[OK] 3 slides configurés\n";

// ═══════════════════════════════════════════════════════════════════
// 4. MARKETING BOXES — 4 BLOCS
// ═══════════════════════════════════════════════════════════════════
echo "\n── 4. BLOCS MARKETING ──\n";

set_config('displaymarketingbox', 1, 'theme_moove');
set_config('marketingheading', 'Pourquoi VERTEX© ?', 'theme_moove');
set_config('marketingcontent', 'Une plateforme unique alliant théorie avancée, cas cliniques interactifs et simulation biomécanique pour les professionnels de santé.', 'theme_moove');

// Box 1
set_config('marketing1icon', 'book-medical', 'theme_moove');
set_config('marketing1heading', '13 Formations', 'theme_moove');
set_config('marketing1content', 'Scoliose, PTG, IOA, tendinites, obésité, diabétologie, HTA, thyroïde, FIV, LCA… Un catalogue complet et en expansion.', 'theme_moove');

// Box 2
set_config('marketing2icon', 'laptop-medical', 'theme_moove');
set_config('marketing2heading', 'Simulateur 3D', 'theme_moove');
set_config('marketing2content', 'Simulateur biomécanique par éléments finis : planifiez et testez vos stratégies chirurgicales sur des modèles 3D réalistes.', 'theme_moove');

// Box 3
set_config('marketing3icon', 'certificate', 'theme_moove');
set_config('marketing3heading', 'Certification', 'theme_moove');
set_config('marketing3content', 'Évaluations progressives Bronze → Diamant avec certification reconnue. Quiz, cas cliniques et examens pratiques.', 'theme_moove');

// Box 4
set_config('marketing4icon', 'users', 'theme_moove');
set_config('marketing4heading', 'Réseau Professionnel', 'theme_moove');
set_config('marketing4content', 'Forums de discussion par spécialité, cas cliniques collaboratifs et réseau de praticiens francophones.', 'theme_moove');

echo "[OK] 4 blocs marketing configurés\n";

// ═══════════════════════════════════════════════════════════════════
// 5. CHIFFRES CLÉS
// ═══════════════════════════════════════════════════════════════════
echo "\n── 5. CHIFFRES CLÉS ──\n";

set_config('numbersfrontpage', 1, 'theme_moove');
set_config('numbersfrontpagecontent', '<div class="row text-center">
    <div class="col-lg-3 col-sm-6"><h2>13</h2><p>Formations</p></div>
    <div class="col-lg-3 col-sm-6"><h2>100+</h2><p>Modules</p></div>
    <div class="col-lg-3 col-sm-6"><h2>500+</h2><p>Questions quiz</p></div>
    <div class="col-lg-3 col-sm-6"><h2>150+</h2><p>Cas cliniques</p></div>
</div>', 'theme_moove');
echo "[OK] Chiffres clés configurés\n";

// ═══════════════════════════════════════════════════════════════════
// 6. FAQ — 6 QUESTIONS
// ═══════════════════════════════════════════════════════════════════
echo "\n── 6. FAQ ──\n";

set_config('faqcount', 6, 'theme_moove');

set_config('faqquestion1', 'À qui s\'adresse VERTEX© ?', 'theme_moove');
set_config('faqanswer1', 'Aux praticiens en exercice et en formation : chirurgiens orthopédistes, endocrinologues, internistes, spécialistes AMP, médecins généralistes souhaitant approfondir une spécialité.', 'theme_moove');

set_config('faqquestion2', 'Quelles spécialités sont couvertes ?', 'theme_moove');
set_config('faqanswer2', 'Orthopédie (scoliose, PTG, IOA, tendinites, obésité, LCA), endocrinologie (diabétologie, HTA, hypothyroïdies, hyperthyroïdies), AMP (FIV) et histoire de l\'orthopédie.', 'theme_moove');

set_config('faqquestion3', 'Comment fonctionne la certification ?', 'theme_moove');
set_config('faqanswer3', '4 niveaux progressifs : Bronze (bases), Argent (intermédiaire), Or (avancé), Diamant (expert). Chaque niveau est validé par des quiz et des cas cliniques.', 'theme_moove');

set_config('faqquestion4', 'Qu\'est-ce que le simulateur 3D ?', 'theme_moove');
set_config('faqanswer4', 'Un simulateur biomécanique exclusif utilisant la méthode des éléments finis. Il permet de pratiquer virtuellement des corrections chirurgicales de scoliose sur des modèles 3D patient-spécifiques.', 'theme_moove');

set_config('faqquestion5', 'Quelle est la durée d\'accès ?', 'theme_moove');
set_config('faqanswer5', 'L\'accès est valable 12 mois à compter de l\'inscription, 24h/24 et 7j/7. Vous progressez à votre rythme.', 'theme_moove');

set_config('faqquestion6', 'Les formations sont-elles adaptées au contexte marocain ?', 'theme_moove');
set_config('faqanswer6', 'Oui, les formations intègrent le cadre réglementaire marocain (loi 47-14 pour l\'AMP, AMO, protocoles nationaux). La tarification est adaptée (MAD/EUR).', 'theme_moove');

echo "[OK] 6 FAQ configurées\n";

// ═══════════════════════════════════════════════════════════════════
// 7. FOOTER
// ═══════════════════════════════════════════════════════════════════
echo "\n── 7. FOOTER ──\n";

set_config('website', 'https://doctraining.ma', 'theme_moove');
set_config('mail', 'contact@doctraining.ma', 'theme_moove');
set_config('footnote', '<div class="vertex-footer-copyright">© 2026 VERTEX© — Virtual Environment for Real-Time EXpertise<br>Tous droits réservés — <a href="mailto:contact@doctraining.ma">contact@doctraining.ma</a></div>', 'theme_moove');
echo "[OK] Footer configuré\n";

// ═══════════════════════════════════════════════════════════════════
// 8. CSS CUSTOM VERTEX©
// ═══════════════════════════════════════════════════════════════════
echo "\n── 8. CSS CUSTOM ──\n";

$css_file = __DIR__ . '/vertex_custom.css';
if (file_exists($css_file)) {
    $custom_css = file_get_contents($css_file);
    set_config('scss', $custom_css, 'theme_moove');
    echo "[OK] CSS VERTEX© chargé depuis vertex_custom.css (" . strlen($custom_css) . " octets)\n";
} else {
    echo "[WARN] vertex_custom.css non trouvé, CSS non appliqué\n";
}

// ═══════════════════════════════════════════════════════════════════
// 9. SMTP INFOMANIAK
// ═══════════════════════════════════════════════════════════════════
echo "\n── 9. SMTP INFOMANIAK ──\n";

set_config('smtphosts', 'mail.infomaniak.com:587');
set_config('smtpsecure', 'tls');
set_config('smtpauthtype', 'LOGIN');
set_config('smtpuser', 'contact@doctraining.ma');
// Le mot de passe SMTP doit être configuré manuellement pour des raisons de sécurité
// set_config('smtppass', 'VOTRE_MOT_DE_PASSE_SMTP');
set_config('smtpmaxbulk', 50);
set_config('noreplyaddress', 'noreply@doctraining.ma');
set_config('emailonlyfromnoreplyaddress', 0);

echo "[OK] SMTP Infomaniak configuré (mail.infomaniak.com:587 TLS)\n";
echo "[!!] IMPORTANT: Configurez le mot de passe SMTP manuellement :\n";
echo "     Admin > Serveur > E-mail > SMTP > Mot de passe\n";
echo "     Ou décommentez la ligne set_config('smtppass',...) dans ce script\n";

// ═══════════════════════════════════════════════════════════════════
// 10. SÉCURITÉ ET PERFORMANCE
// ═══════════════════════════════════════════════════════════════════
echo "\n── 10. SÉCURITÉ & PERFORMANCE ──\n";

// Sécurité
set_config('forcelogin', 0); // Permettre l'accès à la page d'accueil sans login
set_config('forceloginforprofiles', 1);
set_config('enablewebservices', 1);
set_config('enablemobilewebservice', 1);
set_config('passwordpolicy', 1);
set_config('minpasswordlength', 8);
set_config('guestloginbutton', 0); // Pas de login invité

// Performance
set_config('cachejs', 1);
set_config('langstringcache', 1);
set_config('filteruploadedfiles', 0);
set_config('enablestats', 1);

// Navigation
set_config('defaulthomepage', 0); // Page d'accueil du site (pas le dashboard)
set_config('frontpage', '6'); // Liste des cours sur la page d'accueil
set_config('frontpageloggedin', '6'); // Idem pour les utilisateurs connectés
set_config('maxcategorydepth', 2);
set_config('courselistwidth', 3); // 3 colonnes

echo "[OK] Sécurité et performance configurées\n";

// ═══════════════════════════════════════════════════════════════════
// 11. INSCRIPTIONS
// ═══════════════════════════════════════════════════════════════════
echo "\n── 11. INSCRIPTIONS ──\n";

set_config('registerauth', 'email'); // Auto-inscription par email
set_config('authpreventaccountcreation', 0);
set_config('allowaccountssameemail', 0);

echo "[OK] Auto-inscription par email activée\n";

// ═══════════════════════════════════════════════════════════════════
// PURGE CACHE
// ═══════════════════════════════════════════════════════════════════
echo "\n── FINALISATION ──\n";
purge_all_caches();
echo "[OK] Cache purgé\n";

echo "\n╔══════════════════════════════════════════════════════════════╗\n";
echo "║  ✓ CONFIGURATION TERMINÉE — doctraining.ma                 ║\n";
echo "╠══════════════════════════════════════════════════════════════╣\n";
echo "║  Actions manuelles restantes :                              ║\n";
echo "║  1. Mot de passe SMTP (Admin > Serveur > E-mail)            ║\n";
echo "║  2. Logo SVG (Admin > Apparence > Logos)                    ║\n";
echo "║  3. Favicon (Admin > Apparence > Logos)                     ║\n";
echo "║  4. Images slider (Admin > Apparence > Moove > Slider)      ║\n";
echo "║  5. Cron Moodle (Infomaniak > Tâches planifiées)            ║\n";
echo "║  6. Coordonnées bancaires (page virement coupons)           ║\n";
echo "╚══════════════════════════════════════════════════════════════╝\n";
