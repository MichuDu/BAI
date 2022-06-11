<template>
  <div>
    <TodoAdd />
    <TodoCategories />
    <div style="float: left; margin-left: 100px">
      <TodoFilters />
      <TodoList />
    </div>
  </div>
</template>

<script>
import TodoAdd from "@/components/TodoAdd.vue";
import TodoList from "@/components/TodoList.vue";
import TodoFilters from "@/components/TodoFilters.vue";
import TodoCategories from "@/components/TodoCategories.vue";

export default {
  components: { TodoAdd, TodoList, TodoFilters, TodoCategories },
};
</script>
