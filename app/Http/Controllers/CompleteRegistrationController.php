<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\Gender;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CompleteRegistrationRequest;

class CompleteRegistrationController extends Controller
{
    public function view()
    {
        $genders = collect(Gender::cases())->mapWithKeys(fn ($item) => [$item->value => Str::title($item->label())]);

        return inertia('participan/complete-registration', [
            'genders' => $genders,
            'user' => User::with('participan')->find(user()->id),
        ]);
    }

    public function store(CompleteRegistrationRequest $request)
    {
        dd($request->validated());
    }
}
