<template>
  <div class="panel results-panel">
    <h3>📊 Résultats</h3>

    <div v-if="!store.spineData" class="hint">
      Aucune simulation en cours. Créez un rachis pour commencer.
    </div>

    <template v-else>
      <!-- Informations patient -->
      <section class="result-section">
        <h4>Patient</h4>
        <div class="info-grid">
          <div class="info-item">
            <span class="info-label">Poids</span>
            <span class="info-value">{{ patientInfo.weight }} kg</span>
          </div>
          <div class="info-item">
            <span class="info-label">Taille</span>
            <span class="info-value">{{ patientInfo.height }} cm</span>
          </div>
          <div class="info-item">
            <span class="info-label">Âge</span>
            <span class="info-value">{{ patientInfo.age }} ans</span>
          </div>
          <div class="info-item">
            <span class="info-label">Sexe</span>
            <span class="info-value">{{ patientInfo.sex === 'M' ? '♂' : '♀' }}</span>
          </div>
        </div>
      </section>

      <!-- Mesures rachidiennes -->
      <section class="result-section">
        <h4>Mesures rachidiennes</h4>
        <div class="metrics">
          <div class="metric-card">
            <span class="metric-value" :class="cobbClass">
              {{ spineMetrics.cobbAngle.toFixed(1) }}°
            </span>
            <span class="metric-label">Cobb</span>
          </div>
          <div class="metric-card">
            <span class="metric-value">{{ spineMetrics.kyphosis.toFixed(1) }}°</span>
            <span class="metric-label">Cyphose T4-T12</span>
          </div>
          <div class="metric-card">
            <span class="metric-value">{{ spineMetrics.lordosis.toFixed(1) }}°</span>
            <span class="metric-label">Lordose L1-S1</span>
          </div>
        </div>
      </section>

      <!-- Balance -->
      <section class="result-section">
        <h4>Équilibre</h4>
        <div class="balance-bar">
          <div class="balance-indicator" :style="balanceStyle">
            <span>{{ spineMetrics.coronalBalance.toFixed(1) }} mm</span>
          </div>
        </div>
        <div class="balance-labels">
          <span>← Gauche</span>
          <span>Centre</span>
          <span>Droite →</span>
        </div>
        <div class="info-item" style="margin-top: 8px;">
          <span class="info-label">SVA (sagittal)</span>
          <span class="info-value" :class="svaClass">
            {{ spineMetrics.sagittalBalance.toFixed(1) }} mm
          </span>
        </div>
      </section>

      <!-- Contraintes FEM -->
      <section v-if="hasStresses" class="result-section">
        <h4>Contraintes (von Mises)</h4>
        <div class="stress-bar">
          <div
            v-for="(s, i) in normalizedStresses"
            :key="i"
            class="stress-segment"
            :style="{ height: (s * 100) + '%', backgroundColor: stressColor(s) }"
            :title="`Segment ${i + 1}: ${stresses[i].toFixed(1)} MPa`"
          ></div>
        </div>
        <div class="stress-legend">
          <span class="legend-min">0 MPa</span>
          <span class="legend-max">{{ maxStress.toFixed(1) }} MPa</span>
        </div>
        <div class="info-item">
          <span class="info-label">Contrainte max</span>
          <span class="info-value stress-high">{{ maxStress.toFixed(1) }} MPa</span>
        </div>
        <div class="info-item">
          <span class="info-label">Contrainte moy</span>
          <span class="info-value">{{ avgStress.toFixed(1) }} MPa</span>
        </div>
      </section>

      <!-- Résultats chirurgicaux -->
      <section v-if="hasSurgeryResults" class="result-section">
        <h4>Évaluation chirurgicale</h4>
        <div class="score-display">
          <div class="score-circle" :class="scoreClass">
            {{ surgeryScore }}
          </div>
          <div class="score-grade">{{ scoreGrade }}</div>
        </div>
        <div class="info-grid">
          <div class="info-item">
            <span class="info-label">Correction Cobb</span>
            <span class="info-value">{{ correctionPercent }}%</span>
          </div>
          <div class="info-item">
            <span class="info-label">Risque PJK</span>
            <span class="info-value" :class="pjkClass">{{ pjkRisk }}</span>
          </div>
        </div>
      </section>

      <!-- Vertèbres (liste compacte) -->
      <section class="result-section collapsible">
        <h4 @click="showVertebrae = !showVertebrae" style="cursor: pointer;">
          {{ showVertebrae ? '▼' : '▸' }} Vertèbres ({{ vertebraeCount }})
        </h4>
        <div v-if="showVertebrae" class="vertebrae-list">
          <div v-for="v in vertebrae" :key="v.level" class="vert-item">
            <span class="vert-level">{{ v.level }}</span>
            <span class="vert-pos">
              x={{ v.position[0].toFixed(1) }}
              y={{ v.position[1].toFixed(1) }}
              z={{ v.position[2].toFixed(1) }}
            </span>
          </div>
        </div>
      </section>
    </template>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useSpineStore } from '../stores/spineStore'

