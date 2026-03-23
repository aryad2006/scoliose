#!/usr/bin/env python3
"""
VERTEX© — Générateur de cours interactifs Moodle v2.

Transforme les fichiers COURS_*.md en pages HTML interactives avec :
  - Sidebar fixe de navigation (table des matières cliquable)
  - QCM fonctionnels : radio (choix unique), checkbox (choix multiple)
  - Drag & drop pour exercices de réarrangement
  - Textarea auto-resize pour réponses libres
  - Encadrés pédagogiques typés
  - Cas cliniques avec feedback dépliable
  - Tags MEDIA avec placeholders visuels

Usage :
    python generate_interactive_course.py --file COURS_DIAB_01_P1.md --preview
    python generate_interactive_course.py --formation diabetologie
    python generate_interactive_course.py   # Toutes les formations

Pré-requis :
    pip install markdown
"""

import argparse
import re
import sys
from pathlib import Path

try:
    import markdown
    from markdown.extensions.toc import TocExtension
except ImportError:
    print("[ERR] pip install markdown")
    sys.exit(1)

PROJECT_ROOT = Path(__file__).parent.parent

# ─────────────────────────────────────────────────────────────────────────────
# CSS + JS — Cours interactif avec sidebar et QCM fonctionnels
# ─────────────────────────────────────────────────────────────────────────────

