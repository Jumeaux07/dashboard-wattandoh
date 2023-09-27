<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Image;
use App\Models\Publication;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');

        View::share("module","Module utilisateur");
        View::share("title","Gestion des utilisateurs");
        // View::share( 'section_title', "Liste des communes" );
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
        $data['subtitle'] = "Liste des Images";
        $module = " Module Utilisateur";
        $action = " a consulter la liste des Image";
        UserActivity:: saveActivity('$module', '$action');
        $data['images']= Image::all();
        $data['subtilte'] = " Liste des Images";
        $publications= Publication::all();
        return view('images.index', $data, compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['subtitle']= "creation d'une Image";
        $module = "Module Utilisateur";
        $action = "creation d'Image";
        UserActivity::saveActivity($module,$action);
        $publications = Publication::all();
        return view('images.create', $data, compact('publications'));

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
            'url'=>'required',
            // 'url'=>'required|image|mimes:jpeg,png,gif|max:2048',
            // dd('url'),
            'publication_id'=> 'required',
        ]);
        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }
        $image = new Image();
        $image->url = htmlspecialchars($request->url);
        // $image->url = $request->file('url')->storage('photopubs');
        // dd($image->url );
        // $image = $request->file('url')->storage_path('photopubs');
        $image->publication_id = $request->publication_id;
        // $image->statut_generique_id = 2;
        $image->created_by = auth()->user()->nom_prenoms;
        if($image->save()){
            $module = "Module utilisateur";
            $action = " a créé une image : $image->url ";
            UserActivity::saveActivity($module,$action);
            session()->flash('type','alert-success');
            session()->flash('message','image créé avec succès');
            return redirect()->route('images.index');
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message','La création d\'une Image  a échoué');
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
        $data['image'] = Image::find($id);
        $data['subtitle'] = "Detail utilisateur";
        if($data['image'] != null){
            //pour l'activité méné par l'utilisateur connecté
            $module = "Module utilisateur";
            $action = " a affiché la page de detail d'une image de  : {{$data['image']->url}} ";
            UserActivity::saveActivity($module,$action);

            return view('images.show', $data);
        }else{
            session()->flash('type','alert-danger');
            session()->flash('message',"image  introuvable");
            return redirect()->route('images.index');
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
        $data['image'] = Image:: find($id);
        $data['subtitle'] = "Modification d'Utilisateur ";
        $module = " Module Utilisateur";
        $action = " A afficher la page de modification d'une Image ";
        UserActivity :: saveActivity('$module', '$action');
        $publications = Publication::all();
        return view('images.edit', $data, compact('publications'));
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
            'url'=>'required|image|mimes:jpeg,png,gif|max:2048',
            'publication_id' => 'required',
        ]);
        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }
        $image = Image::find($id);
        if(!$image){
            session()->flash('type','alert-danger');
            session()->flash('message','image introuvable');
            return back();
        }else{
            $image->url =  htmlspecialchars($request->url);
            $image->publication_id =  htmlspecialchars($request->publication_id);
            if($image->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations d\' une image ont bien été modifiées');

                $module = "Module utilisateur";
                $action = " a modifié les information d'une image ";
                UserActivity::saveActivity($module,$action);

                return redirect()->route('images.show', $image->id);
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
    public function statutImage( $id){
        $image = Image::find($id);
        if (!$image){
            session()->flash('type', 'alert-danger');
            session()->flash('message', 'l image est introuvable.');
            return back();
        }
        $module = 'Module utilisateur';

        if ($image->statut_generique_id == 2){
            $image->statut_generique_id = 1;
            $action = " a désactivé une Image de : {{$image->url}}." ;
            session()->flash('message', 'L Image a bien été désactivé.');
        }else{
            $image->statut_generique_id = 2;
            $action = " a procédé à la l'activation d'une Image  de  : {{$image->url}}." ;
            session()->flash('message', 'L Image a bien été activé.');
        }
        $image->save();

        UserActivity::saveActivity($module,$action);
        session()->flash('type', 'alert-success');
        return redirect()->back();
    }
    public function upload(Request $request){
        $request->validate([
            'url'=>'required|image|mimes:jpeg,png,gif|max:2048',
            // 'publication_id' => 'required',

        ]);
        //  enregistre l image
        $image = $request->file('url')->store('photopubs');
        return redirect()->back()->with('message','image créé avec succès');


    }

}
