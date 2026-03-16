"""
VERTEX© — Banque de questions Diabétologie COMPLETE
P1 : 15 Bronze + 15 Argent
P2 : 12 Or + 12 Diamant
P3 : 10 Bronze sup + 15 Argent sup
P4 : 12 Or sup + 8 Diamant sup
TOTAL : 99 questions
"""
from questions_diabetologie_p1 import questions_bronze, questions_argent
from questions_diabetologie_p2 import questions_or, questions_diamant
from questions_diabetologie_p3 import questions_bronze_sup, questions_argent_sup
from questions_diabetologie_p4 import questions_or_sup, questions_diamant_sup

questions = (
    questions_bronze + questions_bronze_sup +
    questions_argent + questions_argent_sup +
    questions_or     + questions_or_sup     +
    questions_diamant + questions_diamant_sup
)

if __name__ == "__main__":
    by_level = {}
    for q in questions:
        by_level.setdefault(q["level"], []).append(q)
    for lvl in ("bronze", "argent", "or", "diamant"):
        print(f"  {lvl:10s} : {len(by_level.get(lvl, []))} questions")
    print(f"  {'TOTAL':10s} : {len(questions)} questions")
