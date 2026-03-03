<template>
  <div class="report-panel">
    <h3 class="panel-title">📄 Rapport clinique</h3>

    <div v-if="!spineId" class="no-model">
      <p>Créez un modèle de rachis pour générer un rapport.</p>
    </div>

    <div v-else class="report-controls">
      <div class="field">
        <label>Nom du patient</label>
        <input
          v-model="patientName"
          type="text"
          placeholder="Patient anonyme"
        />
      </div>

      <div class="field">
        <label>Généré par</label>
        <input
          v-model="generatedBy"
          type="text"
          placeholder="Dr. Martin"
        />
      </div>

      <button
        class="btn-report"
        @click="generateReport"
        :disabled="isGenerating"
      >
        <span v-if="isGenerating">⏳ Génération...</span>
        <span v-else>📥 Télécharger PDF</span>
      </button>

      <button
        class="btn-preview"
        @click="previewReport"
        :disabled="isGenerating"
      >
        👁️ Prévisualiser
      </button>
    </div>

    <!-- Résumé du dernier rapport -->
    <div v-if="lastReport" class="report-summary">
      <h4>Résumé</h4>
      <div class="summary-grid">
        <div class="metric">
          <span class="label">Angle de Cobb</span>
          <span class="value" :class="cobbClass">
            {{ lastReport.clinical_measurements?.cobb_angle_deg }}°
          </span>
        </div>
        <div class="metric">
          <span class="label">Sévérité</span>
          <span class="value">{{ lastReport.clinical_measurements?.scoliosis_severity }}</span>
        </div>
        <div class="metric">
          <span class="label">Pathologies</span>
          <span class="value">{{ lastReport.pathologies?.length || 0 }}</span>
        </div>
      </div>

      <div class="recommendations" v-if="lastReport.recommendations?.length">
        <strong>Recommandations :</strong>
        <ul>
          <li v-for="(rec, i) in lastReport.recommendations" :key="i">{{ rec }}</li>
        </ul>
      </div>
    </div>

    <div v-if="error" class="error-msg">⚠️ {{ error }}</div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  spineId: { type: String, default: null },
})

const patientName  = ref('Patient anonyme')
const generatedBy  = ref('VERTEX© Simulator')
const isGenerating = ref(false)
const lastReport   = ref(null)
const error        = ref('')

// Couleur selon sévérité Cobb
const cobbClass = computed(() => {
  const cobb = lastReport.value?.clinical_measurements?.cobb_angle_deg || 0
  if (cobb < 10) return 'green'
  if (cobb < 25) return 'yellow'
  if (cobb < 40) return 'orange'
  return 'red'
})

/**
 * Récupère les données de rapport depuis l'API
 */
async function fetchReport() {
  if (!props.spineId) return null
  error.value = ''

  const params = new URLSearchParams({
    patient_name: patientName.value,
    generated_by: generatedBy.value,
  })

  const response = await fetch(`/api/spine/${props.spineId}/report?${params}`)
  if (!response.ok) {
    const err = await response.json()
    throw new Error(err.error || 'Erreur API')
  }
  return response.json()
}

/**
 * Génère le PDF et le télécharge
 */
async function generateReport() {
  if (!props.spineId) return
  isGenerating.value = true
  error.value = ''

  try {
    const report = await fetchReport()
    lastReport.value = report

    // Import dynamique de jsPDF pour lazy loading
    const { jsPDF } = await import('jspdf')
    const { default: autoTable } = await import('jspdf-autotable')

    const doc = new jsPDF({ orientation: 'portrait', unit: 'mm', format: 'a4' })
    buildPDF(doc, report)

    const filename = `rapport_vertex_${report.metadata.report_id.slice(0, 8)}.pdf`
    doc.save(filename)

  } catch (e) {
    error.value = `Erreur : ${e.message}`
  } finally {
    isGenerating.value = false
  }
}

/**
 * Ouvre un aperçu HTML du rapport dans un nouvel onglet
 */
