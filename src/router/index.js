import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/",
    name: "TodoView",
    component: () => import("../views/TodoView.vue"),
  },
  {
    path: "/login",
    name: "LoginView",
    component: () => import("../views/LoginView.vue"),
  },
  {
    path: "/register",
    name: "RegisterView",
    component: () => import("../views/RegisterView.vue"),
  },
  {
    path: "/registerSuccess",
    name: "RegisterSuccess",
    component: () => import("../views/RegisterSuccess.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export default router;
