<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\TmdbResult;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $topRatedMoviesFromReviews = Review::groupBy('movie')
            ->selectRaw('movie, avg(note) as average_note')
            ->orderBy('average_note', 'desc')
            ->take(3)
            ->get();

        $topRatedMovies = [];

        foreach ($topRatedMoviesFromReviews as $topRatedMovie) {
            $TmdbResult = new TmdbResult();
            $response = $TmdbResult->show($topRatedMovie->movie['id'], $topRatedMovie->movie['mediaType']);

            $topRatedMovie->normalized_title = $response['normalized_title'];
            $topRatedMovie->poster_path = $response['poster_path'];
            $topRatedMovie->id = $response['id'];
            $topRatedMovie->media_type = $response['media_type'];
            if ($response['media_type'] === 'movie') {
                $topRatedMovie->release_date = $response['release_date'];
            } else {
                $topRatedMovie->first_air_date = $response['first_air_date'];
            }
            unset($topRatedMovie->movie);

            $topRatedMovies[] = $topRatedMovie;
        }

        $lastReviews = Review::orderBy('created_at', 'desc')->with('user:id,username,avatar')->take(3)->get();
        $topUsers = Review::groupBy('user_id')
            ->selectRaw('user_id, count(*) as reviews_count')
            ->orderBy('reviews_count', 'desc')
            ->with('user:id,username,avatar,bio')
            ->take(3)
            ->get();

        return view('home', [
            'topRatedMovies' => $topRatedMovies,
            'lastReviews' => $lastReviews,
            'topUsers' => $topUsers,
        ]);
    }
}
