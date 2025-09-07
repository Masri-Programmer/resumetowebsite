<script setup lang="ts">
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { importMethod } from '@/routes';
import { edit } from '@/routes/resumes';
import type { Page } from '@inertiajs/core';
import { router, useForm } from '@inertiajs/vue3';
import { Download, Upload } from 'lucide-vue-next';
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useToast } from 'vue-toastification';

const isDialogOpen = ref(false);
const toast = useToast();
const { t } = useI18n();

const form = useForm({
    resumeFile: null as File | null,
});

const submit = () => {
    form.post(importMethod.url(), {
        preserveScroll: true,
        onSuccess: (page: Page) => {
            const id = page.props.parsed_data.id;
            toast.success(t('resume.importSuccess'));
            isDialogOpen.value = false;
            form.reset();
            router.visit(edit.url(id), {
                preserveState: true,
            });
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
    <Dialog :open="isDialogOpen" @update:open="isDialogOpen = $event">
        <DialogTrigger as-child>
            <Button variant="outline" class="h-auto w-full border-0 p-0">
                <div
                    class="card-glow group relative flex aspect-[4/5] w-full flex-col justify-center overflow-hidden rounded-2xl border border-gray-900"
                >
                    <PlaceholderPattern />
                    <div class="flex flex-1 items-center justify-center">
                        <Download
                            class="!h-20 !w-20 text-gray-700 transition-colors duration-300 group-hover:text-gray-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1"
                            stroke="currentColor"
                        />
                    </div>
                    <div class="p-8 text-left">
                        <h2 class="text-lg font-semibold text-gray-700">{{ t('resume.importExistingTitle') }}</h2>
                        <p class="mt-1 text-sm text-wrap text-gray-500">{{ t('resume.importExistingDescription') }}</p>
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
</template>
