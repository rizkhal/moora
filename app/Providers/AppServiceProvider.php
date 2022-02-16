<?php

namespace App\Providers;

use Inertia\Response;
use App\Datatable\Datatable;
use Illuminate\Support\ServiceProvider;
use App\Datatable\Exceptions\InvalidDatatable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(ConfigServiceProvider::class);
        $this->app->register(NavigatorServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('title', function ($title) {
            return $this->with('title', $title);
        });

        Response::macro('datatable', function ($datatable) {
            if (!$datatable instanceof Datatable) {
                throw InvalidDatatable::create();
            }

            $this->with([
                'datatable' => [
                    'fields' => $datatable->fields(),
                    'columns' => $datatable->columns(),
                    'data' => $datatable->datatable(request()),
                    'filters' => request()->all(['column', 'search', 'direction', 'filters', 'perpage']),
                ]
            ]);

            return $this;
        });
    }
}
