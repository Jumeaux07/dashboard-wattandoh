<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\Admin\AnnonceurController;
use App\Http\Controllers\Dashboard\Admin\AdministrateurController;
use App\Http\Controllers\Dashboard\Admin\ClientController;

Route::prefix('admin')->group(function () {
    //affichage du tableau de bord
    Route::get('/index',[HomeController::class,'index'])->name('dashboard');
    //Administrateurs
    Route::resource('administrateurs',AdministrateurController::class);

    //activer ou desactiver un admin
    Route::get('statut/{id}',[AdministrateurController::class,'change'])->name('administrateur.changeStatut');
//                     ONGLETS ANNONCEURS
    // route specialiale annonceurs
    Route::resource('annonceurs',AnnonceurController::class);
    //activer un annonceurs
    // Route::get('statut/{id}',[AnnonceurController::class,'statut'])->name('annonceur.anStatut');
    Route::get('statutA/{id}',[AnnonceurController::class,'statutA'])->name('annonceur.statutA');
    // ONGLES CLIENTS
    Route::resource('clients',ClientController::class);

    // activer un client
    Route::get('statutC/{id}',[ClientController::class,'statut'])->name('client.cliStatut');

    // ONgles gestionnaire

});
