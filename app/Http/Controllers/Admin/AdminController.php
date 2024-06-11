<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\JobSeeker;
use App\Models\Job;
use App\Models\ApplyJob;
use App\Models\Admin;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || $user->user_type !== 'admin') {
            return redirect()->route('login');
        }

        $admin = Admin::where('user_id', $user->id)->first();

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
