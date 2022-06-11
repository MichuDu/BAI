<template>
  <div>
    <div>
      <TodoAdd />
      <TodoCategories />
      <div style="float: left; margin-left: 100px">
        <div>
          <h2>{{ activeCategory }}</h2>
        </div>
        <TodoFilters />
        <TodoList />
      </div>
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
