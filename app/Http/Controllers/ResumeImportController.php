<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Spatie\PdfToText\Pdf;

class ResumeImportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'resumeFile' => ['required', 'file', 'mimes:pdf,json,doc,docx', 'max:5120'], // 5MB Max
        ]);

        $file = $request->file('resumeFile');
        $extension = strtolower($file->getClientOriginalExtension());
        $parsedData = null;

        try {
            switch ($extension) {
                case 'pdf':
                        $parsedData = (new Pdf())
                        ->setPdf($file->getRealPath())
                        ->text();
                    break;

                case 'json':
                    $content = $file->get();
                    $parsedData = json_decode($content, true);
                    // For display purposes, let's re-encode it as a formatted string.
                    if (is_array($parsedData)) {
                        $parsedData = json_encode($parsedData, JSON_PRETTY_PRINT);
                    }
                    break;

                case 'docx':
                    // Placeholder for a real docx parsing library like PhpOffice/PHPWord
                    $parsedData = "DOCX parsing is not yet implemented.";
                    break;

                default:
                    return Redirect::back()->withErrors(['resumeFile' => 'Unsupported file type.']);
            }

            // A quick way to debug: uncomment the line below to stop execution
            // and see if $parsedData contains the text from the PDF.
            
            if (empty($parsedData)) {
                return Redirect::back()->withErrors(['resumeFile' => 'The file was processed, but no content could be extracted. It might be empty or corrupt.']);
            }
        } catch (\Exception $e) {
            // Log the actual error for debugging purposes
            Log::error('File parsing failed: ' . $e->getMessage());
            
            // Provide a user-friendly error
            return Redirect::back()->withErrors(['resumeFile' => 'Could not parse the uploaded file. Please ensure it is a valid document and that the server has parsing tools installed.']);
        }

        // dd($parsedData);
        // Flashing data to the session works, but be mindful of session size limits with large files.
        return Redirect::route('dashboard') // Or wherever you redirect to
            ->with('success', 'Resume imported successfully!')
            ->with('parsed_data', $parsedData);
    }
}
