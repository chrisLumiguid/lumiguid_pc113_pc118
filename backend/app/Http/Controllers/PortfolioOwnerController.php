<?php

namespace App\Http\Controllers;

use App\Models\PortfolioOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioOwnerController extends Controller
{
    public function index(Request $request)
    {
        $query = PortfolioOwner::query();

        if ($search = $request->input('search')) {
            $query->where('headline', 'like', "%$search%")
                  ->orWhere('skills', 'like', "%$search%")
                  ->orWhere('location', 'like', "%$search%");
        }

        return response()->json($query->with('user')->paginate(10));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'headline' => 'required|string|max:255',
            'about' => 'nullable|string|max:2000',

            'skills' => 'nullable|string|max:1000',

            'current_company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'experience_summary' => 'nullable|string|max:2000',
            'education_summary' => 'nullable|string|max:2000',

            'social_links' => 'nullable|json',
            'personal_website' => 'nullable|url|max:255',

            'portfolio_overview' => 'nullable|string|max:2000',

            'profile_banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // max 2MB
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024', // max 1MB
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // max 5MB

            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
        ]);

        $data['user_id'] = Auth::id();

        // Handle image & file uploads if present
        if ($request->hasFile('profile_banner')) {
            $data['profile_banner'] = $request->file('profile_banner')->store('banners', 'public');
        }
        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('avatars', 'public');
        }
        if ($request->hasFile('resume')) {
            $data['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        $portfolio = PortfolioOwner::create($data);

        return response()->json(['message' => 'Portfolio created.', 'portfolio' => $portfolio]);
    }

    public function show($id)
    {
        return response()->json(PortfolioOwner::with('user')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $portfolio = PortfolioOwner::findOrFail($id);

        $data = $request->validate([
            'headline' => 'required|string|max:255',
            'about' => 'nullable|string|max:2000',

            'skills' => 'nullable|string|max:1000',

            'current_company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'experience_summary' => 'nullable|string|max:2000',
            'education_summary' => 'nullable|string|max:2000',

            'social_links' => 'nullable|json',
            'personal_website' => 'nullable|url|max:255',

            'portfolio_overview' => 'nullable|string|max:2000',

            'profile_banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',

            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
        ]);

        if ($request->hasFile('profile_banner')) {
            $data['profile_banner'] = $request->file('profile_banner')->store('banners', 'public');
        }
        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('avatars', 'public');
        }
        if ($request->hasFile('resume')) {
            $data['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        $portfolio->update($data);

        return response()->json(['message' => 'Portfolio updated.', 'portfolio' => $portfolio]);
    }

    public function destroy($id)
    {
        $portfolio = PortfolioOwner::findOrFail($id);
        $portfolio->delete();

        return response()->json(['message' => 'Portfolio deleted.']);
    }
}
