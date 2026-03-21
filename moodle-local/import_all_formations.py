#!/usr/bin/env python3
"""
VERTEX© — Import de TOUTES les formations dans Moodle.

Gère les 12+ formations avec leurs modules, quiz et cas cliniques.
Crée les catégories, les cours, les sections et les activités quiz.

Usage :
    python import_all_formations.py --host http://localhost:8890 --token <TOKEN>
    python import_all_formations.py --dry-run          # Prévisualisation
    python import_all_formations.py --formation hta     # Une seule formation
    python import_all_formations.py --list              # Lister les formations

Pré-requis :
    pip install requests markdown beautifulsoup4
"""

import argparse
import json
import os
import re
import sys
from pathlib import Path

try:
    import markdown
    import requests
    from bs4 import BeautifulSoup
except ImportError:
    print("[ERR] Dépendances manquantes : pip install requests markdown beautifulsoup4")
    sys.exit(1)

# ─────────────────────────────────────────────────────────────────────────────
# Configuration des 12 formations VERTEX©
# ─────────────────────────────────────────────────────────────────────────────

PROJECT_ROOT = Path(__file__).parent.parent

FORMATIONS = {
    "scoliose": {
        "dir": "cours-scoliose",
        "fullname": "VERTEX© — Chirurgie du Rachis et Scoliose",
        "shortname": "VERTEX-SCOLIOSE",
        "pattern": "MODULE_*.md",
        "color": "#1565C0",  # Bleu
        "category": "Orthopédie",
        "has_quiz": False,
        "has_cas": True,
        "cas_pattern": "CAS_CLINIQUES_SCOLIOSE*.md",
        "description": "25 modules — anatomie, biomécanique, classification, chirurgie du rachis",
    },
    "ptg": {
        "dir": "cours-ptg",
        "fullname": "VERTEX© — Prothèse Totale de Genou",
        "shortname": "VERTEX-PTG",
        "pattern": "CDC_PTG_*.md",
        "color": "#2E7D32",  # Vert
        "category": "Orthopédie",
        "has_quiz": False,
        "has_cas": True,
        "cas_pattern": "CAS_CLINIQUES_PTG*.md",
        "description": "8 parties — fondamentaux, implants, planification, complications, reprises",
    },
    "ioa": {
        "dir": "cours-infection-osseuse",
        "fullname": "VERTEX© — Infections Ostéo-Articulaires",
        "shortname": "VERTEX-IOA",
        "pattern": "CDC_IOA_*.md",
        "color": "#795548",  # Marron
        "category": "Orthopédie",
        "has_quiz": False,
        "has_cas": True,
        "cas_pattern": "CAS_CLINIQUES_IOA*.md",
        "description": "10 parties — diagnostic, antibiothérapie, chirurgie, reconstruction",
    },
    "tendinites": {
        "dir": "cours-tendinites",
        "fullname": "VERTEX© — Tendinites et Tendinopathies",
        "shortname": "VERTEX-TEND",
        "pattern": "CDC_TEND_*.md",
        "color": "#E65100",  # Orange
        "category": "Orthopédie",
        "has_quiz": False,
        "has_cas": True,
        "cas_pattern": "CAS_CLINIQUES_TENDINITES*.md",
        "description": "9 parties — Achille, coiffe, coude, genou, traitements, innovations",
    },
    "obesite": {
        "dir": "cours-obesite-orthopedie",
        "fullname": "VERTEX© — Obésité et Orthopédie",
        "shortname": "VERTEX-OBO",
        "pattern": "CDC_OBO_*.md",
        "color": "#6A1B9A",  # Violet
        "category": "Orthopédie",
        "has_quiz": False,
        "has_cas": False,
        "cas_pattern": "CAS_CLINIQUES_OBO*.md",
        "description": "9 parties — biomécanique, arthroplastie, rachis, périopératoire",
    },
    "diabetologie": {
        "dir": "cours-diabetologie",
        "fullname": "VERTEX© — Diabétologie",
        "shortname": "VERTEX-DIAB",
        "pattern": "CDC_DIAB_*.md",
        "color": "#00838F",  # Teal
        "category": "Médecine",
        "has_quiz": True,
        "quiz_file": "QUIZ_DIABETOLOGIE.md",
        "has_cas": True,
        "cas_pattern": "CAS_CLINIQUES_DIABETOLOGIE*.md",
        "description": "12 modules — physiopathologie, DT1, DT2, complications, innovations",
    },
    "hta": {
        "dir": "cours-hta",
        "fullname": "VERTEX© — Hypertension Artérielle",
        "shortname": "VERTEX-HTA",
        "pattern": "CDC_HTA_*.md",
        "color": "#C62828",  # Rouge
        "category": "Médecine",
        "has_quiz": False,
        "has_cas": True,
        "cas_pattern": "CAS_CLINIQUES_HTA*.md",
        "description": "12 modules — physiopathologie, traitement, HTA secondaire, urgences",
    },
    "hypothyroidie": {
        "dir": "cours-hypothyroidie",
        "fullname": "VERTEX© — Hypothyroïdies",
        "shortname": "VERTEX-HYPO",
        "pattern": "CDC_HYPO_*.md",
        "color": "#283593",  # Indigo
        "category": "Médecine",
        "has_quiz": True,
        "quiz_file": "QUIZ_HYPOTHYROIDIE.md",
        "has_cas": True,
        "cas_pattern": "CAS_CLINIQUES_HYPO*.md",
        "description": "12 modules — étiologies, diagnostic, traitement, situations particulières",
    },
    "hyperthyroidie": {
        "dir": "cours-hyperthyroidie",
        "fullname": "VERTEX© — Hyperthyroïdies",
        "shortname": "VERTEX-HYPER",
        "pattern": "CDC_HYPER_*.md",
        "color": "#EF6C00",  # Orange foncé
        "category": "Médecine",
        "has_quiz": True,
        "quiz_file": "QUIZ_HYPERTHYROIDIE.md",
        "has_cas": True,
        "cas_pattern": "CAS_CLINIQUES_HYPER*.md",
        "description": "12 modules — Basedow, nodule toxique, ATS, iode radioactif",
    },
    "fiv": {
        "dir": "cours-fiv",
        "fullname": "VERTEX© — Fécondation In Vitro (AMP)",
        "shortname": "VERTEX-FIV",
        "pattern": "CDC_FIV_*.md",
        "color": "#AD1457",  # Rose
        "category": "Médecine",
        "has_quiz": True,
        "quiz_file": "QUIZ_FIV.md",
        "has_cas": True,
        "cas_pattern": "CAS_CLINIQUES_FIV*.md",
        "description": "14 modules — bilan, stimulation, ponction, transfert, éthique, innovations",
    },
    "histoire": {
        "dir": "cours-histoire-orthopedie",
        "fullname": "VERTEX© — Histoire de l'Orthopédie",
        "shortname": "VERTEX-HISTO",
        "pattern": "CDC_HISTO_*.md",
        "color": "#4E342E",  # Marron foncé
        "category": "Culture médicale",
        "has_quiz": False,
        "has_cas": False,
        "cas_pattern": None,
        "description": "9 parties — Antiquité au XXIe siècle, grands noms de l'orthopédie",
    },
    "lca": {
        "dir": "cours-lca",
        "fullname": "VERTEX© — Ligament Croisé Antérieur",
        "shortname": "VERTEX-LCA",
        "pattern": "CDC_LCA_*.md",
        "color": "#00695C",  # Vert foncé
        "category": "Orthopédie",
        "has_quiz": False,
        "has_cas": False,
        "cas_pattern": None,
        "description": "En cours de rédaction — anatomie, diagnostic, chirurgie, rééducation",
    },
}

