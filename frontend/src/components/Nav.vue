<script lang="ts" setup>
import { ref } from 'vue';
import { RouterLink, useRouter } from 'vue-router';
import { LayoutDashboard, Plus, LogOut } from 'lucide-vue-next';
import { LoginService } from '../services/LoginService';
import Loading from './Loading.vue';

const usuario = JSON.parse(localStorage.getItem('usuario') || '{}');
const nomeUsuario = usuario?.nome || '';

const emit = defineEmits<{
  (e: 'status', tipo: string, msg: string): void;
  (e: 'loading', status: boolean): void;
}>();

const carregando = ref(false);

const router = useRouter();
const loginService = new LoginService();

async function logout() {
  carregando.value = true;
  await loginService.logout().then((response) => {
    if (response === 200) {
      localStorage.removeItem('token');
      localStorage.removeItem('usuario');
      router.push('/login');
    }
  }).finally(() => {
    carregando.value = false;
  });
}
</script>

<template>
  <header>
    <nav class="bg-gray-800">
      <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
          <div class="flex flex-1 items-center sm:items-stretch sm:justify-start">
            <div class="flex space-x-4">
              <RouterLink to="/" v-slot="{ isActive }">
                <span :class="['pr-3 py-2 text-sm font-medium rounded-md', isActive ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white']">
                  <LayoutDashboard class="inline" /> Dashboard
                </span>
              </RouterLink>

              <RouterLink to="/pedido/cadastrar" v-slot="{ isActive }">
                <span :class="['px-3 py-2 text-sm font-medium rounded-md', isActive ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white']">
                  <Plus class="inline" /> Pedido
                </span>
              </RouterLink>
            </div>
          </div>
          <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
            <span class="bg-white text-gray-800 px-3 py-1 rounded-full text-sm font-medium shadow mr-2">
              {{ nomeUsuario }}
            </span>
            <button
              type="button"
              @click="logout"
              class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
            >
              <span class="absolute -inset-1.5"></span>
              <LogOut class="inline" />
            </button>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <Loading :ativo="carregando" />
</template>