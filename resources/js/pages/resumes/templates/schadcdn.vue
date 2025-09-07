<template>
    <div id="pdf-content" class="bg-background text-foreground font-sans leading-relaxed">
      <div id="resumeContent" class="max-w-4xl mx-auto p-4 sm:p-6 space-y-6">
        <header id="header" class="flex flex-col items-center gap-4 sm:flex-row sm:justify-start sm:gap-6 md:gap-10">
          <Avatar class="w-24 h-24">
            <AvatarImage src="https://github.com/unovue.png" alt="@unovue" />
            <AvatarFallback>CN</AvatarFallback>
          </Avatar>
          <div class="grow w-full text-center sm:text-start">
            <h1 class="text-3xl font-bold md:text-4xl">
              Your Name
            </h1>
            <p class="text-muted-foreground mt-2">
              City, Country |
              <a href="mailto:your.email@example.com" class="hover:underline">your.email@example.com</a>
              |
              <a href="https://yourwebsite.com" target="_blank" rel="noopener noreferrer" class="hover:underline">yourwebsite.com</a>
            </p>
          </div>
        </header>
  
        <Separator />
  
        <Card id="work-experience">
          <CardHeader>
            <CardTitle>Work Experience</CardTitle>
          </CardHeader>
          <CardContent class="space-y-6">
            <div>
              <h3 class="font-semibold">
                Job Title – Company Name (Location/Remote)
              </h3>
              <p class="text-sm text-muted-foreground">Month Year – Month Year</p>
              <ul class="list-disc ml-5 mt-2 text-sm space-y-1">
                <li>Description of your responsibility or achievement. Use action verbs.</li>
                <li>Another description of your responsibility or achievement.</li>
                <li>Quantify your impact whenever possible, e.g., "Increased efficiency by 20%."</li>
              </ul>
            </div>
            <div>
              <h3 class="font-semibold">Another Job Title – Another Company (Location/Remote)</h3>
              <p class="text-sm text-muted-foreground">Month Year – Month Year</p>
              <ul class="list-disc ml-5 mt-2 text-sm space-y-1">
                <li>Responsibility or achievement.</li>
                <li>Responsibility or achievement.</li>
              </ul>
            </div>
          </CardContent>
        </Card>
  
        <Card id="technical-skills">
          <CardHeader>
            <CardTitle>Technical Skills</CardTitle>
          </CardHeader>
          <CardContent class="grid sm:grid-cols-2 gap-6 text-sm">
            <div class="space-y-4">
              <div>
                <h4 class="font-semibold mb-2">
                  Frontend
                </h4>
                <ul class="list-disc ml-5 space-y-1">
                  <li>Vue.js (Vue 3, Composition API)</li>
                  <li>Inertia.js</li>
                  <li>JavaScript & TypeScript (ES6+)</li>
                  <li>HTML5, CSS3 (Tailwind CSS, SASS)</li>
                </ul>
              </div>
              <div>
                <h4 class="font-semibold mb-2">
                  Competences
                </h4>
                <ul class="list-disc ml-5 space-y-1">
                  <li>Teamwork & Collaboration</li>
                  <li>Agile Methodologies</li>
                  <li>Problem-solving</li>
                </ul>
              </div>
            </div>
            <div class="space-y-4">
              <div>
                <h4 class="font-semibold mb-2">
                  Backend & Tools
                </h4>
                <ul class="list-disc ml-5 space-y-1">
                  <li>Laravel, PHP</li>
                  <li>Database (MySQL)</li>
                  <li>Version Control (Git/GitHub)</li>
                  <li>Testing (Pest, Vitest)</li>
                  <li>Dev Stack (LAMP)</li>
                </ul>
              </div>
            </div>
          </CardContent>
        </Card>
  
        <div class="grid md:grid-cols-2 gap-6">
          <Card id="education">
            <CardHeader>
              <CardTitle>Education</CardTitle>
            </CardHeader>
            <CardContent>
              <p class="font-semibold">
                Degree Name (e.g., B.Sc. in Computer Science)
              </p>
              <p class="text-sm text-muted-foreground">
                University Name, City, Country
              </p>
              <p class="text-sm mt-2">
                Relevant coursework or focus area.
              </p>
            </CardContent>
          </Card>
          <Card id="academic-achievements">
            <CardHeader>
              <CardTitle>Academic Achievements</CardTitle>
            </CardHeader>
            <CardContent>
              <ul class="list-disc ml-5 text-sm space-y-1">
                <li>Honors or awards (e.g., Dean's List).</li>
                <li>Relevant certifications or online courses completed.</li>
              </ul>
            </CardContent>
          </Card>
        </div>
  
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          <Card id="projects">
            <CardHeader>
              <CardTitle>Projects</CardTitle>
            </CardHeader>
            <CardContent class="text-sm">
              <p>For a detailed overview, please visit my portfolio:</p>
            </CardContent>
          </Card>
          <Card id="languages">
            <CardHeader>
              <CardTitle>Languages</CardTitle>
            </CardHeader>
            <CardContent>
              <ul class="text-sm space-y-1">
                <li>Language 1: Proficiency Level</li>
                <li>Language 2: Proficiency Level</li>
                <li>Language 3: Proficiency Level</li>
              </ul>
            </CardContent>
          </Card>
          <Card id="other-info">
            <CardHeader>
              <CardTitle>Other</CardTitle>
            </CardHeader>
            <CardContent>
              <ul class="list-disc ml-5 text-sm space-y-1">
                <li>Willingness to travel or relocate.</li>
                <li>Another piece of relevant information.</li>
              </ul>
            </CardContent>
          </Card>
          <Card id="hobbies">
            <CardHeader>
              <CardTitle>Hobbies</CardTitle>
            </CardHeader>
            <CardContent>
              <ul class="list-disc ml-5 text-sm space-y-1">
                <li>Hobby 1</li>
                <li>Hobby 2</li>
                <li>Hobby 3</li>
              </ul>
            </CardContent>
          </Card>
        </div>
  
        <blockquote class="text-center italic text-muted-foreground pt-4">
          "A brief, professional summary or a quote that represents your work ethic."
        </blockquote>
      </div>
  
      <footer id="footer" class="text-center p-4 text-xs text-muted-foreground print:hidden">
        <a href="https://yourwebsite.com" target="_blank" rel="noopener noreferrer" class="hover:underline">https://yourwebsite.com</a>
      </footer>
  
      <div class="fixed top-4 right-4 flex flex-col space-y-2 no-print">
        <Button @click="toggleTheme" variant="outline" size="icon" aria-label="Toggle Theme">
          <SunMoon class="w-5 h-5" />
        </Button>
        <Button @click="printWindow" variant="outline" size="icon" aria-label="Print Page">
          <Printer class="w-5 h-5" />
        </Button>
        <Button @click="downloadPdfHandler" variant="outline" size="icon" aria-label="Download as PDF">
          <Download class="w-5 h-5" />
        </Button>
      </div>
    </div>
  </template>
  <script setup lang="ts">
  import { onMounted } from 'vue';
  import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
  import { SunMoon, Printer, Download } from 'lucide-vue-next'
  import { Button } from '@/components/ui/button'
  import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
  import { Separator } from '@/components/ui/separator'
  
  const props = defineProps({
      parsed_data: Object,
  });
  
  onMounted(() => {
      const htmlElement = document.documentElement;
      const storedTheme = localStorage.getItem("theme");
  
      const setTheme = (theme) => {
          if (theme === "dark") {
              htmlElement.classList.add("dark");
              localStorage.setItem("theme", "dark");
          } else {
              htmlElement.classList.remove("dark");
              localStorage.setItem("theme", "light");
          }
      };
  
      if (storedTheme) {
          setTheme(storedTheme);
      } else if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
          setTheme("dark");
      } else {
          setTheme("light");
      }
  });
  
  const toggleTheme = () => {
      const htmlElement = document.documentElement;
      if (htmlElement.classList.contains("dark")) {
          htmlElement.classList.remove("dark");
          localStorage.setItem("theme", "light");
      } else {
          htmlElement.classList.add("dark");
          localStorage.setItem("theme", "dark");
      }
  };
  
  const printWindow = () => {
      window.print();
  };
  
  const downloadPdfHandler = () => {
      if (!window.html2canvas || !window.jspdf) {
          console.error("html2canvas or jspdf is not loaded.");
          return;
      }
  
      const resumeElement = document.getElementById("resumeContent");
      document.body.classList.add("pdf-export-active");
  
      window.html2canvas(resumeElement, {
          scale: 2,
          useCORS: true,
          backgroundColor: window
              .getComputedStyle(document.body)
              .getPropertyValue("background-color"),
      })
          .then((canvas) => {
              const imgData = canvas.toDataURL("image/png");
              const { jsPDF } = window.jspdf;
              const pdf = new jsPDF({
                  orientation: "portrait",
                  unit: "pt",
                  format: "a4",
              });
  
              const imgProps = pdf.getImageProperties(imgData);
              const pdfWidth = pdf.internal.pageSize.getWidth();
              const pdfHeight = pdf.internal.pageSize.getHeight();
              const bottomMargin = 10;
              const usablePdfPageHeight = pdfHeight - bottomMargin;
              const imgHeightInPdf = (imgProps.height * pdfWidth) / imgProps.width;
              let heightLeft = imgHeightInPdf;
              let position = 0;
  
              pdf.addImage(imgData, "PNG", 0, position, pdfWidth, imgHeightInPdf);
              heightLeft -= usablePdfPageHeight;
  
              while (heightLeft > 0) {
                  position = heightLeft - imgHeightInPdf;
                  pdf.addPage();
                  pdf.addImage(imgData, "PNG", 0, position, pdfWidth, imgHeightInPdf);
                  heightLeft -= usablePdfPageHeight;
              }
              pdf.save("resume.pdf");
          })
          .catch((err) => {
              console.error("Error generating PDF:", err);
          })
          .finally(() => {
              document.body.classList.remove("pdf-export-active");
          });
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
  
      #resumeContent {
          box-shadow: none;
          margin: 0;
          max-width: 100%;
          border: none;
      }
  }
  
  .pdf-export-active .no-print {
      display: none;
  }
  </style>