ASSETS = r"""
<style>
/* ════════════════════════════════════════════════════════════
   VERTEX© — Cours interactif v2
   ════════════════════════════════════════════════════════════ */

/* === Layout sidebar + contenu === */
.vertex-wrapper {
  display: flex;
  min-height: 100vh;
  font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
  color: #2d3436;
}

/* --- Sidebar --- */
.vertex-sidebar {
  position: sticky;
  top: 0;
  align-self: flex-start;
  width: 280px;
  min-width: 280px;
  max-height: 100vh;
  overflow-y: auto;
  background: #F8F9FA;
  border-right: 1px solid #DEE2E6;
  padding: 20px 0;
  font-size: 0.88em;
  z-index: 100;
  scrollbar-width: thin;
}
.vertex-sidebar::-webkit-scrollbar { width: 5px; }
.vertex-sidebar::-webkit-scrollbar-thumb { background: #CED4DA; border-radius: 3px; }
.vertex-sidebar-title {
  padding: 0 18px 14px;
  font-weight: 700;
  font-size: 1.1em;
  color: var(--vertex-primary, #1565C0);
  border-bottom: 1px solid #DEE2E6;
  margin-bottom: 10px;
}
.vertex-sidebar-title::before { content: "📑 "; }
.vertex-sidebar ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.vertex-sidebar li { margin: 0; }
.vertex-sidebar a {
  display: block;
  padding: 7px 18px;
  color: #495057;
  text-decoration: none;
  border-left: 3px solid transparent;
  transition: all 0.15s ease;
  line-height: 1.4;
}
.vertex-sidebar a:hover {
  background: #E9ECEF;
  color: var(--vertex-primary, #1565C0);
}
.vertex-sidebar a.active {
  background: #E3F2FD;
  color: var(--vertex-primary, #1565C0);
  border-left-color: var(--vertex-primary, #1565C0);
  font-weight: 600;
}
.vertex-sidebar .toc-h3 {
  padding-left: 34px;
  font-size: 0.92em;
  color: #6C757D;
}

/* --- Contenu principal --- */
.vertex-content {
  flex: 1;
  max-width: 820px;
  padding: 30px 40px;
  line-height: 1.75;
  font-size: 16px;
  margin: 0 auto;
}

/* === Titres === */
.vertex-content h1 {
  color: var(--vertex-primary, #1565C0);
  border-bottom: 3px solid var(--vertex-primary, #1565C0);
  padding-bottom: 12px;
  font-size: 1.85em;
  margin-top: 0.5em;
}
.vertex-content h2 {
  color: var(--vertex-primary, #1565C0);
  margin-top: 2.5em;
  font-size: 1.5em;
  border-left: 5px solid var(--vertex-primary, #1565C0);
  padding-left: 14px;
  scroll-margin-top: 20px;
}
.vertex-content h3 {
  color: #2E7D32;
  margin-top: 1.8em;
  font-size: 1.22em;
  scroll-margin-top: 20px;
}
.vertex-content h4 { color: #6A1B9A; margin-top: 1.2em; font-size: 1.05em; }

/* === Encadrés pédagogiques === */
.vbox {
  border-radius: 8px;
  padding: 18px 22px;
  margin: 22px 0;
  border-left: 5px solid;
}
.vbox p:last-child { margin-bottom: 0; }
.vbox-title { font-weight: 700; margin-bottom: 8px; display: block; }

.vbox.clinique    { background:#FFF8E1; border-color:#F57F17; }
.vbox.clinique    .vbox-title { color:#E65100; }
.vbox.clinique    .vbox-title::before { content:"🏥 "; }
.vbox.danger      { background:#FBE9E7; border-color:#C62828; }
.vbox.danger      .vbox-title { color:#B71C1C; }
.vbox.danger      .vbox-title::before { content:"⚠️ "; }
.vbox.approfondi  { background:#E3F2FD; border-color:#1565C0; }
.vbox.approfondi  .vbox-title { color:#0D47A1; }
.vbox.approfondi  .vbox-title::before { content:"📖 "; }
.vbox.astuce      { background:#E8F5E9; border-color:#2E7D32; }
.vbox.astuce      .vbox-title { color:#1B5E20; }
.vbox.astuce      .vbox-title::before { content:"💡 "; }
.vbox.expert      { background:#F3E5F5; border-color:#7B1FA2; }
.vbox.expert      .vbox-title { color:#6A1B9A; }
.vbox.expert      .vbox-title::before { content:"🔬 "; }
.vbox.reflexion   { background:#FFFDE7; border-color:#F9A825; }
.vbox.reflexion   .vbox-title { color:#F57F17; }
.vbox.reflexion   .vbox-title::before { content:"🤔 "; }
.vbox.controverse { background:#ECEFF1; border-color:#546E7A; }
.vbox.controverse .vbox-title { color:#37474F; }
.vbox.controverse .vbox-title::before { content:"⚖️ "; }
.vbox.pertinence  { background:#FFF3E0; border-color:#E65100; }
.vbox.pertinence  .vbox-title { color:#BF360C; }
.vbox.pertinence  .vbox-title::before { content:"🎯 "; }

/* === Média placeholder === */
.vmedia {
  background: #F3E5F5; border: 2px dashed #9C27B0; border-radius: 10px;
  padding: 22px; margin: 22px 0; text-align: center; color: #6A1B9A;
}
.vmedia-icon { font-size: 2em; display: block; margin-bottom: 6px; }
.vmedia-code { font-weight: 700; }
.vmedia-desc { font-style: italic; margin-top: 6px; color: #7B1FA2; }
.vmedia-note { font-size: 0.8em; color: #9E9E9E; margin-top: 8px; }

/* === QCM interactif === */
.vqcm {
  border: 2px solid #E0E0E0; border-radius: 10px;
  padding: 22px; margin: 25px 0; background: #FAFAFA;
}
.vqcm-header { display: flex; align-items: center; gap: 10px; margin-bottom: 14px; flex-wrap: wrap; }
.vqcm-badge {
  display: inline-block; padding: 3px 12px; border-radius: 14px;
  font-size: 0.82em; font-weight: 700; color: #fff;
}
.vqcm-badge.bronze  { background: #F57F17; }
.vqcm-badge.argent  { background: #78909C; }
.vqcm-badge.or      { background: #FFB300; color:#333; }
.vqcm-badge.diamant { background: #00ACC1; }
.vqcm-question { font-weight: 600; font-size: 1.05em; margin-bottom: 14px; }

/* Options empilées verticalement */
.vqcm-options { list-style: none; padding: 0; margin: 0 0 15px; }
.vqcm-options li {
  display: flex; align-items: flex-start; gap: 10px;
  padding: 12px 14px; margin: 6px 0; border-radius: 8px;
  border: 2px solid #E0E0E0; background: #fff;
  cursor: pointer; transition: all 0.15s ease;
  user-select: none;
}
.vqcm-options li:hover { border-color: #90CAF9; background: #F5F9FF; }
.vqcm-options li.selected { border-color: var(--vertex-primary, #1565C0); background: #E3F2FD; }
.vqcm-options li.correct-show { border-color: #2E7D32; background: #E8F5E9; }
.vqcm-options li.incorrect-show { border-color: #C62828; background: #FFEBEE; }
.vqcm-options input[type="radio"],
.vqcm-options input[type="checkbox"] {
  margin-top: 3px; flex-shrink: 0; accent-color: var(--vertex-primary, #1565C0);
  width: 18px; height: 18px;
}
.vqcm-options label { cursor: pointer; flex: 1; }

/* Bouton valider */
.vqcm-validate {
  display: inline-block; padding: 10px 24px; border-radius: 8px;
  background: var(--vertex-primary, #1565C0); color: #fff; border: none;
  font-weight: 600; font-size: 0.95em; cursor: pointer;
  transition: background 0.15s ease;
}
.vqcm-validate:hover { filter: brightness(1.1); }
.vqcm-validate:disabled { background: #CCC; cursor: not-allowed; }

.vqcm-result {
  margin-top: 14px; padding: 12px 16px; border-radius: 8px;
  font-weight: 600; display: none;
}
.vqcm-result.correct { background: #E8F5E9; color: #1B5E20; }
.vqcm-result.incorrect { background: #FFEBEE; color: #B71C1C; }

/* Feedback dépliable */
.vfeedback { margin-top: 12px; border-radius: 8px; overflow: hidden; }
.vfeedback summary {
  background: #E3F2FD; padding: 10px 16px; cursor: pointer;
  font-weight: 600; color: #1565C0; border-radius: 8px;
  list-style: none;
}
.vfeedback summary::-webkit-details-marker { display: none; }
.vfeedback summary::before { content: "💬 "; }
.vfeedback .fb-content {
  padding: 14px 16px; background: #F5F5F5;
  border-radius: 0 0 8px 8px; line-height: 1.6;
}

/* === Exercice drag & drop === */
.vdrag-zone {
  display: flex; flex-direction: column; gap: 6px;
  margin: 14px 0; padding: 12px; background: #F5F5F5; border-radius: 8px;
  min-height: 60px;
}
.vdrag-item {
  display: flex; align-items: center; gap: 10px;
  padding: 12px 16px; background: #fff; border: 2px solid #E0E0E0;
  border-radius: 8px; cursor: grab; user-select: none;
  transition: all 0.15s ease;
}
.vdrag-item:active { cursor: grabbing; }
.vdrag-item:hover { border-color: #90CAF9; box-shadow: 0 2px 6px rgba(0,0,0,0.08); }
.vdrag-item .drag-handle { color: #9E9E9E; font-size: 1.2em; }
.vdrag-item .drag-handle::before { content: "⠿"; }
.vdrag-item.drag-over { border-color: var(--vertex-primary, #1565C0); background: #E3F2FD; }
.vdrag-item.correct-pos { border-color: #2E7D32; background: #E8F5E9; }
.vdrag-item.incorrect-pos { border-color: #C62828; background: #FFEBEE; }

/* === Textarea auto-resize === */
.vtext-answer {
  width: 100%; min-height: 80px; padding: 14px; border: 2px solid #E0E0E0;
  border-radius: 8px; font-family: inherit; font-size: 0.95em;
  line-height: 1.6; resize: none; overflow: hidden;
  transition: border-color 0.15s ease;
}
.vtext-answer:focus { border-color: var(--vertex-primary, #1565C0); outline: none; }
.vtext-answer::placeholder { color: #ADB5BD; }

/* === Exercice structuré === */
.vexercice {
  border: 2px solid #26A69A; border-radius: 10px;
  padding: 22px; margin: 22px 0; background: #E0F2F1;
}
.vexercice-title { font-weight: 700; color: #00695C; margin-bottom: 10px; }
.vexercice-title::before { content: "✏️ "; }

/* === Points clés === */
.vpoints-cles {
  background: linear-gradient(135deg, #E8F5E9, #C8E6C9);
  border-radius: 12px; padding: 22px 26px; margin: 30px 0;
  border: 1px solid #A5D6A7;
}
.vpoints-cles-title { font-weight:700; font-size:1.2em; color:#1B5E20; margin-bottom:14px; }
.vpoints-cles-title::before { content: "🔑 "; }
.vpoints-cles ol { padding-left: 22px; }
.vpoints-cles li { margin-bottom: 8px; }

/* === Tableaux === */
.vertex-content table {
  width: 100%; border-collapse: collapse; margin: 22px 0;
  font-size: 0.94em; border-radius: 8px; overflow: hidden;
  box-shadow: 0 1px 3px rgba(0,0,0,0.08);
}
.vertex-content th {
  background: var(--vertex-primary, #1565C0); color: #fff;
  padding: 11px 14px; text-align: left; font-weight: 600;
}
.vertex-content td { padding: 9px 14px; border-bottom: 1px solid #E8E8E8; }
.vertex-content tr:nth-child(even) { background: #F8F9FA; }
.vertex-content tr:hover { background: #E3F2FD; }

/* === Transition === */
.vtransition {
  text-align:center; padding:18px; margin:30px 0; color:#78909C;
  font-style:italic; border-top:1px dashed #CFD8DC; border-bottom:1px dashed #CFD8DC;
}

/* === Références === */
.vrefs {
  background:#ECEFF1; border-radius:10px; padding:20px 24px;
  margin:30px 0; font-size:0.88em; color:#546E7A;
}
.vrefs-title { font-weight:700; color:#37474F; font-size:1.05em; margin-bottom:10px; }
.vrefs-title::before { content:"📚 "; }
.vrefs ul { padding-left:18px; }
.vrefs li { margin-bottom:4px; }

/* === Footer === */
.vertex-footer {
  text-align:center; padding:20px; margin-top:40px;
  color:#9E9E9E; font-size:0.85em; border-top:1px solid #E0E0E0;
}

/* Listes & blockquotes */
.vertex-content ul, .vertex-content ol { padding-left:24px; }
.vertex-content li { margin-bottom:5px; }
.vertex-content blockquote {
  border-left:4px solid #90CAF9; padding:12px 20px;
  margin:16px 0; background:#F5F5F5; border-radius:0 8px 8px 0;
}

/* === Responsive === */
@media (max-width: 900px) {
  .vertex-wrapper { flex-direction: column; }
  .vertex-sidebar {
    position: relative; width: 100%; min-width: unset;
    max-height: none; border-right: none; border-bottom: 1px solid #DEE2E6;
  }
  .vertex-content { padding: 20px; }
}
@media print {
  .vertex-sidebar { display: none; }
  .vertex-content { max-width: 100%; padding: 0; }
}
</style>

<script>
/* ════════════════════════════════════════════════════════════
   VERTEX© — JavaScript interactif
   ════════════════════════════════════════════════════════════ */

document.addEventListener('DOMContentLoaded', function() {

  // ── Sidebar : scroll spy (highlight section active)
  const sidebarLinks = document.querySelectorAll('.vertex-sidebar a');
  const sections = [];
  sidebarLinks.forEach(link => {
    const id = link.getAttribute('href')?.replace('#','');
    if (id) {
      const el = document.getElementById(id);
      if (el) sections.push({ el, link });
    }
  });

  function updateActive() {
    let current = null;
    for (const s of sections) {
      if (s.el.getBoundingClientRect().top <= 80) current = s;
    }
    sidebarLinks.forEach(l => l.classList.remove('active'));
    if (current) current.link.classList.add('active');
  }
  window.addEventListener('scroll', updateActive, { passive: true });
  updateActive();

  // ── Sidebar smooth scroll
  sidebarLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      const id = this.getAttribute('href')?.replace('#','');
      const el = document.getElementById(id);
      if (el) { e.preventDefault(); el.scrollIntoView({ behavior:'smooth', block:'start' }); }
    });
  });

  // ── QCM : radio/checkbox + validation progressive
  document.querySelectorAll('.vqcm').forEach(qcm => {
    const btn = qcm.querySelector('.vqcm-validate');
    const resultDiv = qcm.querySelector('.vqcm-result');
    const feedbackEl = qcm.querySelector('.vfeedback');
    const corrBtn = qcm.querySelector('.vqcm-show-correction');
    const options = qcm.querySelectorAll('.vqcm-options li');
    const inputs = qcm.querySelectorAll('input[type="radio"], input[type="checkbox"]');

    // Click on li selects the input
    options.forEach(li => {
      li.addEventListener('click', function(e) {
        if (e.target.tagName === 'INPUT') return;
        const input = this.querySelector('input');
        if (!input || input.disabled) return;
        if (input.type === 'radio') {
          inputs.forEach(i => { i.checked = false; i.closest('li').classList.remove('selected','incorrect-show'); });
          input.checked = true;
          this.classList.add('selected');
        } else {
          input.checked = !input.checked;
          this.classList.toggle('selected', input.checked);
          this.classList.remove('incorrect-show');
        }
        // Clear previous result message when user changes selection
        if (resultDiv) resultDiv.style.display = 'none';
      });
    });

    // Validate — only shows if wrong, user can retry
    if (btn) {
      btn.addEventListener('click', function() {
        // Check if anything is selected
        const anySelected = [...inputs].some(i => i.checked);
        if (!anySelected) return;

        let allCorrect = true;
        options.forEach(li => {
          const input = li.querySelector('input');
          const isCorrect = li.dataset.correct === 'true';
          const isSelected = input && input.checked;

          li.classList.remove('correct-show','incorrect-show');

          if (isSelected && !isCorrect) {
            li.classList.add('incorrect-show');
            allCorrect = false;
          }
          if (!isSelected && isCorrect) {
            allCorrect = false;
          }
        });

        if (resultDiv) {
          resultDiv.style.display = 'block';
          if (allCorrect) {
            // Correct! Show success, highlight correct answers, disable inputs
            resultDiv.className = 'vqcm-result correct';
            resultDiv.textContent = 'Bonne réponse !';
            options.forEach(li => {
              const isCorrect = li.dataset.correct === 'true';
              if (isCorrect) li.classList.add('correct-show');
              const input = li.querySelector('input');
              if (input) input.disabled = true;
            });
            btn.disabled = true;
            if (corrBtn) corrBtn.style.display = 'none';
            if (feedbackEl) feedbackEl.style.display = 'block';
          } else {
            // Wrong — show message but keep interactive
            resultDiv.className = 'vqcm-result incorrect';
            resultDiv.textContent = 'Réponse incorrecte — réessayez ou cliquez sur « Voir la correction ».';
            // Show correction button
            if (corrBtn) corrBtn.style.display = 'inline-block';
          }
        }
      });
    }

    // Show correction — reveals correct answers, locks the QCM
    if (corrBtn) {
      corrBtn.addEventListener('click', function() {
        options.forEach(li => {
          const input = li.querySelector('input');
          const isCorrect = li.dataset.correct === 'true';
          li.classList.remove('selected','incorrect-show','correct-show');
          if (isCorrect) li.classList.add('correct-show');
          if (input) input.disabled = true;
        });
        if (resultDiv) {
          resultDiv.style.display = 'block';
          resultDiv.className = 'vqcm-result incorrect';
          resultDiv.textContent = 'Voici la bonne réponse :';
        }
        btn.disabled = true;
        corrBtn.style.display = 'none';
        if (feedbackEl) feedbackEl.style.display = 'block';
      });
    }
  });

  // ── Drag & Drop pour exercices de réarrangement
  document.querySelectorAll('.vdrag-zone').forEach(zone => {
    let draggedItem = null;

    zone.querySelectorAll('.vdrag-item').forEach(item => {
      item.setAttribute('draggable', 'true');

      item.addEventListener('dragstart', function(e) {
        draggedItem = this;
        this.style.opacity = '0.5';
        e.dataTransfer.effectAllowed = 'move';
      });

      item.addEventListener('dragend', function() {
        this.style.opacity = '1';
        zone.querySelectorAll('.vdrag-item').forEach(i => i.classList.remove('drag-over'));
      });

      item.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        this.classList.add('drag-over');
      });

      item.addEventListener('dragleave', function() {
        this.classList.remove('drag-over');
      });

      item.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('drag-over');
        if (draggedItem !== this) {
          const allItems = [...zone.querySelectorAll('.vdrag-item')];
          const fromIdx = allItems.indexOf(draggedItem);
          const toIdx = allItems.indexOf(this);
          if (fromIdx < toIdx) {
            zone.insertBefore(draggedItem, this.nextSibling);
          } else {
            zone.insertBefore(draggedItem, this);
          }
        }
      });

      // Touch support
      let touchStartY = 0;
      item.addEventListener('touchstart', function(e) {
        draggedItem = this;
        touchStartY = e.touches[0].clientY;
        this.style.opacity = '0.7';
      }, { passive: true });

      item.addEventListener('touchmove', function(e) {
        e.preventDefault();
        const touch = e.touches[0];
        const target = document.elementFromPoint(touch.clientX, touch.clientY);
        if (target && target.closest('.vdrag-item') && target.closest('.vdrag-item') !== draggedItem) {
          const over = target.closest('.vdrag-item');
          zone.querySelectorAll('.vdrag-item').forEach(i => i.classList.remove('drag-over'));
          over.classList.add('drag-over');
        }
      });

      item.addEventListener('touchend', function(e) {
        this.style.opacity = '1';
        const touch = e.changedTouches[0];
        const target = document.elementFromPoint(touch.clientX, touch.clientY);
        if (target) {
          const dropTarget = target.closest('.vdrag-item');
          if (dropTarget && dropTarget !== draggedItem) {
            const allItems = [...zone.querySelectorAll('.vdrag-item')];
            const fromIdx = allItems.indexOf(draggedItem);
            const toIdx = allItems.indexOf(dropTarget);
            if (fromIdx < toIdx) {
              zone.insertBefore(draggedItem, dropTarget.nextSibling);
            } else {
              zone.insertBefore(draggedItem, dropTarget);
            }
          }
        }
        zone.querySelectorAll('.vdrag-item').forEach(i => i.classList.remove('drag-over'));
      });
    });

    // Validate drag order + correction + retry
    const validateBtn = zone.parentElement.querySelector('.vdrag-validate');
    const correctionBtn = zone.parentElement.querySelector('.vdrag-correction');

    if (validateBtn) {
      validateBtn.addEventListener('click', function() {
        const items = zone.querySelectorAll('.vdrag-item');
        let allCorrect = true;
        items.forEach(item => {
          const currentIdx = [...zone.querySelectorAll('.vdrag-item')].indexOf(item);
          const correctIdx = parseInt(item.dataset.order);
          item.classList.remove('correct-pos', 'incorrect-pos');
          if (currentIdx === correctIdx) {
            item.classList.add('correct-pos');
          } else {
            item.classList.add('incorrect-pos');
            allCorrect = false;
          }
          // Disable drag during review
          item.setAttribute('draggable', 'false');
          item.style.cursor = 'default';
        });
        validateBtn.disabled = true;
        // Show correction button if not all correct
        if (correctionBtn && !allCorrect) {
          correctionBtn.style.display = 'inline-block';
          correctionBtn.dataset.state = 'show';
          correctionBtn.textContent = 'Voir la correction';
        }
      });
    }

    if (correctionBtn) {
      correctionBtn.addEventListener('click', function() {
        const state = this.dataset.state;
        const items = [...zone.querySelectorAll('.vdrag-item')];

        if (state === 'show') {
          // Show correct order: sort items by data-order
          const sorted = items.slice().sort((a, b) => parseInt(a.dataset.order) - parseInt(b.dataset.order));
          sorted.forEach(item => {
            zone.appendChild(item);
            // Mark: green if user had it right, red if user had it wrong
            const wasCorrect = item.classList.contains('correct-pos');
            item.classList.remove('correct-pos', 'incorrect-pos');
            if (wasCorrect) {
              item.classList.add('correct-pos');
            } else {
              item.classList.add('incorrect-pos');
            }
          });
          this.dataset.state = 'retry';
          this.textContent = 'Réessayer';
        } else if (state === 'retry') {
          // Reset: shuffle items, clear colors, re-enable drag
          const shuffled = items.slice().sort(() => Math.random() - 0.5);
          shuffled.forEach(item => {
            zone.appendChild(item);
            item.classList.remove('correct-pos', 'incorrect-pos');
            item.setAttribute('draggable', 'true');
            item.style.cursor = 'grab';
          });
          validateBtn.disabled = false;
          this.style.display = 'none';
          this.dataset.state = 'show';
        }
      });
    }
  });

  // ── Textarea auto-resize
  document.querySelectorAll('.vtext-answer').forEach(ta => {
    function autoResize() {
      ta.style.height = 'auto';
      ta.style.height = ta.scrollHeight + 'px';
    }
    ta.addEventListener('input', autoResize);
    autoResize();
  });

});
</script>
"""

