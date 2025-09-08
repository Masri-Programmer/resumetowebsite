<template>
  <div class="fixed inset-x-0 bottom-0 mx-auto hidden py-6 text-center md:block">
    <div class="inline-flex items-center justify-center rounded-full bg-background px-4 shadow-xl">
      <Button variant="ghost" size="icon" class="rounded-none" data-state="closed">
        <Undo2 class="size-4" />
      </Button>

      <Button variant="ghost" size="icon" class="rounded-none" data-state="closed">
        <Redo2 class="size-4" />
      </Button>

      <div data-orientation="vertical" role="none" class="h-9 w-px shrink-0 bg-border" />

      <Button variant="ghost" size="icon" class="rounded-none" type="button" aria-pressed="true" data-state="closed">
        <Move class="size-4" />
      </Button>

      <div data-orientation="vertical" role="none" class="h-9 w-px shrink-0 bg-border" />

      <Button variant="ghost" size="icon" class="rounded-none" data-state="closed">
        <ZoomIn class="size-4" />
      </Button>

      <Button variant="ghost" size="icon" class="rounded-none" data-state="closed">
        <ZoomOut class="size-4" />
      </Button>

      <Button variant="ghost" size="icon" class="rounded-none" data-state="closed">
        <History class="size-4" />
      </Button>

      <Button variant="ghost" size="icon" class="rounded-none" data-state="closed">
        <Focus class="size-4" />
      </Button>

      <div data-orientation="vertical" role="none" class="h-9 w-px shrink-0 bg-border" />

      <Button variant="ghost" size="icon" class="rounded-none" type="button" aria-pressed="false" data-state="closed">
        <Unlink2 class="size-4" />
      </Button>

      <Button variant="ghost" size="icon" class="rounded-none" type="button" aria-pressed="false" data-state="closed">
        <Hash class="size-4" />
      </Button>

      <div data-orientation="vertical" role="none" class="h-9 w-px shrink-0 bg-border" />

      <Button variant="ghost" size="icon" class="rounded-none" :disabled="true" data-state="closed">
        <Link class="size-4" />
      </Button>

      <Button variant="ghost" size="icon" class="rounded-none" data-state="closed">
        <Type class="size-4" />
      </Button>
    </div>
  </div>
</template>
<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
  Undo2,
  Redo2,
  Move,
  ZoomIn,
  ZoomOut,
  History,
  Focus,
  Unlink2,
  Hash,
  Link,
  Type,
} from 'lucide-vue-next';
</script>