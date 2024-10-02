<?php

namespace App\Http\Controllers\Fco;

use App\Models\Complain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index(Request $request){

        $lists      =   Complain::with('workCenter','centerDepartment','ComplaintStatus')->paginate(10);
        $total      =   Complain::count();
        $closed     =   Complain::whereIn('complaint_status_id',[7, 5, 6])->count();
        
        $progress   =   $total - $closed;

        return view('fco.dashboard', compact('lists', 'total', 'closed','progress'));
    }

}
