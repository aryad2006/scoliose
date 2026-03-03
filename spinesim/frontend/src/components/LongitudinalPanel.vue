<template>
  <div class="panel longitudinal-panel">
    <h3>📈 Simulation Longitudinale</h3>
    <p class="subtitle">Théorie du ressort spiral — Progression scoliotique</p>

    <!-- Paramètres -->
    <div class="form-group">
      <label>Durée (années)</label>
      <input type="number" v-model.number="params.duration_years" min="1" max="30" step="1" />
    </div>

    <div class="form-group">
      <label>Âge initial</label>
      <input type="number" v-model.number="params.initial_age" min="5" max="60" step="1" />
    </div>

    <div class="form-group">
      <label>Type d'asymétrie</label>
      <select v-model="params.asymmetry_type">
        <option value="none">Symétrique (contrôle)</option>
        <option value="wedging_1">Cunéiformisation 1°</option>
        <option value="wedging_2">Cunéiformisation 2°</option>
        <option value="wedging_3">Cunéiformisation 3°</option>
        <option value="ligament_10">Ligaments +10%</option>
        <option value="ligament_20">Ligaments +20%</option>
        <option value="disc_10">Disque +10%</option>
        <option value="combined">Combinée (wedge 2° + lig 10%)</option>
      </select>
    </div>

    <button class="btn primary" @click="runSimulation" :disabled="store.loading">
      <span v-if="store.loading">⏳ Simulation en cours...</span>
      <span v-else>🔬 Lancer la simulation</span>
    </button>

    <button class="btn outline" @click="runStudy" :disabled="store.loading">
      📊 Étude comparative (9 configs)
    </button>

    <!-- Résultats de simulation simple -->
    <template v-if="result">
      <section class="result-section">
        <h4>Résultats</h4>
        <div class="metrics">
          <div class="metric-card">
            <span class="metric-value" :class="cobbClass">
              {{ result.final_cobb_deg.toFixed(1) }}°
            </span>
            <span class="metric-label">Cobb final</span>
          </div>
          <div class="metric-card">
            <span class="metric-value" :class="result.developed_scoliosis ? 'scoliosis-yes' : 'scoliosis-no'">
              {{ result.developed_scoliosis ? 'OUI' : 'NON' }}
            </span>
            <span class="metric-label">Scoliose (>10°)</span>
          </div>
        </div>
        <div class="info-grid" v-if="result.developed_scoliosis">
          <div class="info-item">
            <span class="info-label">Onset</span>
            <span class="info-value">{{ result.scoliosis_onset_years?.toFixed(1) ?? '—' }} ans</span>
          </div>
        </div>
        <div class="info-item">
          <span class="info-label">Temps de calcul</span>
          <span class="info-value">{{ result.computation_time_s?.toFixed(2) ?? '—' }} s</span>
        </div>
      </section>

      <!-- Graphique Chart.js + slider timeline -->
      <section class="result-section" v-if="result.snapshots?.length > 0">
        <h4>Évolution de Cobb</h4>

        <!-- Graphique Chart.js -->
        <div class="chart-container">
          <canvas ref="chartCanvas"></canvas>
        </div>

        <!-- ─── Slider timeline ─── -->
        <div class="timeline-slider">
          <label class="timeline-label">
            📅 Année : <strong>{{ currentSnap?.time_years?.toFixed(1) ?? '—' }}</strong>
          </label>
          <input
            type="range"
            class="slider"
            :min="0"
            :max="result.snapshots.length - 1"
            :step="1"
            v-model.number="timelineIdx"
          />
          <div class="timeline-info" v-if="currentSnap">
            <span class="ti-item">
              Cobb :
              <strong :class="cobbColorClass(currentSnap.cobb_angles?.max)">
                {{ currentSnap.cobb_angles?.max?.toFixed(1) ?? '—' }}°
              </strong>
            </span>
            <span class="ti-item">
              Flambage :
              <strong>{{ currentSnap.buckling_ratio?.toFixed(3) ?? '—' }}</strong>
            </span>
            <span class="ti-item" v-if="currentSnap.cobb_angles?.max > 10">
              ⚠️ Seuil scoliose dépassé
            </span>
          </div>
        </div>

        <!-- Table des snapshots -->
        <div class="snapshot-table">
          <div class="snap-row snap-header">
            <span>Année</span>
            <span>Cobb max</span>
            <span>Flambage</span>
          </div>
          <div
            v-for="(snap, idx) in result.snapshots"
            :key="snap.time_years"
            class="snap-row"
            :class="{
              'snap-scoliosis': snap.cobb_angles?.max > 10,
              'snap-active': idx === timelineIdx
            }"
            @click="timelineIdx = idx"
          >
            <span>{{ snap.time_years.toFixed(1) }}</span>
            <span>{{ snap.cobb_angles?.max?.toFixed(1) ?? '—' }}°</span>
            <span>{{ snap.buckling_ratio?.toFixed(2) ?? '—' }}</span>
          </div>
        </div>
      </section>
    </template>

    <!-- Résultats comparatifs -->
    <template v-if="comparison">
      <section class="result-section">
        <h4>Étude comparative</h4>
        <div class="comparison-table">
          <div class="comp-row comp-header">
            <span>Config</span>
            <span>Cobb</span>
            <span>Scol.</span>
          </div>
          <div
            v-for="(res, name) in comparison.results"
            :key="name"
            class="comp-row"
            :class="{ 'comp-scoliosis': res.developed_scoliosis }"
          >
            <span class="comp-name">{{ formatName(name) }}</span>
            <span>{{ res.final_cobb.toFixed(1) }}°</span>
            <span>{{ res.developed_scoliosis ? '✅' : '—' }}</span>
          </div>
        </div>
      </section>
    </template>
  </div>
