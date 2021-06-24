<?php

namespace App\Http\Livewire\Document;

use App\Constants\Gender;
use App\Constants\Religion;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Upload extends Component
{
    public $criterias;
    
    /** @var string */
    public $nik;

    /** @var string */
    public $phone;

    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var string */
    public $gender;

    /** @var string */
    public $birth_place;

    /** @var string */
    public $birth_date;

    /** @var string */
    public $religion;

    public function mount($user)
    {
        $this->nik = $user->nik;
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->birth_date = Carbon::parse($user->birth_date)->translatedFormat('d F Y');
        $this->birth_place = $user->birth_place;
        $this->gender = Gender::label($user->gender);
        $this->religion = Religion::label($user->religion);
    }

    public function upload()
    {
        dd(request()->all());
    }

    public function render()
    {
        return view('livewire.document.upload')->extends('layouts.app');
    }
}
