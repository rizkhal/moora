<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\Gender;
use App\Models\Criteria;
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
            'criterias' => Criteria::with(['texts', 'options'])->get(),
        ]);
    }

    public function store(CompleteRegistrationRequest $request)
    {
        user()->detail()->create($request->common());

        return redirect()->back();
    }
}
