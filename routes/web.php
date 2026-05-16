<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/account/suspended', 'errors.suspended')->name('account-suspended');


Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/account/profile', [UserController::class, 'profile'])
        ->name('profile.show');
    Route::get('/account/password', [UserController::class, 'editPassword'])
        ->name('password.edit');
    Route::put('/account/password', [AuthController::class, 'changePassword'])
        ->name('password.update');
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::middleware('isActive')->group(function () {
        Route::resource('projects', ProjectController::class);
        Route::resource('projects.tasks', TaskController::class)->scoped();
    });
});