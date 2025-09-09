<template>
 <main class="resume-content mx-auto max-w-4xl overflow-hidden border bg-card p-6 shadow-md lg:p-8" role="document">
            <header class="resume-header mb-4 border-b border-border pb-4">
                <div class="relative flex flex-col items-center gap-4 sm:flex-row sm:justify-start sm:gap-6 md:gap-10">
                    <Avatar class="h-24 w-24">
                        <AvatarImage src="https://github.com/unovue.png" alt="@unovue" />
                        <AvatarFallback>
                            {{ getInitials(parsed_data.data.personalInfo[0].firstName, parsed_data.data.personalInfo[0].lastName) }}
                        </AvatarFallback>
                    </Avatar>
                    <div class="w-full grow text-center sm:text-start">
                        <h1 class="title-font text-3xl font-bold md:text-4xl">
                            {{ parsed_data.data.personalInfo[0].firstName }} {{ parsed_data.data.personalInfo[0].lastName }}
                        </h1>
                        <div
                            class="mt-2 flex w-full flex-col items-center text-center text-muted-foreground sm:flex-row sm:items-baseline md:text-start"
                        >
                            <p>
                                {{ parsed_data.data.location[0].city }}, {{ parsed_data.data.location[0].country }} |
                                <a class="hover:underline" target="_blank" :href="`mailto:${parsed_data.data.personalInfo[0].email}`">{{
                                    parsed_data.data.personalInfo[0].email
                                }}</a>
                                |
                                <a class="hover:underline" target="_blank" :href="parsed_data.data.personalInfo[0].website">{{
                                    parsed_data.data.personalInfo[0].website
                                }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </header>

            <section id="work-experience" class="mb-6">
                <h2 class="title-font mb-3 border-b pb-2 text-xl font-bold">Work Experience</h2>
                <div v-for="(job, index) in parsed_data.data.workExperience" :key="index" class="mb-5">
                    <h3 class="text-base font-bold">
                        <span>{{ job.role }}</span> – {{ job.company }}
                    </h3>
                    <p class="text-sm text-muted-foreground">{{ formatDate(job.startDate) }} – {{ formatDate(job.endDate) }}</p>
                    <ul class="mt-2 ml-5 list-disc space-y-1 text-sm">
                        <li>{{ job.description }}</li>
                    </ul>
                </div>
            </section>

            <section id="technical-skills" class="mb-6">
                <h2 class="title-font mb-3 border-b pb-2 text-xl font-bold">Technical Skills</h2>
                <ul class="mt-2 ml-5 list-disc space-y-1 text-sm">
                    <li v-for="(skill, index) in parsed_data.data.skills" :key="index">
                        {{ skill.skill }}
                    </li>
                </ul>
            </section>

            <section id="education" class="mb-6" v-if="parsed_data.data.education.length">
                <h2 class="title-font mb-3 border-b pb-2 text-xl font-bold">Education</h2>
                <div v-for="(edu, index) in parsed_data.data.education" :key="index">
                    <p>
                        <strong
                            ><span>{{ edu.degree }}</span></strong
                        >
                    </p>
                    <p class="mt-1 text-sm">{{ edu.institution }}</p>
                    <p class="mt-1 text-sm text-muted-foreground">Graduated: {{ formatDate(edu.graduationDate) }}</p>
                    <p class="mt-2 text-sm">{{ edu.details }}</p>
                </div>
            </section>

            <section id="academic-achievements" class="mb-6" v-if="parsed_data.data.achievements.length">
                <h2 class="title-font mb-3 border-b pb-2 text-xl font-bold">Academic Achievements</h2>
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

                <section id="languages" class="mb-6">
                    <h2 class="title-font mb-3 border-b pb-2 text-xl font-bold">Languages</h2>
                    <ul class="mt-1 ml-1 space-y-1 text-sm">
                        <li>
                            <span><strong>English:</strong> Professional Proficiency</span>
                        </li>
                        <li>
                            <span><strong>German:</strong> Elementary Proficiency</span>
                        </li>
                    </ul>
                </section>

                <section
                    id="social-links"
                    class="mb-6"
                    v-if="
                        parsed_data.data.socialLinks.length &&
                        (parsed_data.data.socialLinks[0].github ||
                            parsed_data.data.socialLinks[0].linkedin ||
                            parsed_data.data.socialLinks[0].twitter ||
                            parsed_data.data.socialLinks[0].instagram ||
                            parsed_data.data.socialLinks[0].other)
                    "
                >
                    <h2 class="title-font mb-3 border-b pb-2 text-xl font-bold">Social Links</h2>
                    <ul class="mt-1 ml-5 list-disc space-y-1 text-sm">
                        <li v-if="parsed_data.data.socialLinks[0].github"><strong>GitHub:</strong> {{ parsed_data.data.socialLinks[0].github }}</li>
                        <li v-if="parsed_data.data.socialLinks[0].linkedin">
                            <strong>LinkedIn:</strong> {{ parsed_data.data.socialLinks[0].linkedin }}
                        </li>
                        <li v-if="parsed_data.data.socialLinks[0].twitter">
                            <strong>Twitter:</strong> {{ parsed_data.data.socialLinks[0].twitter }}
                        </li>
                        <li v-if="parsed_data.data.socialLinks[0].instagram">
                            <strong>Instagram:</strong> {{ parsed_data.data.socialLinks[0].instagram }}
                        </li>
                        <li v-if="parsed_data.data.socialLinks[0].other"><strong>Other:</strong> {{ parsed_data.data.socialLinks[0].other }}</li>
                    </ul>
                </section>

                <section
                    id="hobbies"
                    class="mb-6"
                    v-if="parsed_data.data.hobbies.length && (parsed_data.data.hobbies[0].hobby || parsed_data.data.hobbies[0].other)"
                >
                    <h2 class="title-font mb-3 border-b pb-2 text-xl font-bold">Hobbies</h2>
                    <ul class="mt-1 ml-5 list-disc space-y-1 text-sm">
                        <li v-for="(hobby, index) in parsed_data.data.hobbies" :key="index">
                            {{ hobby.hobby }}
                        </li>
                    </ul>
                </section>
            </div>
        </main>
</template>

<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';

defineProps({
  parsed_data: {
    type: Object,
    required: true,
  },
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

<style scoped>

</style>