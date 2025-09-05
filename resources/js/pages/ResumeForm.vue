<script setup lang="ts">
import type { PropType } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { ParsedData } from '@/types/index';
import { computed } from 'vue';

// ShadCN Vue Components
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Trash2 } from 'lucide-vue-next';

const props = defineProps({
    successMessage: {
        type: String,
        required: true,
    },
    parsedData: {
        type: Object as PropType<ParsedData>,
        required: true,
    },
});

// Initialize the form with the data parsed by the AI
const form = useForm(props.parsedData);

// --- Form action methods ---

const addWorkExperience = () => {
    form.workExperience?.push({ role: '', company: '', startDate: '', endDate: '', description: [] });
};

const removeWorkExperience = (index: number) => {
    form.workExperience?.splice(index, 1);
};

const addEducation = () => {
    form.education?.push({ degree: '', institution: '', graduationDate: '' });
};

const removeEducation = (index: number) => {
    form.education?.splice(index, 1);
};

// Computed properties to handle skills arrays as comma-separated strings for textareas
const technicalSkills = computed({
    get: () => form.skills?.technical?.join(', ') || '',
    set: (value) => {
        if (form.skills) form.skills.technical = value.split(',').map(s => s.trim()).filter(Boolean);
    }
});

const softSkills = computed({
    get: () => form.skills?.soft?.join(', ') || '',
    set: (value) => {
        if (form.skills) form.skills.soft = value.split(',').map(s => s.trim()).filter(Boolean);
    }
});

const languages = computed({
    get: () => form.skills?.languages?.join(', ') || '',
    set: (value) => {
        if (form.skills) form.skills.languages = value.split(',').map(s => s.trim()).filter(Boolean);
    }
});


const submit = () => {
    // This will post the form data to a new route for saving.
    // You will need to create this route in your `routes/web.php`.
    form.post('/resume/save', {
        onSuccess: () => {
            // Handle successful save (e.g., show a toast notification)
        },
    });
};
</script>

<template>
    <form @submit.prevent="submit" class="w-full">
        <div class="space-y-6">
            <!-- Personal Information Card -->
            <Card>
                <CardHeader>
                    <CardTitle>Personal Information</CardTitle>
                    <CardDescription>Edit your personal details below.</CardDescription>
                </CardHeader>
                <CardContent class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="space-y-2">
                        <Label for="firstName">First Name</Label>
                        <Input id="firstName" v-model="form.personalInfo.firstName" />
                    </div>
                    <div class="space-y-2">
                        <Label for="lastName">Last Name</Label>
                        <Input id="lastName" v-model="form.personalInfo.lastName" />
                    </div>
                    <div class="space-y-2">
                        <Label for="email">Email</Label>
                        <Input id="email" type="email" v-model="form.personalInfo.email" />
                    </div>
                    <div class="space-y-2">
                        <Label for="mobile">Mobile</Label>
                        <Input id="mobile" v-model="form.personalInfo.mobile" />
                    </div>
                    <div class="space-y-2 sm:col-span-2">
                        <Label for="website">Website</Label>
                        <Input id="website" v-model="form.personalInfo.website" />
                    </div>
                </CardContent>
            </Card>

            <!-- Work Experience Card -->
            <Card>
                <CardHeader>
                    <CardTitle>Work Experience</CardTitle>
                    <CardDescription>Add or remove your work history.</CardDescription>
                </CardHeader>
                <CardContent class="space-y-4">
                    <div v-for="(job, index) in form.workExperience" :key="index" class="rounded-md border p-4 relative">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="space-y-2">
                                <Label :for="`role-${index}`">Role</Label>
                                <Input :id="`role-${index}`" v-model="job.role" />
                            </div>
                            <div class="space-y-2">
                                <Label :for="`company-${index}`">Company</Label>
                                <Input :id="`company-${index}`" v-model="job.company" />
                            </div>
                            <div class="space-y-2">
                                <Label :for="`startDate-${index}`">Start Date</Label>
                                <Input :id="`startDate-${index}`" v-model="job.startDate" />
                            </div>
                            <div class="space-y-2">
                                <Label :for="`endDate-${index}`">End Date</Label>
                                <Input :id="`endDate-${index}`" v-model="job.endDate" />
                            </div>
                        </div>
                        <Button variant="destructive" size="icon" class="absolute top-2 right-2 h-7 w-7" @click="removeWorkExperience(index)">
                            <Trash2 class="h-4 w-4" />
                        </Button>
                    </div>
                </CardContent>
                <CardFooter>
                    <Button type="button" variant="outline" @click="addWorkExperience">Add Work Experience</Button>
                </CardFooter>
            </Card>

            <!-- Education Card -->
            <Card>
                <CardHeader>
                    <CardTitle>Education</CardTitle>
                    <CardDescription>Manage your educational background.</CardDescription>
                </CardHeader>
                <CardContent class="space-y-4">
                     <div v-for="(edu, index) in form.education" :key="index" class="rounded-md border p-4 relative">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                             <div class="space-y-2">
                                <Label :for="`degree-${index}`">Degree</Label>
                                <Input :id="`degree-${index}`" v-model="edu.degree" />
                            </div>
                             <div class="space-y-2">
                                <Label :for="`institution-${index}`">Institution</Label>
                                <Input :id="`institution-${index}`" v-model="edu.institution" />
                            </div>
                             <div class="space-y-2 sm:col-span-2">
                                <Label :for="`gradDate-${index}`">Graduation Date</Label>
                                <Input :id="`gradDate-${index}`" v-model="edu.graduationDate" />
                            </div>
                        </div>
                         <Button variant="destructive" size="icon" class="absolute top-2 right-2 h-7 w-7" @click="removeEducation(index)">
                             <Trash2 class="h-4 w-4" />
                         </Button>
                    </div>
                </CardContent>
                <CardFooter>
                    <Button type="button" variant="outline" @click="addEducation">Add Education</Button>
                </CardFooter>
            </Card>

            <!-- Skills Card -->
            <Card>
                <CardHeader>
                    <CardTitle>Skills</CardTitle>
                    <CardDescription>Enter your skills, separated by commas.</CardDescription>
                </CardHeader>
                <CardContent class="space-y-4">
                    <div class="space-y-2">
                        <Label for="technicalSkills">Technical Skills</Label>
                        <Textarea id="technicalSkills" v-model="technicalSkills" placeholder="e.g., Vue.js, Laravel, MySQL" />
                    </div>
                    <div class="space-y-2">
                        <Label for="softSkills">Soft Skills</Label>
                        <Textarea id="softSkills" v-model="softSkills" placeholder="e.g., Teamwork, Communication" />
                    </div>
                    <div class="space-y-2">
                        <Label for="languages">Languages</Label>
                        <Textarea id="languages" v-model="languages" placeholder="e.g., English, German" />
                    </div>
                </CardContent>
            </Card>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <Button type="submit" :disabled="form.processing">Save Resume</Button>
            </div>
        </div>
    </form>
</template>
