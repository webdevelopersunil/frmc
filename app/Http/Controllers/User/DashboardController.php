<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\Complain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class DashboardController extends Controller
{
    
    public function index(Request $request){

        $lists  =   Complain::where('complainant_id',Auth::user()->id)->paginate(10);
        $total  =   Complain::count();

        return view('user.dashboard', compact('lists','total'));
    }
    
}
