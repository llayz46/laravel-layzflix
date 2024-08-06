<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public static function favorites(User $user, Int|bool $elements = false): array|null
    {
        if($user->favorite_media) {
            $favoriteMedia = json_decode($user->favorite_media, true);

            if ($elements) {
                $keys = array_keys($favoriteMedia);
                $last_keys = array_slice($keys, 0, $elements);
                $favoriteMedia = array_intersect_key($favoriteMedia, array_flip($last_keys));
            }

            $medias = [];
            foreach ($favoriteMedia as $id => $media) {
                $TmdbResult = new TmdbResult();
                $response = $TmdbResult->show($id, $media['mediaType']);

                $medias[] = $response;
            }

            return $medias;
        }

        return null;
    }

    public static function getNumberOfFavoritesMovies(User $user): int
    {
        if($user->favorite_media) {
            $favoriteMedia = json_decode($user->favorite_media, true);
            return count($favoriteMedia);
        }

        return 0;
    }
}
