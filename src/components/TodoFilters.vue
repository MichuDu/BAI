<template>
  <div>
    <label for="todo-filter">Filtruj:</label>
    <select
      name="todo-filter"
      id="todo-filter"
      v-model="activeFilter"
      @change="
        activeCategory
          ? filterTodos(activeFilter, todosCategorized)
          : filterTodos(activeFilter, todos)
      "
    >
      <option value="all">Pokaż wszystko</option>
      <option value="uncompleted">Pokaż do zrobienia</option>
      <option value="completed">Pokaż ukończone</option>
    </select>
  </div>
</template>

<script setup>
import { useTodoListStore } from "@/stores/todolist.store";

import { storeToRefs } from "pinia";
import { onMounted } from "vue";

const store = useTodoListStore();

const { filterTodos } = store;
const { todos, todosCategorized, activeCategory } = storeToRefs(store);

const activeFilter = "all";

onMounted(() => store.setActiveFilter(activeFilter));
</script>
