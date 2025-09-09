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

        return Inertia::render('Dashboard', ['parsed_data' => $resumes]);
    }
    public function index()
    {
        $resumes = Auth::user()->resumes()->orderBy('created_at', 'desc')->get();

        return Inertia::render('resumes/Index', ['parsed_data' => $resumes]);
    }

    public function create()
    {
        $resumes = Auth::user()->resumes()->orderBy('created_at', 'desc')->get();
        return Inertia::render('Dashboard', ['parsed_data' => $resumes]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $resume =  Auth::user()->resumes()->create([
            'title' => $validated['title'],
            'data'  => $request->except('title'),
        ]);
        return Inertia::render('resumes/Edit', ['parsed_data' => $resume]);
    }

    public function show(Resume $resume)
    {
        if ($resume->user_id !== Auth::id()) {
            abort(403);
        }

        return Inertia::render('resumes/Show', ['parsed_data' => $resume]);
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
        $resumes = Auth::user()->resumes()->orderBy('created_at', 'desc')->get();
        return Inertia::render('resumes/Index', ['parsed_data' => $resumes]);
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
        $path = $file->store('resumes', 'public');
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

        $resume = Auth::user()->resumes()->create(['data' => $finalData, 'file' => $path]);
        return Inertia::render('resumes/Edit', ['parsed_data'=> $resume]);
    }

    private function analyzeResumeWithGemini(string $resumeText): ?array
    {
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
