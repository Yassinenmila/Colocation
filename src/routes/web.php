<?php

use Illuminate\Support\Facades\Route;



Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->middleware('guest')->name('login');
Route::get('/signup', [App\Http\Controllers\AuthController::class, 'signup'])->middleware('guest')->name('signup');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->middleware('guest')->name('register');
Route::post('/signin', [App\Http\Controllers\AuthController::class, 'signin'])->middleware('guest')->name('signin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function (){
    return redirect()->route('home');
});

// Routes accessibles à TOUS les utilisateurs authentifiés (dashboard, colocations)
Route::middleware(['auth', 'banned'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::resource('colocations', App\Http\Controllers\ColocationController::class)->only(['index', 'create', 'store', 'show']);
});

// Routes réservées aux admins uniquement (gestion des utilisateurs)
Route::middleware(['auth', 'banned', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', App\Http\Controllers\UserController::class)->only(['index', 'show', 'update']);
});
