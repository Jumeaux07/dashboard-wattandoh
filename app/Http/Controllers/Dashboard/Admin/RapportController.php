<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Marche;
use App\Models\Rapport;
use App\Models\Annonceur;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class RapportController extends Controller
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
        $data['subtitle'] = "listes des rapports";
        $module = "Module Utilisateur ";
        $action =  "A consulte la listes des rapports";
        UserActivity::saveActivity($module, $action);
        $data['rapports']= Rapport::all();
        $data['subtitle'] =  "listes des rapports ";
        $annonceurs = Annonceur::all();
        $marches =  Marche::all();
        return view('rapports.index', $data, compact('annonceurs', 'marches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['subtitle']= "creation d'un rapport";
        $module = "Module Utilisateur";
        $action = "creation de rapport";
        UserActivity::saveActivity($module,$action);
        $annonceurs = Annonceur::all();
        $marches= Marche::all();
        return view('rapports.create', $data,compact('annonceurs','marches') );
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
            'annonceur_id'=>'required',
            'marche_id'=>'required',
            'reference'=>'required',
            'nom_prenoms'=>'required',
            'telephone'=>'required',
            'loyer'=>'required',
            'commission'=>'required',
            'pourcentage'=>'required',
            'date'=>'required',
        ]);
        if ($validator->fails()) {
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le Formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
         }
         $rapport =  new Rapport();
         $rapport->nom_prenoms = htmlspecialchars($request->nom_prenoms);
         $rapport->reference = htmlspecialchars($request->reference);
         $rapport->telephone = htmlspecialchars($request->telephone);
         $rapport->loyer = htmlspecialchars($request->loyer);
         $rapport->commission = htmlspecialchars($request->commission);
         $rapport->pourcentage = htmlspecialchars($request->pourcentage);
         $rapport->date = htmlspecialchars($request->date);
         $rapport-> annonceur_id = $request->annonceur_id ;
         $rapport-> marche_id = $request->marche_id ;
        //  $rapport -> statut_generique_id = 2;
        //  $rapport -> created_by = auth()->user()->nom_prenoms;
        if ($rapport ->save()) {
            // activation mene par un utilisateur
            $module="Module Utilisateur";
            $action = "a creer une quartier du nom de : $rapport->reference";
            UserActivity::saveActivity('$module', '$action');
            session()->flash('type','alert-success');
            session()->flash('message','rapport creer avec succès');
            return redirect()->route('rapports.index');

        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','creation de rapport  a  echoué');
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
        $data['rapport'] = Rapport::find($id);
        $data['subtitle']= " Detail Rapport ";
        if ($data['rapport'] != null ) {
            $module = "Module Utilisateur";
            $action = " a afficher le rapport : {{$data['rapport']->reference}}";
            UserActivity::saveActivity('$module', '$action');
            return view ('rapports.show', $data);
        }else {
            session()->flash('type', 'alert-danger');
            session()->flash('message','rapport Introuvable');
            return redirect()->route('rapports.index');
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
        $data['rapport'] = Rapport::find($id);
        $data['subtitle'] = "Modification d'un Rapport";

        $module = "Module utilisateur";
        $action = " a affiché la page de modification d'un rapport ";
        UserActivity::saveActivity($module,$action);
        $annonceurs = Annonceur::all();
        $marches= Marche::all();

        return view('rapports.edit', $data, compact('annonceurs', 'marches'));
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
            'annonceur_id'=>'required',
            'marche_id'=>'required',
            'reference'=>'required',
            'nom_prenoms'=>'required',
            'telephone'=>'required',
            'loyer'=>'required',
            'commission'=>'required',
            'pourcentage'=>'required',
            'date'=>'required',
        ]);
        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }
        $rapport = Rapport::find($id);
        if(!$rapport){
            session()->flash('type','alert-danger');
            session()->flash('message','rapport introuvable');
            return back();
        }else{
            $rapport->nom_prenoms = htmlspecialchars($request->nom_prenoms);
            $rapport->reference = htmlspecialchars($request->reference);
            $rapport->telephone = htmlspecialchars($request->telephone);
            $rapport->loyer = htmlspecialchars($request->loyer);
            $rapport->commission = htmlspecialchars($request->commission);
            $rapport->pourcentage = htmlspecialchars($request->pourcentage);
            $rapport->date = htmlspecialchars($request->date);
            $rapport-> annonceur_id = $request->annonceur_id ;
            $rapport-> marche_id = $request->marche_id ;

            if($rapport->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations du rapport ont bien été modifiées');

                //pour l'activité méné par l'utilisateur connecté
                $module = "Module utilisateur";
                $action = " a modifié les information d'un rapport ";
                UserActivity::saveActivity($module,$action);
                // $communes = Commune::find($id);

                return redirect()->route('rapports.show', $rapport->id);
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
}
