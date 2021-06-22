<?php

namespace App\Http\Livewire\Traits;

use App\Services\Regional;

trait WithRegional
{
    /** @var array */
    public $cities;
    public $districts;
    public $subdistricts;
    
    /** @var string|null */
    public $province;
    public $city;
    public $district;
    public $sub_district;

    public function validateRegional()
    {
        return $this->validate([
            'province' => ['required'],
            'city' => ['required'],
            'district' => ['required'],
            'sub_district' => ['required'],
        ]);
    }

    public function provinces()
    {
        return Regional::provinces();
    }

    public function updatedProvince($value): void
    {
        $this->cities = [];
        $this->districts = [];
        $this->subdistricts = [];
        $this->cities = Regional::cities($value);
    }

    public function updatedCity($value): void
    {
        $this->districts = [];
        $this->subdistricts = [];
        $this->districts = Regional::districts($value);
    }

    public function updatedDistrict($value): void
    {
        $this->subdistricts = Regional::subdistricts($value);
    }
}