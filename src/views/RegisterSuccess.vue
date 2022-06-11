<template>
  <div class="todo-success-wrapper wrapper">
    <div class="todo-success">
      <div class="todo-success-title">
        <h3>Pomyślnie utworzono konto!</h3>
      </div>
      <div class="todo-success-content">
        <p class="todo-success-text">
          Za
          <span class="todo-success-seconds"
            >{{ miliseconds / 1000 }} sekund</span
          >
          zostaniesz przekierowany do strony logowania.
        </p>
        <router-link
          class="todo-success-link link body-3"
          :to="{ name: 'LoginView' }"
        >
          Kliknij tutaj, aby przenieść się teraz.
        </router-link>
      </div>
  </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      miliseconds: 5000,
    };
  },
  methods: {
    redirectToLogin: function () {
      const self = this;

      setTimeout(function () {
        self.$router.push({ name: "LoginView" });
      }, self.miliseconds);
    },
  },
  mounted() {
    this.redirectToLogin();
  },
};
</script>

<style lang="scss">
.todo-success {
  padding: 100px 0;
}

.todo-success-seconds {
  font-weight: 500;
}

.todo-success-text {
  margin-top: 8px;
  margin-bottom: 32px;
}
</style>
