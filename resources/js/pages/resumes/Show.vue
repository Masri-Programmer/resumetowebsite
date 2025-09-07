<template>
    <div v-if="parsed_data?.data" class="resume-container py-6 font-sans leading-relaxed text-stone-900 bg-stone-100 dark:bg-stone-800 dark:text-neutral-300 overflow-x-hidden">
      <main class="resume-content max-w-4xl mx-auto p-6 bg-stone-50 shadow-md dark:bg-stone-950 overflow-hidden" role="document">
        <header class="resume-header border-b pb-3 mb-3">
          <div class="relative flex flex-col items-center gap-4 sm:flex-row sm:justify-start sm:gap-6 md:gap-10">
            <Avatar>
              <AvatarImage src="https://github.com/unovue.png" alt="@unovue" />
              <AvatarFallback>
                {{ getInitials(parsed_data.data.personalInfo[0].firstName, parsed_data.data.personalInfo[0].lastName) }}
              </AvatarFallback>
            </Avatar>
            <div class="grow w-full text-center sm:text-start">
              <h1 class="text-2xl font-bold md:text-3xl">
                {{ parsed_data.data.personalInfo[0].firstName }} {{ parsed_data.data.personalInfo[0].lastName }}
              </h1>
              <div class="flex flex-col items-center sm:flex-row sm:items-baseline w-full text-center md:text-start mt-1">
                <p>
                  {{ parsed_data.data.location[0].city }}, {{ parsed_data.data.location[0].country }} |
                  <a target="_blank" :href="`mailto:${parsed_data.data.personalInfo[0].email}`">{{ parsed_data.data.personalInfo[0].email }}</a>
                  |
                  <a target="_blank" :href="parsed_data.data.personalInfo[0].website">{{ parsed_data.data.personalInfo[0].website }}</a>
                </p>
              </div>
            </div>
          </div>
        </header>

        <section id="work-experience" class="mb-4 md:mb-6 mt-3">
          <h2 class="text-xl font-semibold mb-2 title-font">Work Experience</h2>

          <div v-for="(job, index) in parsed_data.data.workExperience" :key="index" class="mb-6 mt-3">
            <h3 class="font-bold">
              <span>{{ job.role }}</span> – {{ job.company }}
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ formatDate(job.startDate) }} – {{ formatDate(job.endDate) }}
            </p>
            <ul class="list-disc ml-5 mt-2 text-sm space-y-1">
              <li>{{ job.description }}</li>
            </ul>
          </div>
        </section>

        <section id="technical-skills" class="mb-4 md:mb-6 mt-3">
          <h2 class="text-xl font-semibold mb-2">Technical Skills</h2>
          <ul class="list-disc ml-5 space-y-1 text-sm mt-2">
              <li v-for="(skill, index) in parsed_data.data.skills" :key="index">
                {{ skill.skill }}
              </li>
          </ul>
        </section>

        <section id="education" class="mb-4 md:mb-6 mt-3" v-if="parsed_data.data.education.length">
          <h2 class="text-xl font-semibold mb-2">Education</h2>
          <div v-for="(edu, index) in parsed_data.data.education" :key="index">
              <p>
                <strong><span>{{ edu.degree }}</span></strong>
              </p>
              <p class="text-sm mt-2">{{ edu.institution }}</p>
              <p class="text-sm mt-1 text-gray-600 dark:text-gray-400">Graduated: {{ formatDate(edu.graduationDate) }}</p>
              <p class="text-sm mt-2">{{ edu.details }}</p>
          </div>
        </section>

        <section id="academic-achievements" class="mb-4 md:mb-6 mt-3" v-if="parsed_data.data.achievements.length">
          <h2 class="text-xl font-semibold mb-2">Academic Achievements</h2>
          <ul class="list-disc ml-5 text-sm space-y-1">
            <li v-for="(item, index) in parsed_data.data.achievements" :key="index">
                {{ item.achievement }}
            </li>
          </ul>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <section id="projects" class="mb-4 md:mb-6 mt-3" v-if="parsed_data.data.projects.length">
            <h2 class="text-xl font-semibold mb-2">Projects</h2>
            <ul class="list-disc ml-5 text-sm space-y-1">
                <li v-for="(project, index) in parsed_data.data.projects" :key="index">
                    {{ project.project }}
                </li>
            </ul>
            <p class="text-sm mt-2">
              <span>For a detailed overview, please visit my portfolio:</span>
              <a target="_blank" :href="parsed_data.data.personalInfo[0].website" class="text-blue-500 underline hover:text-blue-600 dark:text-blue-300 dark:hover:text-blue-400" aria-label="View all projects (opens in a new tab)">
                {{ parsed_data.data.personalInfo[0].website }}
              </a>
            </p>
          </section>

          <section id="languages" class="mb-4 md:mb-6 mt-3">
            <h2 class="text-xl font-semibold mb-2 title-font">Languages</h2>
            <ul class="ml-1 text-sm space-y-1 mt-1">
              <li><span>English: Professional Proficiency</span></li>
              <li><span>German: Elementary Proficiency</span></li>
            </ul>
          </section>

          <section id="social-links" class="mb-4 md:mb-6 mt-3" v-if="parsed_data.data.socialLinks.length">
            <h2 class="text-xl font-semibold">Social Links</h2>
            <ul class="list-disc ml-5 text-sm mt-1 space-y-1">
                <li v-if="parsed_data.data.socialLinks[0].github">GitHub: {{ parsed_data.data.socialLinks[0].github }}</li>
                <li v-if="parsed_data.data.socialLinks[0].linkedin">LinkedIn: {{ parsed_data.data.socialLinks[0].linkedin }}</li>
                <li v-if="parsed_data.data.socialLinks[0].twitter">Twitter: {{ parsed_data.data.socialLinks[0].twitter }}</li>
                <li v-if="parsed_data.data.socialLinks[0].instagram">Instagram: {{ parsed_data.data.socialLinks[0].instagram }}</li>
                <li v-if="parsed_data.data.socialLinks[0].other">Other: {{ parsed_data.data.socialLinks[0].other }}</li>
            </ul>
          </section>

          <section id="hobbies" class="mb-4 md:mb-6 mt-3" v-if="parsed_data.data.hobbies.length">
            <h2 class="text-xl font-semibold">Hobbies</h2>
            <ul class="list-disc ml-5 text-sm mt-1 space-y-1">
              <li v-for="(hobby, index) in parsed_data.data.hobbies" :key="index">
                  {{ hobby.hobby }}
              </li>
            </ul>
          </section>
        </div>

      </main>

      <footer class="resume-footer text-center text-xs text-gray-600 dark:text-gray-400">
          <div class="print-signature">
              <a :href="parsed_data.data.personalInfo[0].website" target="_blank" rel="noopener noreferrer">{{ parsed_data.data.personalInfo[0].website }}</a>
          </div>
      </footer>


      <div class="fixed top-4 right-4 flex flex-col space-y-3 no-print z-50">
        <Button @click="toggleAppearance" variant="outline" size="icon" :aria-label="`Toggle theme, current is ${appearance}`">
        <component :is="currentIcon" class="w-5 h-5" />
    </Button>
     
        <Button @click="printWindow" variant="outline" size="icon" aria-label="Print Page">
            <Printer class="w-5 h-5" />
        </Button>

        <Button @click="downloadPdfHandler" variant="outline" size="icon" aria-label="Download Page as PDF">
            <Download class="w-5 h-5" />
        </Button>
    </div>
    </div>
    <div v-else class="text-center p-10">
        Loading data...
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { Printer, Download, Monitor, Moon, Sun  } from 'lucide-vue-next';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import { useAppearance } from '@/composables/useAppearance';

