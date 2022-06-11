<template>
  <div class="todo-filters">
    <div class="todo-filters-field">
      <label class="label" for="todo-filter">Filtruj:</label>
      <select
        class="select"
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

<style lang="scss">
@import "@/scss/utils/_variables.scss";

.todo-filters {
  padding: 16px 0;

  @media (min-width: $media-tablet) {
    padding: 24px 0;
  }
}

.todo-filters-field {
  display: flex;
  align-items: center;

  .label {
    margin-right: 16px;
    margin-bottom: 0;
  }
}
</style>
