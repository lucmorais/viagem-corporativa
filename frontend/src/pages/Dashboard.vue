<script lang="ts" setup>
import ListaPedidos from '../components/ListaPedidos.vue';
</script>

<template>
  <section class="rounded-lg overflow-hidden shadow-lg bg-white w-full mt-6">
    <div class="px-6 py-6">
      <div class="font-bold text-xl text-left mb-6">Pedidos de viagem</div>
      <div>
        <ListaPedidos />
      </div>
    </div>
  </section>
</template>