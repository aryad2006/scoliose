/**
 * VERTEX© — Tests unitaires Vitest
 * Couverture : SpineRenderer, ScrewPlacer, stores, composants
 *
 * Lancer :
 *   cd spinesim/frontend
 *   npx vitest run          # mode CI
 *   npx vitest              # mode watch
 *   npx vitest --coverage   # avec rapport Istanbul
 */

import { describe, it, expect, vi, beforeEach, afterEach } from 'vitest'
import { mount } from '@vue/test-utils'
import { createPinia, setActivePinia } from 'pinia'

// ─────────────────────────────────────────────────────────────────────────────
// Helpers & stubs
// ─────────────────────────────────────────────────────────────────────────────

/** Mock THREE.js pour éviter WebGL dans les tests */
vi.mock('three', () => {
  const Vec3 = class {
    constructor(x = 0, y = 0, z = 0) { this.x = x; this.y = y; this.z = z }
    set(x, y, z) { this.x = x; this.y = y; this.z = z; return this }
    clone() { return new Vec3(this.x, this.y, this.z) }
    normalize() { return this }
    copy(v) { this.x = v.x; this.y = v.y; this.z = v.z; return this }
    applyEuler() { return this }
    subVectors(a, b) { this.x = a.x - b.x; this.y = a.y - b.y; this.z = a.z - b.z; return this }
    dot(b) { return this.x * b.x + this.y * b.y + this.z * b.z }
  }
  const Quat = class {
    setFromUnitVectors() { return this }
  }
  const Euler = class {
    constructor(x = 0, y = 0, z = 0) { this.x = x; this.y = y; this.z = z }
  }
  class FakeGeometry { dispose = vi.fn() }
  class FakeMaterial { dispose = vi.fn(); constructor(p = {}) { Object.assign(this, p) } }
  class FakeMesh {
    position = new Vec3()
    rotation = new Euler()
    scale    = new Vec3(1, 1, 1)
    quaternion = new Quat()
    children = []
    geometry = new FakeGeometry()
    material = new FakeMaterial()
    add(child) { this.children.push(child) }
    remove(child) { this.children = this.children.filter(c => c !== child) }
    traverse(fn) { fn(this) }
    raycast() {}
  }
  class FakeScene extends FakeMesh { }
  class FakeCamera {
    position = new Vec3(0, 0, 300)
    lookAt = vi.fn()
    updateProjectionMatrix = vi.fn()
    aspect = 1
  }
  class FakeRenderer {
    domElement = { addEventListener: vi.fn(), style: {} }
    setSize = vi.fn()
    setPixelRatio = vi.fn()
    render = vi.fn()
    dispose = vi.fn()
  }
  return {
    __esModule: true,
    Vector3: Vec3,
    Quaternion: Quat,
    Euler,
    Scene: FakeScene,
    PerspectiveCamera: FakeCamera,
    WebGLRenderer: FakeRenderer,
    Mesh: FakeMesh,
    Group: FakeMesh,
    CylinderGeometry: FakeGeometry,
    TubeGeometry: FakeGeometry,
    MeshStandardMaterial: FakeMaterial,
    MeshPhongMaterial: FakeMaterial,
    MeshBasicMaterial: FakeMaterial,
    AmbientLight: class { },
    DirectionalLight: class { position = new Vec3() },
    Raycaster: class {
      setFromCamera = vi.fn()
      intersectObjects = vi.fn(() => [])
    },
    CatmullRomCurve3: class { constructor(pts) { this.points = pts } },
    BufferGeometry: FakeGeometry,
    Color: class { constructor(c) { this.c = c } },
    SphereGeometry: FakeGeometry,
    BoxGeometry: FakeGeometry,
    ExtrudeGeometry: FakeGeometry,
    Shape: class {
      moveTo = vi.fn()
      lineTo = vi.fn()
      quadraticCurveTo = vi.fn()
    },
  }
})

vi.mock('axios', () => ({
  default: {
    get:  vi.fn(() => Promise.resolve({ data: {} })),
    post: vi.fn(() => Promise.resolve({ data: {} })),
  },
}))

vi.mock('chart.js/auto', () => ({
  default: class {
    constructor() {}
    destroy = vi.fn()
    update  = vi.fn()
  },
}))

// ─────────────────────────────────────────────────────────────────────────────
// Tests : Store Pinia
// ─────────────────────────────────────────────────────────────────────────────

