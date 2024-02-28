// Import the bootstrap file which contains the setup for Laravel and other dependencies
import './bootstrap';

// Import the createApp function from Vue
import { createApp } from 'vue';

// Import the Example component from './components/Example.vue' file
import Example from './components/Example.vue';

// Create a new Vue application instance
const app = createApp();

// Register the Example component globally
app.component('example', Example);

// Mount the Vue application to the element with the id 'app' in the HTML file
app.mount('#app');
