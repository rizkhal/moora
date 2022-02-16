<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    public function notice(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        return inertia('auth/notice');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        $request->user()->sendEmailVerificationNotification();
        return redirect()->back();
    }

    public function verify(string $id, string $hash)
    {
        if (!hash_equals((string) $id, (string) user()->getKey())) {
            throw new AuthorizationException();
        }

        if (!hash_equals((string) $hash, sha1(user()->getEmailForVerification()))) {
            throw new AuthorizationException();
        }

        if (user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        if (user()->markEmailAsVerified()) {
            event(new Verified(user()));
        }

        return redirect()->route('home');
    }
}
