#!/usr/bin/env python3
"""
VERTEX© — Convertisseur Quiz MD → format GIFT Moodle.

Lit les fichiers QUIZ_*.md (format markdown avec questions numérotées)
et génère des fichiers .gift importables dans la banque de questions Moodle.

Supporte les types :
  - QCM à réponse unique (une seule bonne réponse parmi A, B, C, D, E)
  - QCM à réponses multiples (plusieurs bonnes réponses)
  - Vrai/Faux

Format GIFT Moodle :
  https://docs.moodle.org/en/GIFT_format

Usage :
    python convert_quiz_to_gift.py                    # Convertit tous les quiz
    python convert_quiz_to_gift.py --quiz fiv          # Un seul quiz
    python convert_quiz_to_gift.py --output ./output   # Dossier de sortie
    python convert_quiz_to_gift.py --list               # Liste les quiz disponibles

Pré-requis : aucune dépendance externe (Python 3.8+)
"""

import argparse
import os
import re
import sys
from pathlib import Path

PROJECT_ROOT = Path(__file__).parent.parent

# ─────────────────────────────────────────────────────────────────────────────
# Configuration des quiz
# ─────────────────────────────────────────────────────────────────────────────

QUIZ_FILES = {
    "diabetologie": {
        "file": "cours-diabetologie/QUIZ_DIABETOLOGIE.md",
        "category": "VERTEX-Diabétologie",
        "name": "Quiz Diabétologie",
    },
    "fiv": {
        "file": "cours-fiv/QUIZ_FIV.md",
        "category": "VERTEX-FIV",
        "name": "Quiz FIV (AMP)",
    },
    "hypothyroidie": {
        "file": "cours-hypothyroidie/QUIZ_HYPOTHYROIDIE.md",
        "category": "VERTEX-Hypothyroïdies",
        "name": "Quiz Hypothyroïdies",
    },
    "hyperthyroidie": {
        "file": "cours-hyperthyroidie/QUIZ_HYPERTHYROIDIE.md",
        "category": "VERTEX-Hyperthyroïdies",
        "name": "Quiz Hyperthyroïdies",
    },
    "obesite-orthopedie": {
        "file": "cours-obesite-orthopedie/QUIZ_OBO_COMPLET.md",
        "category": "VERTEX-Obésité-Orthopédie",
        "name": "Quiz Obésité et Orthopédie",
    },
    "ptg": {
        "file": "cours-ptg/QUIZ_PTG_COMPLET.md",
        "category": "VERTEX-PTG",
        "name": "Quiz Prothèse Totale du Genou",
    },
    "scoliose": {
        "file": "cours-scoliose/QUIZ_SCOL_COMPLET.md",
        "category": "VERTEX-Scoliose",
        "name": "Quiz Scoliose",
    },
    "tendinites": {
        "file": "cours-tendinites/QUIZ_TEND_COMPLET.md",
        "category": "VERTEX-Tendinites",
        "name": "Quiz Tendinites et Tendinopathies",
    },
    "hta": {
        "file": "cours-hta/QUIZ_HTA_COMPLET.md",
        "category": "VERTEX-HTA",
        "name": "Quiz HTA",
    },
    "ioa": {
        "file": "cours-infection-osseuse/QUIZ_IOA_COMPLET.md",
        "category": "VERTEX-IOA",
        "name": "Quiz Infections Ostéo-Articulaires",
    },
}

# ─────────────────────────────────────────────────────────────────────────────
# Parseur de quiz MD
# ─────────────────────────────────────────────────────────────────────────────

