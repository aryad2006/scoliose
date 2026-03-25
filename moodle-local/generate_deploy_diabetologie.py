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
    ("Partie I \u2014 Fondamentaux",
     ["COURS_DIAB_01_P1.html", "COURS_DIAB_01_P2.html",
      "COURS_DIAB_01_P3.html", "COURS_DIAB_01_P4.html"]),

    ("Partie II \u2014 Physiopathologie",
     ["COURS_DIAB_02_P1.html", "COURS_DIAB_02_P2.html"]),

    ("Partie III \u2014 Diagnostic et d\u00e9pistage",
     ["COURS_DIAB_03_P1.html", "COURS_DIAB_03_P2.html"]),

    ("Partie IV \u2014 Clinique et formes",
     ["COURS_DIAB_04_P1.html", "COURS_DIAB_04_P2.html"]),

    ("Partie V \u2014 Complications microvasculaires",
     ["COURS_DIAB_05_P1.html", "COURS_DIAB_05_P2.html"]),

    ("Partie VI \u2014 Complications macrovasculaires",
     ["COURS_DIAB_06_P1.html", "COURS_DIAB_06_P2.html"]),

    ("Partie VII \u2014 Traitement du DT1",
     ["COURS_DIAB_07_P1.html", "COURS_DIAB_07_P2.html"]),

    ("Partie VIII \u2014 Traitement du DT2",
     ["COURS_DIAB_08_P1.html", "COURS_DIAB_08_P2.html"]),

    ("Partie IX \u2014 Situations particuli\u00e8res",
     ["COURS_DIAB_09_P1.html", "COURS_DIAB_09_P2.html"]),

    ("Partie X \u2014 Innovations et recherche",
     ["COURS_DIAB_10_P1.html", "COURS_DIAB_10_P2.html"]),

    ("Partie XI \u2014 Organisation des soins et ETP",
     ["COURS_DIAB_11_P1.html"]),
]

def page_title(filename):
    import re
    m = re.match(r'COURS_DIAB_(\d+)_P(\d+)\.html', filename)
    if m:
        mod  = int(m.group(1))
        part = int(m.group(2))
        return f"M{mod:02d} \u2014 Partie {part}"
    return filename.replace('.html', '')

def b64(filepath):
    return base64.b64encode(filepath.read_bytes()).decode('ascii')

def main():
    print("=" * 60)
    print("  VERTEX\u00a9 \u2014 G\u00e9n\u00e9ration deploy_cours_diab_prod.php")
    print("=" * 60)

    php_header = r"""<?php
/**
 * VERTEX© — Déploiement cours interactif Diabétologie (prod)
 * Reconstruit VERTEX-DIAB avec 23 pages interactives VERTEX©.
 * Généré par generate_deploy_diabetologie.py
 *
 * Usage : cd ~/sites/doctraining.ma && php deploy_cours_diab_prod.php
 */
define('CLI_SCRIPT', true);
require_once(__DIR__ . '/config.php');
require_once($CFG->libdir  . '/accesslib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/mod/page/lib.php');
require_once($CFG->dirroot . '/lib/modinfolib.php');

global $USER, $DB, $CFG;
$USER = $DB->get_record('user', ['username' => 'admin']);
\core\session\manager::set_user($USER);

echo "=======================================================\n";
echo "  VERTEX© — Cours interactif Diabétologie (prod)\n";
echo "=======================================================\n\n";

// ── Trouver le cours ──────────────────────────────────────────────
$course = $DB->get_record('course', ['shortname' => 'VERTEX-DIAB'], '*', MUST_EXIST);
$courseid = $course->id;
echo "  Cours : {$course->fullname} (id={$courseid})\n\n";

// ── Nettoyer sections et activités existantes ────────────────────
$sections = $DB->get_records_select('course_sections',
    'course = ? AND section > 0', [$courseid]);
foreach ($sections as $sec) {
    foreach (array_filter(explode(',', $sec->sequence ?? '')) as $cmid) {
        if ($cm = $DB->get_record('course_modules', ['id' => (int)$cmid])) {
            $DB->delete_records('page', ['id' => $cm->instance]);
            $DB->delete_records('course_modules', ['id' => $cm->id]);
        }
    }
    $DB->delete_records('course_sections', ['id' => $sec->id]);
}
rebuild_course_cache($courseid, true);
echo "  Sections nettoyees.\n";

// ── Fonctions (API Moodle native) ────────────────────────────────

function vertex_add_section($courseid, $num, $name) {
    global $DB;
    $section = course_create_section($courseid, $num);
    $DB->set_field('course_sections', 'name',    $name, ['id' => $section->id]);
    $DB->set_field('course_sections', 'visible', 1,     ['id' => $section->id]);
    return $section->id;
}

function vertex_add_page($courseid, $sectionnum, $title, $html_b64) {
    global $DB, $CFG;
    $content = base64_decode($html_b64);
    $courseobj = get_course($courseid);

    $data = new stdClass();
    $data->modulename    = 'page';
    $data->course        = $courseid;
    $data->section       = $sectionnum;
    $data->visible       = 1;
    $data->name          = $title;
    $data->intro         = '';
    $data->introformat   = FORMAT_HTML;
    $data->content       = $content;
    $data->contentformat = FORMAT_HTML;
    $data->display       = 0;

    $cm = add_moduleinfo($data, $courseobj);
    return $cm->id;
}

// ── Sections et pages ────────────────────────────────────────────
"""

    lines = [php_header]
    total = 0

    for sec_idx, (sec_name, files) in enumerate(SECTIONS, start=1):
        print(f"  Section {sec_idx}: {sec_name} ({len(files)} fichiers)")
        # Echapper les guillemets simples pour PHP
        safe_name = sec_name.replace("'", "\\'")
        lines.append(f"echo \"  {sec_name}...\\n\";\n")
        lines.append(f"$sid = vertex_add_section($courseid, {sec_idx}, '{safe_name}');\n")

        for fname in files:
            fpath = COURS_DIR / fname
            if not fpath.exists():
                print(f"    Manquant : {fname}")
                continue
            title     = page_title(fname)
            b64_str   = b64(fpath)
            safe_title = title.replace("'", "\\'")
            lines.append(
                f"vertex_add_page($courseid, {sec_idx}, '{safe_title}', '{b64_str}');\n"
            )
            total += 1

        lines.append("\n")

    lines.append(f"""
rebuild_course_cache($courseid, true);

echo "\\n=======================================================\\n";
echo "  {total} pages deployees - Diabetologie\\n";
echo "  URL : {{$CFG->wwwroot}}/course/view.php?id={{$courseid}}\\n";
echo "=======================================================\\n";
?>""")

    OUTPUT_PHP.write_text(''.join(lines), encoding='utf-8')
    size_kb = OUTPUT_PHP.stat().st_size // 1024
    print(f"\n  OK : {OUTPUT_PHP.name} ({size_kb} Ko, {total} pages)")

if __name__ == "__main__":
    main()
