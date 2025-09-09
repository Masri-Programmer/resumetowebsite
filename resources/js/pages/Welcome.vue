<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import AOS from 'aos';
import 'aos/dist/aos.css';
import { nextTick, onMounted } from 'vue';
import Faq from './Faq.vue';
import Features from './Features.vue';
import Footer from './Footer.vue';
import Header from './Header.vue';
import Hero from './Hero.vue';
import Technologies from './Technologies.vue';
import Testimonials from './Testimonials.vue';

onMounted(() => {
    nextTick(() => {
        AOS.init({
            duration: 800,
            once: true,
        });
    });
});

router.on('success', () => {
    AOS.refresh();
});
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://masri.blog/" />
    </Head>
    <Header data-aos="fade-down" data-aos-delay="1000" />
    <main class="overflow-hidden bg-background text-foreground grid gap-4 sm:gap-6 md:gap-8 lg:gap-10 xl:gap-12">
        <Hero data-aos="fade-down" />
        <Features data-aos="fade-right" />
        <Testimonials data-aos="fade-left" />
        <Faq data-aos="fade-up" />
        <Technologies data-aos="fade-up" />
    </main>
    <Footer />
</template>
