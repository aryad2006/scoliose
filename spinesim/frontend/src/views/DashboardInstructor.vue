<template>
  <div class="dashboard-instructor">
    <header class="dash-header">
      <div class="dash-title">
        <span class="dash-icon">🎓</span>
        <div>
          <h1>Tableau de bord formateur</h1>
          <p class="dash-subtitle">VERTEX© — Vue d'ensemble de la promotion</p>
        </div>
      </div>
      <div class="header-actions">
        <select v-model="selectedCohort" class="cohort-select">
          <option value="">Toutes les promotions</option>
          <option v-for="c in cohorts" :key="c.id" :value="c.id">{{ c.name }}</option>
        </select>
        <button class="btn btn-export" @click="exportCSV">⬇️ Export CSV</button>
      </div>
    </header>

    <!-- KPIs row -->
    <section class="kpi-row">
      <div class="kpi-card" v-for="kpi in kpiCards" :key="kpi.label">
        <div class="kpi-value" :style="{ color: kpi.color }">{{ kpi.value }}</div>
        <div class="kpi-label">{{ kpi.label }}</div>
      </div>
    </section>

    <div class="dash-grid">
      <!-- Heatmap scores par étudiant/domaine -->
      <div class="card heatmap-card">
        <div class="card-header">
          <h3 class="card-title">🔥 Heatmap — Scores par domaine</h3>
          <div class="heatmap-legend">
            <span class="hm-cell hm-low"></span> &lt;50%
            <span class="hm-cell hm-mid"></span> 50–74%
            <span class="hm-cell hm-high"></span> ≥75%
          </div>
        </div>
        <div class="heatmap-scroll">
          <table class="heatmap-table">
            <thead>
              <tr>
                <th>Étudiant</th>
                <th v-for="d in domains" :key="d.key">{{ d.short }}</th>
                <th>Moy.</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="student in filteredStudents" :key="student.id">
                <td class="student-name" @click="selectStudent(student)">
                  {{ student.name }}
                  <span class="level-pip" :class="student.level">{{ levelPip(student.level) }}</span>
                </td>
                <td
                  v-for="d in domains"
                  :key="d.key"
                  :class="heatClass(student.scores[d.key])"
                  :title="`${d.label} : ${student.scores[d.key] ?? '—'}%`"
                >
                  {{ student.scores[d.key] ?? '—' }}
                </td>
                <td class="avg-cell" :class="heatClass(studentAvg(student))">
                  <strong>{{ studentAvg(student) }}%</strong>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Distribution niveaux -->
      <div class="card chart-card">
        <h3 class="card-title">📊 Distribution des niveaux</h3>
        <canvas ref="levelChartRef" height="220"></canvas>
      </div>

      <!-- Activité dans le temps -->
      <div class="card chart-card">
        <h3 class="card-title">📈 Simulations par jour</h3>
        <canvas ref="activityChartRef" height="220"></canvas>
      </div>

      <!-- Panel détail étudiant -->
      <div class="card student-detail-card" v-if="selectedStudent">
        <h3 class="card-title">
          👤 {{ selectedStudent.name }}
          <span class="level-badge-sm" :class="selectedStudent.level">{{ levelLabel(selectedStudent.level) }}</span>
          <button class="close-btn" @click="selectedStudent = null">✕</button>
        </h3>
        <div class="detail-grid">
          <div class="detail-stat">
            <span class="ds-label">Simulations</span>
            <span class="ds-value">{{ selectedStudent.sim_count }}</span>
          </div>
          <div class="detail-stat">
            <span class="ds-label">Cobb moyen</span>
            <span class="ds-value">{{ selectedStudent.avg_cobb }}°</span>
          </div>
          <div class="detail-stat">
            <span class="ds-label">Meilleur score chir.</span>
            <span class="ds-value">{{ selectedStudent.best_surgery_score ?? '—' }}/100</span>
          </div>
          <div class="detail-stat">
            <span class="ds-label">Dernière activité</span>
            <span class="ds-value">{{ formatDate(selectedStudent.last_activity) }}</span>
          </div>
        </div>
        <canvas ref="studentRadarRef" height="180"></canvas>
        <div class="detail-actions">
          <button class="btn btn-sm btn-primary" @click="sendReminder(selectedStudent)">📧 Envoyer rappel</button>
          <button class="btn btn-sm btn-ghost" @click="viewInMoodle(selectedStudent)">🎓 Voir Moodle</button>
        </div>
      </div>

      <!-- Alertes et interventions -->
      <div class="card alerts-card">
        <h3 class="card-title">⚠️ Alertes — Étudiants en difficulté</h3>
        <div v-if="atRiskStudents.length === 0" class="empty-state">Aucune alerte active.</div>
        <ul class="alerts-list" v-else>
          <li
            v-for="student in atRiskStudents"
            :key="student.id"
            class="alert-item"
            :class="alertSeverity(student)"
          >
            <div class="alert-who">
              <strong>{{ student.name }}</strong>
              <span class="alert-level" :class="student.level">{{ levelLabel(student.level) }}</span>
            </div>
            <div class="alert-reason">{{ alertReason(student) }}</div>
            <div class="alert-actions">
              <button class="btn-xs btn-warning" @click="sendReminder(student)">Rappel</button>
              <button class="btn-xs btn-ghost" @click="selectStudent(student)">Voir</button>
            </div>
          </li>
        </ul>
      </div>

      <!-- Top performers -->
      <div class="card top-card">
        <h3 class="card-title">🏆 Top 5 — Meilleurs scores</h3>
        <ol class="top-list">
          <li
            v-for="(s, idx) in topStudents"
            :key="s.id"
            class="top-item"
          >
            <span class="top-rank">{{ idx + 1 }}</span>
            <span class="top-name" @click="selectStudent(s)">{{ s.name }}</span>
            <span class="level-pip" :class="s.level">{{ levelPip(s.level) }}</span>
            <span class="top-score">{{ studentAvg(s) }}%</span>
          </li>
        </ol>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, watch, nextTick } from 'vue'
