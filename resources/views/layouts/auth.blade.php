<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>Sistem Penerimaan Pegawai KPPS - Skripsi</title>
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
    @livewireStyles
    <!-- CSRF Token -->

    @stack('styles')
</head>

<body class="min-h-screen bg-gray-200">

    @if ($reqruitment->req_status === \App\Constants\Status::INACTIVE)
        <x-global-alert color="indigo">
            <div class="text-sm font-medium text-white my-2">
                📢 Saat ini pendaftaran telah ditutup, silahkan kembali jika pendaftaran telah dibuka.
            </div>
        </x-global-alert>
    @endif
    
    @yield('content')

    @livewireScripts
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    @stack('scripts')
</body>

</html>
