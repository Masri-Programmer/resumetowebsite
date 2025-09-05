import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, DefineComponent, h } from 'vue';
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';
// import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { initializeTheme } from './composables/useAppearance';
import i18n from './i18n';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.use(plugin);
        // app.use(ZiggyVue);
        app.use(i18n);
        app.use(Toast, {
            transition: 'Vue-Toastification__bounce',
            maxToasts: 5,
            newestOnTop: true,
        });
        app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

initializeTheme();
