<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\JobSeeker;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()) {
            $user = Auth::user();
            $jobSeeker = JobSeeker::where('user_id', $user->id)->first();
            return view('index', compact('jobSeeker'));
        }
        return view('index');
    }
}
