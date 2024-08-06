<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaylistRequest;
use App\Models\Playlist;
use App\Models\User;
use Illuminate\Validation\Rules\In;

class PlaylistController extends Controller
{
    public function show(User $user, Playlist $playlist)
    {
        if (!$playlist->is_public) {
            return back()->with('error', 'Playlist is private');
        }

        return view('playlists.show', [
            'playlist' => $playlist,
            'user' => $user,
            'datas' => ProfileController::getHeadersData($user),
        ]);
    }

    public function store(PlaylistRequest $playlistRequest)
    {
        $data = $playlistRequest->validated();

        $playlist = Playlist::create($data);

        return back()->with('success', 'Playlist created successfully');
    }

    public function addMedia()
    {
        $data = request()->validate([
            'playlist' => 'required|string|exists:playlists,id',
            'media_id' => 'required|string',
            'media_title' => 'required|string',
            'media_type' => ['required', 'string', new In(['movie', 'tv'])],
            'media_poster' => 'string',
        ]);

        $playlist = Playlist::find($data['playlist']);

        if ($playlist->user_id !== auth()->id()) {
            return back()->with('error', 'You are not allowed to add media to this playlist');
        }

        $playlistMedias = json_decode($playlist->medias, true);

        if (!is_array($playlistMedias)) {
            $playlistMedias = [];
        }

        if(array_key_exists($data['media_id'], $playlistMedias)) {
            return back()->with('error', 'Media already added to playlist');
        }

        $playlistMedias[$data['media_id']] = ['type' => $data['media_type'], 'title' => $data['media_title'], 'poster' => $data['media_poster']];

        $playlist->medias = $playlistMedias;

        $playlist->save();

        return back()->with('success', 'Media added to playlist successfully');
    }

    public function update(Playlist $playlist)
    {
        if ($playlist->user_id !== auth()->id()) {
            return back()->with('error', 'You are not allowed to update this playlist');
        }

        if($playlist->is_public) {
            $playlist->is_public = false;
        } else {
            $playlist->is_public = true;
        }

        $playlist->save();

        return back()->with('success', 'Playlist updated successfully');
    }

    public function destroy(Playlist $playlist)
    {
        if ($playlist->user_id !== auth()->id()) {
            return back()->with('error', 'You are not allowed to delete this playlist');
        }

        $playlist->delete();

        return back()->with('success', 'Playlist deleted successfully');
    }

    public function deleteMedia()
    {
        $data = request()->validate([
            'playlist' => 'required|string|exists:playlists,id',
            'media_id' => 'required|string',
        ]);

        $playlist = Playlist::find($data['playlist']);

        if ($playlist->user_id !== auth()->id()) {
            return back()->with('error', 'You are not allowed to remove media from this playlist');
        }

        $playlistMedias = json_decode($playlist->medias, true);

        if(!array_key_exists($data['media_id'], $playlistMedias)) {
            return back()->with('error', 'Media is not in this playlist');
        }

        foreach ($playlistMedias as $key => $media) {
            if ($key === (int)$data['media_id']) {
                unset($playlistMedias[$key]);
            }
        }

        $playlist->medias = $playlistMedias;

        $playlist->save();

        return back()->with('success', 'Media removed from playlist successfully');
    }
}