const store = useSpineStore()
const showVertebrae = ref(false)

const patientInfo = computed(() => {
  const d = store.spineData
  if (!d) return { weight: 0, height: 0, age: 0, sex: 'F' }
  return d.patient || { weight: 70, height: 170, age: 14, sex: 'F' }
})

const vertebrae = computed(() => store.spineData?.vertebrae || [])
const vertebraeCount = computed(() => vertebrae.value.length)
const stresses = computed(() => store.stresses || [])

const spineMetrics = computed(() => {
  const d = store.spineData
  if (!d) return { cobbAngle: 0, kyphosis: 0, lordosis: 0, coronalBalance: 0, sagittalBalance: 0 }
  return {
    cobbAngle: d.cobb_angle || 0,
    kyphosis: d.kyphosis || 35,
    lordosis: d.lordosis || 45,
    coronalBalance: d.coronal_balance || 0,
    sagittalBalance: d.sagittal_balance || 0,
  }
})

const cobbClass = computed(() => {
  const c = spineMetrics.value.cobbAngle
  if (c >= 60) return 'metric-severe'
  if (c >= 25) return 'metric-moderate'
  if (c >= 10) return 'metric-mild'
  return 'metric-normal'
})

const svaClass = computed(() => {
  const sva = Math.abs(spineMetrics.value.sagittalBalance)
  if (sva > 50) return 'metric-severe'
  if (sva > 25) return 'metric-moderate'
  return 'metric-normal'
})

const balanceStyle = computed(() => {
  const b = spineMetrics.value.coronalBalance
  const offset = Math.max(Math.min(b / 40 * 50, 50), -50)
  return { left: `calc(50% + ${offset}%)` }
})

// Stress computations
const hasStresses = computed(() => stresses.value.length > 0)
const maxStress = computed(() => Math.max(...stresses.value, 0.001))
const avgStress = computed(() => {
  if (stresses.value.length === 0) return 0
  return stresses.value.reduce((a, b) => a + b, 0) / stresses.value.length
})
const normalizedStresses = computed(() =>
  stresses.value.map((s) => s / maxStress.value)
)

function stressColor(ratio) {
  const r = Math.round(255 * ratio)
  const g = Math.round(255 * (1 - ratio * 0.7))
  const b = Math.round(255 * (1 - ratio))
  return `rgb(${r}, ${g}, ${b})`
}

// Surgery results
const hasSurgeryResults = computed(() => !!store.spineData?.surgery_score)
const surgeryScore = computed(() => store.spineData?.surgery_score || 0)
const scoreGrade = computed(() => {
  const s = surgeryScore.value
  if (s >= 90) return '⭐⭐⭐⭐⭐ Excellent'
  if (s >= 75) return '⭐⭐⭐⭐ Très bien'
  if (s >= 60) return '⭐⭐⭐ Bien'
  if (s >= 40) return '⭐⭐ Passable'
  return '⭐ Insuffisant'
})
const scoreClass = computed(() => {
  const s = surgeryScore.value
  if (s >= 75) return 'score-excellent'
  if (s >= 50) return 'score-good'
  return 'score-poor'
})
const correctionPercent = computed(() => store.spineData?.correction_percent?.toFixed(0) || '—')
const pjkRisk = computed(() => {
  const r = store.spineData?.pjk_risk
  if (!r) return '—'
  if (r < 0.1) return 'Faible'
  if (r < 0.3) return 'Modéré'
  return 'Élevé'
})
const pjkClass = computed(() => {
  const r = store.spineData?.pjk_risk
  if (!r || r < 0.1) return 'metric-normal'
  if (r < 0.3) return 'metric-moderate'
  return 'metric-severe'
})
</script>

