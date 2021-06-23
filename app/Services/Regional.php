<?php

// regional select chain

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Regional
{
    public static function get(string $param)
    {
        $response = Http::get(config('regional.endpoint') . "/{$param}.json");
        if ($response->successful()) {
            return object_to_array(json_decode($response->body()));
        }

        return false;
    }
    
    public static function province(int $id)
    {
        return static::get("province/{$id}");
    }

    public static function city(int $id)
    {
        return static::get("regency/{$id}");
    }

    public static function district(int $id)
    {
        return static::get("district/{$id}");
    }

    public static function subdistrict(int $id)
    {
        return static::get("village/{$id}");
    }
    
    /**
     * Get all provinces
     *
     * @return void
     */
    public static function provinces()
    {
        return static::get("provinces");
    }
    
    /**
     * Get cities based on province
     *
     * @return void
     */
    public static function cities(string $province)
    {
        return static::get("regencies/{$province}");
    }

    /**
     * Get districts based on city
     *
     * @return void
     */
    public static function districts(string $city)
    {
        return static::get("districts/{$city}");
    }

    /**
     * Get subdistricts based on district
     *
     * @param string $district
     * @return void
     */
    public static function subdistricts(string $district)
    {
        return static::get("villages/{$district}");
    }
}