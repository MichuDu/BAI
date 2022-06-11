<template>
  <div>
    <div>
      <h3>Twoje zadania</h3>
    </div>
    <ul v-if="Object.keys(todosFilters).length !== 0">
      <li v-for="todo in todosFilters" :key="todo.id">
        <TodoItem :todo="todo" />
      </li>
    </ul>
    <div v-else>
      <span>Brak zadań</span>
    </div>
  </div>
</template>

<script setup>
import TodoItem from "@/components/TodoItem.vue";

import { useTodoListStore } from "@/stores/todolist.store";

import { onMounted } from "vue";
import { storeToRefs } from "pinia";

const store = useTodoListStore();

const { setCategorizedTodos, activeCategory } = store;
const { todosFilters } = storeToRefs(store);

onMounted(() => {
  store.getTodos();
  //setCategorizedTodos(activeCategory);
});
</script>

<style>
.todo-completed {
  text-decoration: line-through;
}

.todo-flag {
  color: red;
}
</style>
