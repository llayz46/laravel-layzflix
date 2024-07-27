<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $response = Http::get('https://api.themoviedb.org/3/movie/top_rated', [
            'api_key' => config('services.tmdb.token'),
        ])->json();

        $topRatedMovies = collect($response['results'])->take(3);

        $lastReviews = Review::orderBy('created_at', 'desc')->with('user:id,username,avatar')->take(3)->get();

        Review::addMovieToReview($lastReviews);

        return view('home', [
            'topRatedMovies' => $topRatedMovies,
            'lastReviews' => $lastReviews,
        ]);
    }
}