<style scoped>
.results-panel h3 {
  margin: 0 0 12px;
  font-size: 14px;
  color: var(--accent);
}

.hint {
  padding: 10px;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 4px;
  color: #888;
  font-size: 12px;
  text-align: center;
}

.result-section {
  margin-bottom: 16px;
  padding-bottom: 12px;
  border-bottom: 1px solid #2a2a3a;
}

.result-section:last-child {
  border-bottom: none;
}

.result-section h4 {
  margin: 0 0 8px;
  font-size: 11px;
  color: #888;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.info-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 4px;
}

.info-item {
  display: flex;
  justify-content: space-between;
  padding: 3px 0;
}

.info-label {
  font-size: 11px;
  color: #888;
}

.info-value {
  font-size: 12px;
  font-weight: bold;
  color: #eee;
}

/* Metrics cards */
.metrics {
  display: flex;
  gap: 6px;
}

.metric-card {
  flex: 1;
  text-align: center;
  padding: 8px 4px;
  background: rgba(255, 255, 255, 0.03);
  border-radius: 4px;
}

.metric-value {
  display: block;
  font-size: 18px;
  font-weight: bold;
  font-family: 'JetBrains Mono', monospace;
}

.metric-label {
  display: block;
  font-size: 9px;
  color: #888;
  margin-top: 2px;
}

.metric-normal { color: #00ff88; }
.metric-mild { color: #88cc00; }
.metric-moderate { color: #ffaa00; }
.metric-severe { color: #ff4444; }

/* Balance bar */
.balance-bar {
  height: 20px;
  background: linear-gradient(to right, rgba(0, 100, 255, 0.2), rgba(0, 255, 136, 0.2), rgba(255, 100, 0, 0.2));
  border-radius: 10px;
  position: relative;
  margin: 6px 0 2px;
}

.balance-indicator {
  position: absolute;
  top: -2px;
  transform: translateX(-50%);
  background: var(--accent);
  padding: 2px 6px;
  border-radius: 10px;
  font-size: 10px;
  font-weight: bold;
  white-space: nowrap;
}

.balance-labels {
  display: flex;
  justify-content: space-between;
  font-size: 9px;
  color: #666;
}

/* Stress bar chart */
.stress-bar {
  display: flex;
  align-items: flex-end;
  gap: 2px;
  height: 50px;
  padding: 4px 0;
}

.stress-segment {
  flex: 1;
  min-height: 2px;
  border-radius: 1px 1px 0 0;
  transition: height 0.3s ease;
}

.stress-legend {
  display: flex;
  justify-content: space-between;
  font-size: 9px;
  color: #666;
}

.stress-high { color: #ff6666; }

/* Surgery score */
.score-display {
  text-align: center;
  margin: 8px 0;
}

.score-circle {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  font-size: 22px;
  font-weight: bold;
  margin-bottom: 4px;
}

.score-excellent { background: rgba(0, 255, 136, 0.2); color: #00ff88; border: 2px solid #00ff88; }
.score-good { background: rgba(255, 170, 0, 0.2); color: #ffaa00; border: 2px solid #ffaa00; }
.score-poor { background: rgba(255, 0, 0, 0.2); color: #ff4444; border: 2px solid #ff4444; }

.score-grade {
  font-size: 12px;
  color: #ccc;
}

/* Vertebrae list */
.vertebrae-list {
  max-height: 200px;
  overflow-y: auto;
}

.vert-item {
  display: flex;
  justify-content: space-between;
  padding: 2px 4px;
  font-size: 10px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.03);
}

.vert-level {
  font-weight: bold;
  color: var(--accent);
  min-width: 30px;
}

.vert-pos {
  color: #888;
  font-family: 'JetBrains Mono', monospace;
  font-size: 9px;
}
</style>
