import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    })
  ],
  resolve: {
    alias: {
      '@ckeditor': path.resolve(__dirname, 'node_modules/@ckeditor')
    }
  },
  optimizeDeps: {
    exclude: ['@ckeditor/ckeditor5-build-classic']
  },
});
