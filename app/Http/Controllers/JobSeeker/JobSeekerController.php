<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobSeeker;

class JobSeekerController extends Controller
{
    //
    public function showProfile()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil data job seeker berdasarkan user_id
        $jobSeeker = JobSeeker::where('user_id', $user->id)->first();

        // Kirim data ke view
        return view('jobseeker.profile', compact('jobSeeker'));
    }
}