def parse_quiz_md(filepath: Path) -> list[dict]:
    """
    Parse un fichier QUIZ_*.md au format VERTEX© (tables de réponses).

    Format VERTEX© :
        ### Question HYPO-BR-001 — QCM
        > **Domaine** : ... · **Module** : M01
        **Texte de la question ?**
        | # | Proposition | Correct |
        |---|---|:---:|
        | 1 | Réponse A | ❌ |
        | 2 | Réponse B | ✅ |
        ...
        **Feedbacks :**
        - *Proposition 1* : Explication...
    """
    text = filepath.read_text(encoding="utf-8")
    questions = []

    # Découper par blocs de questions (###)
    # Pattern : ### Question CODE-LEVEL-NUM — QCM/QRM
    q_header_pattern = re.compile(
        r'^###\s+Question\s+(\S+)\s*[-—]\s*(\S+)',
        re.MULTILINE | re.IGNORECASE,
    )

    q_matches = list(q_header_pattern.finditer(text))

    # Détecter le niveau courant à partir des sections ## (Bronze, Argent, etc.)
    level_sections = list(re.finditer(
        r'^##\s+.*?(Bronze|Argent|Or|Diamant)',
        text, re.MULTILINE | re.IGNORECASE,
    ))
    level_map = []
    for ls in level_sections:
        level_map.append((ls.start(), ls.group(1).lower()))

    def get_level_at_pos(pos: int) -> str:
        current_level = "bronze"
        for lpos, lvl in level_map:
            if lpos <= pos:
                current_level = lvl
            else:
                break
        return current_level

    for idx, q_match in enumerate(q_matches):
        code = q_match.group(1)  # e.g. HYPO-BR-001
        qtype = q_match.group(2).upper()  # QCM, QRM

        # Numéro séquentiel
        num_match = re.search(r'(\d+)$', code)
        q_num = int(num_match.group(1)) if num_match else idx + 1

        # Niveau depuis le code ou la section
        level = "bronze"
        code_upper = code.upper()
        if "-BR-" in code_upper:
            level = "bronze"
        elif "-AR-" in code_upper:
            level = "argent"
        elif "-OR-" in code_upper:
            level = "or"
        elif "-DI-" in code_upper or "-DM-" in code_upper:
            level = "diamant"
        else:
            level = get_level_at_pos(q_match.start())

        # Extraire le bloc jusqu'à la prochaine question
        start = q_match.end()
        end = q_matches[idx + 1].start() if idx + 1 < len(q_matches) else len(text)
        block = text[start:end]

        # Extraire le texte de la question (lignes en **gras**)
        q_text_match = re.search(r'\*\*(.+?\?)\*\*', block, re.DOTALL)
        if not q_text_match:
            # Chercher toute ligne qui finit par ?
            q_text_match = re.search(r'^(.+\?)\s*$', block, re.MULTILINE)
        if not q_text_match:
            continue

        full_question = q_text_match.group(1).strip()
        full_question = re.sub(r'\*{1,2}', '', full_question).strip()
        full_question = re.sub(r'\s+', ' ', full_question)

        # Extraire le domaine/module si présent dans le bloc (> **Domaine** : ...)
        domain_match = re.search(r'Domaine\*{0,2}\s*[:：]\s*(\S+)', block)
        module_match = re.search(r'Module\*{0,2}\s*[:：]\s*(\S+)', block)
        domain = domain_match.group(1).strip() if domain_match else ""
        module_ref = module_match.group(1).strip() if module_match else ""

        # Extraire les réponses depuis le tableau
        # Format : | 1 | Texte | ✅ ou ❌ |
        answers = []
        table_pattern = re.compile(
            r'^\|\s*(\d+)\s*\|\s*(.+?)\s*\|\s*(✅|❌|Correct|Incorrect)\s*\|',
            re.MULTILINE,
        )
        for t_match in table_pattern.finditer(block):
            ans_num = int(t_match.group(1))
            ans_text = t_match.group(2).strip()
            is_correct = t_match.group(3) in ("✅", "Correct")
            # Nettoyer
            ans_text = re.sub(r'\*{1,2}', '', ans_text).strip()
            answers.append({
                "letter": chr(64 + ans_num),  # 1→A, 2→B, etc.
                "text": ans_text,
                "correct": is_correct,
            })

        if not answers:
            # Essayer le format A) ... ✅
            alt_pattern = re.compile(r'^\s*[-*]?\s*([A-E])[.)]\s*(.+?)(\s*[✅✓])?$', re.MULTILINE)
            for a_match in alt_pattern.finditer(block):
                answers.append({
                    "letter": a_match.group(1),
                    "text": re.sub(r'[✅✓]', '', a_match.group(2)).strip(),
                    "correct": bool(a_match.group(3)),
                })

        if not answers:
            continue

        # Extraire les feedbacks / explication
        explanation = ""
        # Chercher le feedback de la bonne réponse
        feedback_pattern = re.compile(
            r'\*Proposition\s+(\d+)\*\s*[:：]\s*(.+?)(?=\n\s*-\s*\*Proposition|\n\s*>|\n\s*---|\Z)',
            re.DOTALL,
        )
        feedbacks = list(feedback_pattern.finditer(block))
        for fb in feedbacks:
            fb_num = int(fb.group(1))
            fb_text = fb.group(2).strip()
            # Trouver si c'est la bonne réponse
            if fb_num <= len(answers) and answers[fb_num - 1]["correct"]:
                explanation = re.sub(r'\s+', ' ', fb_text)
                explanation = re.sub(r'\*{1,2}', '', explanation)
                break

        # Si pas de feedback individuel, chercher un bloc global
        if not explanation:
            expl_match = re.search(
                r'(?:Explication|Justification)\s*[:—]\s*(.+?)(?=\n---|\Z)',
                block, re.DOTALL | re.IGNORECASE,
            )
            if expl_match:
                explanation = re.sub(r'\s+', ' ', expl_match.group(1).strip())

        questions.append({
            "num": q_num,
            "question": full_question,
            "level": level,
            "answers": answers,
            "explanation": explanation[:600],  # Limiter la taille
            "n_correct": sum(1 for a in answers if a["correct"]),
            "code": code,
            "type": qtype,
        })

    return questions


