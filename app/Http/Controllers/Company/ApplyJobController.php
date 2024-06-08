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
    public function showDetailModal(Request $request, $id, $jobId)
    {
        // cek apakah company id yang ada di table jobs sesuai dengan id company yang sedang login
        $company = Company::where('user_id', Auth::id())->firstOrFail();
        $job = Job::where('id', $jobId)
        ->where('company_id', $company->id)
        ->first();
        if (!$job) {
            // Job tidak ditemukan dan company_id tidak sesuai
            return response()->json(['message' => 'Job ID tidak valid'], 404);
        }

        $jobseeker = JobSeeker::find($id);

        if (!$jobseeker) {
            return response()->json(['message' => 'JobSeeker /ApplyJob not found'], 404);
        }

        $applyJob = ApplyJob::where('job_seeker_id', $id)->where('job_id', $jobId)->first();
        $idfile = $applyJob->file_jobseeker_id;
        $fileJobseeker = FileJobSeeker::find($idfile);
        $cv = $fileJobseeker->cv;
        $certificate = $fileJobseeker->certificate;

        // Mengembalikan detail jobseeker dalam format JSON
        return response()->json([
            'profile_picture' => $jobseeker->profile_picture, // Asumsikan ada atribut profile_picture
            'job_seeker_name' => $jobseeker->job_seeker_name, // Asumsikan ada atribut name
            'job_seeker_address' => $jobseeker->job_seeker_address, // Asumsikan ada atribut address
            'job_seeker_phone' => $jobseeker->job_seeker_phone, // Asumsikan ada atribut phone
            'job_seeker_resume' => $jobseeker->job_seeker_resume, // Asumsikan ada atribut resume
            // 'id_file' => $idFile,
            'job_seeker_cv' => $cv, // Asumsikan ada atribut CV
            'job_seeker_certificate' => $certificate, // Asumsikan ada atribut Certificate
        ]);
    }

    public function showCv($id)
    {
        $file = FileJobSeeker::find($id);
        $cv = $file->cv;

        return view('company.jobapply.previewPdf', compact('cv'));

    }
}
