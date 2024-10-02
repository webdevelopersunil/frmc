<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\Complain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class DashboardController extends Controller
{

    public function index(Request $request){

        $lists      =   Complain::where('complainant_id',Auth::user()->id)->with('workCenter','centerDepartment','ComplaintStatus')->paginate(10);
        $total      =   Complain::where('complainant_id',Auth::user()->id)->count();
        $closed     =   Complain::where('complainant_id',Auth::user()->id)->whereIn('complaint_status_id',[5,6,7])->count();
        $progress   =   $total - $closed;
 
        return view('user.dashboard', compact('lists','total','closed','progress'));
    }
    
}
