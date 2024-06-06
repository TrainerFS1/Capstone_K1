<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use App\Models\Job;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class KelJobController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Mengambil informasi user yang sedang login
        $jobs = Job::with('company', 'category')->get();
        return view('admin.datajobs.joblisting', compact('jobs', 'user'));
    }

    public function ShowdetailJobAdmin($id)
    {
                
 
        $user = User::where('id', Auth::id())->firstOrFail();
        $job = Job::with(['company', 'category', 'jobType'])->findOrFail($id);
        return view('admin.datajobs.jobdetail', compact('job', 'user'));
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('admin.joblisting')->with('success', 'Pekerjaan berhasil dihapus');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'job_status' => 'required|in:active,inactive',
        ]);

        $job = Job::findOrFail($id);
        $job->job_status = $request->job_status;
        $job->save();

        return redirect()->route('admin.joblisting')->with('success', 'Status pekerjaan berhasil diperbarui');
    }
}
