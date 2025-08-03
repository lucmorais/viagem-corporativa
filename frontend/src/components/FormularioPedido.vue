<script lang="ts" setup>
import { reactive } from 'vue';
import { PedidoService } from '@/services/PedidoService';

const form = reactive({
  destino: '',
  dataIda: '',
  dataVolta: '',
  idUsuario: 0,
});

const usuario = JSON.parse(localStorage.getItem('usuario') || '{}');
form.idUsuario = Object.keys(usuario).length > 0 ? usuario.id : 0;

const emit = defineEmits<{
  (e: 'status', tipo: string, msg: string): void;
  (e: 'loading', status: boolean): void;
}>();

function formSubmit() {
  emit('loading', true);

  const pedidoService = new PedidoService();
  pedidoService.createPedido(form).then((response) => {
    if (response == 201) {
      emit('status', 'sucesso', 'Pedido cadastrado com sucesso');
    } else {
      emit('status', 'erro', 'Erro ao cadastrar pedido');
    }

    form.destino = '';
    form.dataIda = '';
    form.dataVolta = '';
  }).finally(() => {
    emit('loading', false);
  });
}
</script>

<template>
    <form @submit.prevent="formSubmit" class="space-y-4 w-full">
        <div>
            <label class="block text-sm font-medium">Destino</label>
            <input v-model="form.destino" type="text" class="mt-1 w-full border px-3 py-2 rounded" required />
        </div>

        <div>
            <label class="block text-sm font-medium">Ida</label>
            <input v-model="form.dataVolta" type="date" class="mt-1 w-full border px-3 py-2 rounded" required />
        </div>

        <div>
            <label class="block text-sm font-medium">Volta</label>
            <input v-model="form.dataIda" type="date" class="mt-1 w-full border px-3 py-2 rounded" required />
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cadastrar</button>
    </form>
</template>
