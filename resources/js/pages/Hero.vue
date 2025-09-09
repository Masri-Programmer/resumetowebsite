<script setup lang="ts">
import { Button } from '@/components/ui/button';
import InteractiveGridPattern from '@/components/ui/interactive-grid-pattern/InteractiveGridPattern.vue';
import ShimmerButton from '@/components/ui/shimmer-button/ShimmerButton.vue';
import { login } from '@/routes';
import { Link } from '@inertiajs/vue3';
import { Book } from 'lucide-vue-next';
</script>

<template>
    <section class="relative flex min-h-screen w-full items-center justify-center overflow-hidden">
        <div class="z-10 container mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid w-full max-w-7xl grid-cols-1 items-center gap-8 lg:grid-cols-2">
                <div class="flex flex-col items-start justify-center space-y-6">
                    <h1 class="text-5xl font-bold tracking-tighter sm:text-6xl xl:text-7xl/none">A free and open-source resume builder</h1>

                    <p class="max-w-prose text-muted-foreground md:text-xl">
                        A free and open-source resume builder that simplifies the process of creating, updating, and sharing your resume.
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <ShimmerButton class="shadow-2xl" shimmer-size="2px">
                            <span
                                class="text-center text-sm leading-none font-medium tracking-tight whitespace-pre-wrap text-white lg:text-lg dark:from-white dark:to-slate-900/10"
                            >
                                <Link :href="login().url"> Get Started </Link>
                            </span>
                        </ShimmerButton>
                        <Button
                            as="a"
                            href="https://github.com/Masri-Programmer/resumetowebsite.git"
                            target="_blank"
                            rel="noopener noreferrer"
                            size="lg"
                            class="rounded-full"
                            variant="secondary"
                        >
                            <Book class="mr-2 h-4 w-4" />
                            Learn More
                        </Button>
                    </div>
                </div>

                <div class="flex items-center justify-center"></div>
            </div>
        </div>
        <InteractiveGridPattern
            class="absolute inset-0 h-full w-full skew-y-12 [mask-image:radial-gradient(1000px_circle_at_left_center,white,transparent)]"
        />
    </section>
</template>
