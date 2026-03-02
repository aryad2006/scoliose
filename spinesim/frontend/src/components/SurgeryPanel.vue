<template>
  <div class="panel surgery-panel">
    <h3>🔩 Chirurgie</h3>

    <div v-if="!store.spineId" class="hint">
      Créez d'abord un rachis pour accéder aux outils chirurgicaux.
    </div>

    <template v-else>
      <!-- Tabs -->
      <div class="tabs">
        <button
          :class="{ active: tab === 'screws' }"
          @click="tab = 'screws'"
        >Vis pédiculaires</button>
        <button
          :class="{ active: tab === 'rod' }"
          @click="tab = 'rod'"
        >Tige</button>
        <button
          :class="{ active: tab === 'maneuver' }"
          @click="tab = 'maneuver'"
        >Manœuvre</button>
      </div>

      <!-- Vis pédiculaires -->
      <div v-if="tab === 'screws'" class="tab-content">
        <div class="form-group">
          <label>Niveau vertébral</label>
          <select v-model="screw.level">
            <option v-for="l in instrumentedLevels" :key="l" :value="l">{{ l }}</option>
          </select>
        </div>

        <div class="form-group">
          <label>Côté</label>
          <div class="side-select">
            <button :class="{ active: screw.side === 'left' }" @click="screw.side = 'left'">
              ← Gauche
            </button>
            <button :class="{ active: screw.side === 'right' }" @click="screw.side = 'right'">
              Droite →
            </button>
          </div>
        </div>

        <div class="form-group">
          <label>Diamètre (mm)</label>
          <select v-model.number="screw.diameter">
            <option :value="4.5">4.5 mm</option>
            <option :value="5.5">5.5 mm</option>
            <option :value="6.0">6.0 mm</option>
            <option :value="6.5">6.5 mm</option>
            <option :value="7.0">7.0 mm</option>
          </select>
        </div>

        <div class="form-group">
          <label>Longueur (mm)</label>
          <select v-model.number="screw.length">
            <option :value="30">30 mm</option>
            <option :value="35">35 mm</option>
            <option :value="40">40 mm</option>
            <option :value="45">45 mm</option>
            <option :value="50">50 mm</option>
          </select>
        </div>

        <!-- Trajectoire personnalisée -->
        <div class="form-group">
          <label>Convergence (°)</label>
          <input
            type="range"
            v-model.number="screw.convergence"
            min="0" max="40" step="1"
          />
          <span class="range-value">{{ screw.convergence }}°</span>
        </div>

        <div class="form-group">
          <label>Inclinaison sagittale (°)</label>
          <input
            type="range"
            v-model.number="screw.sagittal"
            min="-15" max="30" step="1"
          />
          <span class="range-value">{{ screw.sagittal }}°</span>
        </div>

        <button class="btn primary" @click="placeScrew" :disabled="store.loading">
          🔩 Placer la vis
        </button>

        <!-- Historique des vis placées -->
        <div v-if="placedScrews.length > 0" class="screw-history">
          <label>Vis placées ({{ placedScrews.length }})</label>
          <div v-for="(s, i) in placedScrews" :key="i" class="screw-item" :class="s.resultClass">
            <span class="screw-level">{{ s.level }} {{ s.side === 'left' ? 'G' : 'D' }}</span>
            <span class="screw-info">∅{{ s.diameter }} × {{ s.length }}mm</span>
            <span class="screw-grade">{{ s.grade }}</span>
          </div>
        </div>
      </div>

      <!-- Tige -->
      <div v-if="tab === 'rod'" class="tab-content">
        <div class="form-group">
          <label>Matériau</label>
          <select v-model="rod.material">
            <option value="titanium">Titane (TiAl6V4)</option>
            <option value="cobalt_chrome">Cobalt-Chrome</option>
            <option value="nitinol">Nitinol</option>
          </select>
        </div>

        <div class="form-group">
          <label>Diamètre (mm)</label>
          <select v-model.number="rod.diameter">
            <option :value="5.5">5.5 mm (standard)</option>
            <option :value="6.0">6.0 mm</option>
            <option :value="6.35">6.35 mm (1/4")</option>
          </select>
        </div>

        <div class="form-group">
          <label>Côté</label>
          <div class="side-select">
            <button :class="{ active: rod.side === 'left' }" @click="rod.side = 'left'">
              ← Gauche
            </button>
            <button :class="{ active: rod.side === 'right' }" @click="rod.side = 'right'">
              Droite →
            </button>
          </div>
        </div>

        <div class="form-group">
          <label>Cintrage</label>
          <select v-model="rod.contouring">
            <option value="anatomical">Anatomique (lordose/cyphose)</option>
            <option value="straight">Droit</option>
            <option value="custom">Personnalisé</option>
          </select>
        </div>

        <button class="btn primary" @click="placeRod" :disabled="store.loading">
          📏 Connecter la tige
        </button>
      </div>

      <!-- Manœuvre de correction -->
      <div v-if="tab === 'maneuver'" class="tab-content">
        <div class="form-group">
          <label>Type de manœuvre</label>
          <select v-model="maneuver.type">
            <option value="rod_rotation">Rotation de la tige (Cotrel-Dubousset)</option>
            <option value="translation">Translation</option>
            <option value="compression">Compression</option>
            <option value="distraction">Distraction</option>
            <option value="derotation">Dérotation vertébrale directe</option>
          </select>
        </div>

        <div class="form-group">
          <label>Intensité (%)</label>
          <input
            type="range"
            v-model.number="maneuver.intensity"
            min="10" max="100" step="5"
          />
          <span class="range-value">{{ maneuver.intensity }}%</span>
        </div>

        <div class="maneuver-desc">
          {{ maneuverDescription }}
        </div>

        <button class="btn primary" @click="applyManeuver" :disabled="store.loading">
          ⚡ Appliquer la manœuvre
        </button>

        <button
          class="btn secondary"
          @click="evaluateSurgery"
          :disabled="store.loading"
        >
          📊 Évaluer la chirurgie
        </button>
      </div>
    </template>
  </div>
</template>

<script setup>
import { reactive, ref, computed } from 'vue'
import { useSpineStore } from '../stores/spineStore'

const store = useSpineStore()
const tab = ref('screws')

const instrumentedLevels = [
  'T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12',
  'L1', 'L2', 'L3', 'L4', 'L5', 'S1',
]

const screw = reactive({
  level: 'T5',
  side: 'left',
  diameter: 5.5,
  length: 40,
  convergence: 25,
  sagittal: 0,
})

const rod = reactive({
  material: 'titanium',
  diameter: 5.5,
  side: 'left',
  contouring: 'anatomical',
})

const maneuver = reactive({
  type: 'rod_rotation',
  intensity: 80,
})

const placedScrews = ref([])

const maneuverDescription = computed(() => {
  const desc = {
    rod_rotation: 'Rotation de 90° de la tige pour convertir la courbe coronale en cyphose thoracique. Technique de Cotrel-Dubousset.',
    translation: 'Translation latérale des vertèbres vers la tige. Utile pour courbes rigides.',
    compression: 'Compression du côté convexe pour fermer la courbe scoliotique.',
    distraction: 'Distraction du côté concave pour ouvrir la courbe.',
    derotation: 'Dérotation vertébrale directe via les vis pédiculaires. Corrige la gibbosité.',
  }
  return desc[maneuver.type] || ''
})

async function placeScrew() {
  const result = await store.placeScrew({
    level: screw.level,
    side: screw.side,
    diameter: screw.diameter,
    length: screw.length,
    entry_offset: [0, 0, 0],
    trajectory_angles: [screw.convergence, screw.sagittal],
  })

  if (result) {
    const accuracy = result.accuracy_score || 0
    let grade = '❌'
    let resultClass = 'screw-bad'
    if (accuracy >= 0.9) { grade = '⭐⭐⭐'; resultClass = 'screw-perfect' }
    else if (accuracy >= 0.7) { grade = '⭐⭐'; resultClass = 'screw-good' }
    else if (accuracy >= 0.5) { grade = '⭐'; resultClass = 'screw-ok' }

    placedScrews.value.push({
      level: screw.level,
      side: screw.side,
      diameter: screw.diameter,
      length: screw.length,
      grade,
      resultClass,
    })
  }
}

async function placeRod() {
  // Appel API tige (stub côté serveur)
  console.log('Place rod:', rod)
}

async function applyManeuver() {
  console.log('Apply maneuver:', maneuver)
}

async function evaluateSurgery() {
  console.log('Evaluate surgery')
}
</script>

<style scoped>
.surgery-panel h3 {
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

.tabs {
  display: flex;
  gap: 2px;
  margin-bottom: 12px;
}

.tabs button {
  flex: 1;
  padding: 6px 4px;
  background: var(--bg-main);
  border: 1px solid #333;
  color: #888;
  font-size: 10px;
  cursor: pointer;
  transition: all 0.2s;
}

.tabs button:first-child { border-radius: 4px 0 0 4px; }
.tabs button:last-child { border-radius: 0 4px 4px 0; }

.tabs button.active {
  background: var(--accent);
  border-color: var(--accent);
  color: white;
}

.tab-content {
  animation: fadeIn 0.2s ease;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(4px); }
  to { opacity: 1; transform: translateY(0); }
}

.form-group {
  margin-bottom: 10px;
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
  padding: 5px 6px;
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
  font-size: 12px;
}

.side-select {
  display: flex;
  gap: 4px;
}

.side-select button {
  flex: 1;
  padding: 6px;
  background: var(--bg-main);
  border: 1px solid #333;
  border-radius: 4px;
  color: #aaa;
  cursor: pointer;
  font-size: 11px;
}

.side-select button.active {
  background: var(--accent);
  border-color: var(--accent);
  color: white;
}

.maneuver-desc {
  padding: 8px;
  background: rgba(255, 255, 255, 0.03);
  border-left: 2px solid var(--accent);
  border-radius: 2px;
  font-size: 11px;
  color: #bbb;
  margin: 8px 0;
  line-height: 1.4;
}

.btn {
  width: 100%;
  padding: 7px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 12px;
  font-weight: bold;
  margin-top: 6px;
  transition: all 0.2s;
}

.btn:disabled { opacity: 0.5; cursor: not-allowed; }

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

.screw-history {
  margin-top: 12px;
}

.screw-history label {
  font-size: 11px;
  color: #aaa;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.screw-item {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 4px 6px;
  margin-top: 4px;
  border-radius: 3px;
  font-size: 11px;
  border-left: 3px solid;
}

.screw-perfect { background: rgba(0, 255, 136, 0.08); border-color: #00ff88; }
.screw-good { background: rgba(0, 200, 255, 0.08); border-color: #00c8ff; }
.screw-ok { background: rgba(255, 170, 0, 0.08); border-color: #ffaa00; }
.screw-bad { background: rgba(255, 0, 0, 0.08); border-color: #ff4444; }

.screw-level { font-weight: bold; color: #eee; min-width: 30px; }
.screw-info { color: #888; flex: 1; }
.screw-grade { font-size: 10px; }
</style>
