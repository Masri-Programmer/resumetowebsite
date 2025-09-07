<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { create  } from'@/routes/resumes';
import { Plus } from "lucide-vue-next"
import { useI18n } from 'vue-i18n';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';

const { t } = useI18n();
</script>

<template>
    <Link :href="create.url()">
        <div class="card-glow group relative flex aspect-[4/5] w-full cursor-pointer flex-col justify-center overflow-hidden rounded-2xl border border-gray-900">
            <PlaceholderPattern />
            <div class="flex flex-1 items-center justify-center">
                <Plus
                    class="!h-20 !w-20 text-gray-700 transition-colors duration-300 group-hover:text-gray-500"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1"
                    stroke="currentColor"
                />
            </div>
            <div class="p-8 text-left">
                <h2 class="text-lg font-semibold text-gray-700">{{ t('resume.createTitle') }}</h2>
                <p class="mt-1 text-sm text-gray-500 text-wrap">{{ t('resume.createDescription') }}</p>
            </div>
        </div>
    </Link>
</template>