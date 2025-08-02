<script lang="ts" setup>
import { Menu as IconeMenu } from 'lucide-vue-next';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { CircleX, Check } from 'lucide-vue-next';
import { ref, computed } from 'vue';
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue';

const props = defineProps<{
  id: number,
  acao: 'aprovar' | 'cancelar'
}>();

const tituloModal = computed(() => {
  switch (props.acao) {
    case 'aprovar':
      return 'Aprovar pedido nº ' + props.id;
    case 'cancelar':
      return 'Cancelar pedido nº ' + props.id;
  }
});

const descricaoModal = computed(() => {
  switch (props.acao) {
    case 'aprovar':
      return 'Tem certeza que deseja aprovar este pedido de viagem?';
    case 'cancelar':
      return 'Tem certeza que deseja cancelar este pedido de viagem?'
  }
});

const icone = computed(() => {
  switch (props.acao) {
    case 'aprovar':
      return Check;
    case 'cancelar':
      return CircleX;
  }
});

const isOpen = ref(false)

function closeModal() {
  isOpen.value = false
}

function openModal() {
  isOpen.value = true
}
</script>

<template>
    <div class="inset-0 flex items-center justify-center">
        <button
            type="button"
            @click="openModal"
            class="rounded-md bg-black/20 px-4 py-2 text-sm font-medium text-white hover:bg-black/30 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
        >
            <component
                :is="icone"
                :class="[props.acao === 'aprovar' ? 'text-green-500' : 'text-red-500']"
            />
        </button>
    </div>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
        <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100"
            leave-to="opacity-0"
        >
            <div class="fixed inset-0 bg-black/25" />
        </TransitionChild>

        <div class="fixed inset-0 overflow-y-auto">
            <div
                class="flex min-h-full items-center justify-center p-4 text-center"
            >
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0 scale-95"
                enter-to="opacity-100 scale-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100 scale-100"
                leave-to="opacity-0 scale-95"
            >
                <DialogPanel
                    class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                >
                <DialogTitle
                    as="h3"
                    class="text-lg font-medium leading-6 text-gray-900"
                >
                    {{ tituloModal }}
                </DialogTitle>
                <div class="mt-2">
                    <p class="text-sm text-gray-500">
                        {{ descricaoModal }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-2 mt-4">
                    <button
                        type="button"
                        class="inline-flex justify-center rounded-md border border-transparent bg-green-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-green-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-green-500 focus-visible:ring-offset-2"
                        @click=""
                    >
                        Sim
                    </button>
                    <button
                        type="button"
                        class="inline-flex justify-center rounded-md border border-transparent bg-red-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-red-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2"
                        @click="closeModal"
                    >
                        Não
                    </button>
                </div>
                </DialogPanel>
            </TransitionChild>
            </div>
        </div>
        </Dialog>
    </TransitionRoot>
</template>