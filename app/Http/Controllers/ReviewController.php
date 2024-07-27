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

        $review = Review::create($data);

        $review->save();

        return back()->with('success', 'Review added successfully.');
    }
}
