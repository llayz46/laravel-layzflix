<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class MovieController extends Controller
{
    public function search(Request $request): View
    {
        $query = $request->input('search');
        $page = $request->input('page', 1);

        $response = Http::get('https://api.themoviedb.org/3/search/movie', [
            'api_key' => config('services.tmdb.token'),
            'query' => $query,
            'page' => $page,
        ]);

        $results = $response->json();
        $totalPages = $results['total_pages'];

        return view('movies.browse', [
            'response' => $results,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'query' => $query,
        ]);
    }

    private function getMovieGenreNameByGenreId(Array $movie): array {
        $response = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
            'api_key' => config('services.tmdb.token'),
        ]);

        $genres = $response['genres'];
        $genreIds = $movie['genre_ids'];

        foreach ($genreIds as $genreId) {
            foreach ($genres as $genre) {
                if ($genre['id'] === $genreId) {
                    $movie['genre_names'][] = $genre['name'];
                }
            }
        }

        return $movie;
    }
}
