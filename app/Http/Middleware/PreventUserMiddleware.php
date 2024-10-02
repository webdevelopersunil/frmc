<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Complain;

class PreventUserMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * 
     */
    public function handle(Request $request, Closure $next, $role): Response{

        $routeParams    =   $request->route()->parameters();

        if($role == 'nodal'){

            $complain       =   Complain::find($routeParams['list_id']);

            if($complain && $complain->complaint_status_id == 1 || $complain->complaint_status_id == 2 ){

                return $next($request);
            }else{

                return redirect()->back()->with('error', 'Complaint under review with FCO Officer. Please try again later.');
            }

        }else if($role == 'user'){

            $complain       =   Complain::find($routeParams['id']);
            
            if ($complain && !in_array($complain->complaint_status_id, [5, 6, 7])) {

                return $next($request);
            }else{

                return redirect()->back()->with('error', 'Complaint restricted from being edited.');
            }

        }else if($role == 'fco'){

            $complain       =   Complain::find($routeParams['list_id']);

            if($complain && $complain->complaint_status_id != 2){
                return $next($request);
            }else{
                return redirect()->back()->with('error', 'Complaint under progress. Please try again later.');
            }
        }
        
    }
    // $role $routeName = Route::currentRouteName(); $currentRoute = Route::current(); $user = $request->user(); $roles = $user ? $user->getRoleNames() : [];
}
