<?php

use App\Http\Controllers\TweetController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\UserlistController;
use App\Http\Controllers\FollowinglistController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RetweetController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::controller(TweetController::class)->group(function () {
    Route::get('/tweet', 'index');
    Route::post('/tweet', 'store');
});

Route::controller(TimelineController::class)->group(function () {
    Route::get('/timeline', 'index');
    Route::post('/timeline', 'store');
});

Route::controller(UserlistController::class)->group(function () {
    Route::get('/userlist', 'index');
    Route::post('/userlist', 'store');
});

Route::controller(FollowinglistController::class)->group(function () {
    Route::get('/followinglist', 'index');
    Route::post('/followinglist', 'store');
});

Route::controller(FavoriteController::class)->group(function () {
    Route::post('/favorite', 'store');
});

Route::controller(RetweetController::class)->group(function () {
    Route::post('/retweet', 'store');
});



require __DIR__ . '/auth.php';
