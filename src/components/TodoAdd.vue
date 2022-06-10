<template>
  <div>
    <h3>Dodaj nowe zadanie</h3>
    <form @submit.prevent="addTodo">
      <div>
        <label for="todoName">Co Ci chodzi po głowie?</label>
        <input type="text" name="todoName" id="todoName" v-model="data.name" />
      </div>
      <button>Dodaj zadanie</button>
      <div v-if="message">
        <p>{{ message }}</p>
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
};

let message = ref("");

function addUserIdToData() {
  const store = useAuthStore();

  data["user_id"] = store.getUserId();
}

function addTodo() {
  const store = useTodoListStore();
  let formData = new FormData();

  message.value = "";

  for (let key in data) {
    formData.append(key, data[key]);

    if (!data[key]) {
      message.value = "To pole jest wymagane.";
    }
  }

  store.addTodo(formData);
}

onMounted(() => {
  addUserIdToData();
});
</script>
