<?php

use App\Http\Controllers\Dashboard\Admin\AdministrateurController;
use App\Http\Controllers\Dashboard\HomeController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::get('/index',[HomeController::class,'index'])->name('dashboard');
    //Administrateurs
    Route::resource('administrateurs',AdministrateurController::class);
    Route::get('statut/{id}',[AdministrateurController::class,'changeStatut'])->name('administateur.statut');
});
