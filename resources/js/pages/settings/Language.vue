<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import LanguageSelector from '@/components/LanguageSelector.vue';
import type { BreadcrumbItem } from '@/types';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Language settings',
        href: '/settings/language',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Language settings" />

        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall
                    title="Language settings"
                    description="Manage your language preferences for the application"
                />
                <LanguageSelector />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>