<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @if (!isset($title))
        <title>👋🏻 Hy {{ auth()->user()->name }}, Selamat Datang Kembali</title>
    @else
        <title>👉🏻 &nbsp; {{ $title }}</title>
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
    <style>
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
    @stack('styles')
</head>

<body class="bg-gray-200">
    @role('Participan')
    @if ($reqruitment->req_status === \App\Constants\Status::ACTIVE)
        @if (!Auth::user()->detail)
            <x-global-alert color="yellow">
                <div class="text-sm font-medium text-white">
                    🚨 Harap upload berkas anda segera.
                </div>

                <span aria-hidden="true" class="hidden sm:block mx-6 h-6 w-px bg-white bg-opacity-20"></span>
                <div class="ml-6 sm:ml-0">
                    <a class="whitespace-nowrap inline-flex rounded-md bg-white py-2 px-3 text-xs font-semibold uppercase text-red-500 hover:bg-opacity-90"
                        href="{{ route('document') }}">
                        Upload Sekarang →
                    </a>
                </div>
            </x-global-alert>
        @endif
    @endif
    @endrole
    <div class="flex full bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('layouts.inc._sidebar')
        <div class="flex flex-col flex-1 w-full">
            @include('layouts.inc._navbar')
            <div class="px-6 mt-6">
                @role('Participan')
                @if ($reqruitment->req_status === \App\Constants\Status::INACTIVE)
                    <div class="px-4 py-3 leading-normal text-blue-700 bg-blue-100 rounded-lg" role="alert">
                        <p>📢 &nbsp; Saat ini pendaftaran telah ditutup dan akan dibuka kembali sampai waktu yang tidak
                            ditentukan.</p>
                    </div>
                @endif
                @endrole
                <x-alert></x-alert>
            </div>
            @yield('content')
        </div>
    </div>

    @livewireScripts
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('js/alpine.js') }}" defer></script>
    @stack('scripts')
</body>

</html>
