<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem } from '@/types/index';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import CreateCard from './resumes/CeateCard.vue';
import Import from './resumes/Import.vue';

// todo: Google & Linked & github sign in/up
// todo: Check Dark & Light
// todo: Check Trans
// todo: Cookies Policy
// todo: Rjesume host
// todo: tiptap editor
// todo: resume host
// todo: User Suggestions for fields (hobbies , language, stars or drag line....)
// todo: fonts and colors
// todo: work experience with html editor
// todo: docs
// todo: Chat Session (Multi-Turn Conversations)

const breadcrumbs = computed<BreadcrumbItem[]>(() => {
    const base = [
        {
            title: 'Dashboard',
            href: dashboard().url,
        },
    ];

    return base;
});
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- <Transition name="slide-fade" mode="out-in"> -->
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="relative w-full max-w-5xl">
                <div class="grid w-full grid-cols-1 gap-8 md:grid-cols-2">
                    <Import />
                    <CreateCard />
                </div>
            </div>
        </div>
        <!-- </Transition> -->
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
