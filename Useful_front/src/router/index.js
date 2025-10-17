import DashboardView from '@/views/DashboardView.vue'
import LoginView from '@/views/LoginView.vue'
import RegisterView from '@/views/RegisterView.vue'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
        path: '/login',
        name: 'login',
        component: LoginView
    },

    {
        path: '/register',
        name: 'register',
        component: RegisterView
    },

    {
        path: '/',
        name: 'home',
        component: DashboardView
    },
  ],
})

export default router