describe('spineStore', () => {
  beforeEach(() => setActivePinia(createPinia()))

  it('initialise avec des valeurs par défaut', async () => {
    const { useSpineStore } = await import('../src/stores/spineStore.js')
    const store = useSpineStore()
    expect(store.spineData).toBeNull()
    expect(store.isLoading).toBe(false)
    expect(store.selectedPathology).toBe('scoliosis')
    expect(store.surgicalResult).toBeNull()
  })

  it('setPathology met à jour le type de pathologie', async () => {
    const { useSpineStore } = await import('../src/stores/spineStore.js')
    const store = useSpineStore()
    store.setPathology('disc_hernia')
    expect(store.selectedPathology).toBe('disc_hernia')
  })

  it('surgicalResult est mutable', async () => {
    const { useSpineStore } = await import('../src/stores/spineStore.js')
    const store = useSpineStore()
    store.surgicalResult = { score: 75, cobb_correction: 12 }
    expect(store.surgicalResult.score).toBe(75)
  })
})

// ─────────────────────────────────────────────────────────────────────────────
// Tests : SpineRenderer
// ─────────────────────────────────────────────────────────────────────────────

describe('SpineRenderer', () => {
  let renderer
  const mockCanvas = {
    getContext: () => ({ canvas: { width: 800, height: 600 } }),
    addEventListener: vi.fn(),
    style: {},
    width: 800,
    height: 600,
  }

  beforeEach(async () => {
    const { SpineRenderer } = await import('../src/engine/SpineRenderer.js')
    renderer = new SpineRenderer(mockCanvas)
  })

  afterEach(() => {
    renderer?.dispose?.()
  })

  it('initialise screwMeshes et rodMeshes vides', () => {
    expect(Array.isArray(renderer.screwMeshes)).toBe(true)
    expect(Array.isArray(renderer.rodMeshes)).toBe(true)
    expect(renderer.screwMeshes.length).toBe(0)
    expect(renderer.rodMeshes.length).toBe(0)
  })

  it('addScrew ajoute un mesh dans screwMeshes', () => {
    const screwData = {
      id: 'screw_L4_left',
      level: 'L4',
      side: 'left',
      position: { x: -15, y: 100, z: 0 },
      direction: { x: 0.3, y: 0, z: -1 },
      diameter: 6.5,
      length: 45,
    }
    renderer.addScrew(screwData)
    expect(renderer.screwMeshes.length).toBe(1)
    expect(renderer.screwMeshes[0].screwId).toBe('screw_L4_left')
  })

  it('clearHardware vide screwMeshes et rodMeshes', () => {
    renderer.addScrew({
      id: 'test', level: 'L3', side: 'left',
      position: { x: 0, y: 0, z: 0 }, direction: { x: 0, y: 1, z: 0 },
      diameter: 6, length: 40,
    })
    expect(renderer.screwMeshes.length).toBe(1)
    renderer.clearHardware()
    expect(renderer.screwMeshes.length).toBe(0)
    expect(renderer.rodMeshes.length).toBe(0)
  })

  it('addRod ajoute un mesh dans rodMeshes', () => {
    const rodData = {
      side: 'left',
      diameter: 5.5,
      screwPositions: [{ x: -15, y: 120 }, { x: -15, y: 90 }, { x: -15, y: 60 }],
    }
    renderer.addRod(rodData)
    expect(renderer.rodMeshes.length).toBe(1)
  })
})

// ─────────────────────────────────────────────────────────────────────────────
// Tests : ScrewPlacer
// ─────────────────────────────────────────────────────────────────────────────

describe('ScrewPlacer', () => {
  let placer
  const mockRenderer = {
    screwMeshes: [],
    vertebraeMeshes: [],
    scene: { add: vi.fn(), remove: vi.fn() },
    addScrew: vi.fn(d => ({ screwId: d.id, position: new (require('three').Vector3)() })),
    camera: {},
    renderer: { domElement: { addEventListener: vi.fn(), removeEventListener: vi.fn() } },
  }

  beforeEach(async () => {
    const { ScrewPlacer } = await import('../src/engine/ScrewPlacer.js')
    placer = new ScrewPlacer(mockRenderer)
  })

  it('crée sans erreur', () => {
    expect(placer).toBeDefined()
  })

  it('on() enregistre un listener', () => {
    const cb = vi.fn()
    placer.on('placed', cb)
    expect(placer._listeners['placed']).toContain(cb)
  })

  it('placeAutomatic place la vis bilatéralement si side === bilateral', async () => {
    const params = { level: 'L4', side: 'bilateral', diameter: 6.5, length: 45, angle: 15 }
    await placer.placeAutomatic(params)
    // Au moins 2 appels : un pour left, un pour right
    expect(mockRenderer.addScrew.mock.calls.length).toBeGreaterThanOrEqual(2)
  })

  it('clearAll déclenche event cleared', () => {
    const cb = vi.fn()
    placer.on('cleared', cb)
    placer.clearAll()
    expect(cb).toHaveBeenCalled()
  })
})

