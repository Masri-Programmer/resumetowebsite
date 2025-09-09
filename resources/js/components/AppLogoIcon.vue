<script setup lang="ts">
import { NotebookPen } from 'lucide-vue-next';
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <NotebookPen color="bg-primary" class="bg-primary"/>
</template>
