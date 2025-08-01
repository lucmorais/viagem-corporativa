<script lang="ts" setup>
import { ref } from 'vue'

interface Pedido {
  id: number
  destino: string
  dataIda: string
  dataVolta: string
  solicitante: string
  status: 'pendente' | 'aprovado' | 'cancelado'
}

const pedido = ref<Pedido>({
  id: 42,
  destino: 'São Paulo',
  dataIda: '2025-08-01',
  dataVolta: '2025-08-05',
  solicitante: 'Kowalski',
  status: 'pendente'
})
</script>

<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label class="text-gray-600 font-medium">ID:</label>
        <p class="text-gray-900">{{ pedido.id }}</p>
      </div>

      <div>
        <label class="text-gray-600 font-medium">Destino:</label>
        <p class="text-gray-900">{{ pedido.destino }}</p>
      </div>

      <div>
        <label class="text-gray-600 font-medium">Data de Ida:</label>
        <p class="text-gray-900">{{ pedido.dataIda }}</p>
      </div>

      <div>
        <label class="text-gray-600 font-medium">Data de Volta:</label>
        <p class="text-gray-900">{{ pedido.dataVolta }}</p>
      </div>

      <div class="sm:col-span-2">
        <label class="text-gray-600 font-medium">Solicitante:</label>
        <p class="text-gray-900">{{ pedido.solicitante }}</p>
      </div>

      <div class="sm:col-span-2">
        <label class="text-gray-600 font-medium">Status:</label>
        <span
          class="inline-block mt-1 px-3 py-1 text-sm font-semibold rounded-full"
          :class="{
            'bg-yellow-100 text-yellow-800': pedido.status === 'pendente',
            'bg-green-100 text-green-800': pedido.status === 'aprovado',
            'bg-red-100 text-red-800': pedido.status === 'cancelado',
          }"
        >
          {{ pedido.status }}
        </span>
      </div>
    </div>
</template>