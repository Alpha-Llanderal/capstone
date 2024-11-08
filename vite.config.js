import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',   // or any other JS file
                'resources/sass/app.scss' // SCSS file
            ],
            refresh: true,
        }),
    ],
});
