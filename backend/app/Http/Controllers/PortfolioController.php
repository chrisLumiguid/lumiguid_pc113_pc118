<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PortfolioController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);
    }
    // 👥 Admin: view all portfolios
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $portfolios = Portfolio::all(); // Admin sees all
        } else {
            $portfolios = Portfolio::where('portfolio_owner_id', Auth::id())->get(); // Portfolio Owner sees only their own
        }

        return response()->json($portfolios);
    }

    // 👥 Admin: view single portfolio by ID
    public function show($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return response()->json($portfolio);
    }

    // 👥 Admin or Portfolio Owner: Create
    public function store(Request $request)
    {
        $user = Auth::guard('api')->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published,archived',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('portfolio_covers', 'public');
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryPaths[] = $galleryImage->store('portfolio_galleries', 'public');
            }
        }

        $portfolio = Portfolio::create([
            'portfolio_owner_id' => Auth::id(),
            'title' => $validatedData['title'],
            'description' => $validatedData['description'] ?? null,
            'category' => $validatedData['category'] ?? null,
            'tags' => $validatedData['tags'] ?? null,
            'status' => $validatedData['status'],
            'cover_image' => $coverImagePath,
            'gallery_images' => json_encode($galleryPaths),
        ]);

        return response()->json(['message' => 'Portfolio created successfully.', 'portfolio' => $portfolio]);
    }

    // 👥 Admin or Portfolio Owner: Update
    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published,archived',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('cover_image')) {
            if ($portfolio->cover_image) {
                Storage::disk('public')->delete($portfolio->cover_image);
            }
            $portfolio->cover_image = $request->file('cover_image')->store('portfolio_covers', 'public');
        }

        if ($request->hasFile('gallery_images')) {
            if ($portfolio->gallery_images) {
                foreach (json_decode($portfolio->gallery_images) as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryPaths[] = $galleryImage->store('portfolio_galleries', 'public');
            }
            $portfolio->gallery_images = json_encode($galleryPaths);
        }

        $portfolio->update($validatedData);

        return response()->json(['message' => 'Portfolio updated successfully.', 'portfolio' => $portfolio]);
    }

    // 👥 Admin or Portfolio Owner: Delete
    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        if ($portfolio->cover_image) {
            Storage::disk('public')->delete($portfolio->cover_image);
        }

        if ($portfolio->gallery_images) {
            foreach (json_decode($portfolio->gallery_images) as $galleryImage) {
                Storage::disk('public')->delete($galleryImage);
            }
        }

        $portfolio->delete();

        return response()->json(['message' => 'Portfolio deleted successfully.']);
    }
}
