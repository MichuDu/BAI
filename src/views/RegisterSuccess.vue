<template>
  <div>
    <div>
      <h3>Pomyślnie utworzono konto!</h3>
      <p>
        Za <span>{{ miliseconds / 1000 }}</span> sekund zostaniesz przekierowany
        do strony logowania.
      </p>
      <router-link :to="{ name: 'LoginView' }">
        Kliknij tutaj, aby przenieść się teraz.
      </router-link>
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
