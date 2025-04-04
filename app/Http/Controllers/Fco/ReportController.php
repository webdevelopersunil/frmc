<?php

namespace App\Http\Controllers\Fco;

use Auth;
use App\Models\User;
use App\Models\Complain;
use App\Models\WorkCenter;
use Illuminate\Http\Request;
use App\Models\DetailedStatus;
use App\Models\ComplaintStatus;
use App\Models\CenterDepartment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FilteredComplainsExport;

class ReportController extends Controller
{
    protected $user;

    public function __construct(){
        
        $this->user = Auth::user();
        // $this->middleware('prevent.user:fco')->only('edit');
        // $this->middleware('prevent.user:fco')->only('update');
    }

    public function index(Request $request){

        $workCenters    =   WorkCenter::with('departments')->get();
        $complaintStatus=   ComplaintStatus::all();

        if (isset($request->work_centre) && !empty($request->work_centre)) {
            $departments    =   CenterDepartment::where('work_center_id', trim($request->work_centre))->get();
        }else{
            $departments    =   NULL;
        }

        $query  =   Complain::query();

        $perPage = 10;

        // Onclick Filteration
        if (isset($request->work_centre) && !empty($request->work_centre)) {
            $query->where('work_centre_id', trim($request->work_centre));
        }
        if (isset($request->department_section) && !empty($request->department_section)) {
            $query->where('department_section_id', trim($request->department_section));
        }

        if (isset($request->complaint_status_id) && !empty($request->complaint_status_id)) {
            $query->where('complaint_status_id', trim($request->complaint_status_id));
        }

        if (isset($request->start_date) && !empty($request->start_date)) {
            $query->whereDate('created_at', trim($request->start_date));
        }

        if (isset($request->status) && !empty($request->status) && trim($request->status) == "closed" ) {
            $query->whereIn('complaint_status_id',[5,6,7]);
        }
        if (isset($request->status) && !empty($request->status) && trim($request->status) == "in_progress" ) {
            $query->whereIn('complaint_status_id',[1,2,3,4]);
        }

        // Filteration section
        if (isset($request->text) && !empty($request->text)) {
            $query->where(function ($query) use ($request) {
                $query->where('complain_no', 'LIKE', '%' . $request->text . '%')
                    // ->orWhere('work_centre_id',$request->text)
                    ->orWhere('against_persons', 'LIKE', '%' . $request->text . '%');
            });
        }

        // sorting portion
        if ($request->sort == 'name') {
            $query->orderBy('name', $by);

        } else if( $request->sort == 'os' ){
            $query->orderBy('operating_system', $by);
        }

        // Pagination Objects Start
        $lists          =   $query->with('workCenter','centerDepartment','ComplaintStatus')->paginate($perPage)->withQueryString();
        $totalRecords   =   $lists->total();
        $totalPages     =   ceil($totalRecords / $perPage);
        // Pagination Objects End

        return view('fco.report', compact('lists','perPage','totalRecords','totalPages', 'workCenters', 'departments', 'complaintStatus'));
    }
}
