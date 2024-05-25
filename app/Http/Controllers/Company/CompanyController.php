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
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    //
    // Registration
    public function showRegistrationForm()
    {
        return view('company.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Hanya cek unik di tabel users
            'password' => [
                'required',
                'string',
                'min:5',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
        ], [
            'password.min' => 'Password must be at least 5 characters.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
        ]);
    
        // Simpan data user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'company',
        ]);
    
        // Simpan data perusahaan
        $company = Company::create([
            'user_id' => $user->id,
            'company_name' => $request->name, // Nama perusahaan diisi sesuai input nama
            // Kolom lain yang ingin Anda tambahkan
        ]);
    
        // Redirect ke halaman login perusahaan dengan pesan sukses
        return redirect()->route('loginCompany')->with('success', 'Company registered successfully. Please login.');
    }
    

    // Dashboard
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

    // Job Listings
    public function showJobs(Request $request)
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
        $search = $request->input('search');
        $query = Job::where('company_id', $company->id);

        if ($search) {
            $query->where('job_title', 'LIKE', "%{$search}%")
                ->orWhere('job_description', 'LIKE', "%{$search}%")
                ->orWhere('job_location', 'LIKE', "%{$search}%")
                ->orWhere('job_skills', 'LIKE', "%{$search}%")
                ->orWhere('job_salary', 'LIKE', "%{$search}%");
        }

        $jobs = $query->paginate(10);

        // Menambahkan parameter pencarian pada pagination links
        if ($search) {
            $jobs->appends(['search' => $search]);
        }

        // Kirim data perusahaan ke tampilan 'company.joblisting'
        return view('company.joblisting', compact('company', 'user', 'jobs'));
    }

    // Edit Job
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

    // Show Add Job Form
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

    // Update Job
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

    // Delete Job
    public function deleteJob($id)
    {
        // Cari job berdasarkan ID
        $job = Job::findOrFail($id);

        // Hapus job
        $job->delete();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('company.jobs')->with('success', 'Job has been deleted successfully.');
    }

    // Create Job
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
        $company = Company::where('user_id', Auth::id())->firstOrFail();
        $job = new Job();
        $job->company_id = $company->id;
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
