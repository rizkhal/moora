<?php

use App\Http\Livewire\Dashboard\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TpsController;
use App\Http\Middleware\UploadedDocument;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ParticipanController;
use App\Http\Livewire\Setting\Setting;

Route::middleware(['auth'])->group(function () {
    Route::get('/home', Home::class)->name('home');

    Route::prefix('criteria')->as('criteria.')->group(function () {
        Route::get('/', [CriteriaController::class, 'index'])->name('index');
        Route::get('/create', [CriteriaController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [CriteriaController::class, 'edit'])->name('edit');
    });

    Route::prefix('participan')->as('participan.')->group(function () {
        Route::get('/', [ParticipanController::class, 'index'])->name('index');
        Route::get('/result', [ParticipanController::class, 'result'])->name('result');
        Route::get('/result/{id}', [ParticipanController::class, 'detail'])->name('detail');
    });

    Route::prefix('setting')->as('setting.')->group(function () {
        Route::get('/', Setting::class)->name('index');
    });

    Route::middleware(UploadedDocument::class)->group(function () {
        Route::get('/upload-document', [DocumentController::class, 'index'])->name('document');
    });
});
