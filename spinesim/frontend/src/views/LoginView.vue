<template>
  <div class="login-container">
    <div class="login-card">
      <!-- Logo / Titre -->
      <div class="login-header">
        <div class="logo">🦴</div>
        <h1>VERTEX<span class="copyright">©</span></h1>
        <p class="tagline">Simulateur biomécanique du rachis</p>
      </div>

      <!-- Onglets Login / Register -->
      <div class="tab-bar">
        <button
          :class="['tab', { active: mode === 'login' }]"
          @click="mode = 'login'"
        >
          Connexion
        </button>
        <button
          :class="['tab', { active: mode === 'register' }]"
          @click="mode = 'register'"
        >
          Inscription
        </button>
      </div>

      <!-- Formulaire Connexion -->
      <form v-if="mode === 'login'" @submit.prevent="doLogin" class="login-form">
        <div class="field">
          <label for="login-id">Email ou nom d'utilisateur</label>
          <input
            id="login-id"
            v-model="loginId"
            type="text"
            placeholder="admin@vertex-spine.com"
            autocomplete="username"
            required
          />
        </div>

        <div class="field">
          <label for="login-pw">Mot de passe</label>
          <div class="password-wrapper">
            <input
              id="login-pw"
              v-model="password"
              :type="showPw ? 'text' : 'password'"
              placeholder="••••••••"
              autocomplete="current-password"
              required
            />
            <button type="button" class="pw-toggle" @click="showPw = !showPw">
              {{ showPw ? '🙈' : '👁️' }}
            </button>
          </div>
        </div>

        <div v-if="authStore.error" class="error-msg">
          ⚠️ {{ authStore.error }}
        </div>

        <button type="submit" class="btn-primary" :disabled="authStore.isLoading">
          <span v-if="authStore.isLoading" class="spinner">⏳</span>
          <span v-else>Se connecter</span>
        </button>
      </form>

      <!-- Formulaire Inscription -->
      <form v-else @submit.prevent="doRegister" class="login-form">
        <div class="field">
          <label for="reg-email">Email</label>
          <input
            id="reg-email"
            v-model="regEmail"
            type="email"
            placeholder="prenom.nom@etablissement.fr"
            autocomplete="email"
            required
          />
        </div>

        <div class="field">
          <label for="reg-username">Nom d'utilisateur</label>
          <input
            id="reg-username"
            v-model="regUsername"
            type="text"
            placeholder="dr.dupont"
            autocomplete="username"
            minlength="3"
            required
          />
        </div>

        <div class="field">
          <label for="reg-fullname">Nom complet (optionnel)</label>
          <input
            id="reg-fullname"
            v-model="regFullName"
            type="text"
            placeholder="Dr Sophie Dupont"
          />
        </div>

        <div class="field">
          <label for="reg-pw">Mot de passe</label>
          <div class="password-wrapper">
            <input
              id="reg-pw"
              v-model="regPassword"
              :type="showPw ? 'text' : 'password'"
              placeholder="Minimum 8 caractères"
              autocomplete="new-password"
              minlength="8"
              required
            />
            <button type="button" class="pw-toggle" @click="showPw = !showPw">
              {{ showPw ? '🙈' : '👁️' }}
            </button>
          </div>
        </div>

        <!-- Indicateur de force du mot de passe -->
        <div class="pw-strength" v-if="regPassword.length > 0">
          <div class="pw-bar">
            <div
              class="pw-fill"
              :style="{ width: `${pwStrength * 25}%` }"
              :class="`strength-${pwStrength}`"
            ></div>
          </div>
          <span class="pw-label">{{ pwStrengthLabel }}</span>
        </div>

        <div v-if="authStore.error" class="error-msg">
          ⚠️ {{ authStore.error }}
        </div>

        <button type="submit" class="btn-primary" :disabled="authStore.isLoading">
          <span v-if="authStore.isLoading">⏳ Création...</span>
          <span v-else>Créer mon compte</span>
        </button>
      </form>

      <!-- Footer -->
      <div class="login-footer">
        <small>VERTEX© v0.2.0 — Simulateur pédagogique du rachis</small>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const router    = useRouter()
const authStore = useAuthStore()

// ── État local ──────────────────────────────────────────────
const mode       = ref('login')
const showPw     = ref(false)

// Login
const loginId  = ref('')
const password = ref('')

// Register
const regEmail    = ref('')
const regUsername = ref('')
const regFullName = ref('')
const regPassword = ref('')

// ── Force du mot de passe ────────────────────────────────────
const pwStrength = computed(() => {
  const pw = regPassword.value
  let score = 0
  if (pw.length >= 8)  score++
  if (/[A-Z]/.test(pw)) score++
  if (/[0-9]/.test(pw)) score++
  if (/[^A-Za-z0-9]/.test(pw)) score++
  return score
})

