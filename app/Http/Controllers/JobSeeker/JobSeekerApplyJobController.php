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
        // Validasi request yang masuk
        $validator = Validator::make($request->all(), [
            'cv' => 'required_if:use_existing_files,null|file|mimes:pdf|max:2048',
            'certificate' => 'required_if:use_existing_files,null|file|mimes:pdf|max:2048',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Dapatkan pekerjaan berdasarkan ID
        $job = Job::findOrFail($id);
    
        // Dapatkan pengguna yang terautentikasi (pelamar pekerjaan)
        $user = Auth::user();
    
        // Periksa apakah pelamar pekerjaan sudah melamar pekerjaan ini sebelumnya
        $alreadyApplied = ApplyJob::where('job_id', $job->id)
            ->where('job_seeker_id', $user->jobSeeker->id)
            ->exists();
    
        if ($alreadyApplied) {
            return back()->with('error', 'Anda sudah melamar pekerjaan ini.');
        }
    
        // Inisialisasi variabel fileJobSeeker
        $fileJobSeeker = null;
    
        // Periksa apakah pengguna ingin menggunakan file yang sudah ada
        if ($request->has('use_existing_files') && $request->input('use_existing_files')) {
            // Gunakan file yang sudah ada dari database
            $fileJobSeeker = FileJobSeeker::where('job_seeker_id', $user->jobSeeker->id)
                ->where('file_type', 'primary')
                ->firstOrFail();
        } else {
            // Handle unggah CV
            if ($request->hasFile('cv')) {
                $cvFile = $request->file('cv');
                $cvName = 'cv_' . time() . '.' . $cvFile->getClientOriginalExtension();
                $cvPath = $cvFile->storeAs('cv', $cvName, 'public');
            } else {
                return back()->with('error', 'File CV diperlukan.');
            }
    
            // Handle unggah sertifikat
            if ($request->hasFile('certificate')) {
                $certificateFile = $request->file('certificate');
                $certificateName = 'certificate_' . time() . '.' . $certificateFile->getClientOriginalExtension();
                $certificatePath = $certificateFile->storeAs('certificates', $certificateName, 'public');
            } else {
                return back()->with('error', 'File sertifikat diperlukan.');
            }
    
            // Simpan entri FileJobSeeker baru dengan tipe 'secondary'
            $fileJobSeeker = FileJobSeeker::Create([
                'job_seeker_id' => $user->jobSeeker->id,
                'cv' => $cvPath,
                'certificate' => $certificatePath,
                'file_type' => 'secondary',
            ]);
        }
    
        // Buat entri ApplyJob
        ApplyJob::create([
            'job_id' => $job->id,
            'job_seeker_id' => $user->jobSeeker->id,
            'file_jobseeker_id' => $fileJobSeeker->id,
            'status' => 'inprogress',
        ]);
    
        // Teruskan $alreadyApplied ke view
        return back()->with('success', 'Lamaran pekerjaan berhasil diajukan.')
                     ->with('alreadyApplied', $alreadyApplied);
    }
    
    public function history()
    {
        // Get the logged in job seeker
        $jobSeeker = JobSeeker::where('user_id', Auth::id())->first();
        
        // Fetch the job applications for the logged in job seeker
        $appliedJobs = ApplyJob::where('job_seeker_id', $jobSeeker->id)
                               ->with('job')
                               ->orderBy('created_at', 'desc')
                               ->paginate(10);
    
        return view('jobseeker.jobs.history', compact('jobSeeker', 'appliedJobs'));
    }
}
