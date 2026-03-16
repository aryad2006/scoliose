#!/usr/bin/env python3
"""
Génère QUIZ_DIABETOLOGIE.md + .docx + .odt depuis les banques de questions.
"""
import sys, os
sys.path.insert(0, os.path.join(os.path.dirname(__file__), 'moodle-local/quiz_questions'))

from questions_diabetologie_p1 import questions_bronze, questions_argent
from questions_diabetologie_p2 import questions_or, questions_diamant
from questions_diabetologie_p3 import questions_bronze_sup, questions_argent_sup
from questions_diabetologie_p4 import questions_or_sup, questions_diamant_sup
from pathlib import Path
import convert_cas_cliniques_diab as conv   # réutilise le convertisseur existant

LEVEL_META = {
    "bronze":  ("🥉 BRONZE",  "Application directe — Bases"),
    "argent":  ("🥈 ARGENT",  "Diagnostic différentiel — Clinique"),
    "or":      ("🥇 OR",      "Décision multi-facteurs — Gestion avancée"),
    "diamant": ("💎 DIAMANT", "Expertise — Cas complexes et rares"),
}
TYPE_LABEL = {"mcq": "QCM", "msq": "QCM à réponses multiples", "truefalse": "Vrai/Faux", "numeric": "Numérique"}

# ── Génération Markdown ────────────────────────────────────────────────────
def gen_md(all_q: list, out: Path):
    lines = [
        "# QUIZ DIABÉTOLOGIE — VERTEX©",
        "",
        "**Formation** : VERTEX© — Diabétologie Complète",
        "**Code** : QZDIAB",
        "**Total** : {} questions".format(len(all_q)),
        "**Niveaux** : 🥉 Bronze (25) · 🥈 Argent (30) · 🥇 Or (24) · 💎 Diamant (20)",
        "**Date** : 14 mars 2026",
        "",
        "---",
        "",
    ]

    groups = [
        ("bronze",  questions_bronze + questions_bronze_sup),
        ("argent",  questions_argent + questions_argent_sup),
        ("or",      questions_or     + questions_or_sup),
        ("diamant", questions_diamant + questions_diamant_sup),
    ]

    for level, qs in groups:
        emoji, subtitle = LEVEL_META[level]
        lines += [
            f"## {emoji} — {subtitle}",
            "",
            "---",
            "",
        ]
        for i, q in enumerate(qs, 1):
            tid = q.get("type", "mcq")
            lines += [
                f"### Question {q['id']} — {TYPE_LABEL.get(tid, tid)}",
                "",
                f"> **Domaine** : {q['domain']}",
                "",
                f"**{q['question']}**",
                "",
            ]
            # Réponses
            lines.append("| # | Proposition | Correct |")
            lines.append("|---|---|:---:|")
            for j, a in enumerate(q["answers"], 1):
                mark = "✅" if a["correct"] else "❌"
                lines.append(f"| {j} | {a['text']} | {mark} |")
            lines.append("")
            # Feedbacks
            lines.append("**Feedbacks :**")
            lines.append("")
            for j, a in enumerate(q["answers"], 1):
                lines.append(f"- *Proposition {j}* : {a['feedback']}")
            lines.append("")
            # Explication
            if q.get("explanation"):
                lines.append(f"> 📖 **Explication** : {q['explanation']}")
                lines.append("")
            # Référence
            if q.get("reference"):
                lines.append(f"> 📚 **Référence** : {q['reference']}")
                lines.append("")
            lines.append("---")
            lines.append("")

    out.write_text("\n".join(lines), encoding="utf-8")
    print(f"  ✓ MD   → {out.name}  ({len(all_q)} questions, {len(lines)} lignes)")


# ── Conversion DOCX + ODT ─────────────────────────────────────────────────
def main():
    all_q = (questions_bronze + questions_bronze_sup +
             questions_argent + questions_argent_sup +
             questions_or     + questions_or_sup     +
             questions_diamant + questions_diamant_sup)
    src   = Path("/Users/imac/Desktop/scoliose/cours-diabetologie/QUIZ_DIABETOLOGIE.md")
    dst   = Path("/Users/imac/Desktop/docs-scoliose")
    dst.mkdir(parents=True, exist_ok=True)

    print(f"\n{'═'*60}")
    print(f"  Génération QUIZ Diabétologie — {len(all_q)} questions")
    print(f"{'═'*60}\n")

    gen_md(all_q, src)

    try:
        conv.md_to_docx(src, dst / "QUIZ_DIABETOLOGIE.docx")
    except Exception as e:
        print(f"  ✗ DOCX: {e}")
    try:
        conv.md_to_odt(src, dst / "QUIZ_DIABETOLOGIE.odt")
    except Exception as e:
        print(f"  ✗ ODT:  {e}")

    print(f"\n{'═'*60}")
    print(f"  ✅  Fichiers dans {dst}")
    print(f"{'═'*60}\n")


if __name__ == "__main__":
    main()
