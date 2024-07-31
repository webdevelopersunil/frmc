<?php

namespace App\Http\Controllers\Fco;

use Auth;
use App\Models\Complain;
use Illuminate\Http\Request;
use App\Models\DetailedStatus;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ComplainantController extends Controller{

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

        return view('fco.list', compact('lists','perPage','totalRecords','totalPages'));
    }

    public function edit($list_id){

        $complain           =   Complain::with('preliminaryReport','nodalAdditionalDetails')->find($list_id);
        
        $detailedStatus     =   DetailedStatus::where(['complain_id'=>$list_id])->first();
        
        return view('fco.edit', compact('list_id','complain','detailedStatus'));
    }

    public function update(Request $request){
        
        try {
            
            // Update the Complain record
            DB::beginTransaction();

            // Update complain with public status
            $complain = Complain::find($request->id);
            if ($complain) {
                $complain->public_status    = $request->public;
                $complain->complaint_status = trim($request->complaint_status);
                $complain->save();
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

        $complain   =   Complain::with('preliminaryReport','nodalAdditionalDetails')->find($id);
        
        return view('fco.work-centre.edit', compact('complain'));

    }

    public function workCentreUpdate(Request $request){
        
        try {
            
            // Update the Complain record
            DB::beginTransaction();

            $complain = Complain::find($request->id);
            if ($complain) {
                $complain->work_centre      = trim($request->work_centre);
                $complain->save();
            }            

            DB::commit();

            // Redirect with success message
            return redirect()->route('fco.complaints')->with('success', 'Complaint has been updated');
            
        } catch (\Exception $e) {
            // Rollback the transaction in case of any exception
            DB::rollBack();

            // Log the error
            \Log::error('Error updating complaint: ' . $e->getMessage());

            // Redirect with error message
            return redirect()->back()->with('error', 'Failed to update complaint. Please try again.'. $e->getMessage());
        }
    }

}