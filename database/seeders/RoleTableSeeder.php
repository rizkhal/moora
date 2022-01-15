<?php

namespace Database\Seeders;

use App\Models\User;
use App\Constants\Gender;
use App\Constants\Religion;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        Role::create(['name' => 'Peserta', 'guard_name' => 'web']);

        User::create([
            'nik' => '294284294829042',
            'name' => 'Admin KPU',
            'email' => 'admin@mail.com',
            'phone' => '081234567899',
            'email_verified_at' => now(),
            'password' => Hash::make('secret123'),
            'gender' => Gender::MALE,
            'birth_date' => '1998-01-02',
            'birth_place' => 'Ternate',
            'religion' => Religion::ISLAM,
            'province' => 82, // maluku utara
            'city' => 8271, // ternate
            'district' => 8271030, // ternate utara
            'sub_district' => 8271030018, // sangaji utara.
        ])->assignRole('Admin');

        User::create([
            'nik' => '294284294829042',
            'name' => 'Ayu Puspita',
            'email' => 'ayu@mail.com',
            'phone' => '081234567810',
            'email_verified_at' => now(),
            'password' => Hash::make('secret123'),
            'gender' => Gender::FEMALE,
            'birth_date' => '1998-01-02',
            'birth_place' => 'Ternate',
            'religion' => Religion::ISLAM,
            'province' => 82, // maluku utara
            'city' => 8271, // ternate
            'district' => 8271030, // ternate utara
            'sub_district' => 8271030018, // sangaji utara.
        ])->assignRole('Peserta');

        User::create([
            'nik' => '294284294829042',
            'name' => 'Bujang',
            'email' => 'bujang@mail.com',
            'phone' => '081214567810',
            'email_verified_at' => now(),
            'password' => Hash::make('secret123'),
            'gender' => Gender::FEMALE,
            'birth_date' => '1998-01-02',
            'birth_place' => 'Ternate',
            'religion' => Religion::ISLAM,
            'province' => 82, // maluku utara
            'city' => 8271, // ternate
            'district' => 8271030, // ternate utara
            'sub_district' => 8271030018, // sangaji utara.
        ])->assignRole('Peserta');
    }
}
