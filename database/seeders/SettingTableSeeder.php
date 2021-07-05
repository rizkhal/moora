<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Setting::create([
            'site_name' => 'Komisi Pemilihan Umum',
            'site_description' => 'Situs Seleksi Pegawai KPU',
            'site_landing_title' => ' Indonesia memanggil.',
            'site_landing_description' => 'Ayoo gabung dengan KPU sekarang juga. bersama KPU kita bangun indonesia yang demokratis!',
            'site_logo' => 'storage/logo/default.svg',
            'site_logo_text' => 'Komisi Pemilihan Umum Kota Lubuk Linggau',
            'created_by' => 1,
        ]);
    }
}
