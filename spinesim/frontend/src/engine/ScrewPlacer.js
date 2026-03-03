/**
 * VERTEX© — ScrewPlacer.js
 *
 * Moteur de placement interactif des vis pédiculaires.
 * Gère le workflow : clic → point d'entrée → trajectoire → validation → appel API.
 *
 * Usage :
 *   const placer = new ScrewPlacer(renderer, apiClient)
 *   placer.activate({ level: 'L3', side: 'left', diameter: 6.5, length: 45, angle: 15 })
 *   placer.on('placed', (result) => { ... })
 *   placer.deactivate()
 */

import * as THREE from 'three'

/** Couleurs de prévisualisation */
const PREVIEW_COLOR  = 0x00e5ff   // Cyan — vis en cours de placement
const VALID_COLOR    = 0x00e676   // Vert — trajectoire valide
const BREACH_COLOR   = 0xff1744   // Rouge — breach détectée
const WARNING_COLOR  = 0xffab00   // Ambre — avertissement

/** Paramètres morphologiques par niveau (pé°dicule, mm) */
const PEDICLE_SAFE_ZONE = {
  C3: { diameter_max: 5.5, length_max: 35, medial_angle: 45, caudal_angle: 5 },
  C4: { diameter_max: 5.7, length_max: 35, medial_angle: 45, caudal_angle: 5 },
  C5: { diameter_max: 6.0, length_max: 38, medial_angle: 45, caudal_angle: 5 },
  C6: { diameter_max: 6.2, length_max: 38, medial_angle: 45, caudal_angle: 5 },
  C7: { diameter_max: 7.0, length_max: 40, medial_angle: 40, caudal_angle: 5 },
  T1: { diameter_max: 7.5, length_max: 40, medial_angle: 30, caudal_angle: 0 },
  T2: { diameter_max: 7.0, length_max: 40, medial_angle: 25, caudal_angle: 0 },
  T3: { diameter_max: 6.8, length_max: 40, medial_angle: 20, caudal_angle: 0 },
  T4: { diameter_max: 6.5, length_max: 40, medial_angle: 15, caudal_angle: 0 },
  T5: { diameter_max: 6.5, length_max: 40, medial_angle: 15, caudal_angle: 0 },
  T6: { diameter_max: 6.7, length_max: 42, medial_angle: 15, caudal_angle: 0 },
  T7: { diameter_max: 7.0, length_max: 42, medial_angle: 15, caudal_angle: 0 },
  T8: { diameter_max: 7.5, length_max: 42, medial_angle: 15, caudal_angle: 0 },
  T9: { diameter_max: 7.8, length_max: 45, medial_angle: 15, caudal_angle: -5 },
  T10: { diameter_max: 8.2, length_max: 45, medial_angle: 15, caudal_angle: -5 },
  T11: { diameter_max: 9.5, length_max: 45, medial_angle: 20, caudal_angle: -5 },
  T12: { diameter_max: 9.8, length_max: 48, medial_angle: 25, caudal_angle: -5 },
  L1: { diameter_max: 8.7, length_max: 50, medial_angle: 25, caudal_angle: -5 },
  L2: { diameter_max: 9.1, length_max: 50, medial_angle: 25, caudal_angle: -5 },
  L3: { diameter_max: 11.2, length_max: 50, medial_angle: 20, caudal_angle: -5 },
  L4: { diameter_max: 14.3, length_max: 55, medial_angle: 15, caudal_angle: -10 },
  L5: { diameter_max: 18.1, length_max: 55, medial_angle: 10, caudal_angle: -15 },
  S1: { diameter_max: 20.0, length_max: 55, medial_angle: 30, caudal_angle: -20 },
}

export class ScrewPlacer {
  /**
   * @param {import('./SpineRenderer').SpineRenderer} renderer
   * @param {{ post: Function, get: Function }} apiClient — axios instance ou fetch wrapper
   */
  constructor(renderer, apiClient) {
    this.renderer  = renderer
    this.api       = apiClient
    this._active   = false
    this._params   = null
    this._previews = []           // Vis preview en cours
    this._placedScrews  = []      // Résultats confirmés
    this._listeners = {}

    this._onMouseMove = this._onMouseMove.bind(this)
    this._onCanvasClick = this._onCanvasClick.bind(this)
  }

  // ─────────────────────────────────────────────────────────────────────────
  // API publique
  // ─────────────────────────────────────────────────────────────────────────

