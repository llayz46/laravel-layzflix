<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;

class FollowerController extends Controller
{
    public function add(User $user)
    {
        $authUser = auth()->user();

        if ($authUser->isFollowing($user)) {
            return back()->with('error', 'You are already friends with this user.');
        }

        Follower::create([
            'user_id' => $authUser->id,
            'friend_id' => $user->id,
        ]);

        return back()->with('success', 'Follower added successfully');
    }

    public function delete(User $user)
    {
        if (auth()->user()->isFollowing($user)) {
            Follower::where('user_id', auth()->id())->where('friend_id', $user->id)->delete();

            return back()->with('success', 'Follower deleted successfully');
        }

        return back()->with('error', 'You are not friends with this user.');
    }
}
