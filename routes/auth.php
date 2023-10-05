<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\auth\AuthController;


Route::prefix('admin')->group(function () {

    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    // $users[] = Auth::guard()->user();
    // dd($users);

    Route::post('/login',[AuthController::class,'login'])->name('login.admin');//connexion
    Route::get('/logout',[AuthController::class,'logout'])->name('logout.admin');//connexion
});
Route::get('/',[AuthController::class,'loginForm'])->name('login.create'); //Route du  formulaire de connexion