import Chart from 'chart.js/auto'
import axios from 'axios'

// ─── Constants ───────────────────────────────────────────────────────────────
const domains = [
  { key: 'anatomie',      short: 'Anat.',  label: 'Anatomie'         },
  { key: 'radiologie',    short: 'Radio.', label: 'Radiologie'       },
  { key: 'biomecanique',  short: 'Bio.',   label: 'Biomécanique'     },
  { key: 'chirurgie',     short: 'Chir.',  label: 'Chirurgie'        },
  { key: 'complications', short: 'Comp.',  label: 'Complications'    },
]

// ─── Refs ────────────────────────────────────────────────────────────────────
const levelChartRef    = ref(null)
const activityChartRef = ref(null)
const studentRadarRef  = ref(null)

const students       = ref([])
const cohorts        = ref([])
const selectedCohort = ref('')
const selectedStudent = ref(null)
const activityData   = ref([])

let levelChart    = null
let activityChart = null
let studentRadar  = null

// ─── Computed ─────────────────────────────────────────────────────────────────
const filteredStudents = computed(() =>
  selectedCohort.value
    ? students.value.filter(s => s.cohort_id === selectedCohort.value)
    : students.value
)

const studentAvg = (s) => {
  const vals = Object.values(s.scores).filter(v => v !== null && v !== undefined)
  if (!vals.length) return 0
  return Math.round(vals.reduce((a, b) => a + b, 0) / vals.length)
}

const atRiskStudents = computed(() =>
  filteredStudents.value
    .filter(s => studentAvg(s) < 50 || s.last_activity_days > 14)
    .slice(0, 6)
)
const topStudents = computed(() =>
  [...filteredStudents.value].sort((a, b) => studentAvg(b) - studentAvg(a)).slice(0, 5)
)

