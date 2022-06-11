<template>
  <span
    :class="{
      'todo-completed': todo.status == 1,
      'todo-flag': todo.flag == 1,
    }"
  >
    {{ todo.name }}
  </span>
  <button @click="setTodoStatus(todo.id)">Wykonane</button>
  <button @click="deleteTodo(todo.id)">Usuń</button>
</template>

<script setup>
import { useTodoListStore } from "@/stores/todolist.store";
import { computed } from "@vue/reactivity";

const store = useTodoListStore();
const { setTodoStatus, deleteTodo } = store;

const props = defineProps({
  todo: Object,
});

const todo = computed({
  get() {
    return props.todo;
  },
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
