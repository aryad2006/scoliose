#!/usr/bin/env python3
"""
VERTEX© — Générateur du cours CDC Admin
========================================
Lit les fichiers HTML des CDC (moodle_html/) et génère le script PHP
pour créer dans Moodle :
  - Catégorie cachée "Documentation interne" (rôle Manager/Admin uniquement)
  - Cours unique "VERTEX© — Documentation CDC"
  - Une section par formation avec ses pages CDC

Usage : python3 generate_cdc_admin.py
Output : setup_cdc_admin_course.php  (à exécuter dans Moodle Docker ou prod)
"""

import re
from pathlib import Path

# ─────────────────────────────────────────────────────────────────────────────
#  CONFIGURATION
# ─────────────────────────────────────────────────────────────────────────────

MOODLE_DIR = Path(__file__).parent
CDC_DIR = MOODLE_DIR / "moodle_html"
OUTPUT_PHP = MOODLE_DIR / "setup_cdc_admin_course.php"

# Ordre d'affichage des formations + noms lisibles
FORMATIONS = [
    ("diabetologie",   "Diabétologie"),
    ("scoliose",       "Scoliose"),
    ("ptg",            "Prothèse Totale Genou"),
    ("ioa",            "Infections Ostéo-Articulaires"),
    ("tendinites",     "Tendinites"),
    ("obesite",        "Obésité et Orthopédie"),
    ("hta",            "HTA"),
    ("hypothyroidie",  "Hypothyroïdies"),
    ("hyperthyroidie", "Hyperthyroïdies"),
    ("fiv",            "FIV & AMP"),
    ("histoire",       "Histoire de l'Orthopédie"),
    ("lca",            "LCA"),
]

# Fichiers à EXCLURE (index navigation, doublons complets)
EXCLUDE_PATTERNS = [
    r'^index\.html$',
]

# Ordre de tri des types de fichiers dans chaque section
FILE_ORDER = ["CDC_", "MODULE_", "CAS_CLINIQUES_", "QUIZ_"]


# ─────────────────────────────────────────────────────────────────────────────
#  HELPERS
# ─────────────────────────────────────────────────────────────────────────────

def should_exclude(filename: str) -> bool:
    for pat in EXCLUDE_PATTERNS:
        if re.match(pat, filename, re.IGNORECASE):
            return True
    return False


def file_sort_key(filename: str) -> tuple:
    """Trie : CDC_* d'abord, puis MODULE_*, CAS_CLINIQUES_*, QUIZ_*, autres."""
    for i, prefix in enumerate(FILE_ORDER):
        if filename.startswith(prefix):
            # Extraire le numéro si présent
            m = re.search(r'_(\d+)_', filename)
            return (i, int(m.group(1)) if m else 99, filename)
    return (len(FILE_ORDER), 0, filename)


def make_page_title(filename: str, formation_name: str) -> str:
    """Génère un titre lisible depuis le nom de fichier."""
    stem = Path(filename).stem

    # Retirer les préfixes connus
    stem = re.sub(r'^CDC_[A-Z]+_', '', stem)
    stem = re.sub(r'^MODULE_', '', stem)
    stem = re.sub(r'^CAS_CLINIQUES_[A-Z]+', 'CAS CLINIQUES', stem)
    stem = re.sub(r'^QUIZ_[A-Z]+', 'QUIZ', stem)

    # Numéro + titre
    m = re.match(r'^(\d+)_(.+)', stem)
    if m:
        num = m.group(1).lstrip('0') or '0'
        title = m.group(2).replace('_', ' ').title()
        # Corrections de casse pour les sigles médicaux
        title = re.sub(r'\bDt1\b', 'DT1', title)
        title = re.sub(r'\bDt2\b', 'DT2', title)
        title = re.sub(r'\bHta\b', 'HTA', title)
        title = re.sub(r'\bIoa\b', 'IOA', title)
        title = re.sub(r'\bPtg\b', 'PTG', title)
        title = re.sub(r'\bLca\b', 'LCA', title)
        title = re.sub(r'\bEos\b', 'EOS', title)
        title = re.sub(r'\bSia\b', 'SIA', title)
        title = re.sub(r'\bAmp\b', 'AMP', title)
        title = re.sub(r'\bFiv\b', 'FIV', title)
        return f"{num} — {title}"

    stem_clean = stem.replace('_', ' ').title()
    if 'CAS CLINIQUES' in stem_clean.upper():
        return f"Cas Cliniques — {formation_name}"
    if 'QUIZ' in stem_clean.upper():
        return f"Quiz — {formation_name}"
    return stem_clean