const levelCounts = computed(() => {
  const counts = { bronze: 0, argent: 0, or: 0, diamant: 0 }
  filteredStudents.value.forEach(s => { if (counts[s.level] !== undefined) counts[s.level]++ })
  return counts
})

const kpiCards = computed(() => {
  const total = filteredStudents.value.length
  const avgScore = total
    ? Math.round(filteredStudents.value.reduce((s, st) => s + studentAvg(st), 0) / total)
    : 0
  const totalSims = filteredStudents.value.reduce((s, st) => s + (st.sim_count || 0), 0)
  const atRisk = atRiskStudents.value.length

  return [
    { label: 'Étudiants actifs',      value: total,            color: '#4caf50' },
    { label: 'Score moyen promotion', value: avgScore + '%',   color: '#2196f3' },
    { label: 'Simulations totales',   value: totalSims,        color: '#ff9800' },
    { label: 'Alertes actives',       value: atRisk,           color: atRisk > 0 ? '#f44336' : '#4caf50' },
  ]
})

// ─── Helpers ──────────────────────────────────────────────────────────────────
const heatClass = (v) => {
  if (v === null || v === undefined) return 'hm-null'
  if (v < 50) return 'hm-low'
  if (v < 75) return 'hm-mid'
  return 'hm-high'
}
const levelPip = (lvl) => ({ bronze: '🥉', argent: '🥈', or: '🥇', diamant: '💎' })[lvl] ?? '⬜'
const levelLabel = (lvl) => ({ bronze: 'Bronze', argent: 'Argent', or: 'Or', diamant: 'Diamant' })[lvl] ?? lvl
const alertSeverity = (s) => studentAvg(s) < 35 || s.last_activity_days > 21 ? 'alert-critical' : 'alert-warn'
const alertReason = (s) => {
  const reasons = []
  if (studentAvg(s) < 50) reasons.push(`Score moyen ${studentAvg(s)}% (seuil 50%)`)
  if (s.last_activity_days > 14) reasons.push(`Inactif depuis ${s.last_activity_days}j`)
  return reasons.join(' · ')
}
const formatDate = (iso) => {
  if (!iso) return '—'
  return new Date(iso).toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' })
}

// ─── Actions ──────────────────────────────────────────────────────────────────
const selectStudent = async (s) => {
  selectedStudent.value = s
  await nextTick()
  renderStudentRadar(s)
}

const sendReminder = async (s) => {
  try {
    await axios.post(`/api/instructor/students/${s.id}/reminder`)
    alert(`Rappel envoyé à ${s.name}`)
  } catch {
    alert('Envoi via Moodle non disponible en mode démo.')
  }
}

const viewInMoodle = (s) => {
  window.open(`/moodle/user/view.php?id=${s.moodle_id}`, '_blank')
}

const exportCSV = () => {
  const rows = [
    ['Nom', 'Niveau', 'Cohorte', ...domains.map(d => d.label), 'Moyenne', 'Simulations', 'Dernière activité'],
    ...filteredStudents.value.map(s => [
      s.name, levelLabel(s.level), s.cohort_name,
      ...domains.map(d => s.scores[d.key] ?? ''),
      studentAvg(s), s.sim_count,
      formatDate(s.last_activity),
    ]),
  ]
  const csv = rows.map(r => r.map(c => `"${c}"`).join(',')).join('\n')
  const blob = new Blob(['\uFEFF' + csv], { type: 'text/csv;charset=utf-8;' })
  const url  = URL.createObjectURL(blob)
  const a    = document.createElement('a')
  a.href     = url
  a.download = `vertex_export_${new Date().toISOString().slice(0,10)}.csv`
  a.click()
  URL.revokeObjectURL(url)
}

