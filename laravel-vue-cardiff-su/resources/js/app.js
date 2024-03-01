// Import the createApp function from Vue
import { createApp } from 'vue';

// Import the bootstrap file which contains the setup for Laravel and other dependencies
import './bootstrap';

// Import App
import App from '../views/App.vue';

// Import router
import router from './router.js';

// Create a new Vue application instance
const app = createApp(App);

// Use Vue Router
app.use(router);

// Wait for the router to be ready before mounting the application
router.isReady().then(() => {
    // Mount the Vue application to the element with the id 'app' in the HTML file
    app.mount('#app');
});
