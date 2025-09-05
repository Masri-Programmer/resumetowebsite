<script setup lang="ts">
import { Download, Upload } from "lucide-vue-next"
import { Button } from "@/components/ui/button"
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from "@/components/ui/dialog"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';
import { useI18n } from 'vue-i18n';
import { computed, ref } from 'vue';


// todo: Chat Session (Multi-Turn Conversations)
interface ParsedData {
    personalInfo?: {
        firstName?: string;
        lastName?: string;
        email?: string;
        mobile?: string;
        website?: string;
        location?: {
            address?: string;
            city?: string;
            state?: string;
            country?: string;
            zipCode?: string;
        }
    };
    socialLinks?: {
        linkedin?: string;
        github?: string;
        [key: string]: any;
    };
    workExperience?: {
        role?: string;
        company?: string;
        startDate?: string;
        endDate?: string;
        description?: string[];
    }[];
    education?: {
        degree?: string;
        institution?: string;
        graduationDate?: string;
    }[];
    skills?: {
        technical?: string[];
        soft?: string[];
        languages?: string[];
    };
    projects?: {
        name?: string;
        description?: string;
        technologies?: string[];
    }[];
    // Add other fields as needed
}

interface PageProps {
    [key: string]: unknown;
    flash?: {
        success?: string;
        parsed_data?: ParsedData;
    }
}

const isDialogOpen = ref(false);
const page = usePage<PageProps>();
const toast = useToast();
const { t } = useI18n();

const successMessage = computed(() => page.props.flash?.success);
const parsedData = computed(() => page.props.flash?.parsed_data);

const form = useForm({
    resumeFile: null as File | null,
});

const submit = () => {
    form.post('/resume/import', {
        preserveScroll: true,
        onSuccess: () => {
            isDialogOpen.value = false;
            form.reset();
        },
        onError: (errors) => {
            if (errors.resumeFile) {
                toast.error(errors.resumeFile);
            } else {
                toast.error(t('errors.unknownImportError'));
            }
        },
    });
};
</script>

