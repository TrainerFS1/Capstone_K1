<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            switch ($user->user_type) {
                case 'admin':
                    return redirect('/admin/dashboard');
                case 'company':
                    return redirect('/company/dashboard');
                case 'job_seeker':
                    return redirect('/');
                default:
                    return redirect('/');
            }
        }

        return $next($request);
    }
}
