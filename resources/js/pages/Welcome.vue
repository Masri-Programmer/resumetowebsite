<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Faq from './Faq.vue';
import Features from './Features.vue';
import Footer from './Footer.vue';
import Hero from './Hero.vue';
import Testimonials from './Testimonials.vue';
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://masri.blog/" />
    </Head>
    <header class="bg-primary p-2 text-center text-sm text-primary-foreground">
        If this project has helped you, please consider donating to Resume to Website...
    </header>
    <main>
        <Hero />
        <Features />
        <Testimonials />
        <Faq />
    </main>
    <Footer />
</template>
