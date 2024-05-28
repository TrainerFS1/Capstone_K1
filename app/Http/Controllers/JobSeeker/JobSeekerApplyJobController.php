<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\FileJobSeeker;
use App\Models\ApplyJob;
use Illuminate\Support\Facades\Validator;

class JobSeekerApplyJobController extends Controller
{
    public function applyJob(Request $request, $id)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'cv' => 'required_if:use_existing_files,null|file|mimes:pdf|max:2048',
            'certificate' => 'required_if:use_existing_files,null|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Get the job by ID
        $job = Job::findOrFail($id);

        // Get the authenticated user (job seeker)
        $user = Auth::user();

        // Check if user wants to use existing files
        if ($request->has('use_existing_files') && $request->input('use_existing_files')) {
            // Use existing files from database
            $fileJobSeeker = FileJobSeeker::where('job_seeker_id', $user->jobSeeker->id)->firstOrFail();
            $cvPath = $fileJobSeeker->cv;
            $certificatePath = $fileJobSeeker->certificate;
        } else {
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

            // Save or update FileJobSeeker entry
            $fileJobSeeker = FileJobSeeker::UpdateorCreate(
                ['job_seeker_id' => $user->jobSeeker->id],
                ['cv' => $cvPath, 'certificate' => $certificatePath]
            );
        }

        // Create ApplyJob entry
        ApplyJob::create([
            'job_id' => $job->id,
            'job_seeker_id' => $user->jobSeeker->id,
            'status' => 'inprogress',
        ]);

        return back()->with('success', 'Job application submitted successfully.');
    }
}
