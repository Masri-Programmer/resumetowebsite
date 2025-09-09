<script setup lang="ts">
import AppearanceIcon from '@/components/AppearanceIcon.vue';
import LanguageSwitch from '@/components/LanguageSwitch.vue'; // Assuming this component exists
import Button from '@/components/ui/button/Button.vue';
import { Book, Github, Heart } from 'lucide-vue-next';
import { shallowRef } from 'vue';

const links = shallowRef({
    product: [
        { text: 'Features', href: '#Features' },
        { text: 'Testimonials', href: '#Testimonials' },
        { text: 'Faq', href: '#Faq' },
    ],
    community: [{ text: 'GitHub', href: 'https://github.com/Masri-Programmer/resumetowebsite.git' }],
    legal: [
        { text: 'Privacy Policy', href: '#' },
        { text: 'Terms of Service', href: '#' },
    ],
});

const year = new Date().getFullYear();
</script>

<template>
    <footer class="w-full border-t border-border bg-background">
        <div class="container mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                <div class="col-span-2 flex flex-col items-start gap-4 md:col-span-1">
                    <div class="flex items-center gap-2">
                        <Book class="h-6 w-6" />
                        <span class="text-lg font-semibold">Resume To Website</span>
                    </div>
                    <p class="text-sm">A free and open-source resume builder.</p>
                </div>

                <div class="space-y-4">
                    <h4 class="font-semibold">Product</h4>
                    <ul class="space-y-2">
                        <li v-for="link in links.product" :key="link.text">
                            <a :href="link.href" class="text-sm hover:text-foreground">{{ link.text }}</a>
                        </li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h4 class="font-semibold">Community</h4>
                    <ul class="space-y-2">
                        <li v-for="link in links.community" :key="link.text">
                            <a :href="link.href" class="text-sm hover:text-foreground" target="_blank" rel="noopener noreferrer">{{ link.text }}</a>
                        </li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h4 class="font-semibold">Legal</h4>
                    <ul class="space-y-2">
                        <li v-for="link in links.legal" :key="link.text">
                            <a :href="link.href" class="text-sm hover:text-foreground">{{ link.text }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="border-t border-border py-4">
            <div class="container mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-4 sm:flex-row sm:px-6 lg:px-8">
                <p class="text-sm text-muted-foreground">&copy; {{ year }} Resume To Website. All rights reserved.</p>

                <p class="flex items-center gap-1.5 text-center text-sm">
                    Made with <Heart class="h-4 w-4 fill-red-500 text-red-500" /> by
                    <a href="https://masri.blog" target="_blank" rel="noopener noreferrer" class="font-medium hover:underline">Mohamad Masri</a>.
                </p>

                <!-- Right: Icons -->
                <div class="flex items-center gap-4">
                    <Button variant="ghost" size="icon">
                        <a
                            href="https://github.com/Masri-Programmer/resumetowebsite.git"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="GitHub Repository"
                        >
                            <Github class="h-5 w-5 hover:text-foreground" />
                        </a>
                    </Button>
                    <AppearanceIcon />
                    <LanguageSwitch />
                </div>
            </div>
        </div>
    </footer>
</template>
