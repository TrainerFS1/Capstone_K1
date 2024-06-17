<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\FileJobSeeker;
use App\Models\ApplyJob;
use App\Models\JobSeeker;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;

class JobSeekerApplyJobController extends Controller
{
    public function applyJob(Request $request, $id)
    {
        $user = Auth::user();
        $jobSeekerId = $user->jobSeeker->id;
    
        // Check if there's any file uploaded in file_job_seekers table for the job seeker
        $fileExists = FileJobSeeker::where('job_seeker_id', $jobSeekerId)->exists();
    
        // If "use existing files" is checked but no primary file exists, return an error message
        if ($request->has('use_existing_files') && $request->input('use_existing_files')) {
            $primaryFileExists = FileJobSeeker::where('job_seeker_id', $jobSeekerId)
                ->where('file_type', 'primary')
                ->exists();
    
            if (!$primaryFileExists) {
                return back()->with('error', 'Silakan upload file utama Anda pada menu data diri.');
            }
        } else {
            // If no file exists and no new file is uploaded, return an error message
            if (!$fileExists && !$request->hasFile('cv') && !$request->hasFile('certificate')) {
                return back()->with('error', 'Tidak ada file yang diunggah, mohon upload file.');
            }
        }
    
        $validator = Validator::make($request->all(), [
            'cv' => 'required_if:use_existing_files,null|file|mimes:pdf|max:2048',
            'certificate' => 'required_if:use_existing_files,null|file|mimes:pdf|max:2048',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $job = Job::findOrFail($id);
        $alreadyApplied = ApplyJob::where('job_id', $job->id)
            ->where('job_seeker_id', $jobSeekerId)
            ->exists();
    
        if ($alreadyApplied) {
            return back()->with('error', 'Anda sudah melamar pekerjaan ini.');
        }
    
        $fileJobSeeker = null;
    
        if ($request->has('use_existing_files') && $request->input('use_existing_files')) {
            $fileJobSeeker = FileJobSeeker::where('job_seeker_id', $jobSeekerId)
                ->where('file_type', 'primary')
                ->firstOrFail();
        } else {
            if ($request->hasFile('cv')) {
                $cvFile = $request->file('cv');
                $cvName = 'cv_' . time() . '.' . $cvFile->getClientOriginalExtension();
                $cvPath = $cvFile->storeAs('cv', $cvName, 'public');
            } else {
                return back()->with('error', 'File CV diperlukan.');
            }
    
            if ($request->hasFile('certificate')) {
                $certificateFile = $request->file('certificate');
                $certificateName = 'certificate_' . time() . '.' . $certificateFile->getClientOriginalExtension();
                $certificatePath = $certificateFile->storeAs('certificates', $certificateName, 'public');
            } else {
                return back()->with('error', 'File sertifikat diperlukan.');
            }
    
            $fileJobSeeker = FileJobSeeker::create([
                'job_seeker_id' => $jobSeekerId,
                'cv' => $cvPath,
                'certificate' => $certificatePath,
                'file_type' => 'secondary',
            ]);
        }
    
        ApplyJob::create([
            'job_id' => $job->id,
            'job_seeker_id' => $jobSeekerId,
            'file_jobseeker_id' => $fileJobSeeker->id,
            'status' => 'inprogress',
        ]);
    
        return back()->with('success', 'Lamaran pekerjaan berhasil diajukan.')
            ->with('alreadyApplied', $alreadyApplied);
    }
    

    public function history()
    {
        // Mendapatkan job seeker berdasarkan user ID yang sedang login
        $jobSeeker = JobSeeker::where('user_id', Auth::id())->first();

        // Mendapatkan applied jobs termasuk yang dihapus (soft delete) dan relasi dengan job
        $appliedJobs = ApplyJob::where('job_seeker_id', $jobSeeker->id)
            ->withTrashed()
            ->with(['job' => function ($query) {
                $query->withTrashed(); // Memasukkan job yang dihapus (soft delete)
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Mengubah status menjadi 'job_deleted' jika job sudah di-soft delete
        foreach ($appliedJobs as $appliedJob) {
            if ($appliedJob->job && $appliedJob->job->trashed()) {
                $appliedJob->status = 'job_deleted';
            }
        }

        // Mengembalikan view dengan data job seeker dan applied jobs
        return view('jobseeker.jobs.history', compact('jobSeeker', 'appliedJobs'));
    }
    
    public function jobDetail($id)
    {
        // Mengambil job termasuk yang sudah di-soft delete beserta relasinya
        $job = Job::withTrashed()->with(['jobType', 'category', 'company'])->findOrFail($id);

        // Mendapatkan job seeker berdasarkan user ID yang sedang login
        $jobSeeker = JobSeeker::where('user_id', Auth::id())->first();

        // Mendapatkan applied job berdasarkan job seeker dan job ID
        $appliedJob = ApplyJob::where('job_seeker_id', $jobSeeker->id)
            ->where('job_id', $id)
            ->first();

        // Jika job tidak pernah diaplikasikan oleh job seeker
        if (!$appliedJob) {
            return response()->json(['error' => 'Anda belum melamar pekerjaan ini.'], 404);
        }

        // Menambahkan status job deleted jika job sudah di-soft delete
        if ($job->trashed()) {
            $appliedJob->status = 'job_deleted';
        }

        // Mengembalikan view dengan data job dan applied job
        return view('jobseeker.jobs.partials.detailhistory', compact('job', 'appliedJob'));
    }
}
