<template>
    <div
        v-if="parsed_data?.data"
        class="resume-container overflow-x-hidden bg-stone-100 py-6 font-sans leading-relaxed text-stone-900 dark:bg-stone-800 dark:text-neutral-300"
    >
        <main class="resume-content mx-auto max-w-4xl overflow-hidden bg-stone-50 p-6 shadow-md dark:bg-stone-950" role="document">
            <header class="resume-header mb-3 border-b pb-3">
                <div class="relative flex flex-col items-center gap-4 sm:flex-row sm:justify-start sm:gap-6 md:gap-10">
                    <Avatar>
                        <AvatarImage src="https://github.com/unovue.png" alt="@unovue" />
                        <AvatarFallback>
                            {{ getInitials(parsed_data.data.personalInfo[0].firstName, parsed_data.data.personalInfo[0].lastName) }}
                        </AvatarFallback>
                    </Avatar>
                    <div class="w-full grow text-center sm:text-start">
                        <h1 class="text-2xl font-bold md:text-3xl">
                            {{ parsed_data.data.personalInfo[0].firstName }} {{ parsed_data.data.personalInfo[0].lastName }}
                        </h1>
                        <div class="mt-1 flex w-full flex-col items-center text-center sm:flex-row sm:items-baseline md:text-start">
                            <p>
                                {{ parsed_data.data.location[0].city }}, {{ parsed_data.data.location[0].country }} |
                                <a target="_blank" :href="`mailto:${parsed_data.data.personalInfo[0].email}`">{{
                                    parsed_data.data.personalInfo[0].email
                                }}</a>
                                |
                                <a target="_blank" :href="parsed_data.data.personalInfo[0].website">{{ parsed_data.data.personalInfo[0].website }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </header>

            <section id="work-experience" class="mt-3 mb-4 md:mb-6">
                <h2 class="title-font mb-2 text-xl font-semibold">Work Experience</h2>

                <div v-for="(job, index) in parsed_data.data.workExperience" :key="index" class="mt-3 mb-6">
                    <h3 class="font-bold">
                        <span>{{ job.role }}</span> – {{ job.company }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ formatDate(job.startDate) }} – {{ formatDate(job.endDate) }}</p>
                    <ul class="mt-2 ml-5 list-disc space-y-1 text-sm">
                        <li>{{ job.description }}</li>
                    </ul>
                </div>
            </section>

            <section id="technical-skills" class="mt-3 mb-4 md:mb-6">
                <h2 class="mb-2 text-xl font-semibold">Technical Skills</h2>
                <ul class="mt-2 ml-5 list-disc space-y-1 text-sm">
                    <li v-for="(skill, index) in parsed_data.data.skills" :key="index">
                        {{ skill.skill }}
                    </li>
                </ul>
            </section>

            <section id="education" class="mt-3 mb-4 md:mb-6" v-if="parsed_data.data.education.length">
                <h2 class="mb-2 text-xl font-semibold">Education</h2>
                <div v-for="(edu, index) in parsed_data.data.education" :key="index">
                    <p>
                        <strong
                            ><span>{{ edu.degree }}</span></strong
                        >
                    </p>
                    <p class="mt-2 text-sm">{{ edu.institution }}</p>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Graduated: {{ formatDate(edu.graduationDate) }}</p>
                    <p class="mt-2 text-sm">{{ edu.details }}</p>
                </div>
            </section>

            <section id="academic-achievements" class="mt-3 mb-4 md:mb-6" v-if="parsed_data.data.achievements.length">
                <h2 class="mb-2 text-xl font-semibold">Academic Achievements</h2>
                <ul class="ml-5 list-disc space-y-1 text-sm">
                    <li v-for="(item, index) in parsed_data.data.achievements" :key="index">
                        {{ item.achievement }}
                    </li>
                </ul>
            </section>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <section id="projects" class="mt-3 mb-4 md:mb-6" v-if="parsed_data.data.projects.length">
                    <h2 class="mb-2 text-xl font-semibold">Projects</h2>
                    <ul class="ml-5 list-disc space-y-1 text-sm">
                        <li v-for="(project, index) in parsed_data.data.projects" :key="index">
                            {{ project.project }}
                        </li>
                    </ul>
                    <p class="mt-2 text-sm">
                        <span>For a detailed overview, please visit my portfolio:</span>
                        <a
                            target="_blank"
                            :href="parsed_data.data.personalInfo[0].website"
                            class="text-blue-500 underline hover:text-blue-600 dark:text-blue-300 dark:hover:text-blue-400"
                            aria-label="View all projects (opens in a new tab)"
                        >
                            {{ parsed_data.data.personalInfo[0].website }}
                        </a>
                    </p>
                </section>

                <section id="languages" class="mt-3 mb-4 md:mb-6">
                    <h2 class="title-font mb-2 text-xl font-semibold">Languages</h2>
                    <ul class="mt-1 ml-1 space-y-1 text-sm">
                        <li><span>English: Professional Proficiency</span></li>
                        <li><span>German: Elementary Proficiency</span></li>
                    </ul>
                </section>

                <section id="social-links" class="mt-3 mb-4 md:mb-6" v-if="parsed_data.data.socialLinks.length">
                    <h2 class="text-xl font-semibold">Social Links</h2>
                    <ul class="mt-1 ml-5 list-disc space-y-1 text-sm">
                        <li v-if="parsed_data.data.socialLinks[0].github">GitHub: {{ parsed_data.data.socialLinks[0].github }}</li>
                        <li v-if="parsed_data.data.socialLinks[0].linkedin">LinkedIn: {{ parsed_data.data.socialLinks[0].linkedin }}</li>
                        <li v-if="parsed_data.data.socialLinks[0].twitter">Twitter: {{ parsed_data.data.socialLinks[0].twitter }}</li>
                        <li v-if="parsed_data.data.socialLinks[0].instagram">Instagram: {{ parsed_data.data.socialLinks[0].instagram }}</li>
                        <li v-if="parsed_data.data.socialLinks[0].other">Other: {{ parsed_data.data.socialLinks[0].other }}</li>
                    </ul>
                </section>

                <section id="hobbies" class="mt-3 mb-4 md:mb-6" v-if="parsed_data.data.hobbies.length">
                    <h2 class="text-xl font-semibold">Hobbies</h2>
                    <ul class="mt-1 ml-5 list-disc space-y-1 text-sm">
                        <li v-for="(hobby, index) in parsed_data.data.hobbies" :key="index">
                            {{ hobby.hobby }}
                        </li>
                    </ul>
                </section>
            </div>
        </main>

        <footer class="resume-footer text-center text-xs text-gray-600 dark:text-gray-400">
            <div class="print-signature">
                <a :href="parsed_data.data.personalInfo[0].website" target="_blank" rel="noopener noreferrer">{{
                    parsed_data.data.personalInfo[0].website
                }}</a>
            </div>
        </footer>

        <div class="no-print fixed top-4 right-4 z-50 flex flex-col space-y-3">
            <Button @click="toggleAppearance" variant="outline" size="icon" :aria-label="`Toggle theme, current is ${appearance}`">
                <component :is="currentIcon" class="h-5 w-5" />
            </Button>

            <Button @click="printWindow" variant="outline" size="icon" aria-label="Print Page">
                <Printer class="h-5 w-5" />
            </Button>

            <Button @click="downloadPdfHandler" variant="outline" size="icon" aria-label="Download Page as PDF">
                <Download class="h-5 w-5" />
            </Button>
        </div>
    </div>
    <div v-else class="p-10 text-center">Loading data...</div>
