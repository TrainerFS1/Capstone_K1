<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobSeeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KelJobSeekerController extends Controller
{
    /**
     * Menampilkan daftar jobseeker untuk dikelola oleh admin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $jobseekers = JobSeeker::latest()->paginate(10);
        return view('admin.datajobseeker.jobseekerlist', compact('user','jobseekers'));
    }


    public function show(JobSeeker $jobseeker)
    {
        $user = Auth::user();
        return view('admin.datajobseeker.jobseekershow', compact('user','jobseeker'));
    }
}
