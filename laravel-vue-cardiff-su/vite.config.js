// Import the defineConfig function from Vite
import { defineConfig } from 'vite';

// Import the laravel plugin for Vite
import laravel from 'laravel-vite-plugin';

// Import the Vue plugin for Vite
import vue from '@vitejs/plugin-vue';

// Export the Vite configuration object
export default defineConfig({
    // Define the plugins to be used by Vite
    plugins: [
        // Use the laravel plugin for Vite
        laravel({
            // Specify the input files for the Laravel integration
            input: ['resources/css/app.css', 'resources/js/app.js'],
            // Enable hot module replacement (HMR) for better development experience
            refresh: true,
        }),
        // Use the Vue plugin for Vite
        vue(),
    ],
    // Configure resolve options
    resolve: {
        // Define aliases for module resolution
        alias: {
            // Alias 'vue' to 'vue/dist/vue.esm-bundler.js' for Vite
            vue: 'vue/dist/vue.esm-bundler.js',
        }
    }
});
