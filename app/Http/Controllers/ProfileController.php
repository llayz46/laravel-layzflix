<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileAvatarRequest;
use App\Http\Requests\UserPublicProfileRequest;
use App\Models\Follower;
use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(User $user): View
    {
        $movies = Movie::favorites($user, 5);

        if($user->reviews()) {
            $lastReviews = $user->reviews()->orderBy('created_at', 'desc')->take(4)->get(['comment', 'note', 'created_at', 'movie']);

            Review::addMovieToReview($lastReviews);
        }

        $numberOfMovies = Movie::getNumberOfFavoritesMovies($user);

        $numberOfReviews = Review::where('user_id', $user->id)->count();

        $followers = Follower::where('friend_id', $user->id)->count();

        if($user == auth()->user()) {
            $playlists = $user->playlists()->orderBy('created_at', 'desc')->take(4)->get();
        } else {
            $playlists = $user->playlists()->where('is_public', true)->orderBy('created_at', 'desc')->take(4)->get();
        }

        return view('profile.index', [
            'user' => $user,
            'movies' => $movies ?? [],
            'numberOfMovies' => $numberOfMovies,
            'lastReviews' => $lastReviews ?? [],
            'numberOfReviews' => $numberOfReviews,
            'followers' => $followers,
            'playlists' => $playlists,
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
        $page = request()->get('page', 1);

        $movies = Movie::favorites($user);
        $movies = collect($movies)->forPage($page, 10);

        $totalPages = ceil(count($movies) / 10);

        $numberOfReviews = Review::where('user_id', $user->id)->count();

        return view('profile.favorites', [
            'user' => $user,
            'movies' => $movies ?? [],
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'numberOfReviews' => $numberOfReviews,
            'numberOfMovies' => Movie::getNumberOfFavoritesMovies($user),
        ]);
    }

    public function following()
    {
        $friendsIds = Follower::where('user_id', auth()->id())->pluck('friend_id')->toArray();
        $friends = User::whereIn('id', $friendsIds)->select('username', 'bio', 'avatar', 'id')->paginate(10);

        return view('friend.index', [
            'user' => auth()->user(),
            'friends' => $friends,
        ]);
    }

    public function followers()
    {
        $user = auth()->user();

        if(!$user->isPremium()) {
            return back()->with('error', 'You need to be a premium user to access this feature.');
        }

        $followers = Follower::where('friend_id', auth()->id())->with('user:id,username')->paginate(10);

        return view('friend.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    public function playlists(User $user)
    {
        if($user == auth()->user()) {
            $playlists = $user->playlists()->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $playlists = $user->playlists()->where('is_public', true)->orderBy('created_at', 'desc')->paginate(10);
        }

        $numberOfReviews = Review::where('user_id', $user->id)->count();
        $numberOfMovies = Movie::getNumberOfFavoritesMovies($user);

        $page = request()->get('page', 1);
        $totalPages = ceil(count($playlists) / 10);

        return view('profile.playlists', [
            'playlists' => $playlists,
            'numberOfReviews' => $numberOfReviews,
            'numberOfMovies' => $numberOfMovies,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'user' => $user,
        ]);
    }

    public static function getHeadersData(User $user)
    {
        return [
            'reviews' => $numberOfReviews = Review::where('user_id', $user->id)->count(),
            'movies' => $numberOfMovies = Movie::getNumberOfFavoritesMovies($user),
            'followers' => $followers = Follower::where('friend_id', $user->id)->count(),
        ];
    }
}
