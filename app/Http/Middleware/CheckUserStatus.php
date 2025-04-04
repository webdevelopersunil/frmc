<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if user exists and is inactive
        if ($user && $user->status === 'inactive') {
            Auth::logout(); // Log the user out
            return redirect()->route('login')->withErrors(['email' => 'Your account is inactive. Please contact support.']);
        }

        return $next($request);
    }
}
