import { defineStore } from "pinia";
import { useAuthStore } from "@/stores/auth.store";
import axios from "axios";

const addUrl = `${import.meta.env.VITE_API_TODO_URL}?action=addTask`;
const readUrl = `${import.meta.env.VITE_API_TODO_URL}?action=getTasks`;
const statusUrl = `${import.meta.env.VITE_API_TODO_URL}?action=changeStatus`;
const flagUrl = `${import.meta.env.VITE_API_TODO_URL}?action=changeFlag`;
const deleteUrl = `${import.meta.env.VITE_API_TODO_URL}?action=deleteTask`;

export const useTodoListStore = defineStore({
  id: "todoList",
  state: () => ({
    todos: {},
    todosFilters: [],
    activeFilter: JSON.parse(localStorage.getItem("activeFilter")),
    categories: [
      {
        name: "Ważne",
        path: "",
      },
    ],
    activeCategory: JSON.parse(localStorage.getItem("activeCategory")),
    todosCategorized: [],
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

          if (self.activeCategory === "") {
            self.renderTodos();
          } else {
            self.renderCategoryTodos();
          }
        })
        .catch((error) => console.log(error));
    },

    renderTodos() {
      this.filterTodos(this.activeFilter, this.todos);
    },

    renderCategoryTodos() {
      this.filterTodos(this.activeFilter, this.todosCategorized);
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

    setTodoFlag(id) {
      const self = this;
      const formData = new FormData();

      formData.append("id", id);

      axios
        .post(flagUrl, formData)
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

    setActiveFilter(value) {
      this.activeFilter = value;
    },

    filterTodos(filter, tasks) {
      this.setActiveFilter(filter);
      switch (filter) {
        case "all":
          this.todosFilters = tasks;

          break;
        case "uncompleted":
          this.todosFilters = Object.fromEntries(
            Object.entries(tasks).filter(([, value]) => value.status == 0)
          );

          break;

        case "completed":
          this.todosFilters = Object.fromEntries(
            Object.entries(tasks).filter(([, value]) => value.status == 1)
          );

          break;
      }
    },
    createPath(category) {
      let path = category
        .normalize("NFD")
        .replace(/\p{Diacritic}/gu, "")
        .toLowerCase();

      return path;
    },
    setPath() {
      for (const element of this.categories) {
        element.path = this.createPath(element.name);
      }
    },
    setActiveCategory(category) {
      this.activeCategory = category;
      localStorage.setItem(
        "activeCategory",
        JSON.stringify(this.activeCategory)
      );
    },
    setCategorizedTodos(category) {
      this.setActiveCategory(category);

      if (category === "Ważne") {
        this.todosCategorized = Object.fromEntries(
          Object.entries(JSON.parse(localStorage.getItem("todos"))).filter(
            ([, value]) => value.flag == 1
          )
        );
      } else {
        this.todosCategorized = Object.fromEntries(
          Object.entries(JSON.parse(localStorage.getItem("todos"))).filter(
            ([, value]) => value.category == category
          )
        );
      }
    },
  },
});
