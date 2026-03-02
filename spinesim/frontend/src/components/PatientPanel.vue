<template>
  <div class="panel patient-panel">
    <h3>👤 Patient</h3>

    <div class="form-group">
      <label>Poids (kg)</label>
      <input
        type="number"
        v-model.number="patient.weight"
        min="30" max="150" step="1"
      />
    </div>

    <div class="form-group">
      <label>Taille (cm)</label>
      <input
        type="number"
        v-model.number="patient.height"
        min="100" max="220" step="1"
      />
    </div>

    <div class="form-group">
      <label>Âge (ans)</label>
      <input
        type="number"
        v-model.number="patient.age"
        min="5" max="90" step="1"
      />
    </div>

    <div class="form-group">
      <label>Sexe</label>
      <select v-model="patient.sex">
        <option value="F">Féminin</option>
        <option value="M">Masculin</option>
      </select>
    </div>

    <div class="form-group">
      <label>T-score (densité osseuse)</label>
      <input
        type="range"
        v-model.number="patient.tscore"
        min="-4" max="2" step="0.1"
      />
      <span class="range-value" :class="tscoreClass">
        {{ patient.tscore.toFixed(1) }}
        <small>{{ tscoreLabel }}</small>
      </span>
    </div>

    <button class="btn primary" @click="createSpine" :disabled="store.loading">
      <span v-if="store.loading">⏳ Calcul...</span>
      <span v-else>🦴 Créer le rachis</span>
    </button>

    <button
      v-if="store.spineId"
      class="btn secondary"
      @click="solveSpine"
      :disabled="store.loading"
    >
      ⚙️ Résoudre (FEM)
    </button>

    <button class="btn outline" @click="reset">
      🔄 Réinitialiser
    </button>

    <div v-if="store.error" class="error-msg">
      ⚠️ {{ store.error }}
    </div>
  </div>
</template>

<script setup>
import { reactive, computed } from 'vue'
import { useSpineStore } from '../stores/spineStore'

const store = useSpineStore()

const patient = reactive({
  weight: 70,
  height: 170,
  age: 14,
  sex: 'F',
  tscore: 0.0,
})

const tscoreClass = computed(() => {
  if (patient.tscore <= -2.5) return 'tscore-osteoporosis'
  if (patient.tscore <= -1.0) return 'tscore-osteopenia'
  return 'tscore-normal'
})

const tscoreLabel = computed(() => {
  if (patient.tscore <= -2.5) return 'Ostéoporose'
  if (patient.tscore <= -1.0) return 'Ostéopénie'
  return 'Normal'
})

async function createSpine() {
  await store.createSpine(patient)
}

async function solveSpine() {
  await store.solveSpine()
}

function reset() {
  store.reset()
  patient.weight = 70
  patient.height = 170
  patient.age = 14
  patient.sex = 'F'
  patient.tscore = 0.0
}
</script>

<style scoped>
.patient-panel h3 {
  margin: 0 0 16px;
  font-size: 14px;
  color: var(--accent);
}

.form-group {
  margin-bottom: 12px;
}

.form-group label {
  display: block;
  font-size: 11px;
  color: #aaa;
  margin-bottom: 4px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.form-group input[type="number"],
.form-group select {
  width: 100%;
  padding: 6px 8px;
  background: var(--bg-main);
  border: 1px solid #333;
  border-radius: 4px;
  color: #eee;
  font-size: 13px;
}

.form-group input[type="range"] {
  width: 100%;
  accent-color: var(--accent);
}

.range-value {
  display: block;
  text-align: center;
  font-weight: bold;
  font-size: 13px;
  margin-top: 4px;
}

.range-value small {
  display: block;
  font-weight: normal;
  font-size: 10px;
}

.tscore-normal { color: #00ff88; }
.tscore-osteopenia { color: #ffaa00; }
.tscore-osteoporosis { color: #ff4444; }

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
  background: var(--accent);
  color: white;
}

.btn.primary:hover:not(:disabled) {
  background: #ff6680;
}

.btn.secondary {
  background: #2a4a8a;
  color: white;
}

.btn.secondary:hover:not(:disabled) {
  background: #3a5a9a;
}

.btn.outline {
  background: transparent;
  color: #888;
  border: 1px solid #444;
}

.btn.outline:hover:not(:disabled) {
  border-color: #888;
  color: #ccc;
}

.error-msg {
  margin-top: 10px;
  padding: 6px 8px;
  background: rgba(255, 0, 0, 0.15);
  border-left: 3px solid #ff4444;
  border-radius: 2px;
  font-size: 11px;
  color: #ff8888;
}
</style>
