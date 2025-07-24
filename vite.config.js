import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import viteCompression from 'vite-plugin-compression'; // Türkçe: Gzip/Brotli desteği için eklendi

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        viteCompression({ algorithm: 'gzip' }), // Türkçe: Gzip sıkıştırma aktif
        viteCompression({ algorithm: 'brotliCompress' }), // Türkçe: Brotli sıkıştırma aktif
    ],
});
// Türkçe: Vite ile build edilen assetler otomatik olarak gzip ve brotli ile sıkıştırılır.
