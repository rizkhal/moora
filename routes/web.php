<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Acl\RoleController;
use App\Http\Controllers\ParticipanController;
use App\Http\Controllers\Acl\PermissionController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\GeneralController;

Route::middleware(['auth', 'verified'])->group(fn (): array => [
    Route::get('/home', [HomeController::class, 'index'])->name('home'),
    Route::resource('/criteria', CriteriaController::class),
    Route::resource('/participan', ParticipanController::class),
    Route::resource('/announcement', AnnouncementController::class),

    Route::prefix('/setting')->as('setting.')->group(fn (): array => [
        Route::resource('/role', RoleController::class),
        Route::resource('/user', UserController::class)->except('edit'),
        Route::resource('/permission', PermissionController::class)->except('edit'),
        Route::prefix('general')->as('general.')->group(fn (): array => [
            Route::get('/', [GeneralController::class, 'index'])->name('index'),
            Route::post('/email/smtp', [GeneralController::class, 'email'])->name('email'),
        ]),
    ]),
]);
