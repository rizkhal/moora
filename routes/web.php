<?php

use App\Http\Livewire\Dashboard\Home;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function() {
    Route::get('/home', Home::class)->name('home');
});