<template>
    <div v-if="parsed_data?.data" class="resume-container bg-background text-foreground py-6 font-sans leading-relaxed overflow-x-hidden">
        <main class="resume-content max-w-4xl mx-auto p-6 lg:p-8 border bg-card shadow-md overflow-hidden" role="document">
            <header class="resume-header border-b border-border pb-4 mb-4">
                <div class="relative flex flex-col items-center gap-4 sm:flex-row sm:justify-start sm:gap-6 md:gap-10">
                    <Avatar class="w-24 h-24">
                        <AvatarImage src="https://github.com/unovue.png" alt="@unovue" />
                        <AvatarFallback>
                            {{ getInitials(parsed_data.data.personalInfo[0].firstName, parsed_data.data.personalInfo[0].lastName) }}
                        </AvatarFallback>
                    </Avatar>
                    <div class="grow w-full text-center sm:text-start">
                        <h1 class="text-3xl font-bold md:text-4xl title-font">
                            {{ parsed_data.data.personalInfo[0].firstName }} {{ parsed_data.data.personalInfo[0].lastName }}
                        </h1>
                        <div class="flex flex-col items-center sm:flex-row sm:items-baseline w-full text-center md:text-start mt-2 text-muted-foreground">
                            <p>
                                {{ parsed_data.data.location[0].city }}, {{ parsed_data.data.location[0].country }} |
                                <a class="hover:underline" target="_blank" :href="`mailto:${parsed_data.data.personalInfo[0].email}`">{{ parsed_data.data.personalInfo[0].email }}</a>
                                |
                                <a class="hover:underline" target="_blank" :href="parsed_data.data.personalInfo[0].website">{{ parsed_data.data.personalInfo[0].website }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </header>

            <section id="work-experience" class="mb-6">
                <h2 class="text-xl font-bold mb-3 title-font border-b pb-2">Work Experience</h2>
                <div v-for="(job, index) in parsed_data.data.workExperience" :key="index" class="mb-5">
                    <h3 class="font-bold text-base">
                        <span>{{ job.role }}</span> – {{ job.company }}
                    </h3>
                    <p class="text-sm text-muted-foreground">
                        {{ formatDate(job.startDate) }} – {{ formatDate(job.endDate) }}
                    </p>
                    <ul class="list-disc ml-5 mt-2 text-sm space-y-1">
                        <li>{{ job.description }}</li>
                    </ul>
                </div>
            </section>

            <section id="technical-skills" class="mb-6">
                <h2 class="text-xl font-bold mb-3 title-font border-b pb-2">Technical Skills</h2>
                <ul class="list-disc ml-5 space-y-1 text-sm mt-2">
                    <li v-for="(skill, index) in parsed_data.data.skills" :key="index">
                        {{ skill.skill }}
                    </li>
                </ul>
            </section>

            <section id="education" class="mb-6" v-if="parsed_data.data.education.length">
                <h2 class="text-xl font-bold mb-3 title-font border-b pb-2">Education</h2>
                <div v-for="(edu, index) in parsed_data.data.education" :key="index">
                    <p>
                        <strong><span>{{ edu.degree }}</span></strong>
                    </p>
                    <p class="text-sm mt-1">{{ edu.institution }}</p>
                    <p class="text-sm mt-1 text-muted-foreground">Graduated: {{ formatDate(edu.graduationDate) }}</p>
                    <p class="text-sm mt-2">{{ edu.details }}</p>
                </div>
            </section>

            <section id="academic-achievements" class="mb-6" v-if="parsed_data.data.achievements.length">
                <h2 class="text-xl font-bold mb-3 title-font border-b pb-2">Academic Achievements</h2>
                <ul class="list-disc ml-5 text-sm space-y-1">
                    <li v-for="(item, index) in parsed_data.data.achievements" :key="index">
                        {{ item.achievement }}
                    </li>
                </ul>
            </section>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8">
                <section id="projects" class="mb-6" v-if="parsed_data.data.projects.length">
                    <h2 class="text-xl font-bold mb-3 title-font border-b pb-2">Projects</h2>
                    <ul class="list-disc ml-5 text-sm space-y-1">
                        <li v-for="(project, index) in parsed_data.data.projects" :key="index">
                            {{ project.project }}
                        </li>
                    </ul>
                    <p class="text-sm mt-2">
                        <span>For a detailed overview, visit my portfolio:</span>
                        <a target="_blank" :href="parsed_data.data.personalInfo[0].website" class="text-blue-600 hover:underline dark:text-blue-400" aria-label="View all projects (opens in a new tab)">
                            {{ parsed_data.data.personalInfo[0].website }}
                        </a>
                    </p>
                </section>

                <section id="languages" class="mb-6">
                    <h2 class="text-xl font-bold mb-3 title-font border-b pb-2">Languages</h2>
                    <ul class="ml-1 text-sm space-y-1 mt-1">
                        <li><span><strong>English:</strong> Professional Proficiency</span></li>
                        <li><span><strong>German:</strong> Elementary Proficiency</span></li>
                    </ul>
                </section>

                <section id="social-links" class="mb-6" v-if="parsed_data.data.socialLinks.length && (parsed_data.data.socialLinks[0].github || parsed_data.data.socialLinks[0].linkedin || parsed_data.data.socialLinks[0].twitter || parsed_data.data.socialLinks[0].instagram || parsed_data.data.socialLinks[0].other)">
                    <h2 class="text-xl font-bold mb-3 title-font border-b pb-2">Social Links</h2>
                    <ul class="list-disc ml-5 text-sm mt-1 space-y-1">
                        <li v-if="parsed_data.data.socialLinks[0].github"><strong>GitHub:</strong> {{ parsed_data.data.socialLinks[0].github }}</li>
                        <li v-if="parsed_data.data.socialLinks[0].linkedin"><strong>LinkedIn:</strong> {{ parsed_data.data.socialLinks[0].linkedin }}</li>
                        <li v-if="parsed_data.data.socialLinks[0].twitter"><strong>Twitter:</strong> {{ parsed_data.data.socialLinks[0].twitter }}</li>
                        <li v-if="parsed_data.data.socialLinks[0].instagram"><strong>Instagram:</strong> {{ parsed_data.data.socialLinks[0].instagram }}</li>
                        <li v-if="parsed_data.data.socialLinks[0].other"><strong>Other:</strong> {{ parsed_data.data.socialLinks[0].other }}</li>
                    </ul>
                </section>

                <section id="hobbies" class="mb-6" v-if="parsed_data.data.hobbies.length && (parsed_data.data.hobbies[0].hobby || parsed_data.data.hobbies[0].other)">
                    <h2 class="text-xl font-bold mb-3 title-font border-b pb-2">Hobbies</h2>
                    <ul class="list-disc ml-5 text-sm mt-1 space-y-1">
                        <li v-for="(hobby, index) in parsed_data.data.hobbies" :key="index">
                            {{ hobby.hobby }}
                        </li>
                    </ul>
                </section>
            </div>
        </main>

        <footer class="resume-footer text-center text-xs text-muted-foreground mt-4">
            <div class="print-signature">
                <a :href="parsed_data.data.personalInfo[0].website" target="_blank" rel="noopener noreferrer">{{ parsed_data.data.personalInfo[0].website }}</a>
            </div>
        </footer>

        <Rightbar />
    </div>
    <div v-else class="flex items-center justify-center min-h-screen">
        <p>Loading data...</p>
    </div>
    <LeftSideBar />
    <BottomBar />
</template>

<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import Rightbar from '@/components/bars/Rightbar.vue';
import BottomBar from '@/components/bars/BottomBar.vue';
import LeftSideBar from '@/components/bars/LeftSideBar.vue';

 defineProps({
    parsed_data: Object,
});

const formatDate = (dateString: string | null): string => {
    if (!dateString) return 'Present';
    const options: Intl.DateTimeFormatOptions = { year: 'numeric', month: 'long' };
    return new Date(dateString).toLocaleDateString(undefined, options);
};

const getInitials = (firstName: string, lastName: string): string => {
    return `${firstName?.charAt(0) || ''}${lastName?.charAt(0) || ''}`.toUpperCase();
};
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