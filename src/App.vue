<script setup>
import { RouterView } from "vue-router";
import TodoHeader from "@/components/TodoHeader.vue";
</script>

<template>
  <div class="todo-container">
    <TodoHeader />
    <main class="todo-main">
      <RouterView />
    </main>
  </div>
</template>

<style lang="scss">
@import "@/scss/style.scss";
</style>
