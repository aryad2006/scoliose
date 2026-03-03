<template>
  <div class="dashboard-student">
    <header class="dash-header">
      <div class="dash-title">
        <span class="dash-icon">🦴</span>
        <div>
          <h1>Tableau de bord étudiant</h1>
          <p class="dash-subtitle">VERTEX© — Simulateur rachidien</p>
        </div>
      </div>
      <div class="level-badge" :class="currentLevel">
        <span class="badge-icon">{{ levelIcon }}</span>
        <span class="badge-label">{{ levelLabel }}</span>
      </div>
    </header>

    <!-- KPIs row -->
    <section class="kpi-row">
      <div class="kpi-card" v-for="kpi in kpiCards" :key="kpi.label">
        <div class="kpi-value" :style="{ color: kpi.color }">{{ kpi.value }}</div>
        <div class="kpi-label">{{ kpi.label }}</div>
        <div class="kpi-trend" :class="kpi.trendDir">{{ kpi.trend }}</div>
      </div>
    </section>

    <div class="dash-grid">
      <!-- Progression Cobb -->
      <div class="card chart-card">
        <h3 class="card-title">📉 Progression — Angle de Cobb</h3>
        <canvas ref="cobbChartRef" height="220"></canvas>
        <p class="chart-hint">
          Dernière valeur : <strong>{{ lastCobb }}°</strong>
          {{ cobbTrend > 0 ? '▲' : '▼' }} {{ Math.abs(cobbTrend) }}° vs session précédente
        </p>
      </div>

      <!-- Radar compétences -->
      <div class="card chart-card">
        <h3 class="card-title">🕸️ Profil de compétences</h3>
        <canvas ref="radarChartRef" height="220"></canvas>
      </div>

      <!-- Histogramme scores quiz -->
      <div class="card chart-card">
        <h3 class="card-title">📊 Scores par domaine</h3>
        <canvas ref="domainChartRef" height="220"></canvas>
      </div>

      <!-- Simulations récentes -->
      <div class="card sims-card">
        <h3 class="card-title">🔬 Simulations récentes</h3>
        <div v-if="recentSims.length === 0" class="empty-state">
          Aucune simulation enregistrée.
        </div>
        <ul class="sim-list" v-else>
          <li v-for="sim in recentSims" :key="sim.id" class="sim-item">
            <div class="sim-meta">
              <span class="sim-date">{{ formatDate(sim.created_at) }}</span>
              <span class="sim-type" :class="sim.pathology">{{ sim.pathology_label }}</span>
            </div>
            <div class="sim-stats">
              <span title="Angle de Cobb">Cobb <b>{{ sim.cobb_angle }}°</b></span>
              <span title="Score FEM">FEM <b>{{ sim.fem_score ?? '—' }}</b></span>
              <span title="Score chirurgie" v-if="sim.surgery_score">
                Chir. <b>{{ sim.surgery_score }}/100</b>
              </span>
            </div>
            <button class="btn-sm btn-ghost" @click="loadSim(sim.id)">Recharger</button>
          </li>
        </ul>
      </div>

      <!-- Progression niveaux -->
      <div class="card levels-card">
        <h3 class="card-title">🏅 Progression par niveau</h3>
        <div class="levels-list">
          <div
            v-for="lvl in levelProgress"
            :key="lvl.key"
            class="level-row"
          >
            <div class="level-head">
              <span class="level-icon">{{ lvl.icon }}</span>
              <span class="level-name">{{ lvl.name }}</span>
              <span class="level-pct">{{ lvl.pct }}%</span>
            </div>
            <div class="level-bar-track">
              <div
                class="level-bar-fill"
                :class="lvl.key"
                :style="{ width: lvl.pct + '%' }"
              ></div>
            </div>
            <div class="level-desc">{{ lvl.desc }}</div>
          </div>
        </div>
      </div>

      <!-- Objectifs actifs -->
      <div class="card goals-card">
        <h3 class="card-title">🎯 Objectifs de la semaine</h3>
        <ul class="goals-list">
          <li
            v-for="goal in weeklyGoals"
            :key="goal.id"
            class="goal-item"
            :class="{ done: goal.done }"
          >
            <span class="goal-check">{{ goal.done ? '✅' : '⬜' }}</span>
            <span class="goal-text">{{ goal.text }}</span>
            <span class="goal-xp">+{{ goal.xp }} XP</span>
          </li>
        </ul>
        <div class="xp-summary">
          XP ce sprint : <strong>{{ earnedXp }} / {{ totalXp }}</strong>
          <div class="xp-bar-track">
            <div class="xp-bar-fill" :style="{ width: xpPct + '%' }"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue'
