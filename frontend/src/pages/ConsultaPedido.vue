<script lang="ts" setup>
import DetalhePedido from '@/components/DetalhePedido.vue';
</script>

<template>
    <section class="rounded-lg overflow-hidden shadow-lg bg-white w-full mt-6">
        <div class="px-6 py-6">
            <div class="font-bold text-xl mb-6">Pedido</div>
            <div>
                <DetalhePedido />
            </div>
        </div>
    </section>
</template>