<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;

class FriendController extends Controller
{
    public function add(User $user)
    {
        if ($user->isFriendWith(auth()->user())) {
            return back()->with('error', 'You are already friends with this user.');
        }

        Friend::create([
            'user_id' => auth()->id(),
            'friend_id' => $user->id,
        ]);

        Friend::create([
            'user_id' => $user->id,
            'friend_id' => auth()->id(),
        ]);

        return back()->with('success', 'Friend added successfully');
    }

    public function delete(User $user)
    {
        if ($user->isFriendWith(auth()->user())) {
            Friend::where('user_id', auth()->id())->where('friend_id', $user->id)->delete();
            Friend::where('user_id', $user->id)->where('friend_id', auth()->id())->delete();

            return back()->with('success', 'Friend deleted successfully');
        }

        return back()->with('error', 'You are not friends with this user.');
    }
}
