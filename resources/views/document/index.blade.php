@extends('layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 px-3 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Upload Berkas
        </h2>
        <div class="overflow-auto">
            @livewire('document.upload', ['criterias' => $criterias, 'user' => $user])
        </div>
    </div>
@endsection
