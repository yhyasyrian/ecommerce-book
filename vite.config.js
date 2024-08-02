import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/scss/sb-admin-2.scss',
                'resources/ts/app.ts',
            ],
            refresh: true,
        }),
    ],
});
