<template>
  <div>
    <div>
      <h2>Twoje zadania</h2>
    </div>
    <TodoAdd />
    <TodoList />
  </div>
</template>

<script>
import TodoAdd from "@/components/TodoAdd.vue";
import TodoList from "@/components/TodoList.vue";

export default {
  components: { TodoAdd, TodoList },
};
</script>
