<template>
  <div>
    <div>
      <div>
        <router-link :to="{ name: 'LoginView' }">
          Powrót do logowania
        </router-link>
      </div>
      <form novalidate="true">
        <h3>Rejestracja</h3>
        <div>
          <label>Imię</label>
          <input type="text" v-model="data.name" />
        </div>
        <div>
          <label>Nazwisko</label>
          <input type="text" v-model="data.lastname" />
        </div>
        <div>
          <label>Login</label>
          <input type="text" v-model="data.login" />
        </div>
         <div>
          <label>Adres e-mail</label>
          <input type="email" v-model="data.email" />
        </div>
        <div>
          <label>Hasło</label>
          <input type="password" v-model="data.password" />
        </div>
        <div>
          <label>Potwierdź hasło</label>
          <input type="password" v-model="data.password_confirm" />
        </div>
        <div v-if="errors.length">
          <p>Aby utworzyć konto popraw poniższe błędy:</p>
          <ul>
            <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
          </ul>
        </div>
        <div>
          <button type="submit" @click="registerAction">Utwórz konto</button>
        </div>
      </form>
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