<template>
    <div>
        <div v-if="successMessage && parsedData" class="mb-6 rounded-lg border border-green-200 bg-green-50 p-6 text-gray-800">
            <h3 class="mb-4 text-xl font-semibold text-green-900">{{ successMessage }}</h3>

            <div class="space-y-6">
                <section v-if="parsedData.personalInfo">
                    <h4 class="text-lg font-bold">Personal Information</h4>
                    <div class="mt-2 grid grid-cols-1 gap-4 rounded-md border p-4 sm:grid-cols-2">
                        <p v-if="parsedData.personalInfo.firstName || parsedData.personalInfo.lastName"><strong>Name:</strong> {{ parsedData.personalInfo.firstName }} {{ parsedData.personalInfo.lastName }}</p>
                        <p v-if="parsedData.personalInfo.email"><strong>Email:</strong> {{ parsedData.personalInfo.email }}</p>
                        <p v-if="parsedData.personalInfo.mobile"><strong>Mobile:</strong> {{ parsedData.personalInfo.mobile }}</p>
                        <p v-if="parsedData.personalInfo.website"><strong>Website:</strong> <a :href="parsedData.personalInfo.website" target="_blank" class="text-blue-600 hover:underline">{{ parsedData.personalInfo.website }}</a></p>
                    </div>
                </section>

                <section v-if="parsedData.workExperience?.length">
                    <h4 class="text-lg font-bold">Work Experience</h4>
                    <div class="mt-2 space-y-4 rounded-md border p-4">
                        <div v-for="(job, index) in parsedData.workExperience" :key="index" class="border-b pb-2 last:border-b-0">
                            <p class="font-semibold">{{ job.role }} at {{ job.company }}</p>
                            <p class="text-sm text-gray-600">{{ job.startDate }} - {{ job.endDate ?? 'Present' }}</p>
                            <ul v-if="job.description?.length" class="mt-1 list-inside list-disc pl-2 text-sm">
                                <li v-for="(desc, dIndex) in job.description" :key="dIndex">{{ desc }}</li>
                            </ul>
                        </div>
                    </div>
                </section>

                <section v-if="parsedData.skills">
                    <h4 class="text-lg font-bold">Skills</h4>
                    <div class="mt-2 rounded-md border p-4">
                        <div v-if="parsedData.skills.technical?.length">
                            <h5 class="font-semibold">Technical Skills</h5>
                            <p class="text-sm">{{ parsedData.skills.technical.join(', ') }}</p>
                        </div>
                        <div v-if="parsedData.skills.soft?.length" class="mt-2">
                            <h5 class="font-semibold">Soft Skills</h5>
                            <p class="text-sm">{{ parsedData.skills.soft.join(', ') }}</p>
                        </div>
                         <div v-if="parsedData.skills.languages?.length" class="mt-2">
                            <h5 class="font-semibold">Languages</h5>
                            <p class="text-sm">{{ parsedData.skills.languages.join(', ') }}</p>
                        </div>
                    </div>
                </section>

                 <section v-if="parsedData.education?.length">
                    <h4 class="text-lg font-bold">Education</h4>
                    <div class="mt-2 space-y-3 rounded-md border p-4">
                        <div v-for="(edu, index) in parsedData.education" :key="index">
                            <p class="font-semibold">{{ edu.degree }}</p>
                            <p class="text-sm">{{ edu.institution }} ({{ edu.graduationDate }})</p>
                        </div>
                    </div>
                </section>

                <div>
                    <details>
                        <summary class="cursor-pointer text-sm text-gray-600">View Raw AI Response</summary>
                        <pre class="mt-2 overflow-x-auto rounded-md bg-gray-800 p-3 text-sm text-white">{{ JSON.stringify(parsedData, null, 2) }}</pre>
                    </details>
                </div>
            </div>
        </div>

        <Dialog :open="isDialogOpen" @update:open="isDialogOpen = $event">
            <DialogTrigger as-child>
                <Button variant="outline" class="h-auto w-full border-0 p-0">
                    <div class="card-glow group relative flex aspect-[4/5] w-full flex-col justify-center overflow-hidden rounded-2xl border border-gray-900">
                    <PlaceholderPattern />
                    <div class="flex flex-1 items-center justify-center">
                        <Download class="!h-20 !w-20 text-gray-700 transition-colors duration-300 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" />
                    </div>
                    <div class="p-8 text-left">
                        <h2 class="text-lg font-semibold text-gray-200">{{ t('resume.importExistingTitle') }}</h2>
                        <p class="mt-1 text-sm text-gray-500">{{ t('resume.importExistingDescription') }}</p>
                    </div>
                    </div>
                </Button>
            </DialogTrigger>

            <DialogContent class="sm:max-w-md">
                <form @submit.prevent="submit">
                    <DialogHeader>
                        <DialogTitle class="flex items-center gap-x-2">
                            <Upload class="h-5 w-5" />
                            {{ t('resume.importTitle') }}
                        </DialogTitle>
                        <DialogDescription>
                            {{ t('resume.importExistingDescription') }}
                        </DialogDescription>
                    </DialogHeader>

                    <div class="grid gap-6 py-4">
                        <div class="grid items-center gap-2">
                            <Label for="file">{{ t('resume.fileLabel') }}</Label>
                            <Input id="file" type="file" @input="form.resumeFile = ($event.target as HTMLInputElement).files?.[0] || null" required />
                            <p v-if="form.errors.resumeFile" class="text-sm text-red-500">{{ form.errors.resumeFile }}</p>
                        </div>
                    </div>

                    <DialogFooter>
                        <Button type="button" variant="secondary" @click="isDialogOpen = false">{{ t('resume.cancel') }}</Button>
                        <Button type="submit" :disabled="form.processing">
                            {{ form.processing ? t('resume.validating') : t('resume.validateButton') }}
                        </Button>
                    </DialogFooter>
                </form>
            </DialogContent>
        </Dialog>
    </div>
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