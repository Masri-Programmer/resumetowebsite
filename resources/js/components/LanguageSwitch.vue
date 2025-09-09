<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button variant="ghost" size="icon">
                <Languages class="h-5 w-5" />
                <span class="sr-only">Change language</span>
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent align="end">
            <DropdownMenuItem @click="setLocale('en')"> English </DropdownMenuItem>
            <DropdownMenuItem @click="setLocale('de')"> Deutsch </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>

<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { switchMethod } from '@/routes/language';
import { router } from '@inertiajs/vue3';
import { Languages } from 'lucide-vue-next';

import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';

const setLocale = (lang: 'en' | 'de') => {
    router.get(
        switchMethod.url({ locale: lang }),
        {},
        {
            preserveState: true,
        },
    );
};
</script>

<style scoped></style>
