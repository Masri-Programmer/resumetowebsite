<script setup lang="ts">
import { dashboard } from '@/routes';
import type {  ParsedData } from '@/types/index';
import { router, useForm } from '@inertiajs/vue3';
import type { PropType } from 'vue';
import { onMounted , computed} from 'vue';
import { cloneDeep } from 'lodash-es';

// ShadCN Vue Components
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { Trash2 } from 'lucide-vue-next';

// --- Props and Setup ---
const props = defineProps({
    successMessage: {
        type: String,
        required: true,
    },
    parsedData: {
        type: Object as PropType<ParsedData>,
        // required: true,
        default: () => ({
            personalInfo: {
                title: 'Personal Information',
                description: 'Your personal contact details.',
                type: 'fields',
                actions: { add: false, remove: false },
                fields: [
                    {
                        firstName: {
                            placeholder: 'e.g., Mohamad',
                            type: 'string',
                            value: 'Mohamad',
                            rules: { required: true, min: 2, max: 255 },
                        },
                        lastName: {
                            placeholder: 'e.g., Masri',
                            type: 'string',
                            value: '',
                            rules: { required: true, min: 2, max: 255 },
                        },
                        email: {
                            placeholder: 'e.g., your@email.com',
                            type: 'email',
                            value: '',
                            rules: { required: true, email: true },
                        },
                        mobile: {
                            placeholder: 'e.g., +49 123 456789',
                            type: 'string',
                            value: '',
                            rules: { required: false, min: 10, max: 20 },
                        },
                        website: {
                            placeholder: 'e.g., www.your-portfolio.com',
                            class: 'sm:col-span-2',
                            type: 'url',
                            value: '',
                            rules: { required: false, url: true },
                        },
                    },
                ],
            },
            location: {
                title: 'Location',
                description: 'Where you are currently based.',
                type: 'fields',
                actions: { add: false, remove: false },
                fields: [
                    {
                        address: {
                            placeholder: 'e.g., Musterstraße 1',
                            class: 'sm:col-span-2',
                            type: 'string',
                            value: '',
                            rules: { required: true, min: 5, max: 255 },
                        },
                        city: {
                            placeholder: 'e.g., Oldenburg',
                            type: 'string',
                            value: '',
                            rules: { required: true, min: 2, max: 255 },
                        },
                        state: {
                            placeholder: 'e.g., Lower Saxony',
                            type: 'string',
                            value: '',
                            rules: { required: true, min: 2, max: 255 },
                        },
                        zipCode: {
                            placeholder: 'e.g., 26121',
                            type: 'string',
                            value: '',
                            rules: { required: true, numeric: true, min: 4, max: 10 },
                        },
                        country: {
                            placeholder: 'e.g., Germany',
                            type: 'string',
                            value: '',
                            rules: { required: true, min: 2, max: 255 },
                        },
                    },
                ],
            },
            socialLinks: {
                title: 'Social & Professional Links',
                description: 'Links to your online profiles.',
                type: 'fields',
                actions: { add: true, remove: false },
                fields: [
                    {
                        linkedin: {
                            placeholder: 'URL of your LinkedIn profile',
                            type: 'url',
                            value: '',
                            rules: { required: false, url: true },
                        },
                        github: {
                            placeholder: 'URL of your GitHub profile',
                            type: 'url',
                            value: '',
                            rules: { required: false, url: true },
                        },
                        twitter: {
                            placeholder: 'URL of your Twitter profile',
                            type: 'url',
                            value: '',
                            rules: { required: false, url: true },
                        },
                        instagram: {
                            placeholder: 'URL of your Instagram profile',
                            type: 'url',
                            value: '',
                            rules: { required: false, url: true },
                        },
                        other: {
                            placeholder: 'URL of a profile',
                            type: 'url',
                            value: '',
                            rules: { required: false, url: true },
                        },
                    },
                ],
            },
            workExperience: {
                title: 'Work Experience',
                description: 'Your professional work history.',
                type: 'group',
                actions: { add: true, remove: true },
                fields: [
                    {
                        role: {
                            placeholder: 'e.g., Full Stack Developer',
                            type: 'string',
                            value: '',
                            rules: { required: true, min: 2, max: 255 },
                        },
                        company: {
                            placeholder: 'e.g., Tech Solutions Inc.',
                            type: 'string',
                            value: '',
                            rules: { required: true, min: 2, max: 255 },
                        },
                        startDate: {
                            placeholder: 'e.g., Oct 2022',
                            type: 'date',
                            value: '',
                            rules: { required: true, date: true },
                        },
                        endDate: {
                            placeholder: 'e.g., Sep 2023 or Present',
                            type: 'date',
                            value: '',
                            rules: { required: false, date: true },
                        },
                        description: {
                            component: 'textarea',
                            placeholder: 'Enter each responsibility on a new line.',
                            class: 'sm:col-span-2',
                            type: 'string',
                            value: '',
                            rules: { required: false, max: 2000 },
                        },
                    },
                ],
            },
            education: {
                title: 'Education',
                description: 'Your educational background.',
                type: 'group',
                actions: { add: true, remove: true },
                fields: [
                    {
                        degree: {
                            placeholder: 'e.g., B.Sc. in Computer Science',
                            type: 'string',
                            value: '',
                            rules: { required: true, min: 2, max: 255 },
                        },
                        institution: {
                            placeholder: 'e.g., University of Oldenburg',
                            type: 'string',
                            value: '',
                            rules: { required: true, min: 2, max: 255 },
                        },
                        graduationDate: {
                            placeholder: 'e.g., Sep 2022',
                            type: 'date',
                            value: '',
                            rules: { required: true, date: true },
                        },
                        details: {
                            component: 'textarea',
                            placeholder: 'e.g., Grade: 1.8\nFocus on OOP...',
                            class: 'sm:col-span-2',
                            type: 'string',
                            value: '',
                            rules: { required: false, max: 2000 },
                        },
                    },
                ],
            },
            skills: {
                title: 'Skills',
                description: 'Your skills.',
                type: 'fields',
                actions: { add: true, remove: true },
                fields: [
                    {
                        skill: {
                            placeholder: 'e.g., Vue.js, Laravel, Teamwork',
                            type: 'string',
                            value: '',
                            rules: { required: true, min: 2, max: 255 },
                        },
                    },
                ],
            },
            achievements: {
                title: 'Achievements',
                description: 'A list of your notable achievements.',
                type: 'fields',
                actions: { add: true, remove: true },
                fields: [
                    {
                        achievement: {
                            placeholder: 'Enter each achievement on a new line.',
                            type: 'string',
                            value: '',
                            rules: { required: true, min: 2, max: 255 },
                        },
                    },
                ],
            },
            projects: {
                title: 'Projects',
                description: 'A list of your projects.',
                type: 'fields',
                actions: { add: true, remove: true },
                fields: [
                    {
                        project: {
                            placeholder: 'Enter each project on a new line.',
                            type: 'string',
                            value: '',
                            rules: { required: true, min: 2, max: 255 },
                        },
                    },
                ],
            },
            hobbies: {
                title: 'Hobbies',
                description: 'Your interests and hobbies.',
                type: 'fields',
                actions: { add: true, remove: true },
                fields: [
                    {
                        hobby: {
                            name: 'hobby',
                            label: 'Hobby',
                            placeholder: 'e.g., Fitness, Travel, Gaming',
                            type: 'string',
                            value: '',
                            rules: { required: false, min: 2, max: 255 },
                        },
                    },
                ],
            },
        }),
    },
});
// onMounted(() => {
//     if (!props.parsedData) {
//         console.warn('no parsed data');
//         router.visit(dashboard().url, { replace: true });
//     }
// });

