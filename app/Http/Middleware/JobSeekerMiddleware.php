<?php
// app/Http/Middleware/JobSeekerMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobSeekerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type === 'job_seeker') {
            return $next($request);
        }

        return redirect('/jobseeker')->with('error', 'You are not authorized to access this page.');
    }
}
