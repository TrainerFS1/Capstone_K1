<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\SavedJob;
use App\Models\JobSeeker;


class SaveJobsController extends Controller
{
    // Method to save a job to saved jobs list
    public function saveJob(Request $request, $id)
    {
        // Get job by ID
        $job = Job::findOrFail($id);

        // Get authenticated user (job seeker)
        $user = Auth::user();
        $jobSeeker = $user->jobSeeker;

        // Check if job is already saved
        $alreadySaved = SavedJob::where('job_id', $job->id)
            ->where('job_seeker_id', $jobSeeker->id)
            ->exists();

        if ($alreadySaved) {
            // Job already saved, delete it (unsave)
            SavedJob::where('job_id', $job->id)
                ->where('job_seeker_id', $jobSeeker->id)
                ->delete();
            return back()->with('success', 'Pekerjaan berhasil dihapus dari simpan.');
        }

        // Save job to saved jobs list
        SavedJob::create([
            'job_id' => $job->id,
            'job_seeker_id' => $jobSeeker->id,
        ]);

        return back()->with('success', 'Pekerjaan berhasil disimpan.');
    }

    // Method to display saved jobs
    public function savedJobs()
    {
        $user = Auth::user();
        $jobSeeker = JobSeeker::where('user_id', Auth::id())->first();

        $savedJobs = SavedJob::where('job_seeker_id', $user->jobSeeker->id)
            ->with('job.company') // Eager load the job and company relation
            ->get();
    
        return view('jobseeker.savedjobs.saved_jobs', compact('savedJobs','jobSeeker'));
    }
    



    public function deleteSavedJob(SavedJob $savedJob)
    {
        $savedJob->delete();

        return back()->with('success', 'Pekerjaan berhasil dihapus dari simpan.');
    }
}
