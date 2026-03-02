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

// Page d'invitation (accessible sans auth pour permettre le lien par email)
Route::get('/invitations/{token}', [App\Http\Controllers\InvitationController::class, 'show'])->name('invitations.show');

Route::middleware(['auth', 'banned'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::resource('colocations', App\Http\Controllers\ColocationController::class);
    Route::resource('categories', App\Http\Controllers\CategorieController::class);
    Route::resource('depenses', App\Http\Controllers\DepenseController::class);
    Route::resource('payments', App\Http\Controllers\PaymentController::class);
    Route::post('/colocations/leave', [App\Http\Controllers\MemberController::class, 'leave'])->name('colocations.leave');
    Route::delete('/members/{id}/remove', [App\Http\Controllers\MemberController::class, 'remove'])->name('members.remove');
    Route::patch('/members/{id}/ban', [App\Http\Controllers\MemberController::class, 'ban'])->name('members.ban');
    Route::patch('/members/{id}/unban', [App\Http\Controllers\MemberController::class, 'unban'])->name('members.unban');
    Route::post('/invitations', [App\Http\Controllers\InvitationController::class, 'store'])->name('invitations.store');
    Route::post('/invitations/{token}/accept', [App\Http\Controllers\InvitationController::class, 'accept'])->name('invitations.accept');
    Route::post('/invitations/{token}/reject', [App\Http\Controllers\InvitationController::class, 'reject'])->name('invitations.reject');
});

Route::middleware(['auth', 'banned', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', App\Http\Controllers\UserController::class)->only(['index', 'show', 'update']);
});
