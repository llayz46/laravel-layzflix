<?php

namespace App\Http\Controllers;


use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function addReview(ReviewRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();

        if (auth()->user()->reviews()->where('movie_id', $data['movie_id'])->exists()) {
            $review = auth()->user()->reviews()->where('movie_id', $data['movie_id'])->first();
            $review->update($data);

            return back()->with('success', 'Review updated successfully.');
        }

        $review = Review::create($data);
        $review->save();

        return back()->with('success', 'Review added successfully.');
    }

    public function deleteReview(Review $review): RedirectResponse
    {
        if ($review->user_id !== auth()->id()) {
            return back()->with('error', 'You are not authorized to delete this review.');
        }

        $review->delete();

        return back()->with('success', 'Review deleted successfully.');
    }
}
