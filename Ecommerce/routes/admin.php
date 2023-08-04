<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;

Route::view('dashboard', 'admin.dashboard')->name('dashboard');

Route::controller(AdminController::class)->group(function () {
});


Route::view('profile', 'admin.profile.index')->name('profile');

Route::controller(ProfileController::class)->group(function () {
    Route::post('update', 'update_profile')->name('update.profile');
    Route::post('update/password', 'update_password')->name('update.password');
});