async function previewReport() {
  if (!props.spineId) return
  isGenerating.value = true
  error.value = ''

  try {
    const report = await fetchReport()
    lastReport.value = report

    const html = buildHTMLReport(report)
    const win  = window.open('', '_blank')
    win.document.write(html)
    win.document.close()

  } catch (e) {
    error.value = `Erreur : ${e.message}`
  } finally {
    isGenerating.value = false
  }
}

// ── Construction du PDF (jsPDF) ────────────────────────────────

function buildPDF(doc, report) {
  const { autoTable } = doc.__proto__.constructor
  const pageW  = 210
  const margin = 15
  let y = margin

  // ── En-tête ────────────────────────────────────────────────
  doc.setFillColor(15, 25, 35)
  doc.rect(0, 0, pageW, 35, 'F')

  doc.setTextColor(100, 180, 255)
  doc.setFontSize(20)
  doc.setFont('helvetica', 'bold')
  doc.text('VERTEX©', margin, 15)

  doc.setTextColor(200, 220, 240)
  doc.setFontSize(10)
  doc.setFont('helvetica', 'normal')
  doc.text('Simulateur biomécanique du rachis', margin, 22)
  doc.text(`Rapport généré le ${new Date(report.metadata.generated_at).toLocaleDateString('fr-FR')}`, margin, 28)

  y = 45

  // ── Section Patient ────────────────────────────────────────
  doc.setTextColor(30, 30, 30)
  doc.setFontSize(13)
  doc.setFont('helvetica', 'bold')
  doc.text('Informations patient', margin, y)
  y += 6

  const p = report.patient
  autoTable(doc, {
    startY: y,
    margin: { left: margin, right: margin },
    head: [['Paramètre', 'Valeur']],
    body: [
      ['Nom', p.name],
      ['Âge', `${p.age} ans`],
      ['Sexe', p.sex === 'M' ? 'Masculin' : 'Féminin'],
      ['Poids', `${p.weight_kg} kg`],
      ['Taille', `${p.height_cm} cm`],
      ['IMC', `${p.bmi} kg/m²`],
      ['Score T (ostéoporose)', p.tscore.toFixed(1)],
    ],
    styles: { fontSize: 9 },
    headStyles: { fillColor: [15, 25, 60] },
    alternateRowStyles: { fillColor: [245, 247, 252] },
  })
  y = doc.lastAutoTable.finalY + 10

  // ── Mesures cliniques ──────────────────────────────────────
  doc.setFontSize(13)
  doc.setFont('helvetica', 'bold')
  doc.text('Mesures cliniques', margin, y)
  y += 6

  const cm = report.clinical_measurements
  autoTable(doc, {
    startY: y,
    margin: { left: margin, right: margin },
    head: [['Mesure', 'Valeur', 'Interprétation']],
    body: [
      ['Angle de Cobb maximal', `${cm.cobb_angle_deg}°`, cm.scoliosis_severity],
      ['Déviation latérale max.', `${cm.max_lateral_deviation_mm} mm`, cm.max_lateral_deviation_mm > 10 ? 'Significative' : 'Normale'],
      ['Cyphose thoracique', `${cm.thoracic_kyphosis_deg}°`, cm.thoracic_kyphosis_deg > 55 ? 'Augmentée' : cm.thoracic_kyphosis_deg < 20 ? 'Réduite' : 'Normale'],
      ['Lordose lombaire', `${cm.lumbar_lordosis_deg}°`, cm.lumbar_lordosis_deg < 30 ? 'Réduite' : cm.lumbar_lordosis_deg > 65 ? 'Augmentée' : 'Normale'],
      ['Hauteur rachis instrument.', `${cm.total_spine_height_mm} mm`, ''],
    ],
    styles: { fontSize: 9 },
    headStyles: { fillColor: [15, 25, 60] },
    alternateRowStyles: { fillColor: [245, 247, 252] },
  })
  y = doc.lastAutoTable.finalY + 10

  // ── Pathologies ────────────────────────────────────────────
  if (report.pathologies?.length > 0) {
    doc.setFontSize(13)
    doc.setFont('helvetica', 'bold')
    doc.text('Pathologies détectées', margin, y)
    y += 6

    autoTable(doc, {
      startY: y,
      margin: { left: margin, right: margin },
      head: [['Type', 'Localisation', 'Sévérité', 'Détail']],
      body: report.pathologies.map(p => [p.type, p.location, p.severity, p.detail]),
      styles: { fontSize: 9 },
      headStyles: { fillColor: [120, 30, 30] },
      alternateRowStyles: { fillColor: [252, 245, 245] },
    })
    y = doc.lastAutoTable.finalY + 10
  }

  // ── Recommandations ────────────────────────────────────────
  if (report.recommendations?.length > 0) {
    if (y > 240) { doc.addPage(); y = margin }

    doc.setFontSize(13)
    doc.setFont('helvetica', 'bold')
    doc.text('Recommandations cliniques', margin, y)
    y += 6

    doc.setFontSize(9)
    doc.setFont('helvetica', 'normal')
    for (const rec of report.recommendations) {
      doc.text(`• ${rec}`, margin + 3, y)
      y += 6
      if (y > 270) { doc.addPage(); y = margin }
    }
  }

  // ── Pied de page ───────────────────────────────────────────
  const pageCount = doc.internal.getNumberOfPages()
  for (let i = 1; i <= pageCount; i++) {
    doc.setPage(i)
    doc.setFontSize(8)
    doc.setTextColor(150)
    doc.text(
      `VERTEX© — Rapport automatisé | Page ${i}/${pageCount} | À titre pédagogique uniquement`,
      pageW / 2, 290, { align: 'center' }
    )
  }
}

