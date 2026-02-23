<?php
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');

echo "=== CONFIGURATION THEME MOOVE ===" . PHP_EOL;

// 1. Activer Moove comme theme par defaut
set_config('theme', 'moove');
echo "[OK] Theme Moove active" . PHP_EOL;

// 2. Couleur principale - bleu medical professionnel
set_config('brandcolor', '#0066CC', 'theme_moove');
echo "[OK] Couleur principale: #0066CC (bleu medical)" . PHP_EOL;

// 3. Couleur menu secondaire
set_config('secondarymenucolor', '#004C99', 'theme_moove');
echo "[OK] Menu secondaire: #004C99" . PHP_EOL;

// 4. Slider - 3 slides
set_config('slidercount', 3, 'theme_moove');
echo "[OK] Slider: 3 slides" . PHP_EOL;

// Slide 1
set_config('slidertitle1', 'Formation Scoliose avec SpineSim', 'theme_moove');
set_config('slidercap1', 'Programme complet de formation medicale continue - 29 modules, 89h15 de formation intensive sur la scoliose', 'theme_moove');
echo "[OK] Slide 1 configure" . PHP_EOL;

// Slide 2
set_config('slidertitle2', 'Simulateur SpineSim', 'theme_moove');
set_config('slidercap2', 'Simulation biomecanique interactive par elements finis - Pratiquez la correction chirurgicale en environnement virtuel', 'theme_moove');
echo "[OK] Slide 2 configure" . PHP_EOL;

// Slide 3
set_config('slidertitle3', 'Certification DPC', 'theme_moove');
set_config('slidercap3', 'Formation eligible au Developpement Professionnel Continu - Certification reconnue par les instances medicales', 'theme_moove');
echo "[OK] Slide 3 configure" . PHP_EOL;

// 5. Marketing boxes
set_config('displaymarketingbox', 1, 'theme_moove');
set_config('marketingheading', 'Pourquoi cette formation ?', 'theme_moove');
set_config('marketingcontent', 'Un programme unique alliant theorie avancee, cas cliniques interactifs et simulation biomecanique pour maitriser la prise en charge de la scoliose.', 'theme_moove');

// Marketing box 1
set_config('marketing1icon', 'book-medical', 'theme_moove');
set_config('marketing1heading', '29 Modules', 'theme_moove');
set_config('marketing1content', 'De l\'anatomie du rachis a la chirurgie avancee, un parcours progressif et structure couvrant tous les aspects de la scoliose.', 'theme_moove');

// Marketing box 2
set_config('marketing2icon', 'laptop-medical', 'theme_moove');
set_config('marketing2heading', 'Simulation SpineSim', 'theme_moove');
set_config('marketing2content', 'Simulateur biomecanique par elements finis : planifiez et testez vos corrections chirurgicales sur des modeles 3D realistes.', 'theme_moove');

// Marketing box 3
set_config('marketing3icon', 'certificate', 'theme_moove');
set_config('marketing3heading', 'Certification', 'theme_moove');
set_config('marketing3content', 'Evaluations a 4 niveaux (Bronze, Argent, Or, Diamant) avec certification DPC reconnue.', 'theme_moove');

// Marketing box 4
set_config('marketing4icon', 'users', 'theme_moove');
set_config('marketing4heading', 'Communaute', 'theme_moove');
set_config('marketing4content', 'Forum de discussion, cas cliniques collaboratifs et reseau professionnel de specialistes de la scoliose.', 'theme_moove');

echo "[OK] 4 blocs marketing configures" . PHP_EOL;

// 6. Chiffres cles sur la page d'accueil
set_config('numbersfrontpage', 1, 'theme_moove');
set_config('numbersfrontpagecontent', '<div class="row text-center">
    <div class="col-lg-3 col-sm-6"><h2>29</h2><p>Modules</p></div>
    <div class="col-lg-3 col-sm-6"><h2>89h</h2><p>de formation</p></div>
    <div class="col-lg-3 col-sm-6"><h2>600+</h2><p>Questions quiz</p></div>
    <div class="col-lg-3 col-sm-6"><h2>130</h2><p>References</p></div>
</div>', 'theme_moove');
echo "[OK] Chiffres cles configures" . PHP_EOL;

// 7. FAQ
set_config('faqcount', 4, 'theme_moove');

set_config('faqquestion1', 'A qui s\'adresse cette formation ?', 'theme_moove');
set_config('faqanswer1', 'Aux chirurgiens orthopedistes, neurochirurgiens, medecins du sport, kinesitherapeutes et tout professionnel de sante implique dans la prise en charge de la scoliose.', 'theme_moove');

set_config('faqquestion2', 'Quelle est la duree de la formation ?', 'theme_moove');
set_config('faqanswer2', '89h15 reparties sur 29 modules. Vous progressez a votre rythme avec un acces 24/7 pendant 12 mois.', 'theme_moove');

set_config('faqquestion3', 'La formation est-elle certifiante ?', 'theme_moove');
set_config('faqanswer3', 'Oui, la formation est eligible au DPC (Developpement Professionnel Continu). Vous recevrez un certificat a chaque niveau valide (Bronze, Argent, Or, Diamant).', 'theme_moove');

set_config('faqquestion4', 'Qu\'est-ce que SpineSim ?', 'theme_moove');
set_config('faqanswer4', 'SpineSim est un simulateur biomecanique exclusif utilisant la methode des elements finis. Il vous permet de pratiquer virtuellement des corrections chirurgicales de scoliose sur des modeles 3D patient-specifiques.', 'theme_moove');

echo "[OK] 4 FAQ configurees" . PHP_EOL;

// 8. Footer - reseaux sociaux et contact
set_config('website', 'https://scoliose-formation.fr', 'theme_moove');
set_config('mail', 'contact@scoliose-formation.fr', 'theme_moove');
echo "[OK] Footer configure" . PHP_EOL;

// 9. Police moderne
set_config('fontsite', 'Inter', 'theme_moove');
echo "[OK] Police: Inter" . PHP_EOL;

// 10. CSS personnalise
$custom_css = '
/* Scoliose Formation - CSS personnalise */
.frontpage-slider .carousel-caption h5 {
    font-size: 2.5rem;
    font-weight: 700;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
}
.frontpage-slider .carousel-caption p {
    font-size: 1.2rem;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
}
.marketing-block {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.marketing-block:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,102,204,0.15);
}
.navbar {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
';
set_config('scss', $custom_css, 'theme_moove');
echo "[OK] CSS personnalise ajoute" . PHP_EOL;

// 11. Activer le course index dans le theme
set_config('enablecourseindex', 1, 'theme_moove');
echo "[OK] Index de cours active" . PHP_EOL;

// Purger le cache
purge_all_caches();
echo PHP_EOL . "=== THEME MOOVE CONFIGURE - Cache purge ===" . PHP_EOL;
echo "Ouvrez http://localhost:8890 pour voir le resultat" . PHP_EOL;