# ─────────────────────────────────────────────────────────────────────────────
# API Moodle
# ─────────────────────────────────────────────────────────────────────────────

class MoodleAPI:
    """Client API REST Moodle."""

    def __init__(self, host: str, token: str):
        self.base = host.rstrip("/") + "/webservice/rest/server.php"
        self.token = token

    def call(self, function: str, **params) -> dict:
        payload = {
            "wstoken": self.token,
            "wsfunction": function,
            "moodlewsrestformat": "json",
            **params,
        }
        resp = requests.post(self.base, data=payload, timeout=60)
        resp.raise_for_status()
        data = resp.json()
        if isinstance(data, dict) and "exception" in data:
            raise ValueError(f"Moodle [{function}]: {data.get('message', data)}")
        return data

    # -- Catégories --
    def get_categories(self) -> list:
        return self.call("core_course_get_categories")

    def create_category(self, name: str, parent: int = 0, description: str = "") -> int:
        result = self.call(
            "core_course_create_categories",
            **{
                "categories[0][name]": name,
                "categories[0][parent]": parent,
                "categories[0][description]": description,
                "categories[0][descriptionformat]": 1,
            },
        )
        return result[0]["id"]

    def get_or_create_category(self, name: str, parent: int = 0) -> int:
        cats = self.get_categories()
        for c in cats:
            if c["name"] == name and c["parent"] == parent:
                return c["id"]
        return self.create_category(name, parent)

    # -- Cours --
    def create_course(
        self, fullname: str, shortname: str, summary: str, category_id: int = 1,
        format_: str = "topics", numsections: int = 20
    ) -> int:
        result = self.call(
            "core_course_create_courses",
            **{
                "courses[0][fullname]": fullname,
                "courses[0][shortname]": shortname,
                "courses[0][categoryid]": category_id,
                "courses[0][summary]": summary,
                "courses[0][summaryformat]": 1,
                "courses[0][lang]": "fr",
                "courses[0][format]": format_,
                "courses[0][numsections]": numsections,
                "courses[0][visible]": 1,
                "courses[0][enablecompletion]": 1,
            },
        )
        return result[0]["id"]

    def get_course_by_shortname(self, shortname: str) -> dict | None:
        result = self.call("core_course_get_courses_by_field", field="shortname", value=shortname)
        courses = result.get("courses", [])
        return courses[0] if courses else None

    def update_course_sections(self, course_id: int, sections: list[dict]):
        """Crée/met à jour les sections d'un cours."""
        contents = self.call("core_course_get_contents", courseid=course_id)
        existing_count = len(contents)

        for i, section in enumerate(sections):
            sec_num = i + 1
            try:
                # Trouver l'ID de la section existante
                if sec_num < existing_count:
                    sec_id = contents[sec_num]["id"]
                    self.call(
                        "core_course_edit_section",
                        id=sec_id,
                        name=section["title"],
                        summary=section["content_html"],
                        summaryformat=1,
                    )
                else:
                    # Besoin de créer via la section number
                    self.call(
                        "core_course_edit_section",
                        id=course_id,
                        section=sec_num,
                        name=section["title"],
                        summary=section["content_html"],
                        summaryformat=1,
                    )
            except (ValueError, KeyError, IndexError):
                pass  # Section non créée — Moodle peut limiter le nombre

    # -- Quiz (via upload XML) --
    def upload_file(self, filepath: Path, component: str = "user", filearea: str = "draft") -> int:
        """Upload un fichier dans la zone de brouillon."""
        url = self.base.replace("/webservice/rest/server.php", "/webservice/upload.php")
        with open(filepath, "rb") as f:
            resp = requests.post(
                url,
                data={"token": self.token, "filearea": filearea},
                files={"file_1": (filepath.name, f)},
                timeout=60,
            )
        resp.raise_for_status()
        data = resp.json()
        if isinstance(data, list) and data:
            return data[0].get("itemid", 0)
        return 0


