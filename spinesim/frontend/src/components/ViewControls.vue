<template>
  <div class="view-controls">

    <!-- Vues prédéfinies -->
    <div class="control-group">
      <span class="group-label">Vue</span>
      <div class="btn-row">
        <button
          v-for="view in PRESET_VIEWS"
          :key="view.id"
          class="ctrl-btn"
          :class="{ active: activeView === view.id }"
          :title="view.label"
          @click="setView(view)"
        >
          {{ view.icon }}
          <span class="btn-label">{{ view.short }}</span>
        </button>
      </div>
    </div>

    <!-- Modes d'affichage -->
    <div class="control-group">
      <span class="group-label">Mode</span>
      <div class="btn-row">
        <button
          v-for="mode in DISPLAY_MODES"
          :key="mode.id"
          class="ctrl-btn"
          :class="{ active: activeMode === mode.id }"
          :title="mode.label"
          @click="setDisplayMode(mode.id)"
        >
          {{ mode.icon }}
          <span class="btn-label">{{ mode.short }}</span>
        </button>
      </div>
    </div>

    <!-- Actions -->
    <div class="control-group">
      <span class="group-label">Actions</span>
      <div class="btn-row">
        <button class="ctrl-btn" title="Réinitialiser la vue" @click="resetView">
          🎯 <span class="btn-label">Reset</span>
        </button>
        <button class="ctrl-btn" title="Capturer l'écran" @click="screenshot">
          📷 <span class="btn-label">Copier</span>
        </button>
        <button class="ctrl-btn" title="Télécharger PNG" @click="downloadScreenshot">
          💾 <span class="btn-label">PNG</span>
        </button>
        <button
          class="ctrl-btn"
          :class="{ active: isFullscreen }"
          title="Plein écran"
          @click="toggleFullscreen"
        >
          {{ isFullscreen ? '⊡' : '⛶' }}
          <span class="btn-label">{{ isFullscreen ? 'Quitter' : 'Plein' }}</span>
        </button>
      </div>
    </div>

    <!-- Toast de confirmation screenshot -->
    <Transition name="toast">
      <div v-if="toastMsg" class="toast">{{ toastMsg }}</div>
    </Transition>

  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

// ── Props ────────────────────────────────────────────────────
const props = defineProps({
  /** Instance SpineRenderer exposée par SpineViewport */
  renderer: {
    type: Object,
    default: null,
  },
  /** Élément à passer en plein écran (par défaut le viewport) */
  fullscreenTarget: {
    type: Object,
    default: null,
  },
})

// ── Configs statiques ────────────────────────────────────────
const PRESET_VIEWS = [
  { id: 'ap',       short: 'AP',    icon: '⬛', label: 'Vue de face (Antéro-Postérieure)',
    pos: [0, 200, 600], target: [0, 200, 0] },
  { id: 'lateral',  short: 'Lat',   icon: '▷', label: 'Vue latérale',
    pos: [600, 200, 0], target: [0, 200, 0] },
  { id: 'axial',    short: 'Axial', icon: '⊙', label: 'Vue axiale (de dessus)',
    pos: [0, 800, 0],   target: [0, 200, 0] },
  { id: '3d',       short: '3D',    icon: '◈', label: 'Vue 3D oblique',
    pos: [250, 350, 450], target: [0, 200, 0] },
]

const DISPLAY_MODES = [
  { id: 'anatomical',    short: 'Anat',  icon: '🦴', label: 'Mode anatomique' },
  { id: 'stress',        short: 'Stress',icon: '🌡', label: 'Mode contraintes von Mises' },
  { id: 'transparent',   short: 'Transp',icon: '👁', label: 'Mode transparent' },
  { id: 'radiographic',  short: 'Radio', icon: '🩻', label: 'Mode radiographique (filaire)' },
]

// ── État ─────────────────────────────────────────────────────
const activeView    = ref('3d')
const activeMode    = ref('anatomical')
const isFullscreen  = ref(false)
const toastMsg      = ref('')
let toastTimer      = null

// ── Actions vues ─────────────────────────────────────────────
function setView(view) {
  activeView.value = view.id
  if (!props.renderer) return

  const r = props.renderer
  const { pos, target } = view

  r.camera.position.set(...pos)
  r.controls.target.set(...target)
  r.camera.lookAt(...target)
  r.controls.update()
}

