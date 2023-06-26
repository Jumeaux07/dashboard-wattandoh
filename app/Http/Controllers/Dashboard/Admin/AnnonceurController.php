<?php

namespace App\Http\Controllers\Dashboard\Admin;


use App\Models\Annonceur;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class AnnonceurController extends Controller
{ public function __construct()
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
        $data['subtitle'] = "Liste des annonceurs";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module Utilisateur ";
        $action = " a consulté la liste des annonceurs";
        UserActivity::saveActivity($module,$action);

        $data['annonceurs'] = Annonceur::all();

        return view('annonceurs.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['subtitle'] = "Création d'un annonceur";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de création d'un annonceurs";

        UserActivity::saveActivity($module,$action);

        return view('annonceurs.create',$data);
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
            'nom_prenoms' => 'required',
            'phone1' => 'required|min:10',
            'phone2' => 'required|min:10',
            'sexe' => 'required',
            'password' => 'required|string|min:7',
            'password_confirmation' => 'required|same:password',
        ]);

        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }

        $annonceur = new Annonceur();
        $annonceur->nom_prenoms = htmlspecialchars($request->nom_prenoms);
        $annonceur->phone1 = htmlspecialchars($request->phone1);
        $annonceur->phone2 = htmlspecialchars($request->phone2);
        $annonceur->sexe = htmlspecialchars($request->sexe);
        $annonceur->password = Hash::make($request->password);
        // $annonceur->role_id = 1;
        $annonceur->statut_generique_id = 2;
        $annonceur->created_by = auth()->user()->nom_prenoms;

        if($annonceur->save()){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a créé l'annonceur : $annonceur->nom_prenoms ";

            UserActivity::saveActivity($module,$action);
            session()->flash('type','alert-success');
            session()->flash('message','Annonceur créé avec succès');
            return redirect()->route('annonceurs.index');
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message','La création d\'un annonceur a échoué');
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
        $data['annonceur'] = Annonceur::find($id);
        $data['subtitle'] = "Detail utilisateur";

        if($data['annonceur'] != null){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a affiché la page de detail d'un annonceur : {{$data['annonceur']->nom_prenoms}} ";
            UserActivity::saveActivity($module,$action);

            return view('annonceurs.show', $data);
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message',"Annonceur introuvable");
            return redirect()->route('annonceurs.index');
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
        $data['annonceur'] = Annonceur::find($id);
        $data['subtitle'] = "Modification d'un utilisateur";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de modification d'un annonceur ";
        UserActivity::saveActivity($module,$action);

        return view('annonceurs.edit', $data);
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
            'nom_prenoms' => 'required',
            'phone1' => 'required|min:10',
            'phone2' => 'required|min:10',
            'sexe' => 'required',
        ]);

        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }

        $annonceur = Annonceur::find($id);


        if(!$annonceur){
            session()->flash('type','alert-danger');
            session()->flash('message','Annonceur introuvable');
            return back();
        }else{
            $annonceur->nom_prenoms =  htmlspecialchars($request->nom_prenoms);
            $annonceur->phone1 =  htmlspecialchars($request->phone1);
            $annonceur->phone2 =  htmlspecialchars($request->phone2);
            $annonceur->sexe =  htmlspecialchars($request->sexe);

            if($annonceur->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations de l\'annonceur ont bien été modifiées');

                //pour l'activité méné par l'utilisateur connecté
                $module = "Module utilisateur";
                $action = " a modifié les information d'un annonceur ";
                UserActivity::saveActivity($module,$action);

                return redirect()->route('annonceurs.show', $annonceur->id);
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
    public function statutA( $id){
        $annonceur = Annonceur::find($id);
        if (!$annonceur){
            session()->flash('type', 'alert-danger');
            session()->flash('message', 'L\'annonceur est introuvable.');
            return back();
        }
        $module = 'Module utilisateur';

        if ($annonceur->statut_generique_id == 2){
            $annonceur->statut_generique_id = 1;
            $action = " a désactivé un annonceur : {{$annonceur->nom_prenoms}}." ;
            session()->flash('message', 'L\'annonceur a bien été désactivé.');
        }else{
            $annonceur->statut_generique_id = 2;
            $action = " a procédé à la l'activation l'annonceur : {{$annonceur->nom_prenoms}}." ;
            session()->flash('message', 'L\'annonceur a bien été activé.');
        }
        $annonceur->save();

        UserActivity::saveActivity($module,$action);
        session()->flash('type', 'alert-success');
        return redirect()->back();
    }
}
