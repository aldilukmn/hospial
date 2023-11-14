import { createRouter, createWebHistory } from "vue-router"
import List from "../views/patient/List.vue"
import Edit from "../views/patient/Edit.vue"
import Add from "../views/patient/Add.vue"
import Detail from "../views/patient/Detail.vue"
import NotFound from "../views/NotFound.vue"

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "list",
      component: List,
      meta: {
        title: "List Patient",
      },
    },
    {
      path: "/detail/:id",
      name: "detail",
      component: Detail,
      props: true,
      meta: {
        title: "Detail Patient",
      },
    },
    {
      path: "/edit/:id",
      name: "edit",
      component: Edit,
      props: true,
      meta: {
        title: "Edit Patient",
      },
    },
    {
      path: "/add-patient",
      name: "add",
      component: Add,
      meta: {
        title: "Add Patient",
      },
    },
    {
      path: "/:catchAll(.*)",
      name: "not-found",
      component: NotFound,
      meta: {
        title: "Not Found",
      },
    },
  ],
});

router.beforeEach((to, from, next) => {
  document.title = to.meta.title || "Your Default Title";
  next();
});

export default router;

