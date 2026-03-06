<template>
  <div id="vertex-app">
    <!-- Header -->
    <header class="header">
      <div class="header-left">
        <h1>🦴 VERTEX<sup>©</sup></h1>
        <span class="version">v0.2.0 — Rachis Simulator</span>
      </div>
      <div class="header-center">
        <div class="view-modes">
          <button
            v-for="mode in viewModes"
            :key="mode.id"
            :class="{ active: currentView === mode.id }"
            @click="currentView = mode.id"
            :title="mode.label"
          >
            {{ mode.icon }}
          </button>
        </div>
      </div>
      <div class="header-right">
        <button class="btn-primary" @click="createSpine" :disabled="loading">
          {{ loading ? '⏳' : '🦴' }} Nouveau rachis
        </button>
      </div>
    </header>

    <!-- Main content -->
    <div class="main-layout">
      <!-- Left panel: Controls -->
      <aside class="panel panel-left">
        <PatientPanel
          :patient="patient"
          @update="updatePatient"
        />
        <ScoliosisPanel
          v-if="spineId"
          :spineId="spineId"
          @applied="onScoliosisApplied"
        />
        <SurgeryPanel
          v-if="spineId && spineData"
          :spineId="spineId"
          :vertebrae="spineData?.vertebrae || []"
        />
      </aside>

      <!-- Center: 3D Viewport -->
      <main ref="viewportContainer" class="viewport-container">
        <SpineViewport
          ref="viewport"
          :spineData="spineData"
          :stresses="stresses"
          :viewMode="currentView"
        />
        <!-- Contrôles de vue (overlay en bas à gauche du viewport) -->
        <div v-if="spineRenderer" class="viewport-controls">
          <ViewControls
            :renderer="spineRenderer"
            :fullscreenTarget="viewportContainer"
          />
        </div>
        <div v-if="!spineId" class="empty-state">
          <p>🦴 Cliquez sur <strong>Nouveau rachis</strong> pour commencer</p>
          <p class="sub">VERTEX© — Virtual Environment for Rachis Training and EXploration</p>
        </div>
        <div v-if="solverInfo" class="solver-badge">
          ✅ Résolu en {{ solverInfo.time }}ms — max σ<sub>VM</sub> = {{ solverInfo.maxStress }} MPa
        </div>
      </main>

      <!-- Right panel: Results -->
      <aside class="panel panel-right">
        <ResultsPanel
          v-if="spineData"
          :spineData="spineData"
          :stresses="stresses"
          :solverInfo="solverInfo"
        />
        <MeasurementPanel v-if="spineId" :spineId="spineId" />
        <LongitudinalPanel />
        <ReportPanel v-if="spineData" :spineData="spineData" :stresses="stresses" />
      </aside>
    </div>

    <!-- Status bar -->
    <footer class="statusbar">
      <span>{{ statusMessage }}</span>
      <span v-if="spineId">ID: {{ spineId.substring(0, 8) }}…</span>
      <span>{{ spineData ? spineData.vertebrae.length + ' vertèbres' : '' }}</span>
    </footer>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useSpineStore } from './stores/spineStore'
import SpineViewport from './components/SpineViewport.vue'
import ViewControls from './components/ViewControls.vue'
import PatientPanel from './components/PatientPanel.vue'
import ScoliosisPanel from './components/ScoliosisPanel.vue'
import SurgeryPanel from './components/SurgeryPanel.vue'
import ResultsPanel from './components/ResultsPanel.vue'
import MeasurementPanel from './components/MeasurementPanel.vue'
import ReportPanel from './components/ReportPanel.vue'
import LongitudinalPanel from './components/LongitudinalPanel.vue'

const store = useSpineStore()
const loading = ref(false)
const viewport = ref(null)
const viewportContainer = ref(null)
const spineRenderer = ref(null)
const currentView = ref('anatomical')

const viewModes = [
  { id: 'anatomical', icon: '🦴', label: 'Vue anatomique' },
  { id: 'radiographic', icon: '📷', label: 'Vue radiographique' },
  { id: 'stress', icon: '🌡️', label: 'Contraintes (heatmap)' },
  { id: 'surgical', icon: '🔪', label: 'Vue chirurgicale' },
  { id: 'transparent', icon: '👁️', label: 'Vue transparente' },
]

const patient = ref({
  weight: 70,
  height: 170,
  age: 30,
  sex: 'M',
  tscore: 0.0,
})

const spineId = computed(() => store.spineId)
const spineData = computed(() => store.spineData)
const stresses = computed(() => store.stresses)
const solverInfo = computed(() => store.solverInfo)
const statusMessage = computed(() => store.statusMessage)

function updatePatient(newPatient) {
  patient.value = { ...patient.value, ...newPatient }
}

async function createSpine() {
  loading.value = true
  try {
    await store.createSpine(patient.value)
    await store.solveSpine()
  } finally {
    loading.value = false
  }
}

function onScoliosisApplied() {
  store.solveSpine()
}

onMounted(() => {
  // Attendre le prochain tick pour que SpineViewport soit monté
  setTimeout(() => {
    if (viewport.value?.renderer) {
      spineRenderer.value = viewport.value.renderer
    }
  }, 100)
})
</script>

