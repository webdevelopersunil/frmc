<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Complain;
use Illuminate\Http\Request;
use App\Models\NodalHistory;
use Illuminate\Support\Facades\Hash;
use App\Models\NodalHistoryComplaint;
use Illuminate\Validation\ValidationException;


class UserManagementController extends Controller {
    
    public function index(Request $request){

        if($request->type == "registration-form"){

            $coll   =   array();

            $coll['page']   =   "fco/user-management/includes/registration-form";
            $coll['active'] =   "registration-form";

        }else if($request->type == "revoke-access"){

            $coll   =   array();

            $coll['page']   =   "fco/user-management/includes/revoke-access";
            $coll['active'] =   "revoke-access";
            $coll['nodals'] =   User::role('nodal')->select('id', 'name','username','status')->get();

        }else if($request->type == "delegate-complaints"){

            $coll   =   array();

            $coll['nodals'] =   User::role('nodal')->where('status','inactive')->select('id', 'name','username','status')->get();

            $coll['page']   =   "fco/user-management/includes/delegate-complaints";
            $coll['active'] =   "delegate-complaints";
        }
        
        return view('fco.user-management.index', compact('coll'));
    }

    public function revokeAccess(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
        ]);

        // Find user by username
        $user = User::where('username', $request->username)->first();

        // Check if the user has the "Nodal Officer" role
        if (!$user->hasRole('nodal')) {
            return redirect()->back()->with('error', 'Only Nodal Officers can have their access revoked.');
        }

        // Proceed with revoking access (implement your logic here)
        // Example: $user->revokeAccess(); // Assuming you have a revokeAccess method
        $user->update(['status' => 'inactive']);
        

        return redirect()->back()->with('success', 'Access revoked successfully.');
    }

    
    public function registrationForm(Request $request) {

        try {

            $validatedData = $request->validate([
                'name'          => 'required|string|max:255',
                'dob' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) {
                        if (date('Y', strtotime($value)) >= 2010) {
                            $fail('The date of birth must be before the year 2010.');
                        }
                    },
                ],

                'email'         => 'required|email|unique:users,email',
                'phone'         => 'required|numeric|min:10',
                'username'      => 'required|string|max:15|unique:users,username',

                
                'address'       => 'nullable|string',
                'house_number'  => 'nullable|string',
                'area'          => 'nullable|string',
                'landmark'      => 'nullable|string',
                'city'          => 'nullable|string',
                'state'         => 'nullable|string',
                'pincode'       => 'nullable|numeric|digits:6',
                
                'role' => 'required|exists:roles,name',

                'password_confirmation' => 'required|string|min:8',
                'password'      =>  [ 
                                        'required', 'string', 'min:8', 'confirmed',  
                                        // 'regex:/^(?=.*[A-Z])(?=.*\d).+$/',
                                    ],
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'dob' => $validatedData['dob'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
                'username' => $validatedData['username'],
                'house_number' => $validatedData['house_number'],
                'area' => $validatedData['area'],
                'landmark' => $validatedData['landmark'],
                'city' => $validatedData['city'],
                'state' => $validatedData['state'],
                'pincode' => $validatedData['pincode'],
                'password' => Hash::make($validatedData['password']),
                'password' => Hash::make('ongc@123'),
            ]);

            $user->assignRole($validatedData['role']);

            return redirect()->back()->with('success', 'User created successfully with role: ' . $validatedData['role']);


        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }


    public function delegateComplaints(Request $request){

        $request->validate([
            'username' => 'required|exists:users,username',
        ]);

        $nodal  =   User::role('nodal')->where(['status'=>'inactive', 'username'=>$request->username])->with('workCenter')->select('id')->first();
        $lists  =   $nodal ? Complain::whereHas('workCenter', fn($query) => $query->where('nodal_officer_id', $nodal->id))
                                ->with('preliminaryReport', 'workCenter', 'centerDepartment', 'ComplaintStatus')->get() : collect();

        $coll               =   array();
        $coll['nodals']     =   User::role('nodal')->where('status','inactive')->select('id', 'name','username','status')->get();
        $coll['a_nodals']   =   User::role('nodal')->where('status','active')->select('id', 'name','username','status')->get();
        $coll['page']       =   "fco/user-management/includes/delegate-complaints";
        $coll['active']     =   "delegate-complaints";
        $coll['username']   =   $request->username;


        $coll['closed']     =   Complain::whereHas('workCenter', fn($query) => $query->where('nodal_officer_id', $nodal->id))
                                    ->whereIn('complaint_status_id',[5,6,7])->count();
        $coll['progress']   =   Complain::whereHas('workCenter', fn($query) => $query->where('nodal_officer_id', $nodal->id))
                                    ->whereIn('complaint_status_id',[1,2,3,4])->count();
        
        return view('fco.user-management.index', compact('nodal','lists','coll'));
    }

    public function delegateComplaintsToNodal(Request $request){
        

        // dd($request->all());
        $request->validate([
            'nodal_officer' => 'required|exists:users,username',
        ]);


        

        // "pending" => "3"
        // "work_center" => "MBA Basin Kolkata"
        // "work_center_id" => "19"
        // "old_username" => "78500"
        // "nodal_officer" => "96437"
      

        // dd($request->all());

        
        $history = NodalHistory::updateOrCreate(
            [
                'old_nodal_id' => User::where('username', $request->old_username)->value('id'),
                'new_nodal_id' => User::where('username', $request->nodal_officer)->value('id'),
                'action_type'  => 'reassigned'
            ],
            [
                'level'        => 1,
                'action_type'  => 'reassigned'
            ]
        );
        
        
        $complaintIds = Complain::whereHas('workCenter', function ($query) use ($request) {
            $query->where('nodal_officer_id', User::where('username', $request->old_username)->value('id'));
        })
        ->whereIn('complaint_status_id', [1, 2, 3, 4])
        ->pluck('id')
        ->toArray();
        
    
        foreach ($complaintIds as $cid) {
            NodalHistoryComplaint::create([
                'nodal_history_id' => $history->id,
                'complaint_id' => $cid,
            ]);
        }
        

        return redirect()->back()->withInput();
        
    }



}
