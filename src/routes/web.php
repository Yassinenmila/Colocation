<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('test');
})->name('home');

Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->middleware('guest')->name('login');
Route::get('/signup', [App\Http\Controllers\AuthController::class, 'signup'])->middleware('guest')->name('signup');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->middleware('guest')->name('register');
Route::post('/signin', [App\Http\Controllers\AuthController::class, 'signin'])->middleware('guest')->name('signin');

Route::middleware(['auth', 'banned','role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/',[App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::resource('users', App\Http\Controllers\UserController::class);

});