// ─── Data fetch ───────────────────────────────────────────────────────────────
const fetchData = async () => {
  try {
    const [studResp, cohortResp, actResp] = await Promise.all([
      axios.get('/api/instructor/students'),
      axios.get('/api/instructor/cohorts'),
      axios.get('/api/instructor/activity?days=30'),
    ])
    students.value     = studResp.data?.students   ?? []
    cohorts.value      = cohortResp.data?.cohorts  ?? []
    activityData.value = actResp.data?.daily       ?? []
  } catch {
    _loadDemoData()
  }
}

const _loadDemoData = () => {
  const mkUser = (id, name, level, scores, sims, days) => ({
    id, name, level, scores,
    sim_count: sims,
    avg_cobb: 28 + id,
    best_surgery_score: 55 + id * 3,
    last_activity: new Date(Date.now() - days * 86400000).toISOString(),
    last_activity_days: days,
    cohort_id: id < 5 ? 'c1' : 'c2',
    cohort_name: id < 5 ? 'Promo 2024' : 'Promo 2025',
    moodle_id: 100 + id,
  })
  students.value = [
    mkUser(1,  'Alice Dupont',     'or',      { anatomie:92, radiologie:85, biomecanique:78, chirurgie:72, complications:60 }, 14, 1),
    mkUser(2,  'Bob Martin',       'argent',  { anatomie:75, radiologie:68, biomecanique:60, chirurgie:50, complications:30 }, 9,  3),
    mkUser(3,  'Carla Sousa',      'bronze',  { anatomie:55, radiologie:48, biomecanique:35, chirurgie:28, complications:20 }, 4,  22),
    mkUser(4,  'Denis Moreau',     'or',      { anatomie:88, radiologie:80, biomecanique:82, chirurgie:75, complications:65 }, 18, 0),
    mkUser(5,  'Eva Leclerc',      'diamant', { anatomie:96, radiologie:93, biomecanique:90, chirurgie:88, complications:82 }, 27, 0),
    mkUser(6,  'François Leroy',   'argent',  { anatomie:70, radiologie:62, biomecanique:58, chirurgie:44, complications:38 }, 7,  8),
    mkUser(7,  'Gabrielle Simon',  'bronze',  { anatomie:40, radiologie:38, biomecanique:30, chirurgie:22, complications:15 }, 2,  30),
    mkUser(8,  'Hugo Petit',       'or',      { anatomie:85, radiologie:78, biomecanique:74, chirurgie:70, complications:58 }, 15, 2),
    mkUser(9,  'Inès Robert',      'argent',  { anatomie:72, radiologie:65, biomecanique:55, chirurgie:48, complications:35 }, 8,  5),
    mkUser(10, 'Jules Bernard',    'bronze',  { anatomie:48, radiologie:42, biomecanique:28, chirurgie:20, complications:12 }, 3,  18),
  ]
  cohorts.value = [
    { id: 'c1', name: 'Promo 2024' },
    { id: 'c2', name: 'Promo 2025' },
  ]
  // Activity: last 30 days
  activityData.value = Array.from({ length: 30 }, (_, i) => ({
    date: new Date(Date.now() - (29 - i) * 86400000).toLocaleDateString('fr-FR', { month: 'short', day: '2-digit' }),
    count: Math.floor(Math.random() * 12) + 1,
  }))
}

