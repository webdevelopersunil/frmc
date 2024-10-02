<?php

namespace App\Http\Controllers\Nodal;

use App\Models\Complain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
    
    public function index(Request $request)
    {
        $lists      =   Complain::whereHas('workCenter', function ($query) { $query->where('nodal_officer_id', Auth::user()->id ); })
                        ->with('preliminaryReport', 'workCenter', 'centerDepartment', 'ComplaintStatus')->paginate(10);

        $total      =   $lists->total();
        $closed     =   $lists->filter(function ($complain) { return $complain->complaint_status_id == 7; })->count();
        $progress   =   $lists->filter(function ($complain) { return $complain->complaint_status_id != 7; })->count();

        // $total      =   Complain::count();
        // $closed     =   Complain::where('complaint_status_id',7)->count();
        // $progress   =   Complain::where('complaint_status_id','!=',7)->count();

        return view('nodal.dashboard', compact('lists', 'total', 'closed', 'progress'));
    }
}
