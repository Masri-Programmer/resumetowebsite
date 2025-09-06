<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ResumeController extends Controller
{
    public function store(Request $request)
    {
        // Get all the data posted from the Vue form
        $resumeData = $request->all();

        $cleanData = [];

        // Loop over each section (e.g., 'personalInfo', 'workExperience')
        foreach ($resumeData as $sectionKey => $sectionData) {
            // Ensure we're only processing sections with a 'fields' array
            if (!isset($sectionData['fields']) || !is_array($sectionData['fields'])) {
                continue;
            }

            $isGroup = $sectionData['type'] === 'group';
            $sectionValues = [];

            // Loop over each field group in the 'fields' array
            foreach ($sectionData['fields'] as $fieldGroup) {
                $groupValues = [];
                // Loop over each field within the group (e.g., 'firstName', 'role')
                foreach ($fieldGroup as $fieldName => $fieldDetails) {
                    // Extract only the 'value'
                    $groupValues[$fieldName] = $fieldDetails['value'] ?? null;
                }

                if ($isGroup) {
                    // For groups like workExperience, append each item to an array
                    $sectionValues[] = $groupValues;
                } else {
                    // For single-field sections, just assign the values
                    $sectionValues = $groupValues;
                }
            }
            $cleanData[$sectionKey] = $sectionValues;
        }

        // Save the cleaned data to the database
        // updateOrCreate will find the resume for the current user or create a new one
        Resume::updateOrCreate(
            ['user_id' => auth()->id()],
            ['data' => $cleanData]
        );

        return back()->with('success', 'Resume saved successfully!');
    }
}
