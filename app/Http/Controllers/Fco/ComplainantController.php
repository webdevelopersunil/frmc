<?php

namespace App\Http\Controllers\Fco;

use Auth;
use App\Models\User;
use App\Models\Complain;
use App\Models\WorkCenter;
use Illuminate\Http\Request;
use App\Models\DetailedStatus;
use App\Models\ComplaintStatus;
use Illuminate\Support\Facades\DB;
use App\Models\CenterDepartment;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;

use App\Exports\FilteredComplainsExport;
use Maatwebsite\Excel\Facades\Excel;


class ComplainantController extends Controller{

    protected $user;

    public function __construct(){
        
        $this->user = Auth::user();
        // $this->middleware('prevent.user:fco')->only('edit');
        // $this->middleware('prevent.user:fco')->only('update');
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

        // Onclick Filteration
        if (isset($request->work_centre) && !empty($request->work_centre)) {
            $query->where('work_centre_id', trim($request->work_centre));
        }
        if (isset($request->department_section) && !empty($request->department_section)) {
            // dd($request->department_section);
            $query->where('department_section_id', trim($request->department_section));
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

        return view('fco.list', compact('lists','perPage','totalRecords','totalPages', 'workCenters', 'departments'));
    }

    public function edit($list_id){

        $complain           =   Complain::with('preliminaryReport','nodalAdditionalDetails')->find($list_id);
        $detailedStatus     =   DetailedStatus::where(['complain_id'=>$list_id])->first();
        $complainStatus     =   ComplaintStatus::all();

        return view('fco.edit', compact('list_id','complain','detailedStatus','complainStatus'));
    }

    public function update(Request $request){
        
        try {
            
            // Update the Complain record
            DB::beginTransaction();

            // Update complain with public status
            $complain = Complain::find($request->id);
            if ($complain) {
                $complain->public_status    = $request->public;
                $complain->complaint_status_id = trim($request->complaint_status);
                $complain->save();
            }

            if($complain){
                // Mail & SMS Notification
                (new NotificationService($complain, 'FCO_UPDATED'))->fcoDocumentUpload();
            }
            // $complain->work_centre      = trim($request->work_centre);

            $detailedStatus = DetailedStatus::updateOrCreate(
                ['complain_id' => $request->id, 'fco_id' => \Auth::user()->id],
                ['public' => $request->public, 'private' => $request->private]
            );

            DB::commit();

            // Redirect with success message
            return redirect()->route('fco.complaint.edit',$complain->id)->with('success', 'Complaint has been updated');
            
        } catch (\Exception $e) {
            // Rollback the transaction in case of any exception
            DB::rollBack();

            // Log the error
            \Log::error('Error updating complaint: ' . $e->getMessage());

            // Redirect with error message
            return redirect()->back()->with('error', 'Failed to update complaint. Please try again.'. $e->getMessage());
        }
    }

    public function view($complain_id){

        $complain    =   Complain::with('userAdditionalDetails')->find($complain_id);
        
        $detailedStatus     =   DetailedStatus::where(['complain_id'=>$complain->id])->first();
        
        return view('fco.view', compact('complain','detailedStatus'));
    }

    public function workCentreEdit($id){

        $complain       =   Complain::with('workCenter')->find($id);
        // $nodal_users    =   User::role('nodal')->get();
        $work_centers    =   WorkCenter::whereNotNull('nodal_officer_id')->get();
        
        return view('fco.work-centre.edit', compact('complain','work_centers'));
    }

    public function workCentreUpdate(Request $request){
        
        try {
            
            // Update the Complain record
            DB::beginTransaction();

            $complain = Complain::find($request->id);
            if ($complain) {
                $complain->work_centre_id      = trim($request->work_center_id);
                $complain->save();
            }

            if($complain){
                // Notify Nodal Officer by SMS
                (new NotificationService($complain, 'FCO_WORK_CENTER_UPDATED'))->fcoWorkCenterUpdate();
            }

            DB::commit();

            // Redirect with success message
            return redirect()->back()->with('success', 'Work Center has been updated');
            
        } catch (\Exception $e) {
            // Rollback the transaction in case of any exception
            DB::rollBack();

            // Log the error
            \Log::error('Error updating complaint: ' . $e->getMessage());

            // Redirect with error message
            return redirect()->back()->with('error', 'Failed to update complaint. Please try again.'. $e->getMessage());
        }
    }

    public function export(Request $request){

        $query = Complain::query();
        // Apply the same filters from the index() method
        if ($request->work_centre) {
            $query->where('work_centre_id', trim($request->work_centre));
        }
        if ($request->department_section) {
            $query->where('department_section_id', trim($request->department_section));
        }
        if ($request->status) {
            if (trim($request->status) == "closed") {
                $query->whereIn('complaint_status_id', [5, 6, 7]);
            } elseif (trim($request->status) == "in_progress") {
                $query->whereIn('complaint_status_id', [1, 2, 3, 4]);
            }
        }
        if ($request->text) {
            $query->where(function ($query) use ($request) {
                $query->where('complain_no', 'LIKE', '%' . $request->text . '%')
                    ->orWhere('against_persons', 'LIKE', '%' . $request->text . '%');
            });
        }

        // Generate and download the Excel file
        return Excel::download(new FilteredComplainsExport($query), 'filtered_complains.xlsx');
    }

}