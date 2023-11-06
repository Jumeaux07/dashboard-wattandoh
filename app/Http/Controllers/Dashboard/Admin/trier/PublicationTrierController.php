<?php

namespace App\Http\Controllers\Dashboard\Admin\trier;

use App\Models\Quartier;
use App\Models\TypeDeBien;
use App\Models\Publication;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commune;
use Illuminate\Support\Facades\View;

class PublicationTrierController extends Controller
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
        $data['subtitle'] = "Liste Des Publications";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module Affichage  ";
        $action = " a consulté la liste des publications";
        UserActivity::saveActivity($module,$action);
        $loyer = $request -> input('loyer');
        $statut_generique_id = $request ->input('statut_generique');
        $type_de_bien_id = $request -> input('type_de_bien');
        $quartier_id = $request -> input('quartier');

        $query = Publication::with(['statut_generique', 'type_de_bien', 'quartier']);
        if ($loyer) {
            $query->where('loyer', $loyer);
        }
        if ($statut_generique_id) {
            $query->whereHas('statut_generique', function($query) use ($statut_generique_id){
                $query->where('id', $statut_generique_id);
            });
        }
        if ($type_de_bien_id) {
            $query->whereHas('type_de_bien', function($query) use ($type_de_bien_id){
                $query->where('id', $type_de_bien_id);
            });
        }
        if ($quartier_id) {
            $query->whereHas('quartier', function($query) use ($quartier_id){
                $query->where('id', $quartier_id);
            });
        }
        $publications = $query->get();
        $typedebiens = TypeDeBien::all();
        $quartiers = Quartier :: all() ;
        return view('publications.index', $data, compact('publications', 'typedebiens', 'quartiers'));

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
