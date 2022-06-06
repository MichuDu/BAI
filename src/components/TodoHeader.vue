<template>
  <header>
    <div>
      <div>
        <h1>Todo App</h1>
      </div>
      <nav v-if="authStore.user">
        <p>Cześć {{ authStore.user.name }}!</p>
        <a @click="authStore.logout()">Wyloguj się</a>
      </nav>
    </div>
  </header>
</template>

<script setup>
import { useAuthStore } from "@/stores/auth.store";

const authStore = useAuthStore();
</script>
