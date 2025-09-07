<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import { useI18n } from 'vue-i18n';
import { useToast } from 'vue-toastification';
import { usePage } from '@inertiajs/vue3';
import {computed} from 'vue'
// const toast = useToast();
// const { t } = useI18n();
const page = usePage<PageProps>();

const data = computed(() => (page.props.resume));
console.log(data.value);
</script>

<template>
     <Card v-if="data">
         <CardHeader>
             <CardTitle>Resume</CardTitle>
             <CardDescription>Card Description</CardDescription>
            </CardHeader>
            <CardContent>
      Card Content
    </CardContent>
    <CardFooter>
      Card Footer
    </CardFooter>
  </Card>
</template>