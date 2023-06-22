<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserActivity;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        $data['title'] = 'Tableau de bord ';
        $data['module'] = 'Tableau de bord';
        $data['subtitle'] = 'Tableau de bord';
        //For activity
		$module = $data['module'];
		$action = " a consulté le Tableau de bord." ;
		UserActivity::saveActivity($module,$action);

        return view('dashboard',$data);
    }
}
