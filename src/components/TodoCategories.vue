<template>
  <div class="todo-categories">
    <div class="todo-title">
      <h3>Kategorie</h3>
    </div>
    <div class="todo-categories-items">
      <router-link
        class="todo-categories-item link"
        :to="'/'"
        @click="setCategorizedTodos('')"
        >Wszystkie kategorie</router-link
      >
      <div v-if="Object.keys(categories).length !== 0">
        <router-link
          :to="{ name: 'Category', params: { url: category.path } }"
          @click="setCategorizedTodos(category.name)"
          class="todo-categories-item link"
          :class="{
            active: category.name === activeCategory,
          }"
          v-for="(category, index) in categories"
          :key="index"
        >
          {{ category.name }}
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useTodoListStore } from "../stores/todolist.store";
import { storeToRefs } from "pinia";

const store = useTodoListStore();
const { setPath, setCategorizedTodos, activeCategory } = store;

setPath();

const { categories } = storeToRefs(store);
</script>

<style lang="scss">
@import "@/scss/utils/_variables.scss";

.todo-categories {
  margin: 0 -16px;
  padding: 24px 16px;
  background-color: $color-beige;
  border-bottom: 1px solid $color-black;

  @media (min-width: $media-tablet) {
    width: 300px;
    margin-right: 0;
    padding-top: 40px;
    padding-bottom: 40px;
    border-right: 1px solid $color-black;
    border-bottom: none;
  }
}

.todo-title {
  margin-bottom: 16px;
}

.todo-categories-items {
  margin: 4px 0;
}

.todo-categories-item {
  margin: 4px 0;
}

.active {
  font-weight: bold;
}
</style>
