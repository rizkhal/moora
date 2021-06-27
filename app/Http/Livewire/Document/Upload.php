<?php

namespace App\Http\Livewire\Document;

use App\Models\User;
use Livewire\Component;
use App\Constants\Gender;
use App\Constants\Religion;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class Upload extends Component
{
    use WithFileUploads;

    /** @var string */
    public $pid;

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

    /** @var object */
    public $diploma;

    /** @var object */
    public $disease_history;

    public function mount($user)
    {
        $this->pid = $user->id;
        $this->nik = $user->nik;
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->birth_date = Carbon::parse($user->birth_date)->translatedFormat('d F Y');
        $this->birth_place = $user->birth_place;
        $this->gender = Gender::label($user->gender);
        $this->religion = Religion::label($user->religion);
    }

    public function updatedDiploma()
    {
        // $this->validate([
        //     'diploma' => 'max:1024',
        // ]);
    }

    public function updatedDiseaseHistory()
    {
        // $this->validate([
        //     'disease_history' => 'max:1024',
        // ]);
    }

    public function upload()
    {
        $this->validate([
            'diploma' => 'required',
            'disease_history' => 'required',
        ]);

        try {
            $diploma = $this->diploma->store('documents');
            $disease = $this->disease_history->store('documents');

            User::query()->whereId($this->pid)->first()
                ->detail()->create([
                    'diploma' => $diploma,
                    'disease_history' => $disease,
                    'user_id' => $this->pid,
                ]);

            return redirect()->route('home');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.document.upload')->extends('layouts.app');
    }
}
