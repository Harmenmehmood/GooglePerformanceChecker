import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(), // Vue plugin remains here
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            // Add this alias to point to the full Vue build that includes the compiler
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
