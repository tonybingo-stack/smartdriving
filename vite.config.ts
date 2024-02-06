import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { watch } from "vite-plugin-watch";
import inertiaLayout from "momentum-layout";
import AutoImport from 'unplugin-auto-import/vite';
import Components from 'unplugin-vue-components/vite';
import vuetify, {transformAssetUrls} from 'vite-plugin-vuetify';
import vueJsx from '@vitejs/plugin-vue-jsx'

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/ts/app.ts',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls
            },
        }),
        vueJsx(),
        watch({
            pattern: "routes/*.php",
            command: "php artisan trail:generate",
          }),
        vuetify({ 
          autoImport: true,       
        }),
        inertiaLayout(),
        Components({
            dirs: ['resources/ts/components'],
            dts: true,
            include: [/\.vue$/, /\.vue\?vue/, /\.md$/],
            resolvers: [
                (name: string) => {
                const components = ["Link", "Head"]
                if (components.includes(name)) {
                return { name, from: "@inertiajs/vue3" }
                }
                },
              ],
          }),
          AutoImport({
            imports: ['vue', 'vue-router', '@vueuse/core', '@vueuse/math', 'pinia', {dayjs: [['default', 'dayjs']]}, {'@inertiajs/vue3' : ['router', 'useForm', 'usePage']},  { "momentum-lock": ["can"] }, { "momentum-trail": ["route", "current"] }],
            vueTemplate: true,
          }),
          
    ],
    resolve: {
        alias: {
          '@': './resources/ts/',
          '@images': './resources/images/',
          '@types': './resources/types/'
        },
      },
    optimizeDeps: {
        exclude: ['vuetify'],
        entries: [
          './resources/ts/**/*.vue',
        ],
      },
    
});
