import { createRouter, createWebHistory } from 'vue-router';

import LaunchScreen from './components/LaunchScreen.vue';
import Home from './components/Home.vue';
import NotFound from './components/404.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: Home },
        { path: '/home', component: Home },
        { path: '/launchscreen', component: LaunchScreen },
        // Move the catch-all route to the end
        { path: '/:notFound(.*)', component: NotFound },
    ],
});

export default router;
