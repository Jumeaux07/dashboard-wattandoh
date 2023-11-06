<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Annonceur;
use App\Models\Parrainage;
use App\Models\StatutGenerique;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AnnonceurTrierController extends Controller
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
        $data['subtitle'] = "Liste des annonceurs";
        $module = "Module Utilisateur ";
        $action = " a consulté la liste des annonceurs";
        UserActivity::saveActivity($module,$action);
        $sexe =  $request->input('sexe');
        $statut_generique_id = $request ->input('statut_generique');
        $parrainage_id = $request->input('parrainage');

        $query = Annonceur::with(['statut_generique', 'parrainage']);
        if ($sexe) {
            $query->where('sexe', $sexe);
        }
        if ($statut_generique_id) {
            $query->whereHas('statut_generique', function($query) use ($statut_generique_id){
                $query->where('id', $statut_generique_id);
            });
        }
        if ($parrainage_id) {
            $query->whereHas('parrainage', function($query) use ($parrainage_id){
                $query->where('id', $parrainage_id);
            });
        }
         $annonceurs = $query->get();
        //  $parrainages = Parrainage::all();
        //  $parrainages = Parrainage::all();
        //  $statut_generiques = StatutGenerique::all();

        return view('annonceurs.index',$data, compact('annonceurs'));
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
