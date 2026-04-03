<?php
/**
 * VERTEX© — Configuration complète production doctraining.ma
 *
 * INSTALLATION :
 *   1. Uploader ce fichier dans ~/sites/doctraining.ma/ (racine Moodle)
 *      via Manager Infomaniak > Gestionnaire de fichiers
 *   2. Ouvrir https://doctraining.ma/setup_vertex_production.php?key=VERTEX2026
 *   3. SUPPRIMER CE FICHIER APRÈS EXÉCUTION (sécurité)
 */

// ── Sécurité : clé obligatoire ──
if (!isset($_GET['key']) || $_GET['key'] !== 'VERTEX2026') {
    http_response_code(403);
    die('Acces interdit. Ajoutez ?key=VERTEX2026 a l\'URL.');
}

// ── Charger Moodle ──
define('CLI_SCRIPT', true);
require(__DIR__ . '/config.php');

header('Content-Type: text/plain; charset=utf-8');

echo "================================================================\n";
echo "  VERTEX© — Configuration Production doctraining.ma\n";
echo "================================================================\n\n";

// ═══════════════════════════════════════════════════════════════════
// 1. PARAMÈTRES GÉNÉRAUX
// ═══════════════════════════════════════════════════════════════════
echo "── 1. PARAMETRES GENERAUX ──\n";

set_config('fullname', 'VERTEX© — Formations Médicales E-Learning');
set_config('shortname', 'VERTEX');
set_config('summary', 'Virtual Environment for Real-Time EXpertise — Plateforme de formations médicales continues multi-spécialités.');
set_config('lang', 'fr');
set_config('country', 'MA');
set_config('timezone', 'Africa/Casablanca');
set_config('defaultcity', 'Casablanca');
set_config('supportemail', 'contact@doctraining.ma');
set_config('supportname', 'Support VERTEX©');
set_config('noreplyaddress', 'noreply@doctraining.ma');
set_config('defaulthomepage', 0);
set_config('frontpage', '6');
set_config('frontpageloggedin', '6');
echo "[OK] Parametres generaux\n";

// ═══════════════════════════════════════════════════════════════════
// 2. THÈME MOOVE
// ═══════════════════════════════════════════════════════════════════
echo "\n── 2. THEME MOOVE ──\n";

// Vérifier que Moove est installé
$themedir = $CFG->dirroot . '/theme/moove';
if (!is_dir($themedir)) {
    echo "[!!] Theme Moove NON INSTALLE dans $themedir\n";
    echo "     Installez-le d'abord via Admin > Apparence > Installer des themes\n";
    echo "     Ou telechargez depuis https://moodle.org/plugins/theme_moove\n\n";
} else {
    echo "[OK] Theme Moove present\n";
}

set_config('theme', 'moove');
set_config('brandcolor', '#0D47A1', 'theme_moove');
set_config('secondarymenucolor', '#1A237E', 'theme_moove');
set_config('fontsite', 'Inter', 'theme_moove');
set_config('enablecourseindex', 1, 'theme_moove');
echo "[OK] Theme Moove active (bleu VERTEX #0D47A1)\n";

// ═══════════════════════════════════════════════════════════════════
// 3. SLIDER — 3 SLIDES
// ═══════════════════════════════════════════════════════════════════
echo "\n── 3. SLIDER ──\n";

set_config('slidercount', 3, 'theme_moove');

set_config('slidertitle1', 'VERTEX© — Formations Médicales d\'Excellence', 'theme_moove');
set_config('slidercap1', '13 formations multi-spécialités : orthopédie, endocrinologie, médecine interne, AMP. Cas cliniques progressifs et certification.', 'theme_moove');

set_config('slidertitle2', 'Simulateur Biomécanique 3D', 'theme_moove');
set_config('slidercap2', 'Simulation interactive par éléments finis — Pratiquez la correction chirurgicale en environnement virtuel.', 'theme_moove');

set_config('slidertitle3', 'Certification Progressive', 'theme_moove');
set_config('slidercap3', 'Évaluation à 4 niveaux : Bronze, Argent, Or, Diamant — Quiz, cas cliniques et examens pratiques.', 'theme_moove');

echo "[OK] 3 slides\n";

// ═══════════════════════════════════════════════════════════════════
// 4. MARKETING BOXES
// ═══════════════════════════════════════════════════════════════════
echo "\n── 4. BLOCS MARKETING ──\n";