# ─────────────────────────────────────────────────────────────────────────────
# Pré-traitement MD
# ─────────────────────────────────────────────────────────────────────────────

def _icon_media_type(icon):
    return {"📷":"photo","📐":"schema","🎬":"video","📊":"infographie","🧊":"modele-3d"}.get(icon,"photo")

def preprocess_md(md_text: str) -> str:
    """Pré-traite le MD : tags MEDIA, encadrés, exercices."""

    # ── Tags MEDIA
    def _repl_media(m):
        icon, code, desc = m.group(1), m.group(2), m.group(3).strip()
        mtype = _icon_media_type(icon)
        return (
            f'\n<div class="vmedia">'
            f'<span class="vmedia-icon">{icon}</span>'
            f'<span class="vmedia-code">{code}</span>'
            f'<div class="vmedia-desc">{desc}</div>'
            f'<div class="vmedia-note">Média à intégrer — {mtype.upper()}</div>'
            f'</div>\n'
        )
    md_text = re.sub(
        r'>\s*\[MEDIA:\s*(📷|📐|🎬|📊|🧊)\s*(\S+)\s*[-—]+\s*(.+?)\]',
        _repl_media, md_text
    )

    # ── Encadrés pédagogiques (blockquotes avec emoji)
    box_map = [
        ("🏥", r"Mise en situation|Cas clinique|Pertinence clinique|Cas —|Pertinence clinique directe", "clinique"),
        ("⚠️", r"Danger|Piège|Alerte|Piège clinique|Piège à connaître", "danger"),
        ("📖", r"Approfondissement", "approfondi"),
        ("💡", r"Mnémonique|Astuce|Astuce clinique", "astuce"),
        ("🔬", r"Expert", "expert"),
        ("🤔", r"Question de réflexion", "reflexion"),
        ("⚖️", r"Controverse", "controverse"),
    ]
    for emoji, title_re, css in box_map:
        esc = re.escape(emoji)
        pat = (
            r'(?:^|\n)>\s*' + esc + r'\s*\*{0,2}(' + title_re + r'[^*\n]*)\*{0,2}\s*[:—]?\s*'
            r'((?:.+?)(?:\n>.*?)*?)(?=\n(?!>)|\n\n|\Z)'
        )
        def _repl_box(m, _css=css):
            title = m.group(1).strip().rstrip(':—').strip()
            body = re.sub(r'\n>\s?', '\n', m.group(2).strip())
            # Convertir le markdown inline (gras, italique) dans le body
            body = re.sub(r'\*\*\*(.+?)\*\*\*', r'<strong><em>\1</em></strong>', body)
            body = re.sub(r'\*\*(.+?)\*\*', r'<strong>\1</strong>', body)
            body = re.sub(r'\*(.+?)\*', r'<em>\1</em>', body)
            # Convertir les sauts de ligne en <br>
            body = body.replace('\n', '<br>\n')
            return (
                f'\n<div class="vbox {_css}">'
                f'<span class="vbox-title">{title}</span>\n{body}\n'
                f'</div>\n'
            )
        md_text = re.sub(pat, _repl_box, md_text, flags=re.DOTALL)

    # ── Micro-exercices interactifs
    _ex_counter = [0]

    def _repl_exercice(m):
        _ex_counter[0] += 1
        eid = f'ex_{_ex_counter[0]}'
        title = m.group(1).strip()
        body = m.group(2).strip()
        parts = re.split(r'\n>\s*\*Réponse\s*[:：]\s*', body, maxsplit=1)
        question_raw = re.sub(r'\n>\s?', '\n', parts[0].strip())
        answer = parts[1].strip().rstrip('*') if len(parts) > 1 else ""

        html = f'\n<div class="vexercice" id="{eid}"><div class="vexercice-title">{title}</div>\n'

        # --- Détection du type d'exercice ---

        # TYPE 1 : Classez / Réarrangez → drag & drop
        if re.search(r'[Cc]lassez|[Rr]éarrangez|[Oo]rdonnez|[Rr]emettez.*ordre', question_raw):
            # Séparer l'énoncé des items
            lines = question_raw.split('\n')
            enonce_lines = []
            items = []
            for line in lines:
                item_match = re.match(r'\s*-\s*\(([A-Z])\)\s*(.+)', line)
                if item_match:
                    items.append((item_match.group(1), item_match.group(2).strip()))
                else:
                    enonce_lines.append(line)

            html += f'<p>{"<br>".join(enonce_lines)}</p>\n'

            if items:
                # Mélanger les items pour l'exercice
                import random
                correct_order = [(letter, text) for letter, text in items]
                shuffled = list(enumerate(items))
                random.shuffle(shuffled)

                html += '<div class="vdrag-zone">\n'
                for orig_idx, (letter, text) in shuffled:
                    html += (
                        f'<div class="vdrag-item" data-order="{orig_idx}">'
                        f'<span class="drag-handle"></span>'
                        f'<span>({letter}) {text}</span></div>\n'
                    )
                html += '</div>\n'
                html += f'<button class="vqcm-validate vdrag-validate" type="button">Vérifier l\'ordre</button>\n'
                html += f'<button class="vqcm-validate vdrag-correction" type="button" style="display:none; margin-left:10px; background:#78909C;">Voir la correction</button>\n'
                html += f'<div class="vqcm-result" id="{eid}_result"></div>\n'

        # TYPE 2 : Questions numérotées (1. ... 2. ... 3. ...) → textarea par question
        elif re.search(r'\n\d+\.\s', question_raw):
            lines = question_raw.split('\n')
            enonce_lines = []
            questions = []
            for line in lines:
                q_match = re.match(r'\s*(\d+)\.\s+(.+)', line)
                if q_match:
                    questions.append((q_match.group(1), q_match.group(2).strip()))
                else:
                    enonce_lines.append(line)

            html += f'<p>{"<br>".join(enonce_lines)}</p>\n'

            for num, qtxt in questions:
                html += (
                    f'<div style="margin:12px 0;">'
                    f'<label for="{eid}_q{num}" style="font-weight:600;color:#00695C;">'
                    f'{num}. {qtxt}</label><br>'
                    f'<textarea class="vtext-answer" id="{eid}_q{num}" '
                    f'placeholder="Rédigez votre réponse ici..."></textarea>'
                    f'</div>\n'
                )

        # TYPE 3 : Question ouverte simple → un seul textarea
        else:
            html += f'<p>{question_raw}</p>\n'
            html += (
                f'<textarea class="vtext-answer" id="{eid}_answer" '
                f'placeholder="Rédigez votre réponse ici..."></textarea>\n'
            )

        # Feedback dépliable
        if answer:
            html += (
                f'<details class="vfeedback" style="margin-top:14px;">'
                f'<summary>Voir la correction</summary>'
                f'<div class="fb-content">{answer}</div></details>\n'
            )

        html += '</div>\n'
        return html

    md_text = re.sub(
        r'✏️\s*\*{0,2}(Micro-exercice|Exercice)[^*]*\*{0,2}\s*[:—]\s*(.+?)(?=\n\n(?!>)|(?=\n## )|\Z)',
        _repl_exercice, md_text, flags=re.DOTALL
    )

    return md_text


