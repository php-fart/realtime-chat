import {fileURLToPath, URL} from 'node:url';
import {resolve} from 'path';
import {defineConfig} from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue()
    ],
    build: {
        lib: {
            entry: resolve(__dirname, 'src/main.js'),
            name: 'Chat',
            formats: ['cjs']
        },
        outDir: '../public'
    },
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./src', import.meta.url))
        }
    },
    define: {
        'process.env': {}
    }
})
