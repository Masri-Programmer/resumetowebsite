<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { index } from '@/routes/dashboard';
import { resume as dashboardResume } from '@/routes/dashboard';
import { type BreadcrumbItem, type PageProps } from '@/types/index';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import ImportResume from './ImportResume.vue';
import ResumeForm from './ResumeForm.vue';

// todo: Check Dark & Light
// todo: Check Trans
// todo: Cookies Policy
// todo: Rjesume host
// todo: resume host
// todo: fonts and colors
// todo: work experience with html editor
// todo: Chat Session (Multi-Turn Conversations)
const page = usePage<PageProps>();

const breadcrumbs = computed<BreadcrumbItem[]>(() => {
    const base = [{
        title: 'Dashboard',
        href: index().url,
    }];

    // If the current URL matches the resume page URL, add the second breadcrumb
    if (page.url === dashboardResume().url) {
        base.push({
            title: 'Resume Form',
            href: dashboardResume().url, // Correctly points to the resume page
        });
    }

    return base;
});


const successMessage = computed(() => page.props.flash?.success);
const parsedData = computed(() => page.props.flash?.parsed_data);
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="relative w-full max-w-5xl">
                <Transition name="slide-fade" mode="out-in">
                    <div class="grid w-full grid-cols-1 gap-8 md:grid-cols-2" v-if="page.url === index().url" key="import-view">
                        <ImportResume />
                    </div>

                    <!-- v-else-if="parsedData && successMessage && page.url === dashboardResume().url" -->
                    <ResumeForm
                        v-else-if="page.url === dashboardResume().url"
                        key="form-view"
                        />
                        <!-- :successMessage="successMessage" -->
                        <!-- :parsedData="parsedData" -->
                </Transition>
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

.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.4s ease-in-out;
}

.slide-fade-enter-from {
    transform: translateX(30px);
    opacity: 0;
}

.slide-fade-leave-to {
    transform: translateX(-30px);
    opacity: 0;
}
</style>

