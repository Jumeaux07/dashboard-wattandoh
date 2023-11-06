<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class GestionnaireTrierController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');

        View::share("module","Module utilisateur");
        View::share("title","Gestion des utilisateurs");

        View::share( 'menu', "Utilisateurs" );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['subtitle'] = "Liste des gestionnaires";

        //pour l'activité méné par l'utilisateur connecté gesionnaire annonceurs
        $module = "Module Utilisateur ";
        $action = " a consulté la liste des gestionnaires annonceurs ";
        UserActivity::saveActivity($module,$action);

        ///
        $module = "Module Utilisateur ";
        $action = " a consulté la liste des gestionnaires Clients ";
        UserActivity::saveActivity($module,$action);

        // $sexe =  $request->input('sexe');
        $adresse = $request->input('adresse');
        $statut_generique_id = $request ->input('statut_generique');
        $role_id = $request->input('role');

        $query = User::with(['statut_generique', 'role']);
        // if ($sexe) {
        //     $query->where('sexe', $sexe);
        // }
        if ($adresse) {
            $query->where('adresse', $adresse);
        }
        if ($statut_generique_id) {
            $query->whereHas('statut_generique', function($query) use ($statut_generique_id){
                $query->where('id', $statut_generique_id);
            });
        }


        // if ($role_id  ) {
        //     $query->whereHas('role', function($query) use ($role_id){
        //         $query->where('id', $role_id);
        //     });
        // }
        if ($role_id) {
            $query->whereHas('role', function($query) use ($role_id){
                $query->where('id', $role_id)->where('id', '!=', 1);
            });
        } else {
            // Si $role_id n'est pas défini, excluez toujours le rôle avec l'ID 1
            $query->whereHas('role', function($query) {
                $query->where('id', '!=', 1);
            });
        }

         $gestionnaires = $query->get();
        return view('gestionnaires.index', compact('gestionnaires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
