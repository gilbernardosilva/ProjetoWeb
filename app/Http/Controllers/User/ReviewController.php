<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(User $user){
        $users = User::all();
        //$user = auth()->user();
        $hideWriteOwnReview = auth()->user();
        return view('reviews.create', compact('users', 'user', 'hideWriteOwnReview'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|nullable|integer',
            'rating' => 'required',
            'description' => 'required|string|max:350',
        ]);
        $review = new Review();
        $review->rating = $request->input('rating');
        $review->description = $request->input('description');
        $review->reviewed_id = $request->input('user_id');
        $review->reviewer_id = Auth::id();

        $review->save();
        return redirect()->back()->with('success', 'Review created successfully!');
    }
}