  /**
   * Active le mode de placement.
   * @param {{ level: string, side: 'left'|'right'|'bilateral',
   *            diameter: number, length: number, angle: number }} params
   */
  activate(params) {
    this._params = params
    this._active = true
    this._hidePreview()

    const canvas = this.renderer.renderer.domElement
    canvas.addEventListener('mousemove', this._onMouseMove)
    canvas.addEventListener('click', this._onCanvasClick)
    canvas.style.cursor = 'crosshair'
  }

  /** Désactive le mode de placement. */
  deactivate() {
    this._active = false
    this._hidePreview()

    const canvas = this.renderer.renderer.domElement
    canvas.removeEventListener('mousemove', this._onMouseMove)
    canvas.removeEventListener('click', this._onCanvasClick)
    canvas.style.cursor = 'default'
  }

  /**
   * Ajoute une vis à la position calculée automatiquement (mode API).
   * Utile pour placement programmé sans interaction souris.
   *
   * @param {{ level, side, diameter, length, angle }} params
   * @returns {Promise<Object>} Résultat { screw, stress, pullout_force, breach_risk }
   */
  async placeAutomatic(params) {
    const entry     = this._computeStandardEntry(params.level, params.side)
    const direction = this._computeDirection(params.level, params.side, params.angle ?? 15)

    const screw3d = this.renderer.addScrew({
      ...params,
      entry,
      direction,
    })

    const result = await this._callScrewApi({
      ...params,
      entry,
      direction,
    })

    this._applyResultColor(screw3d, result)
    this._placedScrews.push({ params: { ...params, entry, direction }, mesh: screw3d, result })
    this._emit('placed', { ...result, mesh: screw3d })
    return result
  }

  /**
   * Supprime toutes les vis placées.
   */
  clearAll() {
    this.renderer.clearHardware()
    this._placedScrews = []
    this._hidePreview()
    this._emit('cleared', {})
  }

  /** S'abonne à un événement ('placed', 'cleared', 'hover'). */
  on(event, handler) {
    this._listeners[event] = handler
  }

  /** Liste des vis placées. */
  get placedScrews() {
    return this._placedScrews
  }

  // ─────────────────────────────────────────────────────────────────────────
  // Interaction souris
  // ─────────────────────────────────────────────────────────────────────────

  _onMouseMove(event) {
    if (!this._active || !this._params) return
    const hit = this._raycastVertebra(event)
    if (hit) this._showPreview(hit)
    else this._hidePreview()
  }

  async _onCanvasClick(event) {
    if (!this._active || !this._params) return
    const hit = this._raycastVertebra(event)
    if (!hit) return

    const entry     = [hit.point.x, hit.point.y, hit.point.z]
    const direction = this._computeDirection(
      this._params.level,
      this._params.side,
      this._params.angle ?? 15,
    )

    const screwData = { ...this._params, entry, direction }
    const screw3d   = this.renderer.addScrew(screwData)

    // Lancer l'analyse côté serveur
    const result = await this._callScrewApi(screwData)
    this._applyResultColor(screw3d, result)
    this._placedScrews.push({ params: screwData, mesh: screw3d, result })
    this._emit('placed', { ...result, mesh: screw3d })
    this._hidePreview()
  }

  // ─────────────────────────────────────────────────────────────────────────
  // Prévisualisation
  // ─────────────────────────────────────────────────────────────────────────

  _showPreview(hit) {
    this._hidePreview()
    if (!this._params) return

    const { diameter = 6.0, length = 45, side = 'left', level = 'L3', angle = 15 } = this._params
    const entry     = [hit.point.x, hit.point.y, hit.point.z]
    const direction = this._computeDirection(level, side, angle)

    // Vis fantôme semi-transparente
    const shaftGeo = new THREE.CylinderGeometry(diameter * 0.45, diameter * 0.3, length, 16, 6)
    const mat = new THREE.MeshStandardMaterial({
      color: PREVIEW_COLOR,
      transparent: true,
      opacity: 0.55,
      metalness: 0.7,
      roughness: 0.3,
    })
    const preview = new THREE.Mesh(shaftGeo, mat)

    // Orienter
    const dir  = new THREE.Vector3(...direction).normalize()
    const yAxis = new THREE.Vector3(0, 1, 0)
    const q = new THREE.Quaternion()
    if (Math.abs(dir.dot(yAxis)) < 0.9999) q.setFromUnitVectors(yAxis, dir)
    preview.setRotationFromQuaternion(q)
    preview.position.set(...entry)

    this.renderer.scene.add(preview)
    this._previews.push(preview)
    this._emit('hover', { entry, direction, level, side })
  }

  _hidePreview() {
    this._previews.forEach((m) => {
      m.geometry.dispose()
      m.material.dispose()
      this.renderer.scene.remove(m)
    })
    this._previews = []
  }

