<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\TypeDeMarche;

use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class TypedemarcheController extends Controller
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
        // accueil
        $data['subtitle'] = "Listes des Type de Marches";
        $module = "Module Utilisateur";
        $action = " A consulter la listes des Types de Marches";
        UserActivity::saveActivity('$module', '$action');
        $data['typedemarches'] = TypeDeMarche::all();
        $data['subtitle'] = "Listes des types de Marches";
        return view('typedemarches.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['subtitle']= "creation d'un type de marche";
        $module = "Module Utilisateur";
        $action = "creation d' un type de marche";
        UserActivity::saveActivity($module,$action);

        return view('typedemarches.create', $data,);
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
         $typedemarche =  new TypeDeMarche();
         $typedemarche->libelle = htmlspecialchars($request->libelle);
         $typedemarche -> created_by = auth()->user()->nom_prenoms;
         if ($typedemarche ->save()) {
            // activation mene par un utilisateur
            $module="Module Utilisateur";
            $action = "a creer un typedemarche du nom de : $typedemarche->libelle";
            UserActivity::saveActivity('$module', '$action');
            session()->flash('type','alert-success');
            session()->flash('message','typedemarche creer avec succès');
            return redirect()->route('typedemarches.index');
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message','creation de un type de marche   a  echoué');
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
        $data['typedemarche'] = TypeDeMarche::find($id);
        $data['subtitle']= " Detail Utilisateur";
        if ($data['typedemarche'] != null ) {
            $module = "Module Utilisateur";
            $action = " a afficher la page de typedemarche : {{$data['typedemarche']->libelle}}";
            UserActivity::saveActivity('$module', '$action');
            return view ('typedemarches.show', $data);
        }else {
            session()->flash('type', 'alert-danger');
            session()->flash('message','type de marche  Introuvable');
            return redirect()->route('typedemarches.index');
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
        $data['typedemarche'] = TypeDeMarche::find($id);
        $data['subtitle'] = "Modification d'un utilisateur";

        $module = "Module utilisateur";
        $action = " a affiché la page de modification d'un typedemarche ";
        UserActivity::saveActivity($module,$action);

        return view('typedemarches.edit', $data);
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
        $typedemarche = TypeDeMarche::find($id);
        if(!$typedemarche){
            session()->flash('type','alert-danger');
            session()->flash('message','typedemarche introuvable');
            return back();
        }else{
            $typedemarche->libelle =  htmlspecialchars($request->libelle);
            if($typedemarche->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations de l typedemarche ont bien été modifiées');

                //pour l'activité méné par l'utilisateur connecté
                $module = "Module utilisateur";
                $action = " a modifié les information d'un typedemarche ";
                UserActivity::saveActivity($module,$action);

                return redirect()->route('typedemarches.show', $typedemarche->id);
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
