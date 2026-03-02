/**
 * VERTEX© — Moteur de rendu 3D du rachis
 * Three.js WebGL 2.0 renderer
 */
import * as THREE from 'three'
import { OrbitControls } from 'three/addons/controls/OrbitControls.js'

// Couleurs des modes d'affichage
const COLORS = {
  bone: 0xf5e6d3,
  boneEdge: 0xd4c5a9,
  disc: 0x7ec8e3,
  discDegen: 0x4a6fa5,
  ligament: 0x90ee90,
  ligamentLVCA: 0x00cc00,
  ligamentLVCP: 0xcc0000,
  ligamentFlavum: 0xcccc00,
  screw: 0xc0c0c0,
  rod: 0xa0a0a0,
  background: 0x1a1a2e,
  grid: 0x2a2a4a,
  accent: 0xe94560,
}

// Palette de stress (bleu → vert → jaune → rouge)
const STRESS_PALETTE = [
  new THREE.Color(0x0000ff),  // 0% — bleu
  new THREE.Color(0x00ffff),  // 25% — cyan
  new THREE.Color(0x00ff00),  // 50% — vert
  new THREE.Color(0xffff00),  // 75% — jaune
  new THREE.Color(0xff0000),  // 100% — rouge
]

export class SpineRenderer {
  constructor(container) {
    this.container = container
    this.viewMode = 'anatomical'
    this.vertebraeMeshes = []
    this.discMeshes = []
    this.ligamentLines = []
    this.screwMeshes = []
    this.labels = []

    this._initScene()
    this._initLights()
    this._initGrid()
    this._initControls()
    this._onResize = this._onResize.bind(this)
    window.addEventListener('resize', this._onResize)
  }

