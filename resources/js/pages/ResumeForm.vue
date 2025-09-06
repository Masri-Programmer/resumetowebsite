<script setup lang="ts">
import type { ParsedData } from '@/types/index';
import { useForm } from '@inertiajs/vue3';
import { cloneDeep } from 'lodash-es';
import type { PropType } from 'vue';

// ShadCN Vue Components
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { Trash2 } from 'lucide-vue-next';
import { useToast } from 'vue-toastification';

const toast = useToast();

// --- Props and Setup ---
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
    form.post('/resume/save', {
        onSuccess: () => {
            toast.success('Successfully Saved');
        },
    });
};
</script>
<template>
    <form v-if="parsedData" @submit.prevent="submit" class="w-full">
        <div class="space-y-6">
            <Card v-for="(section, sectionKey,) in parsedData" :key="sectionKey">
                <template v-if="section">
                    <CardHeader>
                        <CardTitle>{{ section.title }}</CardTitle>
                        <CardDescription>{{ section.description }}</CardDescription>
                    </CardHeader>
                    <CardContent class="space-y-4">
                        <div class="space-y-6">
                            <div
                                v-for="(fieldGroup, groupIndex) in form[sectionKey].fields"
                                :key="groupIndex"
                                class="grid grid-cols-1 gap-x-6 gap-y-4 rounded-lg border p-4 sm:grid-cols-2 relative"
                            >
                            <Button
                            v-if="section.actions?.remove"
                            variant="destructive"
                            size="icon"
                            class="absolute top-2 right-2 h-7 w-7"
                            @click="removeSection(String(sectionKey), groupIndex)"
                        >
                            <Trash2 class="h-4 w-4" />
                        </Button>
                                <div v-for="(field, fieldName) in fieldGroup" :key="fieldName" :class="field.class || 'space-y-2'">
                                    <Label :for="`${fieldName}-${groupIndex}`">{{
                                        (fieldName as string).charAt(0).toUpperCase() + (fieldName as string).slice(1)
                                    }}</Label>
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
                            v-if="section.actions?.add"
                            type="button"
                            variant="outline"
                            @click="addSection(String(sectionKey) as keyof ParsedData)"
                        >
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
