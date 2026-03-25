#!/usr/bin/env python3
"""
VERTEX© — Génère deploy_cours_diab_prod.php
Reconstruit le cours VERTEX-DIAB sur prod avec les 23 pages interactives
(COURS-DEFINITIF-DIABETOLOGIE/).

Usage : python3 generate_deploy_diabetologie.py
Output : deploy_cours_diab_prod.php
"""

import base64
from pathlib import Path

MOODLE_DIR   = Path(__file__).parent
COURS_DIR    = MOODLE_DIR / "cours_html" / "COURS-DEFINITIF-DIABETOLOGIE"
OUTPUT_PHP   = MOODLE_DIR / "deploy_cours_diab_prod.php"

# Structure Parties → fichiers (ordre exact de l'index.html)
SECTIONS = [
    ("Partie I — Fondamentaux",
     ["COURS_DIAB_01_P1.html", "COURS_DIAB_01_P2.html",
      "COURS_DIAB_01_P3.html", "COURS_DIAB_01_P4.html"]),

    ("Partie II — Physiopathologie",
     ["COURS_DIAB_02_P1.html", "COURS_DIAB_02_P2.html"]),

    ("Partie III — Diagnostic et dépistage",
     ["COURS_DIAB_03_P1.html", "COURS_DIAB_03_P2.html"]),

    ("Partie IV — Clinique et formes",
     ["COURS_DIAB_04_P1.html", "COURS_DIAB_04_P2.html"]),

    ("Partie V — Complications microvasculaires",
     ["COURS_DIAB_05_P1.html", "COURS_DIAB_05_P2.html"]),

    ("Partie VI — Complications macrovasculaires",
     ["COURS_DIAB_06_P1.html", "COURS_DIAB_06_P2.html"]),

    ("Partie VII — Traitement du DT1",
     ["COURS_DIAB_07_P1.html", "COURS_DIAB_07_P2.html"]),

    ("Partie VIII — Traitement du DT2",
     ["COURS_DIAB_08_P1.html", "COURS_DIAB_08_P2.html"]),

    ("Partie IX — Situations particulières",
     ["COURS_DIAB_09_P1.html", "COURS_DIAB_09_P2.html"]),

    ("Partie X — Innovations et recherche",
     ["COURS_DIAB_10_P1.html", "COURS_DIAB_10_P2.html"]),

    ("Partie XI — Organisation des soins et ETP",
     ["COURS_DIAB_11_P1.html"]),
]

def page_title(filename: str) -> str:
    """M01 P1, M02 P2... depuis le nom de fichier."""
    import re
    m = re.match(r'COURS_DIAB_(\d+)_P(\d+)\.html', filename)
    if m:
        mod = int(m.group(1))
        part = int(m.group(2))
        return f"M{mod:02d} — Partie {part}"
    return filename.replace('.html', '')

def b64(filepath: Path) -> str:
    return base64.b64encode(filepath.read_bytes()).decode('ascii')

