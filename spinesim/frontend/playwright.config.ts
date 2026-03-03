import { defineConfig, devices } from '@playwright/test'

export default defineConfig({
  testDir: './e2e',
  timeout: 30_000,
  retries: process.env.CI ? 2 : 0,
  workers: process.env.CI ? 1 : 4,

  reporter: [
    ['html', { outputFolder: 'playwright-report' }],
    ['list'],
    ...(process.env.CI ? [['github'] as any] : []),
  ],

  use: {
    baseURL:     process.env.VERTEX_BASE_URL ?? 'http://localhost:5173',
    headless:    true,
    screenshot:  'only-on-failure',
    video:       'retain-on-failure',
    trace:       'on-first-retry',
    actionTimeout: 10_000,
    navigationTimeout: 15_000,
  },

  projects: [
    { name: 'chromium', use: { ...devices['Desktop Chrome'] } },
    { name: 'firefox',  use: { ...devices['Desktop Firefox'] } },
    // Mobile — smoke only
    { name: 'mobile-chrome', use: { ...devices['Pixel 5'] }, testMatch: ['**/vertex.spec.ts'] },
  ],

  // Démarrer le serveur de dev avant les tests E2E
  webServer: process.env.CI ? undefined : {
    command: 'npm run dev',
    url:     'http://localhost:5173',
    reuseExistingServer: !process.env.CI,
    timeout: 60_000,
  },
})