  // ─────────────────────────────────────────────────────────────────────────
  // Calculs géométriques
  // ─────────────────────────────────────────────────────────────────────────

  /**
   * Point d'entrée pédiculaire standard (postérieur, selon la morphologie).
   */
  _computeStandardEntry(level, side) {
    const vertebra = this.renderer.vertebraeMeshes.find(
      (g) => g.userData.level === level,
    )
    if (!vertebra) return [side === 'left' ? -25 : 25, 200, 20]

    const pos = vertebra.position
    const xOffset = (side === 'left' ? -1 : 1) * 18
    return [pos.x + xOffset, pos.y, pos.z - 10]  // postérieur (z négatif dans Three.js)
  }

  /**
   * Direction d'insertion pédiculaire (médio-caudal) en coordonnées Three.js.
   * mediaAngle : angle médial en degrés, caudalAngle : angle caudal.
   */
  _computeDirection(level, side, mediaAngle = 15) {
    const safe = PEDICLE_SAFE_ZONE[level] ?? { medial_angle: 15, caudal_angle: -5 }
    const mRad = THREE.MathUtils.degToRad(safe.medial_angle)
    const cRad = THREE.MathUtils.degToRad(Math.abs(safe.caudal_angle))
    const sign  = side === 'left' ? 1 : -1

    // Vecteur antérieur + médial + caudal
    const dir = new THREE.Vector3(
      sign * Math.sin(mRad) * Math.cos(cRad),  // médio-latéral
      -Math.sin(cRad),                          // caudal
      -Math.cos(mRad) * Math.cos(cRad),         // antérieur
    ).normalize()

    return [dir.x, dir.y, dir.z]
  }

  // ─────────────────────────────────────────────────────────────────────────
  // Raycasting
  // ─────────────────────────────────────────────────────────────────────────

  _raycastVertebra(event) {
    const canvas = this.renderer.renderer.domElement
    const rect   = canvas.getBoundingClientRect()
    const mouse  = new THREE.Vector2(
      ((event.clientX - rect.left) / rect.width)  *  2 - 1,
      -((event.clientY - rect.top)  / rect.height) *  2 + 1,
    )
    const rc = new THREE.Raycaster()
    rc.setFromCamera(mouse, this.renderer.camera)
    const hits = rc.intersectObjects(this.renderer.vertebraeMeshes, true)
    return hits.length > 0 ? hits[0] : null
  }

  // ─────────────────────────────────────────────────────────────────────────
  // API
  // ─────────────────────────────────────────────────────────────────────────

  async _callScrewApi(screwData) {
    try {
      const payload = {
        level: screwData.level,
        side: screwData.side,
        diameter: screwData.diameter,
        length: screwData.length,
        entry_point: screwData.entry,
        direction: screwData.direction,
      }
      const res = await this.api.post('/api/simulation/screw-analysis', payload)
      return res.data ?? res
    } catch (err) {
      console.warn('[ScrewPlacer] API inaccessible, estimation locale', err?.message)
      return this._estimateLocally(screwData)
    }
  }

  /** Estimation heuristique sans serveur. */
  _estimateLocally(screwData) {
    const safe = PEDICLE_SAFE_ZONE[screwData.level] ?? {}
    const diamRatio = screwData.diameter / (safe.diameter_max ?? 10)
    const breach = diamRatio > 0.85 ? 0.3 : 0.05
    const pullout = 3500 - (screwData.level.startsWith('C') ? 1500 : 0)
    return {
      pullout_force_n: pullout,
      breach_risk: breach,
      cortical_contact_pct: 72,
      grade: breach > 0.25 ? 'C' : 'A',
      local_estimate: true,
    }
  }

  // ─────────────────────────────────────────────────────────────────────────
  // Feedback visuel
  // ─────────────────────────────────────────────────────────────────────────

  _applyResultColor(screwGroup, result) {
    const { breach_risk = 0 } = result
    const color = breach_risk > 0.3 ? BREACH_COLOR
      : breach_risk > 0.15 ? WARNING_COLOR
      : VALID_COLOR

    screwGroup.traverse((c) => {
      if (c.isMesh) c.material.color.setHex(color)
    })
  }

  // ─────────────────────────────────────────────────────────────────────────
  // Événements
  // ─────────────────────────────────────────────────────────────────────────

  _emit(event, data) {
    if (typeof this._listeners[event] === 'function') {
      this._listeners[event](data)
    }
  }

  /** Libère les ressources. */
  dispose() {
    this.deactivate()
    this.clearAll()
    this._listeners = {}
  }
}

export default ScrewPlacer