def extract_level(level_str: str) -> str:
    """Extrait le niveau (bronze/argent/or/diamant) d'une chaîne."""
    s = level_str.lower()
    if "diamant" in s:
        return "diamant"
    if "or" in s:
        return "or"
    if "argent" in s:
        return "argent"
    if "bronze" in s:
        return "bronze"
    return "bronze"  # défaut


# ─────────────────────────────────────────────────────────────────────────────
# Générateur GIFT
# ─────────────────────────────────────────────────────────────────────────────

def escape_gift(text: str) -> str:
    """Échappe les caractères spéciaux GIFT."""
    # GIFT utilise ~ = # { } : comme caractères spéciaux
    text = text.replace("\\", "\\\\")
    text = text.replace("{", "\\{")
    text = text.replace("}", "\\}")
    text = text.replace("~", "\\~")
    text = text.replace("=", "\\=")
    text = text.replace("#", "\\#")
    text = text.replace(":", "\\:")
    return text


def question_to_gift(q: dict, category: str) -> str:
    """Convertit une question en format GIFT."""
    lines = []

    # Titre de la question
    level_emoji = {"bronze": "🥉", "argent": "🥈", "or": "🥇", "diamant": "💎"}.get(q["level"], "")
    title = f"Q{q['num']:03d} {level_emoji} {q['level'].capitalize()}"
    lines.append(f"// Question {q['num']} — {q['level'].capitalize()}")

    q_text = escape_gift(q["question"])

    if q["n_correct"] <= 1:
        # QCM à réponse unique
        lines.append(f"::{title}::{q_text} {{")
        for ans in q["answers"]:
            ans_text = escape_gift(ans["text"])
            prefix = "=" if ans["correct"] else "~"
            feedback = ""
            if q.get("explanation") and ans["correct"]:
                feedback = f" #{escape_gift(q['explanation'][:500])}"
            elif not ans["correct"]:
                feedback = f" #Incorrect."
            lines.append(f"  {prefix}{ans_text}{feedback}")
        lines.append("}")
    else:
        # QCM à réponses multiples
        lines.append(f"::{title}::{q_text} {{")
        pct_correct = round(100 / q["n_correct"], 5)
        pct_wrong = round(-100 / (len(q["answers"]) - q["n_correct"]), 5) if len(q["answers"]) > q["n_correct"] else 0
        for ans in q["answers"]:
            ans_text = escape_gift(ans["text"])
            pct = pct_correct if ans["correct"] else pct_wrong
            feedback = ""
            if ans["correct"] and q.get("explanation"):
                feedback = f" #{escape_gift(q['explanation'][:300])}"
            lines.append(f"  ~%{pct}%{ans_text}{feedback}")
        lines.append("}")

    lines.append("")  # Ligne vide entre les questions
    return "\n".join(lines)


def generate_gift_file(questions: list[dict], category: str, output_path: Path):
    """Génère un fichier .gift complet."""
    lines = []

    # En-tête avec catégorie
    lines.append(f"// VERTEX© — Banque de questions — {category}")
    lines.append(f"// Généré automatiquement — {len(questions)} questions")
    lines.append(f"// Format GIFT pour import Moodle")
    lines.append("")
    lines.append(f"$CATEGORY: $course$/VERTEX/{category}")
    lines.append("")

    # Grouper par niveau
    for level in ["bronze", "argent", "or", "diamant"]:
        level_qs = [q for q in questions if q["level"] == level]
        if not level_qs:
            continue

        level_emoji = {"bronze": "🥉", "argent": "🥈", "or": "🥇", "diamant": "💎"}[level]
        lines.append(f"// --- {level_emoji} Niveau {level.capitalize()} ({len(level_qs)} questions) ---")
        lines.append(f"$CATEGORY: $course$/VERTEX/{category}/{level.capitalize()}")
        lines.append("")

        for q in level_qs:
            lines.append(question_to_gift(q, category))

    content = "\n".join(lines)
    output_path.write_text(content, encoding="utf-8")
    return len(questions)