// ── Construction HTML (pour aperçu) ───────────────────────────

function buildHTMLReport(report) {
  const p  = report.patient
  const cm = report.clinical_measurements
  const patos = report.pathologies || []
  const recs  = report.recommendations || []

  return `<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Rapport VERTEX© — ${p.name}</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 2cm; color: #1a1a2e; }
    h1 { color: #3b82f6; }
    h2 { color: #1e3a5f; border-bottom: 2px solid #3b82f6; padding-bottom: 4px; }
    table { width: 100%; border-collapse: collapse; margin: 1rem 0; }
    th { background: #1e3a5f; color: white; padding: 6px 10px; text-align: left; }
    td { padding: 5px 10px; border-bottom: 1px solid #e5e7eb; }
    tr:nth-child(even) { background: #f8fafc; }
    .severity-légère { color: #f59e0b; }
    .severity-modérée { color: #f97316; }
    .severity-sévère { color: #ef4444; font-weight: bold; }
    .footer { margin-top: 3rem; font-size: 0.75rem; color: #94a3b8; text-align: center; }
    @media print { body { margin: 1cm; } }
  </style>
</head>
<body>
  <h1>🦴 VERTEX© — Rapport d'analyse du rachis</h1>
  <p>Généré le ${new Date(report.metadata.generated_at).toLocaleString('fr-FR')} par ${report.metadata.generated_by}</p>

  <h2>Patient</h2>
  <table>
    <tr><th>Paramètre</th><th>Valeur</th></tr>
    <tr><td>Nom</td><td>${p.name}</td></tr>
    <tr><td>Âge</td><td>${p.age} ans</td></tr>
    <tr><td>Sexe</td><td>${p.sex === 'M' ? 'Masculin' : 'Féminin'}</td></tr>
    <tr><td>Poids / Taille</td><td>${p.weight_kg} kg / ${p.height_cm} cm (IMC ${p.bmi})</td></tr>
    <tr><td>Score T</td><td>${p.tscore.toFixed(1)}</td></tr>
  </table>

  <h2>Mesures cliniques</h2>
  <table>
    <tr><th>Mesure</th><th>Valeur</th><th>Sévérité</th></tr>
    <tr><td>Angle de Cobb</td><td>${cm.cobb_angle_deg}°</td><td class="severity-${cm.scoliosis_severity}">${cm.scoliosis_severity}</td></tr>
    <tr><td>Déviation latérale</td><td>${cm.max_lateral_deviation_mm} mm</td><td></td></tr>
    <tr><td>Cyphose thoracique</td><td>${cm.thoracic_kyphosis_deg}°</td><td></td></tr>
    <tr><td>Lordose lombaire</td><td>${cm.lumbar_lordosis_deg}°</td><td></td></tr>
  </table>

  ${patos.length > 0 ? `
  <h2>Pathologies détectées (${patos.length})</h2>
  <table>
    <tr><th>Type</th><th>Localisation</th><th>Sévérité</th><th>Détail</th></tr>
    ${patos.map(pa => `<tr><td>${pa.type}</td><td>${pa.location}</td><td class="severity-${pa.severity}">${pa.severity}</td><td>${pa.detail}</td></tr>`).join('')}
  </table>` : ''}

  ${recs.length > 0 ? `
  <h2>Recommandations cliniques</h2>
  <ul>${recs.map(r => `<li>${r}</li>`).join('')}</ul>` : ''}

  <div class="footer">VERTEX© — Rapport automatisé à titre pédagogique uniquement. Ne constitue pas un avis médical.</div>
</body>
</html>`
}
</script>

