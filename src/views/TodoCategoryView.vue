<template>
  <div class="todo-list">
    <TodoCategories />
    <div class="todo-list-content">
      <TodoAdd />
      <div class="todo-category-title">
        <h3>{{ activeCategory }}</h3>
      </div>
      <TodoFilters />
      <TodoList />
    </div>
  </div>
</template>

<script setup>
import TodoAdd from "@/components/TodoAdd.vue";
import TodoList from "@/components/TodoList.vue";
import TodoFilters from "@/components/TodoFilters.vue";
import TodoCategories from "@/components/TodoCategories.vue";

import { useTodoListStore } from "@/stores/todolist.store";

const store = useTodoListStore();
const { setPath, activeCategory } = store;

setPath();
</script>

<style lang="scss">
@import "@/scss/utils/_variables.scss";

.todo-list {
  display: flex;
  flex-direction: column;
  padding: 0 16px;

  @media (min-width: $media-tablet) {
    flex-direction: row;
    min-height: 90vh;
  }
}

.todo-list-content {
  @media (min-width: $media-tablet) {
    flex: 1;
    padding: 0 72px;
  }
}

.todo-category-title {
  margin-top: 32px;
}
</style>
