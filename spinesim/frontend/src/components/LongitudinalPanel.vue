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

      <!-- Graphique de progression -->
      <section class="result-section" v-if="result.snapshots?.length > 0">
        <h4>Progression de Cobb</h4>
        <div class="chart-container">
          <canvas ref="chartCanvas"></canvas>
        </div>
        <div class="snapshot-table">
          <div class="snap-row snap-header">
            <span>Année</span>
            <span>Cobb max</span>
            <span>Flambage</span>
          </div>
          <div
            v-for="snap in result.snapshots"
            :key="snap.time_years"
            class="snap-row"
            :class="{ 'snap-scoliosis': snap.cobb_angles?.max > 10 }"
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
import { ref, computed, watch, nextTick } from 'vue'
import { useSpineStore } from '../stores/spineStore'

const store = useSpineStore()
const chartCanvas = ref(null)

const params = ref({
  duration_years: 10,
  initial_age: 10,
  asymmetry_type: 'combined',
})

const result = computed(() => store.longitudinalResult)
const comparison = computed(() => store.comparisonResults)

const cobbClass = computed(() => {
  if (!result.value) return ''
  const cobb = result.value.final_cobb_deg
  if (cobb > 40) return 'cobb-severe'
  if (cobb > 25) return 'cobb-moderate'
  if (cobb > 10) return 'cobb-mild'
  return 'cobb-normal'
})

async function runSimulation() {
  await store.runLongitudinal(params.value)
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

function drawChart() {
  if (!chartCanvas.value || !result.value?.snapshots?.length) return
  const canvas = chartCanvas.value
  const ctx = canvas.getContext('2d')
  const snaps = result.value.snapshots

  const dpr = window.devicePixelRatio || 1
  const rect = canvas.parentElement.getBoundingClientRect()
  canvas.width = rect.width * dpr
  canvas.height = 160 * dpr
  canvas.style.width = rect.width + 'px'
  canvas.style.height = '160px'
  ctx.scale(dpr, dpr)

  const w = rect.width
  const h = 160
  const pad = { top: 20, right: 20, bottom: 30, left: 45 }
  const plotW = w - pad.left - pad.right
  const plotH = h - pad.top - pad.bottom

  const times = snaps.map(s => s.time_years)
  const cobbs = snaps.map(s => s.cobb_angles?.max ?? 0)
  const maxT = Math.max(...times, 1)
  const maxC = Math.max(...cobbs, 12)

  // Background
  ctx.fillStyle = '#0f3460'
  ctx.fillRect(0, 0, w, h)

  // Grid
  ctx.strokeStyle = '#2a2a4a'
  ctx.lineWidth = 0.5
  for (let i = 0; i <= 4; i++) {
    const y = pad.top + (plotH / 4) * i
    ctx.beginPath()
    ctx.moveTo(pad.left, y)
    ctx.lineTo(w - pad.right, y)
    ctx.stroke()
  }

  // 10° threshold line
  const y10 = pad.top + plotH * (1 - 10 / maxC)
  ctx.strokeStyle = '#e94560'
  ctx.setLineDash([5, 3])
  ctx.beginPath()
  ctx.moveTo(pad.left, y10)
  ctx.lineTo(w - pad.right, y10)
  ctx.stroke()
  ctx.setLineDash([])
  ctx.fillStyle = '#e94560'
  ctx.font = '9px monospace'
  ctx.fillText('10° (seuil scoliose)', w - pad.right - 100, y10 - 3)

  // Cobb curve
  ctx.strokeStyle = '#4ecdc4'
  ctx.lineWidth = 2
  ctx.beginPath()
  snaps.forEach((s, i) => {
    const x = pad.left + (s.time_years / maxT) * plotW
    const y = pad.top + plotH * (1 - (s.cobb_angles?.max ?? 0) / maxC)
    if (i === 0) ctx.moveTo(x, y)
    else ctx.lineTo(x, y)
  })
  ctx.stroke()

  // Points
  snaps.forEach(s => {
    const x = pad.left + (s.time_years / maxT) * plotW
    const cobb = s.cobb_angles?.max ?? 0
    const y = pad.top + plotH * (1 - cobb / maxC)
    ctx.fillStyle = cobb > 10 ? '#e94560' : '#4ecdc4'
    ctx.beginPath()
    ctx.arc(x, y, 3, 0, Math.PI * 2)
    ctx.fill()
  })

  // Axes labels
  ctx.fillStyle = '#a0a0b0'
  ctx.font = '10px monospace'
  ctx.textAlign = 'center'
  ctx.fillText('Années', w / 2, h - 3)

  ctx.save()
  ctx.translate(12, h / 2)
  ctx.rotate(-Math.PI / 2)
  ctx.fillText('Cobb (°)', 0, 0)
  ctx.restore()

  // Tick labels
  ctx.textAlign = 'center'
  for (let t = 0; t <= maxT; t += Math.ceil(maxT / 5)) {
    const x = pad.left + (t / maxT) * plotW
    ctx.fillText(t.toString(), x, h - pad.bottom + 15)
  }
  ctx.textAlign = 'right'
  for (let c = 0; c <= maxC; c += Math.ceil(maxC / 4)) {
    const y = pad.top + plotH * (1 - c / maxC)
    ctx.fillText(c.toString(), pad.left - 5, y + 3)
  }
}

// Redraw chart when result changes
watch(result, async () => {
  await nextTick()
  drawChart()
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
.comp-scoliosis { background: rgba(233, 69, 96, 0.1); }
.comp-name { font-size: 10px; }
</style>
