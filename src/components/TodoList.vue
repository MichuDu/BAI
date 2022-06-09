<template>
  <div>
    <ul v-for="todo in todos" :key="todo.id">
      <li>{{ todo.name }}</li>
    </ul>
  </div>
</template>

<script setup>
import { useTodoListStore } from "@/stores/todolist.store";
import { onMounted } from "vue";
import { storeToRefs } from "pinia";

const store = useTodoListStore();
const { todos } = storeToRefs(store);

onMounted(() => {
  store.getTodos();
});
</script>
