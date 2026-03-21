#!/usr/bin/env python3
"""
VERTEX© — Générateur de contenu Moodle riche et pédagogique.

Transforme les fichiers CDC/MODULE Markdown en pages HTML professionnelles
prêtes pour import dans Moodle. Le contenu est enrichi avec :
  - CSS médical professionnel
  - Boîtes pédagogiques (objectifs, alertes, erreurs fréquentes, etc.)
  - Médias intégrés (placeholders pour images/vidéos)
  - Tableaux responsifs
  - Sections collapsibles pour le contenu dense
  - Navigation intra-module

Génère un fichier HTML par module/CDC, prêt à être collé dans une section Moodle
ou importé via l'API REST.

Usage :
    python generate_moodle_content.py                         # Toutes les formations
    python generate_moodle_content.py --formation hta          # Une formation
    python generate_moodle_content.py --output ./moodle_html   # Dossier de sortie
    python generate_moodle_content.py --preview                # Aperçu dans le navigateur

Pré-requis :
    pip install markdown beautifulsoup4
"""

import argparse
import os
import re
import sys
from pathlib import Path

try:
    import markdown
    from bs4 import BeautifulSoup
except ImportError:
    print("[ERR] pip install markdown beautifulsoup4")
    sys.exit(1)

PROJECT_ROOT = Path(__file__).parent.parent

# ─────────────────────────────────────────────────────────────────────────────
# CSS professionnel pour Moodle
# ─────────────────────────────────────────────────────────────────────────────

MOODLE_CSS = """
<style>
/* VERTEX© — Styles pédagogiques Moodle */
.vertex-module { font-family: 'Segoe UI', Roboto, sans-serif; line-height: 1.7; color: #333; max-width: 960px; margin: 0 auto; }
.vertex-module h1 { color: #1565C0; border-bottom: 3px solid #1565C0; padding-bottom: 10px; font-size: 1.8em; }
.vertex-module h2 { color: #2E7D32; margin-top: 2em; font-size: 1.5em; border-left: 4px solid #2E7D32; padding-left: 12px; }
.vertex-module h3 { color: #E65100; margin-top: 1.5em; font-size: 1.2em; }
.vertex-module h4 { color: #6A1B9A; margin-top: 1em; }

/* Boîte objectifs */
.vertex-objectifs { background: #E3F2FD; border-left: 5px solid #1565C0; padding: 15px 20px; margin: 20px 0; border-radius: 0 8px 8px 0; }
.vertex-objectifs h3 { color: #1565C0; margin-top: 0; font-size: 1.1em; }
.vertex-objectifs::before { content: "🎯"; font-size: 1.3em; margin-right: 8px; }

/* Boîte cas clinique / accroche */
.vertex-accroche { background: #FFF3E0; border-left: 5px solid #E65100; padding: 15px 20px; margin: 20px 0; border-radius: 0 8px 8px 0; font-style: italic; }
.vertex-accroche::before { content: "🏥"; font-size: 1.3em; margin-right: 8px; font-style: normal; }

/* Boîte alerte / danger */
.vertex-alerte { background: #FFEBEE; border-left: 5px solid #C62828; padding: 15px 20px; margin: 20px 0; border-radius: 0 8px 8px 0; }
.vertex-alerte::before { content: "⚠️"; font-size: 1.3em; margin-right: 8px; }

/* Boîte erreur fréquente */
.vertex-erreur { background: #FCE4EC; border-left: 5px solid #AD1457; padding: 15px 20px; margin: 20px 0; border-radius: 0 8px 8px 0; }
.vertex-erreur::before { content: "❌"; font-size: 1.3em; margin-right: 8px; }

/* Boîte point clé / retenir */
.vertex-cle { background: #E8F5E9; border-left: 5px solid #2E7D32; padding: 15px 20px; margin: 20px 0; border-radius: 0 8px 8px 0; }
.vertex-cle::before { content: "💡"; font-size: 1.3em; margin-right: 8px; }

/* Boîte média */
.vertex-media { background: #F3E5F5; border: 2px dashed #7B1FA2; padding: 20px; margin: 20px 0; border-radius: 8px; text-align: center; color: #6A1B9A; }
.vertex-media::before { content: "📷"; font-size: 1.5em; display: block; margin-bottom: 8px; }
.vertex-media.video::before { content: "🎬"; }
.vertex-media.schema::before { content: "📐"; }

/* Boîte référence bibliographique */
.vertex-ref { background: #ECEFF1; border-left: 5px solid #607D8B; padding: 10px 15px; margin: 15px 0; border-radius: 0 8px 8px 0; font-size: 0.9em; color: #546E7A; }
.vertex-ref::before { content: "📚"; margin-right: 8px; }

/* Tableaux */
.vertex-module table { width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 0.95em; }
.vertex-module th { background: #1565C0; color: white; padding: 10px 12px; text-align: left; font-weight: 600; }
.vertex-module td { padding: 8px 12px; border-bottom: 1px solid #E0E0E0; }
.vertex-module tr:nth-child(even) { background: #F5F5F5; }
.vertex-module tr:hover { background: #E3F2FD; }

/* Listes */
.vertex-module ul { padding-left: 25px; }
.vertex-module li { margin-bottom: 6px; }

/* Blockquotes */
.vertex-module blockquote { border-left: 4px solid #90CAF9; padding: 10px 20px; margin: 15px 0; background: #F5F5F5; }

/* Code / formules */
.vertex-module code { background: #F5F5F5; padding: 2px 6px; border-radius: 3px; font-size: 0.9em; color: #C62828; }

/* Section navigation */
.vertex-nav { background: #FAFAFA; border: 1px solid #E0E0E0; padding: 15px 20px; margin: 20px 0; border-radius: 8px; }
.vertex-nav h3 { margin-top: 0; color: #1565C0; font-size: 1em; }
.vertex-nav ul { columns: 2; column-gap: 30px; }
.vertex-nav li { margin-bottom: 4px; break-inside: avoid; }

/* Badge niveau */
.vertex-badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 0.8em; font-weight: 600; margin-right: 8px; }
.vertex-badge.bronze { background: #F9A825; color: #fff; }
.vertex-badge.argent { background: #90A4AE; color: #fff; }
.vertex-badge.or { background: #FFD600; color: #333; }
.vertex-badge.diamant { background: #00BCD4; color: #fff; }

/* Cas clinique structure */
.vertex-cas { border: 2px solid #E0E0E0; border-radius: 12px; padding: 20px; margin: 25px 0; }
.vertex-cas-header { background: #F5F5F5; margin: -20px -20px 20px -20px; padding: 15px 20px; border-radius: 10px 10px 0 0; }
.vertex-cas-header h3 { margin: 0; }

/* Responsive */
@media (max-width: 768px) { .vertex-nav ul { columns: 1; } .vertex-module table { font-size: 0.85em; } }
</style>
"""

