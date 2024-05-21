<?php
// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginFormAdmin()
    {
        return view('admin.login');
    }
    public function showLoginFormCompany()
    {
        return view('company.login');
    }
    public function showLoginFormJobSeeker()
    {
        return view('jobseeker.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->user_type === 'admin') {
                return redirect()->intended('admin/dashboard');
            } elseif ($user->user_type === 'company') {
                return redirect()->intended('/company/dashboard');
            } elseif ($user->user_type === 'job_seeker') {
                return redirect()->route('front');
            }
        }

        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
