<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\CategoryController;

Route::view('dashboard', 'admin.dashboard')->name('dashboard');
Route::view('profile', 'admin.profile.index')->name('profile');

Route::resource('slider', SliderController::class);
Route::resource('category', CategoryController::class);

Route::controller(ProfileController::class)->group(function () {
    Route::post('update', 'update_profile')->name('update.profile');
    Route::post('update/password', 'update_password')->name('update.password');
});

Route::controller(AdminController::class)->group(function () {
});
