<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Client;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{public function __construct()
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
        $data['subtitle'] = "Liste des clients";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module Utilisateur ";
        $action = " a consulté la liste des clients";
        UserActivity::saveActivity($module,$action);

        $data['clients'] = Client::all();

        return view('clients.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['subtitle'] = "Création d'un client";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de création d'un client";

        UserActivity::saveActivity($module,$action);

        return view('clients.create',$data);
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

        $client = new Client();
        $client->nom_prenoms = htmlspecialchars($request->nom_prenoms);
        $client->phone1 = htmlspecialchars($request->phone1);
        $client->phone2 = htmlspecialchars($request->phone2);
        $client->sexe = htmlspecialchars($request->sexe);
        $client->password = Hash::make($request->password);
        // $annonceur->role_id = 1;
        $client->statut_generique_id = 2;
        $client->created_by = auth()->user()->nom_prenoms;

        if($client->save()){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a créé l'client : $client->nom_prenoms ";

            UserActivity::saveActivity($module,$action);
            session()->flash('type','alert-success');
            session()->flash('message','client créé avec succès');
            return redirect()->route('clients.index');
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message','La création d\'un client a échoué');
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
        $data['client'] = Client::find($id);
        $data['subtitle'] = "Detail utilisateur";

        if($data['client'] != null){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a affiché la page de detail d'un client : {{$data['client']->nom_prenoms}} ";
            UserActivity::saveActivity($module,$action);

            return view('clients.show', $data);
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message',"client introuvable");
            return redirect()->route('clients.index');
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
        $data['client'] = Client::find($id);
        $data['subtitle'] = "Modification d'un utilisateur";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de modification d'un client ";
        UserActivity::saveActivity($module,$action);

        return view('clients.edit', $data);
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

        $client = Client::find($id);


        if(!$client){
            session()->flash('type','alert-danger');
            session()->flash('message','client introuvable');
            return back();
        }else{
            $client->nom_prenoms =  htmlspecialchars($request->nom_prenoms);
            $client->phone1 =  htmlspecialchars($request->phone1);
            $client->phone2 =  htmlspecialchars($request->phone2);
            $client->sexe =  htmlspecialchars($request->sexe);

            if($client->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations de l\'client ont bien été modifiées');

                //pour l'activité méné par l'utilisateur connecté
                $module = "Module utilisateur";
                $action = " a modifié les information d'un client ";
                UserActivity::saveActivity($module,$action);

                return redirect()->route('clients.show', $client->id);
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
    public function statut( $id){
        $client = Client::find($id);
        if (!$client){
            session()->flash('type', 'alert-danger');
            session()->flash('message', 'Le client est introuvable.');
            return back();
        }
        $module = 'Module utilisateur';

        if ($client->statut_generique_id == 2){
            $client->statut_generique_id = 1;
            $action = " a désactivé un client : {{$client->nom_prenoms}}." ;
            session()->flash('message', 'Le client a bien été désactivé.');
        }else{
            $client->statut_generique_id = 2;
            $action = " a procédé à la l'activation l'client : {{$client->nom_prenoms}}." ;
            session()->flash('message', 'Le client a bien été activé.');
        }
        $client->save();

        UserActivity::saveActivity($module,$action);
        session()->flash('type', 'alert-success');
        return redirect()->back();
    }
}
