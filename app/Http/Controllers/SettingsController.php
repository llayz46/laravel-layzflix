<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePasswordRequest;
use App\Http\Requests\UserInformationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index', [
            'user' => auth()->user()
        ]);
    }

    public function update(UserInformationRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return back()->with('success', 'Profile updated successfully');
    }

    public function updatePassword(ProfilePasswordRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $request->user()->update([
            'password' => Hash::make($data['new_password']),
        ]);

        return back()->with('success', 'Password updated successfully');
    }
}
