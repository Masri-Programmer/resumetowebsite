<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Spatie\PdfToText\Pdf;
use Gemini;
class ResumeImportController extends Controller
{
    /**
     * Store, parse, and analyze the uploaded resume file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'resumeFile' => ['required', 'file', 'mimes:pdf,json,docx,odt,rtf,md,txt', 'max:2048'],
        ]);

        /** @var UploadedFile $file */
        $file = $request->file('resumeFile');
        $extension = strtolower($file->getClientOriginalExtension());
        $finalData = null;

        try {
            $rawContent = match ($extension) {
                'pdf'   => (new Pdf(env('PDF_TO_TEXT_PATH')))->setPdf($file->getRealPath())->text(), // Ensure PDF_TO_TEXT_PATH is set if needed
                'json'  => $file->get(),
                'txt',
                'md'    => $file->get(),
                'docx',
                'odt',
                'rtf'   => "Parsing for '." . strtoupper($extension) . "' files is not yet implemented.",
                default => throw new \InvalidArgumentException("Unsupported file type: {$extension}"),
            };

            if (empty($rawContent)) {
                return Redirect::back()->withErrors(['resumeFile' => 'The file was processed, but no content could be extracted. It might be empty or corrupt.']);
            }

            // If the file is JSON, we assume it's already structured
            if ($extension === 'json') {
                $finalData = json_decode($rawContent, true);
            } else {
                // For all other text-based content, send it to Gemini for analysis
                $finalData = $this->analyzeResumeWithGemini($rawContent);
            }

            if (empty($finalData)) {
                throw new \Exception('Gemini analysis returned no data.');
            }
        } catch (\Exception $e) {
            Log::error('File processing or AI analysis failed: ' . $e->getMessage(), [
                'file' => $file->getClientOriginalName(),
                'trace' => $e->getTraceAsString(),
            ]);

            return Redirect::back()->withErrors(['resumeFile' => 'Could not parse or analyze the uploaded file. Please try again.']);
        }

