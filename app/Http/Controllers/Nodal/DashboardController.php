<?php

namespace App\Http\Controllers\Nodal;

use App\Models\Complain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller {

    protected $CMP_CLOSED;

    public function __construct() {

        $this->CMP_CLOSED    =   config('complain.CMP_CLOSED');
    }

    
    public function index(Request $request)
    {

        $lists      =   Complain::whereHas('workCenter', function ($query) {
                                    $query->where('nodal_officer_id', Auth::user()->id);
                                })->with('preliminaryReport', 'workCenter', 'centerDepartment', 'ComplaintStatus')->paginate(10);

        $total      =   Complain::whereHas('workCenter', function ($query) { 
                                    $query->where('nodal_officer_id', Auth::user()->id);
                                })->count();

        $closed     =   Complain::whereHas('workCenter', function ($query) {
                                    $query->where('nodal_officer_id', Auth::user()->id);
                                })->whereIn('complaint_status_id', $this->CMP_CLOSED)->count();

        $progress   =   Complain::whereHas('workCenter', function ($query) { 
                                    $query->where('nodal_officer_id', Auth::user()->id); 
                                })->whereNotIn('complaint_status_id', $this->CMP_CLOSED)->count();

        return view('nodal.dashboard', compact('lists', 'total', 'closed', 'progress'));
    }
}
