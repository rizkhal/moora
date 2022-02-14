<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\Acl\RoleController;
use App\Http\Controllers\ParticipanController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ReqruitmentController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Acl\PermissionController;
use App\Http\Controllers\CompleteRegistrationController;
use App\Http\Controllers\ReqruitmentCriteriaController;

Route::middleware(['auth', 'verified'])->group(fn (): array => [
    Route::get('/home', [HomeController::class, 'index'])->name('home'),
    Route::resource('/participan', ParticipanController::class),
    Route::resource('/announcement', AnnouncementController::class),
    Route::prefix('/evaluation')->as('evaluation.')->group(fn (): array => [
        Route::get('/', [EvaluationController::class, 'index'])->name('index'),
    ]),

    Route::resource('/reqruitment', ReqruitmentController::class),

    Route::controller(ReqruitmentController::class)->prefix('/reqruitment')->as('reqruitment.')->group(fn (): array => [
        Route::get('/{reqruitment}/users', 'users')->name('users'),
        Route::get('/{reqruitment}/users/ranks', 'ranks')->name('ranks'),
    ]),

    Route::controller(ReqruitmentCriteriaController::class)->prefix('/reqruitment')->as('reqruitment.')->group(fn (): array => [
        Route::get('/{reqruitment}/criteria', 'create')->name('criteria.create'),
        Route::post('/{reqruitment}/criteria', 'store')->name('critera.store'),
        Route::get('/{reqruitment}/criteria/{criteria}', 'show')->name('criteria.show'),
        Route::get('/{reqruitment}/criteria/{criteria}/edit', 'edit')->name('criteria.edit'),
        Route::patch('/{reqruitment}/criteria/{criteria}', 'update')->name('criteria.update'),
        Route::delete('/{reqruitment}/criteria/{criteria}', 'destroy')->name('criteria.destroy'),
    ]),

    Route::prefix('/setting')->as('setting.')->group(fn (): array => [
        Route::resource('/role', RoleController::class),
        Route::resource('/user', UserController::class)->except('edit'),
        Route::resource('/permission', PermissionController::class)->except('edit'),
        Route::prefix('general')->as('general.')->group(fn (): array => [
            Route::get('/', [GeneralController::class, 'index'])->name('index'),
            Route::post('/email/smtp', [GeneralController::class, 'email'])->name('email'),
        ]),
    ]),

    Route::prefix('/participan')->as('participan.')->middleware('role:Peserta')->group(fn (): array => [
        Route::get('/complete-registration', [CompleteRegistrationController::class, 'view'])->name('complete-registration'),
        Route::post('/complete-registration', [CompleteRegistrationController::class, 'store'])->name('store.complete-registration'),
    ]),
]);
