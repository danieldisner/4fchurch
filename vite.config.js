import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        cors: true, // Adiciona suporte a CORS
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/member-form.js',
                'resources/js/finances-form.js',
                'resources/js/export-report.js',
                'resources/css/finances-form.css'
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build',
        manifest: true,
        rollupOptions: {
            input: {
                app: 'resources/js/app.js',
                'member-form': 'resources/js/member-form.js',
                'finances-form': 'resources/js/finances-form.js',
                'export-report': 'resources/js/export-report.js',
                'app-css': 'resources/css/app.css',
                'finances-form-css': 'resources/css/finances-form.css'
            }
        }
    },
});
