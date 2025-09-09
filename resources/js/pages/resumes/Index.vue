<script setup lang="ts">
import ActionBar from '@/components/bars/ActionBar.vue';
import SocialLinks from '@/components/SocialLinks.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/components/ui/accordion';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { create, index } from '@/routes/resumes';
import { BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    parsed_data: Object,
});

const formatDate = (dateString: string) => {
    if (!dateString) return 'Present';
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
    });
};

const breadcrumbs = computed<BreadcrumbItem[]>(() => {
    return [
        {
            title: 'Dashboard',
            href: dashboard().url,
        },
        {
            title: 'Resumes',
            href: index().url,
        },
    ];
});
</script>

<template>
    <Head title="Resumes" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-if="props.parsed_data && props.parsed_data.length > 0" class="mx-auto max-w-4xl space-y-8">
            <Card v-for="resume in props.parsed_data" :key="resume.id" class="relative overflow-hidden rounded-xl shadow-lg">

                <div v-if="resume.title" class="absolute left-4 top-4 rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                    {{ resume.title }}
                </div>

                <CardHeader class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <div v-if="resume.data.personalInfo && resume.data.personalInfo.length > 0">
                                <CardTitle class="text-3xl font-bold text-foreground">
                                    {{ resume.data.personalInfo[0].firstName }} {{ resume.data.personalInfo[0].lastName }}
                                </CardTitle>
                                <CardDescription
                                    v-if="resume.data.workExperience && resume.data.workExperience.length > 0"
                                    class="pt-1 text-lg text-indigo-600 dark:text-indigo-400"
                                >
                                    {{ resume.data.workExperience[0].role }}
                                </CardDescription>
                            </div>
                            <div v-else>
                                <CardTitle>Resume</CardTitle>
                                <CardDescription>Personal information not available.</CardDescription>
                            </div>
                        </div>
                        <ActionBar :id="resume.id" />
                    </div>
                </CardHeader>

                <CardContent class="p-6">
                    <Accordion type="multiple" class="w-full" collapsible>
                        <AccordionItem v-if="resume.data.personalInfo && resume.data.personalInfo.length > 0" value="personal-info">
                            <AccordionTrigger class="text-xl font-semibold">Personal Information</AccordionTrigger>
                            <AccordionContent class="grid gap-4 pt-2 text-sm text-muted-foreground sm:grid-cols-2">
                                <div v-if="resume.data.personalInfo[0].email">
                                    <strong class="text-foreground">Email:</strong> {{ resume.data.personalInfo[0].email }}
                                </div>
                                <div v-if="resume.data.personalInfo[0].mobile">
                                    <strong class="text-foreground">Mobile:</strong> {{ resume.data.personalInfo[0].mobile }}
                                </div>
                                <div v-if="resume.data.personalInfo[0].website">
                                    <a :href="resume.data.personalInfo[0].website" target="_blank" rel="noopener noreferrer" class="text-indigo-500 hover:underline dark:text-indigo-400">
                                        <strong class="text-foreground">{{ resume.data.personalInfo[0].website }}</strong>
                                    </a>
                                </div>
                                <div v-if="resume.data.location && resume.data.location.length > 0">
                                    <strong class="text-foreground">Location:</strong> {{ resume.data.location[0].city }}, {{ resume.data.location[0].country }}
                                </div>
                            </AccordionContent>
                        </AccordionItem>

                        <AccordionItem v-if="resume.data.workExperience && resume.data.workExperience.length > 0" value="work-experience">
                            <AccordionTrigger class="text-xl font-semibold">Work Experience</AccordionTrigger>
                            <AccordionContent class="pt-2">
                                <div v-for="(job, index) in resume.data.workExperience" :key="index" class="mb-4 last:mb-0">
                                    <h4 class="text-md font-bold text-foreground">{{ job.role }}</h4>
                                    <p class="text-sm text-muted-foreground">{{ job.company }} | {{ formatDate(job.startDate) }} - {{ formatDate(job.endDate) }}</p>
                                    <p class="mt-1 text-sm text-muted-foreground">{{ job.description }}</p>
                                </div>
                            </AccordionContent>
                        </AccordionItem>

                        <AccordionItem v-if="resume.data.education && resume.data.education.length > 0" value="education">
                            <AccordionTrigger class="text-xl font-semibold">Education</AccordionTrigger>
                            <AccordionContent class="pt-2">
                                <div v-for="(edu, index) in resume.data.education" :key="index" class="mb-4 last:mb-0">
                                    <h4 class="text-md font-bold text-foreground">{{ edu.institution }}</h4>
                                    <p class="text-sm text-muted-foreground">{{ edu.degree }} - Graduated {{ formatDate(edu.graduationDate) }}</p>
                                    <p class="mt-1 text-sm text-muted-foreground">{{ edu.details }}</p>
                                </div>
                            </AccordionContent>
                        </AccordionItem>

                        <AccordionItem v-if="resume.data.skills && resume.data.skills.length > 0" value="skills">
                            <AccordionTrigger class="text-xl font-semibold">Skills</AccordionTrigger>
                            <AccordionContent class="pt-2">
                                 <ul class="list-inside list-disc space-y-1 text-sm text-muted-foreground">
                                    <li v-for="(skill, index) in resume.data.skills" :key="index">{{ skill.skill }}</li>
                                </ul>
                            </AccordionContent>
                        </AccordionItem>

                        <AccordionItem v-if="resume.data.projects && resume.data.projects.length > 0" value="projects">
                            <AccordionTrigger class="text-xl font-semibold">Projects</AccordionTrigger>
                            <AccordionContent class="pt-2">
                                <ul class="list-inside list-disc space-y-1 text-sm text-muted-foreground">
                                    <li v-for="(project, index) in resume.data.projects" :key="index">{{ project.project }}</li>
                                </ul>
                            </AccordionContent>
                        </AccordionItem>

                         <AccordionItem v-if="resume.data.achievements && resume.data.achievements.length > 0" value="achievements">
                            <AccordionTrigger class="text-xl font-semibold">Achievements</AccordionTrigger>
                            <AccordionContent class="pt-2">
                                <ul class="list-inside list-disc space-y-1 text-sm text-muted-foreground">
                                    <li v-for="(achievement, index) in resume.data.achievements" :key="index">{{ achievement.achievement }}</li>
                                </ul>
                            </AccordionContent>
                        </AccordionItem>
                    </Accordion>
                </CardContent>

                <CardFooter v-if="resume.data.socialLinks">
                    <SocialLinks :links="resume.data.socialLinks" />
                </CardFooter>
            </Card>
        </div>
        <div v-else class="py-12 text-center">
             </div>
    </AppLayout>
</template>
