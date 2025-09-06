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
                "title": "Personal Information",
                "description": "Your personal contact details.",
                "actions": { "add": false, "remove": false },
                "fields": [
                    {
                        "firstName": {
                            "placeholder": "e.g., Mohamad",
                            "type": "string",
                            "value": "Mohamad",
                            "rules": { "required": true, "min": 2, "max": 255 }
                        },
                        "lastName": {
                            "placeholder": "e.g., Masri",
                            "type": "string",
                            "value": "",
                            "rules": { "required": true, "min": 2, "max": 255 }
                        },
                        "email": {
                            "placeholder": "e.g., your@email.com",
                            "type": "email",
                            "value": "",
                            "rules": { "required": true, "email": true }
                        },
                        "mobile": {
                            "placeholder": "e.g., +49 123 456789",
                            "type": "string",
                            "value": "",
                            "rules": { "required": false, "min": 10, "max": 20 }
                        },
                        "website": {
                            "placeholder": "e.g., www.your-portfolio.com",
                            "class": "sm:col-span-2",
                            "type": "url",
                            "value": "",
                            "rules": { "required": false, "url": true }
                        }
                    }
                ]
            },
            "location": {
                "title": "Location",
                "description": "Where you are currently based.",
                "actions": { "add": false, "remove": false },
                "fields": [
                    {
                        "address": {
                            "placeholder": "e.g., Musterstraße 1",
                            "class": "sm:col-span-2",
                            "type": "string",
                            "value": "",
                            "rules": { "required": true, "min": 5, "max": 255 }
                        },
                        "city": {
                            "placeholder": "e.g., Oldenburg",
                            "type": "string",
                            "value": "",
                            "rules": { "required": true, "min": 2, "max": 255 }
                        },
                        "state": {
                            "placeholder": "e.g., Lower Saxony",
                            "type": "string",
                            "value": "",
                            "rules": { "required": true, "min": 2, "max": 255 }
                        },
                        "zipCode": {
                            "placeholder": "e.g., 26121",
                            "type": "string",
                            "value": "",
                            "rules": { "required": true, "numeric": true, "min": 4, "max": 10 }
                        },
                        "country": {
                            "placeholder": "e.g., Germany",
                            "type": "string",
                            "value": "",
                            "rules": { "required": true, "min": 2, "max": 255 }
                        }
                    }
                ]
            },
            "socialLinks": {
                "title": "Social & Professional Links",
                "description": "Links to your online profiles.",
                "actions": { "add": true, "remove": false },
                "fields": [
                    {
                        "linkedin": {
                            "placeholder": "URL of your LinkedIn profile",
                            "type": "url",
                            "value": "",
                            "rules": { "required": false, "url": true }
                        },
                        "github": {
                            "placeholder": "URL of your GitHub profile",
                            "type": "url",
                            "value": "",
                            "rules": { "required": false, "url": true }
                        },
                        "twitter": {
                            "placeholder": "URL of your Twitter profile",
                            "type": "url",
                            "value": "",
                            "rules": { "required": false, "url": true }
                        },
                        "instagram": {
                            "placeholder": "URL of your Instagram profile",
                            "type": "url",
                            "value": "",
                            "rules": { "required": false, "url": true }
                        },
                        "other": {
                            "placeholder": "URL of a profile",
                            "type": "url",
                            "value": "",
                            "rules": { "required": false, "url": true }
                        }
                    }
                ]
            },
            "workExperience": {
                "title": "Work Experience",
                "description": "Your professional work history.",
                "actions": { "add": true, "remove": true },
                "fields": [
                    {
                        "role": {
                            "placeholder": "e.g., Full Stack Developer",
                            "type": "string",
                            "value": "",
                            "rules": { "required": true, "min": 2, "max": 255 }
                        },
                        "company": {
                            "placeholder": "e.g., Tech Solutions Inc.",
                            "type": "string",
                            "value": "",
                            "rules": { "required": true, "min": 2, "max": 255 }
                        },
                        "startDate": {
                            "placeholder": "e.g., Oct 2022",
                            "type": "date",
                            "value": "",
                            "rules": { "required": true, "date": true }
                        },
                        "endDate": {
                            "placeholder": "e.g., Sep 2023 or Present",
                            "type": "date",
                            "value": "",
                            "rules": { "required": false, "date": true }
                        },
                        "description": {
                            "component": "textarea",
                            "placeholder": "Enter each responsibility on a new line.",
                            "class": "sm:col-span-2",
                            "type": "string",
                            "value": "",
                            "rules": { "required": false, "max": 2000 }
                        }
                    }
                ]
            },
            "education": {
                "title": "Education",
                "description": "Your educational background.",
                "actions": { "add": true, "remove": true },
                "fields": [
                    {
                        "degree": {
                            "placeholder": "e.g., B.Sc. in Computer Science",
                            "type": "string",
                            "value": "",
                            "rules": { "required": true, "min": 2, "max": 255 }
                        },
                        "institution": {
                            "placeholder": "e.g., University of Oldenburg",
                            "type": "string",
                            "value": "",
                            "rules": { "required": true, "min": 2, "max": 255 }
                        },
                        "graduationDate": {
                            "placeholder": "e.g., Sep 2022",
                            "type": "date",
                            "value": "",
                            "rules": { "required": true, "date": true }
                        },
                        "details": {
                            "component": "textarea",
                            "placeholder": "e.g., Grade: 1.8\nFocus on OOP...",
                            "class": "sm:col-span-2",
                            "type": "string",
                            "value": "",
                            "rules": { "required": false, "max": 2000 }
                        }
                    }
                ]
            },
            "skills": {
                "title": "Skills",
                "description": "Your skills.",
                "actions": { "add": true, "remove": true },
                "fields": [
                    {
                        "skill": {
                            "placeholder": "e.g., Vue.js, Laravel, Teamwork",
                            "type": "string",
                            "value": "",
                            "rules": { "required": true, "min": 2, "max": 255 }
                        }
                    }
                ]
            },
            "achievements": {
                "title": "Achievements",
                "description": "A list of your notable achievements.",
                "actions": { "add": true, "remove": true },
                "fields": [
                    {
                        "achievement": {
                            "placeholder": "Enter each achievement on a new line.",
                            "type": "string",
                            "value": "",
                            "rules": { "required": true, "min": 2, "max": 255 }
                        }
                    }
                ]
            },
            "projects": {
                "title": "Projects",
                "description": "A list of your projects.",
                "actions": { "add": true, "remove": true },
                "fields": [
                    {
                        "project": {
                            "placeholder": "Enter each project on a new line.",
                            "type": "string",
                            "value": "",
                            "rules": { "required": true, "min": 2, "max": 255 }
                        }
                    }
                ]
            },
            "hobbies": {
                "title": "Hobbies",
                "description": "Your interests and hobbies.",
                "actions": { "add": true, "remove": true },
                "fields": [
                    {
                        "hobby": {
                            "name": "hobby",
                            "label": "Hobby",
                            "placeholder": "e.g., Fitness, Travel, Gaming",
                            "type": "string",
                            "value": "",
                            "rules": { "required": false, "min": 2, "max": 255 }
                        }
                    }
                ]
            }
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
