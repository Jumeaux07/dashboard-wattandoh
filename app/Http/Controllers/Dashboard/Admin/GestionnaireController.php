<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class GestionnaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');

        View::share("module","Module utilisateur");
        View::share("title","Gestion des utilisateurs");
        // View::share( 'section_title', "Liste des administrateur" );
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
        $data['subtitle'] = "Liste des gestionnaires";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module Utilisateur ";
        $action = " a consulté la liste des gestionnaires annonceurs ";
        UserActivity::saveActivity($module,$action);

        $data['gestionnaires'] = User::where('role_id',2)->get();


        $data['subtitle'] = "Liste des gestionnaires";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module Utilisateur ";
        $action = " a consulté la liste des gestionnaires Clients ";
        UserActivity::saveActivity($module,$action);

        $data['gestionnaires'] = User::where('role_id',3)->get();


        return view('gestionnaires.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['subtitle'] = "Création d'un gestionnaire Annonceurs";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de création d'un gestionnaire Annonceurs";

        UserActivity::saveActivity($module,$action);

        return view('gestionnaires.create',$data);
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
            'email' => 'required|email|unique:users,email',
            'telephone' => 'required|min:10',
            'adresse' => 'required',
            // 'role_libelle'=>'required',
            'password' => 'required|string|min:7',
            'password_confirmation' => 'required|same:password',
        ]);

        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }
        // gestionnaire annonceur
        $gestionnaire = new User();
        $gestionnaire->nom_prenoms = htmlspecialchars($request->nom_prenoms);
        $gestionnaire->email = htmlspecialchars($request->email);
        $gestionnaire->telephone = htmlspecialchars($request->telephone);
        $gestionnaire->adresse = htmlspecialchars($request->adresse);
        $gestionnaire->password = Hash::make($request->password);
        $gestionnaire->role_id = 2;
        $gestionnaire->statut_generique_id = 2;
        $gestionnaire->created_by = auth()->user()->nom_prenoms;

        // gestionnaire clients
        $gestionnaire = new User();
        $gestionnaire->nom_prenoms = htmlspecialchars($request->nom_prenoms);
        $gestionnaire->email = htmlspecialchars($request->email);
        $gestionnaire->telephone = htmlspecialchars($request->telephone);
        $gestionnaire->adresse = htmlspecialchars($request->adresse);
        $gestionnaire->password = Hash::make($request->password);
        $gestionnaire->role_id = 3;
        $gestionnaire->statut_generique_id = 2;
        $gestionnaire->created_by = auth()->user()->nom_prenoms;


        if($gestionnaire->save()){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a créé l'gestionnaire : $gestionnaire->nom_prenoms ";

            UserActivity::saveActivity($module,$action);
            session()->flash('type','alert-success');
            session()->flash('message','gestionnaire créé avec succès');
            return redirect()->route('gestionnaires.index');
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message','La création d\'un gestionnaire a échoué');
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
        $data['gestionnaire'] = User::find($id);
        $data['subtitle'] = "Detail de gestionnaire";

        if($data['gestionnaire'] != null){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a affiché la page de detail d'un gestionnaire : {{$data['gestionnaire']->nom_prenoms}} ";
            UserActivity::saveActivity($module,$action);

            return view('gestionnaires.show', $data);
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message',"gestionnaire introuvable");
            return redirect()->route('gestionnaires.index');
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
        $data['gestionnaire'] = User::find($id);
        $data['subtitle'] = "Modification d'un gestionnaire ";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de modification d'un gestionnaire ";
        UserActivity::saveActivity($module,$action);

        return view('gestionnaires.edit', $data);
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
            'email' => 'required|email',
            'telephone' => 'required|min:10',
            'adresse' => 'required',
        ]);

        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }

        $gestionnaire = User::find($id);


        if(!$gestionnaire){
            session()->flash('type','alert-danger');
            session()->flash('message','gestionnaire introuvable');
            return back();
        }else{
            $gestionnaire->nom_prenoms =  htmlspecialchars($request->nom_prenoms);
            $gestionnaire->email =  htmlspecialchars($request->email);
            $gestionnaire->telephone =  htmlspecialchars($request->telephone);
            $gestionnaire->adresse =  htmlspecialchars($request->adresse);

            if($gestionnaire->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations de l\'gestionnaire ont bien été modifiées');

                //pour l'activité méné par l'utilisateur connecté
                $module = "Module utilisateur";
                $action = " a modifié les information d'un administrateur ";
                UserActivity::saveActivity($module,$action);

                return redirect()->route('gestionnaires.show', $gestionnaire->id);
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
    public function statutG( $id){
        $gestionnaire = User::find($id);
        if (!$gestionnaire){
            session()->flash('type', 'alert-danger');
            session()->flash('message', 'L\'gestionnaire est introuvable.');
            return back();
        }
        $module = 'Module utilisateur';

        if ($gestionnaire->statut_generique_id == 2){
            $gestionnaire->statut_generique_id = 1;
            $action = " a désactivé un gestionnaire : {{$gestionnaire->nom_prenoms}}." ;
            session()->flash('message', 'L\'gestionnaire a bien été désactivé.');
        }else{
            $gestionnaire->statut_generique_id = 2;
            $action = " a procédé à la l'activation l'gestionnaire : {{$gestionnaire->nom_prenoms}}." ;
            session()->flash('message', 'L\'gestionnaire a bien été activé.');
        }
        $gestionnaire->save();

        UserActivity::saveActivity($module,$action);
        session()->flash('type', 'alert-success');
        return redirect()->back();
    }
}
