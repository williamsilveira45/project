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
          <button class="btn btn-outline-danger" @click="logout" v-if="isAuthenticated">Logout</button>
        </div>
      </div>
    </nav>
    <router-view></router-view>
  </div>
</template>

<script setup>
import { useUserStore } from '@/stores/user';

const userStore = useUserStore();
const isAuthenticated = userStore.isAuthenticated;

const logout = () => {
  // authStore.logout();
};
</script>