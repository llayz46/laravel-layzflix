<?php

namespace App\Http\Controllers;

use App\Models\User;

class PaymentController extends Controller
{
    public function index()
    {
        return view('subscribe');
    }

    public function store(User $user)
    {
        $user->subscribe();

        return redirect()->route('profile.index', $user)->with('success', 'You are now subscribed!');
    }
}
