<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;

Route::controller(VendorController::class)->group(function () {
    Route::view('dashboard', 'vendor.dashboard.dashboard')->name('dashboard');
    Route::view('profile', 'vendor.dashboard.profile')->name('profile');
    Route::put('/update', [VendorController::class, 'update_profile'])->name('update.profile');
    Route::post('/update/password', [VendorController::class, 'update_password'])->name('update.password');
});
