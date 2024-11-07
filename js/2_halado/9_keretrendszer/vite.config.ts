import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// https://vite.dev/config/
export default defineConfig({
  base: '/js/2_halado/9_keretrendszer/dist/',
  plugins: [react()],
})