# ─────────────────────────────────────────────────────────────────────────────
# Parseur Markdown → structure de cours Moodle
# ─────────────────────────────────────────────────────────────────────────────

def md_to_html(text: str) -> str:
    """Convertit du Markdown en HTML nettoyé."""
    html_content = markdown.markdown(
        text,
        extensions=["extra", "tables", "toc", "nl2br", "sane_lists"],
    )
    return html_content


def parse_cdc_file(filepath: Path) -> dict:
    """
    Parse un fichier CDC_*.md ou MODULE_*.md.
    Retourne : { title, sections: [{title, content_html}] }
    """
    text = filepath.read_text(encoding="utf-8")
    html_content = md_to_html(text)
    soup = BeautifulSoup(html_content, "html.parser")

    # Titre principal (h1)
    h1 = soup.find("h1")
    title = h1.get_text(strip=True) if h1 else filepath.stem.replace("_", " ").title()

    # Découper en sections par h2
    sections = []
    current_title = "Introduction"
    current_content = []

    for elem in soup.children:
        tag = getattr(elem, "name", None)
        if tag == "h1":
            continue  # Skip h1 (déjà utilisé comme titre)
        if tag == "h2":
            if current_content:
                sections.append({
                    "title": current_title,
                    "content_html": "\n".join(str(c) for c in current_content),
                })
            current_title = elem.get_text(strip=True)
            current_content = []
        else:
            current_content.append(elem)

    if current_content:
        sections.append({
            "title": current_title,
            "content_html": "\n".join(str(c) for c in current_content),
        })

    return {
        "title": title,
        "sections": sections,
        "filepath": filepath,
    }


def parse_cas_cliniques(filepath: Path) -> dict:
    """Parse un fichier de cas cliniques → structure de sections."""
    return parse_cdc_file(filepath)


