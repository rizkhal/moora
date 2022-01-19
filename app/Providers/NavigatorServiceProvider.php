<?php

namespace App\Providers;

use Nedwors\Navigator\Facades\Nav;
use Illuminate\Support\ServiceProvider;

class NavigatorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Nav::define(fn ($user) => [
            Nav::item(__('Overview'))->subItems([
                Nav::item(__('Dashboard'))->for('/home')
                    ->heroicon('HomeIcon')->icon('solid'),

                Nav::item(__('Verifikasi'))->for('/participan/verification')
                    ->heroicon('BadgeCheckIcon')->icon('solid')
                    ->when($user->can('lihat-verivakasi')),

                Nav::item(__('Upload Berkas'))->for('/participan/complete-registration')
                    ->heroicon('SparklesIcon')->icon('solid')
                    ->when($user->hasRole('Peserta')),

                Nav::item(__('Pengumuman'))->for('/home')
                    ->heroicon('SpeakerphoneIcon')->icon('solid')
                    ->when($user->hasRole('Peserta')),
            ]),

            Nav::item(__('Master'))->subItems([
                Nav::item(__('Peserta'))->for('/participan')
                    ->heroicon('UserGroupIcon')->icon('solid')
                    ->when($user->can('lihat-peserta')),

                Nav::item(__('Kriteria'))->for('/criteria')
                    ->heroicon('SparklesIcon')->icon('solid')
                    ->when($user->can('lihat-pengumuman')),

                Nav::item(__('Pengumuman'))->for('/announcement')
                    ->heroicon('SpeakerphoneIcon')->icon('solid')
                    ->when($user->can('lihat-pengumuman')),
            ]),

            Nav::item(__('Pengaturan'))->subItems([
                Nav::item(__('Role'))->for('/setting/role')
                    ->heroicon('LockClosedIcon')->icon('solid')
                    ->when($user->can('lihat-role')),

                Nav::item(__('Umum'))->for('/setting/general')
                    ->heroicon('CogIcon')->icon('solid')
                    ->when($user->can('lihat-pengaturan-umum')),

                Nav::item(__('Pengguna'))->for('/setting/user')
                    ->heroicon('UsersIcon')->icon('solid')
                    ->when($user->can('lihat-pengguna')),
            ]),
        ]);
    }
}
