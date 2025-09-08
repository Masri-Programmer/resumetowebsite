<template>
  <Sidebar>
    <SidebarContent>
      <SidebarGroup>
        <SidebarGroupLabel>Application</SidebarGroupLabel>
        <SidebarGroupAction>
          <Plus /> <span class="sr-only">Add Project</span>
        </SidebarGroupAction>
        <SidebarGroupContent></SidebarGroupContent>
      </SidebarGroup>
    </SidebarContent>
  </Sidebar>
</template>

<script setup lang="ts">
import {
  Sidebar,
  SidebarContent,
  SidebarGroupContent,
  SidebarGroupLabel,
  SidebarGroupAction,
} from '@/components/ui/sidebar'
</script>
<style scoped>

</style>