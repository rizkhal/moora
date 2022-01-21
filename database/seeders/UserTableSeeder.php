<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\Gender;
use App\Enums\Religion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret123'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Operator',
            'email' => 'operator@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret123'),
        ])->assignRole('Operator');

        User::create([
            'name' => 'Pimpinan',
            'email' => 'pimpinan@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret123'),
        ])->assignRole('Pimpinan');

        $this->user();
    }

    private function user()
    {
        $p1 = User::create([
            'name' => 'Ayu Puspita',
            'email' => 'ayu@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret123'),
        ])->assignRole('Peserta');

        // $p1->detail()->create([
        //     'nik' => '294284294829042',
        //     'phone' => '081234567810',
        //     'gender' => Gender::FEMALE->value,
        // ]);

        $p2 = User::create([
            'name' => 'Mia Khalifa',
            'email' => 'mia@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret123'),
        ])->assignRole('Peserta');

        // $p2->detail()->create([
        //     'nik' => '294848144829042',
        //     'phone' => '081234134810',
        //     'gender' => Gender::FEMALE->value,
        // ]);
    }
}
