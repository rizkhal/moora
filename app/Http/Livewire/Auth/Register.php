<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use App\Constants\Gender;
use App\Constants\Religion;
use App\Http\Livewire\Traits\WithRegional;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    use WithRegional;

    public $stepper = 1;

    /** @var string */
    public $nik;

    /** @var string */
    public $phone;

    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /** @var string */
    public $passwordConfirmation;

    /** @var string */
    public $gender;

    /** @var string */
    public $birth_place;

    /** @var string */
    public $birth_date;

    /** @var string */
    public $religion;

    /** @var array */
    public $validated;

    public function firstStepSubmit()
    {
        $this->validated = $this->validate([
            'nik' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'min:11', 'unique:users'],
            'password' => ['required', 'min:8', 'same:passwordConfirmation'],
            'passwordConfirmation' => ['required'],
        ]);

        $this->stepper = 2;
    }

    public function secondStepSubmit()
    {
        $validated = $this->validate([
            'gender' => ['required'],
            'birth_place' => ['required'],
            'birth_date' => ['required'],
            'religion' => ['required']
        ]);

        $this->validated = array_merge($this->validated, $validated);

        $this->stepper = 3;
    }

    public function register()
    {
        $validated = array_merge($this->validated, $this->validateRegional());

        $validated['password'] = Hash::make($validated['password']);
        $validated['birth_date'] = date('Y-m-d', strtotime($validated['birth_date']));
        unset($validated['passwordConfirmation']);

        $user = User::create($validated);

        $user->assignRole('Participan');
        
        Auth::login($user, true);

        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.register', [
            'genders' => Gender::labels(),
            'religions' => Religion::labels(),
            'provinces' => $this->provinces(),
        ])->extends('layouts.auth');
    }
}
