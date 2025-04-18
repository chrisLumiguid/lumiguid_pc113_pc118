<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        return Testimonial::with(['portfolioOwner', 'employer'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'portfolio_owner_id' => 'required|exists:users,id',
            'employer_id' => 'nullable|exists:users,id',
            'rating' => 'nullable|integer|min:1|max:5',
            'testimonial_content' => 'required|string',
            'status' => 'in:pending,approved,rejected',
        ]);

        $testimonial = Testimonial::create($validated);

        return response()->json($testimonial, 201);
    }

    public function show(Testimonial $testimonial)
    {
        return $testimonial->load(['portfolioOwner', 'employer']);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'rating' => 'nullable|integer|min:1|max:5',
            'testimonial_content' => 'required|string',
            'status' => 'in:pending,approved,rejected',
        ]);

        $testimonial->update($validated);

        return response()->json($testimonial);
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return response()->json(null, 204);
    }
}
