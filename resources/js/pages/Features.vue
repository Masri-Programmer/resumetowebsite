<script setup lang="ts">
import {
  DollarSign,
  Github,
  FileText,
  EyeOff,
  Server,
  Languages,
  BrainCircuit,
  Mail,
  ShieldCheck,
  LayoutTemplate,
  FileStack,
  Files,
  Palette,
  LayoutGrid,
  PlusSquare,
  NotebookText,
  Lock,
  FileCheck,
  Type,
  Globe,
  View,
  SunMoon,
  MoreHorizontal,
} from 'lucide-vue-next';
import { shallowRef, computed } from 'vue';
import Marquee from '@/components/ui/marquee/Marquee.vue';

const features = shallowRef([
  { text: 'Free, forever', icon: DollarSign },
  { text: 'Open Source', icon: Github },
  { text: 'MIT License', icon: FileText },
  { text: 'No user tracking or advertising', icon: EyeOff },
  { text: 'Self-Host with Docker', icon: Server },
  { text: 'Available in 50 languages', icon: Languages },
  { text: 'OpenAI Integration', icon: BrainCircuit },
  { text: 'Sign in with GitHub', icon: Github },
  { text: 'Sign in with Google', icon: Globe },
  { text: 'Sign in with Email', icon: Mail },
  { text: 'Secure with two-factor authentication', icon: ShieldCheck },
  { text: '12 resume templates to choose from', icon: LayoutTemplate },
  { text: 'Design single/multi page resumes', icon: FileStack },
  { text: 'Manage multiple resumes', icon: Files },
  { text: 'Customisable colour palettes', icon: Palette },
  { text: 'Customisable layouts', icon: LayoutGrid },
  { text: 'Custom resume sections', icon: PlusSquare },
  { text: 'Personal notes for each resume', icon: NotebookText },
  { text: 'Lock a resume to prevent editing', icon: Lock },
  { text: 'Supports A4/Letter page formats', icon: FileCheck },
  { text: 'Pick any font from Google Fonts', icon: Type },
  { text: 'Host your resume publicly', icon: Globe },
  { text: 'Track views and downloads', icon: View },
  { text: 'Light or dark theme', icon: SunMoon },
  { text: 'and many more...', icon: MoreHorizontal },
]);

// Split the features array into two halves for the two marquee rows
const firstHalf = computed(() => features.value.slice(0, Math.ceil(features.value.length / 2)));
const secondHalf = computed(() => features.value.slice(Math.ceil(features.value.length / 2)));
</script>

<template>
    <section id="Features" class="container mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 items-center gap-x-16 gap-y-10 lg:grid-cols-2">
        <div class="space-y-4 text-left">
          <h2 class="text-3xl font-bold tracking-tighter sm:text-5xl text-foreground">Rich in features, not in pricing.</h2>
          <p class="max-w-[900px] text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
            Resume to Website is a passion project, and with that comes a number of re-iterated ideas and features that have been
            built to (near) perfection.
          </p>
        </div>

        <div class="space-y-4">
          <Marquee pause-on-hover class="[--duration:60s]">
            <div
              v-for="(feature, index) in firstHalf"
              :key="`first-${index}`"
              class="flex items-center gap-2 rounded-lg bg-muted p-3 text-sm font-medium text-muted-foreground"
            >
              <component :is="feature.icon" class="h-4 w-4 flex-shrink-0" />
              <span>{{ feature.text }}</span>
            </div>
          </Marquee>
          <Marquee reverse pause-on-hover class="[--duration:60s]">
            <div
              v-for="(feature, index) in secondHalf"
              :key="`second-${index}`"
              class="flex items-center gap-2 rounded-lg bg-muted p-3 text-sm font-medium text-muted-foreground"
            >
              <component :is="feature.icon" class="h-4 w-4 flex-shrink-0" />
              <span>{{ feature.text }}</span>
            </div>
          </Marquee>
        </div>
      </div>
  </section>
</template>

