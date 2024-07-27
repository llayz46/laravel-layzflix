<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function show(String $movie)
    {
        $response = Http::get("https://api.themoviedb.org/3/movie/{$movie}", [
            'api_key' => config('services.tmdb.token'),
        ]);

        $movie = $response->json();
        $movie['credits'] = $this->getCreditsByMovieId($movie['id']);

        $directorFromCast = array_filter($movie['credits']['crew'], function ($crew) {
            return $crew['job'] === 'Director';
        });
        $director = (new Collection($directorFromCast))->first();

        $favorites = User::where('favorite_films', 'like', "%{$movie['id']}%")->count();

        $reviews = Review::with('user:id,username,avatar')->where('movie_id', $movie['id'])->get();

        return view('movies.show', [
            'movie' => $movie,
            'director' => $director,
            'favorites' => $favorites,
            'reviews' => $reviews,
        ]);
    }

    public function movieToFavorite(String $movie)
    {
        $user = request()->user();

        $favoriteFilms = json_decode($user->favorite_films, true);

        if(!is_array($favoriteFilms)) {
            $favoriteFilms = [];
        }

        if (in_array($movie, $favoriteFilms)) {
            $key = array_search($movie, $favoriteFilms);

            unset($favoriteFilms[$key]);

            $user->update([
                'favorite_films' => json_encode($favoriteFilms),
            ]);

            $user->save();

            return back()->with('success', 'Movie successfully removed from favorites');
        }

        $favoriteFilms = array_merge($favoriteFilms, [$movie]);

        $user->update([
            'favorite_films' => json_encode($favoriteFilms),
        ]);

        return back()->with('success', 'Movie added to favorites');
    }

//    private function getMovieGenreNameByGenreId(Array $movie): array
//    {
//        $response = Http::get('https://api.themoviedb.org/3/genre/movie/list', [
//            'api_key' => config('services.tmdb.token'),
//        ]);
//
//        $genres = $response['genres'];
//        $genreIds = $movie['genre_ids'];
//
//        foreach ($genreIds as $genreId) {
//            foreach ($genres as $genre) {
//                if ($genre['id'] === $genreId) {
//                    $movie['genre_names'][] = $genre['name'];
//                }
//            }
//        }
//
//        return $movie;
//    }

    protected function getCreditsByMovieId(String $movie): array
    {
        $response = Http::get("https://api.themoviedb.org/3/movie/{$movie}/credits", [
            'api_key' => config('services.tmdb.token')
        ]);

        return $response->json();
    }
}