# ─────────────────────────────────────────────────────────────────────────────
# Transformateur MD → HTML pédagogique
# ─────────────────────────────────────────────────────────────────────────────

def transform_md_to_moodle_html(md_text: str, formation_color: str = "#1565C0") -> str:
    """
    Transforme du contenu Markdown en HTML Moodle enrichi pédagogiquement.

    Transformations appliquées :
    1. Conversion MD → HTML de base
    2. Détection et stylisation des boîtes pédagogiques
    3. Conversion des tags MEDIA en placeholders visuels
    4. Mise en forme des erreurs fréquentes
    5. Stylisation des tableaux
    6. Ajout de CSS VERTEX©
    """

    # 1. Pré-traitement : transformer les patterns spéciaux AVANT la conversion MD

    # Tags MEDIA : > [MEDIA: 📷 CODE -- Description]
    md_text = re.sub(
        r'>\s*\[MEDIA:\s*(📷|📐|🎬)\s*(\S+)\s*[-—]+\s*(.+?)\]',
        lambda m: _media_box(m.group(1), m.group(2), m.group(3)),
        md_text,
    )

    # Accroches cliniques : > 🏥 **Mise en situation** ou > 🏥 **Cas clinique**
    md_text = re.sub(
        r'>\s*🏥\s*\*{0,2}(?:Mise en situation|Cas clinique)[^*]*\*{0,2}\s*[:—]?\s*(.+?)(?=\n\n|\n(?:##|\*\*|>))',
        lambda m: f'\n<div class="vertex-accroche">{m.group(1).strip()}</div>\n',
        md_text, flags=re.DOTALL,
    )

    # Erreurs fréquentes : ❌ **Erreur fréquente** :
    md_text = re.sub(
        r'❌\s*\*{0,2}Erreur fréquente\*{0,2}\s*[:—]\s*(.+?)(?=\n\n|\n(?:##|\*\*|❌))',
        lambda m: f'\n<div class="vertex-erreur"><strong>Erreur fréquente</strong> : {m.group(1).strip()}</div>\n',
        md_text, flags=re.DOTALL,
    )

    # Points d'alerte : ⚠️
    md_text = re.sub(
        r'⚠️\s*\*{0,2}([^*\n]+)\*{0,2}\s*[:—]\s*(.+?)(?=\n\n|\n(?:##|\*\*|⚠️|❌))',
        lambda m: f'\n<div class="vertex-alerte"><strong>{m.group(1).strip()}</strong> : {m.group(2).strip()}</div>\n',
        md_text, flags=re.DOTALL,
    )

    # 2. Conversion MD → HTML
    html_content = markdown.markdown(
        md_text,
        extensions=["extra", "tables", "toc", "nl2br", "sane_lists"],
    )

    # 3. Post-traitement HTML

    # Transformer les sections "Objectifs d'apprentissage" en boîtes
    html_content = re.sub(
        r'<h[23]>([^<]*(?:Objectifs?|objectifs?)[^<]*)</h[23]>\s*((?:<(?:ol|ul)>.*?</(?:ol|ul)>|<p>.*?</p>)+)',
        lambda m: f'<div class="vertex-objectifs"><h3>{m.group(1)}</h3>{m.group(2)}</div>',
        html_content, flags=re.DOTALL,
    )

    # Transformer les "Contenu obligatoire" en boîtes point clé
    html_content = re.sub(
        r'<h[34]>([^<]*(?:Contenu obligatoire|Point clé|À retenir|Essentiel)[^<]*)</h[34]>',
        lambda m: f'<div class="vertex-cle"><strong>{m.group(1)}</strong></div>',
        html_content,
    )

    # Ajouter la couleur de la formation au h1
    html_content = re.sub(
        r'<h1>',
        f'<h1 style="border-color: {formation_color}; color: {formation_color};">',
        html_content,
    )

    # Wrapper global
    html_content = f'<div class="vertex-module">\n{html_content}\n</div>'

    return html_content


