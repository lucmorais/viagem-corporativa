<script lang="ts" setup>
import { CircleX, Check } from 'lucide-vue-next';
import { computed, onMounted, watch } from 'vue';
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue';

const props = defineProps<{
  modelValue: boolean;
  mensagem: string;
  tipo: string;
}>();

const emit = defineEmits(['update:modelValue']);

const icone = computed(() => {
  switch (props.tipo) {
    case 'sucesso':
      return Check;
    case 'erro':
      return CircleX;
  }
});

function fecharModal() {
  emit('update:modelValue', false);
}

watch(() => props.modelValue, (val) => {
  if (val) {
    setTimeout(() => {
      fecharModal();
    }, 5000);
  }
});
</script>

<template>
    <TransitionRoot appear :show="modelValue" as="template">
        <Dialog as="div" @close="fecharModal" class="relative z-10">
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

            <div class="fixed inset-0 pointer-events-none z-50">
                <div class="absolute top-4 right-4 w-full max-w-sm pointer-events-auto">
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
                        <component :is="icone" class="inline-block mr-2" />{{ tipo === 'erro' ? 'Erro' : 'Sucesso' }}
                    </DialogTitle>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            {{ mensagem }}
                        </p>
                    </div>
                    </DialogPanel>
                </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>