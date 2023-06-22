<?php

use App\Http\Controllers\Dashboard\auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::get('/login',[AuthController::class,'loginForm'])->name('login.create'); //Route du  formulaire de connexion
    Route::post('/login',[AuthController::class,'login'])->name('login.admin');//connexion
    Route::get('/logout',[AuthController::class,'logout'])->name('logout.admin');//connexion
});
