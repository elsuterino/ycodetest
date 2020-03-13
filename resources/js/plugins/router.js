import Vue from "vue";
import VueRouter from "vue-router";

import WebsitesIndex from '../components/WebsitesIndex';
import WebsitesCreate from '../components/WebsitesCreate';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            redirect: "/websites"
        },
        {
            path: "/websites",
            name: "websites.index",
            component: WebsitesIndex,
        },
        {
            path: "/websites/create",
            name: "websites.create",
            component: WebsitesCreate,
        }
    ]
});


export default router;
