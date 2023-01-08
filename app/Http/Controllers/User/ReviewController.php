<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;

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
        if($request->user_id){
            $user=User::find($request->user_id);
            $user->products()->save($review);
        }
        $review->save();
        return redirect()->back()->with('success', 'Review created successfully!');
    }
}