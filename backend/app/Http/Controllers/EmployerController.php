<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employer;

class EmployerController extends Controller
{
    /**
     * Display the employer dashboard data.
     */
    public function dashboard()
    {
        /** @var \App\Models\Employer|null $employer */
        $employer = Auth::user()->employer;

        return response()->json([
            'message' => 'Welcome to the employer dashboard!',
            'employer' => $employer
        ]);
    }

    /**
     * Update the employer profile.
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'company_description' => 'nullable|string',
            'company_website' => 'nullable|url',
            'contact_number' => 'nullable|string|max:20',
        ]);

        $user->employer()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only([
                'company_name',
                'position',
                'company_description',
                'company_website',
                'contact_number'
            ])
        );

        return response()->json(['message' => 'Employer profile updated successfully.']);
    }
}
