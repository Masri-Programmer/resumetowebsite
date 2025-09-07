<template>
    <div class="resume-container font-sans leading-relaxed text-stone-900 bg-stone-100 dark:bg-stone-800 dark:text-neutral-300 overflow-x-hidden">
      <main class="resume-content max-w-4xl mx-auto p-6 bg-stone-50 shadow-md dark:bg-stone-950 overflow-hidden" role="document">
        <header class="resume-header border-b pb-3 mb-3">
          <div class="relative flex flex-col items-center gap-4 sm:flex-row sm:justify-start sm:gap-6 md:gap-10">
            <Avatar>
              <AvatarImage src="https://github.com/unovue.png" alt="@unovue" />
              <AvatarFallback>CN</AvatarFallback>
            </Avatar>
            <div class="grow w-full text-center sm:text-start">
              <h1 class="text-2xl font-bold md:text-3xl">Your Name</h1>
              <div class="flex flex-col items-center sm:flex-row sm:items-baseline w-full text-center md:text-start mt-1">
                <p>
                  City, Country |
                  <a target="_blank" href="mailto:your.email@example.com">your.email@example.com</a>
                  |
                  <a target="_blank" href="https://yourwebsite.com">www.yourwebsite.com</a>
                </p>
              </div>
            </div>
          </div>
        </header>
  
        <!-- Professional Summary Section -->
        <!-- <section id="summary" class="mb-4 md:mb-6 mt-3">
          <p class="italic text-center text-gray-700 dark:text-gray-400">
            A brief, professional summary or a statement that represents your work ethic.
          </p>
        </section> -->
  
        <!-- Work Experience Section -->
        <section id="work-experience" class="mb-4 md:mb-6 mt-3">
          <h2 class="text-xl font-semibold mb-2 title-font">Work Experience</h2>
          
          <div class="mb-6 mt-3">
            <h3 class="font-bold">
              <span>Job Title</span> – Company Name (Location/Remote)
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Month Year – Month Year</p>
            <ul class="list-disc ml-5 mt-2 text-sm space-y-1">
              <li>Description of your responsibility or achievement. Use action verbs.</li>
              <li>Another description of your responsibility or achievement.</li>
              <li>Quantify your impact whenever possible, e.g., "Increased efficiency by 20%."</li>
            </ul>
          </div>
  
          <div class="mb-6 mt-3">
            <h3 class="font-bold">Another Job Title – Another Company (Location/Remote)</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Month Year – Month Year</p>
            <ul class="list-disc ml-5 mt-2 text-sm space-y-1">
              <li>Responsibility or achievement.</li>
              <li>Responsibility or achievement.</li>
            </ul>
          </div>
        </section>
  
        <!-- Technical Skills Section -->
        <section id="technical-skills" class="mb-4 md:mb-6 mt-3">
          <h2 class="text-xl font-semibold mb-2">Technical Skills</h2>
          <div class="text-sm grid gap-4 grid-cols-1 sm:grid-cols-2 mt-2">
            <div>
              <h4 class="font-semibold">Frontend</h4>
              <ul class="list-disc ml-5 space-y-1">
                <li>Framework (e.g., React.js, Vue.js, Angular)</li>
                <li>JavaScript & TypeScript (ES6+)</li>
                <li>HTML5, CSS3 (e.g., Tailwind, SASS, Bootstrap)</li>
              </ul>
            </div>
            <div>
              <h4 class="font-semibold">Backend & Tools</h4>
              <ul class="list-disc ml-5 space-y-1">
                <li>Language/Framework (e.g., Laravel, PHP, Node.js)</li>
                <li>Database (e.g., SQL-MySQL, NoSQL-MongoDB)</li>
                <li>Version Control (e.g., Git/GitHub)</li>
                <li>Testing (e.g., Jest, Cypress)</li>
                <li>Dev Stack (e.g., LAMP)</li>
              </ul>
            </div>
            <div>
              <h4 class="font-semibold">Other</h4>
              <ul class="list-disc ml-5 space-y-1">
                <li>Python, Java, C++, etc.</li>
              </ul>
            </div>
            <div>
              <h4 class="font-semibold">Competences</h4>
              <ul class="list-disc ml-5 space-y-1">
                <li>Soft Skill 1 (e.g., Teamwork)</li>
                <li>Soft Skill 2 (e.g., Problem-solving)</li>
                <li>Soft Skill 3 (e.g., Communication)</li>
              </ul>
            </div>
          </div>
        </section>
  
        <!-- Education Section -->
        <section id="education" class="mb-4 md:mb-6 mt-3">
          <h2 class="text-xl font-semibold mb-2">Education</h2>
          <p>
            <strong><span>Degree Name (e.g., B.Sc. in Computer Science)</span></strong>
            <span class="text-sm text-gray-600 dark:text-gray-400"> - GPA: X.XX / 4.0</span>
          </p>
          <p class="text-sm mt-2">University Name, City, Country</p>
          <p class="text-sm mt-2">Relevant coursework or focus area.</p>
        </section>
  
        <!-- Academic Achievements Section -->
        <section id="academic-achievements" class="mb-4 md:mb-6 mt-3">
          <h2 class="text-xl font-semibold mb-2">Academic Achievements</h2>
          <ul class="list-disc ml-5 text-sm space-y-1">
            <li>Honors or awards (e.g., Dean's List).</li>
            <li>Relevant certifications or online courses completed.</li>
          </ul>
        </section>
  
        <!-- Additional Information Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <section id="projects" class="mb-4 md:mb-6 mt-3">
            <h2 class="text-xl font-semibold mb-2">Projects</h2>
            <p class="text-sm">
              <span>For a detailed overview, please visit my portfolio:</span>
              <a target="_blank" href="https://yourwebsite.com/projects" class="text-blue-500 underline hover:text-blue-600 dark:text-blue-300 dark:hover:text-blue-400" aria-label="View all projects (opens in a new tab)">
                www.yourwebsite.com/projects
              </a>
            </p>
          </section>
  
          <section id="languages" class="mb-4 md:mb-6 mt-3">
            <h2 class="text-xl font-semibold mb-2 title-font">Languages</h2>
            <ul class="ml-1 text-sm space-y-1 mt-1">
              <li><span>Language 1: Proficiency Level</span></li>
              <li><span>Language 2: Proficiency Level</span></li>
              <li><span>Language 3: Proficiency Level</span></li>
            </ul>
          </section>
  
          <section id="other-info" class="mb-4 md:mb-6 mt-3">
            <h2 class="text-xl font-semibold">Other</h2>
            <!-- Using a proper <ul> for semantic list structure -->
            <ul class="list-disc ml-5 text-sm mt-1 space-y-1">
              <li>Relevant information like willingness to travel or relocate.</li>
              <li>Another piece of relevant information.</li>
            </ul>
          </section>
  
          <section id="hobbies" class="mb-4 md:mb-6 mt-3">
            <h2 class="text-xl font-semibold">Hobbies</h2>
            <!-- Using a proper <ul> for semantic list structure -->
            <ul class="list-disc ml-5 text-sm mt-1 space-y-1">
              <li>Hobby 1</li>
              <li>Hobby 2</li>
              <li>Hobby 3</li>
            </ul>
          </section>
        </div>
        
      </main>
  
      <!-- Footer for print signature, now part of the normal document flow -->
      <footer class="resume-footer text-center py-6 text-xs text-gray-600 dark:text-gray-400">
          <div class="print-signature">
              <a href="https://yourwebsite.com" target="_blank" rel="noopener noreferrer">https://yourwebsite.com</a>
          </div>
      </footer>
  
  
      <!-- Floating Action Buttons for UI controls -->
      <div class="fixed top-4 right-4 flex flex-col space-y-3 no-print z-50">
        <Button @click="toggleTheme" variant="outline" size="icon" aria-label="Toggle Theme">
            <SunMoon class="w-5 h-5" />
        </Button>

        <Button @click="printWindow" variant="outline" size="icon" aria-label="Print Page">
            <Printer class="w-5 h-5" />
        </Button>

        <Button @click="downloadPdfHandler" variant="outline" size="icon" aria-label="Download Page as PDF">
            <Download class="w-5 h-5" />
        </Button>
    </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { onMounted } from 'vue';
  import { SunMoon, Printer, Download } from 'lucide-vue-next';
  import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
  import { Button } from '@/components/ui/button';
  
  // Component props definition
  const props = defineProps({
      parsed_data: Object,
  });
  
  /**
   * Sets the color theme on the document and stores the preference.
   * @param {'dark' | 'light'} theme - The theme to apply.
   */
  const setTheme = (theme: 'dark' | 'light') => {
      const htmlElement = document.documentElement;
      if (theme === "dark") {
          htmlElement.classList.add("dark");
      } else {
          htmlElement.classList.remove("dark");
      }
      localStorage.setItem("theme", theme);
  };
  
  
  /**
   * Toggles the current theme between light and dark.
   */
  const toggleTheme = () => {
      const isDark = document.documentElement.classList.contains("dark");
      setTheme(isDark ? "light" : "dark");
  };
  
  
  /**
   * Triggers the browser's print dialog.
   */
  const printWindow = () => {
      window.print();
  };
  
  /**
   * Generates and downloads a PDF of the resume content.
   * This function depends on `html2canvas` and `jspdf` being available in the global scope,
   * typically included via <script> tags in the main HTML file.
   */
  const downloadPdfHandler = () => {
    return
  };
  
  
  // On component mount, initialize the theme based on user preference or system settings.
  onMounted(() => {
      const storedTheme = localStorage.getItem("theme");
      const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
  
      if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
          setTheme("dark");
      } else {
          setTheme("light");
      }
  });
  </script>
  
  <style>

@import './style.css';
  
  /* Print-specific styles */
  @media print {
      .no-print {
          display: none !important;
      }
  
      body {
          background-color: #fff; /* Ensure a white background for printing */
      }
  
      /* Use class selector for lower specificity and better reusability */
      .resume-content {
          box-shadow: none;
          margin: 0;
          max-width: 100%;
          border: none;
      }
  }
  
  /* Hides elements specifically during the PDF export process */
  .pdf-export-active .no-print {
      display: none;
  }
  </style>
  