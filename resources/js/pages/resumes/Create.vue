<script setup lang="ts">
import { edit, store } from '@/routes/resumes';
import { Plus } from "lucide-vue-next"
import { useI18n } from 'vue-i18n';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogFooter, DialogTrigger } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useToast } from 'vue-toastification';
import type { Page } from '@inertiajs/core';

const isDialogOpen = ref(false);
const toast = useToast();
const { t } = useI18n();

const form = useForm({
    title: null as string | null,
});

const submit = () => {
    form.post(store.url(), {
        preserveScroll: true,
        onSuccess: (page: Page) => {
            const id = page.props.parsed_data.id;
            isDialogOpen.value = false;
            form.reset();
             router.visit(edit.url(id), {
                preserveState: true,
            });
        },
        onError: (errors) => {
            if (Object.keys(errors).length > 0) {
                for (const key in errors) {
                    toast.error(errors[key]);
                }
            } else {
                toast.error('An unexpected error occurred.');
            }
        },
    });
};
</script>

<template>
    <Dialog :open="isDialogOpen" @update:open="isDialogOpen = $event">
        <DialogTrigger as-child>
            <Button variant="outline" class="h-auto w-full border-0 p-0">
                <div class="card-glow group relative flex aspect-[4/5] w-full cursor-pointer flex-col justify-center overflow-hidden rounded-2xl border border-gray-900">
                    <PlaceholderPattern />
                    <div class="flex flex-1 items-center justify-center">
                        <Plus
                            class="!h-20 !w-20 text-gray-700 transition-colors duration-300 group-hover:text-gray-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1"
                            stroke="currentColor"
                        />
                    </div>
                    <div class="p-8 text-left">
                        <h2 class="text-lg font-semibold text-gray-700">{{ t('resume.createTitle') }}</h2>
                        <p class="mt-1 text-sm text-gray-500 text-wrap">{{ t('resume.createDescription') }}</p>
                    </div>
                </div>
            </Button>
        </DialogTrigger>

        <DialogContent class="sm:max-w-md">
            <form @submit.prevent="submit">
                <div class="grid gap-6 py-4">
                    <div class="grid items-center gap-2">
                        <Label for="title">Title</Label>
                      <Input id="title" type="text" v-model="form.title as string" required />
                        <p v-if="form.errors.title" class="text-sm text-red-500">{{ form.errors.title }}</p>
                    </div>
                </div>

                <DialogFooter>
                    <Button type="button" variant="secondary" @click="isDialogOpen = false">{{ t('resume.cancel') }}</Button>
                    <Button type="submit" :disabled="form.processing">
                        {{ form.processing ? 'Creating...' : 'Create' }}
                    </Button>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>