# ─────────────────────────────────────────────────────────────────────────────
# Post-traitement HTML : QCM interactifs fonctionnels
# ─────────────────────────────────────────────────────────────────────────────

_qcm_counter = 0

def postprocess_html(html: str) -> str:
    """Post-traite le HTML : QCM fonctionnels, points clés, références, transitions."""
    global _qcm_counter
    _qcm_counter = 0

    html = _transform_qcm(html)
    html = _transform_qcm_raw(html)

    # Points clés
    html = re.sub(
        r'<h2([^>]*)>([^<]*Points clés[^<]*)</h2>\s*((?:<ol>.*?</ol>|<ul>.*?</ul>))',
        lambda m: f'<div class="vpoints-cles"><div class="vpoints-cles-title">{m.group(2)}</div>{m.group(3)}</div>',
        html, flags=re.DOTALL
    )

    # Références
    html = re.sub(
        r'<h2([^>]*)>([^<]*Référence[^<]*)</h2>\s*((?:<ul>.*?</ul>|<p>.*?</p>|<li>.*)+)',
        lambda m: f'<div class="vrefs"><div class="vrefs-title">{m.group(2)}</div>{m.group(3)}</div>',
        html, flags=re.DOTALL
    )

    # Transitions
    html = re.sub(
        r'<p><strong>Transition</strong>\s*[:：]\s*(.*?)</p>',
        lambda m: f'<div class="vtransition">{m.group(1)}</div>',
        html, flags=re.DOTALL
    )

    # Feedback restants (blockquotes)
    html = re.sub(
        r'<blockquote>\s*<p>\s*<em>(?:Feedback|Réponse|Réponse attendue)\s*[:：]\s*(.*?)</em>\s*</p>\s*</blockquote>',
        lambda m: f'<details class="vfeedback"><summary>Voir la réponse</summary><div class="fb-content">{m.group(1)}</div></details>',
        html, flags=re.DOTALL
    )

    # Exercices de classement : détecte les listes (A) (B) (C)... dans les vexercice
    html = _transform_ordering_exercises(html)

    # Cas cliniques interactifs : Q1/Q2 → textarea + feedback dépliable
    html = _transform_cas_cliniques(html)

    # Questions de synthèse 💎 → textarea + feedback dépliable
    html = _transform_questions_synthese(html)

    return html


