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

Route::middleware('auth')->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::resource('projects.tasks', TaskController::class)->shallow();
});