<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Rapport;
use App\Models\Rendezvous;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class RendezvousPointControler extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');

        View::share("module","Module Rapport");
        View::share("title","Gestion des Rapports");

        View::share( 'menu', "Rapports" );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['subtitle'] = "Listes des Rapports des Rendez vous";
        $module = " Module Rapport";
        $action =  " a consulter la Liste des Rapports des Rendez vous ";
        UserActivity::saveActivity('$module' ,' $action');
        $data['rendezvous'] = Rendezvous::all();
        $data['subtitle'] =  "Listes des Rapports des Rendez vous";
        $rapports = Rapport::all();
        return view('pointrendezvous.index', $data, compact('rapports'));
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
