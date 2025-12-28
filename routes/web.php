<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// In routes/web.php
use App\Http\Controllers\PostController;

Route::resource('posts', PostController::class)
     ->middleware(['auth'])->except(['index', 'show']);
// This one line creates 7 named routes: posts.index, posts.create, posts.store, etc.
Route::resource('posts', PostController::class);

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::get('/dashboard', function () {
    return redirect()->route('posts.index');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
