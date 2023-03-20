import Main from "@/pages/Main.vue";
import {createRouter, createWebHistory} from "vue-router";
import About from "@/pages/About.vue";
import PostsPage from "@/pages/PostsPage.vue";

const routes = [
    {
        path: "/",
        component: Main
    },
    {
        path: "/posts",
        component: PostsPage
    },
    {
        path: "/about",
        component: About
    }
];

const router = createRouter({
    routes,
    history: createWebHistory(process.env.BASE_URL)
})

export default router;