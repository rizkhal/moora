<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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
        Role::create(['name' => 'Operator', 'guard_name' => 'web']);
        Role::create(['name' => 'Pimpinan', 'guard_name' => 'web']);
    }
}
