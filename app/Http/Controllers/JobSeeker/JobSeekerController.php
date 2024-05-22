<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobSeeker;

class JobSeekerController extends Controller
{
    public function showProfile()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil data job seeker berdasarkan user_id
        $jobSeeker = JobSeeker::where('user_id', $user->id)->first();

        // Kirim data ke view
        return view('jobseeker.profile', compact('jobSeeker'));
    }

    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'job_seeker_name' => 'required|string|max:255',
            'job_seeker_phone' => 'nullable|string|max:255',
            'job_seeker_address' => 'nullable|string|max:255',
            'job_seeker_resume' => 'nullable|string',
        ]);
    
        // Ambil data job seeker berdasarkan user_id
        $jobSeeker = JobSeeker::where('user_id', Auth::id())->first();
    
        // Perbarui data job seeker
        $jobSeeker->job_seeker_name = $request->job_seeker_name;
        $jobSeeker->job_seeker_phone = $request->job_seeker_phone;
        $jobSeeker->job_seeker_address = $request->job_seeker_address;
        $jobSeeker->job_seeker_resume = $request->job_seeker_resume;
        $jobSeeker->save();
    
        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('jobseeker.profile')->with('success', 'Profile updated successfully.');
    }
    
    
}
