<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('notes.index');
});

Route::resource('notes', NoteController::class);
Route::patch('/notes/{note}/toggle-pin', [NoteController::class, 'togglePin'])->name('notes.toggle-pin');
Route::get('/category/{category}', [NoteController::class, 'filterByCategory'])->name('notes.category');
