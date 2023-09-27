<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\TypeDeBien;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class TypedebienController extends Controller
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
        $data['subtitle'] = "Liste des types de biens";
        $module = " Module Utilisateur ";
        $action = "a consulter la listes de types de biens";
        UserActivity :: saveActivity('$module', '$action');
        $data['typedebiens'] = TypeDeBien :: all();
        // $data['subtitle'] = " Liste des types de biens ";
        return view('typedebiens.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['subtitle'] = "Création d'un  type de bien ";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de création d'un type de bien ";

        UserActivity::saveActivity($module,$action);

        return view('typedebiens.create',$data);
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
            'libelle' => 'required',

        ]);
        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }
        $typedebien = new TypeDeBien();
        $typedebien->libelle = htmlspecialchars($request->libelle);
        $typedebien->statut_generique_id = 2;
        $typedebien->created_by = auth()->user()->nom_prenoms;
        if($typedebien->save()){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a créé un type de bien : $typedebien->libelle ";

            UserActivity::saveActivity($module,$action);
            session()->flash('type','alert-success');
            session()->flash('message','type de bien créé avec succès');
            return redirect()->route('typedebiens.index');
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message','La création d\'un type de bien a échoué');
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
        $data['typedebien'] = TypeDeBien::find($id);
        $data['subtitle'] = "Detail utilisateur";
        if($data['typedebien'] != null){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a affiché la page de detail d'un type de bien de   : {{$data['typedebien']->libelle}} ";
            UserActivity::saveActivity($module,$action);

            return view('typedebiens.show', $data);
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message',"typedebiens introuvable");
            return redirect()->route('typedebiens.index');
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
        $data['typedebien'] = TypeDeBien:: find($id);
        $data['subtitle'] = "Modification d'Utilisateur ";
        $module = " Module Utilisateur";
        $action = " A afficher la page de modification d'un type de bien ";
        UserActivity :: saveActivity('$module', '$action');
        return view('typedebiens.edit', $data);
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
        $typedebien= TypeDeBien::find($id);
        if(!$typedebien){
            session()->flash('type','alert-danger');
            session()->flash('message','type de bien introuvable');
            return back();
        }else{
            $typedebien->libelle =  htmlspecialchars($request->libelle);

            if($typedebien->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations d\' un type de bien ont bien été modifiées');

                $module = "Module utilisateur";
                $action = " a modifié les information d'un type de bien  ";
                UserActivity::saveActivity($module,$action);

                return redirect()->route('typedebiens.show', $typedebien->id);
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
    public function statutTypedebien( $id){
        $typedebien = TypeDeBien::find($id);
        if (!$typedebien){
            session()->flash('type', 'alert-danger');
            session()->flash('message', 'le type de bien est introuvable.');
            return back();
        }
        $module = 'Module utilisateur';

        if ($typedebien->statut_generique_id == 2){
            $typedebien->statut_generique_id = 1;
            $action = " a désactivé un rendezvous de : {{$typedebien->libelle}}." ;
            session()->flash('message', 'Le type de bien  a bien été désactivé.');
        }else{
            $typedebien->statut_generique_id = 2;
            $action = " a procédé à la l'activation d'un type de bien  de  : {{$typedebien->libelle}}." ;
            session()->flash('message', 'Le type de bien a bien été activé.');
        }
        $typedebien->save();

        UserActivity::saveActivity($module,$action);
        session()->flash('type', 'alert-success');
        return redirect()->back();
    }
}
