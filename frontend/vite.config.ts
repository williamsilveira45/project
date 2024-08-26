import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
  server: {
    host: '0.0.0.0',
    port: 3000,
    strictPort: true, 
    hmr: {
      host: 'frontend.project.com',
    },
  },
  plugins: [vue()],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'src')
    }
  }
});