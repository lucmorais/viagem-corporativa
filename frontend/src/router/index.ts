import { createRouter, createWebHistory, type RouteRecordRaw } from 'vue-router';
import Dashboard from '../pages/Dashboard.vue';
import Login from '@/pages/Login.vue';
import CadastroPedido from '../pages/CadastroPedido.vue';
import ConsultaPedido from '../pages/ConsultaPedido.vue';

const routes: RouteRecordRaw[] = [
  { path: '/', component: Dashboard },
  { path: '/login', component: Login },
  { path: '/pedido/cadastrar', component: CadastroPedido },
  { path: '/pedido/consultar', component: ConsultaPedido },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
});

router.beforeEach((to, from, next) => {
  const autenticado = !!localStorage.getItem('token');

  if (to.path !== '/login' && !autenticado) {
    next('/login');
  } else {
    next();
  }
});

export default router;