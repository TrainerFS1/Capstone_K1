<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\JobSeeker;
use App\Models\Job;
use App\Models\ApplyJob;
use App\Models\Admin; // Import model Admin
use App\Models\User; // Import model User

class AdminController extends Controller
{
    public function index()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();
        
        // Memastikan bahwa user yang login adalah seorang admin
        if (!$user || $user->user_type !== 'admin') {
            return redirect()->route('login'); // Ganti route login dengan route yang sesuai
        }

        // Mengambil data admin berdasarkan user_id
        $admin = Admin::where('user_id', $user->id)->first();

        // Mengambil jumlah data dari masing-masing model
        $totalCompanies = Company::count();
        $totalJobSeekers = JobSeeker::count();
        $totalJobListings = Job::count();
        $totalApplications = ApplyJob::count();
        $newJobListings = Job::whereDate('created_at', '>', now()->subDays(7))->count();

        return view('admin.dashboard', [
            'totalCompanies' => $totalCompanies,
            'totalJobSeekers' => $totalJobSeekers,
            'totalJobListings' => $totalJobListings,
            'totalApplications' => $totalApplications,
            'newJobListings' => $newJobListings,
            'admin' => $admin,
            'user' => $user,
        ]);
    }
}
