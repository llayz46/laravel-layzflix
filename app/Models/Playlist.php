<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Playlist extends Model
{
    protected $fillable = ['name', 'user_id', 'medias'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getMedias()
    {
        $medias = [];

        foreach (json_decode($this->medias, true) as $key => $media) {
            $medias[] = [
                'id' => $key,
                'media_type' => $media['type'],
                'normalized_title' => $media['title'],
                'poster_path' => $media['poster'],
            ];
        }

        return $medias;
    }
}
