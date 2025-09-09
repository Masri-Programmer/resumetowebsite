<template>
  <TooltipProvider :delay-duration="100">
    <div class="flex flex-shrink-0 items-center space-x-1">
      <Tooltip>
        <TooltipTrigger as-child>
          <Button @click="publishResume(id as number)" variant="ghost" size="icon" class="h-8 w-8">
            <Globe class="h-4 w-4" />
          </Button>
        </TooltipTrigger>
        <TooltipContent>
          <p>Publish Resume</p>
        </TooltipContent>
      </Tooltip>

      <Tooltip>
        <TooltipTrigger as-child>
          <Link :href="show.url((id as number).toString())">
            <Button variant="ghost" size="icon" class="h-8 w-8">
              <ExternalLink class="h-4 w-4" />
            </Button>
          </Link>
        </TooltipTrigger>
        <TooltipContent>
          <p>View Resume</p>
        </TooltipContent>
      </Tooltip>

      <Tooltip>
        <TooltipTrigger as-child>
          <Link :href="edit.url((id as number).toString())">
            <Button variant="ghost" size="icon" class="h-8 w-8">
              <Pencil class="h-4 w-4" />
            </Button>
          </Link>
        </TooltipTrigger>
        <TooltipContent>
          <p>Edit Resume</p>
        </TooltipContent>
      </Tooltip>

      <Tooltip>
        <TooltipTrigger as-child>
          <Link :href="destroy.url((id as number).toString())" method="delete" as="button" :onBefore="confirmDelete" preserve-scroll>
            <Button variant="ghost" size="icon" class="h-8 w-8 text-red-500 hover:text-red-600">
              <Trash2 class="h-4 w-4" />
            </Button>
          </Link>
        </TooltipTrigger>
        <TooltipContent>
          <p>Delete Resume</p>
        </TooltipContent>
      </Tooltip>
      </div>
  </TooltipProvider>
</template>

<script setup lang="ts">
import { ExternalLink, Pencil, Trash2, Globe } from 'lucide-vue-next';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { destroy, edit, show } from '@/routes/resumes';
import { Button } from '@/components/ui/button';
import {  Link } from '@inertiajs/vue3';


defineProps({
    id: Number,
});

const confirmDelete = () => {
    return window.confirm('Are you sure you want to delete this resume?');
};

const publishResume = (id : number) => {
 return alert(id+ ' publish feature not implemented yet');
};
</script>