<?php

use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\ParticipanController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\WeightController;
use App\Http\Livewire\Dashboard\Home;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/home', Home::class)->name('home');
    Route::get('/tps', [TpsController::class, 'index'])->name('tps');
    Route::get('/weight', [WeightController::class, 'index'])->name('weight');
    Route::get('/criteria', [CriteriaController::class, 'index'])->name('criteria');
    Route::get('/participans', [ParticipanController::class, 'index'])->name('participan');
});
