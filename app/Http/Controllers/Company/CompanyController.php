<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Job;
use App\Models\User;





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
        $jobs = Job::where('user_id', Auth::id())->get();

        // Kirim data perusahaan ke tampilan 'company.profile'
        return view('company.joblisting', compact('company', 'user', 'jobs'));
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
    // public function showtambahlowongan()
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
    //     $jobCategories = JobCategory::all();
    //     $jobTypes = JobType::all();

    //     // Kirim data perusahaan ke tampilan 'company.profile'
    //     return view('company.tambahlowongan', compact('company', 'user', 'jobCategories', 'jobTypes'));
    // }
    // Edit

    // Hapus
    // Create
    // public function tambahlowongan(Request $request)
    // {
    //     // Validasi data yang diterima dari form
    //     $request->validate([
    //         'job_category_id' => 'required|exists:job_categorys,id',
    //         'job_type_id' => 'required|exists:job_types,id',
    //         'job_benefit' => 'nullable|string',
    //         'job_requirement' => 'nullable|string',
    //         'job_description' => 'nullable|string',
    //         'job_title' => 'nullable|string',
    //         'salary_range' => 'nullable|string',
    //     ]);

    //     // Simpan data ke database
    //     $jobListing = new JobListing();
    //     $jobListing->user_id = Auth::id();
    //     $jobListing->job_category_id = $request->input('job_category_id');
    //     $jobListing->job_type_id = $request->input('job_type_id');
    //     $jobListing->job_benefit = $request->input('job_benefit');
    //     $jobListing->job_requirement = $request->input('job_requirement');
    //     $jobListing->job_description = $request->input('job_description');
    //     $jobListing->job_title = $request->input('job_title');
    //     $jobListing->salary_range = $request->input('salary_range');
    //     $jobListing->save();

    //     // Redirect kembali ke halaman form dengan pesan sukses
    //     return redirect()->route('company.listlowongan')->with('success', 'Job listing created successfully.');
    // }
}