// ── Actions modes ────────────────────────────────────────────
function setDisplayMode(modeId) {
  activeMode.value = modeId
  if (!props.renderer) return
  props.renderer.setViewMode(modeId)
}

// ── Reset ────────────────────────────────────────────────────
function resetView() {
  setView(PRESET_VIEWS.find(v => v.id === '3d'))
  activeView.value = '3d'
}

// ── Screenshot ───────────────────────────────────────────────
function getCanvas() {
  return props.renderer?.renderer?.domElement ?? null
}

async function screenshot() {
  const canvas = getCanvas()
  if (!canvas) return

  try {
    // Forcer un rendu avant capture
    props.renderer.renderer.render(props.renderer.scene, props.renderer.camera)
    canvas.toBlob(async (blob) => {
      try {
        await navigator.clipboard.write([
          new ClipboardItem({ 'image/png': blob }),
        ])
        showToast('📋 Copié dans le presse-papier')
      } catch {
        showToast('⚠️ Copie non supportée — essayez "PNG"')
      }
    }, 'image/png')
  } catch (e) {
    showToast('Erreur capture')
  }
}

function downloadScreenshot() {
  const canvas = getCanvas()
  if (!canvas) return

  props.renderer.renderer.render(props.renderer.scene, props.renderer.camera)
  const url = canvas.toDataURL('image/png')
  const a = document.createElement('a')
  a.href = url
  a.download = `vertex-spine-${Date.now()}.png`
  a.click()
  showToast('💾 Téléchargement démarré')
}

// ── Plein écran ───────────────────────────────────────────────
function toggleFullscreen() {
  const el = props.fullscreenTarget ?? document.documentElement

  if (!document.fullscreenElement) {
    el.requestFullscreen?.()
  } else {
    document.exitFullscreen?.()
  }
}

function onFullscreenChange() {
  isFullscreen.value = !!document.fullscreenElement
}

// ── Toast ────────────────────────────────────────────────────
function showToast(msg) {
  toastMsg.value = msg
  clearTimeout(toastTimer)
  toastTimer = setTimeout(() => { toastMsg.value = '' }, 2500)
}

// ── Cycle de vie ─────────────────────────────────────────────
onMounted(() => {
  document.addEventListener('fullscreenchange', onFullscreenChange)
})

onUnmounted(() => {
  document.removeEventListener('fullscreenchange', onFullscreenChange)
  clearTimeout(toastTimer)
})
</script>

<style scoped>
.view-controls {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
  padding: 0.6rem;
  background: rgba(15, 52, 96, 0.85);
  border-radius: 10px;
  backdrop-filter: blur(6px);
  border: 1px solid #2a2a4a;
}

/* ── Groupe ── */
.control-group {
  display: flex;
  flex-direction: column;
  gap: 0.35rem;
}

.group-label {
  font-size: 0.65rem;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  color: #8899aa;
}

.btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 0.3rem;
}

/* ── Bouton contrôle ── */
.ctrl-btn {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.15rem;
  padding: 0.35rem 0.5rem;
  background: #16213e;
  border: 1px solid #2a2a4a;
  border-radius: 6px;
  color: #c0c8d8;
  cursor: pointer;
  font-size: 1rem;
  min-width: 48px;
  transition: all 0.15s;
  user-select: none;
}

.ctrl-btn:hover {
  background: #1a2a50;
  border-color: #e94560;
  color: #ffffff;
}

.ctrl-btn.active {
  background: #e94560;
  border-color: #e94560;
  color: #ffffff;
  box-shadow: 0 0 8px rgba(233, 69, 96, 0.5);
}

.btn-label {
  font-size: 0.6rem;
  font-weight: 600;
}

/* ── Toast ── */
.toast {
  position: fixed;
  bottom: 2rem;
  left: 50%;
  transform: translateX(-50%);
  background: #0f3460;
  color: #ffffff;
  padding: 0.5rem 1.2rem;
  border-radius: 20px;
  border: 1px solid #e94560;
  font-size: 0.82rem;
  z-index: 999;
  pointer-events: none;
  white-space: nowrap;
}

.toast-enter-active,
.toast-leave-active {
  transition: opacity 0.25s, transform 0.25s;
}

.toast-enter-from,
.toast-leave-to {
  opacity: 0;
  transform: translateX(-50%) translateY(10px);
}
</style>
