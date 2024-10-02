<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class FrontendController extends Controller{
    
    public function index(){

        return view('auth.welcome');
    }

    public function adminLogin(){

        return view('auth.admin-login');
    }

    public function adminWelcome(){
        
        return view('auth.admin-welcome');
    }

    public function complainantLogin(){

        return view('auth.user_login');
    }

    
}