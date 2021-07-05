@extends('layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <div class="flex items-center justify-between">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                {{ $title }}
            </h2>
        </div>

        <div class="p-1 pb-16 overflow-auto">
            @livewire('criteria.form', ['row' => $row, 'attr' => $attributes])
        </div>
    </div>
@endsection