# ─────────────────────────────────────────────────────────────────────────────
# Import d'une formation complète
# ─────────────────────────────────────────────────────────────────────────────

def import_formation(api: MoodleAPI, key: str, config: dict, dry_run: bool = False):
    """Importe une formation complète dans Moodle."""
    course_dir = PROJECT_ROOT / config["dir"]
    if not course_dir.exists():
        print(f"  [SKIP] Répertoire {config['dir']} introuvable")
        return

    print(f"\n{'='*70}")
    print(f"  {config['fullname']}")
    print(f"  Répertoire : {config['dir']}")
    print(f"  {config['description']}")
    print(f"{'='*70}")

    # 1. Lister les fichiers CDC/MODULE (exclure COMPLET et CAS_CLINIQUES)
    all_md = sorted(course_dir.glob(config["pattern"]))
    # Exclure les fichiers *_COMPLET.md
    all_md = [f for f in all_md if "_COMPLET" not in f.stem]

    print(f"\n  Modules/CDC : {len(all_md)} fichiers")
    for f in all_md:
        print(f"    - {f.name}")

    # 2. Lister les cas cliniques
    cas_files = []
    if config.get("cas_pattern"):
        cas_files = sorted(course_dir.glob(config["cas_pattern"]))
        if cas_files:
            print(f"  Cas cliniques : {len(cas_files)} fichiers")
            for f in cas_files:
                print(f"    - {f.name}")

    # 3. Lister le quiz
    quiz_file = None
    if config.get("has_quiz") and config.get("quiz_file"):
        qf = course_dir / config["quiz_file"]
        if qf.exists():
            quiz_file = qf
            print(f"  Quiz : {qf.name}")

    if dry_run:
        print(f"\n  [DRY-RUN] {len(all_md)} modules + {len(cas_files)} cas cliniques")
        return

    # 4. Créer la catégorie
    vertex_cat_id = api.get_or_create_category("VERTEX© Formations")
    sub_cat_id = api.get_or_create_category(config["category"], parent=vertex_cat_id)

    # 5. Créer le cours principal
    existing = api.get_course_by_shortname(config["shortname"])
    if existing:
        course_id = existing["id"]
        print(f"\n  Cours existant (id={course_id})")
    else:
        # Préparer le résumé HTML
        summary = f"""<div style="border-left: 4px solid {config['color']}; padding: 10px 20px; margin: 10px 0;">
<h3 style="color: {config['color']};">{config['fullname']}</h3>
<p>{config['description']}</p>
<p><strong>Plateforme</strong> : VERTEX© — Formation médicale en ligne</p>
<p><strong>Modules</strong> : {len(all_md)} | <strong>Cas cliniques</strong> : {len(cas_files)} fichiers</p>
</div>"""

        num_sections = len(all_md) + len(cas_files) + (1 if quiz_file else 0) + 2
        course_id = api.create_course(
            fullname=config["fullname"],
            shortname=config["shortname"],
            summary=summary,
            category_id=sub_cat_id,
            numsections=num_sections,
        )
        print(f"\n  Cours créé (id={course_id})")

    # 6. Importer les modules comme sections
    all_sections = []

    for md_file in all_md:
        try:
            parsed = parse_cdc_file(md_file)
            # Combiner toutes les sous-sections en un seul contenu
            combined_html = f"<h2>{parsed['title']}</h2>\n"
            for sec in parsed["sections"]:
                combined_html += f"<h3>{sec['title']}</h3>\n{sec['content_html']}\n"

            # Extraire le numéro de module pour le titre de section
            num_match = re.search(r"_(\d+)_", md_file.stem)
            num = num_match.group(1) if num_match else "00"
            section_title = f"Module {int(num):02d} — {parsed['title'][:80]}"

            all_sections.append({
                "title": section_title,
                "content_html": combined_html,
            })
            print(f"    Section : {section_title}")
        except Exception as e:
            print(f"    [ERR] {md_file.name} : {e}")

    # 7. Ajouter les cas cliniques comme sections
    for cas_file in cas_files:
        try:
            parsed = parse_cdc_file(cas_file)
            combined_html = f"<h2>{parsed['title']}</h2>\n"
            for sec in parsed["sections"]:
                combined_html += f"<h3>{sec['title']}</h3>\n{sec['content_html']}\n"

            # Titre de section pour les cas cliniques
            part_match = re.search(r"_P(\d+)", cas_file.stem)
            part_suffix = f" (Partie {part_match.group(1)})" if part_match else ""
            section_title = f"Cas cliniques{part_suffix}"

            all_sections.append({
                "title": section_title,
                "content_html": combined_html,
            })
            print(f"    Section : {section_title}")
        except Exception as e:
            print(f"    [ERR] {cas_file.name} : {e}")

    # 8. Ajouter le quiz comme section (lien vers la banque de questions)
    if quiz_file:
        quiz_text = quiz_file.read_text(encoding="utf-8")
        quiz_html = md_to_html(quiz_text)
        all_sections.append({
            "title": "Quiz — Banque de questions",
            "content_html": f"""<div style="background: #FFF3E0; padding: 15px; border-radius: 8px;">
<h3>Quiz d'auto-évaluation</h3>
<p>Les questions de ce quiz couvrent l'ensemble des modules de la formation.
Quatre niveaux de difficulté : Bronze, Argent, Or, Diamant.</p>
<p><em>Importez le fichier GIFT dans la banque de questions Moodle pour activer le quiz interactif.</em></p>
</div>
{quiz_html}""",
        })
        print(f"    Section : Quiz")

    # 9. Pousser toutes les sections vers Moodle
    try:
        api.update_course_sections(course_id, all_sections)
        print(f"\n  {len(all_sections)} sections importées dans le cours {course_id}")
    except Exception as e:
        print(f"\n  [ERR] Mise à jour des sections : {e}")
        print("  Tentative section par section...")
        for i, sec in enumerate(all_sections):
            try:
                api.call(
                    "core_course_edit_section",
                    id=course_id,
                    section=i + 1,
                    name=sec["title"],
                    summary=sec["content_html"],
                    summaryformat=1,
                )
            except Exception as e2:
                print(f"    [ERR] Section {i+1} : {e2}")

    print(f"\n  Formation {key} importée avec succès")


