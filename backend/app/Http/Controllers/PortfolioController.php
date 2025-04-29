<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;  

class PortfolioController extends Controller
{
    public function index()
{
    $portfolios = Portfolio::all(); // Ensure this retrieves data
    if ($portfolios->isEmpty()) {
        return response()->json(['message' => 'Portfolios not found'], 404);
    }
    return response()->json($portfolios);
}

    public function create()
    {
        return view('portfolios.create');
    }

    public function store(Request $request)
    {
        /** @var \App\Models\PortfolioOwner|null $owner */
        $owner = Auth::user()->portfolioOwner;  // Use Auth::user() instead of auth()->user()

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi|max:10240',
            'category' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
            'date_completed' => 'nullable|date',
            'client_name' => 'nullable|string|max:255',
            'project_url' => 'nullable|url',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $portfolio = new Portfolio([
            'portfolio_owner_id' => $owner?->id,
            'title' => $validatedData['title'],
            'description' => $validatedData['description'] ?? null,
            'category' => $validatedData['category'] ?? null,
            'tags' => json_encode(explode(',', $validatedData['tags'] ?? '')),
            'date_completed' => $validatedData['date_completed'] ?? null,
            'client_name' => $validatedData['client_name'] ?? null,
            'project_url' => $validatedData['project_url'] ?? null,
            'status' => $validatedData['status'],
        ]);

        if ($request->hasFile('cover_image')) {
            $portfolio->cover_image = $request->file('cover_image')->store('portfolio_images', 'public');
        }

        if ($request->has('gallery_images')) {
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('portfolio_gallery', 'public');
            }
            $portfolio->gallery_images = json_encode($galleryImages);
        }

        if ($request->has('video_url')) {
            $portfolio->video_url = $validatedData['video_url'];
        }

        if ($request->hasFile('video_file')) {
            $portfolio->video_file = $request->file('video_file')->store('portfolio_videos', 'public');
        }

        $portfolio->save();

        return redirect()->route('portfolios.index')->with('success', 'Portfolio created successfully!');
    }

    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi|max:10240',
            'category' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
            'date_completed' => 'nullable|date',
            'client_name' => 'nullable|string|max:255',
            'project_url' => 'nullable|url',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $portfolio->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'] ?? null,
            'category' => $validatedData['category'] ?? null,
            'tags' => json_encode(explode(',', $validatedData['tags'] ?? '')),
            'date_completed' => $validatedData['date_completed'] ?? null,
            'client_name' => $validatedData['client_name'] ?? null,
            'project_url' => $validatedData['project_url'] ?? null,
            'status' => $validatedData['status']
        ]);

        if ($request->hasFile('cover_image')) {
            Storage::disk('public')->delete($portfolio->cover_image);
            $portfolio->cover_image = $request->file('cover_image')->store('portfolio_images', 'public');
        }

        if ($request->has('gallery_images')) {
            $oldImages = json_decode($portfolio->gallery_images ?? '[]');
            foreach ($oldImages as $img) {
                Storage::disk('public')->delete($img);
            }

            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('portfolio_gallery', 'public');
            }
            $portfolio->gallery_images = json_encode($galleryImages);
        }

        if ($request->has('video_url')) {
            $portfolio->video_url = $validatedData['video_url'];
        }

        if ($request->hasFile('video_file')) {
            Storage::disk('public')->delete($portfolio->video_file);
            $portfolio->video_file = $request->file('video_file')->store('portfolio_videos', 'public');
        }

        $portfolio->save();

        return redirect()->route('portfolios.index')->with('success', 'Portfolio updated successfully!');
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        // Delete media files if they exist
        if ($portfolio->cover_image) {
            Storage::disk('public')->delete($portfolio->cover_image);
        }

        if ($portfolio->video_file) {
            Storage::disk('public')->delete($portfolio->video_file);
        }

        $gallery = json_decode($portfolio->gallery_images ?? '[]');
        foreach ($gallery as $image) {
            Storage::disk('public')->delete($image);
        }

        $portfolio->delete();

        return redirect()->route('portfolios.index')->with('success', 'Portfolio deleted successfully!');
    }
}
