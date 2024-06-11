<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobSeeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelJobSeekerController extends Controller
{
    /**
     * Menampilkan daftar jobseeker untuk dikelola oleh admin.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Menerima input pencarian
        $search = $request->input('search');
        
        // Mengambil data jobseeker dengan pencarian dan paginasi
        $jobseekers = JobSeeker::with('user')
                                ->when($search, function($query, $search) {
                                    return $query->where('job_seeker_name', 'like', "%{$search}%")
                                                 ->orWhereHas('user', function($query) use ($search) {
                                                     $query->where('email', 'like', "%{$search}%");
                                                 });
                                })
                                ->latest()
                                ->paginate(10);
        
        return view('admin.datajobseeker.jobseekerlist', compact('user', 'jobseekers', 'search'));
    }

    public function getJobSeekerDetails(JobSeeker $jobseeker)
    {
        return view('admin.datajobseeker.partials.jobseekerdetails', compact('jobseeker'));
    }
}
