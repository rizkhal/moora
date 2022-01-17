<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function view()
    {
        return inertia('auth/register');
    }

    public function register(RegisterRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create($request->dataUser());
            $user->assignRole('Peserta');

            Auth::login($user, true);

            event(new Registered($user));

            return redirect()->intended(route('home'));
        });

        return redirect()->back()->with('error', 'Something went wrong');
    }
}
