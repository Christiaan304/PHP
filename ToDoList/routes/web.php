<?php

use App\Http\Controllers\ActionsController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'tasks');

Route::resource('tasks', TaskController::class)->except(['show']);

Route::controller(ActionsController::class)->group(function () {
    Route::get('/hidden_tasks', 'hidden_tasks')->name('hidden_tasks');

    Route::get('/hide/{id}', 'hide_task')
        ->whereNumber('id')
        ->name('hide');

    Route::get('/unhide/{id}', 'unhide_task')
        ->whereNumber('id')
        ->name('unhide');

    Route::get('/done/{id}', 'task_done')
        ->whereNumber('id')
        ->name('done');

    Route::get('/undone/{id}', 'task_undone')
        ->whereNumber('id')
        ->name('undone');
});
