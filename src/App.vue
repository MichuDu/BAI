<script setup>
import { RouterView } from "vue-router";
import TodoHeader from "@/components/TodoHeader.vue";
</script>

<template>
  <div class="todo-container">
    <TodoHeader />
    <RouterView />
  </div>
</template>

<style lang="scss">
@import "@/scss/style.scss";
</style>