import { useSpineStore } from '../stores/spineStore'
import { useRouter } from 'vue-router'
import Chart from 'chart.js/auto'
import axios from 'axios'

const store  = useSpineStore()
const router = useRouter()

// ─── Refs DOM ───────────────────────────────────────────────────────────────
const cobbChartRef   = ref(null)
const radarChartRef  = ref(null)
const domainChartRef = ref(null)

// ─── State ──────────────────────────────────────────────────────────────────
const recentSims    = ref([])
const cobbHistory   = ref([])
const quizScores    = ref({ anatomie: 0, radiologie: 0, biomecanique: 0, chirurgie: 0, complications: 0 })
const levelProgress = ref([
  { key: 'bronze',  icon: '🥉', name: 'Bronze',  pct: 0, desc: 'Bases anatomiques'          },
  { key: 'argent',  icon: '🥈', name: 'Argent',  pct: 0, desc: 'Biomécanique appliquée'      },
  { key: 'or',      icon: '🥇', name: 'Or',      pct: 0, desc: 'Planification chirurgicale'  },
  { key: 'diamant', icon: '💎', name: 'Diamant', pct: 0, desc: 'Expertise et complications'  },
])
const weeklyGoals = ref([
  { id: 1, text: 'Compléter 3 simulations',            xp: 50,  done: false },
  { id: 2, text: 'Quiz Bronze ≥ 70%',                  xp: 30,  done: false },
  { id: 3, text: 'Placer 6 vis pédiculaires',          xp: 40,  done: false },
  { id: 4, text: 'Correction Cobb < 10° en simulation', xp: 60, done: false },
  { id: 5, text: 'Revoir cours MODULE 02',              xp: 20,  done: false },
])

// ─── Charts instances ────────────────────────────────────────────────────────
let cobbChart   = null
let radarChart  = null
let domainChart = null

// ─── Computed ────────────────────────────────────────────────────────────────
const lastCobb  = computed(() => cobbHistory.value.length ? cobbHistory.value.at(-1) : '—')
const cobbTrend = computed(() => {
  const h = cobbHistory.value
  return h.length >= 2 ? h.at(-1) - h.at(-2) : 0
})

const currentLevel = computed(() => {
  const p = levelProgress.value
  if (p[3].pct >= 75) return 'diamant'
  if (p[2].pct >= 70) return 'or'
  if (p[1].pct >= 65) return 'argent'
  return 'bronze'
})
const levelIcon = computed(() => {
  return { bronze: '🥉', argent: '🥈', or: '🥇', diamant: '💎' }[currentLevel.value]
})
const levelLabel = computed(() => {
  return { bronze: 'Bronze', argent: 'Argent', or: 'Or', diamant: 'Diamant' }[currentLevel.value]
})

const earnedXp  = computed(() => weeklyGoals.value.filter(g => g.done).reduce((s, g) => s + g.xp, 0))
const totalXp   = computed(() => weeklyGoals.value.reduce((s, g) => s + g.xp, 0))
const xpPct     = computed(() => totalXp.value > 0 ? Math.round(earnedXp.value / totalXp.value * 100) : 0)

