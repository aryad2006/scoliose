import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createRouter, createWebHistory } from 'vue-router'
import App from './App.vue'
import LoginView from './views/LoginView.vue'
import { useAuthStore } from './stores/auth'

const pinia = createPinia()

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/login',                component: LoginView,                                                              meta: { public: true } },
    { path: '/dashboard/student',    component: () => import('./views/DashboardStudent.vue'),    meta: { role: 'student'    } },
    { path: '/dashboard/instructor', component: () => import('./views/DashboardInstructor.vue'), meta: { role: 'instructor' } },
    { path: '/:pathMatch(.*)*',      component: App },
  ],
})

// Navigation guard : rediriger vers /login si non authentifié
router.beforeEach((to) => {
  const auth = useAuthStore()
  if (!to.meta.public && !auth.isAuthenticated) {
    return '/login'
  }
})

const app = createApp(
  // Si on est sur /login, rendre LoginView directement
  // Sinon, App est montée via le router
  { template: '<router-view />' }
)
app.use(pinia)
app.use(router)
app.mount('#app')
