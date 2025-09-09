<script setup lang="ts">
import {
    ResizableHandle,
    ResizablePanel,
    ResizablePanelGroup,
} from '@/components/ui/resizable'
import { Sidebar, SidebarContent } from '@/components/ui/sidebar';
</script>

<template>
    <ResizablePanelGroup direction="horizontal" class="min-h-screen w-full">
        <ResizablePanel :default-size="20" :min-size="15" :max-size="30">
            <!-- 
                This sidebar is designed for a detail/show page.
                It's simpler than the main AppSidebar, focusing on in-page navigation.
            -->
            <Sidebar variant="inset" class="h-full">
                <SidebarContent>
                  sadsada
                    <!-- <NavMain :items="showPageNavItems" /> -->
                </SidebarContent>
            </Sidebar>
        </ResizablePanel>
        <ResizableHandle with-handle />
        <ResizablePanel :default-size="80">
            <div class="p-6">
                <slot />
            </div>
        </ResizablePanel>
    </ResizablePanelGroup>
</template>

