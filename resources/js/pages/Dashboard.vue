<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { Download } from 'lucide-vue-next';
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
                
                <!-- Card 1: Create a new resume -->
                <!-- <a href="#" class="card-glow group relative flex aspect-[4/5] flex-col justify-center overflow-hidden rounded-2xl border border-gray-900">
                <PlaceholderPattern />
                <div class="flex flex-1 items-center justify-center">
                    <svg class="h-20 w-20 text-gray-700 transition-colors duration-300 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <div class="p-8 text-left">
                    <h2 class="text-lg font-semibold text-gray-200">Create a new resume</h2>
                    <p class="mt-1 text-sm text-gray-500">Start building from scratch</p>
                </div>
            </a> -->

            <!-- Card 2: Import an existing resume -->
            <a href="#" class="card-glow group relative flex aspect-[4/5] flex-col justify-center overflow-hidden rounded-2xl border border-gray-900">
                <PlaceholderPattern />

                <div class="flex flex-1 items-center justify-center">
                     <Download class="h-20 w-20 text-gray-700 transition-colors duration-300 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                 />
                </div>
                <div class="p-8 text-left">
                    <h2 class="text-lg font-semibold text-gray-200">Import an existing resume</h2>
                    <p class="mt-1 text-sm text-gray-500">PDF, LinkedIn, JSON Resume, etc.</p>
                </div>
            </a>

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