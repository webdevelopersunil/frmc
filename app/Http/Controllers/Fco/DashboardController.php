<?php

namespace App\Http\Controllers\Fco;

use App\Models\Complain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index(Request $request){

        $lists  =   Complain::paginate(10);

        $total  =   Complain::count();

        return view('fco.dashboard', compact('lists','total'));
    }

}
