<script lang="ts" setup>
import { reactive } from 'vue'

const form = reactive({
  destino: '',
  data_ida: '',
  data_volta: '',
})

function formSubmit() {
  if (!form.destino || !form.data_ida || !form.data_volta) {
    alert('Preencha todos os campos obrigatórios.')
    return
  }
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
            <input v-model="form.data_ida" type="date" class="mt-1 w-full border px-3 py-2 rounded" required />
        </div>

        <div>
            <label class="block text-sm font-medium">Volta</label>
            <input v-model="form.data_volta" type="date" class="mt-1 w-full border px-3 py-2 rounded" required />
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cadastrar</button>
    </form>
</template>
