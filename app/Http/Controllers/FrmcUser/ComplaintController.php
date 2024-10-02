<?php

namespace App\Http\Controllers\FrmcUser;

use App\Http\Controllers\Controller;
use App\Models\DetailedStatus;
use Illuminate\Http\Request;
use App\Models\Complain;
use Auth;

class ComplaintController extends Controller {
    
    protected $user;

    public function __construct(){
        
        $this->user = Auth::user();
    }

    public function index(Request $request){

        $query  =   Complain::query();

        $perPage = 10;

        // Onclick Filteration
        if (isset($request->work_centre) && !empty($request->work_centre)) {
            $query->where('work_centre', 'LIKE', '%' . $request->work_centre . '%');
        }
        if (isset($request->department_section) && !empty($request->department_section)) {
            $query->where('department_section', 'LIKE', '%' . $request->department_section . '%');
        }

        // Filteration section
        if (isset($request->text) && !empty($request->text)) {
            $query->where(function ($query) use ($request) {
                $query->where('complain_no', 'LIKE', '%' . $request->text . '%')
                    ->orWhere('work_centre', 'LIKE', '%' . $request->text . '%')
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
        $lists  =   $query->paginate($perPage)->withQueryString();
        $totalRecords   =   $lists->total();
        $totalPages     =   ceil($totalRecords / $perPage);
        // Pagination Objects End

        return view('frmc_user.list', compact('lists','perPage','totalRecords','totalPages'));
    }

    public function view($complain_id){

        $complain    =   Complain::with('userAdditionalDetails')->find($complain_id);
        
        $detailedStatus     =   DetailedStatus::where(['complain_id'=>$complain->id])->first();
        
        return view('frmc_user.view', compact('complain','detailedStatus'));
    }
    
}
