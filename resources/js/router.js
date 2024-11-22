import { createRouter, createWebHistory } from "vue-router";
import Login from "./components/Login.vue";
import Dashboard from "./components/Dashboard.vue";
import LighthouseCheck from "./components/LighthouseCheck.vue"; // Import LighthouseCheck component
import GoogleLogin from "./components/GoogleLogin.vue"; // Import GoogleLogin component

const routes = [
    { path: "/", component: Login, name: "Login" },
    { path: "/dashboard", component: Dashboard, name: "Dashboard" },
    {
        path: "/lighthouse-check",
        component: LighthouseCheck,
        name: "LighthouseCheck",
    },
    {
        path: "/login/google/callback",
        component: GoogleLogin,
        name: "GoogleLoginCallback",
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;
