<template>
  <div class="todo-tasks">
    <div class="todo-title todo-title-tasks">
      <h3>Twoje zadania</h3>
    </div>
    <ul class="todo-tasks-items" v-if="Object.keys(todosFilters).length !== 0">
      <TodoItem />
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

<style lang="scss">
.todo-tasks {
  padding-top: 16px;
  padding-bottom: 40px;
}

.todo-title {
  &.todo-title-tasks {
    margin-bottom: 32px;
  }
}

.todo-tasks-items {
  display: flex;
  flex-direction: column-reverse;
  margin: -16px 0;
}
</style>
