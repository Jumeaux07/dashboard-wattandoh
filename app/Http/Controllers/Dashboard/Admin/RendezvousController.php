<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Client;
use App\Models\Rendezvous;
use App\Models\Publication;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class RendezvousController extends Controller
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
    public function index()
    {
        // accede la liste des rendez vous
        $data['subtitle'] = "Listes de rendez vous";
        $module = " Module Utilisateur";
        $action =  " a consulter la liste des rendez vous ";
        UserActivity::saveActivity('$module' ,' $action');
        $data['rendezvous'] = Rendezvous::all();
        $data['subtitle'] =  "Listes des Rendez Vous";
        $publications = Publication::all();
        $clients = Client::all();

        return view('rendezvous.index', $data, compact('publications', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['subtitle'] = "Création d'un  Rendez Vous ";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de création d'un Rendez Vous";

        UserActivity::saveActivity($module,$action);
        $publications = Publication::all();
        $clients = Client::all();

        return view('rendezvous.create',$data, compact('publications','clients'));
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
        $validator = Validator::make($request->all(),[
            'reference' => 'required',
            'date'=> 'required',
            'publication_id' => 'required',
            'client_id' => 'required',
        ]);
        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }
        $rendezvou = new Rendezvous();
        $rendezvou->reference = htmlspecialchars($request->reference);
        $rendezvou->date = htmlspecialchars($request->date);
        $rendezvou->publication_id =  $request->publication_id;
        $rendezvou->client_id =  $request->client_id;
        $rendezvou->statut_generique_id = 2;
        $rendezvou->created_by = auth()->user()->nom_prenoms;
        if($rendezvou->save()){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a créé un rendezvous : $rendezvou->reference ";

            UserActivity::saveActivity($module,$action);
            session()->flash('type','alert-success');
            session()->flash('message','rendezvous créé avec succès');
            return redirect()->route('rendezvous.index');
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message','La création d\'un rendez vous a échoué');
            return back()->withInput($request->input());
        }
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
        $data['rendezvou'] = Rendezvous::find($id);
        $data['subtitle'] = "Detail utilisateur";

        if($data['rendezvou'] != null){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a affiché la page de detail d'un rendezvous de   : {{$data['rendezvou']->reference}} ";
            UserActivity::saveActivity($module,$action);

            return view('rendezvous.show', $data);
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message',"rendezvous introuvable");
            return redirect()->route('rendezvous.index');
        }
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
        $data['rendezvou'] = Rendezvous:: find($id);
        $data['subtitle'] = "Modification d'Utilisateur ";
        $module = " Module Utilisateur";
        $action = " A afficher la page de modification d'un rendez vous ";
        UserActivity :: saveActivity('$module', '$action');
        $publications = Publication::all();
        $clients = Client::all();
        return view('rendezvous.edit', $data, compact('publications','clients'));
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
        $validator = Validator::make($request->all(),[
            'reference' => 'required',
            'date'=> 'required',
            'publication_id' => 'required',
            'client_id' => 'required',
        ]);
        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }
        $rendezvou = Rendezvous::find($id);
        if(!$rendezvou){
            session()->flash('type','alert-danger');
            session()->flash('message','rendezvous introuvable');
            return back();
        }else{
            $rendezvou->reference =  htmlspecialchars($request->reference);
            $rendezvou->date =  htmlspecialchars($request->date);
            $rendezvou->publication_id =  htmlspecialchars($request->publication_id);
            $rendezvou->client_id =  htmlspecialchars($request->client_id);
            if($rendezvou->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations d\' un rendezvous ont bien été modifiées');

                $module = "Module utilisateur";
                $action = " a modifié les information d'un rendezvous ";
                UserActivity::saveActivity($module,$action);

                return redirect()->route('rendezvous.show', $rendezvou->id);
            }else{
                session()->flash('type','alert-danger');
                session()->flash('message','Une erreur s\'est produite lors de la modification');
            }
        }

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
    public function statutRendezvous( $id){
        $rendezvou = Rendezvous::find($id);
        if (!$rendezvou){
            session()->flash('type', 'alert-danger');
            session()->flash('message', 'le rendezvous est introuvable.');
            return back();
        }
        $module = 'Module utilisateur';

        if ($rendezvou->statut_generique_id == 2){
            $rendezvou->statut_generique_id = 1;
            $action = " a désactivé un rendezvous de : {{$rendezvou->reference}}." ;
            session()->flash('message', 'Le rendez vous a bien été désactivé.');
        }else{
            $rendezvou->statut_generique_id = 2;
            $action = " a procédé à la l'activation d'un rendezvous  de  : {{$rendezvou->reference}}." ;
            session()->flash('message', 'Le rendezvous a bien été activé.');
        }
        $rendezvou->save();

        UserActivity::saveActivity($module,$action);
        session()->flash('type', 'alert-success');
        return redirect()->back();
    }
}
