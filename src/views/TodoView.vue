<template>
  <div>
    <div>
      <h2>Twoje zadania</h2>
    </div>
    <TodoFilters />
    <TodoAdd />
    <TodoList />
  </div>
</template>

<script>
import TodoAdd from "@/components/TodoAdd.vue";
import TodoList from "@/components/TodoList.vue";
import TodoFilters from "@/components/TodoFilters.vue";

export default {
  components: { TodoAdd, TodoList, TodoFilters },
};
</script>
