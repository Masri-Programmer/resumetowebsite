<script setup lang="ts">
import type { PropType } from 'vue';
import { ParsedData, } from '@/types/index';

defineProps({
    successMessage: {
        type: String,
        required: true,
    },
    parsedData: {
        type: Object as PropType<ParsedData>,
        required: true,
    },
});
</script>

<template>
    <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-6 text-gray-800">
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
</template>