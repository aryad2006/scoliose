<template>
  <div ref="container" class="spine-viewport" @contextmenu.prevent></div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, watch, shallowRef, defineExpose } from 'vue'
import { SpineRenderer } from '../engine/SpineRenderer'

const props = defineProps({
  spineData: { type: Object, default: null },
  stresses: { type: Array, default: () => [] },
  viewMode: { type: String, default: 'anatomical' },
})

const container = ref(null)
const renderer = shallowRef(null)

onMounted(() => {
  renderer.value = new SpineRenderer(container.value)
  renderer.value.animate()
})

onUnmounted(() => {
  if (renderer.value) {
    renderer.value.dispose()
  }
})

watch(() => props.spineData, (data) => {
  if (renderer.value && data) {
    renderer.value.updateSpine(data)
  }
}, { deep: true })

watch(() => props.stresses, (s) => {
  if (renderer.value && s.length > 0) {
    renderer.value.updateStresses(s)
  }
})

watch(() => props.viewMode, (mode) => {
  if (renderer.value) {
    renderer.value.setViewMode(mode)
  }
})

// Exposer le renderer pour que le parent puisse le passer à ViewControls
defineExpose({ renderer })
</script>

<style scoped>
.spine-viewport {
  width: 100%;
  height: 100%;
}
</style>
