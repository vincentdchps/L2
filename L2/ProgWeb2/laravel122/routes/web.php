<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['title' => 'Dashboard']);
    })->name('dashboard');

    Route::resource('users', UserController::class);



});


Route::middleware('auth')->group(function () {
    Route::resource('videos', VideoController::class);
});

require __DIR__.'/auth.php';
