import { createRouter, createWebHistory, type RouteRecordRaw } from 'vue-router';
import Dashboard from '../pages/Dashboard.vue';
import CadastroPedido from '../pages/CadastroPedido.vue';
import ConsultaPedido from '../pages/ConsultaPedido.vue';

const routes: RouteRecordRaw[] = [
  { path: '/', component: Dashboard },
  { path: '/pedido/cadastrar', component: CadastroPedido },
  { path: '/pedido/consultar', component: ConsultaPedido },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
});

export default router;