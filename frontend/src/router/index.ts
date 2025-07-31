import { createRouter, createWebHistory, type RouteRecordRaw } from 'vue-router';
import Dashboard from '../components/dashboard/Dashboard.vue';
// import Login from '../pages/Login.vue';

const routes: RouteRecordRaw[] = [
  { path: '/', component: Dashboard },
  // { path: '/login', component: Login }
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
});

export default router;