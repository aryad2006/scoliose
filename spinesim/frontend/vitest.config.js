import { defineConfig } from 'vitest/config'
import vue from '@vitejs/plugin-vue'
import { fileURLToPath, URL } from 'node:url'

export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url)),
    },
  },
  test: {
    globals:     true,
    environment: 'jsdom',
    setupFiles:  ['./src/test/setup.js'],
    coverage: {
      provider: 'istanbul',
      reporter: ['text', 'html', 'lcov'],
      include:  ['src/**/*.{js,vue}'],
      exclude:  ['src/test/**', 'src/assets/**'],
      thresholds: {
        lines:     70,
        functions: 70,
        branches:  60,
        statements: 70,
      },
    },
  },
})
