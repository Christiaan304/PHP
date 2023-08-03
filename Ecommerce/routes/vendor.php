<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;

Route::controller(VendorController::class)->group(function () {
    Route::get('dashboard', 'dashboard')->name('dashboard');
});
