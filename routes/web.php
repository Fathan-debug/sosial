<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/test');
})->name('logout');

Route::get('/test', function () {
    return view('auth.test');
})->name('test');

Route::get('/Home', function () {
    return view('Home');
})->middleware('auth')->name('Home');

Route::get('/notification', function () {
    return view('notification');
})->name('notification');

Route::get('/friends', function () {
    return view('auth.friends');
})->name('friends');

Route::get('/RegTest', function () {
    return view('auth.RegTest');
});

Route::get('/UpdateProfile', function () {
    return view('auth.UpdateProfile');
})->name('UpdateProfile');

Route::get('/profile', function () {
    return view('auth.profile');
})->name('profile');

require __DIR__.'/auth.php';
