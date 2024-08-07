import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig(({ command }) => ({
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
    // Configuração adicional para o caminho do manifest
    build: {
        manifest: {
            publicPath: '/build/',
        },
        outDir: 'public/build',
        rollupOptions: {
            input: {
                'app': 'resources/js/app.js',
                'member-form': 'resources/js/member-form.js',
                'finances-form': 'resources/js/finances-form.js',
                'export-report': 'resources/js/export-report.js',
                'app-css': 'resources/css/app.css',
                'finances-form-css': 'resources/css/finances-form.css',
            }
        },

    },
    server: command === 'serve' ? {
        cors: {
            origin: '*',
        },
        host: '0.0.0.0',
        hmr: {
            host: 'localhost',
        }
    } : {},

}));