// ─── Chart rendering ──────────────────────────────────────────────────────────
const renderCharts = () => {
  if (levelChartRef.value) {
    levelChart?.destroy()
    const lc = levelCounts.value
    levelChart = new Chart(levelChartRef.value, {
      type: 'doughnut',
      data: {
        labels: ['Bronze', 'Argent', 'Or', 'Diamant'],
        datasets: [{
          data: [lc.bronze, lc.argent, lc.or, lc.diamant],
          backgroundColor: ['#cd7f32', '#a8a9ad', '#ffd700', '#b9f2ff'],
          borderColor: '#1a1a1a',
          borderWidth: 2,
        }],
      },
      options: {
        plugins: { legend: { position: 'bottom', labels: { color: '#aaa', font: { size: 11 } } } },
        cutout: '60%',
        animation: { duration: 600 },
      },
    })
  }

  if (activityChartRef.value && activityData.value.length) {
    activityChart?.destroy()
    activityChart = new Chart(activityChartRef.value, {
      type: 'bar',
      data: {
        labels: activityData.value.map(d => d.date),
        datasets: [{
          label: 'Simulations',
          data: activityData.value.map(d => d.count),
          backgroundColor: 'rgba(33,150,243,0.6)',
          borderRadius: 3,
        }],
      },
      options: {
        plugins: { legend: { display: false } },
        scales: { x: { ticks: { maxRotation: 45 } }, y: { beginAtZero: true } },
        animation: { duration: 600 },
      },
    })
  }
}

const renderStudentRadar = (s) => {
  if (!studentRadarRef.value) return
  studentRadar?.destroy()
  studentRadar = new Chart(studentRadarRef.value, {
    type: 'radar',
    data: {
      labels: domains.map(d => d.label),
      datasets: [{
        label: s.name,
        data: domains.map(d => s.scores[d.key] ?? 0),
        backgroundColor: 'rgba(255,152,0,0.18)',
        borderColor: '#ff9800',
        borderWidth: 2,
        pointBackgroundColor: '#ff9800',
      }],
    },
    options: {
      scales: { r: { beginAtZero: true, max: 100, ticks: { color: '#888' } } },
      plugins: { legend: { display: false } },
      animation: { duration: 400 },
    },
  })
}

// ─── Lifecycle ────────────────────────────────────────────────────────────────
onMounted(async () => {
  await fetchData()
  renderCharts()
})
onUnmounted(() => {
  levelChart?.destroy()
  activityChart?.destroy()
  studentRadar?.destroy()
})
watch(filteredStudents, renderCharts, { deep: true })
</script>

