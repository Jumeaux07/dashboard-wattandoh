<?php

namespace App\Http\Controllers\Dashboard\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.guest',['except'=> 'logout']);
    }
    public function loginForm(){

        return view('auth.login');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:7'
        ]);

        if($validator->fails()){
            session()->flash('type','alert-danger');
            session()->flash('message','Erreur dans le formulaire');
            return back()->withErrors($validator->errors())->withInput($request->input());
        }

        $identifiants = $request->only('email','password');// recuperation de l'email et du mot de passe
        if(Auth::attempt($identifiants)){
            //si connexion reussie redirection vers le dashboard
            session()->flash('type','alert-success');
            session()->flash('message','Connexion reussie');
            return redirect()->route('dashboard');
        }else{
            // sinon redirection a la page de connexion
            session()->flash('type','alert-danger');
            session()->flash('message','Identifants invalides');
            return redirect()->route('login.create');
        }
    }

    public function logout(){
        auth()->logout();

        session()->flash('type','alert-success');
        session()->flash('message','Deconnecté');
        return redirect()->route('login.create');
    }
}
