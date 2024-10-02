<?php

namespace App\Http\Controllers\FrmcUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complain;

class DashboardController extends Controller
{
    public function index(Request $request){
        
        $lists  =   Complain::paginate(10);

        $total  =   Complain::count();

        return view('frmc_user.dashboard', compact('lists','total'));
    }
}