def _transform_qcm(html: str) -> str:
    """Transforme les QCM en composants interactifs avec radio/checkbox."""
    global _qcm_counter
    badge_map = {'🥉':'bronze','🥈':'argent','🥇':'or','💎':'diamant'}
    badge_labels = {'🥉':'Bronze','🥈':'Argent','🥇':'Or','💎':'Diamant'}

    pattern = (
        r'<p><strong>(QCM\s*\d+)</strong>\s*('
        + '|'.join(re.escape(e) for e in badge_map)
        + r')\s*[:：]\s*(.*?)</p>\s*'
        r'<ul>\s*(.*?)</ul>\s*'
        r'(?:<blockquote>\s*<p>\s*<em>(?:Feedback|Réponse)\s*[:：]\s*(.*?)</em>\s*</p>\s*</blockquote>)?'
    )

    def _repl(m):
        global _qcm_counter
        _qcm_counter += 1
        qid = f'qcm_{_qcm_counter}'
        label = m.group(1)
        emoji = m.group(2)
        question = m.group(3).strip()
        opts_html = m.group(4)
        feedback = m.group(5) or ""

        bcls = badge_map.get(emoji, 'bronze')
        btxt = badge_labels.get(emoji, 'Bronze')

        # Parse options
        opts = re.findall(r'<li>(.*?)</li>', opts_html, re.DOTALL)
        correct_count = sum(1 for o in opts if '✅' in o)
        input_type = 'checkbox' if correct_count > 1 else 'radio'

        opts_out = ''
        for i, opt in enumerate(opts):
            is_correct = '✅' in opt
            clean = opt.replace('✅','').strip()
            dc = 'true' if is_correct else 'false'
            opts_out += (
                f'<li data-correct="{dc}">'
                f'<input type="{input_type}" name="{qid}" id="{qid}_{i}">'
                f'<label for="{qid}_{i}">{clean}</label>'
                f'</li>\n'
            )

        r = (
            f'<div class="vqcm">'
            f'<div class="vqcm-header">'
            f'<span class="vqcm-badge {bcls}">{emoji} {btxt}</span>'
            f'<span>{label}</span></div>'
            f'<div class="vqcm-question">{question}</div>'
            f'<ul class="vqcm-options">{opts_out}</ul>'
            f'<button class="vqcm-validate" type="button">Valider ma réponse</button>'
            f'<button class="vqcm-validate vqcm-show-correction" type="button" '
            f'style="display:none; margin-left:10px; background:#78909C;">Voir la correction</button>'
            f'<div class="vqcm-result"></div>'
        )

        if feedback:
            r += (
                f'<details class="vfeedback" style="display:none">'
                f'<summary>Voir l\'explication</summary>'
                f'<div class="fb-content">{feedback}</div></details>'
            )

        r += '</div>'
        return r

    return re.sub(pattern, _repl, html, flags=re.DOTALL)


