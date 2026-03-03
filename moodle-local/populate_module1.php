<?php
/**
 * Peuplement du Module 1 : Anatomie du Rachis
 * 5 pages de cours + 1 quiz de 15 QCM
 */
define('CLI_SCRIPT', true);
require('/var/www/html/config.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/mod/page/lib.php');
require_once($CFG->dirroot . '/mod/quiz/lib.php');
require_once($CFG->dirroot . '/question/editlib.php');
require_once($CFG->libdir . '/questionlib.php');
require_once($CFG->dirroot . '/question/type/multichoice/questiontype.php');

$courseid = 2; // SCOL-COMPLET
$course = $DB->get_record('course', ['id' => $courseid], '*', MUST_EXIST);

// Trouver la section 1 (Module 1)
$section = $DB->get_record('course_sections', ['course' => $courseid, 'section' => 1], '*', MUST_EXIST);
echo "Section trouvee: {$section->id} - {$section->name}\n";

// ============================================================
// FONCTION : Ajouter une page au cours
// ============================================================
function add_page_to_course($course, $section, $title, $content) {
    global $DB, $CFG;
    
    $moduleid = $DB->get_field('modules', 'id', ['name' => 'page']);
    
    $page = new stdClass();
    $page->course = $course->id;
    $page->name = $title;
    $page->intro = '';
    $page->introformat = FORMAT_HTML;
    $page->content = $content;
    $page->contentformat = FORMAT_HTML;
    $page->display = 5; // RESOURCELIB_DISPLAY_OPEN
    $page->timemodified = time();
    $page->id = $DB->insert_record('page', $page);
    
    $cm = new stdClass();
    $cm->course = $course->id;
    $cm->module = $moduleid;
    $cm->instance = $page->id;
    $cm->section = $section->id;
    $cm->added = time();
    $cm->visible = 1;
    $cm->visibleoncoursepage = 1;
    $cm->groupmode = 0;
    $cm->completion = 2; // COMPLETION_TRACKING_MANUAL
    $cmid = $DB->insert_record('course_modules', $cm);
    
    // Ajouter à la séquence de la section
    $seq = $section->sequence ? $section->sequence . ',' . $cmid : (string)$cmid;
    $DB->set_field('course_sections', 'sequence', $seq, ['id' => $section->id]);
    $section->sequence = $seq;
    
    echo "  Page ajoutee: $title (cmid=$cmid)\n";
    return $cmid;
}

// ============================================================
// PAGE 1.1 : Anatomie descriptive du rachis
// ============================================================
$content_1_1 = '
<h2>1.1 Anatomie descriptive du rachis</h2>

