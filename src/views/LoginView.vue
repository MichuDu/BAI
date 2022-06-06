<template>
  <div>
    <div>
      <form @submit.prevent="onSubmit">
        <h3>Logowanie</h3>
        <p>
          Jeśli masz już konto, możesz zalogować się przy pomocy loginu lub
          emaila.
        </p>
        <div>
          <label>Login / email</label>
          <input type="text" v-model="data.login" />
        </div>
        <div>
          <label>Hasło</label>
          <input type="password" v-model="data.password" />
        </div>
        <div v-if="errorsVisible">
          <p>Nieudane logowanie:</p>
          <ul>
            <li v-for="(error, index) in errors" :key="index">
              {{ error }}
            </li>
          </ul>
        </div>
        <div>
          <button type="submit">Zaloguj się</button>
        </div>
      </form>
    </div>
    <div>
      <h3>Rejestracja</h3>
      <p>Utwórz konto, aby uzyskać dostęp do aplikacji.</p>
      <router-link :to="{ name: 'RegisterView' }">
        Chcę utworzyć konto
      </router-link>
    </div>
  </div>
</template>

<script setup>
import { useAuthStore } from "@/stores/auth.store";
import axios from "axios";
import { ref, reactive } from "vue";

const actionUrl = `${import.meta.env.VITE_API_URL}?action=login`;

const data = {
  login: "",
  password: "",
};

const errorsVisible = ref(false);
let errors = reactive([]);

function getFormData(obj) {
  let formData = new FormData();

  for (let key in obj) {
    formData.append(key, obj[key]);
  }
  return formData;
};

function getErrors(messages) {
  errors.splice(0);

  for (let key in messages) {
    errors.push(messages[key]);
  }

  errorsVisible.value = errors.length ? true : false;
}

function onSubmit() {
  const authStore = useAuthStore();
  const options = {
    method: "POST",
    headers: { "content-type": "multipart/form-data" },
    data: getFormData(data),
    url: actionUrl,
  };

  axios(options).then(function (response) {
    getErrors(response.data.message);
  });

  return authStore.login(options);
}
</script>
