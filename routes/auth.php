<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;

Route::get('/', WelcomeController::class);

Route::delete('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
Route::middleware('guest')->group(fn (): array => [
    Route::get('/login', [LoginController::class, 'view'])->name('login'),
    Route::post('/login', [LoginController::class, 'login'])->name('login.store'),
    Route::get('/register', [RegisterController::class, 'view'])->name('register'),
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store'),
]);

Route::prefix('/verification')->as('verification.')->middleware('auth')->group(fn (): array => [
    Route::get('/notice', [VerificationController::class, 'notice'])->name('notice'),

    Route::post('/resend/email', [VerificationController::class, 'resend'])->middleware('throttle:6,1')->name('resend'),
    Route::get('/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware('signed')->name('verify'),
]);