def _transform_qcm_raw(html: str) -> str:
    """Transforme les QCM en format texte brut (- A) ... dans un <p>) en composants interactifs.
    Gère le cas où markdown n'a pas converti les options en <ul><li>."""
    global _qcm_counter
    badge_map = {'🥉':'bronze','🥈':'argent','🥇':'or','💎':'diamant'}
    badge_labels = {'🥉':'Bronze','🥈':'Argent','🥇':'Or','💎':'Diamant'}

    # Pattern : <p><strong>QCM N</strong> 🥉 : question\n- A) option\n- B) option ✅\n...</p>
    # Suivi optionnellement d'un <details> feedback
    pattern = (
        r'<p><strong>(QCM\s*\d+)</strong>\s*('
        + '|'.join(re.escape(e) for e in badge_map)
        + r')\s*[:：]\s*(.*?)\n'
        r'((?:\s*-\s*[A-Z]\).*?\n?)+)'
        r'</p>\s*'
        r'(?:<details class="vfeedback"><summary>[^<]*</summary><div class="fb-content">(.*?)</div></details>)?'
    )

    def _repl(m):
        global _qcm_counter
        _qcm_counter += 1
        qid = f'qcm_{_qcm_counter}'
        label = m.group(1)
        emoji = m.group(2)
        question = m.group(3).strip()
        opts_raw = m.group(4).strip()
        feedback = m.group(5) or ""

        bcls = badge_map.get(emoji, 'bronze')
        btxt = badge_labels.get(emoji, 'Bronze')

        # Parse options: - A) text ✅
        opts = re.findall(r'-\s*([A-Z])\)\s*(.+?)(?:\n|$)', opts_raw)
        correct_count = sum(1 for _, t in opts if '✅' in t)
        input_type = 'checkbox' if correct_count > 1 else 'radio'

        opts_out = ''
        for i, (letter, text) in enumerate(opts):
            is_correct = '✅' in text
            clean = text.replace('✅', '').strip()
            dc = 'true' if is_correct else 'false'
            opts_out += (
                f'<li data-correct="{dc}">'
                f'<input type="{input_type}" name="{qid}" id="{qid}_{i}">'
                f'<label for="{qid}_{i}">{letter}) {clean}</label>'
                f'</li>\n'
            )

        r = (
            f'<div class="vqcm">'
            f'<div class="vqcm-header">'
            f'<span class="vqcm-badge {bcls}">{emoji} {btxt}</span>'
            f'<span>{label}</span></div>'
            f'<div class="vqcm-question">{question}</div>'
            f'<ul class="vqcm-options">{opts_out}</ul>'
            f'<button class="vqcm-validate" type="button">Valider ma réponse</button>'
            f'<button class="vqcm-validate vqcm-show-correction" type="button" '
            f'style="display:none; margin-left:10px; background:#78909C;">Voir la correction</button>'
            f'<div class="vqcm-result"></div>'
        )

        if feedback:
            r += (
                f'<details class="vfeedback" style="display:none">'
                f'<summary>Voir l\'explication</summary>'
                f'<div class="fb-content">{feedback}</div></details>'
            )

        r += '</div>'
        return r

    html = re.sub(pattern, _repl, html, flags=re.DOTALL)
    return html


