<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Interdit;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class InterditController extends Controller
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
        $data['subtitle'] = "Listes des Interdits";
        $module = "Module Utilisateur";
        $action = " A consulter la listes des Interdits";
        UserActivity::saveActivity('$module', '$action');
        $data['interdits'] = Interdit::all();
        $data['subtitle'] = "Listes des Interdits";
        return view('interdits.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['subtitle']= "creation d'un interdit";
        $module = "Module Utilisateur";
        $action = "creation d' interdit";
        UserActivity::saveActivity($module,$action);

        return view('interdits.create', $data,);
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
         $interdit =  new Interdit();
         $interdit->libelle = htmlspecialchars($request->libelle);
         $interdit -> created_by = auth()->user()->nom_prenoms;
         if ($interdit ->save()) {
            // activation mene par un utilisateur
            $module="Module Utilisateur";
            $action = "a creer un interdit du nom de : $interdit->libelle";
            UserActivity::saveActivity('$module', '$action');
            session()->flash('type','alert-success');
            session()->flash('message','interdit creer avec succès');
            return redirect()->route('interdits.index');

        }else{
            session()->flash('type','alert-danger');
            session()->flash('message','creation de l interdit  a  echoué');
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
        $data['interdit'] = Interdit::find($id);
        $data['subtitle']= " Detail Utilisateur";
        if ($data['interdit'] != null ) {
            $module = "Module Utilisateur";
            $action = " a afficher la page de interdit : {{$data['interdit']->libelle}}";
            UserActivity::saveActivity('$module', '$action');
            return view ('interdits.show', $data);
        }else {
            session()->flash('type', 'alert-danger');
            session()->flash('message','interdit Introuvable');
            return redirect()->route('interdits.index');
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
        $data['interdit'] = Interdit::find($id);
        $data['subtitle'] = "Modification d'un utilisateur";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de modification d'un interdit ";
        UserActivity::saveActivity($module,$action);

        return view('interdits.edit', $data);
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
        $interdit = Interdit::find($id);
        if(!$interdit){
            session()->flash('type','alert-danger');
            session()->flash('message','interdit introuvable');
            return back();
        }else{
            $interdit->libelle =  htmlspecialchars($request->libelle);
            if($interdit->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations de l interdit ont bien été modifiées');

                //pour l'activité méné par l'utilisateur connecté
                $module = "Module utilisateur";
                $action = " a modifié les information d'un interdit ";
                UserActivity::saveActivity($module,$action);

                return redirect()->route('interdits.show', $interdit->id);
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
