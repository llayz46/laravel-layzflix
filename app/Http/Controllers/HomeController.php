<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $topRatedMoviesFromReviews = Review::groupBy('movie_id')
            ->selectRaw('movie_id, AVG(note) as average_note')
            ->orderBy('average_note', 'desc')
            ->take(3)
            ->get();

        $topRatedMovies = [];

        foreach ($topRatedMoviesFromReviews as $topRatedMovie) {
            $response = Http::get('https://api.themoviedb.org/3/movie/' . $topRatedMovie->movie_id, [
                'api_key' => config('services.tmdb.token'),
            ])->json();

            $topRatedMovie->title = $response['title'];
            $topRatedMovie->poster_path = $response['poster_path'];
            $topRatedMovie->id = $response['id'];
            $topRatedMovie->release_date = $response['release_date'];

            $topRatedMovies[] = $topRatedMovie;
        }

        $lastReviews = Review::orderBy('created_at', 'desc')->with('user:id,username,avatar')->take(3)->get();

        Review::addMovieToReview($lastReviews);

        return view('home', [
            'topRatedMovies' => $topRatedMovies,
            'lastReviews' => $lastReviews,
        ]);
    }
}
