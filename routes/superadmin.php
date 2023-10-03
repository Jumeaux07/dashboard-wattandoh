<?php

use App\Models\Quartier;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\Admin\ImageController;
use App\Http\Controllers\Dashboard\Admin\BudgetController;
use App\Http\Controllers\Dashboard\Admin\ClientController;
use App\Http\Controllers\Dashboard\Admin\MarcheController;
use App\Http\Controllers\Dashboard\Admin\CommuneController;
use App\Http\Controllers\Dashboard\Admin\RapportController;
use App\Http\Controllers\Dashboard\Admin\QuartierController;
use App\Http\Controllers\Dashboard\Admin\AnnonceurController;
use App\Http\Controllers\Dashboard\Admin\RendezvousController;
use App\Http\Controllers\Dashboard\Admin\TypedebienController;
use App\Http\Controllers\Dashboard\Admin\PublicationController;
use App\Http\Controllers\Dashboard\Admin\GestionnaireController;
use App\Http\Controllers\Dashboard\Admin\AdministrateurController;
use App\Http\Controllers\Dashboard\Admin\InterditController;
use App\Http\Controllers\Dashboard\Admin\OtpController;
use App\Http\Controllers\Dashboard\Admin\TypedemarcheController;
use App\Http\Controllers\Dashboard\Admin\CodeController;

// use App\Models\Commune;
// use App\Models\Publication;

// use App\Models\Budget;

Route::prefix('admin')->group(function () {
    //affichage du tableau de bord
    Route::get('/index',[HomeController::class,'index'])->name('dashboard');
    //Administrateurs
    Route::resource('administrateurs',AdministrateurController::class);
    // verification profil de l'administrateur connecter
    // Route::get('$administrateurShow/{id}',[AdministrateurController::class,'show'])->name('administrateurs.show');

    //activer ou desactiver un admin
    Route::get('changeStatut/{id}',[AdministrateurController::class,'changeStatut'])->name('administrateur.changeStatut');
//                     ONGLETS ANNONCEURS
    // route specialiale annonceurs
    Route::resource('annonceurs',AnnonceurController::class);
    //activer un annonceurs
    // Route::get('statut/{id}',[AnnonceurController::class,'statut'])->name('annonceur.anStatut');
    Route::get('statutA/{id}',[AnnonceurController::class,'statutA'])->name('annonceur.statutA');

    // route de parrainage d'un annonceurs
    // Route::get('statutParrain/{id}',[AnnonceurController::class,'statutParrain'])->name('annonceur.statutParrain');

    // ONGLES CLIENTS
    Route::resource('clients',ClientController::class);

    // activer un client
    Route::get('statutC/{id}',[ClientController::class,'statut'])->name('client.cliStatut');

    // ONgles gestionnaire
    Route::resource('gestionnaires',GestionnaireController::class);
     // activer les gestionnaires
     Route::get('statutG/{id}',[GestionnaireController::class,'statutG'])->name('gestionnaire.statutG');


     // publication
     Route::resource('publications',PublicationController::class);
     Route::get('statutPub/{id}',[PublicationController::class,'statutPub'])->name('publication.statutPub');
     Route:: post('/recherche-quartiers', 'PublicationController@rechercheQuartiers')->name('rechercheQuartiers');
     // budgets
     Route::resource('budgets',BudgetController::class);
     Route::get('statutB/{id}',[BudgetController::class,'statutB'])->name('budget.statutB');
    //  Route::delete('delete/{id}',[BudgetController::class, 'delete'])->name('budget.delete');

     // Communes
     Route::resource('communes', CommuneController::class);
     Route::get('statutCommune/{id}',[CommuneController::class,'statutCommune'])->name('commune.statutCommune');

     // Quartier
     Route::resource('quartiers', QuartierController::class);
     Route::get('statutQuartier/{id}',[QuartierController::class,'statutQuartier'])->name('quartier.statutQuartier');
    //  Route::get('get-quartiers', 'QuartierController@getQuartiers');

     // Rendez Vous
     Route::resource('rendezvous', RendezvousController::class);
     Route::get('statutRendezvous/{id}',[RendezvousController::class,'statutRendezvous'])->name('rendezvous.statutRendezvous');
    //  Marche
    Route::resource('marches', MarcheController::class);
    Route::get('statutMarche/{id}', [MarcheController::class,'statutMarche'])->name('marche.statutMarche');

    // Image
    Route::resource('images', ImageController::class);
    Route::get('statutImage/{id}', [ImageController::class,'statutImage'])->name('image.statutImage');
    Route::post('/upload', [ImageController::class,'upload'])->name('uploadImage');
     // Type de bien
     Route::resource('typedebiens', TypedebienController::class);
     Route::get('statutTypedebien/{id}', [TypedebienController::class, 'statutTypedebien'])->name('typedebien.statutTypedebien');

     // rapport
     Route::resource('rapports', RapportController::class);

     // Interdits
     Route::resource('interdits', InterditController::class);

     // Type de marches
     Route::resource('typedemarches', TypedemarcheController::class);

     // otp
     Route::resource('otps',OtpController::class);
     // code Qr
     Route::resource('codeQR', CodeController::class);
});
