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
