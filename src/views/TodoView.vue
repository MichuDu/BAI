<template>
  <div class="todo-list">
    <TodoCategories />
    <div class="todo-list-content">
      <TodoAdd />
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

<style lang="scss">
@import "@/scss/utils/_variables.scss";

.todo-list {
  display: flex;
  flex-direction: column;
  padding: 0 16px;

  @media (min-width: $media-tablet) {
    flex-direction: row;
    min-height: 90vh;
  }
}

.todo-list-content {
  @media (min-width: $media-tablet) {
    flex: 1;
    padding: 0 72px;
  }
}
</style>
