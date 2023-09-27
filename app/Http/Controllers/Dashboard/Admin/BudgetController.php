<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Budget;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class BudgetController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');

        View::share("module","Module utilisateur");
        View::share("title","Gestion des utilisateurs");
        // View::share( 'section_title', "Liste des Budgets" );
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
        $data['subtitle'] = "Liste des budgets";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module Utilisateur ";
        $action = " a consulté la liste des budgets ";
        UserActivity::saveActivity($module,$action);
        $data['budgets'] = Budget::all();
        $data['subtitle'] = "Liste des budgets";
        return view('budgets.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['subtitle'] = "Création d'un Budget";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de création d'un Budget";

        UserActivity::saveActivity($module,$action);

        return view('budgets.create',$data);
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
            'min' => 'required',
            'max' => 'required',


        ]);

        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }

        $budget = new Budget();
        $budget->min = htmlspecialchars($request->min);
        $budget->max = htmlspecialchars($request->max);

        $budget->statut_generique_id = 2;
        $budget->created_by = auth()->user()->nom_prenoms;

        if($budget->save()){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a créé un budget : $budget->min ";

            UserActivity::saveActivity($module,$action);
            session()->flash('type','alert-success');
            session()->flash('message','budget créé avec succès');
            return redirect()->route('budgets.index');
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message','La création d\'un budget a échoué');
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
        $data['budget'] = Budget::find($id);
        $data['subtitle'] = "Detail utilisateur";

        if($data['budget'] != null){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a affiché la page de detail d'un budget minimun de  : {{$data['budget']->min}} ";
            UserActivity::saveActivity($module,$action);

            return view('budgets.show', $data);
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message',"budget introuvable");
            return redirect()->route('budgets.index');
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

        $data['budget'] = Budget::find($id);
        $data['subtitle'] = "Modification d'un utilisateur";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de modification d'un budget ";
        UserActivity::saveActivity($module,$action);

        return view('budgets.edit', $data);
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
            'min' => 'required',
            'max' => 'required',

        ]);

        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }

        $budget = Budget::find($id);


        if(!$budget){
            session()->flash('type','alert-danger');
            session()->flash('message','budget introuvable');
            return back();
        }else{
            $budget->min =  htmlspecialchars($request->min);
            $budget->max =  htmlspecialchars($request->max);


            if($budget->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations de l\'budget ont bien été modifiées');

                //pour l'activité méné par l'utilisateur connecté
                $module = "Module utilisateur";
                $action = " a modifié les information d'un budget ";
                UserActivity::saveActivity($module,$action);

                return redirect()->route('budgets.show', $budget->id);
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


    public function statutB( $id){
        $budget = Budget::find($id);
        if (!$budget){
            session()->flash('type', 'alert-danger');
            session()->flash('message', 'le budget est introuvable.');
            return back();
        }
        $module = 'Module utilisateur';

        if ($budget->statut_generique_id == 2){
            $budget->statut_generique_id = 1;
            $action = " a désactivé un budget minimun de : {{$budget->min}}." ;
            session()->flash('message', 'Le budget a bien été désactivé.');
        }else{
            $budget->statut_generique_id = 2;
            $action = " a procédé à la l'activation d'un budget minimun de  : {{$budget->min}}." ;
            session()->flash('message', 'Le budget a bien été activé.');
        }
        $budget->save();

        UserActivity::saveActivity($module,$action);
        session()->flash('type', 'alert-success');
        return redirect()->back();
    }
}