def _transform_ordering_exercises(html: str) -> str:
    """Transforme les exercices de classement/réarrangement en drag & drop."""
    # Détecte les patterns : "Classez dans l'ordre" suivi de - (A) ... - (B) ...
    # dans les divs vexercice
    pattern = r'(<div class="vexercice">.*?Classez.*?<ul>\s*(.*?)</ul>)'

    def _repl(m):
        full = m.group(0)
        items_html = m.group(2)
        items = re.findall(r'<li>\s*\(([A-Z])\)\s*(.*?)\s*</li>', items_html, re.DOTALL)
        if not items or len(items) < 3:
            return full  # pas assez d'items, on laisse tel quel

        # Mélanger pour le drag & drop (ordre alphabétique inversé pour que l'exercice ait du sens)
        import random
        indexed = [(i, letter, text) for i, (letter, text) in enumerate(items)]
        shuffled = indexed.copy()
        random.shuffle(shuffled)

        drag_items = ''
        for orig_idx, letter, text in shuffled:
            drag_items += (
                f'<div class="vdrag-item" data-order="{orig_idx}">'
                f'<span class="drag-handle"></span>'
                f'<span>({letter}) {text}</span></div>\n'
            )

        drag_html = (
            f'<div class="vdrag-zone">{drag_items}</div>'
            f'<button class="vqcm-validate vdrag-validate" type="button">Vérifier l\'ordre</button>'
            f'<button class="vqcm-validate vdrag-correction" type="button" style="display:none; margin-left:10px; background:#78909C;">Voir la correction</button>'
        )

        # Remplacer la <ul> par le drag zone
        return full.replace(f'<ul>\n{items_html}</ul>', drag_html).replace(f'<ul>{items_html}</ul>', drag_html)

    return re.sub(pattern, _repl, html, flags=re.DOTALL)


_cas_counter = [0]

def _transform_cas_cliniques(html: str) -> str:
    """Transforme les questions Q1/Q2 dans les cas cliniques en textarea interactifs."""
    # Pattern : **Q1** 🥇 : question\n> *Réponse : texte*
    # Dans les blocs .vbox.clinique ou blockquotes

    def _repl_question(m):
        _cas_counter[0] += 1
        qid = f'cas_q{_cas_counter[0]}'
        qlabel = m.group(1)  # Q1, Q2
        badge = m.group(2)   # 🥇, 🥈
        question = m.group(3).strip()
        answer = m.group(4).strip().rstrip('*') if m.group(4) else ""

        badge_map = {'🥉': 'bronze', '🥈': 'argent', '🥇': 'or', '💎': 'diamant'}
        badge_labels = {'🥉': 'Bronze', '🥈': 'Argent', '🥇': 'Or', '💎': 'Diamant'}
        bcls = badge_map.get(badge, 'or')
        btxt = badge_labels.get(badge, 'Or')

        r = (
            f'<div style="margin:16px 0; padding:14px; background:#FFF3E0; '
            f'border-radius:8px; border-left:4px solid #E65100;">'
            f'<div style="margin-bottom:8px;">'
            f'<span class="vqcm-badge {bcls}">{badge} {btxt}</span> '
            f'<strong style="color:#E65100;">{qlabel}</strong> : {question}'
            f'</div>'
            f'<textarea class="vtext-answer" id="{qid}" '
            f'placeholder="Rédigez votre réponse ici..."></textarea>'
        )

        if answer:
            r += (
                f'<details class="vfeedback" style="margin-top:10px;">'
                f'<summary>Voir la réponse attendue</summary>'
                f'<div class="fb-content">{answer}</div></details>'
            )

        r += '</div>'
        return r

    # Matcher : **Q1** 🥇 : question\n> *Réponse : texte*
    # ou : <strong>Q1</strong> 🥇 : question ... <em>Réponse : texte</em>
    pattern = (
        r'<strong>(Q\d+)</strong>\s*('
        + '|'.join(re.escape(e) for e in ['🥉','🥈','🥇','💎'])
        + r')\s*[:：]\s*(.*?)'
        r'(?:\n>\s*\*(?:Réponse|Réponse attendue)\s*[:：]\s*(.*?)\*)?'
        r'(?=\s*(?:<strong>Q\d+|</div>|\n>?\s*<strong>|\Z))'
    )
    html = re.sub(pattern, _repl_question, html, flags=re.DOTALL)

    # Aussi matcher le format HTML (après conversion markdown)
    pattern_html = (
        r'<strong>(Q\d+)</strong>\s*('
        + '|'.join(re.escape(e) for e in ['🥉','🥈','🥇','💎'])
        + r')\s*[:：]\s*(.*?)'
        r'(?:<br\s*/?>)?\s*'
        r'(?:<em>(?:Réponse|Réponse attendue)\s*[:：]\s*(.*?)</em>)?'
        r'(?=\s*(?:<strong>Q\d+|</div>|<hr|$))'
    )
    html = re.sub(pattern_html, _repl_question, html, flags=re.DOTALL)

    return html


_synth_counter = [0]

def _transform_questions_synthese(html: str) -> str:
    """Transforme les questions de synthèse 💎 en textarea interactif."""

    def _repl_synth(m):
        _synth_counter[0] += 1
        sid = f'synth_{_synth_counter[0]}'
        question = m.group(1).strip()

        r = (
            f'<div class="vexercice" style="border-color:#00ACC1; background:#E0F7FA;">'
            f'<div class="vexercice-title" style="color:#006064;">💎 Question de synthèse</div>'
            f'<p>{question}</p>'
            f'<textarea class="vtext-answer" id="{sid}" rows="6" '
            f'placeholder="Développez votre réponse ici (8-10 lignes)..."></textarea>'
            f'</div>'
        )
        return r

    # Pattern : 💎 **Question ouverte** : texte
    html = re.sub(
        r'<p>💎\s*<strong>Question ouverte</strong>\s*[:：]\s*(.*?)</p>',
        _repl_synth, html, flags=re.DOTALL
    )

    return html


# ─────────────────────────────────────────────────────────────────────────────
# Sidebar : génération depuis les headings
# ─────────────────────────────────────────────────────────────────────────────

def build_sidebar_and_ids(html: str) -> tuple:
    """Ajoute des id aux h2/h3, construit la sidebar HTML."""
    counter = [0]

    def _add_id(m):
        tag = m.group(1)
        attrs = m.group(2) or ""
        content = m.group(3)

        # Si déjà un id, le garder
        if 'id="' in attrs:
            hid = re.search(r'id="([^"]*)"', attrs).group(1)
        else:
            counter[0] += 1
            slug = re.sub(r'<[^>]+>', '', content)
            slug = re.sub(r'[^a-zA-Z0-9\u00C0-\u024F]+', '-', slug.lower()).strip('-')[:60]
            hid = f"s-{counter[0]}-{slug}"
            attrs = f' id="{hid}"' + attrs

        return f'<{tag}{attrs}>{content}</{tag}>', tag, hid, re.sub(r'<[^>]+>', '', content).strip()

    # Collecter les headings
    toc_items = []
    new_html = html

    for m in re.finditer(r'<(h[23])(\s[^>]*)?>(.+?)</\1>', html, re.DOTALL):
        replacement, tag, hid, clean = _add_id(m)
        new_html = new_html.replace(m.group(0), replacement, 1)
        css_class = 'toc-h3' if tag == 'h3' else ''
        toc_items.append(f'<li><a href="#{hid}" class="{css_class}">{clean}</a></li>')

    sidebar_html = (
        '<nav class="vertex-sidebar">'
        '<div class="vertex-sidebar-title">Sommaire</div>'
        '<ul>' + '\n'.join(toc_items) + '</ul>'
        '</nav>'
    )

    return sidebar_html, new_html


