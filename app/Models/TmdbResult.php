<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class TmdbResult extends Model
{
    protected $guarded = [];

    protected function normalizeContent($results, $browse = false, $person = false)
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
        } elseif ($person) {
            if (isset($results['success']) && !$results['success']) {
                return 'No results found';
            } else {
                return collect($results['combined_credits']['crew'])
                    ->filter(function ($crew) {
                        return $crew['job'] === 'Director';
                    })
                    ->map(function ($director) {
                        $director['normalized_title'] = $director['title'] ?? $director['name'];
                        return $director;
                    })
                    ->toArray();
            }
        } else {
            if (isset($results['success']) && !$results['success']) {
                return 'No results found';
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
    }

    public function search($query)
    {
        $response = Http::get('https://api.themoviedb.org/3/search/multi', [
            'query' => $query,
            'api_key' => config('services.tmdb.token'),
            'page' => request('page', 1),
        ]);

        $results = $response->json();

        return $this->normalizeContent($results, true);
    }

    public function show($media, $mediaType = null)
    {
        if (!$mediaType) {
            $response = Http::get("https://api.themoviedb.org/3/tv/{$media}", [
                'api_key' => config('services.tmdb.token'),
            ]);

            if (isset($response->json()['success']) && !$response->json()['success'] || !$response->json()['id']) {
                $response = Http::get("https://api.themoviedb.org/3/movie/{$media}", [
                    'api_key' => config('services.tmdb.token'),
                ]);
            }
        } else {
            $response = Http::get("https://api.themoviedb.org/3/{$mediaType}/{$media}", [
                'api_key' => config('services.tmdb.token'),
            ]);
        }

        $results = $response->json();

        return $this->normalizeContent($results);
    }

    public function searchByDirector($person)
    {
        $response = Http::get("https://api.themoviedb.org/3/person/{$person}", [
            'api_key' => config('services.tmdb.token'),
            'append_to_response' => 'combined_credits',
            'page' => request('page', 1),
        ]);

        $results = $response->json();

        return $this->normalizeContent($results, false, true);
    }
}
