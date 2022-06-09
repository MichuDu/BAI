import { defineStore } from "pinia";
import { useAuthStore } from "@/stores/auth.store";
import axios from "axios";

const addUrl = `${import.meta.env.VITE_API_TODO_URL}?action=addTask`;
const readUrl = `${import.meta.env.VITE_API_TODO_URL}?action=getTasks`;
const statusUrl = `${import.meta.env.VITE_API_TODO_URL}?action=changeStatus`;
const deleteUrl = `${import.meta.env.VITE_API_TODO_URL}?action=deleteTask`;

export const useTodoListStore = defineStore({
  id: "todoList",
  state: () => ({
    todos: {},
  }),
  actions: {
    addTodo(todo) {
      const self = this;

      axios
        .post(addUrl, todo)
        .then(function (response) {
          const todo = response.data.task;

          if (todo) {
            self.getTodos();
          }
        })
        .catch((error) => console.log(error));
    },

    getTodos() {
      const self = this;
      const auth = useAuthStore();
      const formData = new FormData();

      formData.append("user_id", auth.getUserId());
      self.todos = {};

      axios
        .post(readUrl, formData)
        .then(function (response) {
          self.todos = Object.assign(self.todos, response.data.tasks);
          localStorage.setItem("todos", JSON.stringify(self.todos));
        })
        .catch((error) => console.log(error));
    },

    setTodoStatus(id) {
      const self = this;
      const formData = new FormData();

      formData.append("id", id);

      axios
        .post(statusUrl, formData)
        .then(function () {
          self.getTodos();
        })
        .catch((error) => console.log(error));
    },

    deleteTodo(id) {
      const self = this;
      const formData = new FormData();

      formData.append("id", id);

      axios
        .post(deleteUrl, formData)
        .then(function () {
          self.getTodos();
        })
        .catch((error) => console.log(error));
    },

    removeTodos() {
      localStorage.removeItem("todos");
    },
  },
});
