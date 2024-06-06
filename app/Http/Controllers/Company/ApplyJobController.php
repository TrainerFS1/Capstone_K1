<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Category;
use App\Models\JobType;
use App\Models\Job;
use App\Models\FileJobSeeker;
use App\Models\ApplyJob;
use App\Models\JobSeeker;
use Illuminate\Support\Facades\Validator;

class ApplyJobController extends Controller
{


    public function showLamaranMasuk(Request $request)
    {
        // Ambil perusahaan berdasarkan user_id dari pengguna yang sedang login
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->with('jobs.applyJobs')->firstOrFail();
        $jobCategories = Category::all();
        $jobTypes = JobType::all();

        return view('company.jobapply.jobapply', compact('company', 'user', 'jobCategories', 'jobTypes'));
    }
    public function rejectLamaran($id)
    {
        $applyJob = ApplyJob::find($id);

        if (!$applyJob) {
            return response()->json(['message' => 'Application not found'], 404);
        }

        // Lakukan aksi penolakan, misalnya mengupdate status
        $applyJob->status = 'rejected';
        $applyJob->save();

        return response()->json(['message' => 'Application rejected successfully']);
    }
    public function acceptLamaran($id)
    {
        $applyJob = ApplyJob::find($id);

        if (!$applyJob) {
            return response()->json(['message' => 'Application not found'], 404);
        }

        // Lakukan aksi penolakan, misalnya mengupdate status
        $applyJob->status = 'accepted';
        $applyJob->save();

        return response()->json(['message' => 'Application Accepted successfully']);
    }
    public function showDetailModal($id)
{
    $jobseeker = JobSeeker::find($id);

    if (!$jobseeker) {
        return response()->json(['message' => 'JobSeeker not found'], 404);
    }

    // Mengembalikan detail jobseeker dalam format JSON
    return response()->json([
        'profile_picture' => $jobseeker->profile_picture, // Asumsikan ada atribut profile_picture
        'job_seeker_name' => $jobseeker->job_seeker_name, // Asumsikan ada atribut name
        'job_seeker_address' => $jobseeker->job_seeker_address, // Asumsikan ada atribut address
        'job_seeker_phone' => $jobseeker->job_seeker_phone, // Asumsikan ada atribut phone
        'job_seeker_resume' => $jobseeker->job_seeker_resume, // Asumsikan ada atribut resume
    ]);
}




    public function showDetail($id)
    {
        $user = Auth::user();
        $company = Company::where('user_id', Auth::id())->first();
        $jobseeker = JobSeeker::find($id);

        if (!$jobseeker) {
            return redirect(route('company.lamaranmasuk'));
        }
        return view('company.jobapply.detailapply', compact('company', 'user', 'jobseeker'));
    }
}
