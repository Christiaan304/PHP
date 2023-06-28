<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::controller(MainController::class)->group(function () {
    Route::view('/', 'message_form')->name('home');
    Route::post('/message_submit', 'message_submit')->name('message_submit');

    Route::get('/confirm/{purl}', 'confirm_message')
        ->name('confirm')
        ->where('purl', '^[\w]{36}$');

    Route::get('/read/{purl}', 'read_message')
        ->name('read')
        ->where('purl', '^[\w]{36}$');
});


Route::get('/test', function () {
    try {
        $dbconnect = DB::connection()->getPDO();
        $dbname = DB::connection()->getDatabaseName();
        echo "Connected successfully to the database. Database name is :" . $dbname;
    } catch (Exception $e) {
        echo '<pre>';
        echo $e;
    }
});
