import { createRouter, createWebHistory } from 'vue-router';


import NotFound from './components/404.vue';
import TaskList from './components/TaskList.vue';
import TaskForm from './components/Form.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: TaskList },
        { path: '/tasks', component: TaskList },
        { path: '/form', component: TaskForm },
        // Move the catch-all route to the end
        { path: '/:notFound(.*)', component: NotFound },
    ],
});

export default router;
