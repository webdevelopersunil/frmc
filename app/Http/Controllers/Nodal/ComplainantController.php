<?php

namespace App\Http\Controllers\Nodal;

use Auth;
use App\Models\File;
use App\Models\Complain;
use Illuminate\Http\Request;
use App\Models\WorkCenter;
use App\Models\CenterDepartment;
use App\Models\PreliminaryReport;
use App\Services\FileUploadService;
use App\Models\UserAdditionalDetail;
use App\Http\Controllers\Controller;
use App\Models\NodalAdditionalDetail;
use App\Services\NotificationService;

class ComplainantController extends Controller{


    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService){

        $this->fileUploadService    =   $fileUploadService;
        $this->middleware('prevent.user:nodal')->only('edit');
        // $this->middleware('prevent.user:nodal')->only('update');
    }


    public function index(Request $request){

        $workCenters    =   WorkCenter::with('departments')->get();

        if (isset($request->work_centre) && !empty($request->work_centre)) {
            $departments    =   CenterDepartment::where('work_center_id', trim($request->work_centre))->get();
        }else{
            $departments    =   NULL;
        }

        $query  =   Complain::query();

        $perPage = 10;

        // Records as per nodal officer
        $query->whereHas('workCenter', function ($query) { $query->where('nodal_officer_id', Auth::user()->id ); });

        // Onclick Filteration
        if (isset($request->work_centre) && !empty($request->work_centre)) {
            $query->where('work_centre_id',$request->work_centre);
        }
        if (isset($request->department_section) && !empty($request->department_section)) {
            $query->where('department_section_id',$request->department_section);
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
        // $lists  =   $query->paginate($perPage)->withQueryString();
        $lists          =   $query->with('preliminaryReport','workCenter','centerDepartment','ComplaintStatus')->paginate($perPage)->withQueryString();
        $totalRecords   =   $lists->total();
        $totalPages     =   ceil($totalRecords / $perPage);
        // Pagination Objects End

        return view('nodal.list', compact('lists','perPage','totalRecords','totalPages', 'workCenters', 'departments'));
    }

    public function edit($list_id){

        $complain       =   Complain::with('nodalPreliminaryReports','userAdditionalDetails','nodalAdditionalDetails')->find($list_id);

        $nodalDocs      =   $complain->nodalAdditionalDetails;

        return view('nodal.edit', compact('complain','list_id','nodalDocs'));
    }

    public function view($complain_id){
        
        $complain                   =   Complain::with('nodalPreliminaryReports','nodalAdditionalDetails','userAdditionalDetails')->find($complain_id);
        
        return view('nodal.view', compact('complain'));
    }
    

    public function update(Request $request){
        
        // Validate the input data
        $attributes = $request->validate([
            'preliminary_report'        => ['nullable','file', 'max:15360'],
            'files.*'                   => ['nullable','file', 'max:15360'],
            'details.*'                 => ['nullable','string'],
        ], [
            'files.*.max'               => 'The document size must not exceed 15 MB.',
            'preliminary_report.max'    => 'The document size must not exceed 15 MB.',
        ]);
        
        try {
            
            $complain = Complain::find($request->id);
            
            if($request->file('preliminary_report')){

                if ($complain) {
                    
                    $file = File::upload($request->file('preliminary_report'), '/nodal/'.$complain->complain_no.'/preliminary_report/');

                    if ($file) {
                        
                        $complain->preliminary_report = $file->id;
                        $complain->save();

                        $nodalAdditionalDetail              =   new NodalAdditionalDetail();
                        $nodalAdditionalDetail->complain_id =   $request->id;
                        $nodalAdditionalDetail->nodal_id    =   \Auth::user()->id;
                        $nodalAdditionalDetail->description =   "---";
                        $nodalAdditionalDetail->flag        =   "preliminary_report";
                        $nodalAdditionalDetail->file_id     =   $file->id;
                        $nodalAdditionalDetail->save();

                        
                    }
                    // preliminary_report submission status change
                    (new Complain)->updateStatus($complain, 1);
                }
            }

            if($nodalAdditionalDetail){
                // Notify Nodal Officer by SMS
                (new NotificationService($complain, 'CREATED'))->nodalDocumentUpdate();
            }
            
            if( $request->hasFile('files') ){
                foreach( $request->file('files') as $index => $file ){
                    
                    $file       =   File::upload($file, '/nodal/'.$complain->complain_no.'/additional_document/');
                    
                    $nodalAdditionalDetail                  =   new NodalAdditionalDetail();
                    $nodalAdditionalDetail->complain_id     =   $request->id;
                    $nodalAdditionalDetail->nodal_id        =   \Auth::user()->id;
                    $nodalAdditionalDetail->description     =   $request->details[$index];
                    $nodalAdditionalDetail->file_id         =   $file->id;

                    $nodalAdditionalDetail->save();
                }
            }
        
            return redirect()->route('user.nodal.view',$request->id)->with('success', 'Complain has been updated');

        } catch (\Exception $e) {

            // Log the error
            \Log::error('Error updating complaint: ' . $e->getMessage());

            // Redirect with error message
            return redirect()->back()->with('error', 'Failed to update complaint. Please try again.');
        }
    }

}
