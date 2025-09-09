<script setup lang="ts">
import { Star } from 'lucide-vue-next';
import { shallowRef } from 'vue';

const testimonials = shallowRef([
  {
    name: 'Sarah Dayan',
    handle: '@sarah_dayan',
    avatar: 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=250&h=250&auto=format&fit=crop',
    text: 'Reactive Resume has been a game-changer for my job applications. The templates are modern and professional, and the OpenAI integration for summaries is pure magic!',
    rating: 5,
  },
  {
    name: 'Alex Johnson',
    handle: '@alex_dev',
    avatar: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?q=80&w=250&h=250&auto=format&fit=crop',
    text: "As a developer, I love that it's open-source and I can host it myself. The interface is clean, fast, and incredibly intuitive. Best resume builder I've ever used.",
    rating: 5,
  },
  {
    name: 'Maria Garcia',
    handle: '@maria_designs',
    avatar: 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=250&h=250&auto=format&fit=crop',
    text: 'The ability to manage multiple resumes and track views has been invaluable. It simplifies the whole process, from creation to sharing. Highly recommended!',
    rating: 5,
  },
]);
</script>

<template>
  <section id="Testimonials" class="w-full py-12 md:py-24 lg:py-32">
    <div class="container mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
      <div class="flex flex-col items-center text-center">
        <h1 class="text-4xl font-semibold leading-none">What our customers are saying about us</h1>
      </div>
      <div class="mx-auto mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        <div v-for="testimonial in testimonials" :key="testimonial.handle" class="rounded p-6 shadow-md dark:bg-gray-800">
          <div class="flex items-center space-x-4">
            <div>
              </div>
          </div>
          <div class="relative">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"
              fill="currentColor"
              class="absolute left-0 top-0 h-8 w-8 dark:text-gray-300"
            >
              <path d="M232,246.857V16H16V416H54.4ZM48,48H200V233.143L48,377.905Z" />
              <path d="M280,416h38.4L496,246.857V16H280ZM312,48H464V233.143L312,377.905Z" />
            </svg>
            <blockquote class="px-12 py-1 text-base italic">{{ testimonial.text }} - {{ testimonial.name }}</blockquote>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"
              fill="currentColor"
              class="absolute bottom-0 right-0 h-8 w-8 dark:text-gray-300"
            >
              <path d="M280,185.143V416H496V16H457.6ZM464,384H312V198.857L464,54.1Z" />
              <path d="M232,16H193.6L16,185.143V416H232ZM200,384H48V198.857L200,54.1Z" />
            </svg>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>