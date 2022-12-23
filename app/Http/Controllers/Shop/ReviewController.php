<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function create(){
        return view('reviews.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required',
            'description' => 'required|string|max:50',
        ]);
        $review = new Review();
        $review->rating = $request->input('rating'); 
        $review->description = $request->input('description');
        $review->save();
        return redirect()->back()->with('success', 'Review created successfully!');
    }
}
