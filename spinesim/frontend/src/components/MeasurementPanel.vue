<template>
  <div class="panel measurement-panel">
    <h3>📐 Mesures Radiologiques</h3>
    <p class="subtitle">Angles et balance du rachis</p>

    <!-- Scoliose -->
    <section class="measure-section">
      <h4>Scoliose</h4>
      <div class="metrics-grid">
        <div class="metric-card" :class="cobbClass(cobb)">
          <span class="metric-value">{{ fmt(cobb) }}&deg;</span>
          <span class="metric-label">Angle de Cobb</span>
          <span class="metric-sub">{{ cobbLabel(cobb) }}</span>
        </div>
        <div class="metric-card">
          <span class="metric-value">{{ apexLevel }}</span>
          <span class="metric-label">Apex</span>
        </div>
      </div>
    </section>

    <!-- Sagittal -->
    <section class="measure-section">
      <h4>Profil Sagittal</h4>
      <div class="metrics-grid">
        <div class="metric-card" :class="kyphosisClass(kyphosis)">
          <span class="metric-value">{{ fmt(kyphosis) }}&deg;</span>
          <span class="metric-label">Cyphose thoracique</span>
          <span class="metric-sub">{{ kyphosisLabel(kyphosis) }}</span>
        </div>
        <div class="metric-card" :class="lordosisClass(lordosis)">
          <span class="metric-value">{{ fmt(lordosis) }}&deg;</span>
          <span class="metric-label">Lordose lombaire</span>
          <span class="metric-sub">{{ lordosisLabel(lordosis) }}</span>
        </div>
      </div>
    </section>

    <!-- Balance -->
    <section class="measure-section">
      <h4>Équilibre</h4>
      <div class="metrics-grid">
        <div class="metric-card" :class="svaClass(sva)">
          <span class="metric-value">{{ fmt(sva) }}&nbsp;mm</span>
          <span class="metric-label">SVA (Balance sagittale)</span>
          <span class="metric-sub">{{ svaLabel(sva) }}</span>
        </div>
        <div class="metric-card" :class="coronalClass(coronalBalance)">
          <span class="metric-value">{{ fmt(coronalBalance) }}&nbsp;mm</span>
          <span class="metric-label">Balance coronale (C7–CSVL)</span>
          <span class="metric-sub">{{ coronalLabel(coronalBalance) }}</span>
        </div>
      </div>
    </section>

    <!-- Barre de sevérité Cobb -->
    <section class="measure-section" v-if="cobb !== null">
      <h4>Sévérité</h4>
      <div class="severity-bar-container">
        <div class="severity-bar">
          <div
            class="severity-cursor"
            :style="{ left: severityPercent(cobb) + '%' }"
          ></div>
          <div class="severity-zones">
            <span class="zone zone-green">Normal<br/>&lt;10°</span>
            <span class="zone zone-yellow">Légère<br/>10–25°</span>
            <span class="zone zone-orange">Modérée<br/>25–40°</span>
            <span class="zone zone-red">Sévère<br/>&gt;40°</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Pas de données -->
    <div v-if="!hasData" class="empty-state">
      <span class="empty-icon">📏</span>
      <p>Résolvez le modèle pour afficher les mesures</p>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useSpineStore } from '../stores/spineStore'

const store = useSpineStore()

// ── Accesseurs des mesures depuis le store ──────────────────
const hasData = computed(() => !!store.solveResult)

const cobb = computed(() => store.solveResult?.cobb_angle_deg ?? null)
const apexLevel = computed(() => store.solveResult?.apex_level ?? '—')
const kyphosis  = computed(() => store.solveResult?.thoracic_kyphosis_deg ?? null)
const lordosis  = computed(() => store.solveResult?.lumbar_lordosis_deg ?? null)
const sva       = computed(() => store.solveResult?.sva_mm ?? null)
const coronalBalance = computed(() => store.solveResult?.coronal_balance_mm ?? null)

// ── Formatage ───────────────────────────────────────────────
function fmt(val, decimals = 1) {
  if (val === null || val === undefined) return '—'
  return Number(val).toFixed(decimals)
}

// ── Classification Cobb ─────────────────────────────────────
function cobbLabel(deg) {
  if (deg === null) return ''
  if (deg < 10)  return 'Normal'
  if (deg < 25)  return 'Légère'
  if (deg < 40)  return 'Modérée'
  if (deg < 60)  return 'Sévère'
  return 'Très sévère'
}

function cobbClass(deg) {
  if (deg === null) return ''
  if (deg < 10)  return 'metric-ok'
  if (deg < 25)  return 'metric-mild'
  if (deg < 40)  return 'metric-moderate'
  return 'metric-severe'
}

// ── Cyphose (norme 20–50°) ──────────────────────────────────
function kyphosisLabel(deg) {
  if (deg === null) return ''
  if (deg < 20) return 'Hypo-cyphose'
  if (deg > 50) return 'Hyper-cyphose'
  return 'Normale (20–50°)'
}

