<script setup lang="ts">
import { ref, watch } from 'vue';

const props = defineProps<{
  ativo: boolean
}>();
</script>

<template>
  <transition name="fade">
    <div
      v-if="ativo"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    >
      <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-gray-800 border-opacity-75"></div>
    </div>
  </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>