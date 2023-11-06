<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Image;
use App\Models\Budget;
use App\Models\Commune;
use App\Models\Interdit;
use App\Models\Quartier;
use App\Models\Annonceur;
use App\Models\TypeDeBien;
use App\Models\Publication;
use App\Models\TypeDeMarche;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class PublicationController extends Controller
{public function __construct()
    {
        $this->middleware('admin');

        View::share("module","Module Affichage");
        View::share("title","Gestion des Affichages");

        View::share( 'menu', "Affichages" );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['subtitle'] = "Liste Des Publications";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module Affichage  ";
        $action = " a consulté la liste des publications";
        UserActivity::saveActivity($module,$action);

        $data['publications'] = Publication::all();
        $annonceurs = Annonceur:: all();
        $budgets = Budget :: all();
        $communes = Commune :: all();
        $quartiers = Quartier :: all();
        $typedemarches = TypeDeMarche::all();
        $interdits = Interdit::pluck('libelle','id');
        $typedebiens = TypeDeBien::all();

        return view('publications.index',$data,  compact('annonceurs', 'budgets','communes', 'quartiers','interdits', 'typedemarches',  'typedebiens','interdits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['subtitle'] = "Création d'une publication";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module Affichage";
        $action = " a affiché la page de création d'une publication";

        UserActivity::saveActivity($module,$action);
        $annonceurs = Annonceur:: all();
        $budgets = Budget :: all();
        $communes = Commune :: all();
        $quartiers = Quartier :: all();
        $typedemarches = TypeDeMarche::all();
        $interdits = Interdit::all();
        $typedebiens = TypeDeBien::all();
        //   $communeId =  $request-> input('commune');
        // $quartiers = Quartier::where('commune_id', $communeId)->get();
        // return view('publications.create',[
        //     'communes' => Commune::all(),
        //     'quartiers' => $quartiers,
        // ]);

        return view('publications.create',$data,
        //   [
        //     'annonceurs'=>$annonceurs,
        //     'budgets'=>$budgets,
        //     'communes'=>$communes,
        //     'quartiers'=>$quartiers,
        //     'type_de_marches'=>$typedemarches,
        //     'interdits'=>$interdits,
        //     'type_de_biens'=>$typedebiens,
        //   ]
          compact('annonceurs', 'budgets','communes', 'quartiers','interdits', 'typedemarches',  'typedebiens','interdits')
        //   ,['interdits'=>$interdits,]
        );
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
        $validator = validator::make($request->all(), [
            // 'reference'=>'required',
            'description'=>'required',
            'piece'=>'required',
            'caution'=>'required',
            'loyer'=>'required',
            'commission'=>'required',
            'interdit_id'=>'required',
            'type_de_marche_id'=>'required',
            'annonceur_id'=>'required',
            'budget_id'=>'required',
            'commune_id'=>'required',
            'quartier_id'=>'required',
            'type_de_bien_id'=>'required',
        ]);
        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }
        // $interdits = $request->input('interdits');
        $publication = new Publication();
        // $publication->reference = htmlspecialchars($request->reference);// ici le travail demande par rapport a rendre la reference automatique

         $publication->reference = "Pub 00";

        // dd($publication->reference);

        $publication->description = htmlspecialchars($request->description);
        $publication->piece = htmlspecialchars($request->piece);
        $publication->caution = htmlspecialchars($request->caution);
        $publication->loyer = htmlspecialchars($request->loyer);
        $publication->commission = htmlspecialchars($request->commission);

        $publication->annonceur_id = $request->annonceur_id;
        // dd($publication->annonceur_id);

        $publication->budget_id = $request -> budget_id;
        $publication->commune_id = $request -> commune_id;
        $publication->quartier_id = $request -> quartier_id;
        $publication->type_de_marche_id = $request -> type_de_marche_id;
        $publication->interdit_id= $request -> interdit_id;
        // $publication->interdit_id()->json_encode($request -> interdit_id) ;
        // $publication->interdits()-> attach($request->interdits ) ;
        $publication->type_de_bien_id= $request -> type_de_bien_id;

        // $publication->password = Hash::make($request->password);
        // $annonceur->role_id = 1;
        $publication->statut_generique_id = 2;
        $publication->created_by = auth()->user()->nom_prenoms;
        // $annonceurs = Annonceur:: all();


        // $communeId =  $request-> input('commune');
        // $quartiers = Quartier::where('commune_id', $communeId)->get();
        // return view('publications.create',[
        //     'communes' => Commune::all(),
        //     'quartiers' => $quartiers,
        // ]);


        if($publication->save()){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module Affichage ";
            $action = " a créé l'publication : $publication->reference ";

            UserActivity::saveActivity($module,$action);
            session()->flash('type','alert-success');
            session()->flash('message','publication créé avec succès');
            return redirect()->route('publications.index');
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message','La création d\'une publication a échoué');
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
        $data['publication'] = Publication::where('id', $id)->with('images')->first();
        // dd($data['publication'] = Publication::where('id', $id)->with('images')->first());

        $data['subtitle'] = "Detail d'une Publication";

        if($data['publication'] != null){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module Affichage";
            $action = " a affiché la page de detail d'une publication : {{$data['publication']->reference}} ";
            UserActivity::saveActivity($module,$action);
            // $images =  Image::where('id', $id)->with('url');
            return view('publications.show', $data); //, compact('images')
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message',"publication introuvable");
            return redirect()->route('publications.index');
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
        $data['publication'] = Publication::find($id);
        $data['subtitle'] = "Modification d'une Publication ";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module Affichage ";
        $action = " a affiché la page de modification d'une publication ";
        UserActivity::saveActivity($module,$action);
        $annonceurs = Annonceur:: all();
        $budgets = Budget :: all();
        $communes = Commune :: all();
        $quartiers = Quartier :: all();
        $typedemarches = TypeDeMarche::all();
        $interdits = Interdit::all();
        $typedebiens = TypeDeBien::all();


        return view('publications.edit', $data,compact('annonceurs', 'budgets','communes', 'quartiers','typedemarches', 'interdits', 'typedebiens'));
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
        // 'reference'=>'required',
        'description'=>'required',
        'piece'=>'required',
        'caution'=>'required',
        'loyer'=>'required',
        'commission'=>'required',
        'interdit_id'=>'required',
        'type_de_marche_id'=>'required',
        'annonceur_id'=>'required',
        'budget_id'=>'required',
        'commune_id'=>'required',
        'quartier_id'=>'required',
        'type_de_bien_id'=>'required',

        ]);
        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }
        $publication = Publication::find($id);
        if(!$publication){
            session()->flash('type','alert-danger');
            session()->flash('message','publication introuvable');
            return back();
        }else{
            $publication->reference =  htmlspecialchars($request->reference);
            $publication->description =  htmlspecialchars($request->description);
            $publication->piece =  htmlspecialchars($request->piece);
            $publication->caution =  htmlspecialchars($request->caution);
            $publication->loyer = htmlspecialchars($request->loyer);
            $publication->commission = htmlspecialchars($request->commission);

            $publication->annonceur_id = $request->annonceur_id;
            // dd($publication->annonceur_id);

            $publication->budget_id = $request -> budget_id;
            $publication->commune_id = $request -> commune_id;
            $publication->quartier_id = $request -> quartier_id;
            $publication->type_de_marche_id = $request -> type_de_marche_id;
            $publication->interdit_id= $request -> interdit_id;
            $publication->type_de_bien_id= $request -> type_de_bien_id;



            if($publication->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations de l\'publication ont bien été modifiées');

                //pour l'activité méné par l'utilisateur connecté
                $module = "Module Affichage";
                $action = " a modifié les information d'un publication ";
                UserActivity::saveActivity($module,$action);

                return redirect()->route('publications.show', $publication->id);
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


    public function statutPub( $id){
        $publication = Publication::find($id);
        if (!$publication){
            session()->flash('type', 'alert-danger');
            session()->flash('message', 'le publication est introuvable.');
            return back();
        }
        $module = 'Module Affichage';

        if ($publication->statut_generique_id == 2){
            $publication->statut_generique_id = 1;
            $action = " a désactivé une publication : {{$publication->reference}}." ;
            session()->flash('message', 'La publication est au brouillon .');
        }else{
            $publication->statut_generique_id = 2;
            $action = " a procédé à la l'activation d'une publication   : {{$publication->reference}}." ;
            session()->flash('message', 'La publication a bien été publier.');
        }
        $publication->save();

        UserActivity::saveActivity($module,$action);
        session()->flash('type', 'alert-success');
        return redirect()->back();
    }
    public function rechercheQuartiers(Request $request){
        $communeId =  $request-> input('commune');
        $quartiers = Quartier::where('commune_id', $communeId)->get();
        return view('publications.index',[
            'communes' => Commune::all(),
            'quartiers' => $quartiers,
        ]);
    }
}
