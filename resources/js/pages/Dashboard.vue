<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import ImportResume from './ImportResume.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid w-full max-w-5xl grid-cols-1 gap-8 md:grid-cols-2">
            <ImportResume />
        </div>
        </div>
    </AppLayout>
</template>
  <style>
        .card-glow {
            position: relative;
            transition: all 0.3s ease-in-out;
        }
        .card-glow:hover {
            border-color: rgba(107, 114, 128, 0.5);
            box-shadow: 0 0 20px rgba(107, 114, 128, 0.1);
        }
    </style>