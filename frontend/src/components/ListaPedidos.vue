<script lang="ts" setup>
import { ref } from 'vue';

const pedidos = ref([
    { id: 1, pedido: 'Viagem teste 1' },
    { id: 2, pedido: 'Viagem teste 2' },
    { id: 3, pedido: 'Viagem teste 3' }
]);
</script>

<template>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Pedido</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="pedido in pedidos" :key="pedido.id">
                <td class="border px-4 py-2">{{ pedido.id }}</td>
                <td class="border px-4 py-2">{{ pedido.pedido }}</td>
            </tr>
        </tbody>
    </table>
</template>