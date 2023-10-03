<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Commune;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Dotenv\Validator;
// use Faker\Provider\UserAgent;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class CommuneController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');

        View::share("module","Module utilisateur");
        View::share("title","Gestion des utilisateurs");
        // View::share( 'section_title', "Liste des communes" );
        View::share( 'menu', "Utilisateurs" );
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['subtitle'] = "listes des communes";
        $module = "Module Utilisateur ";
        $action =  "A consulte la listes des communes";
        UserActivity::saveActivity($module, $action);
        $data['communes']= Commune::all();
        $data['subtitle'] =  "listes des communes ";
        return view('communes.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['subtitle']= "creation d'une commune";
        $module = "Module Utilisateur";
        $action = "creation de commune";
        UserActivity::saveActivity($module,$action);
        return view('communes.create', $data);
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
        $validator =  Validator::make($request->all(),[
            'libelle'=>'required',
        ]);
        if ($validator->fails()) {
           session()->flash('type','alert-danger');
           session()->flash('message','Erreur dans le Formulaire');
           return back()->withErrors($validator->errors())->withInput($request->input());
        }
        $commune =  new Commune();
        $commune->libelle = htmlspecialchars($request->libelle);
        $commune -> statut_generique_id = 2;
        $commune -> created_by = auth()->user()->nom_prenoms;
        if ($commune ->save()) {
            // activation mene par un utilisateur
            $module="Module Utilisateur";
            $action = "a creer une commune du nom de : $commune->libelle";
            UserActivity::saveActivity('$module', '$action');
            session()->flash('type','alert-success');
            session()->flash('message','Commune creer avec succès');
            return redirect()->route('communes.index');

        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','creation de commune a  echoué');
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
        $data['commune'] = Commune::find($id);
        $data['subtitle']= " Detail Commune";
        if ($data['commune'] != null ) {
            $module = "Module Utilisateur";
            $action = " a afficher la commue : {{$data['commune']->libelle}}";
            UserActivity::saveActivity('$module', '$action');
            return view ('communes.show', $data);
        }else {
            session()->flash('type', 'alert-danger');
            session()->flash('message','commune Introuvable');
            return redirect()->route('communes.index');
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
        $data['commune'] = Commune::find($id);
        $data['subtitle'] = "Modification d'une commune";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de modification d'un commune ";
        UserActivity::saveActivity($module,$action);

        return view('communes.edit', $data);
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
            'libelle' => 'required',


        ]);

        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }
        $commune = Commune::find($id);


        if(!$commune){
            session()->flash('type','alert-danger');
            session()->flash('message','commune introuvable');
            return back();
        }else{
            $commune->libelle =  htmlspecialchars($request->libelle);
            if($commune->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations de la commune ont bien été modifiées');

                //pour l'activité méné par l'utilisateur connecté
                $module = "Module utilisateur";
                $action = " a modifié les information d'une Commune ";
                UserActivity::saveActivity($module,$action);

                return redirect()->route('communes.show', $commune->id);
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
    public function statutCommune( $id){
        $commune = Commune::find($id);
        if (!$commune){
            session()->flash('type', 'alert-danger');
            session()->flash('message', 'le commune est introuvable.');
            return back();
        }
        $module = 'Module utilisateur';

        if ($commune->statut_generique_id == 2){
            $commune->statut_generique_id = 1;
            $action = " a désactivé une Commune  : {{$commune->libelle}}." ;
            session()->flash('message', 'La commune a bien été désactivé.');
        }else{
            $commune->statut_generique_id = 2;
            $action = " a procédé à la l'activation d'une commune  : {{$commune->libelle}}." ;
            session()->flash('message', 'Le commune a bien été activé.');
        }
        $commune->save();

        UserActivity::saveActivity($module,$action);
        session()->flash('type', 'alert-success');
        return redirect()->back();
    }
}
