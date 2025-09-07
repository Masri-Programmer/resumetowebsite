<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { destroy, edit, create, index, show } from '@/routes/resumes';
import { BreadcrumbItem } from '@/types';
import type { PageProps } from '@/types/index';
import { Resume } from '@/types/index';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ExternalLink, Pencil, Trash2 } from 'lucide-vue-next';
import { computed } from 'vue';

const page = usePage<PageProps & { resumes: Resume[] }>();

const data = computed(() => page.props.resumes);

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
const confirmDelete = () => {
    return window.confirm('Are you sure you want to delete this resume?');
};
</script>

<template>
    <Head title="Resumes" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-if="data && data.length > 0" class="mx-auto max-w-4xl space-y-8">
            <Card v-for="resume in data" :key="resume.id" class="overflow-hidden rounded-xl shadow-lg">
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

                        <div class="flex flex-shrink-0 items-center space-x-1">
                            <Link :href="show.url(resume.id)">
                                <Button variant="ghost" size="icon" class="h-8 w-8">
                                    <ExternalLink class="h-4 w-4" />
                                </Button>
                            </Link>

                            <Link :href="edit.url(resume.id)">
                                <Button variant="ghost" size="icon" class="h-8 w-8">
                                    <Pencil class="h-4 w-4" />
                                </Button>
                            </Link>
                            <Link :href="destroy.url(resume.id)" method="delete" as="button" :onBefore="confirmDelete" preserve-scroll>
                                <Button variant="ghost" size="icon" class="h-8 w-8 text-red-500 hover:text-red-600">
                                    <Trash2 class="h-4 w-4" />
                                </Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>

                <CardContent class="grid gap-6 p-6">
                    <div
                        v-if="resume.data.personalInfo && resume.data.personalInfo.length > 0"
                        class="grid gap-4 text-sm text-muted-foreground sm:grid-cols-2"
                    >
                        <div v-if="resume.data.personalInfo[0].email">
                            <strong class="text-foreground">Email:</strong> {{ resume.data.personalInfo[0].email }}
                        </div>
                        <div v-if="resume.data.personalInfo[0].mobile">
                            <strong class="text-foreground">Mobile:</strong> {{ resume.data.personalInfo[0].mobile }}
                        </div>
                        <div v-if="resume.data.personalInfo[0].website">
                            <a
                                :href="resume.data.personalInfo[0].website"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="text-indigo-500 hover:underline dark:text-indigo-400"
                                ><strong class="text-foreground">{{ resume.data.personalInfo[0].website }}</strong></a
                            >
                        </div>
                        <div v-if="resume.data.location && resume.data.location.length > 0">
                            <strong class="text-foreground">Location:</strong> {{ resume.data.location[0].city }},
                            {{ resume.data.location[0].country }}
                        </div>
                    </div>

                    <div v-if="resume.data.workExperience && resume.data.workExperience.length > 0">
                        <h3 class="mb-3 border-b border-border pb-2 text-xl font-semibold text-foreground">Work Experience</h3>
                        <div v-for="(job, index) in resume.data.workExperience" :key="index" class="mb-4 last:mb-0">
                            <h4 class="text-md font-bold text-foreground">{{ job.role }}</h4>
                            <p class="text-sm text-muted-foreground">
                                {{ job.company }} | {{ formatDate(job.startDate) }} - {{ formatDate(job.endDate) }}
                            </p>
                            <p class="mt-1 text-sm text-muted-foreground">{{ job.description }}</p>
                        </div>
                    </div>

                    <div v-if="resume.data.education && resume.data.education.length > 0">
                        <h3 class="mb-3 border-b border-border pb-2 text-xl font-semibold text-foreground">Education</h3>
                        <div v-for="(edu, index) in resume.data.education" :key="index" class="mb-4 last:mb-0">
                            <h4 class="text-md font-bold text-foreground">{{ edu.institution }}</h4>
                            <p class="text-sm text-muted-foreground">{{ edu.degree }} - Graduated {{ formatDate(edu.graduationDate) }}</p>
                            <p class="mt-1 text-sm text-muted-foreground">{{ edu.details }}</p>
                        </div>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div v-if="resume.data.skills && resume.data.skills.length > 0">
                            <h3 class="mb-3 border-b border-border pb-2 text-xl font-semibold text-foreground">Skills</h3>
                            <ul class="list-inside list-disc space-y-1 text-sm text-muted-foreground">
                                <li v-for="(skill, index) in resume.data.skills" :key="index">{{ skill.skill }}</li>
                            </ul>
                        </div>

                        <div v-if="resume.data.projects && resume.data.projects.length > 0">
                            <h3 class="mb-3 border-b border-border pb-2 text-xl font-semibold text-foreground">Projects</h3>
                            <ul class="list-inside list-disc space-y-1 text-sm text-muted-foreground">
                                <li v-for="(project, index) in resume.data.projects" :key="index">{{ project.project }}</li>
                            </ul>
                        </div>
                    </div>

                    <div v-if="resume.data.achievements && resume.data.achievements.length > 0">
                        <h3 class="mb-3 border-b border-border pb-2 text-xl font-semibold text-foreground">Achievements</h3>
                        <ul class="list-inside list-disc space-y-1 text-sm text-muted-foreground">
                            <li v-for="(achievement, index) in resume.data.achievements" :key="index">{{ achievement.achievement }}</li>
                        </ul>
                    </div>
                </CardContent>

                <CardFooter v-if="resume.data.socialLinks" class="bg-muted/50 p-4">
                    <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm">
                        <a
                            v-if="resume.data.socialLinks[0].github"
                            :href="resume.data.socialLinks[0].github"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-indigo-500 hover:underline dark:text-indigo-400"
                            >GitHub</a
                        >
                        <a
                            v-if="resume.data.socialLinks[0].linkedin"
                            :href="resume.data.socialLinks[0].linkedin"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-indigo-500 hover:underline dark:text-indigo-400"
                            >LinkedIn</a
                        >
                        <a
                            v-if="resume.data.socialLinks[0].twitter"
                            :href="resume.data.socialLinks[0].twitter"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-indigo-500 hover:underline dark:text-indigo-400"
                            >Twitter</a
                        >
                        <a
                            v-if="resume.data.socialLinks[0].instagram"
                            :href="resume.data.socialLinks[0].instagram"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-indigo-500 hover:underline dark:text-indigo-400"
                            >Instagram</a
                        >
                        <a
                            v-if="resume.data.socialLinks[0].other"
                            :href="resume.data.socialLinks[0].other"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-indigo-500 hover:underline dark:text-indigo-400"
                            >Other</a
                        >
                    </div>
                </CardFooter>
            </Card>
        </div>
        <div v-else class="py-12 text-center">
            <p class="text-muted-foreground">No resumes available to display.</p>
            <Button as-child class="mt-4">
                <Link :href="create().url">Create New Resume</Link>
            </Button>
        </div>
    </AppLayout>
</template>
