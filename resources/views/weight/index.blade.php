@extends('layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <div class="flex items-center justify-between">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                {{ $title }}
            </h2>
            <button
                class="flex items-center px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-800 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                Tambah
                <span class="ml-2" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-plus-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="16"></line>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg>
                </span>
            </button>
        </div>

        <div class="p-1 overflow-scroll">
            @livewire('tps.table')
        </div>
    </div>
@endsection
