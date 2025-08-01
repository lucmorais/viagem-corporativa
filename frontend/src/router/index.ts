import { createRouter, createWebHistory, type RouteRecordRaw } from 'vue-router';
import Dashboard from '../pages/Dashboard.vue';
import Pedido from '../pages/Pedido.vue';

const routes: RouteRecordRaw[] = [
  { path: '/', component: Dashboard },
  { path: '/pedido/cadastrar', component: Pedido },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
});

export default router;