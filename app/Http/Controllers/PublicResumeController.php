<?php
// app/Http/Controllers/PublicResumeController.php

namespace App\Http\Controllers;

use App\Models\Resume; 
use Inertia\Inertia;

class PublicResumeController extends Controller
{
    /**
     * Display the specified resume.
     *
     * @param string $subdomain
     * @return \Inertia\Response
     */
    public function show(string $subdomain)
    {
        $resume = Resume::where('slug', $subdomain)->firstOrFail();

        return Inertia::render('resumes/PublicView', [
            'parsed_data' => $resume
        ]);
    }
}