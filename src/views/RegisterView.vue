<template>
  <div class="todo-register-wrapper wrapper">
    <div class="todo-register">
      <form class="todo-register-form form">
        <div class="form-title">
          <h3>Rejestracja</h3>
        </div>
        <div class="field required">
          <label class="label">Imię</label>
          <input class="input" type="text" v-model="data.name" />
        </div>
        <div class="field required">
          <label class="label">Nazwisko</label>
          <input class="input" type="text" v-model="data.lastname" />
        </div>
        <div class="field required">
          <label class="label">Login</label>
          <input class="input" type="text" v-model="data.login" />
        </div>
        <div class="field required">
          <label class="label">Adres e-mail</label>
          <input class="input" type="email" v-model="data.email" />
        </div>
        <div class="field required">
          <label class="label">Hasło</label>
          <input class="input" type="password" v-model="data.password" />
        </div>
        <div class="field required">
          <label class="label">Potwierdź hasło</label>
          <input
            class="input"
            type="password"
            v-model="data.password_confirm"
          />
        </div>
        <div v-if="errors.length" class="form-errors">
          <ul class="form-errors-list">
            <li
              v-for="(error, index) in errors"
              :key="index"
              class="form-errors-item"
            >
              {{ error }}
            </li>
          </ul>
        </div>
        <div class="form-actions">
          <button class="button" type="submit" @click="registerAction">
            Utwórz konto
          </button>
        </div>
      </form>
      <div class="todo-back">
        <router-link
          class="todo-back-link link body-3"
          :to="{ name: 'LoginView' }"
        >
          Powrót do logowania
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      errors: [],
      data: {
        name: "",
        lastname: "",
        login: "",
        email: "",
        password: "",
        password_confirm: "",
      },
    };
  },

  methods: {
    getFormData(obj) {
      let formData = new FormData();

      for (let key in obj) {
        formData.append(key, obj[key]);
      }
      return formData;
    },

    getErrors(messages) {
      this.errors = [];

      for (let key in messages) {
        this.errors.push(messages[key]);
      }
    },

    registerAction(e) {
      e.preventDefault();

      const self = this;

      const registerForm = this.getFormData(this.data);
      const options = {
        method: "POST",
        headers: { "content-type": "multipart/form-data" },
        data: registerForm,
        url: "http://localhost/todo/index.php?action=register",
      };

      axios(options)
        .then(function (response) {
          self.getErrors(response.data.message);

          if (!self.errors.length) {
            self.$router.push({ name: "RegisterSuccess" });
          }
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>

<styles lang="scss">
@import "@/scss/utils/_variables.scss";

.todo-register {
  padding: 48px 0;
}

.todo-back {
  margin-top: 48px;
  text-align: center;
}

.todo-back-link {
  font-weight: 500;
}

.todo-register-form {
  max-width: 800px;
  margin-top: 32px;
}
</styles>
