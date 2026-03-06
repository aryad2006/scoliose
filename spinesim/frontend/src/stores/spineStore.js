import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'

const API_BASE = '/api'

export const useSpineStore = defineStore('spine', () => {
  // State
  const spineId = ref(null)
  const spineData = ref(null)
  const stresses = ref([])
  const solverInfo = ref(null)
  const statusMessage = ref('Prêt')
  const screwResults = ref([])
  const surgicalResult = ref(null)
  const solveResult = ref(null)
  const loading = ref(false)
  const error = ref(null)

  // Actions
  async function createSpine(patient) {
    loading.value = true
    error.value = null
    statusMessage.value = 'Création du rachis...'
    try {
      const res = await axios.post(`${API_BASE}/spine/create`, {
        weight: patient.weight,
        height: patient.height,
        age: patient.age,
        sex: patient.sex,
        tscore: patient.tscore,
      })
      spineId.value = res.data.id
      spineData.value = res.data.model
      statusMessage.value = `Rachis créé — ${res.data.num_vertebrae} vertèbres, ${res.data.num_discs} disques, ${res.data.num_ligaments} ligaments`
    } catch (err) {
      error.value = err.response?.data?.error || err.message
      statusMessage.value = `❌ Erreur: ${error.value}`
      throw err
    } finally {
      loading.value = false
    }
  }

  async function solveSpine() {
    if (!spineId.value) return
    loading.value = true
    error.value = null
    statusMessage.value = 'Résolution FEM en cours...'
    try {
      const res = await axios.post(`${API_BASE}/spine/${spineId.value}/solve`)
      spineData.value = res.data.model
      stresses.value = res.data.stresses || []
      solverInfo.value = {
        time: res.data.solver_time_ms,
        maxDisplacement: res.data.max_displacement_mm,
        maxStress: res.data.max_von_mises_mpa,
        numDof: res.data.num_dof,
      }
      statusMessage.value = `✅ Résolu en ${res.data.solver_time_ms}ms — ${res.data.num_dof} DOF`
      // Charger les mesures radiologiques après résolution
      await fetchMeasurements()
    } catch (err) {
      error.value = err.response?.data?.error || err.message
      statusMessage.value = `❌ Erreur solveur: ${error.value}`
    } finally {
      loading.value = false
    }
  }

  async function fetchMeasurements() {
    if (!spineId.value) return
    try {
      const res = await axios.get(`${API_BASE}/spine/${spineId.value}/measurements`)
      solveResult.value = res.data
    } catch (err) {
      console.warn('Mesures indisponibles:', err.message)
    }
  }

  async function applyScoliosis(params) {
    if (!spineId.value) return
    // Support both object and positional args
    const lenkeType = params.lenke_type ?? params
    const cobb = params.cobb_angle ?? params.cobb ?? 50
    loading.value = true
    error.value = null
    statusMessage.value = `Application scoliose Lenke ${lenkeType} (Cobb ${cobb}°)...`
    try {
      const res = await axios.post(`${API_BASE}/spine/${spineId.value}/scoliosis`, {
        lenke_type: lenkeType,
        cobb: cobb,
      })
      spineData.value = res.data.model
      statusMessage.value = res.data.message
    } catch (err) {
      error.value = err.response?.data?.error || err.message
      statusMessage.value = `❌ Erreur scoliose: ${error.value}`
    } finally {
      loading.value = false
    }
  }

  async function placeScrew(params) {
    if (!spineId.value) return
    // Support both object and positional args
    const level = params.level ?? params
    const side = params.side ?? 'left'
    const diameter = params.diameter ?? 5.5
    const length = params.length ?? 40
    loading.value = true
    error.value = null
    statusMessage.value = `Placement vis ${level} ${side} (ø${diameter}mm, L${length}mm)...`
    try {
      const res = await axios.post(`${API_BASE}/surgery/${spineId.value}/screw`, {
        level, side, diameter, length,
      })
      screwResults.value.push(res.data)
      const r = res.data.result
      if (r.placed) {
        statusMessage.value = `✅ Vis ${level} ${side} — précision ${r.accuracy_percent}%, pull-out ${r.pullout_strength_N}N`
      } else {
        statusMessage.value = `⚠️ Vis ${level} ${side} — BRÈCHE ${r.breach} (${r.breach_severity_mm}mm)`
      }
      return res.data
    } catch (err) {
      error.value = err.response?.data?.error || err.message
      statusMessage.value = `❌ Erreur vis: ${error.value}`
    } finally {
      loading.value = false
    }
  }

  // Longitudinal simulation results
  const longitudinalResult = ref(null)
  const comparisonResults = ref(null)

  async function runLongitudinal(params) {
    loading.value = true
    error.value = null
    statusMessage.value = `Simulation longitudinale ${params.duration_years} ans...`
    try {
      const res = await axios.post(`${API_BASE}/longitudinal/run`, params)
      longitudinalResult.value = res.data
      statusMessage.value = `✅ Simulation terminée — Cobb ${res.data.final_cobb_deg.toFixed(1)}° en ${res.data.duration_years} ans`
      return res.data
    } catch (err) {
      error.value = err.response?.data?.error || err.message
      statusMessage.value = `❌ Erreur simulation: ${error.value}`
    } finally {
      loading.value = false
    }
  }

  async function runComparison(params) {
    loading.value = true
    error.value = null
    statusMessage.value = `Étude comparative en cours (9 configurations × ${params.duration_years} ans)...`
    try {
      const res = await axios.post(`${API_BASE}/longitudinal/comparison`, params)
      comparisonResults.value = res.data
      statusMessage.value = `✅ Étude comparative terminée — ${Object.keys(res.data.results).length} configurations`
      return res.data
    } catch (err) {
      error.value = err.response?.data?.error || err.message
      statusMessage.value = `❌ Erreur comparaison: ${error.value}`
    } finally {
      loading.value = false
    }
  }

  function reset() {
    spineId.value = null
    spineData.value = null
    stresses.value = []
    solverInfo.value = null
    screwResults.value = []
    solveResult.value = null
    longitudinalResult.value = null
    comparisonResults.value = null
    loading.value = false
    error.value = null
    statusMessage.value = 'Prêt'
  }

  return {
    spineId, spineData, stresses, solverInfo, statusMessage, screwResults, surgicalResult,
    solveResult, longitudinalResult, comparisonResults,
    loading, error,
    createSpine, solveSpine, applyScoliosis, placeScrew, fetchMeasurements,
    runLongitudinal, runComparison, reset,
  }
})