# ─────────────────────────────────────────────────────────────────────────────
# Générateur XML Moodle natif
# ─────────────────────────────────────────────────────────────────────────────

def generate_xml_file(questions: list[dict], category: str, output_path: Path):
    """Génère un fichier XML Moodle natif."""
    import html as html_module

    lines = ['<?xml version="1.0" encoding="UTF-8"?>', "<quiz>", ""]

    # Catégorie
    lines.append(f'  <question type="category">')
    lines.append(f'    <category><text>$course$/VERTEX/{html_module.escape(category)}</text></category>')
    lines.append(f'  </question>')
    lines.append("")

    for q in questions:
        qtype = "multichoice"
        is_single = q["n_correct"] <= 1

        q_text = html_module.escape(q["question"])
        explanation = html_module.escape(q.get("explanation", ""))

        level_emoji = {"bronze": "🥉", "argent": "🥈", "or": "🥇", "diamant": "💎"}.get(q["level"], "")
        title = f"Q{q['num']:03d} {level_emoji} {q['level'].capitalize()}"

        lines.append(f'  <question type="{qtype}">')
        lines.append(f'    <name><text>{html_module.escape(title)}</text></name>')
        lines.append(f'    <questiontext format="html">')
        lines.append(f'      <text><![CDATA[<p>{q_text}</p>]]></text>')
        lines.append(f'    </questiontext>')
        lines.append(f'    <generalfeedback format="html">')
        lines.append(f'      <text><![CDATA[<p>{explanation}</p>]]></text>')
        lines.append(f'    </generalfeedback>')
        lines.append(f'    <defaultgrade>1</defaultgrade>')
        lines.append(f'    <penalty>0.3333333</penalty>')
        lines.append(f'    <hidden>0</hidden>')
        lines.append(f'    <single>{"true" if is_single else "false"}</single>')
        lines.append(f'    <shuffleanswers>true</shuffleanswers>')
        lines.append(f'    <answernumbering>abc</answernumbering>')

        n_correct = q["n_correct"]
        n_wrong = len(q["answers"]) - n_correct

        for ans in q["answers"]:
            if is_single:
                fraction = 100 if ans["correct"] else 0
            else:
                fraction = round(100 / n_correct) if ans["correct"] else round(-100 / max(n_wrong, 1))

            ans_text = html_module.escape(ans["text"])
            lines.append(f'    <answer fraction="{fraction}" format="html">')
            lines.append(f'      <text><![CDATA[<p>{ans_text}</p>]]></text>')
            lines.append(f'      <feedback format="html"><text></text></feedback>')
            lines.append(f'    </answer>')

        lines.append(f'  </question>')
        lines.append("")

    lines.append("</quiz>")

    content = "\n".join(lines)
    output_path.write_text(content, encoding="utf-8")
    return len(questions)


# ─────────────────────────────────────────────────────────────────────────────
# Point d'entrée
# ─────────────────────────────────────────────────────────────────────────────

