<template>
    <section class="flex min-h-screen w-full flex-col bg-background text-foreground">
        <div class="flex flex-1 items-center justify-center">
            <div class="container mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                <div class="grid w-full grid-cols-1 gap-8 lg:grid-cols-2">
                    <div class="flex flex-col items-start justify-center space-y-6">
                        <h1 class="text-5xl font-bold tracking-tighter sm:text-6xl xl:text-7xl/none">
                            A free and open-source resume builder
                        </h1>

                        <p class="max-w-prose text-muted-foreground md:text-xl">
                            A free and open-source resume builder that simplifies the process of creating, updating, and sharing your
                            resume.
                        </p>

                        <div class="flex gap-4">
                            <Link :href="login().url"><Button size="lg">Get Started</Button></Link>
                            <Button size="lg" variant="outline"
                                ><Book /><a
                                    href="https://github.com/Masri-Programmer/resumetowebsite.git"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="hover:underline"
                                    >Learn More</a
                                ></Button
                            >
                        </div>
                    </div>

                    <div class="flex items-center justify-center">
                        </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { login } from '@/routes';
import { Book } from 'lucide-vue-next';
</script>

<style scoped></style>