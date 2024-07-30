<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\Complain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class DashboardController extends Controller
{
    
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

        $lists  =   $query->paginate(1)->withQueryString();

        return view('user.dashboard', compact('lists'));
        // return view('user.list', compact('lists'));
    }

    public function index_old(Request $request){

        $lists  =   Complain::where('complainant_id',Auth::user()->id)->paginate(10);
        $total  =   Complain::count();

        return view('user.dashboard', compact('lists','total'));
    }
    
}
