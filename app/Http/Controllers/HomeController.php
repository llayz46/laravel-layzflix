<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $response = Http::get('https://api.themoviedb.org/3/movie/top_rated', [
            'api_key' => config('services.tmdb.token'),
        ])->json();

        $topRatedMovies = collect($response['results'])->take(3);

        return view('home', compact('topRatedMovies'));
    }
}
