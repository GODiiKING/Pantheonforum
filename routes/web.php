<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThreadController; // <-- add this line
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReplyController;

Route::post('/threads/{thread}/replies', [ReplyController::class, 'store'])
    ->middleware('auth')
    ->name('replies.store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Forum routes
Route::get('/threads', [ThreadController::class, 'index'])->name('threads.index');
Route::get('/threads/create', [ThreadController::class, 'create'])->middleware('auth')->name('threads.create');
Route::post('/threads', [ThreadController::class, 'store'])->middleware('auth')->name('threads.store');
Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');