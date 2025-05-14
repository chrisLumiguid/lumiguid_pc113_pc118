<?php

namespace App\Http\Controllers;

use App\Models\PortfolioOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class PortfolioOwnerController extends Controller
{
    /**
     * Complete the portfolio owner's profile.
     */
    public function completeProfile(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'User not authenticated.'], 401);
            }

            $validated = $request->validate([
                'headline' => 'required|string|max:255',
                'about' => 'required|string',
                'skills' => 'required|string',
                'current_company' => 'nullable|string|max:255',
                'position' => 'nullable|string|max:255',
                'experience_summary' => 'nullable|string',
                'education_summary' => 'nullable|string',
                'portfolio_overview' => 'nullable|string',
                'profile_picture' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'profile_banner' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'social_links' => 'nullable|array',
                'social_links.*' => 'nullable|url',
                'personal_website' => 'nullable|url',
                'location' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'contact_email' => 'nullable|email|max:255',
            ]);

            $user->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'contact_number' => $validated['contact_number'],
            ]);

            // Handle file uploads
            $profilePicturePath = $request->file('profile_picture')?->store('avatars', 'public');
            $resumePath = $request->file('resume')?->store('resumes', 'public');
            $profileBannerPath = $request->file('profile_banner')?->store('banners', 'public');

            $portfolioOwner = PortfolioOwner::create([
                'user_id' => $user->id,
                'headline' => $validated['headline'],
                'about' => $validated['about'] ?? null,
                'skills' => $validated['skills'] ?? null,
                'current_company' => $validated['current_company'] ?? null,
                'position' => $validated['position'] ?? null,
                'experience_summary' => $validated['experience_summary'] ?? null,
                'education_summary' => $validated['education_summary'] ?? null,
                'portfolio_overview' => $validated['portfolio_overview'] ?? null,
                'profile_picture' => $profilePicturePath,
                'resume' => $resumePath,
                'profile_banner' => $profileBannerPath,
                'social_links' => isset($validated['social_links']) ? json_encode($validated['social_links']) : null,
                'personal_website' => $validated['personal_website'] ?? null,
                'location' => $validated['location'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'contact_email' => $validated['contact_email'] ?? null,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Portfolio created successfully!',
                'user' => $user,
                'portfolio' => $portfolioOwner
            ], 201);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating portfolio owner: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to create profile.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show all portfolio owners.
     */
    public function index()
    {
        try {
            $portfolioOwners = PortfolioOwner::all();

            return response()->json([
                'message' => $portfolioOwners->isEmpty() ? 'No portfolio owners found.' : 'Portfolio owners retrieved successfully.',
                'data' => $portfolioOwners
            ], 200);

        } catch (Exception $e) {
            Log::error('Error fetching portfolio owners: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to fetch portfolio owners.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a new portfolio owner.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();

            $validated = $request->validate([
                'headline' => 'required|string|max:255',
                'about' => 'nullable|string|max:2000',
                'skills' => 'nullable|string|max:1000',
                'current_company' => 'nullable|string|max:255',
                'position' => 'nullable|string|max:255',
                'experience_summary' => 'nullable|string|max:2000',
                'education_summary' => 'nullable|string|max:2000',
                'social_links' => 'nullable|array',
                'social_links.*' => 'nullable|url',
                'personal_website' => 'nullable|url|max:255',
                'portfolio_overview' => 'nullable|string|max:2000',
                'profile_banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'location' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'contact_email' => 'nullable|email|max:255',
            ]);

            $data = $validated;
            $data['user_id'] = $user->id;

            if ($request->hasFile('profile_banner')) {
                $data['profile_banner'] = $request->file('profile_banner')->store('banners', 'public');
            }
            if ($request->hasFile('profile_picture')) {
                $data['profile_picture'] = $request->file('profile_picture')->store('avatars', 'public');
            }
            if ($request->hasFile('resume')) {
                $data['resume'] = $request->file('resume')->store('resumes', 'public');
            }
            if (isset($validated['social_links'])) {
                $data['social_links'] = json_encode($validated['social_links']);
            }

            $portfolio = PortfolioOwner::create($data);

            DB::commit();

            return response()->json([
                'message' => 'Portfolio created successfully.',
                'portfolio' => $portfolio
            ], 201);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error storing portfolio: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to store portfolio.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display a specific portfolio owner.
     */
    public function show($id)
    {
        try {
            $portfolio = PortfolioOwner::with('user')->findOrFail($id);

            return response()->json([
                'message' => 'Portfolio retrieved successfully.',
                'portfolio' => $portfolio
            ], 200);

        } catch (Exception $e) {
            Log::error('Error showing portfolio: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to retrieve portfolio.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update a specific portfolio owner.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $portfolio = PortfolioOwner::findOrFail($id);

            $validated = $request->validate([
                'headline' => 'required|string|max:255',
                'about' => 'nullable|string|max:2000',
                'skills' => 'nullable|string|max:1000',
                'current_company' => 'nullable|string|max:255',
                'position' => 'nullable|string|max:255',
                'experience_summary' => 'nullable|string|max:2000',
                'education_summary' => 'nullable|string|max:2000',
                'social_links' => 'nullable|array',
                'social_links.*' => 'nullable|url',
                'personal_website' => 'nullable|url|max:255',
                'portfolio_overview' => 'nullable|string|max:2000',
                'profile_banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
                'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'location' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'contact_email' => 'nullable|email|max:255',
            ]);

            $data = $validated;

            if ($request->hasFile('profile_banner')) {
                $data['profile_banner'] = $request->file('profile_banner')->store('banners', 'public');
            }
            if ($request->hasFile('profile_picture')) {
                $data['profile_picture'] = $request->file('profile_picture')->store('avatars', 'public');
            }
            if ($request->hasFile('resume')) {
                $data['resume'] = $request->file('resume')->store('resumes', 'public');
            }
            if (isset($validated['social_links'])) {
                $data['social_links'] = json_encode($validated['social_links']);
            }

            $portfolio->update($data);

            DB::commit();

            return response()->json([
                'message' => 'Portfolio updated successfully.',
                'portfolio' => $portfolio
            ], 200);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating portfolio: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to update portfolio.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a specific portfolio owner.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $portfolio = PortfolioOwner::findOrFail($id);
            $portfolio->delete();

            DB::commit();

            return response()->json([
                'message' => 'Portfolio deleted successfully.'
            ], 200);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting portfolio: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to delete portfolio.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
