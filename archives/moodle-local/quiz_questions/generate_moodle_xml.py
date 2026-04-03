"""
VERTEX© — Générateur de quiz XML pour import Moodle (format GIFT ou XML natif).

Usage :
    python generate_moodle_xml.py --level bronze      # Génère le quiz Bronze
    python generate_moodle_xml.py --level all         # Génère tous les niveaux
    python generate_moodle_xml.py --format gift       # Format GIFT (plus simple)

Formats supportés :
    xml   → Format XML Moodle natif (Moodle XML Question Bank)
    gift  → Format GIFT texte (importable comme banque de questions)
    csv   → Export CSV pour rapport et révision

Prérequis :
    pip install lxml (pour xml) — ou aucun pour gift/csv
"""

import argparse
import json
import csv
import html
import re
import sys
from pathlib import Path
from datetime import datetime

# Importer les questions depuis questions_atlas.py
try:
    from questions_atlas import questions
except ImportError:
    # Fallback : lire le JSON s'il existe
    json_path = Path(__file__).parent / "questions_atlas.json"
    if json_path.exists():
        with json_path.open(encoding="utf-8") as f:
            questions = json.load(f)["questions"]
    else:
        print("[ERR] questions_atlas.py ou questions_atlas.json introuvable")
        sys.exit(1)

# ─────────────────────────────────────────────────────────────────────────────
# Configuration des niveaux
# ─────────────────────────────────────────────────────────────────────────────

LEVEL_CONFIG = {
    "bronze":   {"name": "Bronze — Bases anatomiques",         "threshold_pct": 60, "badge_img": "badge_bronze.png"},
    "argent":   {"name": "Argent — Biomécanique appliquée",    "threshold_pct": 65, "badge_img": "badge_argent.png"},
    "or":       {"name": "Or — Planification chirurgicale",    "threshold_pct": 70, "badge_img": "badge_or.png"},
    "diamant":  {"name": "Diamant — Expertise et complications","threshold_pct": 75, "badge_img": "badge_diamant.png"},
}

# ─────────────────────────────────────────────────────────────────────────────
# Générateur XML Moodle
# ─────────────────────────────────────────────────────────────────────────────

def question_to_xml(q: dict) -> str:
    """Convertit une question en XML Moodle (format Question Bank)."""
    qtype = {
        "mcq":       "multichoice",
        "msq":       "multichoice",
        "truefalse": "truefalse",
        "numeric":   "numerical",
    }.get(q["type"], "multichoice")

    is_single = q["type"] == "mcq"

    answers_xml = []
    n_correct = sum(1 for a in q["answers"] if a["correct"])
    point_per_correct = 100 // n_correct if n_correct > 0 else 100
    wrong_penalty     = -1 / max(len(q["answers"]) - n_correct, 1) * 100 / point_per_correct

    for ans in q["answers"]:
        fraction = point_per_correct if ans["correct"] else round(wrong_penalty, 4)
        feedback = html.escape(ans.get("feedback", ""))
        text     = html.escape(ans["text"])
        answers_xml.append(f"""    <answer fraction="{fraction}" format="html">
      <text><![CDATA[<p>{text}</p>]]></text>
      <feedback format="html"><text><![CDATA[<p>{feedback}</p>]]></text></feedback>
    </answer>""")

    explanation = html.escape(q.get("explanation", ""))
    reference   = html.escape(q.get("reference", ""))
    ref_html    = f'<p><em>Référence : {reference}</em></p>' if reference else ""

    question_text = html.escape(q["question"])
    level_tag  = q.get("level", "bronze").upper()
    domain_tag = q.get("domain", "anatomie")
    qid        = q.get("id", "Q?")

    return f"""  <question type="{qtype}">
    <name>
      <text>[{qid}] {question_text[:50]}…</text>
    </name>
    <questiontext format="html">
      <text><![CDATA[<p><strong>[{level_tag} | {domain_tag.upper()}]</strong></p><p>{question_text}</p>]]></text>
    </questiontext>
    <generalfeedback format="html">
      <text><![CDATA[<p>{explanation}</p>{ref_html}]]></text>
    </generalfeedback>
    <defaultgrade>1.0</defaultgrade>
    <penalty>0.0</penalty>
    <hidden>0</hidden>
    <idnumber>{qid}</idnumber>
    <single>{'true' if is_single else 'false'}</single>
    <shuffleanswers>true</shuffleanswers>
    <answernumbering>ABCD</answernumbering>
    <correctfeedback format="html"><text>Excellente réponse ✓</text></correctfeedback>
    <partiallycorrectfeedback format="html"><text>Réponse partiellement correcte.</text></partiallycorrectfeedback>
    <incorrectfeedback format="html"><text>Réponse incorrecte. Relisez l'explication.</text></incorrectfeedback>
    <shownumcorrect/>
{chr(10).join(answers_xml)}
  </question>"""