def _media_box(icon: str, code: str, description: str) -> str:
    """Génère un placeholder média HTML."""
    media_type = {
        "📷": "photo",
        "📐": "schema",
        "🎬": "video",
    }.get(icon, "photo")

    css_class = f"vertex-media {media_type}" if media_type != "photo" else "vertex-media"

    return f"""
<div class="{css_class}">
<strong>{icon} {code}</strong><br/>
<em>{description.strip()}</em><br/>
<small style="color: #9E9E9E;">Média à intégrer — format {media_type.upper()}</small>
</div>
"""


# ─────────────────────────────────────────────────────────────────────────────
# Configuration des formations
# ─────────────────────────────────────────────────────────────────────────────

FORMATIONS = {
    "scoliose": {"dir": "cours-scoliose", "pattern": "MODULE_*.md", "color": "#1565C0", "name": "Scoliose"},
    "ptg": {"dir": "cours-ptg", "pattern": "CDC_PTG_*.md", "color": "#2E7D32", "name": "PTG"},
    "ioa": {"dir": "cours-infection-osseuse", "pattern": "CDC_IOA_*.md", "color": "#795548", "name": "IOA"},
    "tendinites": {"dir": "cours-tendinites", "pattern": "CDC_TEND_*.md", "color": "#E65100", "name": "Tendinites"},
    "obesite": {"dir": "cours-obesite-orthopedie", "pattern": "CDC_OBO_*.md", "color": "#6A1B9A", "name": "Obésité"},
    "diabetologie": {"dir": "cours-diabetologie", "pattern": "CDC_DIAB_*.md", "color": "#00838F", "name": "Diabétologie"},
    "hta": {"dir": "cours-hta", "pattern": "CDC_HTA_*.md", "color": "#C62828", "name": "HTA"},
    "hypothyroidie": {"dir": "cours-hypothyroidie", "pattern": "CDC_HYPO_*.md", "color": "#283593", "name": "Hypothyroïdies"},
    "hyperthyroidie": {"dir": "cours-hyperthyroidie", "pattern": "CDC_HYPER_*.md", "color": "#EF6C00", "name": "Hyperthyroïdies"},
    "fiv": {"dir": "cours-fiv", "pattern": "CDC_FIV_*.md", "color": "#AD1457", "name": "FIV"},
    "histoire": {"dir": "cours-histoire-orthopedie", "pattern": "CDC_HISTO_*.md", "color": "#4E342E", "name": "Histoire Orthopédie"},
    "lca": {"dir": "cours-lca", "pattern": "CDC_LCA_*.md", "color": "#00695C", "name": "LCA"},
}

