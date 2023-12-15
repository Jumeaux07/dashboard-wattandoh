<?php

namespace App\Http\Controllers\Dashboard\Admin\trier;

use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rendezvous;
use Illuminate\Support\Facades\View;

class RendezvousTrierControler extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');

        View::share("module","Module Rubriques");
        View::share("title","Gestion des Rubriques");

        View::share( 'menu', "Rubriques" );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['subtitle'] = "Listes de rendez vous";
        $module = " Module Utilisateur";
        $action =  " a consulter la liste des rendez vous ";
        UserActivity::saveActivity('$module' ,' $action');

        $statut_generique_id = $request ->input('statut_generique');
        $query = Rendezvous::with(['statut_generique']);
        if ($statut_generique_id) {
            $query->whereHas('statut_generique', function($query) use ($statut_generique_id){
                $query->where('id', $statut_generique_id);
            });
        }
    $rendezvous = $query->get();
    return view('rendezvous.index', $data, compact('rendezvous'));

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
