<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class);
Route::delete('/logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware('guest')->group(fn (): array => [
    Route::get('/login', [LoginController::class, 'view'])->name('login'),
    Route::post('/login', [LoginController::class, 'login'])->name('login.store'),
]);