const kpiCards = computed(() => [
  {
    label: 'Simulations réalisées',
    value: recentSims.value.length,
    color: '#4caf50',
    trend: '+' + recentSims.value.length,
    trendDir: 'up',
  },
  {
    label: 'Cobb moyen',
    value: cobbHistory.value.length
      ? (cobbHistory.value.reduce((a, b) => a + b, 0) / cobbHistory.value.length).toFixed(1) + '°'
      : '—',
    color: '#2196f3',
    trend: cobbTrend.value > 0 ? '▲' + cobbTrend.value + '°' : '▼' + Math.abs(cobbTrend.value) + '°',
    trendDir: cobbTrend.value < 0 ? 'up' : 'down',
  },
  {
    label: 'Niveau actuel',
    value: levelLabel.value,
    color: '#ff9800',
    trend: 'XP ' + earnedXp.value,
    trendDir: 'neutral',
  },
  {
    label: 'Objectifs semaine',
    value: weeklyGoals.value.filter(g => g.done).length + '/' + weeklyGoals.value.length,
    color: '#9c27b0',
    trend: xpPct.value + '%',
    trendDir: xpPct.value >= 50 ? 'up' : 'neutral',
  },
])

// ─── Methods ─────────────────────────────────────────────────────────────────
const formatDate = (iso) => {
  if (!iso) return '—'
  const d = new Date(iso)
  return d.toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', hour: '2-digit', minute: '2-digit' })
}

const loadSim = (id) => {
  router.push({ path: '/', query: { sim: id } })
}

const fetchDashboardData = async () => {
  try {
    const [simsResp, progressResp] = await Promise.all([
      axios.get('/api/student/simulations?limit=10'),
      axios.get('/api/student/progress'),
    ])
    const sims = simsResp.data?.simulations ?? []
    recentSims.value = sims
    cobbHistory.value = sims.map(s => s.cobb_angle).filter(Boolean).reverse()

    const prog = progressResp.data ?? {}
    quizScores.value = prog.domain_scores ?? quizScores.value
    levelProgress.value.forEach(lvl => {
      lvl.pct = prog.levels?.[lvl.key] ?? lvl.pct
    })
    weeklyGoals.value.forEach(g => {
      const matched = prog.goals?.find(pg => pg.id === g.id)
      if (matched) g.done = matched.done
    })
  } catch {
    // Mode démo sans API
    _loadDemoData()
  }
}

const _loadDemoData = () => {
  cobbHistory.value = [42, 38, 35, 33, 30, 27, 25]
  recentSims.value  = [
    { id: 1, created_at: new Date().toISOString(), pathology: 'scoliosis', pathology_label: 'Scoliose idiopathique', cobb_angle: 25, fem_score: 87, surgery_score: 72 },
    { id: 2, created_at: new Date(Date.now() - 86400000).toISOString(), pathology: 'disc_hernia', pathology_label: 'Hernie discale L4-L5', cobb_angle: 8, fem_score: 91, surgery_score: null },
    { id: 3, created_at: new Date(Date.now() - 172800000).toISOString(), pathology: 'scoliosis', pathology_label: 'Scoliose thoracique', cobb_angle: 33, fem_score: 78, surgery_score: 65 },
  ]
  quizScores.value = { anatomie: 82, radiologie: 74, biomecanique: 61, chirurgie: 55, complications: 40 }
  levelProgress.value = [
    { key: 'bronze',  icon: '🥉', name: 'Bronze',  pct: 85, desc: 'Bases anatomiques'         },
    { key: 'argent',  icon: '🥈', name: 'Argent',  pct: 62, desc: 'Biomécanique appliquée'     },
    { key: 'or',      icon: '🥇', name: 'Or',      pct: 30, desc: 'Planification chirurgicale' },
    { key: 'diamant', icon: '💎', name: 'Diamant', pct: 10, desc: 'Expertise et complications' },
  ]
  weeklyGoals.value[0].done = true
  weeklyGoals.value[1].done = true
}

