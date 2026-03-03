// VERTEX© — Setup global pour Vitest (jsdom)
import { config } from '@vue/test-utils'
import { createPinia, setActivePinia } from 'pinia'
import { vi } from 'vitest'

// ── Polyfills jsdom ──────────────────────────────────────────────────────────
global.URL.createObjectURL = vi.fn(() => 'blob:mock-url')
global.URL.revokeObjectURL = vi.fn()
global.ResizeObserver = class {
  observe()   {}
  unobserve() {}
  disconnect(){}
}

// Stub canvas pour Chart.js (jsdom ne supporte pas canvas)
HTMLCanvasElement.prototype.getContext = vi.fn(() => ({
  clearRect:    vi.fn(),
  beginPath:    vi.fn(),
  arc:          vi.fn(),
  fill:         vi.fn(),
  stroke:       vi.fn(),
  moveTo:       vi.fn(),
  lineTo:       vi.fn(),
  fillRect:     vi.fn(),
  fillText:     vi.fn(),
  measureText:  vi.fn(() => ({ width: 0 })),
  canvas: { width: 300, height: 150 },
}))

// ── Configuration Vue Test Utils ──────────────────────────────────────────────
config.global.plugins = []

// ── Pinia propre à chaque test ────────────────────────────────────────────────
beforeEach(() => {
  setActivePinia(createPinia())
})
