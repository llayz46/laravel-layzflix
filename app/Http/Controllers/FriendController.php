<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;

class FriendController extends Controller
{
    public function add(User $user)
    {
        $authUser = auth()->user();

        if ($authUser->isFriendWith($user)) {
            return back()->with('error', 'You are already friends with this user.');
        }

        Friend::create([
            'user_id' => $authUser->id,
            'friend_id' => $user->id,
        ]);

        return back()->with('success', 'Friend added successfully');
    }

    public function delete(User $user)
    {
        if (auth()->user()->isFriendWith($user)) {
            Friend::where('user_id', auth()->id())->where('friend_id', $user->id)->delete();

            return back()->with('success', 'Friend deleted successfully');
        }

        return back()->with('error', 'You are not friends with this user.');
    }
}
