<?php

namespace App\Http\Controllers\Nodal;

use Auth;
use App\Models\File;
use App\Models\Complain;
use Illuminate\Http\Request;
use App\Models\PreliminaryReport;
use App\Services\FileUploadService;
use App\Models\UserAdditionalDetail;
use App\Http\Controllers\Controller;
use App\Models\NodalAdditionalDetail;

class ComplainantController extends Controller{


    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService){

        $this->fileUploadService    =   $fileUploadService;
    }


    public function index(Request $request){

        $query  =   Complain::query();

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

        $lists  =   $query->with('preliminaryReport')->paginate(10)->withQueryString();

        return view('nodal.list', compact('lists'));
    }

    public function edit($list_id){

        $complain       =   Complain::with('preliminaryReport','userAdditionalDetails','nodalAdditionalDetails')->find($list_id);

        $nodalDocs      =   $complain->nodalAdditionalDetails;

        return view('nodal.edit', compact('complain','list_id','nodalDocs'));
    }

    public function view($complain_id){
        
        $complain                   =   Complain::with('preliminaryReport','nodalAdditionalDetails','userAdditionalDetails')->find($complain_id);
        
        return view('nodal.view', compact('complain'));
    }
    

    public function update(Request $request){

        try {
            
            if($request->hasFile('preliminary_report')){

                $complain = Complain::find($request->id);

                if ($complain) {

                    $file = File::upload($request->file('preliminary_report'), '/nodal/'.$complain->complain_no.'/preliminary_report/');

                    if ($file) {
                        
                        $complain->preliminary_report = $file->id;
                        $complain->save();
                    } 
                }
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
        
            return redirect()->route('nodal.complaints')->with('success', 'Complain has been updated');

        } catch (\Exception $e) {

            // Log the error
            \Log::error('Error updating complaint: ' . $e->getMessage());

            // Redirect with error message
            return redirect()->back()->with('error', 'Failed to update complaint. Please try again.');
        }
    }

}
