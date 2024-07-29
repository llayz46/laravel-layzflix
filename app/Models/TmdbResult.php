<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class TmdbResult extends Model
{
    protected $guarded = [];

    protected function normalizeContent($results, $browse = false)
    {
        if ($browse) {
            if (isset($results['results'])) {
                $results['results'] = collect($results['results'])
                    ->filter(function ($result) {
                        return in_array($result['media_type'], ['movie', 'tv']);
                    })
                    ->map(function ($result) {
                        $result['normalized_title'] = $result['title'] ?? $result['name'];
                        $tmdbResult = new TmdbResult($result);
                        return $tmdbResult->toArray();
                    });

                return $results;
            } else {
                return 'No results found';
            }
        } else {
            $results['normalized_title'] = $results['title'] ?? $results['name'];

            if(isset($results['release_date'])) {
                $results['media_type'] = 'movie';
            } else {
                $results['media_type'] = 'tv';
            }

            return $results;
        }
    }

    public function search($query)
    {
        $response = Http::get('https://api.themoviedb.org/3/search/multi', [
            'query' => $query,
            'api_key' => config('services.tmdb.token'),
        ]);

        $results = $response->json();

        return $this->normalizeContent($results);
    }

    public function show($media, $mediaType)
    {
        $response = Http::get("https://api.themoviedb.org/3/{$mediaType}/{$media}", [
            'api_key' => config('services.tmdb.token'),
        ]);

        $results = $response->json();

        return $this->normalizeContent($results);
    }
}
