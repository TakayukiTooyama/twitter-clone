<?php

use App\Http\Controllers\HomeController;
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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// ユーザー認証
Route::middleware('auth')->group(function () {
    // ユーザー機能
    Route::prefix('users')->name('users')->group(function () {
        // ユーザー一覧
        Route::get('/', [UserController::class, 'index'])->name('.index');
        // ユーザー詳細
        Route::get('/{id}', [UserController::class, 'show'])->name('.show');
        // ユーザー情報更新
        Route::put('/{id}', [UserController::class, 'update'])->name('.update');
        // ユーザー削除
        Route::delete('/{id}', [UserController::class, 'delete'])->name('.delete');
    });
    // ツイート
    Route::prefix('tweet')->name('tweet')->group(function () {
        Route::get('/', [TweetController::class, 'index'])->name('.index');
        Route::post('/', [TweetController::class, 'create'])->name('.create');
        Route::get('/{id}', [TweetController::class, 'show'])->name('.show');
        Route::put('/{id}', [TweetController::class, 'update'])->name('.update');
        Route::delete('/{id}', [TweetController::class, 'delete'])->name('.delete');
    });
});
