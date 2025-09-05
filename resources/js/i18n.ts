import { createI18n } from 'vue-i18n';

// Import locale messages
import de from './locales/de.json';
import en from './locales/en.json';

const i18n = createI18n({
    legacy: false, // You must set legacy to false to use the Composition API
    locale: 'en', // Set default locale
    fallbackLocale: 'en', // Set fallback locale
    messages: {
        en,
        de,
    },
});

export default i18n;
