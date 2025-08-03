<script lang="ts" setup>
import { ref } from 'vue';
import Nav from '@/components/Nav.vue';
import FormularioPedido from '@/components/FormularioPedido.vue';
import Loading from '@/components/Loading.vue';
import Notificacao from '@/components/Notificacao.vue';

const showModal = ref(false);
const mensagemErro = ref('');
const tipoStatus = ref('');
const carregando = ref(false);
</script>

<template>
    <Nav />
    <div class="bg-gray-100 min-h-screen">
        <Loading :ativo="carregando" />
        <Notificacao v-model="showModal" :tipo="tipoStatus" :mensagem="mensagemErro" />
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <section class="rounded-lg overflow-hidden shadow-lg bg-white w-full mt-6">
                    <div class="px-6 py-6">
                        <div class="font-bold text-xl text-left mb-6">Cadastrar pedido de viagem</div>
                        <div>
                            <FormularioPedido
                                @status="(tipo, msg) => { tipoStatus = tipo ; mensagemErro = msg; showModal = true; }"
                                @loading="(status) => { carregando = status; }"
                            />
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>