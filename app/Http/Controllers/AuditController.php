<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Complain;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuditController extends Controller{
    
    public function index(Request $request){
        
        $perPage  =   20;
        $query          =   Audit::query();

        $users = User::role($request->role)->get(['id','name']);
        
        if (isset($request->role) && !empty($request->role)) {
            // dd($request->role);
            if (isset($request->user) && !empty($request->user)) {
                $query->where('user_id', $request->user);
            }
        }


        $lists  =   $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();

        
        $totalRecords = $lists->total();
        $totalPages = ceil($totalRecords / $perPage);
        // Pagination Objects End

        return view('audits.index', compact('lists','perPage','totalRecords','totalPages','users'));

    }

    public function viewAudit($id){
        
        $audit   =   Audit::find($id);
        $user   =   User::with('roles')->where('id', $audit->user_id)->first(['name','email','cpfNo','phone']);
        
        return view('audits.detail', compact('audit','user'));
    }
}
