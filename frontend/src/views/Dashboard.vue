<template>
    <div class="dashboard-layout d-flex">
      <!-- Menu Lateral -->
      <nav class="sidebar bg-light">
        <ul class="nav flex-column">
          <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">Dashboard</router-link>
          </li>
          <li class="nav-item">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              @click.prevent="toggleSubMenu('posts')"
            >
              Posts
            </a>
            <ul v-if="submenus.posts" class="nav flex-column ms-3">
              <li class="nav-item">
                <router-link to="/posts/list" class="nav-link">Lista de Posts</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/posts/new" class="nav-link">Novo Post</router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              @click.prevent="toggleSubMenu('settings')"
            >
              Configurações
            </a>
            <ul v-if="submenus.settings" class="nav flex-column ms-3">
              <li class="nav-item">
                <router-link to="/settings/profile" class="nav-link">Perfil</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/settings/preferences" class="nav-link">Preferências</router-link>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
  
      <!-- Conteúdo Principal -->
      <div class="main-content flex-grow-1 p-4">
        <router-view></router-view>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue'
  
  const submenus = ref({
    posts: false,
    settings: false,
  })
  
  function toggleSubMenu(menu: string) {
    submenus.value[menu] = !submenus.value[menu]
  }
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
  