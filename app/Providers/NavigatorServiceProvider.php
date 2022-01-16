<?php

namespace App\Providers;

use Nedwors\Navigator\Facades\Nav;
use Illuminate\Support\ServiceProvider;

class NavigatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Nav::define(fn ($user) => [
            Nav::item(__('Beranda'))->for('/home')
                ->heroicon('HomeIcon')->icon('solid'),

            Nav::item(__('Master'))->subItems([
                Nav::item(__('Peserta'))->for('/participan')
                    ->heroicon('UserGroupIcon')->icon('solid'),

                Nav::item(__('Kriteria'))->for('/criteria')
                    ->heroicon('BadgeCheckIcon')->icon('solid'),

                Nav::item(__('Pengumuman'))->for('/announcement')
                    ->heroicon('SpeakerphoneIcon')->icon('solid'),
            ]),

            Nav::item(__('Pengaturan'))->subItems([
                Nav::item(__('Role'))->for('/setting/role')
                    ->heroicon('LockClosedIcon')->icon('solid'),

                Nav::item(__('Umum'))->for('/setting/general')
                    ->heroicon('CogIcon')->icon('solid'),

                Nav::item(__('Pengguna'))->for('/setting/user')
                    ->heroicon('UsersIcon')->icon('solid'),
            ]),
        ]);
    }
}