<style>
/* ── Reset & Global ── */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

:root {
  --bg-dark: #1a1a2e;
  --bg-panel: #16213e;
  --bg-card: #0f3460;
  --accent: #e94560;
  --accent-light: #ff6b6b;
  --text: #eee;
  --text-muted: #a0a0b0;
  --border: #2a2a4a;
  --success: #4ecdc4;
  --warning: #ffe66d;
  --danger: #ff6b6b;
  --bone: #f5e6d3;
  --disc: #7ec8e3;
}

body {
  font-family: 'Segoe UI', system-ui, sans-serif;
  background: var(--bg-dark);
  color: var(--text);
  overflow: hidden;
  height: 100vh;
}

#vertex-app {
  display: flex;
  flex-direction: column;
  height: 100vh;
}

/* ── Header ── */
.header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 8px 16px;
  background: var(--bg-panel);
  border-bottom: 1px solid var(--border);
  height: 52px;
}

.header h1 {
  font-size: 1.3rem;
  color: var(--accent);
}

.header h1 sup {
  font-size: 0.7rem;
}

.version {
  font-size: 0.75rem;
  color: var(--text-muted);
  margin-left: 10px;
}

.view-modes {
  display: flex;
  gap: 4px;
}

.view-modes button {
  background: var(--bg-card);
  border: 1px solid var(--border);
  color: var(--text);
  padding: 6px 12px;
  border-radius: 6px;
  cursor: pointer;
  font-size: 1rem;
  transition: all 0.2s;
}

.view-modes button.active {
  background: var(--accent);
  border-color: var(--accent-light);
}

.view-modes button:hover:not(.active) {
  background: var(--border);
}

.btn-primary {
  background: var(--accent);
  border: none;
  color: white;
  padding: 8px 16px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 0.9rem;
  font-weight: 600;
  transition: background 0.2s;
}

.btn-primary:hover:not(:disabled) {
  background: var(--accent-light);
}

.btn-primary:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

/* ── Main Layout ── */
.main-layout {
  display: flex;
  flex: 1;
  overflow: hidden;
}

.panel {
  width: 300px;
  background: var(--bg-panel);
  border-right: 1px solid var(--border);
  overflow-y: auto;
  padding: 12px;
}

.panel-right {
  border-right: none;
  border-left: 1px solid var(--border);
}

.viewport-container {
  flex: 1;
  position: relative;
  background: var(--bg-dark);
}

.empty-state {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  color: var(--text-muted);
}

.empty-state p {
  font-size: 1.2rem;
  margin-bottom: 8px;
}

.empty-state .sub {
  font-size: 0.85rem;
}

.solver-badge {
  position: absolute;
  bottom: 16px;
  left: 50%;
  transform: translateX(-50%);
  background: rgba(15, 52, 96, 0.9);
  color: var(--success);
  padding: 6px 16px;
  border-radius: 20px;
  font-size: 0.8rem;
  border: 1px solid var(--success);
}

.viewport-controls {
  position: absolute;
  bottom: 50px;
  left: 12px;
  z-index: 10;
}

/* ── Status Bar ── */
.statusbar {
  display: flex;
  justify-content: space-between;
  padding: 4px 16px;
  background: var(--bg-panel);
  border-top: 1px solid var(--border);
  font-size: 0.75rem;
  color: var(--text-muted);
  height: 28px;
  align-items: center;
}

/* ── Card style for panels ── */
.card {
  background: var(--bg-card);
  border-radius: 8px;
  padding: 12px;
  margin-bottom: 12px;
  border: 1px solid var(--border);
}

.card h3 {
  font-size: 0.9rem;
  color: var(--accent);
  margin-bottom: 8px;
  display: flex;
  align-items: center;
  gap: 6px;
}

.form-group {
  margin-bottom: 8px;
}

.form-group label {
  display: block;
  font-size: 0.75rem;
  color: var(--text-muted);
  margin-bottom: 2px;
}

.form-group input,
.form-group select {
  width: 100%;
  padding: 6px 8px;
  background: var(--bg-dark);
  border: 1px solid var(--border);
  border-radius: 4px;
  color: var(--text);
  font-size: 0.85rem;
}

.form-row {
  display: flex;
  gap: 8px;
}

.form-row .form-group {
  flex: 1;
}

.btn-secondary {
  background: var(--bg-card);
  border: 1px solid var(--accent);
  color: var(--accent);
  padding: 6px 12px;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.85rem;
  width: 100%;
  transition: all 0.2s;
}

.btn-secondary:hover {
  background: var(--accent);
  color: white;
}

.metric {
  display: flex;
  justify-content: space-between;
  padding: 4px 0;
  border-bottom: 1px solid rgba(255,255,255,0.05);
  font-size: 0.8rem;
}

.metric-label {
  color: var(--text-muted);
}

.metric-value {
  font-weight: 600;
}

.metric-value.good { color: var(--success); }
.metric-value.warning { color: var(--warning); }
.metric-value.danger { color: var(--danger); }
</style>