# ─────────────────────────────────────────────────────────────────────────────
# Pipeline principal
# ─────────────────────────────────────────────────────────────────────────────

def convert_cours_to_html(md_text: str, color: str = "#1565C0") -> str:
    """Pipeline complet MD → HTML interactif Moodle."""

    # 1. Pré-traitement
    md_text = preprocess_md(md_text)

    # 2. MD → HTML
    html = markdown.markdown(md_text, extensions=["extra", "tables", "sane_lists"])

    # 3. Post-traitement interactif (QCM, points clés, etc.)
    html = postprocess_html(html)

    # 4. Sidebar
    sidebar_html, html = build_sidebar_and_ids(html)

    # 5. Assemblage final
    color_css = f'<style>:root {{ --vertex-primary: {color}; }}</style>'

    full = (
        f'<!DOCTYPE html><html lang="fr"><head>'
        f'<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">'
        f'<title>VERTEX© — Cours interactif</title>'
        f'{ASSETS}{color_css}'
        f'</head><body>'
        f'<div class="vertex-wrapper">'
        f'{sidebar_html}'
        f'<main class="vertex-content">'
        f'{html}'
        f'<div class="vertex-footer">VERTEX© — Virtual Environment for Real-Time EXpertise<br/>'
        f'Formation médicale e-learning — doctraining.ma</div>'
        f'</main></div>'
        f'</body></html>'
    )

    return full


# ─────────────────────────────────────────────────────────────────────────────
# Formations
# ─────────────────────────────────────────────────────────────────────────────

FORMATIONS = {
    "diabetologie": {"dir": "cours-diabetologie", "color": "#00838F", "name": "Diabétologie"},
    "scoliose": {"dir": "cours-scoliose", "color": "#1565C0", "name": "Scoliose"},
    "ptg": {"dir": "cours-ptg", "color": "#2E7D32", "name": "PTG"},
    "ioa": {"dir": "cours-infection-osseuse", "color": "#795548", "name": "IOA"},
    "tendinites": {"dir": "cours-tendinites", "color": "#E65100", "name": "Tendinites"},
    "obesite": {"dir": "cours-obesite-orthopedie", "color": "#6A1B9A", "name": "Obésité-Orthopédie"},
    "hta": {"dir": "cours-hta", "color": "#C62828", "name": "HTA"},
    "hypothyroidie": {"dir": "cours-hypothyroidie", "color": "#283593", "name": "Hypothyroïdies"},
    "hyperthyroidie": {"dir": "cours-hyperthyroidie", "color": "#EF6C00", "name": "Hyperthyroïdies"},
    "fiv": {"dir": "cours-fiv", "color": "#AD1457", "name": "FIV"},
    "histoire": {"dir": "cours-histoire-orthopedie", "color": "#4E342E", "name": "Histoire Orthopédie"},
    "lca": {"dir": "cours-lca", "color": "#00695C", "name": "LCA"},
}


def generate_one(md_path: Path, output_dir: Path, color: str, preview: bool = False):
    """Génère le HTML pour un fichier COURS_*.md."""
    md_text = md_path.read_text(encoding="utf-8")
    html = convert_cours_to_html(md_text, color)
    out_name = md_path.stem + ".html"
    out_path = output_dir / out_name
    out_path.write_text(html, encoding="utf-8")
    size_kb = len(html) / 1024
    print(f"  ✅ {out_name} ({size_kb:.0f} Ko)")
    if preview:
        import webbrowser
        webbrowser.open(f"file://{out_path}")
    return out_path


def generate_formation(key: str, config: dict, output_dir: Path, preview: bool = False):
    """Génère les HTML pour tous les COURS_*.md d'une formation."""
    d = PROJECT_ROOT / config["dir"]
    if not d.exists():
        print(f"  [SKIP] {key} — répertoire introuvable"); return 0
    files = sorted(d.glob("COURS_*.md"))
    if not files:
        print(f"  [SKIP] {key} — aucun COURS_*.md"); return 0
    fdir = output_dir / key
    fdir.mkdir(parents=True, exist_ok=True)
    print(f"\n  📘 {config['name']} — {len(files)} fichiers")
    count = 0
    for f in files:
        try:
            generate_one(f, fdir, config["color"], preview=(preview and count == 0))
            count += 1
        except Exception as e:
            print(f"  [ERR] {f.name}: {e}")
            import traceback; traceback.print_exc()
    return count


def main():
    parser = argparse.ArgumentParser(description="VERTEX© — Cours interactifs Moodle v2")
    parser.add_argument("--formation", default=None)
    parser.add_argument("--file", default=None)
    parser.add_argument("--output", default=None)
    parser.add_argument("--preview", action="store_true")
    parser.add_argument("--list", action="store_true")
    args = parser.parse_args()

    if args.list:
        print("\n  FORMATIONS (fichiers COURS_*.md)\n")
        for k, c in FORMATIONS.items():
            d = PROJECT_ROOT / c["dir"]
            n = len(list(d.glob("COURS_*.md"))) if d.exists() else 0
            print(f"  {k:<16} {c['name']:<25} {n}")
        print(); return

    output_dir = Path(args.output) if args.output else Path(__file__).parent / "cours_html"
    output_dir.mkdir(parents=True, exist_ok=True)

    if args.file:
        p = Path(args.file)
        if not p.exists():
            for c in FORMATIONS.values():
                cand = PROJECT_ROOT / c["dir"] / args.file
                if cand.exists(): p = cand; break
        if not p.exists():
            print(f"[ERR] Introuvable: {args.file}"); sys.exit(1)
        color = "#1565C0"
        for c in FORMATIONS.values():
            if c["dir"] in str(p): color = c["color"]; break
        print(f"\n  VERTEX© — Cours interactif v2\n  {p.name} → {output_dir}\n")
        generate_one(p, output_dir, color, args.preview)
        return

    formations = {args.formation: FORMATIONS[args.formation]} if args.formation else FORMATIONS
    total = 0
    print(f"\n{'='*60}\n  VERTEX© — Cours interactifs v2\n  Sortie: {output_dir}\n{'='*60}")
    for k, c in formations.items():
        total += generate_formation(k, c, output_dir, args.preview)
    print(f"\n{'='*60}\n  {total} fichiers générés → {output_dir}\n{'='*60}\n")


if __name__ == "__main__":
    main()