<style scoped>
.dashboard-instructor {
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
  flex-wrap: wrap;
  gap: 0.75rem;
}
.dash-title {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}
.dash-icon { font-size: 2.2rem; }
.dash-title h1 { font-size: 1.4rem; margin: 0; color: #fff; }
.dash-subtitle { font-size: 0.8rem; color: #888; margin: 0; }
.header-actions { display: flex; gap: 0.75rem; align-items: center; }
.cohort-select {
  background: #1a1a1a;
  border: 1px solid #333;
  color: #ccc;
  border-radius: 6px;
  padding: 0.35rem 0.75rem;
  font-size: 0.8rem;
}
.btn { padding: 0.4rem 0.9rem; border-radius: 6px; font-size: 0.8rem; cursor: pointer; border: none; }
.btn-export { background: #1e3a2a; color: #4caf50; border: 1px solid #2e5a3a; }
.btn-export:hover { background: #2e5a3a; }
.btn-primary { background: #1e3060; color: #80b0ff; border: 1px solid #2e4080; }
.btn-ghost   { background: transparent; color: #aaa; border: 1px solid #444; }

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
.kpi-label { font-size: 0.73rem; color: #888; margin-top: 0.25rem; }

/* Grid */
.dash-grid {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr;
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
  display: flex;
  align-items: center;
  gap: 0.5rem;
  flex-wrap: wrap;
}

/* Heatmap */
.heatmap-card { grid-column: span 2; }
.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.75rem;
}
.heatmap-legend { display: flex; align-items: center; gap: 0.4rem; font-size: 0.72rem; color: #888; }
.hm-cell {
  display: inline-block;
  width: 16px;
  height: 12px;
  border-radius: 2px;
  margin-left: 6px;
}
.hm-null { background: #2a2a2a; }
.hm-low  { background: #4d1515; }
.hm-mid  { background: #4d3d00; }
.hm-high { background: #1a4d1a; }

.heatmap-scroll { overflow-x: auto; }
.heatmap-table {
  border-collapse: collapse;
  width: 100%;
  font-size: 0.77rem;
}
.heatmap-table th, .heatmap-table td {
  border: 1px solid #2a2a2a;
  padding: 0.3rem 0.5rem;
  text-align: center;
  white-space: nowrap;
}
.heatmap-table th { background: #111; color: #888; font-weight: 600; }
.student-name { text-align: left; cursor: pointer; color: #9ecfff; display: flex; align-items: center; gap: 0.3rem; }
.student-name:hover { text-decoration: underline; }
.level-pip { font-size: 0.75rem; }
.avg-cell { font-weight: 700; }

/* Chart cards */
.chart-card { min-height: 260px; }

/* Student detail */
.student-detail-card { grid-column: 1; }
.level-badge-sm {
  font-size: 0.7rem;
  padding: 2px 8px;
  border-radius: 10px;
  border: 1px solid;
  font-weight: 600;
}
.level-badge-sm.bronze  { border-color: #cd7f32; color: #cd7f32; }
.level-badge-sm.argent  { border-color: #a8a9ad; color: #a8a9ad; }
.level-badge-sm.or      { border-color: #ffd700; color: #ffd700; }
.level-badge-sm.diamant { border-color: #b9f2ff; color: #b9f2ff; }
.close-btn { margin-left: auto; background: none; border: none; color: #666; cursor: pointer; font-size: 1rem; }
.detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; margin-bottom: 0.75rem; }
.detail-stat { background: #111; border-radius: 6px; padding: 0.4rem 0.6rem; }
.ds-label { font-size: 0.7rem; color: #666; display: block; }
.ds-value { font-size: 1rem; font-weight: 700; color: #e0e0e0; }
.detail-actions { display: flex; gap: 0.5rem; margin-top: 0.75rem; }
.btn-sm { padding: 0.3rem 0.75rem; border-radius: 5px; font-size: 0.75rem; cursor: pointer; border: none; }

/* Alerts */
.alerts-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.5rem; }
.alert-item {
  padding: 0.5rem 0.75rem;
  border-radius: 6px;
  border-left: 3px solid;
  font-size: 0.78rem;
}
.alert-critical { border-color: #f44336; background: rgba(244,67,54,0.07); }
.alert-warn     { border-color: #ff9800; background: rgba(255,152,0,0.07); }
.alert-who      { display: flex; align-items: center; gap: 0.4rem; margin-bottom: 0.2rem; font-weight: 600; }
.alert-level    { font-size: 0.68rem; }
.alert-reason   { color: #888; font-size: 0.72rem; }
.alert-actions  { display: flex; gap: 0.4rem; margin-top: 0.35rem; }
.btn-xs { padding: 0.15rem 0.5rem; border-radius: 4px; font-size: 0.68rem; cursor: pointer; border: none; }
.btn-warning { background: rgba(255,152,0,0.18); color: #ff9800; }
.btn-ghost   { background: transparent; border: 1px solid #333; color: #888; }

/* Top */
.top-list { list-style: none; padding: 0; margin: 0; }
.top-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.4rem 0;
  border-bottom: 1px solid #1e1e1e;
  font-size: 0.82rem;
}
.top-rank  { font-weight: 700; color: #666; min-width: 1.2rem; text-align: center; }
.top-name  { flex: 1; cursor: pointer; color: #9ecfff; }
.top-name:hover { text-decoration: underline; }
.top-score { font-weight: 700; color: #4caf50; }
.empty-state { color: #555; font-style: italic; text-align: center; padding: 1rem 0; font-size: 0.85rem; }

@media (max-width: 1100px) {
  .dash-grid { grid-template-columns: 1fr 1fr; }
  .heatmap-card { grid-column: span 2; }
}
@media (max-width: 700px) {
  .kpi-row  { grid-template-columns: 1fr 1fr; }
  .dash-grid { grid-template-columns: 1fr; }
  .heatmap-card { grid-column: span 1; }
}
</style>
