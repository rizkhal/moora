<?php

namespace Database\Seeders;

use App\Enums\PermissionType;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

        $this->admin();
    }

    private function admin()
    {
        // create
        Permission::create(['name' => 'tambah-role', 'description' => 'Tambah Role', 'type' => PermissionType::CREATE->value]);
        Permission::create(['name' => 'tambah-permission', 'description' => 'Tambah Permission', 'type' => PermissionType::CREATE->value]);
        Permission::create(['name' => 'tambah-pengguna', 'description' => 'Tambah pengguna', 'type' => PermissionType::CREATE->value]);
        Permission::create(['name' => 'tambah-pengumuman', 'description' => 'Tambah pengumuman', 'type' => PermissionType::CREATE->value]);

        // read
        Permission::create(['name' => 'lihat-dashboard', 'description' => 'Lihat dashboard', 'type' => PermissionType::READ->value]);
        Permission::create(['name' => 'lihat-peserta', 'description' => 'Lihat peserta', 'type' => PermissionType::READ->value]);
        Permission::create(['name' => 'lihat-pengumuman', 'description' => 'Lihat pengumuman', 'type' => PermissionType::READ->value]);
        Permission::create(['name' => 'lihat-role', 'description' => 'Lihat role', 'type' => PermissionType::READ->value]);
        Permission::create(['name' => 'lihat-permission', 'description' => 'Lihat permission', 'type' => PermissionType::READ->value]);
        Permission::create(['name' => 'lihat-pengguna', 'description' => 'Lihat pengguna', 'type' => PermissionType::READ->value]);
        Permission::create(['name' => 'lihat-pengaturan-umum', 'description' => 'Lihat pengaturan umum', 'type' => PermissionType::READ->value]);

        // update
        Permission::create(['name' => 'ubah-role', 'description' => 'Ubah role', 'type' => PermissionType::UPDATE->value]);
        Permission::create(['name' => 'ubah-permission', 'description' => 'Ubah role', 'type' => PermissionType::UPDATE->value]);
        Permission::create(['name' => 'ubah-pengguna', 'description' => 'Ubah pengguna', 'type' => PermissionType::UPDATE->value]);
        Permission::create(['name' => 'ubah-pengumuman', 'description' => 'Ubah pengumuman', 'type' => PermissionType::UPDATE->value]);
        Permission::create(['name' => 'ubah-pengaturan-umum', 'description' => 'Ubah pengaturan umum', 'type' => PermissionType::UPDATE->value]);

        // delete
        Permission::create(['name' => 'hapus-role', 'description' => 'Hapus role', 'type' => PermissionType::DELETE->value]);
        Permission::create(['name' => 'hapus-permission', 'description' => 'Hapus permission', 'type' => PermissionType::DELETE->value]);
        Permission::create(['name' => 'hapus-pengguna', 'description' => 'Hapus pengguna', 'type' => PermissionType::DELETE->value]);
        Permission::create(['name' => 'hapus-pengumuman', 'description' => 'Hapus pengumuman', 'type' => PermissionType::DELETE->value]);

        // verifikasi
        Permission::create(['name' => 'lihat-verivakasi', 'description' => 'Lihat verifikasi', 'type' => PermissionType::READ->value]);
        Permission::create(['name' => 'verikasi-peserta', 'description' => 'Verifikasi peserta', 'type' => PermissionType::CREATE->value]);

        Role::findByName('Admin')->syncPermissions(Permission::all());

        return $this;
    }
}
