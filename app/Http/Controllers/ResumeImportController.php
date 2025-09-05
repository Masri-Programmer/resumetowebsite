<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Spatie\PdfToText\Pdf;
use Gemini\Enums\ModelVariation;
use Gemini\GeminiHelper;
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

        return Redirect::back()
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
