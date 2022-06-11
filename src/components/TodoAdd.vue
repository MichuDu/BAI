<template>
  <div>
    <h3>Dodaj nowe zadanie</h3>
    <form @submit.prevent="addTodo">
      <div>
        <label for="todoName">Co Ci chodzi po głowie?</label>
        <input type="text" name="todoName" id="todoName" v-model="data.name" />
      </div>
      <div>
        <input
          type="checkbox"
          name="todoFlag"
          id="todoFlag"
          v-model="data.flag"
        />
        <label for="todoFlag">Ważne</label>
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
      message.value = "To pole jest wymagane.";
    }
  }

  store.addTodo(formData);

  e.target.reset();
}

onMounted(() => {
  addUserIdToData();
});
</script>
