<script lang="ts" setup>
import Nav from '@/components/Nav.vue';
import DetalhePedido from '@/components/DetalhePedido.vue';
</script>

<template>
    <Nav />
    <div class="bg-gray-100 min-h-screen">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <section class="rounded-lg overflow-hidden shadow-lg bg-white w-full mt-6">
                    <div class="px-6 py-6">
                        <div class="font-bold text-xl text-left mb-6">Pedido</div>
                        <div>
                            <DetalhePedido />
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>