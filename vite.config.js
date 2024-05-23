import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/member-form.js',
                'resources/js/finances-form.js',
            ],
            refresh: true,
        }),
    ],
});
