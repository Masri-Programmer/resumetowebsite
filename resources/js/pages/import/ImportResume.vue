<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { Download, Upload } from "lucide-vue-next"
import { Button } from "@/components/ui/button"
import {
  Dialog,
  DialogClose,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { useToast } from 'vue-toastification';
import { useI18n } from 'vue-i18n'; // 1. Import useI18n

const { t } = useI18n(); 
const toast = useToast(); 
const form = useForm({
  resumeFile: null as File | null,
});

// const handleFileChange = (event: Event) => {
//     const target = event.target as HTMLInputElement;
//     if (target.files) {
//         form.resumeFile = target.files[0];
//     }
// };

const submit = () => {
    console.log(form);
    // form.post(route('resume.import'), {
    //     onSuccess: () => {
    //         toast.success("Resume imported successfully!");
    //     },
    //     onError: (errors) => {
    //         if (errors.resumeFile) {
    //             toast.error(errors.resumeFile);
    //         } else {
    //             toast.error("An unknown error occurred.");
    //         }
    //     },
    // });
};
</script>

<template>
  <Dialog>
    <DialogTrigger as-child>
      <Button variant="outline" class="h-auto p-0 border-0">
        <div class="card-glow group relative flex aspect-[4/5] w-full flex-col justify-center overflow-hidden rounded-2xl border border-gray-900">
          <PlaceholderPattern />
          <div class="flex flex-1 items-center justify-center">
            <Download class="!h-20 !w-20 text-gray-700 transition-colors duration-300 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" />
          </div>
          <div class="p-8 text-left">
            <h2 class="text-lg font-semibold text-gray-200">Import an existing resume</h2>
            <p class="mt-1 text-sm text-gray-500">PDF, LinkedIn, JSON Resume, etc.</p>
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
                {{ t('resume.importDescription') }}
            </DialogDescription>
        </DialogHeader>

        <div class="grid gap-6 py-4">
            <div class="grid items-center gap-2">
                <Label for="file">File</Label>
                <Input id="file" type="file" @input="form.resumeFile = ($event.target as HTMLInputElement).files[0]" />
                <p v-if="form.errors.resumeFile" class="text-sm text-red-500">{{ form.errors.resumeFile }}</p>
            </div>
        </div>

        <DialogFooter>
            <DialogClose as-child>
                <Button type="button" variant="secondary">{{ t('resume.cancel') }}</Button>
            </DialogClose>
            <Button type="submit" :disabled="form.processing">
                {{ form.processing ? 'Validating...' :  t('resume.validateButton') }}
            </Button>
        </DialogFooter>
      </form>
    </DialogContent>
  </Dialog>
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