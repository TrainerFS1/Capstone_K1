<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use App\Models\Category;
use App\Models\JobType;
use Illuminate\Auth\Events\Validated;

class CompanyController extends Controller
{
    //
    //SHOW
    public function showDashboard()
    {
        // Ambil perusahaan berdasarkan user_id dari pengguna yang sedang login
        $company = Company::where('user_id', Auth::id())->first();
        $user = User::where('id', Auth::id())->firstOrFail();

        // Jika tidak ada data perusahaan, buat data default atau biarkan sebagai null
        if (!$company) {
            $company = new Company(); // Atau Anda bisa membuat data default
            $company->user_id = Auth::id();
            $company->company_name = 'Company';
            $company->company_logo = 'Company';
            // Set properti lainnya sesuai kebutuhan
        }

        // Kirim data perusahaan ke tampilan 'company.profile'
        return view('company.dashboard', compact('company', 'user'));
    }
    public function showJobs()
    {
        // Ambil perusahaan berdasarkan user_id dari pengguna yang sedang login
        $company = Company::where('user_id', Auth::id())->first();
        $user = User::where('id', Auth::id())->firstOrFail();
        if (!$company) {
            $company = new Company(); // Atau Anda bisa membuat data default
            $company->user_id = Auth::id();
            $company->company_name = 'Company';
            $company->company_logo = 'Company';
            // Set properti lainnya sesuai kebutuhan
        }
        $jobs = Job::where('company_id', $company->id)->get();

        // Kirim data perusahaan ke tampilan 'company.profile'
        return view('company.joblisting', compact('company', 'user', 'jobs'));
    }
    public function showEditJob($id)
    {
        $company = Company::where('user_id', Auth::id())->first();
        $user = User::where('id', Auth::id())->firstOrFail();
        if (!$company) {
            $company = new Company(); // Atau Anda bisa membuat data default
            $company->user_id = Auth::id();
            $company->company_name = 'Company';
            $company->company_logo = 'Company';
            // Set properti lainnya sesuai kebutuhan
        }
        // Cari job berdasarkan ID
        $job = Job::findOrFail($id);
        $jobCategories = Category::all();
        $jobTypes = JobType::all();


        // Tampilkan halaman edit dengan data yang diperlukan
        return view('company.editjob', compact('company', 'user', 'job', 'jobCategories', 'jobTypes'));
    }
    // public function showLamaranMasuk()
    // {
    //     // Ambil perusahaan berdasarkan user_id dari pengguna yang sedang login
    //     $company = Company::where('user_id', Auth::id())->first();
    //     $user = User::where('id', Auth::id())->firstOrFail();
    //     if (!$company) {
    //         $company = new Company(); // Atau Anda bisa membuat data default
    //         $company->user_id = Auth::id();
    //         $company->company_name = 'Company';
    //         $company->company_logo = 'Company';
    //         // Set properti lainnya sesuai kebutuhan
    //     }
    //     // Kirim data perusahaan ke tampilan 'company.profile'
    //     return view('company.lamaranmasuk', compact('company', 'user'));
    // }
    public function showAddJob()
    {
        // Ambil perusahaan berdasarkan user_id dari pengguna yang sedang login
        $company = Company::where('user_id', Auth::id())->first();
        $user = User::where('id', Auth::id())->firstOrFail();
        if (!$company) {
            $company = new Company(); // Atau Anda bisa membuat data default
            $company->user_id = Auth::id();
            $company->company_name = 'Company';
            $company->company_logo = 'Company';
            // Set properti lainnya sesuai kebutuhan
        }
        $jobCategories = Category::all();
        $jobTypes = JobType::all();

        // Kirim data perusahaan ke tampilan 'company.profile'
        return view('company.addjob', compact('company', 'user', 'jobCategories', 'jobTypes'));
    }
    // Edit
    public function updateStatus(Request $request, $id)
    {
        // Cari job berdasarkan ID
        $job = Job::findOrFail($id);

        // Periksa status yang diinginkan dari permintaan
        if ($job->job_status == 'active') {
            $job->job_status = 'inactive';
            $job->save();
        } elseif ($job->job_status == 'inactive') {
            $job->job_status = 'active';
            $job->save();
            // dd($job);
        }
        // Simpan perubahan

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('company.jobs')->with('success', 'Job has been updated successfully.');
    }
    public function updateJob(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'job_title' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'job_type_id' => 'required|integer',
            'job_location' => 'required|string|max:255',
            'job_salary' => 'required|string|max:255',
            'job_skills' => 'required|string',
            'job_description' => 'required|string',
        ]);

        $job = Job::findOrFail($id);
        // Update data job
        $job->job_title = $request->job_title;
        $job->category_id = $request->category_id;
        $job->job_type_id = $request->job_type_id;
        $job->job_location = $request->job_location;
        $job->job_salary = $request->job_salary;
        $job->job_skills = $request->job_skills;
        $job->job_description = $request->job_description;
        $job->save();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('company.jobs')->with('success', 'Job has been Edited successfully.');
    }

    // Hapus
    public function deleteJob($id)
    {
        // Cari job berdasarkan ID
        $job = Job::findOrFail($id);

        // Hapus job
        $job->delete();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('company.jobs')->with('success', 'Job has been deleted successfully.');
    }
    // Create
    public function addJob(Request $request)
    {
        // Validasi input
        $request->validate([
            'job_title' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'job_type_id' => 'required|integer',
            'job_location' => 'required|string|max:255',
            'job_salary' => 'required|string|max:255',
            'job_skills' => 'required|string',
            'job_description' => 'required|string',
        ]);

        // Buat job baru
        $id =   Company::where('user_id', Auth::id())->first();
        $job = new Job();
        $job->company_id = $id->id; // Atur sesuai dengan logika Anda untuk mendapatkan company_id
        $job->job_title = $request->job_title;
        $job->category_id = $request->category_id;
        $job->job_type_id = $request->job_type_id;
        $job->job_location = $request->job_location;
        $job->job_salary = $request->job_salary;
        $job->job_skills = $request->job_skills;
        $job->job_description = $request->job_description;
        $job->job_status = 'inactive'; // Atau logika lain untuk status
        $job->save();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('company.jobs')->with('success', 'The job has been created successfully. Please activate the status from show to jobseeker.');
    }
}
