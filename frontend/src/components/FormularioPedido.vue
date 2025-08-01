<script lang="ts" setup>
import { reactive } from 'vue'

const form = reactive({
  nome: '',
  email: '',
  mensagem: ''
})

function formSubmit() {
  if (!form.nome || !form.email) {
    alert('Preencha todos os campos obrigatórios.')
    return
  }
}
</script>

<template>
    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white w-full">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">Cadastro de pedido</div>
                <form @submit.prevent="formSubmit" class="space-y-4 w-full">
                    <div>
                        <label class="block text-sm font-medium">Nome</label>
                        <input v-model="form.nome" type="text" class="mt-1 w-full border px-3 py-2 rounded" required />
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Email</label>
                        <input v-model="form.email" type="email" class="mt-1 w-full border px-3 py-2 rounded" required />
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Mensagem</label>
                        <textarea v-model="form.mensagem" class="mt-1 w-full border px-3 py-2 rounded"></textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enviar</button>
                </form>
            </div>
        <div class="px-6 pt-4 pb-2">
            <span class="inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-blue-700 mr-2">#exemplo</span>
            <span class="inline-block bg-green-200 rounded-full px-3 py-1 text-sm font-semibold text-green-700">#tailwind</span>
        </div>
    </div>
</template>
