<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\Setting;
use App\Models\SettingEmail;
use Illuminate\Database\Seeder;
use App\Models\SettingReqruitment;
use Illuminate\Database\Eloquent\Model;

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
            'site_logo' => 'storage/logo/kpu.png',
            'site_logo_text' => 'Komisi Pemilihan Umum Kota Lubuk Linggau',
            'created_by' => 1,
        ]);

        SettingEmail::create([
            'mail_driver' => 'smtp',
            'mail_host' => 'smtp.mailtrap.io',
            'mail_port' => '2525',
            'mail_username' => '05a3cd2df1e7e7',
            'mail_password' => 'd3c55edc7c38f8',
            'mail_encryption' => 'tls',
            'mail_from_address' => 'noreply@kpu.com',
            'mail_from_name' => 'KPU Email Broadcaster',
            'created_by' => 1
        ]);

        SettingReqruitment::create([
            'pas_min' => 65.00,
            'req_status' => Status::ACTIVE->value, // status penerimaan
            'created_by' => 1
        ]);
    }
}
