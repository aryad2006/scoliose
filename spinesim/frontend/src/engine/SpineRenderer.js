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
    this.rodMeshes = []
    this.labels = []
    this._cameraAnim = null  // animation en cours

    this._initScene()
    this._initLights()
    this._initGrid()
    this._initControls()
    this._initEnvironment()
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
   * Crée la forme 2D réniforme (kidney-shape) d'un corps vertébral.
   * Utilise des courbes de Bézier pour approximer la section transversale
   * réniforme des vertèbres lombaires/thoraciques.
   *
   * @param {number} w - Demi-largeur (mm)
   * @param {number} d - Demi-profondeur (mm)
   * @returns {THREE.Shape}
   */
  _createVertebraShape(w, d) {
    const shape = new THREE.Shape()

    // Coin postérieur gauche
    shape.moveTo(-w, -d * 0.1)

    // Arc antérieur (convexe — corps vertébral)
    shape.bezierCurveTo(
      -w * 0.8,  d * 1.0,   // cp1
       w * 0.8,  d * 1.0,   // cp2
       w,       -d * 0.1    // fin
    )

    // Arc postérieur droit (légèrement concave — canal médullaire)
    shape.bezierCurveTo(
       w * 0.7, -d * 0.9,   // cp1
       w * 0.2, -d * 1.1,   // cp2
       0,       -d * 0.85   // milieu — concavité postérieure
    )

    // Arc postérieur gauche
    shape.bezierCurveTo(
      -w * 0.2, -d * 1.1,
      -w * 0.7, -d * 0.9,
      -w,       -d * 0.1
    )

    shape.closePath()
    return shape
  }

  /**
   * Crée le mesh 3D d'une vertèbre avec ExtrudeGeometry réniforme et matériau PBR.
   */
  _createVertebraMesh(v) {
    const group = new THREE.Group()
    const morph = v.morphology

    // Dimensions en mm (coordonnées 1:1)
    const hw = morph.body_width  / 2   // demi-largeur
    const hd = morph.body_depth  / 2   // demi-profondeur
    const bh = morph.body_height        // hauteur corps

    // ── Corps vertébral (ExtrudeGeometry réniforme) ──
    const bodyShape = this._createVertebraShape(hw * 0.92, hd * 0.85)

    const extrudeSettings = {
      depth: bh,
      bevelEnabled: true,
      bevelThickness: 1.2,
      bevelSize: 1.0,
      bevelSegments: 2,
      steps: 1,
    }

    const bodyGeom = new THREE.ExtrudeGeometry(bodyShape, extrudeSettings)
    bodyGeom.center()

    // Matériau PBR os cortical
    const bodyMat = new THREE.MeshStandardMaterial({
      color:     COLORS.bone,
      roughness: 0.72,
      metalness: 0.04,
      envMapIntensity: 0.6,
    })

    const bodyMesh = new THREE.Mesh(bodyGeom, bodyMat)
    bodyMesh.rotation.x = -Math.PI / 2   // XZ-plan → Three.js XY-plan
    bodyMesh.castShadow = true
    bodyMesh.receiveShadow = true
    bodyMesh.userData = { type: 'vertebra', level: v.level }
    group.add(bodyMesh)

    // ── Pédicules — cylindres PBR ──
    const pedMat = new THREE.MeshStandardMaterial({
      color:     COLORS.bone,
      roughness: 0.65,
      metalness: 0.02,
    })

    for (const side of [-1, 1]) {
      const pedGeom = new THREE.CylinderGeometry(
        morph.pedicle_width / 2 * 0.8,
        morph.pedicle_width / 2,
        morph.body_depth * 0.55,
        10
      )
      const pedMesh = new THREE.Mesh(pedGeom, pedMat)
      pedMesh.rotation.x = Math.PI / 2
      pedMesh.position.set(
        side * hw * 0.62,
        0,
        -hd * 0.35
      )
      pedMesh.castShadow = true
      group.add(pedMesh)
    }

    // ── Lamines — connexion pédicules → processus épineux ──
    const lamMat = new THREE.MeshStandardMaterial({
      color:     COLORS.bone,
      roughness: 0.68,
      metalness: 0.03,
    })
    for (const side of [-1, 1]) {
      const lamGeom = new THREE.BoxGeometry(
        hw * 0.35,                  // largeur
        bh * 0.45,                  // hauteur
        morph.body_depth * 0.12     // épaisseur
      )
      const lamMesh = new THREE.Mesh(lamGeom, lamMat)
      lamMesh.position.set(
        side * hw * 0.35,
        0,
        -hd * 0.55
      )
      lamMesh.castShadow = true
      group.add(lamMesh)
    }

    // ── Processus transverses — cylindres latéraux ──
    for (const side of [-1, 1]) {
      const tpGeom = new THREE.CylinderGeometry(2.0, 1.4, hw * 0.55, 8)
      const tpMesh = new THREE.Mesh(tpGeom, pedMat)
      tpMesh.rotation.z = side * Math.PI / 2
      tpMesh.position.set(
        side * (hw * 0.85),
        0,
        -hd * 0.25
      )
      tpMesh.castShadow = true
      group.add(tpMesh)
    }

    // ── Facettes articulaires — petites sphères supérieures/inférieures ──
    const facMat = new THREE.MeshStandardMaterial({
      color:     0xe8d5c0,
      roughness: 0.50,
      metalness: 0.06,
    })
    for (const side of [-1, 1]) {
      for (const sup of [-1, 1]) {  // -1 = inférieur, +1 = supérieur
        const facGeom = new THREE.SphereGeometry(2.2, 8, 6)
        const facMesh = new THREE.Mesh(facGeom, facMat)
        facMesh.position.set(
          side * hw * 0.45,
          sup * bh * 0.38,
          -hd * 0.65
        )
        group.add(facMesh)
      }
    }

    // ── Processus épineux — cône PBR ──
    const spGeom = new THREE.ConeGeometry(2.8, morph.body_depth * 0.42, 5)
    const spMesh = new THREE.Mesh(spGeom, pedMat)
    spMesh.rotation.x = Math.PI / 2
    spMesh.position.set(0, 0, -hd * 0.72)
    group.add(spMesh)

    // ── Plateaux vertébraux — disques fins ──
    for (const yOff of [-bh / 2 - 0.8, bh / 2 + 0.8]) {
      const plateShape = this._createVertebraShape(hw * 0.88, hd * 0.82)
      const plateGeom  = new THREE.ExtrudeGeometry(plateShape, {
        depth: 1.5, bevelEnabled: false
      })
      plateGeom.center()
      const plateMat = new THREE.MeshStandardMaterial({
        color:     0xd4c5a9,
        roughness: 0.55,
        metalness: 0.05,
      })
      const plateMesh = new THREE.Mesh(plateGeom, plateMat)
      plateMesh.rotation.x = -Math.PI / 2
      plateMesh.position.y = yOff
      group.add(plateMesh)
    }

    // Position dans l'espace (serveur: [x=lat, y=AP, z=vertical] → Three.js: [x, y(vert), z(AP)])
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
    this.rodMeshes.forEach((m) => this.scene.remove(m))

    this.vertebraeMeshes = []
    this.discMeshes = []
    this.ligamentLines = []
    this.labels = []
    this.screwMeshes = []
    this.rodMeshes = []
  }

  _onResize() {
    const { clientWidth: w, clientHeight: h } = this.container
    this.camera.aspect = w / h
    this.camera.updateProjectionMatrix()
    this.renderer.setSize(w, h)
  }

  /**
   * Ajoute une vis pédiculaire dans la scène 3D.
   *
   * @param {Object} screwData
   *   { level: 'L3', side: 'left'|'right',
   *     entry: [x,y,z], direction: [dx,dy,dz],
   *     diameter: 6.0, length: 45.0,
   *     material: 'titanium'|'coba_chrome' }
   * @returns {THREE.Object3D} Le groupe ajouté à la scène.
   */
  addScrew(screwData) {
    const {
      entry = [0, 0, 0],
      direction = [0, 0, -1],
      diameter = 6.0,
      length = 45.0,
      material: mat = 'titanium',
      level = '',
      side = 'left',
    } = screwData

    const metalColor  = mat === 'titanium' ? 0xafc4d6 : 0x8a9bb0   // Titane / Cobalt-Chrome
    const headColor   = mat === 'titanium' ? 0xc8d8e8 : 0xa8b8c8

    const group = new THREE.Group()
    group.userData = { type: 'screw', level, side, screwData }

    // Filet (cylindre légèrement conique)
    const shaftGeo = new THREE.CylinderGeometry(
      diameter * 0.5 * 0.9,  // rayon supérieur
      diameter * 0.5 * 0.6,  // rayon inférieur (pointe)
      length,
      16,
      8,
    )
    const shaftMat = new THREE.MeshStandardMaterial({
      color: metalColor,
      metalness: 0.92,
      roughness: 0.18,
    })
    const shaft = new THREE.Mesh(shaftGeo, shaftMat)
    shaft.castShadow = true
    group.add(shaft)

    // Tête de vis (cylindre plus large)
    const headGeo = new THREE.CylinderGeometry(diameter * 0.75, diameter * 0.65, diameter * 1.2, 16)
    const headMat = new THREE.MeshStandardMaterial({
      color: headColor,
      metalness: 0.95,
      roughness: 0.12,
    })
    const head = new THREE.Mesh(headGeo, headMat)
    head.position.y = length * 0.5 + diameter * 0.6
    head.castShadow = true
    group.add(head)

    // Orienter le groupe selon `direction`
    const dir = new THREE.Vector3(...direction).normalize()
    const yAxis = new THREE.Vector3(0, 1, 0)
    const q = new THREE.Quaternion()
    if (Math.abs(dir.dot(yAxis)) < 0.9999) {
      q.setFromUnitVectors(yAxis, dir)
    } else if (dir.y < 0) {
      q.setFromAxisAngle(new THREE.Vector3(1, 0, 0), Math.PI)
    }
    group.setRotationFromQuaternion(q)

    // Translater vers le point d'entrée
    group.position.set(...entry)

    this.scene.add(group)
    this.screwMeshes.push(group)

    return group
  }

  /**
   * Ajoute une tige de connexion entre plusieurs vis.
   *
   * @param {Object} rodData
   *   { screwHeads: [[x,y,z], ...], diameter: 5.5,
   *     material: 'titanium'|'cobalt_chrome', side: 'left'|'right' }
   * @returns {THREE.Mesh}
   */
  addRod(rodData) {
    const {
      screwHeads = [],
      diameter = 5.5,
      material: mat = 'titanium',
      side = 'left',
    } = rodData

    if (screwHeads.length < 2) {
      console.warn('[SpineRenderer] addRod: besoin d\'au moins 2 points')
      return null
    }

    const rodColor = mat === 'titanium' ? 0xbbd0e8 : 0x9aaaca  // Titane légèrement bleuté

    const points = screwHeads.map((p) => new THREE.Vector3(...p))
    const curve  = new THREE.CatmullRomCurve3(points)

    const tubeGeo = new THREE.TubeGeometry(curve, 64, diameter * 0.5, 12, false)
    const tubeMat = new THREE.MeshStandardMaterial({
      color: rodColor,
      metalness: 0.95,
      roughness: 0.10,
      envMapIntensity: 1.0,
    })
    const rod = new THREE.Mesh(tubeGeo, tubeMat)
    rod.castShadow = true
    rod.userData = { type: 'rod', side, rodData }

    this.scene.add(rod)
    this.rodMeshes.push(rod)

    return rod
  }

  /**
   * Supprime le matériel chirurgical (vis + tiges) sans toucher au rachis.
   */
  clearHardware() {
    this.screwMeshes.forEach((m) => {
      m.traverse((c) => { if (c.isMesh) { c.geometry.dispose(); c.material.dispose() } })
      this.scene.remove(m)
    })
    this.rodMeshes.forEach((m) => {
      m.geometry.dispose()
      m.material.dispose()
      this.scene.remove(m)
    })
    this.screwMeshes = []
    this.rodMeshes  = []
  }

  /**
   * Anime la correction progressive du rachis.
   * Interpole chaque vertèbre de sa position initiale vers la position corrigée.
   *
   * @param {number[]} targetCorrectionsPct — [0-100] pour chaque vertèbre
   * @param {number}   durationMs           — durée totale de l'animation (ms)
   */
  animateCorrection(targetCorrectionsPct = [], durationMs = 2000) {
    if (this.vertebraeMeshes.length === 0) return

    const startPositions = this.vertebraeMeshes.map((g) => g.position.clone())
    const startRotations = this.vertebraeMeshes.map((g) => g.rotation.clone())
    const startTime = performance.now()

    const tick = () => {
      const elapsed = performance.now() - startTime
      const t = Math.min(elapsed / durationMs, 1.0)
      const ease = t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t  // ease-in-out

      this.vertebraeMeshes.forEach((group, i) => {
        const pct = (targetCorrectionsPct[i] ?? 0) / 100

        // Réduction de la rotation en z (courbure coronale)
        const origRz = startRotations[i].z
        group.rotation.z = origRz * (1 - ease * pct)

        // Légère translation coronale pour simuler le maintien de la tige
        const driftX = startPositions[i].x * ease * pct * 0.3
        group.position.x = startPositions[i].x - driftX
      })

      if (t < 1.0) requestAnimationFrame(tick)
    }

    requestAnimationFrame(tick)
  }

  /**
   * Initialise un environment map procédural pour les reflets PBR.
   * Simule un environnement de bloc opératoire (neutre, lumineux).
   */
  _initEnvironment() {
    const pmremGenerator = new THREE.PMREMGenerator(this.renderer)
    pmremGenerator.compileEquirectangularShader()

    // Scène d'environnement simple (ciel neutre chirurgical)
    const envScene = new THREE.Scene()
    envScene.background = new THREE.Color(0xd0d8e0)

    // Sol
    const floorGeo = new THREE.PlaneGeometry(2000, 2000)
    const floorMat = new THREE.MeshBasicMaterial({ color: 0xb0bec5 })
    const floor = new THREE.Mesh(floorGeo, floorMat)
    floor.rotation.x = -Math.PI / 2
    floor.position.y = -100
    envScene.add(floor)

    // Plafond lumineux (scialytique)
    const ceilGeo = new THREE.PlaneGeometry(400, 400)
    const ceilMat = new THREE.MeshBasicMaterial({ color: 0xffffff })
    const ceil = new THREE.Mesh(ceilGeo, ceilMat)
    ceil.rotation.x = Math.PI / 2
    ceil.position.y = 600
    envScene.add(ceil)

    this.envMap = pmremGenerator.fromScene(envScene, 0.04).texture
    this.scene.environment = this.envMap
    pmremGenerator.dispose()
    envScene.clear()
  }

  /**
   * Anime la caméra vers une position/target avec easing.
   *
   * @param {number[]} targetPos   — [x, y, z] position caméra cible
   * @param {number[]} targetLook  — [x, y, z] point de regard cible
   * @param {number}   durationMs  — durée de l'animation (ms, défaut 600)
   */
  setCameraView(targetPos, targetLook, durationMs = 600) {
    // Annuler toute animation en cours
    if (this._cameraAnim) {
      cancelAnimationFrame(this._cameraAnim)
      this._cameraAnim = null
    }

    const startPos = this.camera.position.clone()
    const startTarget = this.controls.target.clone()
    const endPos = new THREE.Vector3(...targetPos)
    const endTarget = new THREE.Vector3(...targetLook)
    const startTime = performance.now()

    const tick = () => {
      const elapsed = performance.now() - startTime
      const t = Math.min(elapsed / durationMs, 1.0)
      // Ease-out cubic
      const ease = 1 - Math.pow(1 - t, 3)

      this.camera.position.lerpVectors(startPos, endPos, ease)
      this.controls.target.lerpVectors(startTarget, endTarget, ease)
      this.controls.update()

      if (t < 1.0) {
        this._cameraAnim = requestAnimationFrame(tick)
      } else {
        this._cameraAnim = null
      }
    }

    this._cameraAnim = requestAnimationFrame(tick)
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