function kyphosisClass(deg) {
  if (deg === null) return ''
  return (deg >= 20 && deg <= 50) ? 'metric-ok' : 'metric-mild'
}

// ── Lordose (norme 30–60°) ──────────────────────────────────
function lordosisLabel(deg) {
  if (deg === null) return ''
  if (deg < 30) return 'Hypo-lordose'
  if (deg > 60) return 'Hyper-lordose'
  return 'Normale (30–60°)'
}

function lordosisClass(deg) {
  if (deg === null) return ''
  return (deg >= 30 && deg <= 60) ? 'metric-ok' : 'metric-mild'
}

// ── SVA (norme < 50 mm) ─────────────────────────────────────
function svaLabel(mm) {
  if (mm === null) return ''
  const abs = Math.abs(mm)
  if (abs < 50)  return 'Équilibré (< 50 mm)'
  if (abs < 100) return 'Déséquilibre modéré'
  return 'Déséquilibre sévère'
}

function svaClass(mm) {
  if (mm === null) return ''
  const abs = Math.abs(mm)
  if (abs < 50)  return 'metric-ok'
  if (abs < 100) return 'metric-moderate'
  return 'metric-severe'
}

// ── Balance coronale (norme < 20 mm) ────────────────────────
function coronalLabel(mm) {
  if (mm === null) return ''
  const abs = Math.abs(mm)
  if (abs < 20) return 'Équilibré (< 20 mm)'
  return 'Déséquilibre coronal'
}

function coronalClass(mm) {
  if (mm === null) return ''
  return Math.abs(mm) < 20 ? 'metric-ok' : 'metric-moderate'
}

// ── Barre de sévérité (0–80° → 0–100%) ─────────────────────
function severityPercent(deg) {
  if (deg === null) return 0
  return Math.min(Math.max(deg / 80 * 100, 0), 100)
}
</script>

<style scoped>
.measurement-panel {
  display: flex;
  flex-direction: column;
  gap: 1.2rem;
}

.subtitle {
  color: #8899aa;
  font-size: 0.78rem;
  margin-top: -0.5rem;
}

.measure-section h4 {
  color: #e94560;
  font-size: 0.8rem;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  margin-bottom: 0.6rem;
}

/* ── Grille de métriques ── */
.metrics-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0.6rem;
}

.metric-card {
  background: #0f3460;
  border: 1px solid #2a2a4a;
  border-radius: 8px;
  padding: 0.7rem;
  text-align: center;
  display: flex;
  flex-direction: column;
  gap: 0.2rem;
  transition: border-color 0.2s;
}

.metric-value {
  font-size: 1.5rem;
  font-weight: 700;
  font-family: monospace;
  color: #e0e0e0;
}

.metric-label {
  font-size: 0.72rem;
  color: #8899aa;
}

.metric-sub {
  font-size: 0.68rem;
  font-weight: 600;
}

/* ── Couleurs de statut ── */
.metric-ok       { border-color: #00cc66; }
.metric-ok       .metric-value { color: #00cc66; }
.metric-ok       .metric-sub   { color: #00cc66; }

.metric-mild     { border-color: #cccc00; }
.metric-mild     .metric-value { color: #cccc00; }
.metric-mild     .metric-sub   { color: #cccc00; }

.metric-moderate { border-color: #ff8800; }
.metric-moderate .metric-value { color: #ff8800; }
.metric-moderate .metric-sub   { color: #ff8800; }

.metric-severe   { border-color: #e94560; }
.metric-severe   .metric-value { color: #e94560; }
.metric-severe   .metric-sub   { color: #e94560; }

/* ── Barre de sévérité ── */
.severity-bar-container {
  padding: 0 0.5rem;
}

.severity-bar {
  position: relative;
  height: 20px;
  border-radius: 10px;
  background: linear-gradient(to right, #00cc66 0%, #cccc00 25%, #ff8800 55%, #e94560 100%);
  margin-bottom: 0.4rem;
}

.severity-cursor {
  position: absolute;
  top: -4px;
  width: 6px;
  height: 28px;
  background: #ffffff;
  border-radius: 3px;
  transform: translateX(-50%);
  box-shadow: 0 0 6px rgba(255,255,255,0.8);
  transition: left 0.4s ease;
}

.severity-zones {
  display: flex;
  justify-content: space-between;
  margin-top: 0.3rem;
}

.zone {
  font-size: 0.62rem;
  text-align: center;
  color: #8899aa;
  flex: 1;
}

/* ── État vide ── */
.empty-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  padding: 1.5rem;
  color: #556677;
}

.empty-icon {
  font-size: 2.5rem;
}

.empty-state p {
  font-size: 0.8rem;
  text-align: center;
}
</style>
