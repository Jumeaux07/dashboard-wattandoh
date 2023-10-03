<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AdministrateurController extends Controller
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
        $data['subtitle'] = "Liste des administrateurs";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module Utilisateur ";
        $action = " a consulté la liste des administrateurs ";
        UserActivity::saveActivity($module,$action);

        $data['administrateurs'] = User::where('role_id',1)->get();

        return view('administrateurs.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['subtitle'] = "Création d'un administrateur";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de création d'un administrateur";

        UserActivity::saveActivity($module,$action);

        return view('administrateurs.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nom_prenoms' => 'required',
            'email' => 'required|email|unique:users,email',
            'telephone' => 'required|min:10',
            'adresse' => 'required',
            'password' => 'required|string|min:7',
            'password_confirmation' => 'required|same:password',
        ]);

        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }

        $administrateur = new User();
        $administrateur->nom_prenoms = htmlspecialchars($request->nom_prenoms);
        $administrateur->email = htmlspecialchars($request->email);
        $administrateur->telephone = htmlspecialchars($request->telephone);
        $administrateur->adresse = htmlspecialchars($request->adresse);
        $administrateur->password = Hash::make($request->password);
        $administrateur->role_id = 1;
        $administrateur->statut_generique_id = 2;
        $administrateur->created_by = auth()->user()->nom_prenoms;

        if($administrateur->save()){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a créé l'administrateur : $administrateur->nom_prenoms ";

            UserActivity::saveActivity($module,$action);
            session()->flash('type','alert-success');
            session()->flash('message','Administrateur créé avec succès');
            return redirect()->route('administrateurs.index');
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message','La création d\'un administrateur a échoué');
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
        $data['administrateur'] = User::find($id);
        $data['subtitle'] = "Detail d'un administrateur";

        if($data['administrateur'] != null){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a affiché la page de detail d'un administrateur : {{$data['administrateur']->nom_prenoms}} ";
            UserActivity::saveActivity($module,$action);

            return view('administrateurs.show', $data);
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message',"Administrateur introuvable");
            return redirect()->route('administrateurs.index');
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
        $data['administrateur'] = User::find($id);
        $data['subtitle'] = "Modification d'un administrateur";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de modification d'un administrateur ";
        UserActivity::saveActivity($module,$action);

        return view('administrateurs.edit', $data);
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

        $administrateur = User::find($id);


        if(!$administrateur){
            session()->flash('type','alert-danger');
            session()->flash('message','Administrateur introuvable');
            return back();
        }else{
            $administrateur->nom_prenoms =  htmlspecialchars($request->nom_prenoms);
            $administrateur->email =  htmlspecialchars($request->email);
            $administrateur->telephone =  htmlspecialchars($request->telephone);
            $administrateur->adresse =  htmlspecialchars($request->adresse);

            if($administrateur->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations de l\'administrateur ont bien été modifiées');

                //pour l'activité méné par l'utilisateur connecté
                $module = "Module utilisateur";
                $action = " a modifié les information d'un administrateur ";
                UserActivity::saveActivity($module,$action);

                return redirect()->route('administrateurs.show', $administrateur->id);
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

    // Activation ou desactivation de compte
    public function changeStatut( $id){
        $administateur = User::find($id);
        if (!$administateur){
            session()->flash('type', 'alert-danger');
            session()->flash('message', 'L\'administrateur est introuvable.');
            return back();
        }
        $module = 'Module utilisateur';

        if ($administateur->statut_generique_id == 2){
            $administateur->statut_generique_id = 1;
            $action = " a désactivé un administrateur : {{$administateur->nom_prenoms}}." ;
            session()->flash('message', 'L\'administrateur a bien été désactivé.');
        }else{
            $administateur->statut_generique_id = 2;
            $action = " a procédé à la l'activation l'administrateur : {{$administateur->nom_prenoms}}." ;
            session()->flash('message', 'L\'administrateur a bien été activé.');
        }
        $administateur->save();

        UserActivity::saveActivity($module,$action);
        session()->flash('type', 'alert-success');
        return redirect()->back();
    }
}
