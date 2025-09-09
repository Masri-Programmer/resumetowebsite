<script setup lang="ts">
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/components/ui/accordion';
import { shallowRef } from 'vue';

const faqs = shallowRef([
  {
    question: 'Is this resume builder really free?',
    answer:
      'Yes, it is completely free and open-source. All features are available to everyone without any cost. If you find the project helpful, you can consider a donation to support its continued development.',
  },
  {
    question: 'Can I host my data on my own server?',
    answer:
      "Absolutely. We provide a Docker image that allows you to self-host the entire application. This gives you full ownership and control over your personal data. You can find the self-hosting guide in the project's documentation.",
  },
  {
    question: 'How many resumes can I create?',
    answer:
      'You can create and manage multiple resumes. This is perfect for tailoring your resume to different job applications and industries without having to start from scratch each time.',
  },
  {
    question: 'Can I import my data from LinkedIn?',
    answer:
      'Yes, we support importing your profile data directly from LinkedIn. We also support the JSON Resume standard, making it easy to migrate from other platforms.',
  },
]);
</script>

<template>
  <section id="Faq" class="w-full py-12 sm:py-16 md:py-20">
       <div class="container mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 items-center gap-x-16 gap-y-10 lg:grid-cols-2">
        <div class="space-y-4 text-left">
          <h2 class="text-3xl font-bold tracking-tighter text-secondary sm:text-5xl">Frequently Asked Questions</h2>
          <p class="max-w-[900px] text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
            Have questions? We've got answers. Here are some of the most common things people ask.
          </p>
        </div>

        <!-- Right Column: Accordion -->
        <div class="text-secondary">
          <Accordion type="single" collapsible class="w-full">
            <AccordionItem v-for="(faq, index) in faqs" :key="index" :value="`item-${index}`">
              <AccordionTrigger>{{ faq.question }}</AccordionTrigger>
              <AccordionContent>
                {{ faq.answer }}
              </AccordionContent>
            </AccordionItem>
          </Accordion>
        </div>
      </div>
    </div>
  </section>
</template>

