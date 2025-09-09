<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Faq from './Faq.vue';
import Features from './Features.vue';
import Footer from './Footer.vue';
import Hero from './Hero.vue';
import Testimonials from './Testimonials.vue';
import { CardContainer, CardBody, CardItem } from "@/components/ui/card-3d";
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://masri.blog/" />
    </Head>
    <header class="bg-secondary p-2 text-center text-sm text-primary">
        If this project has helped you, please consider donating to Resume to Website...
    </header>
    <ClientOnly>
    <CardContainer>
      <CardBody
        class="group/card relative size-auto rounded-xl border border-black/[0.1] bg-gray-50 p-6 sm:w-[30rem] dark:border-white/[0.2] dark:bg-black dark:hover:shadow-2xl dark:hover:shadow-emerald-500/[0.1]"
      >
        <CardItem
          :translate-z="50"
          class="text-xl font-bold text-neutral-600 dark:text-white"
        >
          Make things float in air
        </CardItem>
        <CardItem
          as="p"
          translate-z="60"
          class="mt-2 max-w-sm text-sm text-neutral-500 dark:text-neutral-300"
        >
          Hover over this card to unleash the power of CSS perspective
        </CardItem>
        <CardItem
          :translate-z="100"
          class="mt-4 w-full"
        >
          <img
            src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=2560&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            height="1000"
            width="1000"
            class="h-60 w-full rounded-xl object-cover group-hover/card:shadow-xl"
            alt="thumbnail"
          />
        </CardItem>
        <div class="mt-20 flex items-center justify-between">
          <CardItem
            :translate-z="20"
            as="a"
            href="https://rahulv.dev"
            target="__blank"
            class="rounded-xl px-4 py-2 text-xs font-normal dark:text-white"
          >
            Visit →
          </CardItem>
          <CardItem
            :translate-z="20"
            as="button"
            class="rounded-xl bg-black px-4 py-2 text-xs font-bold text-white dark:bg-white dark:text-black"
          >
            Get Started
          </CardItem>
        </div>
      </CardBody>
    </CardContainer>
  </ClientOnly>
    <main class="bg-primary text-secondary">
        <Hero />
        <Features />
        <Testimonials />
        <Faq />
    </main>
    <Footer />
</template>
