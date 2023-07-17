<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::resource('event', EventController::class);

Route::get('/dashboard', function () {
    return view('dashboard', [
        'events' => auth()->user()->events,
        'event_as_attendee' => auth()->user()->participants,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/event/attend/{id}', [EventController::class, 'attend'])->name('event.attend');
    Route::delete('/event/unattend/{id}', [EventController::class, 'unattend'])->name('event.unattend');
});

require __DIR__.'/auth.php';
