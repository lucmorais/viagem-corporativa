<script lang="ts" setup>
import { ref } from 'vue';
import FormularioLogin from '@/components/FormularioLogin.vue';
import Notificacao from '@/components/Notificacao.vue';
import Loading from '@/components/Loading.vue';

const showModal = ref(false);
const mensagemErro = ref('');
const carregando = ref(false);
</script>

<template>
  <div class="bg-gray-100 min-h-screen flex items-center">
    <Loading :ativo="carregando" />
    <Notificacao v-model="showModal" tipo="erro" :mensagem="mensagemErro" />
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="flex justify-center">
        <section class="rounded-lg overflow-hidden shadow-lg bg-white w-full mt-6">
          <div class="px-6 py-6">
            <div class="font-bold text-xl text-left mb-6">Login</div>
            <div>
                <FormularioLogin @erro-login="(msg) => { mensagemErro = msg; showModal = true; }" @loading="(status) => { carregando = status; }" />
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>