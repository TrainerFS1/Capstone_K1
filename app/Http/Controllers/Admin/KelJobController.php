<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelJobController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Mengambil informasi user yang sedang login
        $jobs = Job::with('company', 'category')->get();
        return view('admin.joblisting.joblisting', compact('jobs', 'user'));
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('admin.joblisting.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'job_title' => 'required',
            'category_id' => 'required',
            'job_description' => 'nullable',
            'job_location' => 'nullable',
            'job_skills' => 'nullable',
            'job_type_id' => 'required',
            'job_status' => 'required|in:active,inactive',
        ]);

        $job = Job::findOrFail($id);
        $job->update($request->all());

        return redirect()->route('admin.joblisting')->with('success', 'Pekerjaan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('admin.joblisting')->with('success', 'Pekerjaan berhasil dihapus');
    }
}
