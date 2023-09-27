<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Commune;
use App\Models\Quartier;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class QuartierController extends Controller
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
        //
        $data['subtitle'] = "listes des quartiers";
        $module = "Module Utilisateur ";
        $action =  "A consulte la listes des quartiers";
        UserActivity::saveActivity($module, $action);
        $data['quartiers']= Quartier::all();
        $data['subtitle'] =  "listes des quartiers ";
        $communes = Commune::all();
        return view('quartiers.index', $data, compact('communes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $data['subtitle']= "creation d'un quartier";
        $module = "Module Utilisateur";
        $action = "creation de quartier";
        UserActivity::saveActivity($module,$action);
        $communes = Commune::all();
        return view('quartiers.create', $data,compact('communes') );
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
            'commune_id'=>'required',
        ]);
        if ($validator->fails()) {
           session()->flash('type','alert-danger');
           session()->flash('message','Erreur dans le Formulaire');
           return back()->withErrors($validator->errors())->withInput($request->input());
        }
        $quartier =  new Quartier();
        $quartier->libelle = htmlspecialchars($request->libelle);
        $quartier-> commune_id = $request->commune_id;
        $quartier -> statut_generique_id = 2;
        $quartier -> created_by = auth()->user()->nom_prenoms;

        if ($quartier ->save()) {
            // activation mene par un utilisateur
            $module="Module Utilisateur";
            $action = "a creer une quartier du nom de : $quartier->libelle";
            UserActivity::saveActivity('$module', '$action');
            session()->flash('type','alert-success');
            session()->flash('message','quartier creer avec succès');
            return redirect()->route('quartiers.index');

        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','creation de quartier a  echoué');
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
        $data['quartier'] = Quartier::find($id);
        $data['subtitle']= " Detail Utilisateur";
        if ($data['quartier'] != null ) {
            $module = "Module Utilisateur";
            $action = " a afficher le quartier : {{$data['quartier']->libelle}}";
            UserActivity::saveActivity('$module', '$action');
            return view ('quartiers.show', $data);
        }else {
            session()->flash('type', 'alert-danger');
            session()->flash('message','quartier Introuvable');
            return redirect()->route('quartiers.index');
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
        $data['quartier'] = Quartier::find($id);
        $data['subtitle'] = "Modification d'un utilisateur";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de modification d'un quartier ";
        UserActivity::saveActivity($module,$action);
        $communes = Commune::all();
        return view('quartiers.edit', $data, compact('communes'));
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
            'commune_id'=>'required',
        ]);
        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }
        $quartier = Quartier::find($id);
        if(!$quartier){
            session()->flash('type','alert-danger');
            session()->flash('message','quartier introuvable');
            return back();
        }else{
            $quartier->libelle =  htmlspecialchars($request->libelle);

            if($quartier->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations de la quartier ont bien été modifiées');

                //pour l'activité méné par l'utilisateur connecté
                $module = "Module utilisateur";
                $action = " a modifié les information d'une quartier ";
                UserActivity::saveActivity($module,$action);
                // $communes = Commune::find($id);

                return redirect()->route('quartiers.show', $quartier->id);
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
    public function statutQuartier( $id){
        $quartier = Quartier::find($id);
        if (!$quartier){
            session()->flash('type', 'alert-danger');
            session()->flash('message', 'le quartier est introuvable.');
            return back();
        }
        $module = 'Module utilisateur';

        if ($quartier->statut_generique_id == 2){
            $quartier->statut_generique_id = 1;
            $action = " a désactivé une quartier  : {{$quartier->libelle}}." ;
            session()->flash('message', 'La quartier a bien été désactivé.');
        }else{
            $quartier->statut_generique_id = 2;
            $action = " a procédé à la l'activation d'une quartier  : {{$quartier->libelle}}." ;
            session()->flash('message', 'Le quartier a bien été activé.');
        }
        $quartier->save();

        UserActivity::saveActivity($module,$action);
        session()->flash('type', 'alert-success');
        return redirect()->back();
    }
    public function getQuartiersByCommune(Commune $commune){
        $quartiers = $commune->quartiers;
        return response()->json($quartiers);

    }
}
