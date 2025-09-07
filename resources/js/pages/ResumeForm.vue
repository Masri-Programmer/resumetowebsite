<script setup lang="ts">
import { schema } from '@/helpers';
import type { ResumeData as ResumeDataTypes, Schema } from '@/types';
import { useForm, usePage } from '@inertiajs/vue3';
import { Trash2 } from 'lucide-vue-next';
import { defineProps, PropType } from 'vue';
import { useToast } from 'vue-toastification';

// ShadCN Vue Components
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';

const page = usePage();
const props = defineProps({
    successMessage: {
        type: String,
        required: false,
    },
    resumeData: {
        type: Object as PropType<ResumeDataTypes>,
        default: () => ({}),
    },
});

const toast = useToast();

const form = useForm<ResumeDataTypes>(
    props.resumeData && Object.keys(props.resumeData).length > 0 ? props.resumeData : (page.props.portfolio as ResumeDataTypes),
);

const typedSchema = schema as Schema;

const addSection = (sectionKey: keyof ResumeDataTypes) => {
    const fieldTemplate = typedSchema[sectionKey].fields[0];
    const newEmptyItem: { [key: string]: string | null } = {};

    for (const fieldName in fieldTemplate) {
        if (Object.prototype.hasOwnProperty.call(fieldTemplate, fieldName)) {
            newEmptyItem[fieldName] = '';
        }
    }

    form[sectionKey].push(newEmptyItem as never);
};

const removeSection = (sectionKey: keyof ResumeDataTypes, index: number) => {
    if (form[sectionKey]?.length > 1) {
        form[sectionKey].splice(index, 1);
    }
};

const submit = () => {
    form.post('/resume/save', {
        onSuccess: () => {
            const message = props.successMessage || 'Successfully Saved';
            toast.success(message);
        },
        onError: (errors) => {
            if (errors.resumeFile) {
                toast.error(errors.resumeFile);
            } else {
                toast.error('Error Occured');
            }
        },
    });
};
</script>

<template>
    <form v-if="form" @submit.prevent="submit" class="w-full">
        <div class="space-y-6">
            <Card v-for="(section, sectionKey) in typedSchema" :key="sectionKey">
                <template v-if="form[sectionKey as keyof ResumeDataTypes]">
                    <CardHeader>
                        <CardTitle>{{ section.title }}</CardTitle>
                        <CardDescription>{{ section.description }}</CardDescription>
                    </CardHeader>
                    <CardContent class="space-y-4">
                        <div class="space-y-6">
                            <div
                                v-for="(dataItem, index) in form[sectionKey as keyof ResumeDataTypes]"
                                :key="index"
                                class="relative grid grid-cols-1 gap-x-6 gap-y-4 rounded-lg border p-6 sm:grid-cols-2"
                            >
                                <Button
                                    v-if="section.actions?.remove && form[sectionKey as keyof ResumeDataTypes].length > 1"
                                    variant="destructive"
                                    size="icon"
                                    class="absolute top-2 right-2 h-7 w-7"
                                    @click="removeSection(sectionKey as keyof ResumeDataTypes, index)"
                                >
                                    <Trash2 class="h-4 w-4" />
                                </Button>

                                <div v-for="(fieldDetails, fieldName) in section.fields[0]" :key="fieldName" :class="'space-y-2'">
                                    <Label :for="`${String(fieldName)}-${index}`">{{
                                        (fieldDetails.label as string).charAt(0).toUpperCase() + (fieldDetails.label as string).slice(1)
                                    }}{{ fieldDetails.rules.required ? '*' : '' }}</Label>
                                    <Textarea
                                        v-if="fieldDetails.component === 'textarea'"
                                        :id="`${String(fieldName)}-${index}`"
                                        v-model="dataItem[fieldName as keyof typeof dataItem]"
                                        :required="fieldDetails.rules.required"
                                        :placeholder="fieldDetails.placeholder"
                                        class="min-h-[120px]"
                                    />
                                    <Input
                                        v-else
                                        :id="`${String(fieldName)}-${index}`"
                                        v-model="dataItem[fieldName as keyof typeof dataItem]"
                                        :required="fieldDetails.rules.required"
                                        :type="fieldDetails.type"
                                        :placeholder="fieldDetails.placeholder"
                                    />
                                </div>
                            </div>
                        </div>
                    </CardContent>
                    <CardFooter>
                        <Button v-if="section.actions?.add" type="button" variant="outline" @click="addSection(sectionKey as keyof ResumeDataTypes)">
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
