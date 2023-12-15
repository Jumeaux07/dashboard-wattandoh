<?php

namespace App\Http\Controllers\Dashboard\Admin\processus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserActivity;
use Illuminate\Support\Facades\View;
use App\Models\Annonceur;
use App\Models\Rendezvous;

class ProcessClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');

        View::share("module","Module utilisateur");
        View::share("title","Gestion des utilisateurs");

        View::share( 'menu', "Utilisateurs" );
    }
    //

    public function rendezvousParAnnonceur($id){
        $data['subtitle'] = "Liste des rendez vous d'un annonceur";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module Utilisateur ";
        $action = " a consulté la liste des rendez vous d'un Annonceur";
        UserActivity::saveActivity($module,$action);
        // recupere l'annonceur et ses rendez vouus
        $annonceur = Annonceur::with('rdv')->findOrFail($id);

        // Retourne vers la view de l'affichage des rendezvous des annonceur
        return view('annonceurs.liste', ['annonceur'=> $annonceur], $data);
    }


}

// $rendezvous_annonceur = Rendezvous::where('annonceur_id')->get();
// $annonceur = Annonceur::find($annonceur_id);
// $rendezvous_id = [];

// foreach($annonceur->rdv as $item){
//     array_unshift($rendezvous_id, $item -> id);
// }
// $data['subtitle'] = "Liste des rendezvous d'un annonceur ";

// //pour l'activité méné par l'utilisateur connecté
// $module = "Module Utilisateur ";
// $action = " a consulté la liste des rendezvous d'un annonceurs";
// UserActivity::saveActivity($module,$action);
// $annonceurs = Annonceur::find($annonceur_id);
// // $rendezvous = Rendezvous::
// return view('annonceurs.liste', $data, ['annonceur'=> $annonceurs,
// 'annonceur_id'=>$annonceur_id,]);