def main():
    print("=" * 60)
    print("  VERTEX© — Génération deploy_cours_diab_prod.php")
    print("=" * 60)

    lines = []
    lines.append("""<?php
/**
 * VERTEX© — Déploiement cours interactif Diabétologie (prod)
 * Reconstruit le cours VERTEX-DIAB avec les 23 pages interactives VERTEX©.
 * Généré par generate_deploy_diabetologie.py
 *
 * Usage : cd ~/sites/doctraining.ma && php deploy_cours_diab_prod.php
 *
 * @copyright 2026 VERTEX©
 */
define('CLI_SCRIPT', true);
require_once(__DIR__ . '/config.php');
require_once($CFG->libdir  . '/accesslib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/mod/page/lib.php');

global $USER, $DB, $CFG;
$USER = $DB->get_record('user', ['username' => 'admin']);
\\core\\session\\manager::set_user($USER);

echo "=======================================================\\n";
echo "  VERTEX© — Cours interactif Diabétologie (prod)\\n";
echo "=======================================================\\n\\n";

// ── Trouver le cours par shortname ───────────────────────────────
$course = $DB->get_record('course', ['shortname' => 'VERTEX-DIAB'], '*', MUST_EXIST);
$courseid = $course->id;
echo "  Cours : {$course->fullname} (id={$courseid})\\n\\n";

// ── Nettoyer les sections existantes (garder section 0) ──────────
$sections = $DB->get_records_select('course_sections',
    'course = ? AND section > 0', [$courseid], 'section');
foreach ($sections as $sec) {
    // Supprimer les activités de la section
    $mods = explode(',', $sec->sequence ?: '');
    foreach (array_filter($mods) as $cmid) {
        if ($cm = $DB->get_record('course_modules', ['id' => $cmid])) {
            $DB->delete_records('page', ['id' => $cm->instance]);
            $DB->delete_records('course_modules', ['id' => $cmid]);
        }
    }
    $DB->delete_records('course_sections', ['id' => $sec->id]);
}
echo "  Sections nettoyées.\\n";

// ── Fonctions ────────────────────────────────────────────────────
function add_section($courseid, $num, $name) {
    global $DB;
    $s = new stdClass();
    $s->course        = $courseid;
    $s->section       = $num;
    $s->name          = $name;
    $s->summary       = '';
    $s->summaryformat = FORMAT_HTML;
    $s->sequence      = '';
    $s->visible       = 1;
    $s->timemodified  = time();
    $s->id = $DB->insert_record('course_sections', $s);
    return $s->id;
}

function add_page($courseid, $sid, $title, $html_b64) {
    global $DB;
    $content = base64_decode($html_b64);

    $page = new stdClass();
    $page->course          = $courseid;
    $page->name            = $title;
    $page->intro           = '';
    $page->introformat     = FORMAT_HTML;
    $page->content         = $content;
    $page->contentformat   = FORMAT_HTML;
    $page->legacyfiles     = 0;
    $page->legacyfileslast = null;
    $page->display         = 0;
    $page->displayoptions  = '';
    $page->revision        = 0;
    $page->timemodified    = time();
    $page->id = $DB->insert_record('page', $page);

    $cm = new stdClass();
    $cm->course               = $courseid;
    $cm->module               = $DB->get_field('modules', 'id', ['name' => 'page']);
    $cm->instance             = $page->id;
    $cm->section              = $sid;
    $cm->visible              = 1;
    $cm->visibleold           = 1;
    $cm->groupmode            = 0;
    $cm->groupingid           = 0;
    $cm->completion           = 0;
    $cm->completiongradeitemnumber = null;
    $cm->completionview       = 0;
    $cm->completionexpected   = 0;
    $cm->showdescription      = 0;
    $cm->deletioninprogress   = 0;
    $cm->added                = time();
    $cm->score                = 0;
    $cm->indent               = 0;
    $cm->id = $DB->insert_record('course_modules', $cm);

    $seq = $DB->get_field('course_sections', 'sequence', ['id' => $sid]);
    $seq = $seq ? $seq . ',' . $cm->id : (string)$cm->id;
    $DB->set_field('course_sections', 'sequence', $seq, ['id' => $sid]);
    return $cm->id;
}

// ── Numsections (Moodle 4.x → course_format_options) ─────────────
$fopt = $DB->get_record('course_format_options', [
    'courseid'  => $courseid,
    'format'    => 'topics',
    'sectionid' => 0,
    'name'      => 'numsections',
]);
if ($fopt) {
    $DB->set_field('course_format_options', 'value', 11, ['id' => $fopt->id]);
} else {
    $opt = new stdClass();
    $opt->courseid  = $courseid;
    $opt->format    = 'topics';
    $opt->sectionid = 0;
    $opt->name      = 'numsections';
    $opt->value     = 11;
    $DB->insert_record('course_format_options', $opt);
}

// ── Sections et pages ────────────────────────────────────────────
""")

    total = 0
    for sec_idx, (sec_name, files) in enumerate(SECTIONS, start=1):
        print(f"  Section {sec_idx}: {sec_name} ({len(files)} fichiers)")
        safe_name = sec_name.replace("'", "\\'")
        lines.append(f"echo \"  📘 {sec_name}...\\n\";\n")
        lines.append(f"$sid = add_section($courseid, {sec_idx}, '{safe_name}');\n")

        for fname in files:
            fpath = COURS_DIR / fname
            if not fpath.exists():
                print(f"    ⚠️  Manquant : {fname}")
                continue
            title = page_title(fname)
            b64_content = b64(fpath)
            safe_title = title.replace("'", "\\'")
            lines.append(f"add_page($courseid, $sid, '{safe_title}', '{b64_content}');\n")
            total += 1

        lines.append("\n")

    lines.append(f"""
rebuild_course_cache($courseid, true);

echo "\\n=======================================================\\n";
echo "  ✅ {total} pages déployées — Diabétologie\\n";
echo "  URL : {{$CFG->wwwroot}}/course/view.php?id={{$courseid}}\\n";
echo "=======================================================\\n";
?>""")

    OUTPUT_PHP.write_text(''.join(lines), encoding='utf-8')
    size_kb = OUTPUT_PHP.stat().st_size // 1024
    print(f"\n  ✅ {OUTPUT_PHP.name} généré ({size_kb} Ko, {total} pages)")

if __name__ == "__main__":
    main()