set_config('displaymarketingbox', 1, 'theme_moove');
set_config('marketingheading', 'Pourquoi VERTEX© ?', 'theme_moove');
set_config('marketingcontent', 'Théorie avancée, cas cliniques interactifs et simulation biomécanique pour les professionnels de santé.', 'theme_moove');

set_config('marketing1icon', 'book-medical', 'theme_moove');
set_config('marketing1heading', '13 Formations', 'theme_moove');
set_config('marketing1content', 'Scoliose, PTG, IOA, tendinites, obésité, diabétologie, HTA, thyroïde, FIV, LCA… Catalogue complet et en expansion.', 'theme_moove');

set_config('marketing2icon', 'laptop-medical', 'theme_moove');
set_config('marketing2heading', 'Simulateur 3D', 'theme_moove');
set_config('marketing2content', 'Simulateur biomécanique par éléments finis : planifiez et testez vos stratégies chirurgicales sur des modèles 3D réalistes.', 'theme_moove');

set_config('marketing3icon', 'certificate', 'theme_moove');
set_config('marketing3heading', 'Certification', 'theme_moove');
set_config('marketing3content', 'Évaluations progressives Bronze → Diamant avec certification reconnue. Quiz, cas cliniques et examens pratiques.', 'theme_moove');

set_config('marketing4icon', 'users', 'theme_moove');
set_config('marketing4heading', 'Réseau Professionnel', 'theme_moove');
set_config('marketing4content', 'Forums par spécialité, cas cliniques collaboratifs et réseau de praticiens francophones.', 'theme_moove');

echo "[OK] 4 blocs marketing\n";

// ═══════════════════════════════════════════════════════════════════
// 5. CHIFFRES CLÉS
// ═══════════════════════════════════════════════════════════════════
echo "\n── 5. CHIFFRES CLES ──\n";

set_config('numbersfrontpage', 1, 'theme_moove');
set_config('numbersfrontpagecontent', '<div class="row text-center">
    <div class="col-lg-3 col-sm-6"><h2>13</h2><p>Formations</p></div>
    <div class="col-lg-3 col-sm-6"><h2>100+</h2><p>Modules</p></div>
    <div class="col-lg-3 col-sm-6"><h2>500+</h2><p>Questions quiz</p></div>
    <div class="col-lg-3 col-sm-6"><h2>150+</h2><p>Cas cliniques</p></div>
</div>', 'theme_moove');
echo "[OK] Chiffres cles\n";

// ═══════════════════════════════════════════════════════════════════
// 6. FAQ
// ═══════════════════════════════════════════════════════════════════
echo "\n── 6. FAQ ──\n";

set_config('faqcount', 6, 'theme_moove');

set_config('faqquestion1', 'À qui s\'adresse VERTEX© ?', 'theme_moove');
set_config('faqanswer1', 'Aux praticiens en exercice et en formation : chirurgiens orthopédistes, endocrinologues, internistes, spécialistes AMP, médecins généralistes.', 'theme_moove');

set_config('faqquestion2', 'Quelles spécialités sont couvertes ?', 'theme_moove');
set_config('faqanswer2', 'Orthopédie (scoliose, PTG, IOA, tendinites, obésité, LCA), endocrinologie (diabétologie, HTA, hypothyroïdies, hyperthyroïdies), AMP (FIV) et histoire de l\'orthopédie.', 'theme_moove');

set_config('faqquestion3', 'Comment fonctionne la certification ?', 'theme_moove');
set_config('faqanswer3', '4 niveaux progressifs : Bronze (bases), Argent (intermédiaire), Or (avancé), Diamant (expert). Validés par quiz et cas cliniques.', 'theme_moove');

set_config('faqquestion4', 'Qu\'est-ce que le simulateur 3D ?', 'theme_moove');
set_config('faqanswer4', 'Un simulateur biomécanique exclusif par éléments finis pour pratiquer virtuellement des corrections chirurgicales de scoliose sur des modèles 3D patient-spécifiques.', 'theme_moove');

set_config('faqquestion5', 'Quelle est la durée d\'accès ?', 'theme_moove');
set_config('faqanswer5', 'Accès valable 12 mois, 24h/24 et 7j/7. Vous progressez à votre rythme.', 'theme_moove');

set_config('faqquestion6', 'Les formations sont-elles adaptées au contexte marocain ?', 'theme_moove');
set_config('faqanswer6', 'Oui : cadre réglementaire marocain intégré (loi 47-14 pour l\'AMP, AMO, protocoles nationaux). Tarification adaptée MAD/EUR.', 'theme_moove');

echo "[OK] 6 FAQ\n";

// ═══════════════════════════════════════════════════════════════════
// 7. FOOTER
// ═══════════════════════════════════════════════════════════════════
echo "\n── 7. FOOTER ──\n";

set_config('website', 'https://doctraining.ma', 'theme_moove');
set_config('mail', 'contact@doctraining.ma', 'theme_moove');
set_config('footnote', '<div class="vertex-footer-copyright">© 2026 VERTEX© — Virtual Environment for Real-Time EXpertise<br>Tous droits réservés — <a href="mailto:contact@doctraining.ma">contact@doctraining.ma</a></div>', 'theme_moove');
echo "[OK] Footer\n";

// ═══════════════════════════════════════════════════════════════════
// 8. CSS CUSTOM VERTEX©
// ═══════════════════════════════════════════════════════════════════
echo "\n── 8. CSS CUSTOM ──\n";

$vertex_css = '
/* === VERTEX© — CSS Custom pour Moodle 4.5 + Theme Moove === */

/* --- COULEURS VERTEX --- */
:root {
    --vertex-primary: #0D47A1;
    --vertex-primary-light: #1565C0;
    --vertex-accent: #E3F2FD;
    --vertex-success: #2E7D32;
    --vertex-dark: #1A237E;
    --vertex-text: #333;
    --vertex-gray: #666;
}

/* --- MASQUER CREDITS THEME --- */
.footer-content-debugging,
.footer-content-debugging *,
a[href*="conecti.me"],
a[href*="willianmano"],
.footer-popover .footer-desc a[href*="conecti"],
.footer-main-info p:last-child,
.theme-credit,
#page-footer .logininfo,
#page-footer .tool_usertours-resettourcontainer {
    display: none !important;
}

