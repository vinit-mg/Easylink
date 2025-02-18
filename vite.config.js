import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/admin/app.scss',
                'resources/js/admin/app.js',
                'resources/js/form-builder/field.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build',  // Ensure output is inside 'public/build'
        assetsDir: 'static',     // Ensure correct assets directory
        manifest: true,          // Generate manifest.json for Laravel
        rollupOptions: {
            output: {
                entryFileNames: 'static/[name].js',
                chunkFileNames: 'static/[name].js',
                assetFileNames: 'static/[name].[ext]',
            }
        }
    }
});
