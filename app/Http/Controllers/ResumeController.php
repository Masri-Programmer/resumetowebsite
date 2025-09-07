<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    /**
     * Display the user's resume data.
     *
     * @return \Inertia\Response
     */
    public function show()
    {
        $resume = Resume::where('user_id', Auth::id())->get();

        return Inertia::render('Dashboard', [
            'resume' => $resume ? $resume : null
        ]);
    }

    /**
     * Store or update the user's resume data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $resumeData = $request->all();
        $cleanData = [];

        foreach ($resumeData as $sectionKey => $sectionData) {
            if (!isset($sectionData['fields']) || !is_array($sectionData['fields'])) {
                continue;
            }

            $sectionValues = [];
            foreach ($sectionData['fields'] as $fieldGroup) {
                $groupValues = [];
                foreach ($fieldGroup as $fieldName => $fieldDetails) {
                    $groupValues[$fieldName] = $fieldDetails['value'] ?? null;
                }
                $sectionValues[] = $groupValues;
            }
            $cleanData[$sectionKey] = $sectionValues;
        }

        Resume::updateOrCreate(
            ['user_id' => Auth::id()],
            ['data' => $cleanData]
        );

        return back()->with('success', 'Resume saved successfully!');
    }
}