#page-footer .footer-content-popover {
    text-align: center;
    font-size: 0.85em;
    color: var(--vertex-gray);
}

/* --- NAVBAR --- */
.navbar {
    background: linear-gradient(135deg, var(--vertex-primary), var(--vertex-dark)) !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
}
.navbar .navbar-brand,
.navbar .nav-link {
    color: #fff !important;
}
.navbar .nav-link:hover {
    color: var(--vertex-accent) !important;
}
.navbar-brand img {
    max-height: 38px;
    filter: brightness(0) invert(1);
}

/* --- SLIDER --- */
.carousel-item .carousel-caption {
    background: rgba(13, 71, 161, 0.75);
    border-radius: 12px;
    padding: 25px 35px;
    backdrop-filter: blur(4px);
}
.carousel-item .carousel-caption h2 {
    font-size: 2em;
    font-weight: 700;
    text-shadow: none;
}

/* --- MARKETING BLOCKS --- */
.frontpage-marketing .marketing-block {
    border-radius: 12px;
    transition: transform 0.3s, box-shadow 0.3s;
}
.frontpage-marketing .marketing-block:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}
.frontpage-marketing .marketing-block i {
    color: var(--vertex-primary-light);
}

/* --- COURS --- */
.course-content .section .sectionname {
    color: var(--vertex-primary);
    font-weight: 700;
    border-left: 4px solid var(--vertex-primary);
    padding-left: 12px;
}
.card.dashboard-card {
    border-radius: 12px;
    border: 1px solid #e0e0e0;
    transition: transform 0.2s, box-shadow 0.2s;
}
.card.dashboard-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}
.progress-bar {
    background: linear-gradient(90deg, var(--vertex-primary-light), var(--vertex-success));
    border-radius: 8px;
}

/* --- BOUTONS --- */
.btn-primary {
    background: linear-gradient(135deg, var(--vertex-primary-light), var(--vertex-primary)) !important;
    border: none !important;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s;
}
.btn-primary:hover {
    background: linear-gradient(135deg, var(--vertex-primary), var(--vertex-dark)) !important;
    box-shadow: 0 4px 12px rgba(13, 71, 161, 0.3);
}

/* --- LOGIN --- */
.login-container .login-form {
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
}
.login-container .login-form .login-heading {
    color: var(--vertex-primary);
}

