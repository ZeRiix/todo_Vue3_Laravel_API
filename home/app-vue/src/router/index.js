import { createWebHistory, createRouter } from "vue-router";
import Home from "@/views/Home";
import Add from "@/views/Add";
import Element from "@/views/Element";
import Modify from "@/views/Modify";
import Remove from "@/views/Remove";
import List from "@/views/List";
import Login from "@/views/Login";


const routes = [
  {
    path: "/home",
    name: "Home",
    component: Home,
  },
  {
    path: "/list",
    name: "List",
    component: List,
  },
  {
    path: "/add",
    name: "Add",
    component: Add,
  },
  {
    path: "/element",
    name: "Element",
    component: Element,
  },
  {
    path: "/modify/:name",
    name: "Modify",
    component: Modify,
  },
  {
    path: "/modify",
    name: "Modify",
    component: Modify,
  },
  {
    path: "/remove",
    name: "Remove",
    component: Remove,
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;