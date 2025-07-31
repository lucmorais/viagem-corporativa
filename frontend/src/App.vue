<script setup lang="ts">
import Dashboard from './components/dashboard/Dashboard.vue';
import Navegacao from './components/navegacao/Navegacao.vue';
</script>

<template>
  <header>
    <Navegacao />
  </header>

  <main>
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="flex justify-center">
          <Dashboard />
        </div>
    </div>
  </main>
</template>

<style scoped></style>