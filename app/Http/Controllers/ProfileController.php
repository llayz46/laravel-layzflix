<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileAvatarRequest;
use App\Http\Requests\UserPublicProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(User $user): View
    {
        return view('profile.index', compact('user'));
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
