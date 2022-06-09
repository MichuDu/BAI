import { defineStore } from "pinia";
import router from "@/router";
import axios from "axios";

export const useAuthStore = defineStore({
  id: "auth",
  state: () => ({
    user: JSON.parse(localStorage.getItem("user")),
  }),
  actions: {
    login(options) {
      const self = this;

      axios(options)
        .then(function (response) {
          if (response.data.login) {
            let user = response.data.user;
            self.user = user;

            localStorage.setItem("user", JSON.stringify(user));
            router.push("/");
          }

          return response;
        })
        .catch((error) => console.log(error));
    },
    logout() {
      this.user = null;
      localStorage.removeItem("user");
      router.push("/login");
    },
    getUserId() {
      if (this.user) {
        return this.user.id;
      }
    }
  },
});
