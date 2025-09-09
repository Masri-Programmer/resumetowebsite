<template>
    <div class="relative hidden lg:block">
        <div class="grid place-content-center p-6 absolute bottom-0 right-0">
          <IconCloud :images="imageUrls" />
        </div>
    </div>
  </template>
  
  <script setup lang="ts">
import IconCloud from '@/components/ui/icon-cloud/IconCloud.vue';

  const slugs = [
    "typescript",
    "javascript",
    "vue",
    "laravel",
    "html5",
    "css3",
    "MySQL",
    "nginx",
    "git",
    "github",
    "visualstudiocode",
    "figma",
  ];
  
  const imageUrls = slugs.map((slug) => `https://cdn.simpleicons.org/${slug}/${slug}`);
  </script>