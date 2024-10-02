<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle($request, Closure $next){

        $maxInactiveTime    = config('session.lifetime') * 60; // 10 minutes in seconds
        $loginTime          = session('login_time');

        if (Auth::check()) {
            $lastActivity = session('lastActivityTime');
            
            $currentTime = time();

            // echo $lastActivity.'-'.$currentTime - $lastActivity.'>'.$maxInactiveTime;

            // echo "<pre>"; print_r(session()->all());
            if ($lastActivity && ($currentTime - $lastActivity) > $maxInactiveTime) {
                Auth::logout();
                session()->flush();
                return redirect()->route('login')->with('warning', 'You have been logged out due to inactivity.');
            }

            session(['lastActivityTime' => $currentTime]);
        }

        return $next($request);
    }

    public function handle_old($request, Closure $next) {

        if (auth()->check()) {
            $loginTime = session('login_time');
            
            // Check if the session has expired
            if ($loginTime && now()->diffInMinutes($loginTime) > config('session.lifetime')) {
                auth()->logout();
                return redirect()->route('login')->with('message', 'You have been logged out due to inactivity.');
            }

            // Update the last activity time in the session
            session(['lastActivityTime' => now()]);
        }

        return $next($request);
    }

}
