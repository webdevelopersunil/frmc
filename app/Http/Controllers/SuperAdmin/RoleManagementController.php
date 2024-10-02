<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\View;

class RoleManagementController extends Controller {

    public function index(Request $request){

        $query          =   User::query();
        $perPage        =   10;

        $roles          =   Role::whereNotIn('name', ['super-admin'])->get();

        $nodalUserCount =   User::getUserRoleCount('nodal');
        $fcoUserCount   =   User::getUserRoleCount('fco');
        
        View::share('title', "User Administrator");

        $query->whereNotNull('phone');

        // Filteration section
        if (isset($request->text) && !empty($request->text)) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->text . '%')
                    ->orWhere('cpfNo', 'LIKE', '%' . $request->text . '%')
                    ->orWhere('username', 'LIKE', '%' . $request->text . '%');
            });
        }

        // Pagination Objects Start
        $lists  =   $query->paginate($perPage)->withQueryString();
        $totalRecords = $lists->total();
        $totalPages = ceil($totalRecords / $perPage);
        // Pagination Objects End

        $lists->getCollection()->transform(function ($user) {
            $user->role_names = $user->roles->pluck('name')->implode(', ');
            return $user;
        });


        return view('super-admin.index', compact('lists','perPage','totalRecords','totalPages','nodalUserCount','fcoUserCount','roles'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        
        View::share('title', "User Administrator");

        $currentRole    =   "";
        $token  =   $id;
        $roles  =   Role::whereNotIn('name', ['super-admin'])->get();
        $user   =   User::find($id);
        
        foreach ($user->getRoleNames() as $role) {
            $currentRole =$role;
            break;
        }
        return view('super-admin.show', compact('user','token','roles', 'currentRole'));
    }

    public function update(Request $request, string $id) {
        
        $user_id        =   $request->id;
        $currentRole    =   User::getCurrentRole($user_id);
        $new_role       =   Role::where('id', $request->role)->value('name');
        $user           =   User::find($id);

        try {

            
            if($new_role == 'super-admin' || $new_role == NULL){
                return redirect()->back()->with('error', 'Un-authorized role selected.');
            }

            $user->removeRole($currentRole);
            
            if ($user) {

                $user->assignRole($new_role);

                return redirect()->route('user.roles.list')->with('success', 'User role updated successfully.');

            } else {
                
                return redirect()->back()->with('error', 'User not found.');
            }

        } catch (Exception $e) {

            // Log the exception message if needed
            \Log::error('Error updating user role: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while updating the user role. Please try again.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