// ─────────────────────────────────────────────────────────────────────────────
// Tests : Composant PatientPanel
// ─────────────────────────────────────────────────────────────────────────────

describe('PatientPanel.vue', () => {
  beforeEach(() => setActivePinia(createPinia()))

  it('monte sans erreur critique', async () => {
    const { default: PatientPanel } = await import('../src/components/PatientPanel.vue')
    const wrapper = mount(PatientPanel, {
      global: { plugins: [createPinia()] },
    })
    expect(wrapper.exists()).toBe(true)
  })

  it('affiche le sélecteur de pathologie', async () => {
    const { default: PatientPanel } = await import('../src/components/PatientPanel.vue')
    const wrapper = mount(PatientPanel, {
      global: { plugins: [createPinia()] },
    })
    // Vérifier qu'il y a un select ou des boutons de sélection de pathologie
    const hasSelect  = wrapper.find('select').exists()
    const hasOptions = wrapper.findAll('[data-pathology]').length > 0 ||
                       wrapper.text().toLowerCase().includes('scoliose')
    expect(hasSelect || hasOptions || wrapper.html().includes('patholog')).toBe(true)
  })
})

// ─────────────────────────────────────────────────────────────────────────────
// Tests : Utilitaires — calculs biomécaniques
// ─────────────────────────────────────────────────────────────────────────────

describe('Calculs biomécaniques', () => {
  // Calcul de l'angle de Cobb simplifié
  const cobbAngle = (endplate1, endplate2) => {
    const a1 = endplate1 * Math.PI / 180
    const a2 = endplate2 * Math.PI / 180
    return Math.abs(Math.atan(Math.tan(a1) - Math.tan(a2)) * 180 / Math.PI)
  }

  it('calcule un angle de Cobb cohérent', () => {
    const cobb = cobbAngle(10, -10)
    expect(cobb).toBeGreaterThan(15)
    expect(cobb).toBeLessThan(25)
  })

  // Score chirurgical simplifié
  const computeSurgeryScore = ({ cobbCorrection, svaDelta, pjkRisk }) => {
    let score = 100
    score -= Math.max(0, 15 - cobbCorrection) * 2  // -2 par degré manquant
    score -= Math.max(0, svaDelta - 20) * 0.5       // pénalité si SVA > 20mm
    score -= pjkRisk * 20                           // pénalité risque PJK (0-1)
    return Math.max(0, Math.round(score))
  }

  it('score chirurgical maximal si correction parfaite', () => {
    const score = computeSurgeryScore({ cobbCorrection: 25, svaDelta: 5, pjkRisk: 0 })
    expect(score).toBe(100)
  })

  it('score chirurgical réduit si correction insuffisante', () => {
    const score = computeSurgeryScore({ cobbCorrection: 5, svaDelta: 5, pjkRisk: 0 })
    expect(score).toBeLessThan(80)
  })

  it('score chirurgical réduit si risque PJK élevé', () => {
    const score = computeSurgeryScore({ cobbCorrection: 25, svaDelta: 5, pjkRisk: 0.8 })
    expect(score).toBeLessThan(90)
  })

  // Contrainte axiale (hypothèse simplifiée)
  const axialStress = (force_N, area_mm2) => force_N / area_mm2  // MPa = N/mm²
  it('contrainte axiale cohérente avec la physique', () => {
    const sigma = axialStress(500, 25)  // 500N sur 25mm²
    expect(sigma).toBe(20)              // 20 MPa
  })
})

// ─────────────────────────────────────────────────────────────────────────────
// Tests : DashboardStudent
// ─────────────────────────────────────────────────────────────────────────────

describe('DashboardStudent.vue', () => {
  beforeEach(() => setActivePinia(createPinia()))

  it('monte et affiche le titre', async () => {
    const { default: DashboardStudent } = await import('../src/views/DashboardStudent.vue')
    const wrapper = mount(DashboardStudent, {
      global: {
        plugins: [createPinia()],
        stubs: { canvas: true },
      },
    })
    expect(wrapper.text()).toContain('Tableau de bord')
  })

  it('affiche le badge de niveau', async () => {
    const { default: DashboardStudent } = await import('../src/views/DashboardStudent.vue')
    const wrapper = mount(DashboardStudent, {
      global: {
        plugins: [createPinia()],
        stubs: { canvas: true },
      },
    })
    const badge = wrapper.find('.level-badge')
    expect(badge.exists()).toBe(true)
  })
})
