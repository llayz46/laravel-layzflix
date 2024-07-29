<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\TmdbResult;
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

        $TmdbResult = new TmdbResult();
        $results = $TmdbResult->search($query);

        $totalPages = $results['total_pages'];

        return view('movies.browse', [
            'response' => $results,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'query' => $query,
        ]);
    }

    public function show(String $media, String $mediaType): View
    {
        $TmdbResult = new TmdbResult();
        $response = $TmdbResult->show($media, $mediaType);

        $response['credits'] = $this->getCreditsByMovieId($response['id'], $mediaType);

        $director = '';
        if ($mediaType === 'movie') {
            $directorFromCast = array_filter($response['credits']['crew'], function ($crew) {
                return $crew['job'] === 'Director';
            });
            $director = (new Collection($directorFromCast))->first(); // A la place un foreach ?
        } else {
            $directorFromCast = array_filter($response['credits']['crew'], function ($crew) {
                return $crew['job'] === 'Producer';
            });
            $director = (new Collection($directorFromCast))->first(); // A la place un foreach ?
        }

        $favorites = User::where('favorite_films', 'like', "%{$response['id']}%")->count();

        $reviews = Review::with('user:id,username,avatar')->where('movie_id', $response['id'])->paginate(5);

        $note = Review::where('movie_id', $response['id'])->avg('note');

        return view('movies.show', [
            'movie' => $response,
            'director' => $director,
            'favorites' => $favorites,
            'reviews' => $reviews,
            'note' => $note,
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

    protected function getCreditsByMovieId(String $movie, String $mediaType): array
    {
        $response = Http::get("https://api.themoviedb.org/3/{$mediaType}/{$movie}/credits", [
            'api_key' => config('services.tmdb.token')
        ]);

        return $response->json();
    }
}
