<?php

namespace App\Http\Controllers;


use App\Http\Requests\ReviewRequest;
use App\Models\Review;

class ReviewController extends Controller
{
    public function addReview(ReviewRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();

        if (auth()->user()->reviews()->where('movie_id', $data['movie_id'])->exists()) {
            return back()->with('error', 'You have already reviewed this movie.');
        }

        $review = Review::create($data);

        $review->save();

        return back()->with('success', 'Review added successfully.');
    }
}
