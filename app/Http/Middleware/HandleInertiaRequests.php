<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Inertia\Middleware;
use Illuminate\Http\Request;
use Nedwors\Navigator\Facades\Nav;
use Tabuna\Breadcrumbs\Breadcrumbs;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => fn (): array => [
                'user' => $request->user() ? [
                    'name' => $request->user()->name,
                    'avatar' => $request->user()->avatar,
                    'email' => $request->user()->email,
                ] : null,
            ],
            'flash' => fn (): array => [
                'success' => $request->session()->get('success'),
                'error' => $request->session()->get('error'),
            ],
            'site' => fn (): array => [
                'navigator' => Nav::items(),
                'setting' => Setting::first(),
                'breadcrumbs' => Breadcrumbs::current()
            ],
        ]);
    }
}
