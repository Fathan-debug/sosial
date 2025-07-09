<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
//     Route::patch('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::post('/test-update', [UserProfileController::class, 'update'])->name('test.update');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('test.update');

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

Route::get('/CreatePost', function () {
    return view('CreatePost');
});

Route::get('/PopUpPost', function () {
    return view('PopUpPost');
});

Route::get('/UpdateProfile', function () {
    return view('auth.UpdateProfile');
})->name('UpdateProfile');

Route::middleware('auth')->group(function () {
    Route::post('/follow/{id}', [UserProfileController::class, 'follow'])->name('user.follow');
    Route::post('/unfollow/{id}', [UserProfileController::class, 'unfollow'])->name('user.unfollow');
});

Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');
Route::delete('/posts/{post}/like', [LikeController::class, 'destroy'])->name('posts.unlike');

Route::get('/connect', [UserProfileController::class, 'connect'])->name('connect');

Route::get('/UpdateProfile/{id}', [UserProfileController::class, 'edit'])->name('UpdateProfile');

Route::get('/profile/{id}', [UserProfileController::class, 'index'])->name('profile');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::post('/posts/{id}/like', [LikeController::class, 'store'])->name('posts.like');
Route::delete('/posts/{id}/like', [LikeController::class, 'destroy'])->name('posts.unlike');

Route::get('/Home', [HomeController::class, 'index'])->name('home');

require __DIR__ . '/auth.php';