const form = useForm(props.parsedData);


const addSection = (sectionKey: keyof ParsedData) => {
    const fieldGroupTemplate = form[sectionKey].fields[0];

    const newFieldGroup = cloneDeep(fieldGroupTemplate);

    for (const fieldName in newFieldGroup) {
        if (Object.prototype.hasOwnProperty.call(newFieldGroup, fieldName)) {
            newFieldGroup[fieldName].value = '';
        }
    }
    form[sectionKey].fields.push(newFieldGroup);
};

const removeSection = (sectionKey: keyof ParsedData, index: number) => {
    if (form[sectionKey].fields.length > 1) {
        form[sectionKey].fields.splice(index, 1);
    }
};

const submit = () => {
    console.log(form);
    // form.post('/resume/save', {
    //     onSuccess: () => {
    //         // Handle success
    //     },
    // });
};
</script>
<template>
    <form v-if="parsedData" @submit.prevent="submit" class="w-full">
        <div class="space-y-6">
            <Card class="relative" v-for="(section, sectionKey,index) in parsedData" :key="sectionKey" >
                <template v-if="section">
                    <CardHeader>
                        <CardTitle>{{ section.title }}</CardTitle>
                        <CardDescription>{{ section.description }}</CardDescription>
                    </CardHeader>
                    <CardContent class="space-y-4">
                        <div class="space-y-6">
                            <div
                                v-for="(fieldGroup, groupIndex) in section.fields"
                                :key="groupIndex"
                                class="grid grid-cols-1 gap-x-6 gap-y-4 rounded-lg border p-4 sm:grid-cols-2"
                            >
                                <div v-for="(field, fieldName) in fieldGroup" :key="fieldName" :class="field.class || 'space-y-2'">
                                    <Label :for="`${fieldName}-${groupIndex}`">{{ (fieldName as string).charAt(0).toUpperCase() + (fieldName as string).slice(1) }}</Label>
                                    <Textarea
                                        v-if="field.component === 'textarea'"
                                        :id="`${fieldName}-${groupIndex}`"
                                        v-model="field.value"
                                        :placeholder="field.placeholder"
                                        class="min-h-[120px]"
                                    />
                                    <Input
                                        v-else
                                        :id="`${fieldName}-${groupIndex}`"
                                        v-model="field.value"
                                        :type="field.type === 'string' ? 'text' : field.type"
                                        :placeholder="field.placeholder"
                                    />
                                </div>
                            </div>
                        </div>
                    </CardContent>
                    <CardFooter>
                        <Button
                            v-if="section.actions?.remove"
                            variant="destructive"
                            size="icon"
                            class="absolute top-2 right-2 h-7 w-7"
                            @click="removeSection(String(sectionKey),index)"
                        >
                            <Trash2 class="h-4 w-4" />
                        </Button>
                        <Button v-if="section.actions?.add" type="button" variant="outline" @click="addSection(String(sectionKey) as keyof ParsedData)">
                            Add {{ section.title }}
                        </Button>
                    </CardFooter>
                </template>
                                </Card>
                    
                                <div class="flex justify-end">
                    <Button type="submit" :disabled="form.processing">Save Resume</Button>
                                </div>
        </div>
    </form>
</template>
