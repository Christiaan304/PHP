<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;

Route::controller(AdminController::class)->group(function () {
    Route::get('dashboard', 'dashboard')->name('dashboard');
});
