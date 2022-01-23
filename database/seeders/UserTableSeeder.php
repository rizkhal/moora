<?php

namespace Database\Seeders;

use App\Models\User;
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

        $this->participan();
    }

    private function participan()
    {
        for ($i = 0; $i <= 4; $i++) {
            User::create([
                'name' => "Peserta {$i}",
                'email' => "p{$i}@mail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('secret123'),
            ])->assignRole('Peserta');
        }
    }
}