<h3>Vertebres cervicales (C1-C7)</h3>
<p>Le rachis cervical comprend <strong>7 vertebres</strong> avec deux vertebres atypiques :</p>
<ul>
<li><strong>Atlas (C1)</strong> : vertebre annulaire sans corps vertebral ni processus epineux. Elle porte le crane via les masses laterales et les condyles occipitaux.</li>
<li><strong>Axis (C2)</strong> : caracterisee par le <strong>processus odontoide</strong> (dent) qui sert de pivot pour la rotation de la tete.</li>
<li><strong>C3 a C7</strong> : vertebres typiques avec un corps vertebral petit, un foramen transversaire (passage de l\'artere vertebrale), et des processus epineux bifides (C3-C6).</li>
</ul>

<h3>Vertebres thoraciques (T1-T12)</h3>
<p>Les 12 vertebres thoraciques se distinguent par :</p>
<ul>
<li>La presence de <strong>facettes costales</strong> sur les corps vertebraux et les processus transverses</li>
<li>Les <strong>articulations costo-vertebrales</strong> : costo-corporéales et costo-transversaires</li>
<li>Un canal rachidien plus etroit qu\'aux autres niveaux</li>
<li>Des processus epineux longs, obliques vers le bas (surtout T5-T8)</li>
</ul>

<h3>Vertebres lombaires (L1-L5)</h3>
<ul>
<li>Corps vertebral <strong>volumineux</strong> (supporte le poids du tronc)</li>
<li>Processus epineux courts et horizontaux</li>
<li>Facettes articulaires orientees dans le plan sagittal</li>
<li>Absence de foramen transversaire et de facettes costales</li>
</ul>

<h3>Sacrum et coccyx</h3>
<p>Le sacrum est forme de <strong>5 vertebres sacrees soudees</strong>. Il s\'articule avec L5 (charniere lombo-sacree) et les os iliaques (articulations sacro-iliaques). Le coccyx (3-5 vertebres vestigiales soudees) termine le rachis.</p>

<div style="background:#e8f4f8; padding:15px; border-radius:8px; margin:15px 0;">
<h4>A retenir</h4>
<p>Le rachis comporte <strong>33 vertebres</strong> au total : 7 cervicales, 12 thoraciques, 5 lombaires, 5 sacrees (soudees), 4 coccygiennes (soudees). Les 24 vertebres mobiles assurent la mobilite du tronc.</p>
</div>
';
add_page_to_course($course, $section, '1.1 Anatomie descriptive du rachis', $content_1_1);

// ============================================================
// PAGE 1.2 : Anatomie fonctionnelle
// ============================================================
$content_1_2 = '
<h2>1.2 Anatomie fonctionnelle</h2>

<h3>Unite fonctionnelle rachidienne — Segment mobile de Junghans</h3>
<p>Le concept cle de la biomecanique rachidienne est le <strong>segment mobile de Junghans</strong>, compose de :</p>
<ul>
<li>Deux vertebres adjacentes</li>
<li>Le disque intervertebral entre elles</li>
<li>Les articulations zygapophysaires (facettaires)</li>
<li>Les ligaments associes</li>
</ul>
<p>Ce segment constitue l\'<strong>unite fonctionnelle</strong> du rachis, permettant d\'analyser la mobilite et la stabilite a chaque niveau.</p>

<h3>Disque intervertebral</h3>
<p>Le disque comporte deux structures :</p>
<ul>
<li><strong>Nucleus pulposus</strong> (noyau) : gel hydrophile, riche en proteoglycanes, au centre du disque. Il agit comme un amortisseur et repartit les pressions.</li>
<li><strong>Annulus fibrosus</strong> (anneau) : couches concentriques de fibres de collagene croisees a 30°, entourant le nucleus. Il resiste aux forces de torsion et de cisaillement.</li>
</ul>

<h3>Articulations zygapophysaires (facettaires)</h3>
<p>Leur orientation varie selon le niveau et determine les mouvements predominants :</p>
<table border="1" cellpadding="8" style="border-collapse:collapse; width:100%;">
<tr style="background:#2c3e50; color:white;"><th>Niveau</th><th>Orientation des facettes</th><th>Mouvement predominant</th></tr>
<tr><td>Cervical</td><td>45° / plan oblique</td><td>Flexion-extension + rotation</td></tr>
<tr><td>Thoracique</td><td>Plan frontal (60°)</td><td>Rotation axiale</td></tr>
<tr><td>Lombaire</td><td>Plan sagittal (90°)</td><td>Flexion-extension</td></tr>
</table>

<h3>Systeme ligamentaire</h3>
<ul>
<li><strong>Ligament longitudinal anterieur (LLA)</strong> : large, court la face anterieure des corps vertebraux. Limite l\'extension.</li>
<li><strong>Ligament longitudinal posterieur (LLP)</strong> : plus etroit, sur la face posterieure des corps. Limite la flexion.</li>
<li><strong>Ligaments jaunes</strong> : relient les lames des vertebres adjacentes. Riches en elastine, ils maintiennent la posture erigee.</li>
<li><strong>Ligaments inter-epineux et supra-epineux</strong> : entre et au sommet des processus epineux.</li>
</ul>

<h3>Canal rachidien et foramens</h3>
<p>Le canal rachidien abrite la <strong>moelle epiniere</strong> (jusqu\'a L1-L2) puis la <strong>queue de cheval</strong>. Les foramens intervertebraux (trous de conjugaison) permettent le passage des nerfs spinaux.</p>
';
add_page_to_course($course, $section, '1.2 Anatomie fonctionnelle', $content_1_2);

// ============================================================
// PAGE 1.3 : Musculature rachidienne
// ============================================================
$content_1_3 = '
<h2>1.3 Musculature rachidienne</h2>

<h3>Muscles erecteurs du rachis</h3>
<p>Le groupe des erecteurs du rachis (erector spinae) constitue la masse musculaire posterieure principale :</p>
<ul>
<li><strong>Iliocostal</strong> (lateral) : s\'insere sur les cotes et les processus transverses. Role : extension et inclinaison laterale.</li>
<li><strong>Longissimus</strong> (intermediaire) : le plus long muscle du dos, de la base du crane au sacrum. Extension du rachis.</li>
<li><strong>Epineux</strong> (spinalis, medial) : entre les processus epineux. Extension.</li>
</ul>

<h3>Muscles transversaires epineux</h3>
<ul>
<li><strong>Multifides</strong> : muscles profonds, essentiels pour la <strong>stabilite segmentaire</strong>. Ils controlent les mouvements fins intervertebraux.</li>
<li><strong>Rotateurs</strong> : courts et longs, assurent la rotation controlée du rachis.</li>
</ul>

<h3>Muscles abdominaux</h3>
<p>Ils jouent un role fondamental dans l\'<strong>equilibre sagittal</strong> :</p>
<ul>
<li>Grand droit de l\'abdomen : flechisseur du tronc</li>
<li>Obliques externe et interne : rotation et stabilisation</li>
<li>Transverse de l\'abdomen : stabilisation profonde, augmentation de la pression intra-abdominale</li>
</ul>
<p>Dans la scoliose, un <strong>desequilibre musculaire asymetrique</strong> contribue a la progression de la courbure.</p>

<h3>Psoas et carre des lombes</h3>
<ul>
<li><strong>Psoas</strong> : relie le rachis lombaire au femur. Son asymetrie peut contribuer aux deformations rachidiennes.</li>
<li><strong>Carre des lombes</strong> : inclinaison laterale du tronc, stabilisation de la 12e cote pour la respiration.</li>
</ul>

<h3>Muscles respiratoires</h3>
<ul>
<li><strong>Diaphragme</strong> : muscle principal de l\'inspiration, s\'insere sur les vertebres lombaires hautes</li>
<li><strong>Intercostaux</strong> : mobilisent la cage thoracique</li>
</ul>
<div style="background:#ffeeba; padding:15px; border-radius:8px; margin:15px 0;">
<h4>Point clinique</h4>
<p>Dans les scolioses severes (> 60°), la deformation thoracique comprime le poumon du cote concave, reduisant la capacite respiratoire. La reeducation musculaire respiratoire est un element cle du traitement.</p>
</div>
';
add_page_to_course($course, $section, '1.3 Musculature rachidienne', $content_1_3);

// ============================================================
// PAGE 1.4 : Neuroanatomie rachidienne
// ============================================================
$content_1_4 = '
<h2>1.4 Neuroanatomie rachidienne</h2>

<h3>Moelle epiniere</h3>
<p>La moelle epiniere s\'etend du <strong>foramen magnum</strong> jusqu\'au niveau de <strong>L1-L2</strong> (cone medullaire). Points cles :</p>
<ul>
<li>31 paires de nerfs spinaux : 8 cervicaux, 12 thoraciques, 5 lombaires, 5 sacres, 1 coccygien</li>
<li>Deux renflements : <strong>cervical</strong> (C5-T1, plexus brachial) et <strong>lombaire</strong> (L1-S3, plexus lombo-sacre)</li>
<li>En dessous de L2 : <strong>queue de cheval</strong> (cauda equina), ensemble de racines nerveuses</li>
</ul>

<h3>Racines nerveuses et plexus</h3>
<table border="1" cellpadding="8" style="border-collapse:collapse; width:100%;">
<tr style="background:#2c3e50; color:white;"><th>Plexus</th><th>Racines</th><th>Territoire</th></tr>
<tr><td>Cervical</td><td>C1-C4</td><td>Cou, diaphragme (nerf phrenique C3-C5)</td></tr>
<tr><td>Brachial</td><td>C5-T1</td><td>Membre superieur</td></tr>
<tr><td>Lombaire</td><td>L1-L4</td><td>Paroi abdominale, cuisse anterieure</td></tr>
<tr><td>Sacre</td><td>L4-S3</td><td>Fesse, membre inferieur, pied (nerf sciatique)</td></tr>
</table>

<h3>Systeme nerveux autonome rachidien</h3>
<ul>
<li><strong>Sympathique</strong> : chaine ganglionnaire para-vertebrale (T1-L2). Controle la vasomotricite, la sudation.</li>
<li><strong>Parasympathique sacre</strong> : S2-S4, controle vesico-sphincterien et genital.</li>
</ul>

<h3>Vascularisation medullaire</h3>
<div style="background:#f8d7da; padding:15px; border-radius:8px; margin:15px 0;">
<h4>CRITIQUE pour la chirurgie</h4>
<p><strong>L\'artere d\'Adamkiewicz</strong> (arteria radicularis magna) est l\'artere nourriciere principale de la moelle thoraco-lombaire basse. Elle nait le plus souvent du cote <strong>gauche</strong>, entre <strong>T9 et T12</strong> (80% des cas).</p>
<p>Sa lesion lors d\'une chirurgie de scoliose peut provoquer un <strong>infarctus medullaire</strong> avec paraplegie. Son identification preoperatoire par angio-IRM ou angioscanner est recommandee dans les cas complexes.</p>
</div>
';
add_page_to_course($course, $section, '1.4 Neuroanatomie rachidienne', $content_1_4);

// ============================================================
// PAGE 1.5 : Courbures physiologiques
// ============================================================
$content_1_5 = '
<h2>1.5 Courbures physiologiques et equilibre sagittal</h2>

<h3>Les courbures normales</h3>
<p>Le rachis presente dans le plan sagittal des courbures alternees :</p>
<table border="1" cellpadding="8" style="border-collapse:collapse; width:100%;">
<tr style="background:#2c3e50; color:white;"><th>Courbure</th><th>Type</th><th>Valeurs normales</th></tr>
<tr><td>Cervicale</td><td>Lordose</td><td>20 a 40°</td></tr>
<tr><td>Thoracique</td><td>Cyphose</td><td>20 a 45°</td></tr>
<tr><td>Lombaire</td><td>Lordose</td><td>40 a 60°</td></tr>
</table>
<p>Ces courbures multiplient par <strong>10</strong> la resistance du rachis aux forces axiales par rapport a un rachis rectiligne (formule : R = N² + 1, avec N = nombre de courbures).</p>

<h3>Parametres pelviens</h3>
<p>L\'equilibre sagittal depend fondamentalement du bassin. Trois parametres cles :</p>
<ul>
<li><strong>Incidence pelvienne (PI)</strong> : angle fixe, propre a chaque individu (moyenne ~52°). Determine la lordose lombaire necessaire.</li>
<li><strong>Pente sacree (SS)</strong> : angle entre le plateau sacre et l\'horizontale.</li>
<li><strong>Version pelvienne (PT)</strong> : angle entre la verticale et la droite joignant le centre du plateau sacre aux tetes femorales.</li>
</ul>
<p><strong>Relation fondamentale : PI = PT + SS</strong></p>

<h3>Equilibre sagittal global</h3>
<ul>
<li><strong>C7 plumb line</strong> : verticale abaissee depuis le centre de C7. Normalement, elle tombe sur le plateau sacre (± 2 cm).</li>
<li><strong>SVA (Sagittal Vertical Axis)</strong> : distance entre la C7 plumb line et le bord posterieur du plateau sacre. Normal : &lt; 5 cm.</li>
<li>Un SVA > 5 cm traduit un <strong>desequilibre sagittal anterieur</strong>, source de douleurs et de handicap.</li>
</ul>

<h3>Mecanismes de compensation</h3>
<p>Quand l\'equilibre sagittal est perturbe, le corps compense par :</p>
<ol>
<li><strong>Retroversion pelvienne</strong> (augmentation du PT)</li>
<li><strong>Flexion des genoux</strong></li>
<li><strong>Hyperextension cervicale</strong></li>
</ol>
<p>Ces mecanismes sont energetiquement couteux et aboutissent a la fatigue et la douleur.</p>

<div style="background:#d4edda; padding:15px; border-radius:8px; margin:15px 0;">
<h4>Synthese Module 1</h4>
<p>L\'anatomie du rachis est le fondement de la comprehension de la scoliose. Les concepts cles a retenir :</p>
<ul>
<li>33 vertebres dont 24 mobiles</li>
<li>Le segment mobile de Junghans = unite fonctionnelle</li>
<li>L\'artere d\'Adamkiewicz : critique en chirurgie</li>
<li>PI = PT + SS : relation fondamentale de l\'equilibre sagittal</li>
<li>SVA &lt; 5 cm = equilibre sagittal normal</li>
</ul>
</div>
';
add_page_to_course($course, $section, '1.5 Courbures physiologiques et equilibre sagittal', $content_1_5);

echo "\n=== 5 pages de cours creees ===\n\n";

// ============================================================
// QUIZ MODULE 1 — 15 QCM
// ============================================================
echo "Creation du quiz...\n";

// 1. Créer le quiz
$quizmoduleid = $DB->get_field('modules', 'id', ['name' => 'quiz']);

$quiz = new stdClass();
$quiz->course = $courseid;
$quiz->name = 'Quiz Module 1 : Anatomie du Rachis';
$quiz->intro = '<p>Ce quiz comporte <strong>15 questions a choix multiples</strong>. Vous devez obtenir un score de <strong>70% minimum</strong> (11/15) pour valider ce module et acceder au Module 2.</p><p>Vous avez <strong>2 tentatives</strong>. La meilleure note est conservee.</p>';
$quiz->introformat = FORMAT_HTML;
$quiz->timeopen = 0;
$quiz->timeclose = 0;
$quiz->timelimit = 1800; // 30 minutes
$quiz->grade = 100;
$quiz->attempts = 2;
$quiz->grademethod = 1; // QUIZ_GRADEHIGHEST
$quiz->questionsperpage = 1;
$quiz->shuffleanswers = 1;
$quiz->preferredbehaviour = 'deferredfeedback';
$quiz->decimalpoints = 0;
$quiz->reviewattempt = 69904;
$quiz->reviewcorrectness = 69904;
$quiz->reviewmarks = 69904;
$quiz->reviewspecificfeedback = 69904;
$quiz->reviewgeneralfeedback = 69904;
$quiz->reviewrightanswer = 69904;
$quiz->timemodified = time();
$quiz->id = $DB->insert_record('quiz', $quiz);

// Ajouter le module au cours
$cm = new stdClass();
$cm->course = $courseid;
$cm->module = $quizmoduleid;
$cm->instance = $quiz->id;
$cm->section = $section->id;
$cm->added = time();
$cm->visible = 1;
$cm->visibleoncoursepage = 1;
$cm->groupmode = 0;
$cm->completion = 2;
$quizcmid = $DB->insert_record('course_modules', $cm);

$seq = $section->sequence ? $section->sequence . ',' . $quizcmid : (string)$quizcmid;
$DB->set_field('course_sections', 'sequence', $seq, ['id' => $section->id]);

echo "  Quiz cree (cmid=$quizcmid)\n";

// 2. Créer la catégorie de questions
$context = context_course::instance($courseid);

$qcat = new stdClass();
$qcat->name = 'Quiz Module 1 - Anatomie du Rachis';
$qcat->contextid = $context->id;
$qcat->info = 'Questions du Module 1';
$qcat->infoformat = FORMAT_HTML;
$qcat->stamp = make_unique_id_code();
$qcat->parent = 0;
$qcat->sortorder = 999;
$qcat->idnumber = null;
$qcat->id = $DB->insert_record('question_categories', $qcat);

echo "  Categorie de questions creee (id={$qcat->id})\n";

// 3. Définir les 15 questions
$questions = [
    [
        'name' => 'Q1 - Nombre de vertebres',
        'text' => 'Combien de vertebres comporte le rachis humain au total ?',
        'answers' => [
            ['text' => '24', 'fraction' => 0, 'feedback' => '24 est le nombre de vertebres mobiles uniquement.'],
            ['text' => '26', 'fraction' => 0, 'feedback' => 'Incorrect.'],
            ['text' => '33', 'fraction' => 1, 'feedback' => 'Correct ! 7 cervicales + 12 thoraciques + 5 lombaires + 5 sacrees + 4 coccygiennes = 33.'],
            ['text' => '30', 'fraction' => 0, 'feedback' => 'Incorrect.'],
        ]
    ],
    [
        'name' => 'Q2 - Atlas C1',
        'text' => 'Quelle est la particularite de l\'atlas (C1) ?',
        'answers' => [
            ['text' => 'Elle possede un processus odontoide', 'fraction' => 0, 'feedback' => 'C\'est l\'axis (C2) qui possede le processus odontoide.'],
            ['text' => 'Elle n\'a pas de corps vertebral', 'fraction' => 1, 'feedback' => 'Correct ! L\'atlas est une vertebre annulaire sans corps vertebral.'],
            ['text' => 'Elle est la plus grosse vertebre cervicale', 'fraction' => 0, 'feedback' => 'Incorrect.'],
            ['text' => 'Elle est soudee a C2', 'fraction' => 0, 'feedback' => 'Incorrect, C1 et C2 sont articulees.'],
        ]
    ],
    [
        'name' => 'Q3 - Vertebres thoraciques',
        'text' => 'Quelle structure anatomique est specifique aux vertebres thoraciques ?',
        'answers' => [
            ['text' => 'Le foramen transversaire', 'fraction' => 0, 'feedback' => 'Le foramen transversaire est propre aux vertebres cervicales.'],
            ['text' => 'Les facettes costales', 'fraction' => 1, 'feedback' => 'Correct ! Les facettes costales permettent l\'articulation avec les cotes.'],
            ['text' => 'Le processus odontoide', 'fraction' => 0, 'feedback' => 'Le processus odontoide est propre a C2.'],
            ['text' => 'Un corps vertebral volumineux', 'fraction' => 0, 'feedback' => 'Les corps volumineux sont plutot lombaires.'],
        ]
    ],
    [
        'name' => 'Q4 - Segment de Junghans',
        'text' => 'Le segment mobile de Junghans comprend :',
        'answers' => [
            ['text' => 'Trois vertebres et deux disques', 'fraction' => 0, 'feedback' => 'Incorrect.'],
            ['text' => 'Deux vertebres adjacentes, le disque et les structures ligamentaires', 'fraction' => 1, 'feedback' => 'Correct ! C\'est l\'unite fonctionnelle du rachis.'],
            ['text' => 'Une vertebre et ses muscles', 'fraction' => 0, 'feedback' => 'Incorrect.'],
            ['text' => 'L\'ensemble du rachis lombaire', 'fraction' => 0, 'feedback' => 'Incorrect.'],
        ]
    ],
    [
        'name' => 'Q5 - Nucleus pulposus',
        'text' => 'Le nucleus pulposus est :',
        'answers' => [
            ['text' => 'Un anneau de fibres de collagene', 'fraction' => 0, 'feedback' => 'C\'est la description de l\'annulus fibrosus.'],
            ['text' => 'Un gel hydrophile au centre du disque intervertebral', 'fraction' => 1, 'feedback' => 'Correct ! Le nucleus est un gel riche en proteoglycanes qui agit comme amortisseur.'],
            ['text' => 'Un ligament intervertebral', 'fraction' => 0, 'feedback' => 'Incorrect.'],
            ['text' => 'Un ganglion nerveux', 'fraction' => 0, 'feedback' => 'Incorrect.'],
        ]
    ],
    [
        'name' => 'Q6 - Facettes lombaires',
        'text' => 'Quelle est l\'orientation predominante des facettes articulaires au niveau lombaire ?',
        'answers' => [
            ['text' => 'Plan frontal', 'fraction' => 0, 'feedback' => 'Le plan frontal est l\'orientation thoracique.'],
            ['text' => 'Plan oblique a 45°', 'fraction' => 0, 'feedback' => 'C\'est l\'orientation cervicale.'],
            ['text' => 'Plan sagittal', 'fraction' => 1, 'feedback' => 'Correct ! Orientation sagittale favorisant la flexion-extension.'],
            ['text' => 'Plan horizontal', 'fraction' => 0, 'feedback' => 'Incorrect.'],
        ]
    ],
    [
        'name' => 'Q7 - Ligament jaune',
        'text' => 'Les ligaments jaunes sont riches en :',
        'answers' => [
            ['text' => 'Collagene de type I', 'fraction' => 0, 'feedback' => 'Le collagene I est surtout dans les tendons.'],
            ['text' => 'Elastine', 'fraction' => 1, 'feedback' => 'Correct ! Leur richesse en elastine leur donne leur couleur jaune et leur elasticite.'],
            ['text' => 'Cartilage hyalin', 'fraction' => 0, 'feedback' => 'Incorrect.'],
            ['text' => 'Tissu adipeux', 'fraction' => 0, 'feedback' => 'Incorrect.'],
        ]
    ],
    [
        'name' => 'Q8 - Multifides',
        'text' => 'Quel est le role principal des muscles multifides ?',
        'answers' => [
            ['text' => 'La flexion du tronc', 'fraction' => 0, 'feedback' => 'La flexion est assuree par les abdominaux.'],
            ['text' => 'La stabilite segmentaire du rachis', 'fraction' => 1, 'feedback' => 'Correct ! Les multifides sont les stabilisateurs profonds essentiels du rachis.'],
            ['text' => 'La rotation de la tete', 'fraction' => 0, 'feedback' => 'Incorrect.'],
            ['text' => 'L\'elevation des cotes', 'fraction' => 0, 'feedback' => 'Incorrect.'],
        ]
    ],
    [
        'name' => 'Q9 - Fin moelle epiniere',
        'text' => 'A quel niveau se termine la moelle epiniere chez l\'adulte ?',
        'answers' => [
            ['text' => 'T12', 'fraction' => 0, 'feedback' => 'Trop haut.'],
            ['text' => 'L1-L2', 'fraction' => 1, 'feedback' => 'Correct ! La moelle se termine au cone medullaire vers L1-L2. En dessous, on trouve la queue de cheval.'],
            ['text' => 'L4-L5', 'fraction' => 0, 'feedback' => 'Trop bas, a ce niveau il n\'y a que la queue de cheval.'],
            ['text' => 'S1', 'fraction' => 0, 'feedback' => 'Incorrect.'],
        ]
    ],
    [
        'name' => 'Q10 - Artere Adamkiewicz',
        'text' => 'L\'artere d\'Adamkiewicz nait le plus souvent :',
        'answers' => [
            ['text' => 'Du cote droit, entre T5 et T8', 'fraction' => 0, 'feedback' => 'Incorrect.'],
            ['text' => 'Du cote gauche, entre T9 et T12', 'fraction' => 1, 'feedback' => 'Correct ! Elle nait a gauche dans 80% des cas, entre T9 et T12.'],
            ['text' => 'Du cote gauche, entre L3 et L5', 'fraction' => 0, 'feedback' => 'Trop bas.'],
            ['text' => 'Des deux cotes a parts egales', 'fraction' => 0, 'feedback' => 'Elle a une nette predominance gauche.'],
        ]
    ],
    [
        'name' => 'Q11 - Cyphose thoracique',
        'text' => 'Quelles sont les valeurs normales de la cyphose thoracique ?',
        'answers' => [
            ['text' => '0 a 15°', 'fraction' => 0, 'feedback' => 'Trop faible.'],
            ['text' => '20 a 45°', 'fraction' => 1, 'feedback' => 'Correct ! La cyphose thoracique normale est de 20 a 45°.'],
            ['text' => '50 a 70°', 'fraction' => 0, 'feedback' => 'Ces valeurs correspondent a une hypercyphose.'],
            ['text' => '10 a 20°', 'fraction' => 0, 'feedback' => 'Trop faible.'],
        ]
    ],
    [
        'name' => 'Q12 - Incidence pelvienne',
        'text' => 'La relation PI = PT + SS signifie :',
        'answers' => [
            ['text' => 'L\'incidence pelvienne est la somme de la pente sacree et de la version pelvienne', 'fraction' => 1, 'feedback' => 'Correct ! C\'est la relation fondamentale des parametres pelviens.'],
            ['text' => 'La pente sacree est la somme de l\'incidence et de la version', 'fraction' => 0, 'feedback' => 'Incorrect : SS = PI - PT.'],
            ['text' => 'La version pelvienne est toujours superieure a la pente sacree', 'fraction' => 0, 'feedback' => 'Pas necessairement.'],
            ['text' => 'L\'incidence pelvienne varie avec la position du patient', 'fraction' => 0, 'feedback' => 'L\'incidence pelvienne est un parametre FIXE.'],
        ]
    ],
    [
        'name' => 'Q13 - SVA normal',
        'text' => 'Un SVA (Sagittal Vertical Axis) est considere comme normal quand il est :',
        'answers' => [
            ['text' => '< 5 cm', 'fraction' => 1, 'feedback' => 'Correct ! Un SVA inferieur a 5 cm traduit un bon equilibre sagittal.'],
            ['text' => '< 10 cm', 'fraction' => 0, 'feedback' => 'Un SVA de 10 cm est deja pathologique.'],
            ['text' => '> 5 cm', 'fraction' => 0, 'feedback' => 'Un SVA > 5 cm traduit un desequilibre sagittal.'],
            ['text' => 'Toujours egal a 0', 'fraction' => 0, 'feedback' => 'Le SVA n\'est pas toujours a 0.'],
        ]
    ],
    [
        'name' => 'Q14 - LLA',
        'text' => 'Le ligament longitudinal anterieur (LLA) limite principalement :',
        'answers' => [
            ['text' => 'La flexion', 'fraction' => 0, 'feedback' => 'C\'est le LLP qui limite la flexion.'],
            ['text' => 'L\'extension', 'fraction' => 1, 'feedback' => 'Correct ! Le LLA, situe en avant, se tend lors de l\'extension et la limite.'],
            ['text' => 'La rotation', 'fraction' => 0, 'feedback' => 'Incorrect.'],
            ['text' => 'L\'inclinaison laterale', 'fraction' => 0, 'feedback' => 'Incorrect.'],
        ]
    ],
    [
        'name' => 'Q15 - Compensation sagittale',
        'text' => 'Quel est le PREMIER mecanisme de compensation d\'un desequilibre sagittal anterieur ?',
        'answers' => [
            ['text' => 'La flexion des genoux', 'fraction' => 0, 'feedback' => 'C\'est un mecanisme secondaire.'],
            ['text' => 'L\'hyperextension cervicale', 'fraction' => 0, 'feedback' => 'C\'est un mecanisme tardif.'],
            ['text' => 'La retroversion pelvienne (augmentation du PT)', 'fraction' => 1, 'feedback' => 'Correct ! La retroversion du bassin est le premier mecanisme mis en jeu pour compenser un desequilibre sagittal.'],
            ['text' => 'La flexion des hanches', 'fraction' => 0, 'feedback' => 'Incorrect.'],
        ]
    ],
];

// 4. Créer chaque question et l'ajouter au quiz
$slot = 1;
foreach ($questions as $q) {
    // Créer l'entrée question
    $question = new stdClass();
    $question->category = $qcat->id;
    $question->name = $q['name'];
    $question->questiontext = $q['text'];
    $question->questiontextformat = FORMAT_HTML;
    $question->generalfeedback = '';
    $question->generalfeedbackformat = FORMAT_HTML;
    $question->qtype = 'multichoice';
    $question->defaultmark = 1;
    $question->penalty = 0.3333333;
    $question->length = 1;
    $question->stamp = make_unique_id_code();
    $question->version = make_unique_id_code();
    $question->hidden = 0;
    $question->timecreated = time();
    $question->timemodified = time();
    $question->createdby = 2;
    $question->modifiedby = 2;
    $question->idnumber = null;
    $question->status = 'ready'; // Moodle 4.x
    $questionid = $DB->insert_record('question', $question);

    // Créer la version de la question (Moodle 4.x question bank)
    $qbe = new stdClass();
    $qbe->questioncategoryid = $qcat->id;
    $qbe->idnumber = null;
    $qbe->ownerid = 2;
    $qbeid = $DB->insert_record('question_bank_entries', $qbe);

    $qv = new stdClass();
    $qv->questionbankentryid = $qbeid;
    $qv->version = 1;
    $qv->questionid = $questionid;
    $qv->status = 'ready';
    $DB->insert_record('question_versions', $qv);

    // Options multichoice
    $mc = new stdClass();
    $mc->questionid = $questionid;
    $mc->layout = 0;
    $mc->single = 1;
    $mc->shuffleanswers = 1;
    $mc->correctfeedback = 'Bonne reponse !';
    $mc->correctfeedbackformat = FORMAT_HTML;
    $mc->partiallycorrectfeedback = '';
    $mc->partiallycorrectfeedbackformat = FORMAT_HTML;
    $mc->incorrectfeedback = 'Mauvaise reponse.';
    $mc->incorrectfeedbackformat = FORMAT_HTML;
    $mc->answernumbering = 'abc';
    $mc->shownumcorrect = 1;
    $mc->showstandardinstruction = 0;
    $DB->insert_record('qtype_multichoice_options', $mc);

    // Réponses
    foreach ($q['answers'] as $a) {
        $answer = new stdClass();
        $answer->question = $questionid;
        $answer->answer = $a['text'];
        $answer->answerformat = FORMAT_HTML;
        $answer->fraction = $a['fraction'];
        $answer->feedback = $a['feedback'];
        $answer->feedbackformat = FORMAT_HTML;
        $DB->insert_record('question_answers', $answer);
    }

    // Ajouter au quiz via quiz_slots
    $quizslot = new stdClass();
    $quizslot->quizid = $quiz->id;
    $quizslot->slot = $slot;
    $quizslot->questionid = $questionid;
    $quizslot->page = $slot; // 1 question par page
    $quizslot->maxmark = 1;
    $DB->insert_record('quiz_slots', $quizslot);

    echo "  Question $slot: {$q['name']} (qid=$questionid)\n";
    $slot++;
}

// Mettre à jour le grade du quiz
$quiz->sumgrades = count($questions);
$DB->update_record('quiz', $quiz);

// Purger les caches
purge_all_caches();

echo "\n=== MODULE 1 COMPLET ===\n";
echo "5 pages de cours + 1 quiz de 15 QCM\n";
echo "Score minimum pour valider : 70% (11/15)\n";
echo "Tentatives : 2 | Temps : 30 minutes\n";
echo "Acces : http://localhost:8890/course/view.php?id=$courseid\n";
