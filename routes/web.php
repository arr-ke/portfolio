<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PortController;

Route::get('/', function () {
    return view('welcome');
});

// ↓ユーザーのパス
Route::resource("users", UserController::class);

// ↓ログイン状態のみ入れるパス一覧
Route::middleware('auth')->group(function () {
    // ↓ポートのパス
    Route::resource("ports", PortController::class);

    // ↓ログインエラーのパス
    Route::get("portsserror", [PortController::class, 'error'])->name("ports.error");
});

// ↓未ログインエラーのパス
Route::get("userserror", [UserController::class, 'error'])->name("users.error");

// ↓ユーザーログインのパス
Route::post("userslogin", [UserController::class, 'login'])->name("users.login");

// ↓ログアウトのパス
Route::get("portslogout", [PortController::class, 'logout'])->name("ports.logout");