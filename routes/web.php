<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('account')->name('account.')->middleware('auth')->group(function () {
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::put('password-change', [UserController::class, 'passwordChange'])->name('password.change');
});

Route::prefix('projects')->name('projects.')->group(function () {
    Route::resource('/', ProjectController::class)->middleware('auth');
    Route::prefix('{project}')->group(function () {
        Route::resource('tasks', TaskController::class)->shallow();
    });
});