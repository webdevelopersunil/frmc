<?php

namespace App\Http\Controllers\User;

use App\Models\File;
use App\Models\Complain;
use App\Models\WorkCenter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\UserAdditionalDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller{
    
    public function index(Request $request){

        $query  =   Complain::query();

        $query->where('complainant_id', Auth::user()->id);

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

        $lists  =   $query->paginate(10)->withQueryString();

        return view('user.list', compact('lists'));
    }

    public function create(Request $request){
        
        $complainNo     =   Complain::getComplainNo();
        $workCenters = WorkCenter::with('departments')->get();

        return view('user.create', compact('complainNo', 'workCenters'));
    }

    public function store(Request $request){
        
        $attributes = request()->validate([
            'complain_no'                   => ['required'],
            'description'                   => ['required'],
            'department_section'            => ['required'],
            'against_persons'               => ['required'],
            'work_centre'                   => ['required'],
        ]);

        try {
            
            $complain                       =   new Complain();
            $complain->complain_no          =   $request->complain_no;
            $complain->complainant_id       =   Auth::user()->id;
            $complain->description          =   $request->description;
            $complain->work_centre          =   $request->work_centre;
            $complain->department_section   =   $request->department_section === 'Others' ? $request->department_section_other : $request->department_section;
            $complain->against_persons      =   $request->against_persons;
            $complain->public_status        =   $request->public_status;
            $complain->save();

            if ($request->hasFile('document')) {

                foreach( $request->file('document') as $index => $file ){
                    
                    $file   =   File::upload($file, $complain->complain_no.'/user/additional-document/');
                    
                        $userAdditionalDetail                   =   new UserAdditionalDetail();
                        $userAdditionalDetail->complain_id      =   $complain->id;
                        $userAdditionalDetail->complainant_id   =   Auth::user()->id;
                        $userAdditionalDetail->description      =   $request->additional_detail[$index];
                        $userAdditionalDetail->file_id          =   $file->id;

                        $userAdditionalDetail->save();
                }
            }

            return redirect()->route('user.complaints')->with('success', 'Complaint has been created and the complaint number is ' . $complain->complain_no);
            
        } catch (\Exception $e) {
            
            return redirect()->route('user.complaint.create')->with('error', 'Failed to register complaint: '.$e->getMessage());
        }

    }

    public function view($complain_id){
 
        $complain               =   Complain::with('preliminaryReport','userAdditionalDetails')->find($complain_id);
        $userAdditionalDetails  =   UserAdditionalDetail::where('complain_id',$complain->id)->get();

        return view('user.view', compact('complain'));
    }
    
    public function edit(Request $request){

        return view('user.edit');
    }
}