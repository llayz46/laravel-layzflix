<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileAvatarRequest;
use App\Http\Requests\UserPublicProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(User $user): View
    {
        if($user->favorite_films) {
            $favoriteFilms = json_decode($user->favorite_films, true);

            $favoriteFilms = array_slice($favoriteFilms, -5);
            $favoriteFilms = array_reverse($favoriteFilms);

            foreach ($favoriteFilms as $movie) {
                $response = Http::get("https://api.themoviedb.org/3/movie/{$movie}", [
                    'api_key' => config('services.tmdb.token'),
                ]);

                $movies[] = $response->json();
            }
        }

        return view('profile.index', [
            'user' => $user,
            'movies' => $movies ?? [],
        ]);
    }

    public function updateInformation(UserPublicProfileRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user = $request->user();

        $user->update($data);

        return back()->with('success', 'Information updated successfully');
    }

    public function updateImage(ProfileAvatarRequest $request): RedirectResponse
    {
        /** @var UploadedFile $image */
        $image = $request->validated('avatar');

        if ($image->getError()) {
            return back()->with('error', 'Image upload failed');
        }

        if ($request->user()->avatar) {
            Storage::disk('public')->delete($request->user()->avatar);
        }

        $imagePath = $image->store('avatars', 'public');

        $request->user()->update([
            'avatar' => $imagePath,
        ]);

        return back()->with('success', 'Image updated successfully');
    }
}
