<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { CardBody, CardContainer, CardItem } from '@/components/ui/card-3d';
import InteractiveGridPattern from '@/components/ui/interactive-grid-pattern/InteractiveGridPattern.vue';
import ShimmerButton from '@/components/ui/shimmer-button/ShimmerButton.vue';
import TextGenerateEffect from '@/components/ui/text-generate-effect/TextGenerateEffect.vue';
import { login } from '@/routes';
import { Link } from '@inertiajs/vue3';
import { Book } from 'lucide-vue-next';
import resume from '../../images/resume.webp';
</script>

<template>
    <section class="relative flex min-h-screen w-full items-center justify-center overflow-hidden">
        <div class="container mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 z-10">
            <div class="z-10 grid w-full max-w-7xl grid-cols-1 items-center gap-8 lg:grid-cols-2">
                <div class="flex flex-col items-start justify-center space-y-6">
                    <h1 class="text-5xl font-bold tracking-tighter sm:text-6xl xl:text-7xl/none text-foreground">A free and open-source resume builder.</h1>

                    <p class="max-w-prose md:text-xl text-muted-foreground">
                        <TextGenerateEffect
                            words="A free and open-source resume builder that simplifies the process of creating, updating, and sharing your resume."
                        />
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <Link :href="login().url">
                            <ShimmerButton class="shadow-2xl" shimmer-size="2px">
                                <span
                                    class="text-center text-sm leading-none font-medium tracking-tight whitespace-pre-wrap text-white lg:text-lg dark:from-white dark:to-slate-900/10"
                                >
                                    Get Started
                                </span>
                            </ShimmerButton>
                        </Link>
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

                <div class="flex items-center justify-center">
                    <CardContainer>
                        <Link :href="login().url">
                            <CardBody
                                class="group/card relative size-auto rounded-xl border border-black/[0.1] bg-gray-50 p-6 sm:w-[30rem] dark:border-white/[0.2] dark:bg-black dark:hover:shadow-2xl dark:hover:shadow-emerald-500/[0.1]"
                            >
                                <CardItem :translate-z="100" class="mt-4 w-full">
                                    <img
                                        :src="resume"
                                        height="1000"
                                        width="1000"
                                        class="h-full w-full rounded-xl object-cover group-hover/card:shadow-xl"
                                        alt="thumbnail"
                                    />
                                </CardItem>
                            </CardBody>
                        </Link>
                    </CardContainer>
                </div>
            </div>
        </div>
        <InteractiveGridPattern
            class="absolute inset-0 h-full w-full skew-y-12 [mask-image:radial-gradient(1000px_circle_at_left_center,white,transparent)]"
        />
    </section>
</template>
