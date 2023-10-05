<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Otp;
use App\Models\Client;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class OtpController extends Controller
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
        $data['subtitle'] = "listes des otps";
        $module = "Module Utilisateur ";
        $action =  "A consulte la listes des otps";
        UserActivity::saveActivity($module, $action);
        $data['otps']= Otp::all();
        $data['subtitle'] =  "listes des otps ";
        $clients = Client::all();
        return view('otps.index', $data, compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['subtitle']= "creation d'un otp";
        $module = "Module Utilisateur";
        $action = "creation de otp";
        UserActivity::saveActivity($module,$action);
        $clients = Client::all();
        return view('otps.create', $data,compact('clients') );
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
            'code'=>'required',
            'expires_at'=>'required',
            'client_id'=>'required',
        ]);
        if ($validator->fails()) {
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le Formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
         }
         $otp =  new Otp();
         $otp->code = htmlspecialchars($request->code);
         $otp->expires_at = htmlspecialchars($request->expires_at);
         $otp-> client_id = $request->client_id;
        //  $otp -> created_by = auth()->user()->nom_prenoms;
        if ($otp ->save()) {
            // activation mene par un utilisateur
            $module="Module Utilisateur";
            $action = "a creer une otp du nom de : $otp->code";
            UserActivity::saveActivity('$module', '$action');
            session()->flash('type','alert-success');
            session()->flash('message','otp creer avec succès');
            return redirect()->route('otps.index');
        }else {
            session()->flash('type','alert-danger');
            session()->flash('message','creation de otp a  echoué');
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
        $data['otp'] = Otp::find($id);
        $data['subtitle']= " Detail otp";
        if ($data['otp'] != null ) {
            $module = "Module Utilisateur";
            $action = " a afficher le otp : {{$data['otp']->code}}";
            UserActivity::saveActivity('$module', '$action');
            return view ('otps.show', $data);
        }else {
            session()->flash('type', 'alert-danger');
            session()->flash('message','otp Introuvable');
            return redirect()->route('otps.index');
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
        $data['otp'] = Otp::find($id);
        $data['subtitle'] = "Modification d'un otp";

        //pour l'activité méné par l'utilisateur connecté
        $module = "Module utilisateur";
        $action = " a affiché la page de modification d'un otp ";
        UserActivity::saveActivity($module,$action);
        $clients = Client::all();
        return view('otps.edit', $data, compact('clients'));
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
        $validator =  Validator::make($request->all(),[
            'code'=>'required',
            'expires_at'=>'required',
            'client_id'=>'required',
        ]);
        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }
        $otp = Otp::find($id);
        if(!$otp){
            session()->flash('type','alert-danger');
            session()->flash('message','otp introuvable');
            return back();
        }else{
            $otp->code = htmlspecialchars($request->code);
            $otp->expires_at = htmlspecialchars($request->expires_at);
            // $otp-> client_id = $request->client_id;

            if($otp->save()){
                session()->flash('type','alert-success');
                session()->flash('message','Les informations de la otp ont bien été modifiées');
                //pour l'activité méné par l'utilisateur connecté
                $module = "Module utilisateur";
                $action = " a modifié les information d'une otp ";
                UserActivity::saveActivity($module,$action);
                return redirect()->route('otps.show', $otp->id);
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
