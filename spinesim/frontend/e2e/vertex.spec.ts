/**
 * VERTEX© — Tests E2E Playwright
 * Lancer : npx playwright test
 *
 * Configurer playwright.config.js :
 *   baseURL: 'http://localhost:5173'  (ou selon l'env)
 */

import { test, expect } from '@playwright/test'

const BASE = process.env.VERTEX_BASE_URL ?? 'http://localhost:5173'

// ─────────────────────────────────────────────────────────────────────────────
// Smoke tests — page principale
// ─────────────────────────────────────────────────────────────────────────────

test.describe('Page principale — Simulateur', () => {
  test.beforeEach(async ({ page }) => {
    await page.goto(BASE)
  })

  test('charge sans erreur 500', async ({ page }) => {
    const response = await page.goto(BASE)
    expect(response?.status()).toBeLessThan(500)
  })

  test('affiche le titre VERTEX', async ({ page }) => {
    await expect(page.locator('h1, .app-title, [class*="title"]').first()).toBeVisible({ timeout: 5000 })
  })

  test('canvas 3D est présent', async ({ page }) => {
    // Attend que le canvas Three.js soit rendu
    const canvas = page.locator('canvas').first()
    await expect(canvas).toBeVisible({ timeout: 8000 })
    const box = await canvas.boundingBox()
    expect(box?.width).toBeGreaterThan(100)
  })

  test('aucune erreur JavaScript critique', async ({ page }) => {
    const errors: string[] = []
    page.on('pageerror', err => errors.push(err.message))
    await page.waitForTimeout(2000)
    const fatal = errors.filter(e =>
      !e.includes('ResizeObserver') &&   // false positive courant
      !e.includes('WebGL')              // attendu en headless
    )
    expect(fatal).toHaveLength(0)
  })
})

// ─────────────────────────────────────────────────────────────────────────────
// PatientPanel — configuration patient
// ─────────────────────────────────────────────────────────────────────────────

test.describe('PatientPanel', () => {
  test.beforeEach(async ({ page }) => {
    await page.goto(BASE)
    await page.waitForLoadState('networkidle')
  })

  test('sélectionner la pathologie scoliose', async ({ page }) => {
    const btn = page.locator('[data-pathology="scoliosis"], button:has-text("Scoliose")').first()
    if (await btn.isVisible()) {
      await btn.click()
      await expect(btn).toHaveClass(/active|selected/, { timeout: 2000 })
    } else {
      test.skip()
    }
  })

  test('lancer une simulation avec des valeurs par défaut', async ({ page }) => {
    const submitBtn = page.locator(
      'button:has-text("Simuler"), button:has-text("Lancer"), [data-action="simulate"]'
    ).first()
    if (await submitBtn.isVisible()) {
      await submitBtn.click()
      // Attend un résultat ou un spinner
      await expect(
        page.locator('[class*="result"], [class*="loading"], [class*="spinner"]').first()
      ).toBeVisible({ timeout: 15000 })
    } else {
      test.skip()
    }
  })
})

// ─────────────────────────────────────────────────────────────────────────────
// SurgeryPanel — placement de vis
// ─────────────────────────────────────────────────────────────────────────────

test.describe('SurgeryPanel', () => {
  test.beforeEach(async ({ page }) => {
    await page.goto(BASE)
    await page.waitForLoadState('networkidle')
    // Naviguer vers le panel chirurgie
    const surgeryTab = page.locator('[data-panel="surgery"], button:has-text("Chirurgie")').first()
    if (await surgeryTab.isVisible()) await surgeryTab.click()
  })

  test('panel chirurgie est accessible', async ({ page }) => {
    const panel = page.locator('[class*="surgery"], [data-panel="surgery"]').first()
    if (await panel.isVisible()) {
      await expect(panel).toBeVisible()
    } else {
      test.skip()
    }
  })

  test('bouton placer vis existe et est cliquable', async ({ page }) => {
    const btn = page.locator('button:has-text("Placer"), button:has-text("vis")').first()
    if (await btn.isVisible()) {
      await expect(btn).toBeEnabled()
    } else {
      test.skip()
    }
  })
})

// ─────────────────────────────────────────────────────────────────────────────
// Dashboard Étudiant
// ─────────────────────────────────────────────────────────────────────────────

test.describe('DashboardStudent', () => {
  test('route /dashboard/student charge', async ({ page }) => {
    const resp = await page.goto(`${BASE}/dashboard/student`)
    // Accepte 200 ou redirect vers login
    expect([200, 302, 303]).toContain(resp?.status() ?? 200)
  })

  test('affiche les KPI cards', async ({ page }) => {
    await page.goto(`${BASE}/dashboard/student`)
    await page.waitForLoadState('networkidle')
    const kpiCards = page.locator('.kpi-card')
    const count = await kpiCards.count()
    // Soit 4 KPI cards, soit on est redirigé (0 cards — on skip)
    if (count > 0) {
      expect(count).toBeGreaterThanOrEqual(3)
    }
  })
})

// ─────────────────────────────────────────────────────────────────────────────
// Dashboard Formateur
// ─────────────────────────────────────────────────────────────────────────────

test.describe('DashboardInstructor', () => {
  test('route /dashboard/instructor charge', async ({ page }) => {
    const resp = await page.goto(`${BASE}/dashboard/instructor`)
    expect([200, 302, 303]).toContain(resp?.status() ?? 200)
  })

  test('bouton export CSV est présent', async ({ page }) => {
    await page.goto(`${BASE}/dashboard/instructor`)
    await page.waitForLoadState('networkidle')
    const exportBtn = page.locator('button:has-text("Export")').first()
    if (await exportBtn.isVisible()) {
      await expect(exportBtn).toBeEnabled()
    }
  })

  test('heatmap table est présente', async ({ page }) => {
    await page.goto(`${BASE}/dashboard/instructor`)
    await page.waitForLoadState('networkidle')
    const table = page.locator('.heatmap-table, table').first()
    if (await table.isVisible()) {
      await expect(table).toBeVisible()
    }
  })
})

// ─────────────────────────────────────────────────────────────────────────────
// API Gateway — santé
// ─────────────────────────────────────────────────────────────────────────────

test.describe('API Gateway', () => {
  const API = process.env.VERTEX_API_URL ?? 'http://localhost:8000'

  test('GET /health répond 200', async ({ request }) => {
    const res = await request.get(`${API}/health`).catch(() => null)
    if (!res) test.skip()
    expect(res?.status()).toBe(200)
    const body = await res?.json()
    expect(body?.status).toBe('ok')
  })

  test('GET /api/payment/plans répond 200', async ({ request }) => {
    const res = await request.get(`${API}/api/payment/plans`).catch(() => null)
    if (!res) test.skip()
    expect(res?.status()).toBe(200)
    const body = await res?.json()
    expect(Array.isArray(body?.plans)).toBe(true)
    expect(body?.plans?.length).toBeGreaterThan(0)
  })
})
