<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\Back\VideoController as BackVideoController;
use App\Http\Controllers\Back\AuthorController as BackAuthorController;
use App\Http\Controllers\Back\BookController as BackBookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['title' => 'Dashboard']);
    })->name('dashboard');

    Route::resource('users', UserController::class);

    
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');



});


Route::middleware('auth')->group(function () {
    Route::resource('videos', VideoController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('is_admin')->name('admin.')->group(function () {
        Route::get('/admin/videos', [BackVideoController::class, 'index'])->name('videos.index');
        Route::post('/admin/videos', [BackVideoController::class, 'store'])->name('videos.store');
        Route::get('/admin/videos/create', [BackVideoController::class, 'create'])->name('videos.create');
        Route::get('/admin/videos/{id}/edit', [BackVideoController::class, 'edit'])->name('videos.edit');
        Route::put('/admin/videos/{id}', [BackVideoController::class, 'update'])->name('videos.update');
        Route::delete('/admin/videos/{id}', [BackVideoController::class, 'destroy'])->name('videos.destroy');
        Route::get('/admin/videos/{id}/published', [BackVideoController::class, 'published'])->name('videos.published');
    });
});

require __DIR__.'/auth.php';