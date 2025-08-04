<script lang="ts" setup>
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { PedidoService } from '@/services/PedidoService';
import type PedidoI from '@/interfaces/PedidoInterface';

const pedido = ref<PedidoI | null>(null);

const emit = defineEmits<{
  (e: 'status', tipo: string, msg: string): void;
  (e: 'loading', status: boolean): void;
}>();

const route = useRoute();
const id = parseInt(route.params.id as string, 10);

onMounted(async () => {
  emit('loading', true);

  const pedidoService = new PedidoService();
  await pedidoService.getPedido(id).then((response) => {
    if (response) {
      pedido.value = response;
    } else {
      emit('status', 'erro', 'Erro ao carregar detalhes do pedido');
    }
  }).finally(() => {
    emit('loading', false);
  });
});
</script>

<template>
    <div v-if="pedido" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
      <div>
        <label class="text-gray-600 font-medium">Destino: </label>
        <p class="text-gray-900 inline">{{ pedido.destino }}</p>
      </div>

      <div>
        <label class="text-gray-600 font-medium">Data de Ida: </label>
        <p class="text-gray-900 inline">{{ pedido.dataIda }}</p>
      </div>

      <div>
        <label class="text-gray-600 font-medium">Data de Volta: </label>
        <p class="text-gray-900 inline">{{ pedido.dataVolta }}</p>
      </div>

      <div>
        <label class="text-gray-600 font-medium">Solicitante: </label>
        <p class="text-gray-900 inline">{{ pedido.solicitante }}</p>
      </div>

      <div>
        <label class="text-gray-600 font-medium">Status: </label>
        <span
          class="inline-block mt-1 px-3 py-1 text-sm font-semibold rounded-full"
          :class="{
            'bg-yellow-100 text-yellow-800': pedido.status === 'solicitado',
            'bg-green-100 text-green-800': pedido.status === 'aprovado',
            'bg-red-100 text-red-800': pedido.status === 'cancelado',
          }"
        >
          {{ pedido.status.toLocaleUpperCase() }}
        </span>
      </div>
    </div>
    <div v-else-if="pedido == null" class="text-center text-gray-500">Dados do pedido não encontrados.</div>
</template>