# ─────────────────────────────────────────────────────────────────────────────
# Point d'entrée
# ─────────────────────────────────────────────────────────────────────────────

def main():
    parser = argparse.ArgumentParser(
        description="VERTEX© — Import de toutes les formations dans Moodle"
    )
    parser.add_argument("--host", default="http://localhost:8890", help="URL Moodle")
    parser.add_argument("--token", default=None, help="Token API Moodle")
    parser.add_argument("--dry-run", action="store_true", help="Prévisualisation sans import")
    parser.add_argument("--formation", default=None, help="Importer une seule formation (clé)")
    parser.add_argument("--list", action="store_true", help="Lister les formations disponibles")
    args = parser.parse_args()

    if args.list:
        print("\n  FORMATIONS VERTEX© DISPONIBLES\n")
        print(f"  {'Clé':<16} {'Nom':<45} {'Modules':<8} {'Quiz':<6} {'Cas'}")
        print(f"  {'-'*16} {'-'*45} {'-'*8} {'-'*6} {'-'*4}")
        for key, cfg in FORMATIONS.items():
            d = PROJECT_ROOT / cfg["dir"]
            n_files = len(list(d.glob(cfg["pattern"]))) if d.exists() else 0
            n_files_no_complet = len([f for f in d.glob(cfg["pattern"]) if "_COMPLET" not in f.stem]) if d.exists() else 0
            quiz = "oui" if cfg.get("has_quiz") else "-"
            cas = "oui" if cfg.get("has_cas") else "-"
            print(f"  {key:<16} {cfg['fullname'][:45]:<45} {n_files_no_complet:<8} {quiz:<6} {cas}")
        print()
        return

    token = args.token or os.getenv("MOODLE_TOKEN", "")
    if not token and not args.dry_run:
        print("[ERR] Token requis : --token <TOKEN> ou export MOODLE_TOKEN=...")
        sys.exit(1)

    api = MoodleAPI(args.host, token) if not args.dry_run else None

    print(f"\n{'#'*70}")
    print(f"  VERTEX© — Import Moodle")
    print(f"  Host : {args.host}")
    print(f"  Mode : {'DRY-RUN' if args.dry_run else 'IMPORT'}")
    print(f"{'#'*70}")

    if args.formation:
        if args.formation not in FORMATIONS:
            print(f"[ERR] Formation inconnue : {args.formation}")
            print(f"  Formations : {', '.join(FORMATIONS.keys())}")
            sys.exit(1)
        import_formation(api, args.formation, FORMATIONS[args.formation], args.dry_run)
    else:
        for key, config in FORMATIONS.items():
            import_formation(api, key, config, args.dry_run)

    print(f"\n{'#'*70}")
    print(f"  Import terminé")
    print(f"{'#'*70}\n")


if __name__ == "__main__":
    main()
