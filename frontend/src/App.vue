<template>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <router-link class="navbar-brand" to="/">Vue 3 App</router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link class="nav-link" to="/">Home</router-link>
            </li>
            <li class="nav-item" v-if="!isAuthenticated">
              <router-link class="nav-link" to="/login">Login</router-link>
            </li>
            <li class="nav-item" v-if="isAuthenticated">
              <router-link class="nav-link" to="/dashboard">Dashboard</router-link>
            </li>
          </ul>
          <button class="btn btn-outline-danger" @click="execLogout" v-show="isAuthenticated">Logout</button>
        </div>
      </div>
    </nav>
    <div class="dashboard-layout d-flex" v-if="isAuthenticated">
      <nav class="sidebar bg-light">
        <ul class="nav flex-column">
          <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">Dashboard</router-link>
          </li>
          <li class="nav-item">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              @click.prevent="toggleSubMenu('users')"
            >
              Users
            </a>
            <ul v-if="submenus.users" class="nav flex-column ms-3">
              <li class="nav-item">
                <router-link to="/users/list" class="nav-link">Lista dos Usuários</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/users/new" class="nav-link">Novo Post</router-link>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
  
      <div class="main-content flex-grow-1 p-4">
        <router-view></router-view>
      </div>
    </div>
    <div v-else>
      <router-view></router-view>
    </div>
  </div>
</template>
<script lang="ts" setup>
import { useUserStore } from "./stores/user";
import { useLogout } from "@/composables/authFunctions";
import { useToast } from 'vue-toast-notification';
import { useRouter } from 'vue-router'
import { computed, ref } from 'vue';
import Pusher from 'pusher-js';

const submenus = ref({
  users: false,
  settings: false,
})
  
const toggleSubMenu = (menu: string) => {
  submenus.value[menu] = !submenus.value[menu]
}

const router = useRouter();
const { logout } = useLogout();
const $toast = useToast();
const userStore = useUserStore();
const isAuthenticated = computed(() => userStore.isAuthenticated);

const wsConfig = {
  appKey: import.meta.env.VITE_WEBSOCKET_APP_KEY,
  cluster: import.meta.env.VITE_WEBSOCKET_APP_CLUSTER,
  wsHost: import.meta.env.VITE_WEBSOCKET_APP_HOST,
  wsPort: Number(import.meta.env.VITE_WEBSOCKET_APP_PORT),
  forceTLS: import.meta.env.VITE_WEBSOCKET_FORCE_TLS == 'true',
  disableStats: import.meta.env.VITE_WEBSOCKET_DISABLE_STATS == 'true',
  enabledTransports: ['ws', 'wss'],
};

const websocketClient = new Pusher(wsConfig.appKey, {
  cluster: wsConfig.cluster,
  wsHost: wsConfig.wsHost,
  wsPort: Number(wsConfig.wsPort),
  forceTLS: Boolean(wsConfig.forceTLS),
  disableStats: Boolean(wsConfig.disableStats),
  enabledTransports: ['ws', 'wss'],
});

websocketClient.connection.bind("error", function (err) {
  console.log('error', err);
});

websocketClient.connection.bind("connected", function () {
  console.log('connected');
});

const channelSubscription = websocketClient.subscribe('users');

channelSubscription.bind('user.login', (message) => {
  console.log('message', message);
});

const execLogout = async () => {
    try {
        await logout();
        router.push({ name: 'Login' });
    } catch (error) {
        const errorMessage = error.response?.data?.message ?? error.message ?? 'Erro desconhecido';
        $toast.error(errorMessage, { duration: 2500, position: 'top-right' });  
    }
};
</script>
  
  <style scoped>
  .dashboard-layout {
    height: 100vh;
  }
  
  .sidebar {
    width: 250px;
  }
  
  .main-content {
    overflow-y: auto;
  }
  </style>
  