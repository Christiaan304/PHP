<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\HomeController;

require __DIR__ . '/auth.php';

Route::view('/', 'frontend.home')->name('home');

Route::controller(HomeController::class)->group(function () {
});

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::view('/dashboard', 'frontend.dashboard.dashboard')->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
//Route::view('/admin/login', 'admin.login');