        return Redirect::route('dashboard.resume')
            ->with('success', 'Resume imported and analyzed successfully!')
            ->with('parsed_data', $finalData);
    }

    /**
     * Analyzes resume text using the Gemini API and returns structured data.
     *
     * @param string $resumeText
     * @return array|null
     */
    private function analyzeResumeWithGemini(string $resumeText): ?array
    {
        return json_decode('{
            "personalInfo": {
              "firstName": "Mohamad",
              "lastName": "Masri",
              "email": "masri_mohamad@protonmail.com",
              "telephone": null,
              "mobile": null,
              "website": "www.masri.blog",
              "location": {
                "address": null,
                "city": "Oldenburg",
                "state": null,
                "country": "Germany",
                "zipCode": null
              }
            },
            "socialLinks": {
              "linkedin": null,
              "github": null,
              "twitter": null,
              "instagram": null,
              "other": []
            },
            "workExperience": [
              {
                "role": "Softwareentwickler",
                "company": "Meinders & Elstermann GmbH & Co. KG",
                "startDate": "Apr 2024",
                "endDate": "Present",
                "description": [
                  "Enterprise-Software-Entwicklung – Erstellung skalierbarer Lösungen für Unternehmenskunden mit Vue.js, Inertia, JavaScript und Laravel.",
                  "Clean Code & Best Practices – Fokus auf das Schreiben von wartbarem, lesbarem und effizientem Code gemäß Clean-Code-Prinzipien.",
                  "Feature-Entwicklung – Design und Implementierung neuer Funktionen, Integration mit Inertia.js (Laravel, GraphQL, Inertia.js).",
                  "Versionskontrolle & Zusammenarbeit für strukturierte Entwicklung (Git, GitFlow, Lazygit).",
                  "Anwendung von Design Patterns (z.B. Singleton, Factory) zur Optimierung der Anwendungsarchitektur und Verbesserung der Skalierbarkeit."
                ]
              },
              {
                "role": "Full Stack Developer",
                "company": "Brainkets",
                "startDate": "Oct 2022",
                "endDate": "Sep 2023",
                "description": [
                  "Frontend-Entwicklung – Entwicklung interaktiver Benutzeroberflächen und skalierbarer Enterprise-Web-Anwendungen mit React.js, Next.js und Redux.",
                  "Backend-Entwicklung – Erstellung von Backend-Komponenten und REST-APIs mit Yii2 und PHP, unter Einhaltung von Clean-Code-Richtlinien.",
                  "UI/UX-Implementierung – Umsetzung von Figma-Designs in responsive Oberflächen mit HTML, CSS, Tailwind CSS, Material UI und design systems.",
                  "API-Integration – Verbindung von Frontend-Komponenten mit verteilten REST-basierten Backend-Systemen (REST-APIs, JSON, XML, SQL, Postman).",
                  "Agile Zusammenarbeit – Aktiver Beitrag zur Softwareentwicklung in einer agilen Teamumgebung (GitHub, Git, SDLC).",
                  "SEO & Performance-Optimierung – Verbesserung von Geschwindigkeit und Auffindbarkeit (SSR, Meta-Optimierung).",
                  "Verwendung gängiger Design Patterns bei der Entwicklung skalierbarer React- und PHP-Backend-Systeme."
                ]
              },
              {
                "role": "Intern",
                "company": "Brainkets",
                "startDate": "Jul 2022",
                "endDate": "Sep 2022",
                "description": [
                  "Praktische Erfahrung mit JavaScript, React.js, HTML, CSS und Bootstrap gesammelt, mit Beiträgen zu kleinen Enterprise-Software-Modulen."
                ]
              },
              {
                "role": "Freelancer & Private Tutor",
                "company": null,
                "startDate": "May 2020",
                "endDate": "Jul 2022",
                "description": [
                  "Projektentwicklung – Unterstützung bei Softwareprojekten (PHP, Java, MySQL, DBMS), gelegentliche Anwendung von Design Patterns.",
                  "Nachhilfe – Unterrichtete Python und Programmiergrundlagen, einschließlich Clean-Code-Konzepte, für Studenten."
                ]
              }
            ],
            "education": [
              {
                "degree": "Bachelor of Science (B.Sc.) in Computer Science (Informatik)",
                "institution": null,
                "graduationDate": null,
                "details": [
                  "Noten: 1.8",
                  "Fokus auf OOP, Datenstrukturen, Algorithmenentwurf, Problemlösung und Komplexitätsanalyse."
                ]
              }
            ],
            "skills": {
              "technical": [
                "React.js",
                "Redux",
                "Next.js",
                "Vue.js",
                "Angular.js",
                "Vite",
                "JavaScript (ES6+)",
                "TypeScript (ES6+)",
                "JSX",
                "HTMX",
                "HTML5",
                "CSS3",
                "Tailwind CSS",
                "SASS",
                "Bootstrap",
                "LESS",
                "Laravel",
                "PHP (Yii2)",
                "Node.js",
                "Express",
                "MySQL",
                "MongoDB",
                "Postman",
                "NPM",
                "Git",
                "GitHub",
                "GitLab",
                "GitLab CI",
                "Jest",
                "Cypress",
                "LAMP Stack",
                "Apache",
                "Python",
                "Java",
                "C++",
                "Windows",
                "Linux",
                "MacOS"
              ],
              "soft": [
                "Teamfähigkeit",
                "Motivation",
                "Flexibilität",
                "Selbstständige Arbeitsweise",
                "Lösungsorientierte Arbeitsweise",
                "Verantwortungsbewusste Arbeitsweise",
                "IT- und Prozessaffinität",
                "Schnelle Auffassungsgabe",
                "Hohes Umsetzungsvermögen",
                "Kommunikationsstark"
              ],
              "languages": [
                "Englisch: Fortgeschritten",
                "Deutsch: sehr gute Deutschkenntnisse",
                "Arabisch: Muttersprache"
              ]
            },
            "projects": [],
            "achievements": [
              "Dekan\'s Ehrenliste – Top-Studenten in akademischer Leistung",
              "Absolvierte verschiedene Udemy-Kurse in React, Node, Testing, Laravel, GraphQL, Software-Designmuster"
            ],
            "hobbies": [
              "Fitness",
              "Travel",
              "Gaming"
            ],
            "other": "Reisebereitschaft (auch mehrtägig) für geschäftliche Zwecke. Aktive Teilnahme und Beitrag zu Arbeitsgruppen und kollaborativen Teamumgebungen. For a detailed overview of projects, including descriptions and technologies used, please visit: masri.blog/Projects (https://masri.blog/Projects/Main)."
          }', true);




        $yourApiKey = getenv('GEMINI_API_KEY');
        $client = Gemini::client($yourApiKey);
  
        $prompt = <<<PROMPT
Analyze the following resume text and extract the information into a structured JSON object.

**JSON Schema:**
-   `personalInfo`: { `firstName`, `lastName`, `email`, `telephone`, `mobile`, `website`, `location`: { `address`, `city`, `state`, `country`, `zipCode` } }
-   `socialLinks`: { `linkedin`, `github`, `twitter`, `instagram`, `other`: [] }
-   `workExperience`: [ { `role`, `company`, `startDate`, `endDate`, `description`: [] } ]
-   `education`: [ { `degree`, `institution`, `graduationDate`, `details`: [] } ]
-   `skills`: { `technical`: [], `soft`: [], `languages`: [] }
-   `projects`: [ { `name`, `description`, `technologies`: [] } ]
-   `achievements`: []
-   `hobbies`: []
-   `other`: "Any other relevant information that doesn't fit elsewhere."

**Instructions:**
1.  Populate all fields based on the text.
2.  If a field or sub-field is not found, use `null` as its value.
3.  Dates should be formatted as 'Month YYYY' or 'YYYY-MM-DD' if possible.
4.  For array fields like `description` or `details`, split distinct points into separate strings.
5.  Your entire response must be **only the JSON object**, without any surrounding text, explanations, or markdown formatting like ```json.

**Resume Text to Analyze:**
---
{$resumeText}
---
PROMPT;

        $result = $client->generativeModel(model: 'gemini-2.5-flash')->generateContent($prompt);
        $cleanedResponse = trim($result->text());

        $cleanedResponse = str_replace(['```json', '```'], '', $cleanedResponse);

        return json_decode($cleanedResponse, true);
    }
}
