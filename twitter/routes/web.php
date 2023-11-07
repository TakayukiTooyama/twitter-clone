<?php

use App\Http\Controllers\HomeController;
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


Route::get('/', function () { return view('welcome'); });

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// ユーザー認証
Route::group(['middleware' => 'auth'], function () {
    // ユーザー機能
    Route::group(['prefix' => 'users', 'as' => 'users'], function () {
        // ユーザー一覧
        Route::get('/', [UserController::class, 'index'])->name('.index');
    });
});
