<?php

use App\Http\Controllers\FollowerController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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



Auth::routes();


// ユーザー認証
Route::middleware('auth')->group(function () {
    // ホーム画面
    Route::get('/', [TweetController::class, 'index'])->name('index');
    Route::get('/home', [TweetController::class, 'index'])->name('home');

    Route::prefix('/{userId}')->name('users.')->group(function () {
        // ユーザー詳細画面の表示
        Route::get('/', [UserController::class, 'show'])->name('show');
        // ユーザー情報更新
        Route::put('/', [UserController::class, 'update'])->name('update');
        // ユーザー削除
        Route::delete('/', [UserController::class, 'delete'])->name('delete');

        // フォロー一覧
        Route::get('/following', [FollowerController::class, 'following'])->name('following');
        // フォロワー一覧
        Route::get('/followed', [FollowerController::class, 'followed'])->name('followed');
        // フォロー
        Route::put('/follow', [FollowerController::class, 'follow'])->name('follow');
        // フォロー解除
        Route::delete('/unfollow', [FollowerController::class, 'unfollow'])->name('unfollow');
    });

    // ツイート投稿
    Route::post('/{userId}/tweet', [TweetController::class, 'create'])->name('tweet.create');

    Route::prefix('/{userId}/tweet/{tweetId}')->name('tweet.')->group(function () {
        // ツイート詳細
        Route::get('/', [TweetController::class, 'show'])->name('show');
        // ツイート更新
        Route::put('/', [TweetController::class, 'update'])->name('update');
        // ツイート削除
        Route::delete('/', [TweetController::class, 'delete'])->name('delete');
    });
});
