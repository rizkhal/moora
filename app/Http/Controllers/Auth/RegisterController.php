<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Reqruitment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Inertia\Response;

class RegisterController extends Controller
{
    public function view(Reqruitment $reqruitment): Response
    {
        return inertia('auth/register')->with([
            'reqruitments' => $reqruitment->active()->select(['id', 'name'])->get(),
        ]);
    }

    public function register(RegisterRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create($request->getUserData());
            $user->assignRole('Peserta');

            $user->reqruitments()->sync([
                'reqruitment_id' => $request->getReqruitment()
            ]);

            Auth::login($user, true);

            event(new Registered($user));

            return redirect()->intended(route('home'));
        });

        return back();
    }
}
