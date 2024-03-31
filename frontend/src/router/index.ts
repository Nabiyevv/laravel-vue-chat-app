import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import Chat from "../views/ChatView.vue";
import { useAuthStore } from "@/stores/auth.store";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/",
            name: "home",
            component: HomeView,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: "/conversation/:id",
            name: "Conversatio",
            component: Chat,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: "/login",
            name: "Login",
            component: () => import("../views/Auth/LoginPage.vue"),
            meta: {
                requiresAuth: false,
            },
        },
        {
            path: "/register",
            name: "Register",
            component: () => import("../views/Auth/RegisterPage.vue"),
            meta: {
                requiresAuth: false,
            },
        },
    ],
});

router.beforeEach(async (to, from, next) => {
    const authSore = useAuthStore();
    const reqAuth = to.matched.some((record) => record.meta.requiresAuth);
    const loginQuery = { path: "/login" };
    console.log(authSore.isAuth);
    if (authSore.isAuth && (to.path == "/login" || to.path == "/register"))
        next({ path: "/" });

    if (reqAuth && !authSore.isAuth) 
        next(loginQuery);
    else next();

});

export default router;