def main():
    parser = argparse.ArgumentParser(description="VERTEX© — Convertisseur Quiz MD → GIFT/XML Moodle")
    parser.add_argument("--quiz", default=None, help="Quiz spécifique (clé)")
    parser.add_argument("--output", default=None, help="Dossier de sortie")
    parser.add_argument("--format", choices=["gift", "xml", "both"], default="both", help="Format de sortie")
    parser.add_argument("--list", action="store_true", help="Lister les quiz disponibles")
    args = parser.parse_args()

    if args.list:
        print("\n  QUIZ VERTEX© DISPONIBLES\n")
        for key, cfg in QUIZ_FILES.items():
            fp = PROJECT_ROOT / cfg["file"]
            exists = "✅" if fp.exists() else "❌"
            print(f"  {exists} {key:<18} {cfg['name']:<30} {cfg['file']}")
        print()
        return

    output_dir = Path(args.output) if args.output else Path(__file__).parent / "quiz_output"
    output_dir.mkdir(parents=True, exist_ok=True)

    quizzes = {args.quiz: QUIZ_FILES[args.quiz]} if args.quiz else QUIZ_FILES
    total_q = 0

    print(f"\n  VERTEX© — Conversion Quiz MD → Moodle")
    print(f"  Format : {args.format}")
    print(f"  Sortie : {output_dir}\n")

    for key, cfg in quizzes.items():
        filepath = PROJECT_ROOT / cfg["file"]
        if not filepath.exists():
            print(f"  [SKIP] {key} — fichier introuvable : {cfg['file']}")
            continue

        print(f"  Traitement : {cfg['name']}...")
        questions = parse_quiz_md(filepath)

        if not questions:
            print(f"    [WARN] Aucune question parsée dans {filepath.name}")
            print(f"    Tentative avec le parseur alternatif...")
            questions = parse_quiz_md_alt(filepath)

        if not questions:
            print(f"    [ERR] Impossible de parser {filepath.name}")
            continue

        # Stats par niveau
        levels = {}
        for q in questions:
            levels[q["level"]] = levels.get(q["level"], 0) + 1

        print(f"    {len(questions)} questions parsées")
        for lvl, count in sorted(levels.items()):
            emoji = {"bronze": "🥉", "argent": "🥈", "or": "🥇", "diamant": "💎"}.get(lvl, "")
            print(f"      {emoji} {lvl.capitalize()}: {count}")

        # Générer GIFT
        if args.format in ("gift", "both"):
            gift_path = output_dir / f"quiz_{key}.gift"
            n = generate_gift_file(questions, cfg["category"], gift_path)
            print(f"    GIFT : {gift_path.name} ({n} questions)")

        # Générer XML
        if args.format in ("xml", "both"):
            xml_path = output_dir / f"quiz_{key}.xml"
            n = generate_xml_file(questions, cfg["category"], xml_path)
            print(f"    XML  : {xml_path.name} ({n} questions)")

        total_q += len(questions)
        print()

    print(f"  Total : {total_q} questions converties")
    print(f"  Fichiers dans : {output_dir}\n")


def parse_quiz_md_alt(filepath: Path) -> list[dict]:
    """
    Parseur alternatif pour les quiz MD qui n'ont pas le format standard.
    Supporte le format :
        ### Question 1 (Bronze)
        Texte de la question...
        - A) ...
        - B) ... ✅
        ...
    """
    text = filepath.read_text(encoding="utf-8")
    questions = []

    # Découper par ### ou **Q
    blocks = re.split(r'\n(?=###\s|(?:\*{2})?Q\d+)', text)

    for block in blocks:
        block = block.strip()
        if not block:
            continue

        # Extraire le numéro
        num_match = re.search(r'(?:###\s*)?(?:Question\s*)?(\d+)', block)
        if not num_match:
            continue
        q_num = int(num_match.group(1))

        # Extraire le niveau
        level = "bronze"
        for lvl in ["diamant", "or", "argent", "bronze"]:
            if lvl.lower() in block.lower():
                level = lvl
                break

        # Extraire le texte de la question (première ligne non-titre)
        lines = block.split("\n")
        q_text_lines = []
        in_answers = False
        answers = []
        explanation = ""

        for line in lines[1:]:  # Skip la première ligne (titre)
            stripped = line.strip()

            # Détecter les réponses
            ans_match = re.match(r'^[-*]?\s*([A-E])[.)]\s*(.+?)(\s*[✅✓☑])?\s*$', stripped)
            if ans_match:
                in_answers = True
                letter = ans_match.group(1)
                ans_text = re.sub(r'[✅✓☑]', '', ans_match.group(2)).strip()
                is_correct = bool(ans_match.group(3))
                answers.append({"letter": letter, "text": ans_text, "correct": is_correct})
                continue

            # Détecter l'explication
            expl_match = re.match(
                r'^>?\s*\*{0,2}(?:Explication|Réponse|Justification)\*{0,2}\s*[:—]\s*(.+)',
                stripped, re.IGNORECASE,
            )
            if expl_match:
                explanation = expl_match.group(1).strip()
                continue

            # Texte de la question (avant les réponses)
            if not in_answers and stripped and not stripped.startswith(("#", "---")):
                q_text_lines.append(stripped)

        full_question = " ".join(q_text_lines).strip()
        full_question = re.sub(r'\*{1,2}', '', full_question)

        if answers and full_question:
            questions.append({
                "num": q_num,
                "question": full_question,
                "level": level,
                "answers": answers,
                "explanation": explanation,
                "n_correct": sum(1 for a in answers if a["correct"]),
            })

    return questions


if __name__ == "__main__":
    main()
