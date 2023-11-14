<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Main from './components/Main.vue'
</script>
<template>
  <header>
    <div class="container text-center my-5">
      <Main msg="Welcome to Hospital Care" class="mb-5" />
      <nav class="nav nav-tabs justify-content-center">
        <div class="nav-item">
          <RouterLink to="/" class="nav-link" :class="{ active: $route.path === '/' }">List Patient</RouterLink>
        </div>
        <div class="nav-item">
          <RouterLink to="/add-patient" class="nav-link" :class="{ active: $route.path === '/add-patient' }">Add Patient</RouterLink>
        </div>
      </nav>
    </div>
  </header>
  <RouterView />
</template>