</template>

<script setup>
import { ref, computed, watch, nextTick, onUnmounted } from 'vue'
import {
  Chart,
  LineController,
  LineElement,
  PointElement,
  LinearScale,
  CategoryScale,
  Tooltip,
  Legend,
  Filler,
} from 'chart.js'
import { useSpineStore } from '../stores/spineStore'

// ── Enregistrement Chart.js (tree-shakeable) ─────────────────
Chart.register(
  LineController, LineElement, PointElement,
  LinearScale, CategoryScale, Tooltip, Legend, Filler
)

const store = useSpineStore()
const chartCanvas = ref(null)

/** Slider de timeline — index dans result.snapshots */
const timelineIdx = ref(0)

const params = ref({
  duration_years: 10,
  initial_age: 10,
  asymmetry_type: 'combined',
})

const result = computed(() => store.longitudinalResult)
const comparison = computed(() => store.comparisonResults)

const currentSnap = computed(() => {
  if (!result.value?.snapshots?.length) return null
  const idx = Math.min(timelineIdx.value, result.value.snapshots.length - 1)
  return result.value.snapshots[idx]
})

const cobbClass = computed(() => {
  if (!result.value) return ''
  const cobb = result.value.final_cobb_deg
  if (cobb > 40) return 'cobb-severe'
  if (cobb > 25) return 'cobb-moderate'
  if (cobb > 10) return 'cobb-mild'
  return 'cobb-normal'
})

function cobbColorClass(deg) {
  if (deg === undefined || deg === null) return ''
  if (deg > 40) return 'cobb-severe'
  if (deg > 25) return 'cobb-moderate'
  if (deg > 10) return 'cobb-mild'
  return 'cobb-normal'
}

async function runSimulation() {
  await store.runLongitudinal(params.value)
  timelineIdx.value = 0
  await nextTick()
  drawChart()
}

async function runStudy() {
  await store.runComparison({
    duration_years: params.value.duration_years,
    initial_age: params.value.initial_age,
  })
}

function formatName(name) {
  return name.replace(/_/g, ' ').replace(/^\d+\s/, '')
}

// ── Chart.js instance ─────────────────────────────────────────
let chartInstance = null

