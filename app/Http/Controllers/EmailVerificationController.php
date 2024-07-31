<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EmailVerificationController extends Controller
{
    public function verifyView(): RedirectResponse|View
    {
        return auth()->user()->hasVerifiedEmail() ? redirect()->intended(route('home')) : view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();

        return redirect()->intended(route('home'));
    }
}
