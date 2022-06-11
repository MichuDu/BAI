<template>
  <header class="todo-header">
    <div class="todo-header-wrapper wrapper">
      <div class="todo-header-title">
        <router-link class="h1" :to="'/'">Todo App</router-link>
      </div>
      <nav v-if="authStore.user" class="todo-header-nav">
        <p class="todo-header-welcome">
          Cześć
          <span class="todo-header-welcome-user">{{ authStore.user.name }}</span
          >!
        </p>
        <a class="todo-header-logout link" @click="authStore.logout()"
          >Wyloguj się</a
        >
      </nav>
    </div>
  </header>
</template>

<script setup>
import { useAuthStore } from "@/stores/auth.store";

const authStore = useAuthStore();
</script>

<style lang="scss">
@import "@/scss/utils/_variables.scss";

.todo-header {
  padding: 32px 0;
  background-color: $color-light-brown;
  border-bottom: 1px solid $color-black;
}

.todo-header-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
}

.todo-header-title {
  flex: 1;
  font-weight: 500;
  letter-spacing: 4px;
  text-align: center;
  text-transform: uppercase;
}

.todo-header-nav {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-left: auto;
  padding-left: 16px;

  @media (min-width: $media-tablet) {
    align-items: baseline;
    flex-direction: row;
  }
}

.todo-header-welcome {
  @media (min-width: $media-tablet) {
    margin-right: 24px;
  }
}

.todo-header-welcome-user {
  font-weight: bold;
}
</style>
