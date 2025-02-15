import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/views/Home.vue';
import Login from '@/views/Login.vue';
import Dashboard from '@/views/Dashboard.vue';
import UserView from '@/Modules/Users/views/View.vue';
import { useUserStore } from '@/stores/user';
import axios from 'axios';

axios.defaults.baseURL = import.meta.env.VITE_API_BASE_URL_API;
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;
axios.defaults.headers.common['Content-Type'] = 'application/json';
axios.defaults.headers.common['Accept'] = 'application/json';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/users/list',
        name: 'UsersList',
        component: UserView,
        meta: {
            requiresAuth: true,
        },
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const userStore = useUserStore();
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!userStore.isAuthenticated) {
            next({ name: 'Login' });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
