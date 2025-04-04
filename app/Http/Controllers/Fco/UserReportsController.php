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
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserReportExport;
use App\Http\Controllers\Fco\Redirect;

class UserReportsController extends Controller
{
    
    protected $user;

    public function __construct(){
        
        $this->user = Auth::user();
        // $this->middleware('prevent.user:fco')->only('edit');
        // $this->middleware('prevent.user:fco')->only('update');
    }



    public function index(Request $request){

        $query      =   User::query();
        $perPage    =   10;

        if (isset($request->role) && !empty($request->role)) {
            $query->role($request->role);
        }
        if (isset($request->text) && !empty($request->text)) {
            $query->where('name', 'LIKE', "%{$request->text}%")
                  ->orWhere('username', 'LIKE', "%{$request->text}%")
                  ->orWhere('email', 'LIKE', "%{$request->text}%")
                  ->orWhere('phone', 'LIKE', "%{$request->text}%")
                  ->orWhere('state', 'LIKE', "%{$request->text}%")
                  ->orWhere('city', 'LIKE', "%{$request->text}%");
        }
        
        // Pagination Objects Start
        $lists          =   $query->with('roles')->paginate($perPage)->withQueryString();
        $totalRecords   =   $lists->total();
        $totalPages     =   ceil($totalRecords / $perPage);
        // Pagination Objects End

        return view('fco.user-report', compact('lists','perPage','totalRecords','totalPages'));
    }

    public function reportExport(Request $request){

        $query = User::query();
        
        if (isset($request->role) && !empty($request->role)) {
            // $query->where('name','LIKE',$request->role);
        }
        if (isset($request->text) && !empty($request->text)) {
            $query->where('name','LIKE',$request->text);
        }

        // Generate and download the Excel file
        return Excel::download(new UserReportExport($query), 'user_report.xlsx');
    }

    public function profileView(Request $request){

        $user   =   User::with('roles')->find($request->user_id);
        
        return view('fco.profile.profile', compact('user'));
    }

    public function UserProfileUpdate(Request $request): RedirectResponse {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|nullable|unique:users,email,' . $request->user()->id,
            'state' => 'nullable|string|max:255',
            'pincode' => 'nullable|numeric|digits:6',
            'dob' => 'nullable|date|before:today',
            'house_number' => 'nullable',
            'address' => 'nullable',
            'landmark' => 'nullable',
            'city' => 'nullable',
            
        ]);

        $user   =   User::with('roles')->where('id',$request->id)->first();

        if($user->roles[0]['name'] != "user"){
                
            $user->name         =   $request->name;
            $user->state        =   $request->state;
            $user->pincode      =   $request->pincode;
            $user->area         =   $request->area;
            $user->dob          =   $request->dob;
            $user->house_number =   $request->house_number;
            $user->address      =   $request->address;
            $user->landmark     =   $request->landmark;
            $user->city         =   $request->city;

            $user->save();

            return redirect()->back()->with('success', 'Profile successfully updated.');

        }else{
            return redirect()->back()->with(['error' => 'User details are prohibited from being updated.']);
        }
    }

}