# ─────────────────────────────────────────────────────────────────────────────
# Générateur principal
# ─────────────────────────────────────────────────────────────────────────────

def generate_formation_html(key: str, config: dict, output_dir: Path, preview: bool = False):
    """Génère les fichiers HTML Moodle pour une formation."""
    course_dir = PROJECT_ROOT / config["dir"]
    if not course_dir.exists():
        print(f"  [SKIP] {key} — répertoire introuvable")
        return 0

    all_md = sorted(course_dir.glob(config["pattern"]))
    all_md = [f for f in all_md if "_COMPLET" not in f.stem]

    if not all_md:
        print(f"  [SKIP] {key} — aucun fichier MD")
        return 0

    formation_dir = output_dir / key
    formation_dir.mkdir(parents=True, exist_ok=True)

    print(f"\n  {config['name']} — {len(all_md)} modules")
    count = 0

    for md_file in all_md:
        try:
            md_text = md_file.read_text(encoding="utf-8")
            html_content = MOODLE_CSS + transform_md_to_moodle_html(md_text, config["color"])

            # Nom de fichier de sortie
            out_name = md_file.stem + ".html"
            out_path = formation_dir / out_name
            out_path.write_text(html_content, encoding="utf-8")

            # Taille approximative
            size_kb = len(html_content) / 1024
            print(f"    {out_name} ({size_kb:.0f} Ko)")
            count += 1

        except Exception as e:
            print(f"    [ERR] {md_file.name} : {e}")

    # Générer aussi les cas cliniques
    cas_patterns = [
        "CAS_CLINIQUES_*.md",
    ]
    for pattern in cas_patterns:
        for cas_file in sorted(course_dir.glob(pattern)):
            try:
                md_text = cas_file.read_text(encoding="utf-8")
                html_content = MOODLE_CSS + transform_md_to_moodle_html(md_text, config["color"])
                out_path = formation_dir / (cas_file.stem + ".html")
                out_path.write_text(html_content, encoding="utf-8")
                size_kb = len(html_content) / 1024
                print(f"    {cas_file.stem}.html ({size_kb:.0f} Ko) [cas cliniques]")
                count += 1
            except Exception as e:
                print(f"    [ERR] {cas_file.name} : {e}")

    # Générer le quiz si présent
    quiz_patterns = ["QUIZ_*.md"]
    for pattern in quiz_patterns:
        for quiz_file in sorted(course_dir.glob(pattern)):
            try:
                md_text = quiz_file.read_text(encoding="utf-8")
                html_content = MOODLE_CSS + transform_md_to_moodle_html(md_text, config["color"])
                out_path = formation_dir / (quiz_file.stem + ".html")
                out_path.write_text(html_content, encoding="utf-8")
                size_kb = len(html_content) / 1024
                print(f"    {quiz_file.stem}.html ({size_kb:.0f} Ko) [quiz]")
                count += 1
            except Exception as e:
                print(f"    [ERR] {quiz_file.name} : {e}")

    # Générer un index HTML de la formation
    _generate_formation_index(key, config, formation_dir, all_md)

    if preview:
        import webbrowser
        index_path = formation_dir / "index.html"
        if index_path.exists():
            webbrowser.open(f"file://{index_path}")

    return count


