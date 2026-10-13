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
});
