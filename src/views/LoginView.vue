<template>
  <div class="todo-auth-wrapper wrapper">
    <div class="todo-auth">
      <div class="todo-login">
        <form class="form" @submit.prevent="onSubmit">
          <div class="form-title">
            <h3>Logowanie</h3>
          </div>
          <div class="form-note">
            <p>
              Jeśli masz już konto, możesz zalogować się przy pomocy loginu lub
              emaila.
            </p>
          </div>
          <div class="field required">
            <label class="label">Login / email</label>
            <input class="input" type="text" v-model="data.login" />
          </div>
          <div class="field required">
            <label class="label">Hasło</label>
            <input class="input" type="password" v-model="data.password" />
          </div>
          <div v-if="errorsVisible" class="form-errors">
            <ul class="form-errors-list">
              <li
                class="form-errors-item"
                v-for="(error, index) in errors"
                :key="index"
              >
                <span>{{ error }}</span>
              </li>
            </ul>
          </div>
          <div class="form-actions">
            <button class="button" type="submit">Zaloguj się</button>
          </div>
        </form>
      </div>
      <div class="todo-to-register">
        <div class="form">
          <div class="form-title">
            <h3>Rejestracja</h3>
          </div>
          <div class="form-note">
            <p>Utwórz konto, aby uzyskać dostęp do aplikacji.</p>
          </div>
          <div class="form-actions">
            <router-link class="button" :to="{ name: 'RegisterView' }">
              Chcę utworzyć konto
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useAuthStore } from "@/stores/auth.store";
import { useTodoListStore } from "@/stores/todolist.store";
import axios from "axios";
import { onMounted, ref, reactive } from "vue";

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
}

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

onMounted(() => {
  const store = useTodoListStore();
  store.removeTodos();
});
</script>

<style lang="scss">
@import "@/scss/utils/_variables.scss";

.todo-auth {
  padding: 48px 0;

  @media (min-width: $media-desktop) {
    display: flex;
    justify-content: center;
    padding: 100px 0;
  }
}

.todo-login {
  margin-bottom: 48px;

  @media (min-width: $media-desktop) {
    margin-right: 56px;
    margin-bottom: 0;
  }
}
</style>
