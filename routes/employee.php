<?php

use App\Http\Controllers\Employees\Auth\AuthController;
use App\Http\Controllers\Employees\Home\HomeController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('login', [AuthController::class, '_login'])->name('_login');

    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'auth:employee'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('/');
});
