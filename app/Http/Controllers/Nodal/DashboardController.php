<?php

namespace App\Http\Controllers\Nodal;

use App\Models\Complain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller{
    
    
    public function index(Request $request){

        $lists  =   Complain::with('preliminaryReport')->paginate(10);

        $total  =   Complain::count();

        return view('nodal.dashboard', compact('lists','total'));
    }
}
