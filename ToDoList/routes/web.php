<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::controller(TaskController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::view('/create', 'tasks.create')->name('create');
    Route::post('/store', 'store')->name('store');

    Route::get('/hidden_tasks', 'hidden_tasks')->name('hidden_tasks');
    Route::get('/hide_task/{id}', 'hide_task')
        ->whereNumber('id')
        ->name('hide_task');

    Route::get('/unhide_task/{id}', 'unhide_task')
        ->whereNumber('id')
        ->name('unhide_task');

    Route::get('/edit_task_frm/{id}', 'task_edit')
        ->whereNumber('id')
        ->name('edit_task');

    Route::post('/edit_task_submit', 'task_edit_submit')->name('edit_task_submit');

    Route::get('/done/{id}', 'task_done')
        ->whereNumber('id')
        ->name('done');

    Route::get('/undone/{id}', 'task_undone')
        ->whereNumber('id')
        ->name('undone');

    Route::get('/delete/{id}', 'task_delete')
        ->whereNumber('id')
        ->name('delete');
});