</template>

<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import { useAppearance } from '@/composables/useAppearance';
import { Download, Monitor, Moon, Printer, Sun } from 'lucide-vue-next';
import { computed } from 'vue';

const props = defineProps({
    parsed_data: Object,
});

const { appearance, updateAppearance } = useAppearance();

const tabs = [
    { value: 'light', Icon: Sun, label: 'Light' },
    { value: 'dark', Icon: Moon, label: 'Dark' },
    { value: 'system', Icon: Monitor, label: 'System' },
] as const;

const currentIcon = computed(() => {
    const current = tabs.find((tab) => tab.value === appearance.value);
    return current ? current.Icon : Monitor;
});

const toggleAppearance = () => {
    const currentIndex = tabs.findIndex((tab) => tab.value === appearance.value);
    const nextIndex = (currentIndex + 1) % tabs.length;
    updateAppearance(tabs[nextIndex].value);
};
const formatDate = (dateString: string | null): string => {
    if (!dateString) return 'Present';
    const options: Intl.DateTimeFormatOptions = { year: 'numeric', month: 'long' };
    return new Date(dateString).toLocaleDateString(undefined, options);
};

const getInitials = (firstName: string, lastName: string): string => {
    return `${firstName?.charAt(0) || ''}${lastName?.charAt(0) || ''}`.toUpperCase();
};

const printWindow = () => {
    window.print();
};

const downloadPdfHandler = () => {
    alert('PDF download functionality not yet implemented.');
};
</script>

<style>
@media print {
    .no-print {
        display: none !important;
    }

    body {
        background-color: #fff;
    }

    .resume-content {
        box-shadow: none;
        margin: 0;
        max-width: 100%;
        border: none;
    }
}
</style>