const pwStrengthLabel = computed(() => {
  const labels = ['', 'Faible', 'Moyen', 'Fort', 'Très fort']
  return labels[pwStrength.value] || ''
})

// ── Actions ──────────────────────────────────────────────────
async function doLogin() {
  const ok = await authStore.login(loginId.value, password.value)
  if (ok) {
    router.push('/')
  }
}

async function doRegister() {
  if (regPassword.value.length < 8) {
    authStore.error = 'Mot de passe trop court (minimum 8 caractères)'
    return
  }
  const ok = await authStore.register(
    regEmail.value,
    regUsername.value,
    regPassword.value,
    regFullName.value
  )
  if (ok) {
    router.push('/')
  }
}
</script>

<style scoped>
.login-container {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #0f1923 0%, #1a2a3a 50%, #0d2137 100%);
  padding: 1rem;
}

.login-card {
  background: rgba(255, 255, 255, 0.04);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(100, 180, 255, 0.15);
  border-radius: 16px;
  padding: 2.5rem 2rem;
  width: 100%;
  max-width: 420px;
  box-shadow: 0 24px 64px rgba(0, 0, 0, 0.6);
}

.login-header {
  text-align: center;
  margin-bottom: 2rem;
}

.logo {
  font-size: 3rem;
  margin-bottom: 0.5rem;
}

.login-header h1 {
  font-size: 2rem;
  font-weight: 700;
  background: linear-gradient(135deg, #64b4ff, #a78bfa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin: 0;
}

.copyright { font-size: 1rem; }

.tagline {
  color: #94a3b8;
  font-size: 0.85rem;
  margin-top: 0.25rem;
}

/* Onglets */
.tab-bar {
  display: flex;
  background: rgba(255,255,255,0.05);
  border-radius: 8px;
  padding: 4px;
  gap: 4px;
  margin-bottom: 1.5rem;
}

.tab {
  flex: 1;
  padding: 0.5rem;
  background: transparent;
  border: none;
  border-radius: 6px;
  color: #94a3b8;
  cursor: pointer;
  font-size: 0.9rem;
  transition: all 0.2s;
}

.tab.active {
  background: rgba(100, 180, 255, 0.15);
  color: #64b4ff;
  font-weight: 600;
}

/* Champs */
.login-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.field {
  display: flex;
  flex-direction: column;
  gap: 0.35rem;
}

.field label {
  font-size: 0.8rem;
  color: #94a3b8;
  font-weight: 500;
}

.field input {
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid rgba(100, 180, 255, 0.2);
  border-radius: 8px;
  padding: 0.6rem 0.85rem;
  color: #e2e8f0;
  font-size: 0.9rem;
  outline: none;
  transition: border-color 0.2s;
}

.field input:focus {
  border-color: rgba(100, 180, 255, 0.5);
}

.password-wrapper {
  position: relative;
}

.password-wrapper input {
  width: 100%;
  padding-right: 2.5rem;
  box-sizing: border-box;
}

.pw-toggle {
  position: absolute;
  right: 0.6rem;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  cursor: pointer;
  font-size: 1rem;
  padding: 0;
  line-height: 1;
}

/* Force mot de passe */
.pw-strength {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.pw-bar {
  flex: 1;
  height: 4px;
  background: rgba(255,255,255,0.1);
  border-radius: 2px;
  overflow: hidden;
}

.pw-fill {
  height: 100%;
  border-radius: 2px;
  transition: width 0.3s, background 0.3s;
}

.strength-1 { background: #ef4444; }
.strength-2 { background: #f59e0b; }
.strength-3 { background: #10b981; }
.strength-4 { background: #6366f1; }

.pw-label {
  font-size: 0.75rem;
  color: #94a3b8;
  min-width: 60px;
}

/* Message d'erreur */
.error-msg {
  background: rgba(239, 68, 68, 0.1);
  border: 1px solid rgba(239, 68, 68, 0.3);
  border-radius: 6px;
  padding: 0.6rem 0.85rem;
  font-size: 0.85rem;
  color: #fca5a5;
}

/* Bouton principal */
.btn-primary {
  background: linear-gradient(135deg, #3b82f6, #6366f1);
  border: none;
  border-radius: 8px;
  padding: 0.75rem;
  color: white;
  font-weight: 600;
  font-size: 0.95rem;
  cursor: pointer;
  transition: opacity 0.2s, transform 0.1s;
  margin-top: 0.5rem;
}

.btn-primary:hover:not(:disabled) {
  opacity: 0.9;
  transform: translateY(-1px);
}

.btn-primary:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

/* Footer */
.login-footer {
  text-align: center;
  margin-top: 1.5rem;
  color: #475569;
  font-size: 0.75rem;
}
</style>
