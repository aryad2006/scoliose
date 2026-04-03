"""
VERTEX© — Import des cours Moodle depuis les fichiers Markdown sources.

Workflow :
  1. Lit les fichiers cours/MODULE_*.md et les convertit en HTML (markdown)
  2. Crée les cours dans Moodle via l'API REST Web Services
  3. Crée les sections de cours avec le contenu
  4. Ajoute une activité VERTEX dans chaque module (simulation)

Usage :
    python import_courses.py [--host http://localhost:8890] [--token <token>]

Pré-requis Moodle :
    Site Admin → Plugins → Web Services → External services → activer
    Token stocké dans la variable d'env ou passé en argument.

    pip install requests markdown beautifulsoup4 python-dotenv
"""

import argparse
import json
import re
import sys
from pathlib import Path

try:
    import markdown
    import requests
    from bs4 import BeautifulSoup
except ImportError:
    print("[ERR] Dépendances manquantes. Lancez : pip install requests markdown beautifulsoup4")
    sys.exit(1)

# ─────────────────────────────────────────────────────────────────────────────
# Configuration
# ─────────────────────────────────────────────────────────────────────────────

PARENT_COURSE_CATEGORY = 1   # ID catégorie Moodle par défaut
VERTEX_APP_URL         = "http://localhost:5173"  # URL simulateur VERTEX

MODULES_DIR = Path(__file__).parent.parent / "cours"

# Mapping module → template de rachis VERTEX
SPINE_TEMPLATES = {
    "MODULE_01": "scoliosis_t8_l2",
    "MODULE_02": "scoliosis_t4_t12",
    "MODULE_03": "double_major",
    "MODULE_04": "adult_deformity",
    "MODULE_05": "scoliosis_l1_l5",
    "MODULE_06": "adult_deformity",
}

# ─────────────────────────────────────────────────────────────────────────────
# API Moodle
# ─────────────────────────────────────────────────────────────────────────────

class MoodleAPI:
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
        resp = requests.post(self.base, data=payload, timeout=30)
        resp.raise_for_status()
        data = resp.json()
        if isinstance(data, dict) and "exception" in data:
            raise ValueError(f"Moodle API error [{function}]: {data.get('message', data)}")
        return data

    def create_course(self, fullname: str, shortname: str, summary: str, category_id: int = 1) -> int:
        result = self.call(
            "core_course_create_courses",
            **{
                "courses[0][fullname]":  fullname,
                "courses[0][shortname]": shortname,
                "courses[0][categoryid]": category_id,
                "courses[0][summary]":   summary,
                "courses[0][summaryformat]": 1,   # HTML
                "courses[0][lang]":      "fr",
                "courses[0][format]":    "weeks",
                "courses[0][visible]":   1,
            }
        )
        return result[0]["id"]

    def create_section(self, course_id: int, section_num: int, name: str, summary: str):
        return self.call(
            "core_course_edit_section",
            **{
                "id":    course_id,
                "section": section_num,
                "name":  name,
                "summary": summary,
                "summaryformat": 1,
            }
        )

    def get_courses_by_field(self, field: str, value: str) -> list:
        result = self.call("core_course_get_courses_by_field", **{
            "field": field,
            "value": value,
        })
        return result.get("courses", [])


# ─────────────────────────────────────────────────────────────────────────────
# Parseur Markdown → structure de cours
# ─────────────────────────────────────────────────────────────────────────────

def parse_module_md(filepath: Path) -> dict:
    """
    Parse un fichier MODULE_XX.md.
    Retourne : { title, shortname, sections: [{title, content_html}] }
    """
    text     = filepath.read_text(encoding="utf-8")
    html     = markdown.markdown(text, extensions=["extra", "toc", "nl2br"])
    soup     = BeautifulSoup(html, "html.parser")

    # Titre principal (h1)
    h1 = soup.find("h1")
    title = h1.get_text(strip=True) if h1 else filepath.stem.replace("_", " ").title()

    # Nom court depuis le pattern MODULE_XX_...
    m = re.match(r"(MODULE_\d+)", filepath.stem)
    shortname = m.group(1).replace("_", "") if m else filepath.stem[:8].upper()

    # Résumé : premier paragraphe après h1
    summary_p = h1.find_next("p") if h1 else soup.find("p")
    summary = str(summary_p) if summary_p else "<p>Module de formation VERTEX.</p>"

    # Découper en sections par h2
    sections = []
    current_title   = "Introduction"
    current_content = []

    for elem in soup.children:
        tag = getattr(elem, "name", None)
        if tag == "h2":
            if current_content:
                sections.append({
                    "title":        current_title,
                    "content_html": "".join(str(c) for c in current_content),
                })
            current_title   = elem.get_text(strip=True)
            current_content = []
        elif tag:
            current_content.append(elem)

    if current_content:
        sections.append({
            "title":        current_title,
            "content_html": "".join(str(c) for c in current_content),
        })

    return {
        "title":     title,
        "shortname": shortname,
        "summary":   summary,
        "sections":  sections,
        "filepath":  filepath,
    }


