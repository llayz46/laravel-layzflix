<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileAvatarRequest;
use App\Http\Requests\UserPublicProfileRequest;
use App\Models\Friend;
use App\Models\Movie;
use App\Models\Review;
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
        $movies = Movie::favorites($user, true);

        if($user->reviews()) {
            $lastReviews = $user->reviews()->orderBy('created_at', 'desc')->take(4)->get(['comment', 'note', 'created_at', 'movie_id']);

            Review::addMovieToReview($lastReviews);
        }

        $numberOfMovies = Movie::getNumberOfFavoritesMovies($user);

        $numberOfReviews = Review::where('user_id', $user->id)->count();

        return view('profile.index', [
            'user' => $user,
            'movies' => $movies ?? [],
            'numberOfMovies' => $numberOfMovies,
            'lastReviews' => $lastReviews ?? [],
            'numberOfReviews' => $numberOfReviews,
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

    public function reviews(User $user): View
    {
        $reviews = $user->reviews()->orderBy('created_at', 'desc')->paginate(10);

        Review::addMovieToReview($reviews);

        $movies = Movie::getNumberOfFavoritesMovies($user);

        $numberOfReviews = Review::where('user_id', $user->id)->count();

        return view('profile.reviews', [
            'user' => $user,
            'reviews' => $reviews,
            'movies' => $movies,
            'numberOfReviews' => $numberOfReviews,
        ]);
    }

    public function favorites(User $user): View
    {
        $movies = Movie::favorites($user);

        $numberOfReviews = Review::where('user_id', $user->id)->count();

        return view('profile.favorites', [
            'user' => $user,
            'movies' => $movies ?? [],
            'numberOfReviews' => $numberOfReviews,
            'numberOfMovies' => Movie::getNumberOfFavoritesMovies($user),
        ]);
    }

    public function friends()
    {
        $friendsIds = Friend::where('user_id', auth()->id())->pluck('friend_id')->toArray();
        $friends = User::whereIn('id', $friendsIds)->select('username', 'bio', 'avatar', 'id')->paginate(10);

        return view('friend.index', [
            'user' => auth()->user(),
            'friends' => $friends,
        ]);
    }
}
