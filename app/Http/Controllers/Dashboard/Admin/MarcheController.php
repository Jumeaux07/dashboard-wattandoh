<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Client;
use App\Models\Marche;
use App\Models\Rendezvous;
use App\Models\Publication;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class MarcheController extends Controller
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
    public function index()
    {
        //
        $data['subtitle'] = " Liste des Marches ";
        $module = " Module Utilisateur";
        $action  = " a consulter la liste des marches";
        UserActivity :: saveActivity('$module', '$action');
        $data['marches'] = Marche:: all();
        $publications = Publication::all();
        $clients = Client::all();
        $rendezvous = Rendezvous::all();
        return view('marches.index', $data,  compact('publications', 'clients', 'rendezvous'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['subtitle'] = " creation de marche";
        $module = 'Module Utilsateur';
        $action = " a consulter la page de creation de marche";
        UserActivity:: saveActivity('$module','$action');
        $rendezvous = Rendezvous::all();
        $publications = Publication::all();
        $clients = Client::all();
        return view('marches.create',$data, compact('rendezvous','publications','clients'));
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
            'rendezvous_id'=> 'required',
            'publication_id' => 'required',
            'client_id' => 'required',
        ]);
        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }
        $marche = new Marche();
        $marche->reference = htmlspecialchars($request->reference);
        $marche->rendezvous_id = $request->rendezvous_id;
        $marche->client_id = $request->client_id;
        $marche->publication_id = $request->publication_id;
        $marche->statut_generique_id = 4;
        $marche->created_by = auth()->user()->nom_prenoms;
        if($marche->save()){
            $module = "Module utilisateur";
            $action = " a créé un marche : $marche->reference ";
            UserActivity::saveActivity($module,$action);
            session()->flash('type','alert-success');
            session()->flash('message','marché créé avec succès');
            return redirect()->route('marches.index');
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message','La création d\'un marche a échoué');
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
        // verification du profil (detail)

        $data['marche'] = Marche::find($id);
        $data['subtitle'] = "Detail marche";
        if($data['marche'] != null){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a affiché la page de detail d'un marche de  : {{$data['marche']->refernce}} ";
            UserActivity::saveActivity($module,$action);

            return view('marches.show', $data);
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message',"marche  introuvable");
            return redirect()->route('marches.index');
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
        // modifier un marches
        $data['marche'] = Marche:: find($id);
        $data['subtitle'] = "Modification d'un marche ";
        $module = " Module Utilisateur";
        $action = " A afficher la page de modification d'un marche ";
        UserActivity :: saveActivity('$module', '$action');
        $rendezvous = Rendezvous::all();
        $publications = Publication::all();
        $clients = Client::all();
        return view('marches.edit', $data, compact('rendezvous','publications','clients'));
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
        // valide la modification d'un marche
        $validator = Validator::make($request->all(),[
            'reference' => 'required',
            'rendezvous_id'=> 'required',
            'publication_id' => 'required',
            'client_id' => 'required',
        ]);
        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }
        $marche = Marche::find($id);
        if(!$marche){
            session()->flash('type','alert-danger');
            session()->flash('message','marche introuvable');
            return back();
        }else{
            $marche->reference =  htmlspecialchars($request->reference);
            $marche->rendezvous_id =  htmlspecialchars($request->rendezvous_id);
            $marche->publication_id =  htmlspecialchars($request->publication_id);
            $marche->client_id =  htmlspecialchars($request->client_id);
            if($marche->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations d\' un marche ont bien été modifiées');

                $module = "Module utilisateur";
                $action = " a modifié les information d'un marche ";
                UserActivity::saveActivity($module,$action);

                return redirect()->route('marches.show', $marche->id);
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
    public function statutMarche( $id){
        $marche = Marche::find($id);
        if (!$marche){
            session()->flash('type', 'alert-danger');
            session()->flash('message', 'le marche est introuvable.');
            return back();
        }
        $module = 'Module utilisateur';

        if ($marche->statut_generique_id == 4){
            $marche->statut_generique_id = 1;
            $action = " a perdu un marche de : {{$marche->reference}}." ;
            session()->flash('message', 'Le marche a bien été  perdu.');
        }else{
            $marche->statut_generique_id = 2;
            $action = " a procédé à la l'activation d'un marche  de  : {{$marche->reference}}." ;
            session()->flash('message', 'Le marche a bien été activé.');
        }
        $marche->save();

        UserActivity::saveActivity($module,$action);
        session()->flash('type', 'alert-success');
        return redirect()->back();
    }
}
