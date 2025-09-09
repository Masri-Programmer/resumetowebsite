<script setup lang="ts">
import { computed } from 'vue';
import { useAppearance } from '@/composables/useAppearance';
import { Monitor, Moon, Sun } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';

const { appearance, updateAppearance } = useAppearance();

// An array defining the themes, their icons, and labels.
const themes = [
    { value: 'light', Icon: Sun, label: 'Light' },
    { value: 'dark', Icon: Moon, label: 'Dark' },
    { value: 'system', Icon: Monitor, label: 'System' },
] as const;

// A computed property that returns the icon for the currently active theme.
const currentIcon = computed(() => {
    const current = themes.find((theme) => theme.value === appearance.value);
    return current ? current.Icon : Monitor; // Default to the 'System' icon
});

// A computed property to create a descriptive aria-label for accessibility.
const ariaLabel = computed(() => {
    const current = themes.find((theme) => theme.value === appearance.value);
    return `Toggle theme, current is ${current ? current.label : 'System'}`;
});

/**
 * Cycles to the next theme in the `themes` array.
 */
const toggleAppearance = () => {
    const currentIndex = themes.findIndex((theme) => theme.value === appearance.value);
    // Use the modulo operator to loop back to the start of the array
    const nextIndex = (currentIndex + 1) % themes.length;
    updateAppearance(themes[nextIndex].value);
};
</script>

<template>
    <Button @click="toggleAppearance" variant="ghost" size="icon" :aria-label="ariaLabel">
        <component :is="currentIcon" class="h-5 w-5" />
    </Button>
</template>
