<script setup lang="ts">
import { Github, Twitter, Book, Heart } from 'lucide-vue-next';
import { shallowRef } from 'vue';

const links = shallowRef({
  product: [
    { text: 'Features', href: '#Features' },
    { text: 'Testimonials', href: '#Testimonials' },
    { text: 'Faq', href: '#Faq' },
    // { text: 'Pricing', href: '#Pricing' },
    // { text: 'Templates', href: '#Templates' },
    // { text: 'Changelog', href: '#Changelog' },
  ],
  community: [
    { text: 'GitHub', href: 'https://github.com/Masri-Programmer/resumetowebsite.git' },
    // { text: 'Twitter', href: '#' },
    // { text: 'Discord', href: '#' },
  ],
  legal: [
    { text: 'Privacy Policy', href: '#' },
    { text: 'Terms of Service', href: '#' },
  ],
});

const year = new Date().getFullYear();
</script>

<template>
  <footer class="w-full border-t border-border bg-primary">
    <div class="container mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
        <div class="col-span-2 flex flex-col items-start gap-4 md:col-span-1">
          <div class="flex items-center gap-2">
            <Book class="h-6 w-6" />
            <span class="text-lg font-semibold">Resume To Website</span>
          </div>
          <p class="text-sm text-muted-foreground">A free and open-source resume builder.</p>
        </div>

        <div class="space-y-4">
          <h4 class="font-semibold">Product</h4>
          <ul class="space-y-2">
            <li v-for="link in links.product" :key="link.text">
              <a :href="link.href" class="text-sm text-muted-foreground hover:text-foreground">{{ link.text }}</a>
            </li>
          </ul>
        </div>
        <div class="space-y-4">
          <h4 class="font-semibold">Community</h4>
          <ul class="space-y-2">
            <li v-for="link in links.community" :key="link.text">
              <a :href="link.href" class="text-sm text-muted-foreground hover:text-foreground" target="_blank">{{
                link.text
              }}</a>
            </li>
          </ul>
        </div>
        <div class="space-y-4">
          <h4 class="font-semibold">Legal</h4>
          <ul class="space-y-2">
            <li v-for="link in links.legal" :key="link.text">
              <a :href="link.href" class="text-sm text-muted-foreground hover:text-foreground">{{ link.text }}</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="mt-12 flex flex-col items-center justify-between border-t border-border pt-8 sm:flex-row">
        <p class="flex items-center gap-1.5 text-center text-sm text-muted-foreground">
          Made with <Heart class="h-4 w-4 fill-red-500 text-red-500" /> by
          <a href="https://masri.blog" target="_blank" class="font-medium hover:underline">Mohamad Masri</a>.
        </p>
        <div class="mt-4 flex items-center gap-4 sm:mt-0">
          <a href="https://github.com/Masri-Programmer/resumetowebsite.git" target="_blank">
            <Github class="h-5 w-5 text-muted-foreground hover:text-foreground" />
          </a>
          <a href="#" target="_blank">
            <Twitter class="h-5 w-5 text-muted-foreground hover:text-foreground" />
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>