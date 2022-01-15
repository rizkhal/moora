<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\SettingReqruitment;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(DirectiveServiceProvider::class);
        $this->app->register(NavigatorServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer([
            'welcome',
            'layouts.app',
            'layouts.auth',
        ], function ($view) {
            $view->with('setting', Setting::first());
            $view->with('reqruitment', SettingReqruitment::first());
        });
    }
}
