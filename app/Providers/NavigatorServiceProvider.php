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

            Nav::item(__('Data'))->subItems([
                Nav::item(__('Partisipan'))->for('/participan')
                    ->heroicon('UserGroupIcon')->icon('solid'),

                Nav::item(__('Kriteria'))->for('/logistics/master/necessity')
                    ->heroicon('BadgeCheckIcon')->icon('solid'),

                Nav::item(__('Pengumuman'))->for('/logistics/master/supplier')
                    ->heroicon('SpeakerphoneIcon')->icon('solid'),
            ]),

            Nav::item(__('Pengaturan'))->subItems([
                Nav::item(__('Situs'))->for('/setting/site')
                    ->heroicon('GlobeIcon')->icon('solid'),

                Nav::item(__('Seleksi'))->for('/setting/criteria')
                    ->heroicon('ClipboardListIcon')->icon('outline'),

                Nav::item(__('Hak Akses'))->for('/setting/role')
                    ->heroicon('LockClosedIcon')->icon('solid'),
            ]),
        ]);
    }
}
