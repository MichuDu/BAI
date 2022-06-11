<template>
  <li
    class="todo-tasks-item"
    v-for="todo in todosFilters"
    :key="todo.id"
    @click="setTodoStatus(todo.id)"
  >
    <span
      class="todo-task-name"
      :class="{
        'todo-completed': todo.status == 1,
        'todo-flag': todo.flag == 1,
      }"
    >
      {{ todo.name }}
    </span>
    <span class="todo-task-actions">
      <button class="todo-task-remove button" @click="deleteTodo(todo.id)">Usuń</button>
    </span>
  </li>
</template>

<script setup>
import { useTodoListStore } from "@/stores/todolist.store";

import { storeToRefs } from "pinia";

const store = useTodoListStore();
const { setTodoStatus, deleteTodo } = store;
const { todosFilters } = storeToRefs(store);
</script>

<style lang="scss">
@import "@/scss/utils/_variables.scss";

.todo-tasks-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 16px 0;
  padding: 16px;
  background-color: $color-beige;
  border: 1px solid $color-black;
  box-shadow: 5px 5px 22px 0px rgba(66, 68, 90, 0.4);
  cursor: pointer;
  transition: 0.3s background-color;

  &:hover {
    background-color: lighten($color-beige, 4%);
  }

  @media (min-width: $media-tablet) {
    max-width: 800px;
  }
}

.todo-task-name {
  font-weight: bold;
}

.todo-completed {
  text-decoration: line-through;
}

.todo-flag {
  color: $color-red;
}
</style>