<style scoped>
.report-panel {
  padding: 1rem;
}

.panel-title {
  font-size: 0.9rem;
  font-weight: 600;
  color: #94a3b8;
  margin-bottom: 1rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.no-model {
  color: #64748b;
  font-size: 0.85rem;
  text-align: center;
  padding: 1rem 0;
}

.report-controls {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.field {
  display: flex;
  flex-direction: column;
  gap: 0.3rem;
}

.field label {
  font-size: 0.75rem;
  color: #94a3b8;
}

.field input {
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(100,180,255,0.2);
  border-radius: 6px;
  padding: 0.45rem 0.7rem;
  color: #e2e8f0;
  font-size: 0.85rem;
  outline: none;
}

.btn-report, .btn-preview {
  padding: 0.55rem 1rem;
  border-radius: 6px;
  border: none;
  cursor: pointer;
  font-size: 0.85rem;
  font-weight: 600;
  transition: opacity 0.2s;
}

.btn-report {
  background: linear-gradient(135deg, #3b82f6, #6366f1);
  color: white;
}

.btn-preview {
  background: rgba(100,180,255,0.1);
  border: 1px solid rgba(100,180,255,0.25);
  color: #64b4ff;
}

.btn-report:disabled, .btn-preview:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.report-summary {
  margin-top: 1.25rem;
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(100,180,255,0.1);
  border-radius: 8px;
  padding: 0.85rem;
}

.report-summary h4 {
  font-size: 0.8rem;
  color: #94a3b8;
  margin: 0 0 0.75rem;
  text-transform: uppercase;
}

.summary-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 0.5rem;
  margin-bottom: 0.75rem;
}

.metric {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.15rem;
}

.metric .label {
  font-size: 0.65rem;
  color: #64748b;
  text-align: center;
}

.metric .value {
  font-size: 1rem;
  font-weight: 700;
  color: #e2e8f0;
}

.metric .value.green  { color: #10b981; }
.metric .value.yellow { color: #f59e0b; }
.metric .value.orange { color: #f97316; }
.metric .value.red    { color: #ef4444; }

.recommendations {
  font-size: 0.8rem;
  color: #94a3b8;
}

.recommendations ul {
  margin: 0.4rem 0 0;
  padding-left: 1.2rem;
}

.recommendations li {
  margin-bottom: 0.25rem;
  line-height: 1.4;
}

.error-msg {
  color: #fca5a5;
  font-size: 0.8rem;
  margin-top: 0.5rem;
  padding: 0.4rem;
  background: rgba(239,68,68,0.1);
  border-radius: 4px;
}
</style>
