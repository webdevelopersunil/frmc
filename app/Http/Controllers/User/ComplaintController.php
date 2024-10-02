<?php

namespace App\Http\Controllers\User;

use App\Models\File;
use App\Models\Complain;
use App\Models\WorkCenter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\CenterDepartment;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use App\Models\UserAdditionalDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller{

    public function __construct(){

        $this->middleware('prevent.user:user')->only('edit');
    }

    public function index(Request $request){

        $workCenters    =   WorkCenter::with('departments')->get();

        if (isset($request->work_centre) && !empty($request->work_centre)) {
            $departments    =   CenterDepartment::where('work_center_id', trim($request->work_centre))->get();
        }else{
            $departments    =   NULL;
        }

        $query          =   Complain::query();
        $perPage        =   10;

        $query->where('complainant_id', Auth::user()->id)->with('workCenter','ComplaintStatus')->with('centerDepartment');

        // Onclick Filteration
        if (isset($request->work_centre) && !empty($request->work_centre)) {
            $query->where('work_centre_id', $request->work_centre);
        }
        if (isset($request->department_section) && !empty($request->department_section)) {
            $query->where('department_section_id', $request->department_section);
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
                    // ->orWhere('work_centre', 'LIKE', '%' . $request->text . '%') 
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
        
        $totalRecords = $lists->total();
        $totalPages = ceil($totalRecords / $perPage);
        // Pagination Objects End

        return view('user.list', compact('lists','perPage','totalRecords','totalPages', 'workCenters', 'departments'));
    }

    public function create(Request $request){
        
        $complainNo         =   Complain::getComplainNo();
        $workCenters        =   WorkCenter::with('departments')->get();
        $centerDepartment   =   CenterDepartment::all();

        return view('user.create', compact('complainNo', 'workCenters', 'centerDepartment'));
    }

    
    public function store(Request $request) {
        
        // Validate the input data
        $attributes = $request->validate([
            'complain_no'               => ['required'],
            'description'               => ['required'],
            'work_centre'               => ['required'],
            'department_section'        => ['required'],
            'against_persons'           => ['required'],
            'other_section'             => ['nullable', 'string'],
            'document.*'                => ['nullable', 'file', 'max:15360'],
            'additional_detail.*'       => ['nullable', 'string'],
        ], [
            'document.*.max'            => 'The document size must not exceed 15 MB.',
        ]);
        

        try {
            // Create a new complaint
            $complain = new Complain();
            
            $complain->complain_no = $request->complain_no;
            $complain->complainant_id = Auth::user()->id;
            $complain->description = $request->description;

            $complain->work_centre_id = $request->work_centre;
            $complain->department_section_id = $request->department_section;
            $complain->other_section = $request->other_section;
            
            $complain->against_persons = $request->against_persons;
            // $complain->public_status = $request->public_status; // Uncomment if needed
            $complain->save();

            
            if ($complain) {
                // Notify Nodal Officer by SMS
                (new NotificationService($complain, 'CREATED'))->userComplainCreate();
            }

            // Check if there are any documents to upload
            if ($request->hasFile('document')) {
                foreach ($request->file('document') as $index => $file) {
                    // Upload the file and save its details
                    $uploadedFile = File::upload($file, $complain->complain_no . '/user/additional-document/');
                    
                    // Save the additional details
                    $userAdditionalDetail = new UserAdditionalDetail();
                    $userAdditionalDetail->complain_id      = $complain->id;
                    $userAdditionalDetail->complainant_id   = Auth::user()->id;
                    $userAdditionalDetail->description      = $request->additional_detail[$index] ?? '';
                    $userAdditionalDetail->file_id          = $uploadedFile->id;
                    
                    $userAdditionalDetail->save();
                }
            }

            return redirect()->route('user.complaints')->with('success', 'Complaint has been created and the complaint number is ' . $complain->complain_no);
            
        } catch (\Exception $e) {
            \Log::error('Complaint creation failed: ' . $e->getMessage());
            return redirect()->route('user.complaint.create')->with('error', 'Failed to register complaint: ' . $e->getMessage());
        }
    }

    public function update(Request $request) {

        // Validate the input data
        $attributes = $request->validate([
            'document.*'                => ['required', 'file', 'max:15360'],
            'additional_detail.*'       => ['required', 'string'],
        ], [
            'document.*.max'            => 'The document size must not exceed 15 MB.',
        ]);


        try {
            // Find the existing complaint
            $complain = Complain::findOrFail($request->complaint_id);

            if($complain->complaint_status == "Withdrawn – to be ignored"){
                
                return redirect()->route('user.complaint.edit', $complain->id)->with('error', 'Failed to update complaint');
            }
            
            // Handle document uploads and additional details
            if ($request->hasFile('document')) {

                foreach ($request->file('document') as $index => $file) {
                    // Upload the file and save its details
                    $uploadedFile = File::upload($file, $complain->complain_no . '/user/additional-document/');
                    
                    // Save the additional details
                    $userAdditionalDetail = new UserAdditionalDetail();
                    $userAdditionalDetail->complain_id      = $complain->id;
                    $userAdditionalDetail->complainant_id   = Auth::user()->id;
                    $userAdditionalDetail->description      = $request->additional_detail[$index] ?? '';
                    $userAdditionalDetail->file_id          = $uploadedFile->id;
                    
                    $userAdditionalDetail->save();
                }
            }

            if ($complain) {
                // Notify Nodal Officer by SMS
                (new NotificationService($complain, 'CREATED'))->userComplainUpdate();
            }

            return redirect()->route('user.complaint.edit',$request->complaint_id)->with('success', 'Complaint has been updated successfully.');

        } catch (\Exception $e) {
            \Log::error('Complaint update failed: ' . $e->getMessage());
            return redirect()->route('user.complaint.update', $complain->id)->with('error', 'Failed to update complaint: ' . $e->getMessage());
        }
    }



    public function view($complain_id){
 
        $complain               =   Complain::with('preliminaryReport','userAdditionalDetails','workCenter','centerDepartment','ComplaintStatus')->find($complain_id);
        $userAdditionalDetails  =   UserAdditionalDetail::where('complain_id',$complain->id)->get();

        return view('user.view', compact('complain'));
    }
    
    public function edit(Request $request){

        $complain               =   Complain::with('preliminaryReport','userAdditionalDetails')->with('workCenter')->with('centerDepartment')->find($request->id);
        $userAdditionalDetails  =   UserAdditionalDetail::where('complain_id',$complain->id)->get();

        return view('user.edit', compact('complain'));
    }
}
