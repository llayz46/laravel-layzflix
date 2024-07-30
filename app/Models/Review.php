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
        'movie',
        'user_id',
    ];

    protected $casts = [
        'movie' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function addMovieToReview($reviews)
    {
        $medias = $reviews->pluck('movie')->unique();

        $mediasContainer = [];

        foreach ($medias as $media) {
            $TmdbResult = new TmdbResult();
            $response = $TmdbResult->show($media['id'], $media['mediaType']);

            $mediasContainer[$media['id']] = $response;
        }

        $reviews->each(function ($review) use ($mediasContainer) {
            $review->movie = $mediasContainer[$review->movie['id']] ?? null;
        });
    }
}
