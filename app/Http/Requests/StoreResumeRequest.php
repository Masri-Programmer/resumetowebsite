<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResumeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
                'personalInfo' => 'required|array|min:1|max:1',
                'personalInfo.*.firstName' => 'required|string|min:2|max:255',
                'personalInfo.*.lastName' => 'required|string|min:2|max:255',
                'personalInfo.*.email' => 'required|email',
                'personalInfo.*.mobile' => 'nullable|string|min:10|max:20', // Changed to string for flexibility e.g. '+'
                'personalInfo.*.website' => 'nullable|url',
    
                'location' => 'present|nullable|array|max:1',
                'location.*.address' => 'nullable|string|min:5|max:255',
                'location.*.city' => 'nullable|string|min:2|max:255',
                'location.*.state' => 'nullable|string|min:2|max:255',
                'location.*.zipCode' => 'nullable|string|min:4|max:10', // String for international zips, adjusted min/max
                'location.*.country' => 'required|string|min:2|max:255', // Country is required in its section
    
                'socialLinks' => 'present|nullable|array|max:1',
                'socialLinks.*.linkedin' => 'nullable|url',
                'socialLinks.*.github' => 'nullable|url',
                'socialLinks.*.twitter' => 'nullable|url',
                'socialLinks.*.instagram' => 'nullable|url',
                'socialLinks.*.other' => 'nullable|url',
    
                'workExperience' => 'present|nullable|array',
                'workExperience.*.role' => 'nullable|string|min:2|max:255',
                'workExperience.*.company' => 'nullable|string|min:2|max:255',
                'workExperience.*.startDate' => 'nullable|date',
                'workExperience.*.endDate' => 'nullable|date|after_or_equal:workExperience.*.startDate',
                'workExperience.*.description' => 'nullable|string|max:2000',
    
                'education' => 'present|nullable|array',
                'education.*.degree' => 'required|string|min:2|max:255', // Degree is required in its section
                'education.*.institution' => 'nullable|string|min:2|max:255',
                'education.*.graduationDate' => 'nullable|date',
                'education.*.details' => 'nullable|string|max:2000', // max length adjusted
    
                'skills' => 'present|nullable|array',
                'skills.*.skill' => 'nullable|string|min:2|max:255',
    
                'achievements' => 'present|nullable|array',
                'achievements.*.achievement' => 'nullable|string|min:2|max:255',
    
                'projects' => 'present|nullable|array',
                'projects.*.project' => 'nullable|string|min:2|max:255',
    
                'hobbies' => 'present|nullable|array',
                'hobbies.*.hobby' => 'nullable|string|min:2|max:255',
        ];
    }
}
