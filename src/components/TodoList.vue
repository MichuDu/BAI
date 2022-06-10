<template>
  <div>
    <ul v-for="todo in todosFilters" :key="todo.id">
      <li>
        <span :class="{ 'todo-completed': todo.status == 1 }">
          {{ todo.name }}
        </span>
        <button @click="setTodoStatus(todo.id)">Wykonane</button>
        <button @click="deleteTodo(todo.id)">Usuń</button>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { useTodoListStore } from "@/stores/todolist.store";
import { onMounted } from "vue";
import { storeToRefs } from "pinia";

const store = useTodoListStore();
const { todosFilters } = storeToRefs(store);
const { setTodoStatus, deleteTodo } = store;

onMounted(() => {
  store.getTodos();
});
</script>

<style>
.todo-completed {
  text-decoration: line-through;
}
</style>
