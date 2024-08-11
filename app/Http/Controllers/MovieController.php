<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\TmdbResult;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
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

    public function show(string $media, string $mediaType): View
    {
        $TmdbResult = new TmdbResult();
        $response = $TmdbResult->show($media, $mediaType);

        if ($response === 'No results found') {
            abort(404);
        }

        $response['credits'] = $this->getCreditsByMovieId($response['id'], $mediaType);

        $director = null;
        if ($mediaType === 'movie') {
            $directorFromCast = array_filter($response['credits']['crew'], function ($crew) {
                return $crew['job'] === 'Director';
            });

            foreach ($directorFromCast as $dir) {
                $director[] = [
                    'name' => $dir['name'],
                    'id' => $dir['id'],
                ];
            }
        } else {
            foreach ($response['created_by'] as $creator) {
                $director[] = [
                    'name' => $creator['name'],
                    'id' => $creator['id'],
                ];
            }
        }

        $favorites = User::where('favorite_media', 'like', "%{$response['id']}%")->count();

        $note = Review::whereJsonContains('movie->id', (string)$response['id'])->avg('note');

        return view('movies.show', [
            'movie' => $response,
            'director' => $director,
            'favorites' => $favorites,
            'note' => $note,
        ]);
    }

    public function mediaToFavorite(string $id, string $mediaType, string $media)
    {
        $user = request()->user();

        $favoriteMedias = json_decode($user->favorite_media, true);

        if (!is_array($favoriteMedias)) {
            $favoriteMedias = [];
        }

        if (array_key_exists($id, $favoriteMedias)) {
            unset($favoriteMedias[$id]);

            $user->favorite_media = $favoriteMedias;

            $user->save();

            return back()->with('success', 'Movie successfully removed from favorites');
        }

        $favoriteMedias[$id] = ['mediaType' => $mediaType, 'media' => $media];

        $user->favorite_media = $favoriteMedias;
        $user->save();

        return back()->with('success', 'Movie added to favorites');
    }

    public function searchForDirectorMedia(int $person, string $slug): View
    {
        $name = Str::title(str_replace('_', ' ', $slug));

        $TmdbResult = new TmdbResult();
        $response = $TmdbResult->searchByDirector($person);

        return view('movies.directors', [
            'response' => $response,
            'name' => $name,
        ]);
    }

    protected function getCreditsByMovieId(string $movie, string $mediaType): array
    {
        $response = Http::get("https://api.themoviedb.org/3/{$mediaType}/{$movie}/credits", [
            'api_key' => config('services.tmdb.token')
        ]);

        return $response->json();
    }
}
