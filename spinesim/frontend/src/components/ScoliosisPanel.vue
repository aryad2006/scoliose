<template>
  <div class="panel scoliosis-panel">
    <h3>🔄 Scoliose</h3>

    <div v-if="!store.spineId" class="hint">
      Créez d'abord un rachis normal pour appliquer une déformation scoliotique.
    </div>

    <template v-else>
      <!-- Classification de Lenke -->
      <div class="form-group">
        <label>Type de Lenke</label>
        <select v-model="params.lenke_type">
          <option value="1">Type 1 — Thoracique principale</option>
          <option value="2">Type 2 — Double thoracique</option>
          <option value="3">Type 3 — Double majeure</option>
          <option value="4">Type 4 — Triple majeure</option>
          <option value="5">Type 5 — Thoraco-lombaire / Lombaire</option>
          <option value="6">Type 6 — Thoraco-lombaire / Lombaire + thoracique</option>
        </select>
      </div>

      <!-- Apex -->
      <div class="form-group">
        <label>Apex de la courbure</label>
        <select v-model="params.apex">
          <option v-for="level in vertebralLevels" :key="level" :value="level">
            {{ level }}
          </option>
        </select>
      </div>

      <!-- Angle de Cobb -->
      <div class="form-group">
        <label>Angle de Cobb (°)</label>
        <input
          type="range"
          v-model.number="params.cobb_angle"
          min="10" max="120" step="1"
        />
        <span class="range-value" :class="cobbClass">
          {{ params.cobb_angle }}°
          <small>{{ cobbSeverity }}</small>
        </span>
      </div>

      <!-- Rotation axiale -->
      <div class="form-group">
        <label>Rotation axiale (°)</label>
        <input
          type="range"
          v-model.number="params.rotation"
          min="0" max="45" step="1"
        />
        <span class="range-value">{{ params.rotation }}°</span>
      </div>

      <!-- Risser -->
      <div class="form-group">
        <label>Risser (maturité)</label>
        <div class="risser-select">
          <button
            v-for="r in 6" :key="r - 1"
            :class="{ active: params.risser === r - 1 }"
            @click="params.risser = r - 1"
          >
            {{ r - 1 }}
          </button>
        </div>
      </div>

      <!-- Flexibilité -->
      <div class="form-group">
        <label>Flexibilité (%)</label>
        <input
          type="range"
          v-model.number="params.flexibility"
          min="10" max="100" step="5"
        />
        <span class="range-value">{{ params.flexibility }}%</span>
      </div>

      <!-- Presets -->
      <div class="presets">
        <label>Cas prédéfinis</label>
        <div class="preset-btns">
          <button class="btn-preset" @click="applyPreset('lenke1')">
            Lenke 1 (thoracique)
          </button>
          <button class="btn-preset" @click="applyPreset('lenke5')">
            Lenke 5 (lombaire)
          </button>
          <button class="btn-preset" @click="applyPreset('severe')">
            Sévère (90°)
          </button>
        </div>
      </div>

      <button
        class="btn primary"
        @click="applyScoliosis"
        :disabled="store.loading"
      >
        <span v-if="store.loading">⏳ Application...</span>
        <span v-else>📐 Appliquer la scoliose</span>
      </button>
    </template>
  </div>
</template>

<script setup>
import { reactive, computed } from 'vue'
import { useSpineStore } from '../stores/spineStore'

const store = useSpineStore()
const emit = defineEmits(['applied'])

const vertebralLevels = [
  'T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12',
  'L1', 'L2', 'L3', 'L4', 'L5'
]

const params = reactive({
  lenke_type: '1',
  apex: 'T8',
  cobb_angle: 45,
  rotation: 15,
  risser: 0,
  flexibility: 60,
})

const cobbClass = computed(() => {
  if (params.cobb_angle >= 80) return 'cobb-severe'
  if (params.cobb_angle >= 40) return 'cobb-moderate'
  return 'cobb-mild'
})

const cobbSeverity = computed(() => {
  if (params.cobb_angle >= 80) return 'Très sévère'
  if (params.cobb_angle >= 60) return 'Sévère'
  if (params.cobb_angle >= 40) return 'Modérée à sévère'
  if (params.cobb_angle >= 25) return 'Modérée'
  return 'Légère'
})

function applyPreset(type) {
  if (type === 'lenke1') {
    params.lenke_type = '1'
    params.apex = 'T8'
    params.cobb_angle = 55
    params.rotation = 20
    params.risser = 1
    params.flexibility = 55
  } else if (type === 'lenke5') {
    params.lenke_type = '5'
    params.apex = 'L1'
    params.cobb_angle = 45
    params.rotation = 15
    params.risser = 2
    params.flexibility = 65
  } else if (type === 'severe') {
    params.lenke_type = '3'
    params.apex = 'T8'
    params.cobb_angle = 90
    params.rotation = 35
    params.risser = 0
    params.flexibility = 30
  }
}

async function applyScoliosis() {
  await store.applyScoliosis({
    lenke_type: parseInt(params.lenke_type),
    apex: params.apex,
    cobb_angle: params.cobb_angle,
    rotation: params.rotation,
    risser: params.risser,
    flexibility: params.flexibility,
  })
  emit('applied')
}
</script>

<style scoped>
.scoliosis-panel h3 {
  margin: 0 0 16px;
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

.form-group select {
  width: 100%;
  padding: 6px 8px;
  background: var(--bg-main);
  border: 1px solid #333;
  border-radius: 4px;
  color: #eee;
  font-size: 12px;
}

.form-group input[type="range"] {
  width: 100%;
  accent-color: var(--accent);
}

.range-value {
  display: block;
  text-align: center;
  font-weight: bold;
  font-size: 14px;
  margin-top: 2px;
}

.range-value small {
  display: block;
  font-weight: normal;
  font-size: 10px;
}

.cobb-mild { color: #00ff88; }
.cobb-moderate { color: #ffaa00; }
.cobb-severe { color: #ff4444; }

.risser-select {
  display: flex;
  gap: 4px;
}

.risser-select button {
  flex: 1;
  padding: 6px;
  background: var(--bg-main);
  border: 1px solid #333;
  border-radius: 4px;
  color: #aaa;
  cursor: pointer;
  font-size: 12px;
  font-weight: bold;
  transition: all 0.2s;
}

.risser-select button.active {
  background: var(--accent);
  border-color: var(--accent);
  color: white;
}

.presets {
  margin: 16px 0 8px;
}

.presets label {
  font-size: 11px;
  color: #aaa;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.preset-btns {
  display: flex;
  flex-direction: column;
  gap: 4px;
  margin-top: 6px;
}

.btn-preset {
  padding: 5px 8px;
  background: rgba(233, 69, 96, 0.1);
  border: 1px solid rgba(233, 69, 96, 0.3);
  border-radius: 4px;
  color: #e94560;
  cursor: pointer;
  font-size: 11px;
  text-align: left;
  transition: all 0.2s;
}

.btn-preset:hover {
  background: rgba(233, 69, 96, 0.25);
  border-color: var(--accent);
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
  background: var(--accent);
  color: white;
}

.btn.primary:hover:not(:disabled) {
  background: #ff6680;
}
</style>
