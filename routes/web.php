<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Acl\RoleController;
use App\Http\Controllers\ParticipanController;
use App\Http\Controllers\Acl\PermissionController;

Route::middleware(['auth'])->group(fn (): array => [
    Route::get('/home', [HomeController::class, 'index'])->name('home'),
    Route::get('/participan', [ParticipanController::class, 'index'])->name('participan'),
    Route::prefix('/setting')->as('setting.')->group(fn (): array => [
        Route::prefix('/role')->as('role.')->group(fn (): array => [
            Route::get('/', [RoleController::class, 'index'])->name('index'),
            Route::get('/create', [RoleController::class, 'create'])->name('create'),
        ]),

        Route::prefix('/permission')->as('permission.')->group(fn (): array => [
            Route::get('/', [PermissionController::class, 'index'])->name('index'),
            Route::post('/', [PermissionController::class, 'store'])->name('store'),
            Route::put('/{permission}', [PermissionController::class, 'update'])->name('update'),
            Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('destroy'),
        ]),
    ]),
]);
