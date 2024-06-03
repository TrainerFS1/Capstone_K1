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
use App\Models\ApplyJob;
use App\Models\JobType;
use Illuminate\Support\Facades\Hash;
use App\Models\Industry;

class CompanyController extends Controller
{
    // Registration
    public function showRegistrationForm()
    {
        $industries = Industry::all();
        return view('company.register', compact('industries'));

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
            'company_name' => $request->name,
            'company_address' => $request->company_address,
            'company_website' => $request->company_website,
            'company_phone' => $request->company_phone,
            'industry_id' => $request->industry_id,
        ]);

        // Redirect ke halaman login perusahaan dengan pesan sukses
        return redirect()->route('loginCompany')->with('success', 'Company registered successfully. Please login.');
    }

    // Show Profile
    public function showProfile()
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
        return view('company.profile', compact('company', 'user'));
    }

    // Edit Profile
    public function editProfile()
    {
        // Mengambil data perusahaan yang sedang login
        $company = Company::where('user_id', Auth::id())->first();
        $user = User::where('id', Auth::id())->firstOrFail();

        // Jika tidak ada data perusahaan, buat data default atau biarkan sebagai null
        if (!$company) {
            $company = new Company();
            $company->user_id = Auth::id();
        }

        // Mengirim data perusahaan ke view 'company.editprofile'
        return view('company.editprofile', compact('company', 'user'));
    }

    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_phone' => 'required|string|max:255',
            'company_address' => 'nullable|string|max:255',
            'company_website' => 'nullable|string|max:255',
            'company_description' => 'nullable|string',
        ]);

        // Ambil perusahaan berdasarkan user_id dari pengguna yang sedang login
        $company = Company::where('user_id', Auth::id())->firstOrFail();

        // Update data perusahaan
        $company->company_name = $request->company_name;
        $company->company_phone = $request->company_phone;
        $company->company_address = $request->company_address;
        $company->company_website = $request->company_website;
        $company->company_description = $request->company_description;
        $company->save();

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('company.profile')->with('success', 'Profile updated successfully.');
    }

    // Dashboard
    public function showDashboard()
    {
        // Ambil perusahaan berdasarkan user_id dari pengguna yang sedang login
        $company = Company::where('user_id', Auth::id())->first();
        $user = User::where('id', Auth::id())->firstOrFail();
        $jobCategories = Category::all();
        $jobTypes = JobType::all();
        // Jika tidak ada data perusahaan, buat data default atau biarkan sebagai null
        if (!$company) {
            $company = new Company(); // Atau Anda bisa membuat data default
            $company->user_id = Auth::id();
            $company->company_name = 'Company';
            $company->company_logo = 'Company';
            // Set properti lainnya sesuai kebutuhan
        }
        //jumlah pekerjaan yang masuk
        $totalApplyJobs = $company->jobs->flatMap(function ($job) {
            return $job->applyJobs;
        })->count();

        // Lamaran yang diterima berdasarkan status
        $acceptedApplyJobs = $company->jobs->flatMap(function ($job) {
            return $job->applyJobs->where('status', 'accepted');
        })->count();

        // Lamaran yang ditolak berdasarkan status
        $rejectedApplyJobs = $company->jobs->flatMap(function ($job) {
            return $job->applyJobs->where('status', 'rejected');
        })->count();
        $inprogressApplyJobs = $company->jobs->flatMap(function ($job) {
            return $job->applyJobs->where('status', 'inprogress');
        })->count();

        $activeJobs = $company->jobs->where('job_status', 'active')->count();
        $inactiveJobs = $company->jobs->where('job_status', 'inactive')->count();

        // 10 data lamaran terbaru
        $recentApplyJobs = $company->jobs->flatMap(function ($job) {
            return $job->applyJobs;
        })->sortByDesc('created_at')->take(10);

        // Kirim data perusahaan ke tampilan 'company.dashboard'
        return view('company.dashboard', compact('company', 'user','jobCategories','jobTypes', 'totalApplyJobs', 'acceptedApplyJobs', 'rejectedApplyJobs','inprogressApplyJobs', 'recentApplyJobs','activeJobs','inactiveJobs'));
    }

    //chart
    public function getApplyJobData()
    {
        // Ambil company yang terkait dengan user yang sedang login
        $company = Company::where('user_id', Auth::id())->first();
        
        if (!$company) {
            return response()->json([
                'dates' => [],
                'apply_job_data' => []
            ]);
        }

        // Ambil job yang terkait dengan company tersebut
        $jobIds = Job::where('company_id', $company->id)->pluck('id');

        // Ambil data aplikasi pekerjaan yang terkait dengan job-job tersebut
        $data = ApplyJob::whereIn('job_id', $jobIds)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
        
        // Siapkan format data untuk chart
        $dates = $data->pluck('date')->toArray();
        $applyJobData = $data->pluck('count')->toArray();

        return response()->json([
            'dates' => $dates,
            'apply_job_data' => $applyJobData
        ]);
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
        $job->job_status = 'active'; // Atau logika lain untuk status
        $job->save();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('company.jobs')->with('success', 'Job has been created successfully.');
    }
}
