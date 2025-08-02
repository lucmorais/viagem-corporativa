<script lang="ts" setup>
import { ref } from 'vue';
import Acao from './Acao.vue';

const pedidos = ref([
    {
        id: 1,
        destino: 'São Paulo',
        dataIda: '2025-08-01',
        dataVolta: '2025-08-05',
        solicitante: 'Kowalski',
        status: 'Solicitado'
    },
    {
        id: 2,
        destino: 'Distrito Federal',
        dataIda: '2025-08-01',
        dataVolta: '2025-08-05',
        solicitante: 'Michelangelo',
        status: 'Aprovado'
    },
    {
        id: 3,
        destino: 'Rio de Janeiro',
        dataIda: '2025-08-01',
        dataVolta: '2025-08-05',
        solicitante: 'Luciano',
        status: 'Cancelado'
    }
]);
</script>

<template>
    <div class="overflow-x-auto">
        <table class="table-auto w-full text-sm">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Destino</th>
                    <th class="border px-4 py-2">Ida</th>
                    <th class="border px-4 py-2">Volta</th>
                    <th class="border px-4 py-2">Solicitante</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="pedido in pedidos" :key="pedido.id">
                    <td class="border px-4 py-2">{{ pedido.id }}</td>
                    <td class="border px-4 py-2 truncate">{{ pedido.destino }}</td>
                    <td class="border px-4 py-2 text-center">{{ pedido.dataIda }}</td>
                    <td class="border px-4 py-2 text-center">{{ pedido.dataVolta }}</td>
                    <td class="border px-4 py-2">{{ pedido.solicitante }}</td>
                    <td class="border px-4 py-2 text-center">{{ pedido.status }}</td>
                    <td class="border px-4 py-2 text-center flex justify-center space-x-2">
                        <Acao :id="pedido.id" :acao="'aprovar'" />
                        <Acao :id="pedido.id" :acao="'cancelar'" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>