/* --- QUIZ --- */
.que .formulation {
    border-radius: 10px;
    border-left: 4px solid var(--vertex-primary-light);
}
.que.correct .formulation {
    border-left-color: var(--vertex-success);
    background: #f1f8e9;
}
.que.incorrect .formulation {
    border-left-color: #C62828;
    background: #fce4ec;
}

/* --- RESPONSIVE --- */
@media (max-width: 768px) {
    .carousel-item .carousel-caption h2 {
        font-size: 1.3em;
    }
    .carousel-item .carousel-caption {
        padding: 15px 20px;
    }
}

/* --- FOOTER --- */
#page-footer {
    background: #1A237E;
    color: #B0BEC5;
    font-size: 0.88em;
}
#page-footer a {
    color: #90CAF9;
}
#page-footer a:hover {
    color: #E3F2FD;
}
.vertex-footer-copyright {
    text-align: center;
    padding: 15px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    margin-top: 10px;
}
';

set_config('scss', $vertex_css, 'theme_moove');
echo "[OK] CSS VERTEX© applique (" . strlen($vertex_css) . " octets)\n";

// ═══════════════════════════════════════════════════════════════════
// 9. SMTP INFOMANIAK
// ═══════════════════════════════════════════════════════════════════
echo "\n── 9. SMTP INFOMANIAK ──\n";

set_config('smtphosts', 'mail.infomaniak.com:587');
set_config('smtpsecure', 'tls');
set_config('smtpauthtype', 'LOGIN');
set_config('smtpuser', 'contact@doctraining.ma');
// IMPORTANT: decommenter et mettre le vrai mot de passe SMTP
// set_config('smtppass', 'VOTRE_MOT_DE_PASSE_SMTP_ICI');
set_config('smtpmaxbulk', 50);
set_config('noreplyaddress', 'noreply@doctraining.ma');

echo "[OK] SMTP configure (mail.infomaniak.com:587 TLS)\n";
echo "[!!] Mot de passe SMTP : a configurer dans Admin > Serveur > E-mail\n";

// ═══════════════════════════════════════════════════════════════════
// 10. SÉCURITÉ & PERFORMANCE
// ═══════════════════════════════════════════════════════════════════
echo "\n── 10. SECURITE & PERFORMANCE ──\n";

set_config('forcelogin', 0);
set_config('forceloginforprofiles', 1);
set_config('enablewebservices', 1);
set_config('enablemobilewebservice', 1);
set_config('passwordpolicy', 1);
set_config('minpasswordlength', 8);
set_config('guestloginbutton', 0);
set_config('cachejs', 1);
set_config('langstringcache', 1);
set_config('enablestats', 1);
set_config('registerauth', 'email');

echo "[OK] Securite et performance\n";

// ═══════════════════════════════════════════════════════════════════
// PURGE CACHE
// ═══════════════════════════════════════════════════════════════════
echo "\n── FINALISATION ──\n";
purge_all_caches();
echo "[OK] Cache purge\n";

// ═══════════════════════════════════════════════════════════════════
// RÉSUMÉ
// ═══════════════════════════════════════════════════════════════════
echo "\n================================================================\n";
echo "  CONFIGURATION TERMINEE\n";
echo "================================================================\n";
echo "\n";
echo "  Theme Moove : active + slider + marketing + FAQ + CSS\n";
echo "  SMTP : mail.infomaniak.com:587 (mot de passe a ajouter)\n";
echo "  Site : VERTEX© doctraining.ma\n";
echo "\n";
echo "  ACTIONS MANUELLES :\n";
echo "  1. Mot de passe SMTP : Admin > Serveur > E-mail\n";
echo "  2. Logo SVG : Admin > Apparence > Logos\n";
echo "  3. Favicon : Admin > Apparence > Logos\n";
echo "  4. Images slider : Admin > Apparence > Themes > Moove\n";
echo "  5. Cron : Manager Infomaniak > Taches planifiees\n";
echo "     Commande : php ~/sites/doctraining.ma/admin/cli/cron.php\n";
echo "     Frequence : */5 * * * *\n";
echo "\n";
echo "  !! SUPPRIMEZ CE FICHIER APRES EXECUTION !!\n";
echo "  rm ~/sites/doctraining.ma/setup_vertex_production.php\n";
echo "================================================================\n";