def extract_body_content(html_path: Path) -> str:
    """Extrait <style> + contenu <body> du fichier HTML."""
    content = html_path.read_text(encoding='utf-8', errors='replace')

    # Style
    style_m = re.search(r'<style>(.*?)</style>', content, re.DOTALL | re.IGNORECASE)
    style = f'<style>{style_m.group(1)}</style>\n' if style_m else ''

    # Body
    body_m = re.search(r'<body[^>]*>(.*?)</body>', content, re.DOTALL | re.IGNORECASE)
    body = body_m.group(1).strip() if body_m else content

    return style + body


def php_str(s: str) -> str:
    """Échappe une string pour PHP (guillemets simples)."""
    return s.replace('\\', '\\\\').replace("'", "\\'")


# ─────────────────────────────────────────────────────────────────────────────
#  GÉNÉRATION DU SCRIPT PHP
# ─────────────────────────────────────────────────────────────────────────────

def generate_php() -> str:
    lines = []

    # ── En-tête PHP
    lines.append(r"""#!/usr/bin/env php
<?php
/**
 * VERTEX© — Setup du cours "Documentation CDC" (admin uniquement)
 *
 * Ce script crée :
 *   1. La catégorie cachée "Documentation interne" (managers/admins seulement)
 *   2. Le cours unique "VERTEX© — Documentation CDC"
 *   3. Une section par formation avec toutes ses pages CDC
 *
 * Usage local  : docker exec moodle-local-moodle-1 php /var/www/html/setup_cdc_admin_course.php
 * Usage prod   : php /var/www/moodle/setup_cdc_admin_course.php
 *
 * @copyright 2026 VERTEX©
 */

define('CLI_SCRIPT', true);
$moodledir = dirname(__FILE__);
require_once($moodledir . '/config.php');
require_once($CFG->libdir . '/accesslib.php');
require_once($CFG->libdir . '/datalib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/mod/page/lib.php');

global $USER, $DB, $CFG;
$USER = $DB->get_record('user', ['id' => 2]);
\core\session\manager::set_user($USER);

echo "============================================================\n";
echo "  VERTEX© — Documentation CDC Admin\n";
echo "============================================================\n\n";

// ─── Fonctions utilitaires ────────────────────────────────────────────────

function create_or_get_category($name, $visible = 0, $description = '') {
    global $DB;
    $existing = $DB->get_record('course_categories', ['name' => $name]);
    if ($existing) {
        echo "  [OK] Catégorie existante : {$name} (id={$existing->id})\n";
        return $existing->id;
    }
    $cat = new stdClass();
    $cat->name        = $name;
    $cat->idnumber    = '';
    $cat->description = $description;
    $cat->visible     = $visible;
    $cat->parent      = 0;
    $cat->sortorder   = 999;
    $catid = $DB->insert_record('course_categories', $cat);
    // Reconstruire le path Moodle
    $DB->set_field('course_categories', 'path', "/{$catid}", ['id' => $catid]);
    fix_course_sortorder();
    echo "  [CRÉÉ] Catégorie : {$name} (id={$catid})\n";
    return $catid;
}

function create_or_get_course($shortname, $fullname, $catid) {
    global $DB;
    $existing = $DB->get_record('course', ['shortname' => $shortname]);
    if ($existing) {
        echo "  [OK] Cours existant : {$shortname} (id={$existing->id})\n";
        return $existing->id;
    }
    $course = new stdClass();
    $course->shortname  = $shortname;
    $course->fullname   = $fullname;
    $course->category   = $catid;
    $course->format     = 'topics';
    $course->visible    = 0;  // Caché par défaut, visible pour managers
    $course->numsections = 1;
    $course->startdate  = time();
    $course->summary    = 'Documentation interne — Cahiers des Charges des formations VERTEX©. Réservé aux gestionnaires de contenu.';
    $course->summaryformat = FORMAT_HTML;
    $created = create_course($course);
    echo "  [CRÉÉ] Cours : {$shortname} (id={$created->id})\n";
    return $created->id;
}

function get_or_create_section($courseid, $sectionnum, $sectionname) {
    global $DB;
    $section = $DB->get_record('course_sections', [
        'course'  => $courseid,
        'section' => $sectionnum,
    ]);
    if (!$section) {
        $section = new stdClass();
        $section->course        = $courseid;
        $section->section       = $sectionnum;
        $section->name          = $sectionname;
        $section->summary       = '';
        $section->summaryformat = FORMAT_HTML;
        $section->sequence      = '';
        $section->visible       = 1;
        $section->id = $DB->insert_record('course_sections', $section);
    } else {
        $DB->set_field('course_sections', 'name', $sectionname, ['id' => $section->id]);
    }
    return $section->id;
}

function add_page_to_section($courseid, $sectionid, $sectionnum, $title, $content) {
    global $DB, $CFG;

    // Créer le module "page"
    $page = new stdClass();
    $page->course         = $courseid;
    $page->name           = $title;
    $page->intro          = '';
    $page->introformat    = FORMAT_HTML;
    $page->content        = $content;
    $page->contentformat  = FORMAT_HTML;
    $page->timemodified   = time();
    $page->id = $DB->insert_record('page', $page);

    // Créer le course_module
    $cm = new stdClass();
    $cm->course     = $courseid;
    $cm->module     = $DB->get_field('modules', 'id', ['name' => 'page']);
    $cm->instance   = $page->id;
    $cm->section    = $sectionid;
    $cm->visible    = 1;
    $cm->completion = 0;
    $cm->added      = time();
    $cm->id = $DB->insert_record('course_modules', $cm);

    // Ajouter à la séquence de la section
    $seq = $DB->get_field('course_sections', 'sequence', ['id' => $sectionid]);
    $seq = $seq ? $seq . ',' . $cm->id : (string)$cm->id;
    $DB->set_field('course_sections', 'sequence', $seq, ['id' => $sectionid]);

    // Invalider le cache
    rebuild_course_cache($courseid, true);

    return $cm->id;
}

""")

    # ── Création catégorie + cours
    lines.append("""
// ═══════════════════════════════════════════════════════════════════
//  1. Catégorie cachée "Documentation interne"
// ═══════════════════════════════════════════════════════════════════
$catid = create_or_get_category(
    'Documentation interne',
    0,  // visible=0 : caché pour les étudiants, visible pour managers
    'CDC et documentation interne des formations VERTEX©'
);

// ═══════════════════════════════════════════════════════════════════
//  2. Cours "VERTEX© — Documentation CDC"
// ═══════════════════════════════════════════════════════════════════
$courseid = create_or_get_course(
    'VERTEX-CDC-ADMIN',
    'VERTEX© — Documentation CDC',
    $catid
);

echo "\\n";
""")

    # ── Sections par formation
    lines.append("// ═══════════════════════════════════════════════════════════════════\n")
    lines.append("//  3. Sections par formation\n")
    lines.append("// ═══════════════════════════════════════════════════════════════════\n")
    lines.append("$section_num = 1;\n\n")

    for form_key, form_name in FORMATIONS:
        form_dir = CDC_DIR / form_key
        if not form_dir.exists():
            print(f"  [SKIP] {form_key} — dossier introuvable")
            continue

        # Lister et trier les fichiers
        all_files = [f for f in sorted(form_dir.glob("*.html"))
                     if not should_exclude(f.name)]
        all_files.sort(key=lambda f: file_sort_key(f.name))

        if not all_files:
            print(f"  [SKIP] {form_key} — aucun fichier HTML")
            continue

        print(f"  {form_name} : {len(all_files)} fichiers")

        safe_name = php_str(form_name)
        lines.append(f"// ── {form_name} ──\n")
        lines.append(f"echo \"  📘 {form_name}...\\n\";\n")
        lines.append(f"$sid = get_or_create_section($courseid, $section_num, '{safe_name}');\n")
        lines.append(f"$section_num++;\n\n")

        for html_file in all_files:
            title = make_page_title(html_file.name, form_name)
            content = extract_body_content(html_file)

            # Nettoyer le contenu pour PHP
            content_escaped = php_str(content)

            safe_title = php_str(title)
            lines.append(f"add_page_to_section($courseid, $sid, $section_num - 1, '{safe_title}',\n")
            lines.append(f"  '{content_escaped}'\n")
            lines.append(f");\n")

        lines.append("\n")

    # ── Pied de page
    lines.append(r"""
// ═══════════════════════════════════════════════════════════════════
//  Finalisation
// ═══════════════════════════════════════════════════════════════════
rebuild_course_cache($courseid, true);

echo "\n============================================================\n";
echo "  ✅ Documentation CDC créée !\n";
echo "  Cours : VERTEX© — Documentation CDC\n";
echo "  URL   : {$CFG->wwwroot}/course/view.php?id={$courseid}\n";
echo "  ⚠️  Visible uniquement pour les managers/admins\n";
echo "============================================================\n";
""")

    lines.append("?>")

    return ''.join(lines)


# ─────────────────────────────────────────────────────────────────────────────
#  MAIN
# ─────────────────────────────────────────────────────────────────────────────

def main():
    print("=" * 60)
    print("  VERTEX© — Génération setup_cdc_admin_course.php")
    print("=" * 60)
    print()

    php_content = generate_php()
    OUTPUT_PHP.write_text(php_content, encoding='utf-8')

    size_kb = OUTPUT_PHP.stat().st_size // 1024
    print()
    print(f"  ✅ {OUTPUT_PHP.name} généré ({size_kb} Ko)")
    print()
    print("  Commande Docker :")
    print("  docker cp setup_cdc_admin_course.php moodle-local-moodle-1:/var/www/html/")
    print("  docker exec moodle-local-moodle-1 php /var/www/html/setup_cdc_admin_course.php")
    print()


if __name__ == "__main__":
    main()
