<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\OrderItem;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(OrderItem $order_item, Game $game){
        return view('reviews.create', compact('order_item', 'game'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $existingReview = Review::where('user_id', $user->id)->where('order_item_id', $request->input('order_item_id'))->first();
        
        if($existingReview){
            return response()->json(['error' => 'You have already reviewed this item.'], 400);
        }

        $request->validate([
            'order_item_id' => 'required|nullable|integer',
            'rating' => 'required',
            'description' => 'required|string|max:350',
        ]);
        $review = new Review();
        $review->rating = $request->input('rating');
        $review->description = $request->input('description');
        $review->order_item_id = $request->input('order_item_id');
        $review->user_id = $user->id;

        $review->save();
        return redirect()->back()->with('success', 'Review created successfully!');
    }
}