def _generate_formation_index(key: str, config: dict, output_dir: Path, modules: list[Path]):
    """Génère un fichier index.html pour la formation."""
    color = config["color"]
    name = config["name"]

    modules_html = ""
    for md_file in modules:
        html_name = md_file.stem + ".html"
        # Extraire le numéro et le titre
        num_match = re.search(r'_(\d+)_(.+)', md_file.stem)
        if num_match:
            num = int(num_match.group(1))
            title = num_match.group(2).replace("_", " ").title()
            modules_html += f'<li><a href="{html_name}" style="color: {color};">Module {num:02d} — {title}</a></li>\n'
        else:
            modules_html += f'<li><a href="{html_name}" style="color: {color};">{md_file.stem}</a></li>\n'

    # Cas cliniques et quiz
    extras_html = ""
    for html_file in sorted(output_dir.glob("CAS_CLINIQUES_*.html")):
        extras_html += f'<li><a href="{html_file.name}">📋 {html_file.stem.replace("_", " ")}</a></li>\n'
    for html_file in sorted(output_dir.glob("QUIZ_*.html")):
        extras_html += f'<li><a href="{html_file.name}">📝 {html_file.stem.replace("_", " ")}</a></li>\n'

    index_html = f"""<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VERTEX© — {name}</title>
{MOODLE_CSS}
<style>
body {{ font-family: 'Segoe UI', Roboto, sans-serif; max-width: 800px; margin: 40px auto; padding: 0 20px; }}
.header {{ background: {color}; color: white; padding: 30px; border-radius: 12px; margin-bottom: 30px; }}
.header h1 {{ margin: 0; font-size: 2em; }}
.header p {{ margin: 10px 0 0; opacity: 0.9; }}
.modules-list {{ list-style: none; padding: 0; }}
.modules-list li {{ padding: 12px 0; border-bottom: 1px solid #E0E0E0; }}
.modules-list a {{ text-decoration: none; font-size: 1.1em; font-weight: 500; }}
.modules-list a:hover {{ text-decoration: underline; }}
</style>
</head>
<body>
<div class="header">
<h1>VERTEX© — {name}</h1>
<p>Formation médicale e-learning — Plateforme VERTEX©</p>
<p>{len(modules)} modules</p>
</div>

<h2>Modules de formation</h2>
<ul class="modules-list">
{modules_html}
</ul>

{"<h2>Cas cliniques et Quiz</h2><ul class='modules-list'>" + extras_html + "</ul>" if extras_html else ""}

<footer style="margin-top: 40px; padding: 20px; text-align: center; color: #9E9E9E; border-top: 1px solid #E0E0E0;">
VERTEX© — Virtual Environment for Rachis Training and EXploration<br/>
Contenu généré pour import Moodle 4.5
</footer>
</body>
</html>"""

    (output_dir / "index.html").write_text(index_html, encoding="utf-8")


# ─────────────────────────────────────────────────────────────────────────────
# Point d'entrée
# ─────────────────────────────────────────────────────────────────────────────

def main():
    parser = argparse.ArgumentParser(description="VERTEX© — Générateur de contenu Moodle riche")
    parser.add_argument("--formation", default=None, help="Formation spécifique (clé)")
    parser.add_argument("--output", default=None, help="Dossier de sortie")
    parser.add_argument("--preview", action="store_true", help="Ouvrir dans le navigateur")
    parser.add_argument("--list", action="store_true", help="Lister les formations")
    args = parser.parse_args()

    if args.list:
        print("\n  FORMATIONS DISPONIBLES\n")
        for key, cfg in FORMATIONS.items():
            d = PROJECT_ROOT / cfg["dir"]
            n = len([f for f in d.glob(cfg["pattern"]) if "_COMPLET" not in f.stem]) if d.exists() else 0
            print(f"  {key:<16} {cfg['name']:<25} {n} modules")
        print()
        return

    output_dir = Path(args.output) if args.output else Path(__file__).parent / "moodle_html"
    output_dir.mkdir(parents=True, exist_ok=True)

    formations = {args.formation: FORMATIONS[args.formation]} if args.formation else FORMATIONS
    total = 0

    print(f"\n{'='*60}")
    print(f"  VERTEX© — Génération du contenu Moodle")
    print(f"  Sortie : {output_dir}")
    print(f"{'='*60}")

    for key, config in formations.items():
        n = generate_formation_html(key, config, output_dir, args.preview)
        total += n

    print(f"\n{'='*60}")
    print(f"  {total} fichiers HTML générés dans {output_dir}")
    print(f"{'='*60}\n")


if __name__ == "__main__":
    main()
