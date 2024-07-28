<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Http;

class Movie extends Model
{
    public static function favorites(User $user, Bool $slice = false): array|null
    {
        if($user->favorite_films) {
            $favoriteFilms = json_decode($user->favorite_films, true);

            if ($slice) {
                $favoriteFilms = array_slice($favoriteFilms, -5);
            }

            $favoriteFilms = array_reverse($favoriteFilms);

            $movies = [];

            foreach ($favoriteFilms as $movie) {
                $response = Http::get("https://api.themoviedb.org/3/movie/{$movie}", [
                    'api_key' => config('services.tmdb.token'),
                ]);

                $movies[] = $response->json();
            }

            return $movies;
        }

        return null;
    }

    public static function getNumberOfFavoritesMovies(User $user): int
    {
        if($user->favorite_films) {
            $favoriteFilms = json_decode($user->favorite_films, true);
            return count($favoriteFilms);
        }

        return 0;
    }
}