# ─────────────────────────────────────────────────────────────────────────────
# Import principal
# ─────────────────────────────────────────────────────────────────────────────

def import_module(api: MoodleAPI, module_md: Path, dry_run: bool = False) -> None:
    module_data = parse_module_md(module_md)
    stem_upper  = module_md.stem.upper()
    spine_tpl   = SPINE_TEMPLATES.get(stem_upper[:9], "scoliosis_t8_l2")

    print(f"\n📦 {module_data['title']} ({module_data['shortname']})")
    print(f"   {len(module_data['sections'])} sections — modèle rachis: {spine_tpl}")

    if dry_run:
        for i, s in enumerate(module_data["sections"], 1):
            print(f"   Section {i}: {s['title']}")
        return

    # Chercher si le cours existe déjà
    existing = api.get_courses_by_field("shortname", module_data["shortname"])
    if existing:
        course_id = existing[0]["id"]
        print(f"   ℹ️  Cours existant (id={course_id})")
    else:
        try:
            course_id = api.create_course(
                fullname   = module_data["title"],
                shortname  = module_data["shortname"],
                summary    = module_data["summary"],
                category_id= PARENT_COURSE_CATEGORY,
            )
            print(f"   ✅ Cours créé (id={course_id})")
        except ValueError as e:
            print(f"   ❌ Erreur: {e}")
            return

    # Créer les sections avec contenu HTML
    for i, section in enumerate(module_data["sections"], 1):
        try:
            api.create_section(
                course_id  = course_id,
                section_num= i,
                name       = section["title"],
                summary    = section["content_html"],
            )
            print(f"   📄 Section {i}: {section['title']}")
        except ValueError as e:
            print(f"   ⚠️  Section {i} ignorée: {e}")

    print(f"   🔩 Activité VERTEX à ajouter manuellement (modèle: {spine_tpl})")
    print(f"      URL: {VERTEX_APP_URL} | cours_id={course_id}")


def main():
    parser = argparse.ArgumentParser(
        description="Importer les modules de formation VERTEX dans Moodle"
    )
    parser.add_argument(
        "--host",  default="http://localhost:8890",
        help="URL de base de Moodle (défaut: http://localhost:8890)"
    )
    parser.add_argument(
        "--token", default=None,
        help="Token Web Services Moodle (ou variable MOODLE_TOKEN)"
    )
    parser.add_argument(
        "--dry-run", action="store_true",
        help="Afficher sans créer"
    )
    parser.add_argument(
        "modules", nargs="*",
        help="Modules à importer (ex: MODULE_01 MODULE_02). Vide = tous."
    )
    args = parser.parse_args()

    import os
    token = args.token or os.getenv("MOODLE_TOKEN", "")
    if not token and not args.dry_run:
        print("[ERR] Fournissez un token Moodle via --token ou MOODLE_TOKEN=...")
        sys.exit(1)

    # Lister les Markdown
    all_md = sorted(MODULES_DIR.glob("MODULE_*.md"))
    if not all_md:
        print(f"[ERR] Aucun fichier MODULE_*.md trouvé dans {MODULES_DIR}")
        sys.exit(1)

    # Filtrer si des modules sont spécifiés
    if args.modules:
        requested = {m.upper() for m in args.modules}
        all_md = [f for f in all_md if any(r in f.stem.upper() for r in requested)]

    api = MoodleAPI(args.host, token)
    print(f"\n🎓 Import Moodle — {args.host}")
    print(f"   {len(all_md)} module(s) à traiter\n")

    for md in all_md:
        import_module(api, md, dry_run=args.dry_run)

    print("\n✅ Import terminé\n")


if __name__ == "__main__":
    main()