def generate_xml(level: str, qs: list[dict]) -> str:
    """Génère le fichier XML complet pour un niveau."""
    cfg  = LEVEL_CONFIG.get(level, LEVEL_CONFIG["bronze"])
    body = "\n".join(question_to_xml(q) for q in qs)

    # Catégorie de regroupement dans la banque Moodle
    cat_name = f"VERTEX / Quiz / {cfg['name']}"

    return f"""<?xml version="1.0" encoding="UTF-8"?>
<!-- VERTEX© — Quiz {cfg['name']} — Généré le {datetime.now():%Y-%m-%d %H:%M} -->
<!-- Importer via : Moodle > Banque de questions > Importer > Format XML -->
<quiz>
  <question type="category">
    <category>
      <text>$course$/top/{cat_name}</text>
    </category>
    <info format="html">
      <text><![CDATA[Seuil de réussite : {cfg['threshold_pct']}% — {len(qs)} questions]]></text>
    </info>
  </question>

{body}
</quiz>
"""


# ─────────────────────────────────────────────────────────────────────────────
# Générateur GIFT
# ─────────────────────────────────────────────────────────────────────────────

def question_to_gift(q: dict) -> str:
    """Convertit une question en format GIFT."""
    lines = []
    qid  = q.get("id", "?")
    text = q["question"].replace("{", "\\{").replace("}", "\\}")
    lines.append(f"// [{q['level'].upper()}] [{q['domain']}] {qid}")
    lines.append(f"::{qid}::{text}{{")

    for ans in q["answers"]:
        t = ans["text"].replace("{", "\\{").replace("}", "\\}")
        fb = ans.get("feedback", "").replace("{", "\\{").replace("}", "\\}")
        sign = "=" if ans["correct"] else "~"
        fb_part = f"#{fb}" if fb else ""
        lines.append(f"    {sign}{t}{fb_part}")

    lines.append("}")
    lines.append("")
    return "\n".join(lines)


def generate_gift(level: str, qs: list[dict]) -> str:
    cfg = LEVEL_CONFIG.get(level, LEVEL_CONFIG["bronze"])
    header = f"// VERTEX© — Quiz {cfg['name']}\n// {len(qs)} questions — Seuil {cfg['threshold_pct']}%\n\n"
    return header + "\n".join(question_to_gift(q) for q in qs)


# ─────────────────────────────────────────────────────────────────────────────
# Export CSV
# ─────────────────────────────────────────────────────────────────────────────

def generate_csv(qs: list[dict], output_path: Path) -> None:
    """Exporte toutes les questions au format CSV (pour révision)."""
    fieldnames = ["id", "level", "domain", "type", "question",
                  "correct_answers", "wrong_answers", "explanation", "reference"]
    with output_path.open("w", encoding="utf-8", newline="") as f:
        w = csv.DictWriter(f, fieldnames=fieldnames)
        w.writeheader()
        for q in qs:
            corrects = " | ".join(a["text"] for a in q["answers"] if a["correct"])
            wrongs   = " | ".join(a["text"] for a in q["answers"] if not a["correct"])
            w.writerow({
                "id":             q.get("id", ""),
                "level":          q.get("level", ""),
                "domain":         q.get("domain", ""),
                "type":           q.get("type", ""),
                "question":       q["question"],
                "correct_answers": corrects,
                "wrong_answers":   wrongs,
                "explanation":     q.get("explanation", ""),
                "reference":       q.get("reference", ""),
            })
    print(f"   📄 {len(qs)} lignes → {output_path.name}")


# ─────────────────────────────────────────────────────────────────────────────
# Main
# ─────────────────────────────────────────────────────────────────────────────

def main():
    parser = argparse.ArgumentParser(description="VERTEX Quiz Generator")
    parser.add_argument("--level",  default="all", choices=list(LEVEL_CONFIG.keys()) + ["all"])
    parser.add_argument("--format", default="xml", choices=["xml", "gift", "csv"])
    parser.add_argument("--out",    default=None, help="Répertoire de sortie")
    args = parser.parse_args()

    out_dir = Path(args.out) if args.out else Path(__file__).parent / "output"
    out_dir.mkdir(parents=True, exist_ok=True)

    levels = list(LEVEL_CONFIG.keys()) if args.level == "all" else [args.level]

    print(f"\n📝 Génération quiz VERTEX — format {args.format.upper()}\n")

    if args.format == "csv":
        csv_path = out_dir / "questions_all.csv"
        generate_csv(questions, csv_path)
        print(f"\n✅ CSV exporté → {csv_path}\n")
        return

    for level in levels:
        qs = [q for q in questions if q["level"] == level]
        if not qs:
            print(f"   ⚠️  Aucune question pour le niveau '{level}'")
            continue

        cfg = LEVEL_CONFIG[level]
        if args.format == "xml":
            content  = generate_xml(level, qs)
            out_file = out_dir / f"quiz_{level}.xml"
        else:
            content  = generate_gift(level, qs)
            out_file = out_dir / f"quiz_{level}.gift.txt"

        out_file.write_text(content, encoding="utf-8")
        print(f"   ✅ {cfg['name']:40s} — {len(qs):3d} questions → {out_file.name}")

    print(f"\n✅ Terminé → {out_dir}\n")


if __name__ == "__main__":
    main()