  _initScene() {
    this.scene = new THREE.Scene()
    this.scene.background = new THREE.Color(COLORS.background)
    this.scene.fog = new THREE.FogExp2(COLORS.background, 0.0008)

    const { clientWidth: w, clientHeight: h } = this.container
    this.camera = new THREE.PerspectiveCamera(45, w / h, 0.1, 5000)
    this.camera.position.set(0, 100, 400)
    this.camera.lookAt(0, 200, 0)

    this.renderer = new THREE.WebGLRenderer({
      antialias: true,
      alpha: false,
      powerPreference: 'high-performance',
    })
    this.renderer.setSize(w, h)
    this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))
    this.renderer.shadowMap.enabled = true
    this.renderer.shadowMap.type = THREE.PCFSoftShadowMap
    this.renderer.toneMapping = THREE.ACESFilmicToneMapping
    this.renderer.toneMappingExposure = 1.2
    this.container.appendChild(this.renderer.domElement)

    // Raycaster for interactivity
    this.raycaster = new THREE.Raycaster()
    this.mouse = new THREE.Vector2()
    this.renderer.domElement.addEventListener('click', this._onClick.bind(this))
  }

  _initLights() {
    // Ambient
    const ambient = new THREE.AmbientLight(0xffffff, 0.4)
    this.scene.add(ambient)

    // Key light (surgical lamp)
    const key = new THREE.DirectionalLight(0xffffff, 0.8)
    key.position.set(50, 300, 200)
    key.castShadow = true
    key.shadow.mapSize.set(2048, 2048)
    key.shadow.camera.near = 10
    key.shadow.camera.far = 1000
    key.shadow.camera.left = -200
    key.shadow.camera.right = 200
    key.shadow.camera.top = 500
    key.shadow.camera.bottom = -100
    this.scene.add(key)

    // Fill light
    const fill = new THREE.DirectionalLight(0xc0d0ff, 0.3)
    fill.position.set(-100, 200, -100)
    this.scene.add(fill)

    // Rim light
    const rim = new THREE.DirectionalLight(0xffe0c0, 0.2)
    rim.position.set(0, 50, -200)
    this.scene.add(rim)
  }

  _initGrid() {
    const grid = new THREE.GridHelper(400, 20, COLORS.grid, COLORS.grid)
    grid.position.y = -10
    grid.material.opacity = 0.3
    grid.material.transparent = true
    this.scene.add(grid)

    // Axes helper (petit, coin inférieur)
    const axes = new THREE.AxesHelper(30)
    axes.position.set(-180, 0, -180)
    this.scene.add(axes)
  }

  _initControls() {
    this.controls = new OrbitControls(this.camera, this.renderer.domElement)
    this.controls.enableDamping = true
    this.controls.dampingFactor = 0.08
    this.controls.minDistance = 100
    this.controls.maxDistance = 1500
    this.controls.target.set(0, 200, 0)
    this.controls.update()
  }

  /**
   * Met à jour le modèle 3D du rachis à partir des données du serveur.
   */
  updateSpine(data) {
    this._clearSpine()

    if (!data || !data.vertebrae) return

    const vertebrae = data.vertebrae
    const discs = data.discs || []

    // ── Vertèbres ──
    vertebrae.forEach((v, i) => {
      const mesh = this._createVertebraMesh(v)
      this.scene.add(mesh)
      this.vertebraeMeshes.push(mesh)

      // Label du niveau
      const label = this._createLabel(v.level, v.position)
      this.scene.add(label)
      this.labels.push(label)
    })

    // ── Disques ──
    discs.forEach((d) => {
      const mesh = this._createDiscMesh(d)
      this.scene.add(mesh)
      this.discMeshes.push(mesh)
    })

    // ── Ligaments (lignes entre vertèbres adjacentes) ──
    for (let i = 0; i < vertebrae.length - 1; i++) {
      const p1 = vertebrae[i].position
      const p2 = vertebrae[i + 1].position

      // LVCA (antérieur, vert)
      this._addLigamentLine(
        [p1[0], p1[2], p1[1] + 15],
        [p2[0], p2[2], p2[1] + 15],
        COLORS.ligamentLVCA
      )
      // LVCP (postérieur, rouge)
      this._addLigamentLine(
        [p1[0], p1[2], p1[1] - 15],
        [p2[0], p2[2], p2[1] - 15],
        COLORS.ligamentLVCP
      )
    }

    // Centrer la caméra
    this._centerCamera(vertebrae)
  }

  /**
   * Crée le mesh 3D d'une vertèbre (corps + pédicules + lame simplifiés).
   */
  _createVertebraMesh(v) {
    const group = new THREE.Group()
    const morph = v.morphology

    // Corps vertébral — cylindre aplati
    const bodyGeom = new THREE.CylinderGeometry(
      morph.body_width / 2 * 0.8,  // rayon supérieur (mm → unités 3D, échelle 1:1)
      morph.body_width / 2,         // rayon inférieur
      morph.body_height,
      16, 1
    )
    const bodyMat = new THREE.MeshPhongMaterial({
      color: COLORS.bone,
      specular: 0x333333,
      shininess: 20,
      flatShading: false,
    })
    const bodyMesh = new THREE.Mesh(bodyGeom, bodyMat)
    bodyMesh.castShadow = true
    bodyMesh.receiveShadow = true
    bodyMesh.userData = { type: 'vertebra', level: v.level }
    group.add(bodyMesh)

    // Pédicules — deux petits cylindres latéraux
    for (const side of [-1, 1]) {
      const pedGeom = new THREE.CylinderGeometry(
        morph.pedicle_width / 2, morph.pedicle_width / 2,
        morph.body_depth * 0.6, 8
      )
      const pedMesh = new THREE.Mesh(pedGeom, bodyMat)
      pedMesh.rotation.x = Math.PI / 2
      pedMesh.position.set(
        side * morph.body_width / 3,
        0,
        -morph.body_depth / 3
      )
      pedMesh.castShadow = true
      group.add(pedMesh)
    }

    // Processus épineux — petit cône postérieur
    const spGeom = new THREE.ConeGeometry(3, morph.body_depth * 0.4, 4)
    const spMesh = new THREE.Mesh(spGeom, bodyMat)
    spMesh.rotation.x = Math.PI / 2
    spMesh.position.set(0, 0, -morph.body_depth * 0.7)
    group.add(spMesh)

    // Position dans l'espace (coordonnées du serveur: x=latéral, y=AP, z=vertical)
    // Three.js: x=latéral, y=vertical, z=AP
    group.position.set(v.position[0], v.position[2], v.position[1])

    return group
  }

  /**
   * Crée le mesh 3D d'un disque intervertébral.
   */
  _createDiscMesh(d) {
    const geom = new THREE.CylinderGeometry(
      d.width / 2 * 0.85,
      d.width / 2 * 0.85,
      d.height,
      16, 1
    )

    // Couleur varie selon la dégénérescence (Pfirrmann)
    const grade = d.pfirrmann || 1
    const hue = 0.55 - grade * 0.08  // bleu → gris selon dégénérescence
    const color = new THREE.Color().setHSL(hue, 0.5, 0.55)

    const mat = new THREE.MeshPhongMaterial({
      color: color,
      transparent: true,
      opacity: 0.7,
      specular: 0x222222,
      shininess: 10,
    })

    const mesh = new THREE.Mesh(geom, mat)
    mesh.position.set(d.position[0], d.position[2], d.position[1])
    mesh.userData = { type: 'disc', level: d.level, pfirrmann: grade }

    return mesh
  }

  /**
   * Ajoute une ligne de ligament entre deux points.
   */
  _addLigamentLine(p1, p2, color) {
    const points = [
      new THREE.Vector3(p1[0], p1[1], p1[2]),
      new THREE.Vector3(p2[0], p2[1], p2[2]),
    ]
    const geom = new THREE.BufferGeometry().setFromPoints(points)
    const mat = new THREE.LineBasicMaterial({ color, linewidth: 2, transparent: true, opacity: 0.6 })
    const line = new THREE.Line(geom, mat)
    this.scene.add(line)
    this.ligamentLines.push(line)
  }

  /**
   * Crée un label texte 3D (sprite) pour identifier le niveau vertébral.
   */
  _createLabel(text, position) {
    const canvas = document.createElement('canvas')
    const ctx = canvas.getContext('2d')
    canvas.width = 128
    canvas.height = 64

    ctx.fillStyle = 'transparent'
    ctx.fillRect(0, 0, 128, 64)

    ctx.font = 'bold 28px monospace'
    ctx.fillStyle = '#e94560'
    ctx.textAlign = 'center'
    ctx.textBaseline = 'middle'
    ctx.fillText(text, 64, 32)

    const texture = new THREE.CanvasTexture(canvas)
    const mat = new THREE.SpriteMaterial({ map: texture, transparent: true, opacity: 0.8 })
    const sprite = new THREE.Sprite(mat)
    sprite.position.set(position[0] - 40, position[2], position[1])
    sprite.scale.set(30, 15, 1)

    return sprite
  }

  /**
   * Met à jour les couleurs selon les contraintes de von Mises.
   */
  updateStresses(stresses) {
    if (!stresses || stresses.length === 0) return

    const maxStress = Math.max(...stresses, 0.001)

    // Chaque stress correspond à un segment (entre 2 vertèbres)
    // → colorer les 2 vertèbres adjacentes
    this.vertebraeMeshes.forEach((group, i) => {
      const s = i < stresses.length ? stresses[i] : (i > 0 ? stresses[i - 1] : 0)
      const ratio = Math.min(s / maxStress, 1)
      const color = this._stressColor(ratio)

      group.traverse((child) => {
        if (child.isMesh) {
          if (this.viewMode === 'stress') {
            child.material.color.copy(color)
            child.material.emissive.copy(color).multiplyScalar(0.15)
          } else {
            child.material.color.setHex(COLORS.bone)
            child.material.emissive.setHex(0x000000)
          }
        }
      })
    })
  }

  /**
   * Interpole la couleur de stress (bleu → vert → jaune → rouge).
   */
  _stressColor(ratio) {
    const idx = ratio * (STRESS_PALETTE.length - 1)
    const lower = Math.floor(idx)
    const upper = Math.min(lower + 1, STRESS_PALETTE.length - 1)
    const frac = idx - lower
    const color = new THREE.Color()
    color.lerpColors(STRESS_PALETTE[lower], STRESS_PALETTE[upper], frac)
    return color
  }

  /**
   * Change le mode d'affichage.
   */
  setViewMode(mode) {
    this.viewMode = mode

    const isStress = mode === 'stress'
    const isTransparent = mode === 'transparent'
    const isRadio = mode === 'radiographic'

    this.vertebraeMeshes.forEach((group) => {
      group.traverse((child) => {
        if (child.isMesh) {
          if (isRadio) {
            child.material.color.setHex(0x999999)
            child.material.wireframe = true
            child.material.opacity = 0.8
          } else if (isTransparent) {
            child.material.color.setHex(COLORS.bone)
            child.material.transparent = true
            child.material.opacity = 0.3
            child.material.wireframe = false
          } else {
            child.material.color.setHex(COLORS.bone)
            child.material.transparent = false
            child.material.opacity = 1.0
            child.material.wireframe = false
          }
        }
      })
    })

    this.discMeshes.forEach((mesh) => {
      mesh.visible = mode !== 'radiographic'
    })

    this.ligamentLines.forEach((line) => {
      line.visible = mode === 'anatomical' || mode === 'surgical'
    })

    // Si stress mode, re-appliquer les couleurs
    if (isStress) {
      // Les couleurs seront appliquées par updateStresses
    }
  }

  /**
   * Centre la caméra sur le rachis.
   */
  _centerCamera(vertebrae) {
    if (!vertebrae || vertebrae.length === 0) return

    const center = new THREE.Vector3()
    vertebrae.forEach((v) => {
      center.add(new THREE.Vector3(v.position[0], v.position[2], v.position[1]))
    })
    center.divideScalar(vertebrae.length)

    this.controls.target.copy(center)
    this.camera.position.set(center.x, center.y, center.z + 300)
    this.controls.update()
  }

  /**
   * Gestion du clic — sélection de vertèbre.
   */
  _onClick(event) {
    const rect = this.renderer.domElement.getBoundingClientRect()
    this.mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1
    this.mouse.y = -((event.clientY - rect.top) / rect.height) * 2 + 1

    this.raycaster.setFromCamera(this.mouse, this.camera)
    const intersects = this.raycaster.intersectObjects(this.vertebraeMeshes, true)

    // Reset previous selection
    this.vertebraeMeshes.forEach((g) => {
      g.traverse((c) => {
        if (c.isMesh) c.material.emissive.setHex(0x000000)
      })
    })

    if (intersects.length > 0) {
      const hit = intersects[0].object
      hit.material.emissive.setHex(COLORS.accent)
      hit.material.emissiveIntensity = 0.3

      // Trouver le parent group pour obtenir les userData
      let parent = hit
      while (parent.parent && !parent.userData.type) {
        parent = parent.parent
      }
      if (parent.userData.level) {
        console.log(`🦴 Vertèbre sélectionnée: ${parent.userData.level}`)
      }
    }
  }

  /**
   * Nettoie tous les objets du rachis.
   */
  _clearSpine() {
    this.vertebraeMeshes.forEach((m) => this.scene.remove(m))
    this.discMeshes.forEach((m) => this.scene.remove(m))
    this.ligamentLines.forEach((l) => this.scene.remove(l))
    this.labels.forEach((l) => this.scene.remove(l))
    this.screwMeshes.forEach((m) => this.scene.remove(m))

    this.vertebraeMeshes = []
    this.discMeshes = []
    this.ligamentLines = []
    this.labels = []
    this.screwMeshes = []
  }

  _onResize() {
    const { clientWidth: w, clientHeight: h } = this.container
    this.camera.aspect = w / h
    this.camera.updateProjectionMatrix()
    this.renderer.setSize(w, h)
  }

  /**
   * Boucle d'animation.
   */
  animate() {
    requestAnimationFrame(() => this.animate())
    this.controls.update()
    this.renderer.render(this.scene, this.camera)
  }

  /**
   * Libère les ressources.
   */
  dispose() {
    window.removeEventListener('resize', this._onResize)
    this.renderer.dispose()
    this._clearSpine()
  }
}
