<template>
    <div v-if="parsed_data?.data" class="resume-container overflow-x-hidden bg-background py-6 font-sans leading-relaxed text-foreground">
        <Resume :parsed_data="parsed_data"/>
        <footer class="resume-footer text-center text-xs text-gray-600 dark:text-gray-400">
            <div class="print-signature">
                <a :href="parsed_data.data.personalInfo[0].website" target="_blank" rel="noopener noreferrer">{{
                    parsed_data.data.personalInfo[0].website
                }}</a>
            </div>
        </footer>
        <Rightbar />
        <LeftSideBar />
        <BottomBar />
    </div>
    <div v-else class="p-10 text-center">Loading data...</div>
</template>

<script setup lang="ts">
import BottomBar from '@/components/bars/BottomBar.vue';
import LeftSideBar from '@/components/bars/LeftSideBar.vue';
import Rightbar from '@/components/bars/Rightbar.vue';
import Resume from './Resume.vue';
defineProps({
    parsed_data: Object,
});
</script>

<style>
@media print {
    .no-print {
        display: none !important;
    }
    .resume-container {
        background-color: transparent;
    }
    .resume-content {
        box-shadow: none;
        max-width: 100%;
        border: none;
    }
}
</style>
