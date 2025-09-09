<script setup lang="ts">
// import { Star } from 'lucide-vue-next';
import { shallowRef } from 'vue';

const testimonials = shallowRef([
  {
    name: 'Sarah Dayan',
    handle: '@sarah_dayan',
    avatar: 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=250&h=250&auto=format&fit=crop',
    text: 'This has been a game-changer for my job hunt. The modern templates and the OpenAI summary integration are pure magic. This tool has completely streamlined my application process.',
    rating: 5,
  },
  {
    name: 'Alex Johnson',
    handle: '@alex_dev',
    avatar: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?q=80&w=250&h=250&auto=format&fit=crop',
    text: "What I love most is that it's open-source. As a developer, self-hosting is a huge plus. The interface is incredibly intuitive, clean, and fast. Hands down, the best resume builder I've used.",
    rating: 5,
  },
  {
    name: 'Maria Garcia',
    handle: '@maria_designs',
    avatar: 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=250&h=250&auto=format&fit=crop',
    text: 'This tool has made managing my job search so much easier. Being able to create multiple resumes and track which ones get viewed is invaluable. Highly recommended for simplifying the whole process.',
    rating: 5,
  },
]);
</script>

<template>
    <section id="Testimonials" class="container mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
      <div class="flex flex-col items-center text-center">
        <h3 class="text-3xl font-bold tracking-tighter sm:text-5xl text-foreground">What our customers are saying about us</h3>
      </div>
      <div class="mx-auto mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        <div v-for="testimonial in testimonials" :key="testimonial.handle" class="rounded p-6 shadow-md ">
          <div class="flex items-center space-x-4">
            <div>
              </div>
          </div>
          <div class="relative">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"
              fill="currentColor"
              class="absolute left-0 top-0 h-8 w-8"
            >
              <path d="M232,246.857V16H16V416H54.4ZM48,48H200V233.143L48,377.905Z" />
              <path d="M280,416h38.4L496,246.857V16H280ZM312,48H464V233.143L312,377.905Z" />
            </svg>
            <blockquote class="px-12 py-1 text-base italic text-muted-foreground">{{ testimonial.text }} - {{ testimonial.name }}</blockquote>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"
              fill="currentColor"
              class="absolute bottom-0 right-0 h-8 w-8"
            >
              <path d="M280,185.143V416H496V16H457.6ZM464,384H312V198.857L464,54.1Z" />
              <path d="M232,16H193.6L16,185.143V416H232ZM200,384H48V198.857L200,54.1Z" />
            </svg>
          </div>
        </div>
      </div>
    </section>
</template>