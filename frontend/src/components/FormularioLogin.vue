<script lang="ts" setup>
import { reactive } from 'vue';
import type LoginI from '@/interfaces/LoginInterface';
import { useRouter } from 'vue-router';
import { LoginService } from '@/services/LoginService';

const router = useRouter();

const form = reactive<LoginI>({
  usuario: '',
  senha: '',
});

const emit = defineEmits<{
  (e: 'erro-login', msg: string): void;
  (e: 'loading', status: boolean): void;
}>();

function formSubmit() {
  emit('loading', true);

  const loginService = new LoginService();
  loginService.login(form.usuario, form.senha).then((response) => {
      if (response) {
        router.push('/');
      } else {
        emit('erro-login', 'Usuário ou senha inválidos.');
      }
  }).finally(() => {
    emit('loading', false);
  });
}
</script>

<template>
    <form @submit.prevent="formSubmit" class="space-y-4 w-full">
        <div>
            <label class="block text-sm font-medium">Usuário</label>
            <input v-model="form.usuario" type="text" class="mt-1 w-full border px-3 py-2 rounded" required />
        </div>

        <div>
            <label class="block text-sm font-medium">Senha</label>
            <input v-model="form.senha" type="password" class="mt-1 w-full border px-3 py-2 rounded" required />
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Logar</button>
    </form>
</template>