// ─── Chart rendering ─────────────────────────────────────────────────────────
const renderCharts = () => {
  // Cobb timeline
  if (cobbChartRef.value) {
    cobbChart?.destroy()
    const labels = cobbHistory.value.map((_, i) => `S${i + 1}`)
    cobbChart = new Chart(cobbChartRef.value, {
      type: 'line',
      data: {
        labels,
        datasets: [{
          label: 'Angle de Cobb (°)',
          data: cobbHistory.value,
          borderColor: '#2196f3',
          backgroundColor: 'rgba(33,150,243,0.12)',
          borderWidth: 2,
          pointRadius: 4,
          tension: 0.3,
          fill: true,
        }],
      },
      options: {
        plugins: { legend: { display: false } },
        scales: {
          y: { min: 0, title: { display: true, text: 'Degrés (°)' } },
        },
        animation: { duration: 600 },
      },
    })
  }

  // Radar compétences
  if (radarChartRef.value) {
    radarChart?.destroy()
    const s = quizScores.value
    radarChart = new Chart(radarChartRef.value, {
      type: 'radar',
      data: {
        labels: ['Anatomie', 'Radiologie', 'Biomécanique', 'Chirurgie', 'Complications'],
        datasets: [{
          label: 'Score (%)',
          data: [s.anatomie, s.radiologie, s.biomecanique, s.chirurgie, s.complications],
          backgroundColor: 'rgba(156,39,176,0.18)',
          borderColor: '#9c27b0',
          borderWidth: 2,
          pointBackgroundColor: '#9c27b0',
        }],
      },
      options: {
        scales: { r: { beginAtZero: true, max: 100 } },
        plugins: { legend: { display: false } },
        animation: { duration: 600 },
      },
    })
  }

  // Bar domaines
  if (domainChartRef.value) {
    domainChart?.destroy()
    const s = quizScores.value
    domainChart = new Chart(domainChartRef.value, {
      type: 'bar',
      data: {
        labels: ['Anatomie', 'Radiologie', 'Biomécanique', 'Chirurgie', 'Complications'],
        datasets: [{
          label: 'Score quiz (%)',
          data: [s.anatomie, s.radiologie, s.biomecanique, s.chirurgie, s.complications],
          backgroundColor: ['#4caf50','#2196f3','#ff9800','#f44336','#9c27b0'],
          borderRadius: 4,
        }],
      },
      options: {
        plugins: { legend: { display: false } },
        scales: { y: { min: 0, max: 100, ticks: { callback: v => v + '%' } } },
        animation: { duration: 600 },
      },
    })
  }
}

// ─── Lifecycle ────────────────────────────────────────────────────────────────
onMounted(async () => {
  await fetchDashboardData()
  renderCharts()
})

onUnmounted(() => {
  cobbChart?.destroy()
  radarChart?.destroy()
  domainChart?.destroy()
})

watch([cobbHistory, quizScores], renderCharts, { deep: true })
</script>

<style scoped>
.dashboard-student {
  padding: 1.5rem;
  background: #0d0d0d;
  min-height: 100vh;
  color: #e0e0e0;
}

