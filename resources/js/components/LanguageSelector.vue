<script setup lang="ts">
import { useI18n } from 'vue-i18n';
import { router } from '@inertiajs/vue3';
import { Check } from 'lucide-vue-next';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';

// Get the current locale from vue-i18n
const { locale } = useI18n();

// Define available languages
const availableLanguages = [
    { code: 'en', name: 'English' },
    { code: 'de', name: 'Deutsch' },
];

// Function to set the locale and persist it in the backend session
const setLocale = (langCode: string) => {
    // This route should exist from our previous setup to make the change persistent
    router.get(`/language/${langCode}`, {}, {
        preserveState: true, // Prevents a full page reload
    });
};
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle>Display Language</CardTitle>
            <CardDescription>
                Choose the language you want to see in the interface.
            </CardDescription>
        </CardHeader>
        <CardContent>
            <div class="space-y-2">
                <Button
                    v-for="lang in availableLanguages"
                    :key="lang.code"
                    :variant="locale === lang.code ? 'secondary' : 'ghost'"
                    class="w-full justify-between"
                    @click="setLocale(lang.code)"
                >
                    <span>{{ lang.name }}</span>
                    <Check v-if="locale === lang.code" class="h-4 w-4" />
                </Button>
            </div>
        </CardContent>
    </Card>
</template>