<?php

use App\Http\Controllers\Managers\Auth\AuthController;
use App\Http\Controllers\Managers\Home\HomeController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('login', [AuthController::class, '_login'])->name('_login');

    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'auth:manager'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('/');
});