/* Header */
.dash-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}
.dash-title {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}
.dash-icon { font-size: 2.2rem; }
.dash-title h1 { font-size: 1.5rem; margin: 0; color: #fff; }
.dash-subtitle { font-size: 0.8rem; color: #888; margin: 0; }

.level-badge {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.4rem 1rem;
  border-radius: 20px;
  font-weight: 700;
  font-size: 0.9rem;
  border: 2px solid;
}
.level-badge.bronze  { border-color: #cd7f32; color: #cd7f32; background: rgba(205,127,50,0.1);  }
.level-badge.argent  { border-color: #a8a9ad; color: #a8a9ad; background: rgba(168,169,173,0.1); }
.level-badge.or      { border-color: #ffd700; color: #ffd700; background: rgba(255,215,0,0.1);   }
.level-badge.diamant { border-color: #b9f2ff; color: #b9f2ff; background: rgba(185,242,255,0.1); }

/* KPIs */
.kpi-row {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1rem;
  margin-bottom: 1.5rem;
}
.kpi-card {
  background: #1a1a1a;
  border: 1px solid #2a2a2a;
  border-radius: 8px;
  padding: 1rem;
  text-align: center;
}
.kpi-value { font-size: 1.8rem; font-weight: 700; }
.kpi-label { font-size: 0.75rem; color: #888; margin: 0.25rem 0; }
.kpi-trend { font-size: 0.75rem; font-weight: 600; }
.kpi-trend.up      { color: #4caf50; }
.kpi-trend.down    { color: #f44336; }
.kpi-trend.neutral { color: #888; }

/* Grid */
.dash-grid {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  grid-template-rows: auto auto;
  gap: 1rem;
}
.card {
  background: #1a1a1a;
  border: 1px solid #2a2a2a;
  border-radius: 10px;
  padding: 1rem 1.25rem;
}
.card-title {
  font-size: 0.9rem;
  font-weight: 600;
  color: #bbb;
  margin: 0 0 0.75rem;
}
.chart-hint {
  font-size: 0.75rem;
  color: #888;
  margin-top: 0.5rem;
  text-align: center;
}

/* Sims list */
.sims-card { grid-column: span 1; }
.sim-list   { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.6rem; }
.sim-item   { display: flex; align-items: center; gap: 0.75rem; font-size: 0.78rem; background: #111; border-radius: 6px; padding: 0.5rem 0.75rem; }
.sim-meta   { display: flex; gap: 0.5rem; flex-direction: column; min-width: 90px; }
.sim-date   { color: #888; }
.sim-type   { display: inline-block; padding: 1px 6px; border-radius: 10px; font-size: 0.7rem; background: #1e3a4a; color: #80cfff; }
.sim-stats  { display: flex; gap: 0.75rem; flex: 1; }
.btn-sm     { padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.7rem; cursor: pointer; }
.btn-ghost  { background: transparent; border: 1px solid #444; color: #aaa; }
.btn-ghost:hover { border-color: #2196f3; color: #2196f3; }
.empty-state { color: #555; font-style: italic; font-size: 0.85rem; text-align: center; padding: 1rem 0; }

/* Levels */
.levels-card { grid-column: span 1; }
.levels-list  { display: flex; flex-direction: column; gap: 0.6rem; }
.level-row    { }
.level-head   { display: flex; align-items: center; gap: 0.5rem; font-size: 0.82rem; margin-bottom: 4px; }
.level-name   { flex: 1; font-weight: 600; }
.level-pct    { font-weight: 700; font-size: 0.85rem; }
.level-bar-track { height: 6px; background: #2a2a2a; border-radius: 3px; }
.level-bar-fill  { height: 100%; border-radius: 3px; transition: width 0.8s ease; }
.level-bar-fill.bronze  { background: #cd7f32; }
.level-bar-fill.argent  { background: #a8a9ad; }
.level-bar-fill.or      { background: #ffd700; }
.level-bar-fill.diamant { background: #b9f2ff; }
.level-desc   { font-size: 0.68rem; color: #666; }

/* Goals */
.goals-card  { grid-column: span 1; }
.goals-list  { list-style: none; padding: 0; margin: 0 0 0.75rem; display: flex; flex-direction: column; gap: 0.4rem; }
.goal-item   { display: flex; align-items: center; gap: 0.5rem; font-size: 0.8rem; padding: 0.3rem 0; border-bottom: 1px solid #1e1e1e; }
.goal-item.done .goal-text { text-decoration: line-through; color: #555; }
.goal-text   { flex: 1; }
.goal-xp     { color: #ffd700; font-size: 0.72rem; font-weight: 600; }
.xp-summary  { font-size: 0.8rem; color: #888; }
.xp-bar-track { height: 6px; background: #2a2a2a; border-radius: 3px; margin-top: 4px; }
.xp-bar-fill  { height: 100%; background: linear-gradient(90deg, #9c27b0, #ffd700); border-radius: 3px; transition: width 0.8s ease; }

@media (max-width: 900px) {
  .kpi-row  { grid-template-columns: 1fr 1fr; }
  .dash-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 600px) {
  .kpi-row  { grid-template-columns: 1fr; }
  .dash-grid { grid-template-columns: 1fr; }
  .dash-header { flex-direction: column; align-items: flex-start; gap: 0.75rem; }
}
</style>
