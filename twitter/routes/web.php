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

    // ユーザー情報関連
    Route::name('users.')->group(function () {
        // ユーザー詳細
        Route::get('/{userId}', [UserController::class, 'show'])->name('show');
        // ユーザー情報更新
        Route::put('/{userId}', [UserController::class, 'update'])->name('update');
        // ユーザー削除
        Route::delete('/{userId}', [UserController::class, 'delete'])->name('delete');

        // フォロー一覧
        Route::get('/{userId}/following', [FollowerController::class, 'following'])->name('following');
        // フォロワー一覧
        Route::get('/{userId}/followed', [FollowerController::class, 'followed'])->name('followed');
        // フォロー
        Route::put('/{followerId}/follow', [FollowerController::class, 'follow'])->name('follow');
        // フォロー解除
        Route::delete('/{followerId}/unfollow', [FollowerController::class, 'unfollow'])->name('unfollow');
    });

    // ツイート関連
    Route::prefix('/tweet')->name('tweet.')->group(function () {
        // ツイート一覧
        Route::get('/', [TweetController::class, 'index'])->name('index');
        // ツイート投稿
        Route::post('/', [TweetController::class, 'store'])->name('store');
        // ツイート詳細
        Route::get('/{tweetId}', [TweetController::class, 'show'])->name('show');
        // ツイート更新
        Route::put('/{tweetId}', [TweetController::class, 'update'])->name('update');
        // ツイート削除
        Route::delete('/{tweetId}', [TweetController::class, 'delete'])->name('delete');
    });
});