function drawChart() {
  if (!chartCanvas.value || !result.value?.snapshots?.length) return

  const snaps  = result.value.snapshots
  const labels = snaps.map(s => s.time_years.toFixed(1))
  const cobbs  = snaps.map(s => s.cobb_angles?.max ?? 0)

  // Couleur des points : rouge si > 10°
  const pointColors = cobbs.map(c => c > 10 ? '#e94560' : '#4ecdc4')

  // Détruis l'instance existante si nécessaire
  if (chartInstance) {
    chartInstance.destroy()
    chartInstance = null
  }

  const ctx = chartCanvas.value.getContext('2d')

  chartInstance = new Chart(ctx, {
    type: 'line',
    data: {
      labels,
      datasets: [
        {
          label: 'Angle de Cobb (°)',
          data: cobbs,
          borderColor: '#4ecdc4',
          backgroundColor: 'rgba(78,205,196,0.12)',
          pointBackgroundColor: pointColors,
          pointRadius: 4,
          pointHoverRadius: 6,
          borderWidth: 2,
          fill: true,
          tension: 0.35,
        },
        {
          // Ligne seuil 10°
          label: 'Seuil scoliose (10°)',
          data: labels.map(() => 10),
          borderColor: '#e94560',
          borderDash: [5, 4],
          borderWidth: 1.5,
          pointRadius: 0,
          fill: false,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animation: { duration: 300 },
      plugins: {
        legend: {
          labels: {
            color: '#b0b8cc',
            font: { size: 10 },
            boxWidth: 14,
          },
        },
        tooltip: {
          callbacks: {
            title: (items) => `Année ${items[0].label}`,
            label: (item) => `${item.dataset.label}: ${Number(item.raw).toFixed(1)}`,
          },
        },
      },
      scales: {
        x: {
          title: { display: true, text: 'Années', color: '#8899aa', font: { size: 10 } },
          ticks: { color: '#8899aa', font: { size: 9 } },
          grid: { color: '#1e2a45' },
        },
        y: {
          title: { display: true, text: 'Cobb (°)', color: '#8899aa', font: { size: 10 } },
          ticks: { color: '#8899aa', font: { size: 9 } },
          grid: { color: '#1e2a45' },
          min: 0,
        },
      },
    },
  })
}

// Mettre à jour la ligne verticale du slider sur le graphique
watch(timelineIdx, (idx) => {
  if (!chartInstance || !result.value?.snapshots?.length) return
  // Highlight le point actif via la propriété pointRadius
  const n = result.value.snapshots.length
  const radii = Array.from({ length: n }, (_, i) => (i === idx ? 8 : 4))
  chartInstance.data.datasets[0].pointRadius = radii
  chartInstance.update('none')
})

// Redraw chart when result changes
watch(result, async () => {
  await nextTick()
  drawChart()
})

onUnmounted(() => {
  if (chartInstance) {
    chartInstance.destroy()
    chartInstance = null
  }
})
</script>

<style scoped>
.longitudinal-panel h3 {
  margin: 0 0 4px;
  font-size: 14px;
  color: var(--accent);
}

.subtitle {
  font-size: 10px;
  color: #777;
  margin-bottom: 12px;
}

.form-group {
  margin-bottom: 10px;
}

.form-group label {
  display: block;
  font-size: 11px;
  color: #aaa;
  margin-bottom: 3px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.form-group input,
.form-group select {
  width: 100%;
  padding: 6px 8px;
  background: var(--bg-dark, #1a1a2e);
  border: 1px solid #333;
  border-radius: 4px;
  color: #eee;
  font-size: 13px;
}

.btn {
  width: 100%;
  padding: 8px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 12px;
  font-weight: bold;
  margin-top: 8px;
  transition: all 0.2s;
}

.btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.btn.primary {
  background: var(--accent, #e94560);
  color: white;
}

.btn.primary:hover:not(:disabled) {
  background: #ff6680;
}

.btn.outline {
  background: transparent;
  color: var(--accent, #e94560);
  border: 1px solid var(--accent, #e94560);
}

.btn.outline:hover:not(:disabled) {
  background: rgba(233, 69, 96, 0.1);
}

.result-section {
  margin-top: 16px;
  padding-top: 12px;
  border-top: 1px solid #2a2a4a;
}

.result-section h4 {
  font-size: 12px;
  color: #ccc;
  margin-bottom: 8px;
}

.metrics {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 8px;
}

.metric-card {
  text-align: center;
  padding: 8px;
  background: rgba(15, 52, 96, 0.5);
  border-radius: 6px;
}

.metric-value {
  display: block;
  font-size: 20px;
  font-weight: bold;
}

.metric-label {
  font-size: 10px;
  color: #888;
  text-transform: uppercase;
}

.cobb-normal { color: #4ecdc4; }
.cobb-mild { color: #ffe66d; }
.cobb-moderate { color: #ff9f43; }
.cobb-severe { color: #ff6b6b; }
.scoliosis-yes { color: #ff6b6b; }
.scoliosis-no { color: #4ecdc4; }

.info-item {
  display: flex;
  justify-content: space-between;
  padding: 4px 0;
  font-size: 12px;
}

.info-label { color: #888; }
.info-value { color: #eee; font-weight: 600; }

.chart-container {
  margin: 8px 0;
  border-radius: 6px;
  overflow: hidden;
}

.chart-container canvas {
  display: block;
}

.snapshot-table, .comparison-table {
  margin-top: 8px;
  font-size: 11px;
  max-height: 200px;
  overflow-y: auto;
}

.snap-row, .comp-row {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  padding: 3px 6px;
  border-bottom: 1px solid #1a1a2e;
}

.snap-header, .comp-header {
  font-weight: bold;
  color: #aaa;
  text-transform: uppercase;
  font-size: 9px;
  background: rgba(15, 52, 96, 0.5);
}

.snap-scoliosis { color: #ff6b6b; }
.snap-active    { background: rgba(78,205,196,0.12); font-weight: 600; }
.comp-scoliosis { background: rgba(233, 69, 96, 0.1); }
.comp-name      { font-size: 10px; }
.timeline-slider {
  margin: 0.6rem 0;
  padding: 0.5rem 0.3rem;
  background: rgba(15, 52, 96, 0.4);
  border-radius: 6px;
  display: flex;
  flex-direction: column;
  gap: 0.4rem;
}

.timeline-label {
  font-size: 0.8rem;
  color: #b0b8cc;
}

.timeline-label strong {
  color: #4ecdc4;
}

.slider {
  width: 100%;
  accent-color: #4ecdc4;
  cursor: pointer;
}

.timeline-info {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  font-size: 0.75rem;
}

.ti-item {
  background: rgba(10, 20, 40, 0.5);
  padding: 0.15rem 0.5rem;
  border-radius: 4px;
  color: #8899aa;
}

.ti-item strong {
  color: #e0e0e0;
}

/* ── Chart.js canvas hauteur fixée ── */
.chart-container {
  height: 200px;
  position: relative;
}
</style>
