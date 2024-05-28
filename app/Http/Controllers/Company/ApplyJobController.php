<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Job;
use App\Models\FileJobSeeker;
use App\Models\ApplyJob;
use Illuminate\Support\Facades\Validator;

class ApplyJobController extends Controller
{
    public function applyJob(Request $request, $id)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [

            'cv' => 'required|file|mimes:pdf|max:2048',
            'certificate' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Get the job by ID
        $job = Job::findOrFail($id);

        // Get the authenticated user (job seeker)
        $user = Auth::user();

        // Handle CV upload
        if ($request->hasFile('cv')) {
            $cvFile = $request->file('cv');
            $cvName = 'cv_' . time() . '.' . $cvFile->getClientOriginalExtension();
            $cvPath = $cvFile->storeAs('cv', $cvName, 'public');

        } else {
            return back()->with('error', 'CV file is required.');
        }

        // Handle certificate upload
        if ($request->hasFile('certificate')) {
            $certificateFile = $request->file('certificate');
            $certificateName = 'certificate_' . time() . '.' . $certificateFile->getClientOriginalExtension();
            $certificatePath = $certificateFile->storeAs('certificates', $certificateName, 'public');
        } else {
            return back()->with('error', 'Certificate file is required.');
        }

        // Create or update FileJobSeeker entry
        $fileJobSeeker = FileJobSeeker::create([
            'job_seeker_id' => $user->jobSeeker->id,
            'cv' => $cvPath,
            'certificate' => $certificatePath,
        ]);

        // Create ApplyJob entry
        ApplyJob::create([
            'job_id' => $job->id,
            'job_seeker_id' => $user->jobSeeker->id,
            'category_name'=>'terserah',
            'status' => 'inprogress', 
        ]);

        return back()->with('success', 'Job application submitted successfully.');
    }

    public function showLamaranMasuk(Request $request)
    {
        // Ambil perusahaan berdasarkan user_id dari pengguna yang sedang login
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->with('jobs.applyJobs')->firstOrFail();

        return view('company.jobapply.jobapply', compact('company', 'user'));
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
}
