<template>
  <div>
    <label for="todo-filter">Filtruj:</label>
    <select
      name="todo-filter"
      id="todo-filter"
      v-model="activeFilter"
      @change="filterTodos(activeFilter)"
    >
      <option value="all">Pokaż wszystko</option>
      <option value="uncompleted">Pokaż do zrobienia</option>
      <option value="completed">Pokaż ukończone</option>
    </select>
  </div>
</template>

<script setup>
import { useTodoListStore } from "@/stores/todolist.store";
import { onMounted } from "vue";

const store = useTodoListStore();
const { filterTodos } = store;

const activeFilter = "all";

onMounted(() => store.setActiveFilter(activeFilter));
</script>
