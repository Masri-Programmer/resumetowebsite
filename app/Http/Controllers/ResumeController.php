<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreResumeRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Spatie\PdfToText\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Gemini;

class ResumeController extends Controller
{
    public function dashboard()
    {
        $resumes = Auth::user()->resumes()->orderBy('created_at', 'desc')->get();

        return Inertia::render('Dashboard', [
            'resumes' => $resumes
        ]);
    }
    public function index()
    {
        $resumes = Auth::user()->resumes()->orderBy('created_at', 'desc')->get();

        return Inertia::render('resumes/Index', [
            'resumes' => $resumes
        ]);
    }

    public function create()
    {
        return Inertia::render('resumes/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        Auth::user()->resumes()->create(['data' => $request->all()]);
        return redirect()->route('resumes.index')->with('success', 'Resume created successfully!');
    }

    public function show(Resume $resume)
    {
        if ($resume->user_id !== Auth::id()) {
            abort(403);
        }

        return Inertia::render('resumes/Show', [
            'resume' => $resume
        ]);
    }

    public function edit(Resume $resume)
    {
        if ($resume->user_id !== Auth::id()) {
            abort(403);
        }

        return Inertia::render('resumes/Edit', ['parsed_data' => $resume]);
    }

    public function update(Request $request, Resume $resume)
    {
        if ($resume->user_id !== Auth::id()) {
            abort(403);
        }
        $resume->update(['data' => $request->all()]);
        return;
    }

    public function destroy(Resume $resume): RedirectResponse
    {
        if ($resume->user_id !== Auth::id()) {
            abort(403);
        }

        $resume->delete();

        return redirect()->route('resumes.index')->with('success', 'Resume deleted successfully!');
    }

    public function import(Request $request)
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
                'pdf'   => (new Pdf(env('PDF_TO_TEXT_PATH')))->setPdf($file->getRealPath())->text(),
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

            if ($extension === 'json') {
                $finalData = json_decode($rawContent, true);
            } else {
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

        $resume = Auth::user()->resumes()->create(['data' => $finalData]);
        return Inertia::render('resumes/Edit', ['parsed_data'=> $resume]);
    }

    private function analyzeResumeWithGemini(string $resumeText): ?array
    {
        return json_decode('{
            "skills": [
                {
                    "skill": "Selbstständige Arbeitsweise"
                },
                {
                    "skill": "Lösungsorientierte Arbeitsweise"
                },
                {
                    "skill": "Verantwortungsbewusste Arbeitsweise"
                },
                {
                    "skill": "IT- und Prozessaffinität"
                },
                {
                    "skill": "Schnelle Auffassungsgabe"
                },
                {
                    "skill": "Hohes Umsetzungsvermögen"
                },
                {
                    "skill": "Kommunikationsstark"
                }
            ],
            "hobbies": [
                {
                    "hobby": "Fitness"
                },
                {
                    "hobby": "Travel"
                },
                {
                    "hobby": "Gaming"
                }
            ],
            "location": [
                {
                    "city": "Oldenburg",
                    "state": null,
                    "address": null,
                    "country": "Germany",
                    "zipCode": null
                }
            ],
            "projects": [
                {
                    "project": "Detailed overview of projects available at masri.blog/Projects"
                }
            ],
            "education": [
                {
                    "degree": "Bachelor of Science (B.Sc.) in Computer Science (Informatik)",
                    "details": "Noten: 1.8; Fokus auf OOP, Datenstrukturen, Algorithmenentwurf, Problemlösung und Komplexitätsanalyse.",
                    "institution": null,
                    "graduationDate": null
                }
            ],
            "socialLinks": [
                {
                    "other": null,
                    "github": null,
                    "twitter": null,
                    "linkedin": null,
                    "instagram": null
                }
            ],
            "achievements": [
                {
                    "achievement": "Dekans Ehrenliste – Top-Studenten in akademischer Leistung"
                },
                {
                    "achievement": "Absolvierte verschiedene Udemy-Kurse in React, Node, Testing, Laravel, GraphQL, Software-Designmuster"
                }
            ],
            "personalInfo": [
                {
                    "email": "masri_mohamad@protonmail.com",
                    "mobile": null,
                    "website": "https:/www.masri.blog",
                    "lastName": "Masri",
                    "firstName": "Mohamad"
                }
            ],
            "workExperience": [
                {
                    "role": "Softwareentwickler",
                    "company": "Meinders & Elstermann GmbH & Co. KG",
                    "endDate": "Present",
                    "startDate": "Apr 2024",
                    "description": "Erstellung skalierbarer Lösungen für Unternehmenskunden mit Vue.js, Inertia, JavaScript und Laravel; Fokus auf das Schreiben von wartbarem, lesbarem und effizientem Code gemäß Clean-Code-Prinzipien; Design und Implementierung neuer Funktionen, Integration mit Inertia.js (Laravel, GraphQL, Inertia.js); Versionskontrolle & Zusammenarbeit für strukturierte Entwicklung (Git, GitFlow, Lazygit); Anwendung von Design Patterns (z.B. Singleton, Factory) zur Optimierung der Anwendungsarchitektur und Verbesserung der Skalierbarkeit."
                },
                {
                    "role": "Full Stack Developer",
                    "company": "Brainkets",
                    "endDate": "Sep 2023",
                    "startDate": "Oct 2022",
                    "description": "Entwicklung interaktiver Benutzeroberflächen und skalierbarer Enterprise-WebAnwendungen mit React.js, Next.js und Redux; Erstellung von Backend-Komponenten und REST-APIs mit Yii2 und PHP, unter Einhaltung von Clean-Code-Richtlinien; Umsetzung von Figma-Designs in responsive Oberflächen mit HTML, CSS, Tailwind CSS, Material UI und design systems; Verbindung von Frontend-Komponenten mit verteilten REST-basierten Backend-Systemen (REST-APIs,JSON, XML, SQL, Postman); Aktiver Beitrag zur Softwareentwicklung in einer agilen Teamumgebung (GitHub, Git, SDLC); Verbesserung von Geschwindigkeit und Auffindbarkeit (SSR, Meta-Optimierung); Verwendung gängiger Design Patterns bei der Entwicklung skalierbarer React- und PHP-Backend-Systeme."
                },
                {
                    "role": "Intern",
                    "company": "Brainkets",
                    "endDate": "Sep 2022",
                    "startDate": "Jul 2022",
                    "description": "Praktische Erfahrung mit JavaScript, React.js, HTML, CSS und Bootstrap gesammelt; Beiträge zu kleinen Enterprise-Software-Modulen."
                },
                {
                    "role": "Freelancer & Private Tutor",
                    "company": null,
                    "endDate": "Jul 2022",
                    "startDate": "May 2020",
                    "description": "Unterstützung bei Softwareprojekten (PHP, Java, MySQL, DBMS), gelegentliche Anwendung von Design Patterns; Unterrichtete Python und Programmiergrundlagen, einschließlich Clean-Code-Konzepte, für Studenten."
                }
            ]
        }', true);
        $yourApiKey = getenv('GEMINI_API_KEY');
        $client = Gemini::client($yourApiKey);
        $resumeSchema = json_encode(Config::get('portfolio.resume'), JSON_PRETTY_PRINT);

        $prompt = <<<PROMPT
        You are an expert resume parsing API. Your sole function is to analyze the provided resume text and return a single, raw JSON object that strictly adheres to the schema and rules below.

        **JSON Schema to Follow:**
        ```json
        {$resumeSchema}
        ```

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

        $cleanedResponse = str_replace(['```json', '```'], "", $cleanedResponse);

        return json_decode($cleanedResponse, true);
    }
}
