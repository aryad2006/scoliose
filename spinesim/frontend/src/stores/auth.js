// ══════════════════════════════════════════════════════════════
// VERTEX© — Store d'authentification (Pinia)
// Sprint 2 : JWT Access + Refresh token
// ══════════════════════════════════════════════════════════════

import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

const API_BASE = '/api'

export const useAuthStore = defineStore('auth', () => {
  // ── État ──────────────────────────────────────────────────

  const accessToken  = ref(localStorage.getItem('vertex_access_token') || '')
  const refreshToken = ref(localStorage.getItem('vertex_refresh_token') || '')
  const user         = ref(JSON.parse(localStorage.getItem('vertex_user') || 'null'))
  const isLoading    = ref(false)
  const error        = ref('')

  // ── Getters ───────────────────────────────────────────────

  const isAuthenticated = computed(() => {
    if (!accessToken.value) return false
    // Vérifier expiration du token (côté client)
    try {
      const payload = JSON.parse(atob(accessToken.value.split('.')[1]))
      return payload.exp * 1000 > Date.now()
    } catch {
      return false
    }
  })

  const currentUser = computed(() => user.value)
  const userRole    = computed(() => user.value?.role || 'guest')
  const isAdmin     = computed(() => userRole.value === 'admin')
  const isInstructor = computed(() => ['admin', 'instructor'].includes(userRole.value))

  // ── Actions ───────────────────────────────────────────────

  /**
   * Connexion avec email/username + mot de passe
   */
  async function login(login, password) {
    isLoading.value = true
    error.value = ''

    try {
      const response = await fetch(`${API_BASE}/auth/login`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ login, password }),
      })

      const data = await response.json()

      if (!response.ok) {
        error.value = data.error || 'Identifiants incorrects'
        return false
      }

      // Stocker les tokens
      _setTokens(data.access_token, data.refresh_token)

      // Récupérer le profil
      await fetchMe()
      return true

    } catch (e) {
      error.value = 'Erreur réseau — vérifiez votre connexion'
      return false
    } finally {
      isLoading.value = false
    }
  }

  /**
   * Inscription
   */
  async function register(email, username, password, fullName = '') {
    isLoading.value = true
    error.value = ''

    try {
      const response = await fetch(`${API_BASE}/auth/register`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, username, password, full_name: fullName }),
      })

      const data = await response.json()

      if (!response.ok) {
        error.value = data.error || 'Erreur lors de l\'inscription'
        return false
      }

      // Auto-login après inscription
      return await login(username, password)

    } catch (e) {
      error.value = 'Erreur réseau'
      return false
    } finally {
      isLoading.value = false
    }
  }

  /**
   * Déconnexion
   */
  async function logout() {
    try {
      await fetch(`${API_BASE}/auth/logout`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ refresh_token: refreshToken.value }),
      })
    } catch { /* ignore */ }

    _clearTokens()
  }

  /**
   * Rafraîchir l'access token
   */
  async function refreshAccessToken() {
    if (!refreshToken.value) return false

    try {
      const response = await fetch(`${API_BASE}/auth/refresh`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ refresh_token: refreshToken.value }),
      })

      if (!response.ok) {
        _clearTokens()
        return false
      }

      const data = await response.json()
      _setTokens(data.access_token, data.refresh_token)
      return true

    } catch {
      return false
    }
  }

  /**
   * Récupérer le profil de l'utilisateur connecté
   */
  async function fetchMe() {
    try {
      const response = await apiFetch('/auth/me')
      if (response.ok) {
        const data = await response.json()
        user.value = data
        localStorage.setItem('vertex_user', JSON.stringify(data))
      }
    } catch { /* ignore */ }
  }

  /**
   * Wrapper fetch avec injection automatique du token et refresh
   */
  async function apiFetch(path, options = {}) {
    const headers = {
      'Content-Type': 'application/json',
      ...(options.headers || {}),
    }

    if (accessToken.value) {
      headers['Authorization'] = `Bearer ${accessToken.value}`
    }

    let response = await fetch(`${API_BASE}${path}`, { ...options, headers })

    // Token expiré → tenter le refresh une fois
    if (response.status === 401 && refreshToken.value) {
      const refreshed = await refreshAccessToken()
      if (refreshed) {
        headers['Authorization'] = `Bearer ${accessToken.value}`
        response = await fetch(`${API_BASE}${path}`, { ...options, headers })
      }
    }

    return response
  }

  // ── Helpers privés ─────────────────────────────────────────

  function _setTokens(access, refresh) {
    accessToken.value  = access
    refreshToken.value = refresh
    localStorage.setItem('vertex_access_token', access)
    localStorage.setItem('vertex_refresh_token', refresh)
  }

  function _clearTokens() {
    accessToken.value  = ''
    refreshToken.value = ''
    user.value         = null
    localStorage.removeItem('vertex_access_token')
    localStorage.removeItem('vertex_refresh_token')
    localStorage.removeItem('vertex_user')
  }

  return {
    // État
    accessToken,
    user,
    isLoading,
    error,
    // Getters
    isAuthenticated,
    currentUser,
    userRole,
    isAdmin,
    isInstructor,
    // Actions
    login,
    register,
    logout,
    refreshAccessToken,
    fetchMe,
    apiFetch,
  }
})
