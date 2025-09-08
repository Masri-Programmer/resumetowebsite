<template>
  <TooltipProvider :delay-duration="100">
    <div class="fixed top-4 right-4 flex flex-col space-y-3 no-print z-50">
      <Tooltip>
        <TooltipTrigger as-child>
          <Button variant="outline" size="icon" aria-label="Home Page">
            <Link :href="dashboard().url"><Home class="w-5 h-5" /></Link>
          </Button>
        </TooltipTrigger>
        <TooltipContent>
          <p>Home Page</p>
        </TooltipContent>
      </Tooltip>

      <Tooltip>
        <TooltipTrigger as-child>
          <Button @click="toggleAppearance" variant="outline" size="icon" :aria-label="`Toggle theme, current is ${appearance}`">
            <component :is="currentIcon" class="w-5 h-5" />
          </Button>
        </TooltipTrigger>
        <TooltipContent>
          <p>Toggle Theme</p>
        </TooltipContent>
      </Tooltip>

      <Tooltip>
        <TooltipTrigger as-child>
          <Button @click="printWindow" variant="outline" size="icon" aria-label="Print Page">
            <Printer class="w-5 h-5" />
          </Button>
        </TooltipTrigger>
        <TooltipContent>
          <p>Print Page</p>
        </TooltipContent>
      </Tooltip>

      <Tooltip>
        <TooltipTrigger as-child>
          <Button @click="downloadPdfHandler" variant="outline" size="icon" aria-label="Download Page as PDF">
            <Download class="w-5 h-5" />
          </Button>
        </TooltipTrigger>
        <TooltipContent>
          <p>Download as PDF</p>
        </TooltipContent>
      </Tooltip>
    </div>
  </TooltipProvider>
</template>

<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';
import { dashboard } from '@/routes';
import { Printer, Download, Monitor, Moon, Sun, Home } from 'lucide-vue-next';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { computed } from 'vue';
import { useAppearance } from '@/composables/useAppearance';


 defineProps({
    parsed_data: Object,
});

const { appearance, updateAppearance } = useAppearance();

const tabs = [
    { value: 'light', Icon: Sun, label: 'Light' },
    { value: 'dark', Icon: Moon, label: 'Dark' },
    { value: 'system', Icon: Monitor, label: 'System' },
] as const;

const currentIcon = computed(() => {
    const current = tabs.find(tab => tab.value === appearance.value);
    return current ? current.Icon : Monitor;
});

const toggleAppearance = () => {
    const currentIndex = tabs.findIndex(tab => tab.value === appearance.value);
    const nextIndex = (currentIndex + 1) % tabs.length;
    updateAppearance(tabs[nextIndex].value);
};

const printWindow = () => {
    const savedAppearance = appearance.value;

    updateAppearance('light');

    setTimeout(() => {
      window.print();
    }, 100);

    window.addEventListener('afterprint', () => {
      updateAppearance(savedAppearance);
    });
};

const downloadPdfHandler = () => {
    alert('PDF download functionality not yet implemented.');
};
</script>