const props = defineProps({
    parsed_data: Object,
});

const { appearance, updateAppearance } = useAppearance();


const tabs = [
    { value: 'light', Icon: Sun, label: 'Light' },
    { value: 'dark', Icon: Moon, label: 'Dark' },
    { value: 'system', Icon: Monitor, label: 'System' },
    ] as const;

    const currentIcon = computed(() => {
  const current = tabs.find(tab => tab.value === appearance.value);
  return current ? current.Icon : Monitor;
});

const toggleAppearance = () => {
  const currentIndex = tabs.findIndex(tab => tab.value === appearance.value);
  const nextIndex = (currentIndex + 1) % tabs.length;
  updateAppearance(tabs[nextIndex].value);
};
const formatDate = (dateString: string | null): string => {
    if (!dateString) return 'Present';
    const options: Intl.DateTimeFormatOptions = { year: 'numeric', month: 'long' };
    return new Date(dateString).toLocaleDateString(undefined, options);
};

const getInitials = (firstName: string, lastName: string): string => {
    return `${firstName?.charAt(0) || ''}${lastName?.charAt(0) || ''}`.toUpperCase();
};

const printWindow = () => {
    window.print();
};

const downloadPdfHandler = () => {
    alert('PDF download functionality not yet implemented.');
};
</script>

<style>
@import './style.css';

@media print {
    .no-print {
        display: none !important;
    }

    body {
        background-color: #fff;
    }

    .resume-content {
        box-shadow: none;
        margin: 0;
        max-width: 100%;
        border: none;
    }
}
</style>