<template>
  <div v-if="hasLinks">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
      Social & Links
    </h3>
    <ul class="list-disc flex flex-wrap gap-x-2 mt-2 space-y-2 text-sm text-gray-600 dark:text-gray-400">
      <template v-for="(url, name) in links[0]" :key="name">
        <li v-if="url" class="flex items-center">
          <!-- <Icon name="lucide:link" class="mr-2 h-4 w-4 text-gray-500" /> -->
          <strong class="font-medium capitalize">{{ name }}:</strong>
          <a
            :href="url"
            target="_blank"
            rel="noopener noreferrer"
            class="ml-2 truncate text-blue-600 hover:underline dark:text-blue-400"
          >
            {{ cleanUrl(url) }}
          </a>
        </li>
      </template>
    </ul>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';

type LinkSet = { [key: string]: string | undefined | null };

interface Props {
  links: LinkSet[] | undefined | null;
}

const props = defineProps<Props>();

const hasLinks = computed(() => {
  if (!props.links || !Array.isArray(props.links) || props.links.length === 0) {
    return false;
  }
  const firstLinkSet = props.links[0];

  if (!firstLinkSet) {
    return false;
  }

  return Object.values(firstLinkSet).some((link) => !!link);
});

const cleanUrl = (url: string): string => {
  return url.replace(/^https?:\/\//, '');
};
</script>