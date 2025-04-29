<?php

namespace App\Http\Controllers;

use App\Models\PortfolioOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class PortfolioOwnerController extends Controller
{
    public function index()
    {
        try {
            $portfolioOwners = PortfolioOwner::all();

            if ($portfolioOwners->isEmpty()) {
                return response()->json([
                    'message' => 'Portfolio-owners not found',
                    'data' => []
                ], 404);
            }

            return response()->json([
                'message' => 'Portfolio-owners retrieved successfully',
                'data' => $portfolioOwners
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
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

            $data['user_id'] = Auth::id();

            // Handle file uploads
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

            return response()->json([
                'message' => 'Portfolio created successfully.',
                'portfolio' => $portfolio
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $portfolio = PortfolioOwner::with('user')->findOrFail($id);

            return response()->json($portfolio, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
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

            // Handle file uploads
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

            return response()->json([
                'message' => 'Portfolio updated successfully.',
                'portfolio' => $portfolio
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $portfolio = PortfolioOwner::findOrFail($id);
            $portfolio->delete();

            return response()->json(['message' => 'Portfolio deleted successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}