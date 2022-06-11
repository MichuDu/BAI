<template>
  <div class="todo-add">
    <div class="todo-add-title todo-title">
      <h3>Dodaj nowe zadanie</h3>
    </div>
    <form @submit.prevent="addTodo">
      <div class="field required">
        <label class="label" for="todoName">Co Ci chodzi po głowie?</label>
        <input
          class="input"
          type="text"
          name="todoName"
          id="todoName"
          v-model="data.name"
        />
      </div>
      <div class="field">
        <input
          class="checkbox"
          type="checkbox"
          name="todoFlag"
          id="todoFlag"
          v-model="data.flag"
        />
        <label class="label" for="todoFlag">Ważne</label>
      </div>
      <div v-if="message" class="form-errors">
        <p class="form-errors-item">{{ message }}</p>
      </div>
      <div class="form-actions">
        <button class="button">Dodaj zadanie</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useAuthStore } from "@/stores/auth.store";
import { useTodoListStore } from "@/stores/todolist.store";
import { onMounted, ref } from "vue";

const data = {
  name: "",
  flag: false,
};

const required = ["name"];

let message = ref("");

function addUserIdToData() {
  const store = useAuthStore();

  data["user_id"] = store.getUserId();
}

function addTodo(e) {
  const store = useTodoListStore();
  let formData = new FormData();

  message.value = "";

  for (let key in data) {
    formData.append(key, data[key]);

    if (required.includes(key) && !data[key]) {
      message.value = "Uzupełnij wymagane pola.";
    }
  }

  store.addTodo(formData);

  data.name = "";
  data.flag = false;
}

onMounted(() => {
  addUserIdToData();
});
</script>

<style lang="scss">
@import "@/scss/utils/_variables.scss";

.todo-add {
  margin: 0 -16px;
  padding: 32px 16px;
  border-bottom: 1px solid $color-black;

  @media (min-width: $media-tablet) {
    margin: 0;
    padding: 40px 0;
  }
}

.todo-title {
  &.todo-add-title {
    @media (min-width: $media-tablet) {
      margin-bottom: 40px;
    }
  }
}
</style>
