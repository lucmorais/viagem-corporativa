<script lang="ts" setup>
import { onMounted, ref, computed, watch } from 'vue';
import { ZoomIn } from 'lucide-vue-next';
import Acao from './Acao.vue';
import { PedidoService } from '../services/PedidoService';
import type PedidoI from '../interfaces/PedidoInterface';

const pedidoService = new PedidoService();

const pedidos = ref<PedidoI[] | undefined>([]);
const filtroSolicitante = ref('');
const filtroDestino = ref('');
const filtroDataIda = ref('');
const filtroDataVolta = ref('');
const filtroStatus = ref('');

const emit = defineEmits<{
    (e: 'status', tipo: string, msg: string): void;
    (e: 'loading', status: boolean): void;
}>();

const usuario = JSON.parse(localStorage.getItem('usuario') || '{}');
const permissao = Object.keys(usuario).length > 0 ? usuario.permissao : '';

watch([filtroSolicitante, filtroDestino, filtroDataIda, filtroDataVolta, filtroStatus], async () => {
    emit('loading', true);

    await pedidoService.filtrarPedidos(
        filtroSolicitante.value,
        filtroDestino.value,
        filtroDataIda.value,
        filtroDataVolta.value,
        filtroStatus.value
    ).then((response) => {
        if (response) {
            pedidos.value = response;
        } else {
            pedidos.value = [];
            emit('status', 'error', 'Erro ao filtrar pedidos');
        }
    }).finally(() => {
        emit('loading', false);
    });
});

onMounted(async () => {
    carregarPedidos();
});

async function carregarPedidos() {
    emit('loading', true);
    await pedidoService.getPedidos().then((response) => {
        if (response) {
            pedidos.value = response;
        } else {
            pedidos.value = [];
            emit('status', 'error', 'Erro ao carregar pedidos');
        }
    }).finally(() => {
        emit('loading', false);
    });
}

async function aprovarPedido(id: number) {
    emit('loading', true);
    await pedidoService.updatePedido(id, { status: 'aprovado' }).then(async (response) => {
        if (response == 200) {
            emit('status', 'sucesso', 'Pedido aprovado com sucesso');
            await carregarPedidos();
        } else if (response == 400) {
            emit('status', 'erro', 'Pedido não pode ser aprovado');
        } else {
            emit('status', 'erro', 'Erro ao aprovar pedido');
        }
    }).finally(() => {
        emit('loading', false);
    });
}

async function cancelarPedido(id: number) {
    emit('loading', true);
    await pedidoService.updatePedido(id, { status: 'cancelado' }).then(async (response) => {
        if (response == 200) {
            emit('status', 'sucesso', 'Pedido cancelado com sucesso');
            await carregarPedidos();
        } else if (response == 400) {
            emit('status', 'erro', 'Pedido não pode ser cancelado');
        } else {
            emit('status', 'erro', 'Erro ao cancelar pedido');
        }
    }).finally(() => {
        emit('loading', false);
    });
}
</script>

<template>
    <div class="overflow-x-auto">
        <table class="table-auto w-full text-sm">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Solicitante</th>
                    <th class="border px-4 py-2">Destino</th>
                    <th class="border px-4 py-2">Ida</th>
                    <th class="border px-4 py-2">Volta</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-2 py-1">
                        <input
                            v-model="filtroSolicitante"
                            type="text"
                            placeholder="Solicitante"
                            class="w-full px-2 py-1 border rounded focus:outline-none focus:ring"
                        />
                    </td>
                    <td class="border px-2 py-1">
                        <input
                            v-model="filtroDestino"
                            type="text"
                            placeholder="Destino"
                            class="w-full px-2 py-1 border rounded focus:outline-none focus:ring"
                        />
                    </td>
                    <td class="border px-2 py-1">
                        <input
                            v-model="filtroDataIda"
                            type="date"
                            class="w-full px-2 py-1 border rounded focus:outline-none focus:ring"
                        />
                    </td>
                    <td class="border px-2 py-1">
                        <input
                            v-model="filtroDataVolta"
                            type="date"
                            class="w-full px-2 py-1 border rounded focus:outline-none focus:ring"
                        />
                    </td>
                    <td class="border px-2 py-1">
                        <input
                            v-model="filtroStatus"
                            type="text"
                            placeholder="Status"
                            class="w-full px-2 py-1 border rounded focus:outline-none focus:ring"
                        />
                    </td>
                    <td class="border px-2 py-1 text-center text-gray-400 italic">
                    </td>
                </tr>
                <tr v-for="pedido in pedidos" :key="pedido.id">
                    <td class="border px-4 py-2">{{ pedido.solicitante }}</td>
                    <td class="border px-4 py-2 truncate">{{ pedido.destino }}</td>
                    <td class="border px-4 py-2 text-center">{{ pedido.dataIda }}</td>
                    <td class="border px-4 py-2 text-center">{{ pedido.dataVolta }}</td>
                    <td class="border px-4 py-2 text-center">
                        <span
                            class="inline-block mt-1 px-3 py-1 text-sm font-semibold rounded-full"
                            :class="{
                                'bg-yellow-100 text-yellow-800': pedido.status === 'solicitado',
                                'bg-green-100 text-green-800': pedido.status === 'aprovado',
                                'bg-red-100 text-red-800': pedido.status === 'cancelado',
                            }"
                        >{{ pedido.status.toLocaleUpperCase() }}</span>
                    </td>
                    <td class="border px-4 py-2 text-center flex justify-center space-x-2">
                        <Acao
                            v-if="permissao === 'admin' && pedido.status === 'solicitado'"
                            :id="pedido.id" :acao="'aprovar'"
                            @aprovar="aprovarPedido"
                        />
                        <Acao
                            v-if="permissao === 'admin' && pedido.status === 'solicitado'" :id="pedido.id"
                            :acao="'cancelar'"
                            @cancelar="cancelarPedido"
                        />
                        <RouterLink :to="{ name: 'consulta-pedido', params: { id: pedido.id } }" class="rounded-md bg-black/20 px-4 py-2 text-sm font-medium text-white hover:bg-black/30 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"><ZoomIn /></RouterLink>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>