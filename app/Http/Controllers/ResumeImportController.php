<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $extension = $file->getClientOriginalExtension();
        $parsedData = null;

        try {
            switch (strtolower($extension)) {
                case 'pdf':
                    // You might need to provide the path to pdftotext binary
                    // See spatie/pdf-to-text documentation
                    $parsedData = Pdf::getText($file->getRealPath());
                    break;

                case 'json':
                    $content = $file->get();
                    $parsedData = json_decode($content, true);
                    break;
                
                // Note: Parsing .doc and .docx is more complex and requires
                // libraries like PHPOffice/PHPWord.
                case 'docx':
                    // Placeholder for docx parsing logic
                    // $parsedData = $this->parseDocx($file);
                    $parsedData = "DOCX parsing is not yet implemented.";
                    break;

                default:
                    // Handle unsupported file types
                    return Redirect::back()->withErrors(['resumeFile' => 'Unsupported file type.']);
            }
        } catch (\Exception $e) {
            // Handle any parsing errors
            return Redirect::back()->withErrors(['resumeFile' => 'Could not parse the uploaded file. Error: ' . $e->getMessage()]);
        }
        
        return Redirect::back()->with('success', 'Resume imported successfully!')->with('parsed_data', $parsedData);
    }
}
