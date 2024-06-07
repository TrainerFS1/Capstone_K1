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
use Illuminate\Support\Facades\Validator;
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
        $company = Company::where('user_id', Auth::id())->firstOrFail();
        $user = User::where('id', Auth::id())->firstOrFail();

        // Ambil data industries
        $industries = Industry::all();

        // Kirim data perusahaan ke tampilan 'company.profile'
        return view('company.profile', compact('company', 'user', 'industries'));
    }

    // Edit Profile
    public function editProfile()
    {
        // Mengambil data perusahaan yang sedang login
        $company = Company::where('user_id', Auth::id())->firstOrFail();
        $user = User::where('id', Auth::id())->firstOrFail();

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
            'industry_id' => 'nullable|int',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'email' => 'required|email',
        ]);

        // Ambil perusahaan berdasarkan user_id dari pengguna yang sedang login
        $company = Company::where('user_id', Auth::id())->firstOrFail();
        $user = User::where('id', Auth::id())->firstOrFail();

        // Update data perusahaan
        $company->company_name = $request->company_name;
        $company->company_phone = $request->company_phone;
        $company->company_address = $request->company_address;
        $company->company_website = $request->company_website;
        $company->company_description = $request->company_description;
        $company->industry_id = $request->industry_id;

        // Jika ada file logo yang di-upload, simpan dan update path logo
        if ($request->hasFile('company_logo')) {
            // Hapus logo lama jika ada
            if ($company->company_logo) {
                Storage::delete('public/company_logo/' . $company->company_logo);
            }
            $file = $request->file('company_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/company_logo', $filename);
            $company->company_logo = $filename;
        }

        $company->save();

        // update Email
        $user->email = $request->email;
        $user->save();

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('company.profile')->with('success', 'Profile updated successfully.');
    }

    // Dashboard
    public function showDashboard()
    {
        // Ambil perusahaan berdasarkan user_id dari pengguna yang sedang login
        $company = Company::where('user_id', Auth::id())->firstOrFail();
        $user = User::where('id', Auth::id())->firstOrFail();
        $jobCategories = Category::all();
        $jobTypes = JobType::all();

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
        return view('company.dashboard', compact('company', 'user', 'jobCategories', 'jobTypes', 'totalApplyJobs', 'acceptedApplyJobs', 'rejectedApplyJobs', 'inprogressApplyJobs', 'recentApplyJobs', 'activeJobs', 'inactiveJobs'));
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

        // Inisialisasi rentang tanggal (misalnya 30 hari terakhir)
        $start = now()->subDays(30);
        $end = now();
        $dates = [];
        $applyJobData = [];

        // Siapkan format data dengan mengisi tanggal yang hilang
        while ($start->lte($end)) {
            $dateStr = $start->format('Y-m-d');
            $dates[] = $dateStr;

            // Cari data untuk tanggal ini
            $dateData = $data->firstWhere('date', $dateStr);
            $applyJobData[] = $dateData ? $dateData->count : 0;

            $start->addDay();
        }

        return response()->json([
            'dates' => $dates,
            'apply_job_data' => $applyJobData
        ]);
    }


    public function showJobs()
    {
        // Ambil perusahaan berdasarkan user_id dari pengguna yang sedang login
        $company = Company::where('user_id', Auth::id())->firstOrFail();
        $user = User::where('id', Auth::id())->firstOrFail();

        $jobs = Job::where('company_id', $company->id)->get();

        // Kirim data perusahaan ke tampilan 'company.joblisting'
        return view('company.joblisting', compact('company', 'user', 'jobs'));
    }

    // Edit Job
    public function showEditJob($id)
    {
        // Ambil perusahaan berdasarkan user_id dari pengguna yang sedang login
        $company = Company::where('user_id', Auth::id())->firstOrFail();
        $user = User::where('id', Auth::id())->firstOrFail();

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
        $company = Company::where('user_id', Auth::id())->firstOrFail();
        $user = User::where('id', Auth::id())->firstOrFail();
        $categories = Category::all();
        $jobTypes = JobType::all();

        // Kirim data perusahaan ke tampilan 'company.addjob'
        return view('company.addjob', compact('company', 'user', 'categories', 'jobTypes'));
    }

    public function addJob(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|int|exists:categories,id',
            'job_type_id' => 'required|int|exists:job_types,id',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'deadline' => 'required|date',
        ]);

        // Ambil perusahaan berdasarkan user_id dari pengguna yang sedang login
        $company = Company::where('user_id', Auth::id())->firstOrFail();

        // Simpan data pekerjaan
        $job = Job::create([
            'company_id' => $company->id,
            'title' => $request->title,
            'category_id' => $request->category_id,
            'job_type_id' => $request->job_type_id,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'location' => $request->location,
            'salary' => $request->salary,
            'deadline' => $request->deadline,
            'job_status' => 'active', // Ubah sesuai kebutuhan
        ]);

        // Redirect ke halaman job listing dengan pesan sukses
        return redirect()->route('company.jobs')->with('success', 'Job added successfully.');
    }

    // Edit Job
    public function editJob(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|int|exists:categories,id',
            'job_type_id' => 'required|int|exists:job_types,id',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'deadline' => 'required|date',
        ]);

        // Ambil job berdasarkan ID
        $job = Job::findOrFail($id);

        // Periksa izin
        $this->authorize('update', $job);

        // Update data pekerjaan
        $job->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'job_type_id' => $request->job_type_id,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'location' => $request->location,
            'salary' => $request->salary,
            'deadline' => $request->deadline,
        ]);

        // Redirect ke halaman job listing dengan pesan sukses
        return redirect()->route('company.jobs')->with('success', 'Job updated successfully.');
    }

    // Delete Logo
    public function deleteLogo()
    {
        // Ambil data perusahaan yang akan diperbarui
        $company = Company::where('user_id', Auth::id())->firstOrFail();

        // Hapus logo lama jika ada
        if ($company->company_logo) {
            Storage::delete('public/company_logo/' . $company->company_logo);
            $company->company_logo = null;
            $company->save();
        }

        // Redirect ke halaman tertentu setelah berhasil menghapus logo
        return redirect()->route('company.profile')->with('success', 'Company logo deleted successfully');
    }

    public function setNewPassword(Request $request)
    {
        // Ambil user yang sedang login
        $user = User::where('id', Auth::id())->firstOrFail();

        // Validasi input
        $validatedData = $request->validate([
            'password' => 'required|string',
            'new_password' => [
                'required',
                'string',
                'min:5',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
        ], [
            'new_password.min' => 'Password must be at least 5 characters.',
            'new_password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
        ]);

        // Pastikan password lama sesuai
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('company.profile')->with('error', 'Password tidak sesuai!');
        }

        // Update password baru
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('company.profile')->with('success', 'Password updated successfully!');
    }

    // NOTIFIKASI
    public function getNotifications()
    {
        $company = Company::where('user_id', Auth::id())->firstOrFail();
        $jobs = $company->jobs->pluck('id'); // Mengambil ID dari semua job yang dimiliki oleh perusahaan tersebut

        // Mengambil lima data terbaru yang read_at tidak null
        $recentReadNotifications = ApplyJob::with(['jobSeeker', 'job'])
            ->whereIn('job_id', $jobs)
            ->whereNotNull('read_at')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Mengambil semua data yang read_at masih null
        $unreadNotifications = ApplyJob::with(['jobSeeker', 'job'])
            ->whereIn('job_id', $jobs)
            ->whereNull('read_at')
            ->get();

        // Mengisi data yang masih kurang dengan data dari $recentReadNotifications
        $notifications = $unreadNotifications->merge($recentReadNotifications->take(5 - $unreadNotifications->count()));

        // Format the notifications data
        $formattedNotifications = $notifications->map(function ($notification) {
            return [
                'job_seeker_name' => $notification->jobSeeker->job_seeker_name,
                'created_at' => $notification->created_at->format('Y-m-d H:i:s'),
            ];
        });

        // Tandai notifikasi sebagai sudah dibaca
        foreach ($unreadNotifications as $notification) {
            $notification->update(['read_at' => now()]);
        }

        return response()->json($formattedNotifications);
    }
}
