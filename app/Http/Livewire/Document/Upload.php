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

    /** @var object|array */
    public $criteria;

    /** @var string */
    public $pid;
    public $nik;
    public $phone;
    public $name;
    public $email;
    public $gender;
    public $birth_place;
    public $birth_date;
    public $religion;

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

    public function upload()
    {
        dd(request()->all()['serverMemo']['data']);
    }

    public function render()
    {
        return view('livewire.document.upload');
    }
}
