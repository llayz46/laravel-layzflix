<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Http;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'comment',
        'note',
        'movie_id',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function addMovieToReview($reviews)
    {
        $movieIds = $reviews->pluck('movie_id')->unique();
        $movies = [];

        foreach ($movieIds as $movieId) {
            $response = Http::get('https://api.themoviedb.org/3/movie/' . $movieId, [
                'api_key' => config('services.tmdb.token'),
            ])->json();
            $movies[$movieId] = $response;
        }

        $reviews->each(function ($review) use ($movies) {
            $review->movie = $movies[$review->movie_id] ?? null;
        });
    }
}
