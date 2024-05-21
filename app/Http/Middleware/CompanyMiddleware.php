<?php

// app/Http/Middleware/CompanyMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type === 'company') {
            return $next($request);
        }

        return redirect('/company')->with('error', 'You are not authorized to access this page.');
    }
}
