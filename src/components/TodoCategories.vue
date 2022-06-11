<template>
  <div style="float: left">
    <div>
      <h3>Kategorie</h3>
    </div>
    <div>
      <router-link :to="'/'" @click="setCategorizedTodos('')"
        >Wszystkie kategorie</router-link
      >
      <div v-if="Object.keys(categories).length !== 0">
        <div v-for="(category, index) in categories" :key="index">
          <router-link
            :to="{ name: 'Category', params: { url: category.path } }"
            @click="setCategorizedTodos(category.name)"
            :class="{
              active: category.name === activeCategory,
            }"
          >
            {{ category.name }}
          </router-link>
        </div>
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

<style>
.active {
  font-weight: bold;
}
</style>
