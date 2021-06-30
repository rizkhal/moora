<?php

use App\Http\Livewire\Dashboard\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TpsController;
use App\Http\Middleware\UploadedDocument;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ParticipanController;

Route::middleware(['auth'])->group(function () {
    Route::get('/home', Home::class)->name('home');
    Route::get('/tps', [TpsController::class, 'index'])->name('tps');
    Route::get('/weight', [WeightController::class, 'index'])->name('weight');

    Route::prefix('criteria')->as('criteria.')->group(function () {
        Route::get('/', [CriteriaController::class, 'index'])->name('index');
        Route::get('/create', [CriteriaController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [CriteriaController::class, 'edit'])->name('edit');
    });

    Route::get('/participans', [ParticipanController::class, 'index'])->name('participan');
    Route::get('/participan/result', [ParticipanController::class, 'result'])->name('participan.result');
    Route::get('/participan/result/{id}', [ParticipanController::class, 'detail'])->name('participan.detail');

    Route::middleware(UploadedDocument::class)->group(function () {
        Route::get('/upload-document', [DocumentController::class, 'index'])->name('document');
    });
});
