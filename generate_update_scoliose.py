#!/usr/bin/env python3
"""
Génère un script PHP qui met à jour le contenu des pages scoliose sur doctraining.ma.
Utilise les vrais modules (MODULE_*.md) pour remplacer le contenu existant.

Usage :
    python generate_update_scoliose.py
    → produit update_scoliose_pages.php à déposer sur le serveur et exécuter via SSH
"""

import base64
import sys
from pathlib import Path

try:
    import markdown
except ImportError:
    print("pip install markdown")
    sys.exit(1)

# Répertoires
ROOT = Path(__file__).parent
COURS_DIR = ROOT / "cours-scoliose"

# Mapping cmid → fichier MD
MODULES = [
    (121, "MODULE_01_ANATOMIE_RACHIS.md"),
    (122, "MODULE_02_EMBRYOLOGIE_CROISSANCE.md"),
    (123, "MODULE_03_BIOMECANIQUE.md"),
    (124, "MODULE_04_DEFINITIONS_EPIDEMIOLOGIE.md"),
    (125, "MODULE_05_CLASSIFICATION.md"),
    (126, "MODULE_06_EXAMEN_CLINIQUE.md"),
    (127, "MODULE_07_IMAGERIE.md"),
    (128, "MODULE_08_SIA.md"),
    (129, "MODULE_09_EOS_INFANTILE_JUVENILE.md"),
    (130, "MODULE_10_SCOLIOSE_ADULTE.md"),
    (131, "MODULE_11_SCOLIOSE_CONGENITALE.md"),
    (132, "MODULE_12_NEUROMUSCULAIRE.md"),
    (133, "MODULE_13_SYNDROMIQUE.md"),
    (134, "MODULE_14_CYPHOSE_SAGITTAL.md"),
    (135, "MODULE_15_INSTRUMENTATION.md"),
    (136, "MODULE_16_VOIES_ABORD.md"),
    (137, "MODULE_17_COMPLICATIONS.md"),
    (138, "MODULE_18_REEDUCATION.md"),
    (139, "MODULE_19_HERNIE_DISCALE.md"),
    (140, "MODULE_20_STENOSE_CANALAIRE.md"),
    (141, "MODULE_21_SPONDYLOLISTHESIS.md"),
    (142, "MODULE_22_INFECTIONS.md"),
    (143, "MODULE_23_TRAUMATISMES.md"),
    (144, "MODULE_24_TUMEURS.md"),
    (145, "MODULE_25_OSTEOPOROSE.md"),
    (171, "CAS_CLINIQUES_SCOLIOSE.md"),
]


def md_to_html(text: str) -> str:
    return markdown.markdown(
        text,
        extensions=["extra", "tables", "toc", "nl2br", "sane_lists"],
    )


def main():
    updates = []
    for cmid, filename in MODULES:
        filepath = COURS_DIR / filename
        if not filepath.exists():
            print(f"[MANQUANT] {filename}")
            continue
        text = filepath.read_text(encoding="utf-8")
        html = md_to_html(text)
        b64 = base64.b64encode(html.encode("utf-8")).decode("ascii")
        updates.append((cmid, filename, b64))
        print(f"[OK] cmid={cmid} — {filename} ({len(html)} chars)")

    # Générer le PHP
    php_lines = [
        "<?php",
        "/**",
        " * VERTEX© — Mise à jour des pages scoliose sur doctraining.ma",
        " * Généré automatiquement par generate_update_scoliose.py",
        " * Usage : php update_scoliose_pages.php",
        " * Exécuter depuis la racine Moodle : ~/sites/doctraining.ma/",
        " */",
        "",
        "define('CLI_SCRIPT', true);",
        "require(__DIR__ . '/config.php');",
        "",
        "$updates = [",
    ]

    for cmid, filename, b64 in updates:
        php_lines.append(f"    // {filename}")
        php_lines.append(f"    {cmid} => base64_decode('{b64}'),")

    php_lines += [
        "];",
        "",
        "$count = 0;",
        "$errors = 0;",
        "",
        "foreach ($updates as $cmid => $html_content) {",
        "    // Récupérer l'instance depuis course_modules",
        "    $cm = $DB->get_record('course_modules', ['id' => $cmid], 'id, instance, module');",
        "    if (!$cm) {",
        "        echo \"[ERREUR] cmid=$cmid introuvable\\n\";",
        "        $errors++;",
        "        continue;",
        "    }",
        "",
        "    // Mettre à jour mdl_page",
        "    $page = $DB->get_record('page', ['id' => $cm->instance]);",
        "    if (!$page) {",
        "        echo \"[ERREUR] page instance={$cm->instance} introuvable\\n\";",
        "        $errors++;",
        "        continue;",
        "    }",
        "",
        "    $page->content = $html_content;",
        "    $page->contentformat = FORMAT_HTML;",
        "    $page->timemodified = time();",
        "    $DB->update_record('page', $page);",
        "",
        "    // Invalider le cache",
        "    rebuild_course_cache($page->course, true);",
        "",
        "    echo \"[OK] cmid=$cmid — {$page->name}\\n\";",
        "    $count++;",
        "}",
        "",
        "echo \"\\n=== Terminé : $count pages mises à jour, $errors erreurs ===\\n\";",
    ]

    out_file = ROOT / "update_scoliose_pages.php"
    out_file.write_text("\n".join(php_lines), encoding="utf-8")
    print(f"\n[GÉNÉRÉ] {out_file}")
    print(f"  → {len(updates)} modules convertis")
    print(f"\nDéploiement :")
    print(f"  1. git add update_scoliose_pages.php && git commit -m 'feat: script update pages scoliose' && git push")
    print(f"  2. SSH Infomaniak → cd ~/sites/doctraining.ma/")
    print(f"  3. wget https://raw.githubusercontent.com/aryad2006/scoliose/main/update_scoliose_pages.php")
    print(f"  4. php update_scoliose_pages.php")
    print(f"  5. rm update_scoliose_pages.php")


if __name__ == "__main__":
    main()
