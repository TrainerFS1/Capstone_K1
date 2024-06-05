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
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;
use App\Models\Industry;

class CompanyController extends Controller
{
    //
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

        // Kirim data perusahaan ke tampilan 'company.profile'
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

        // Siapkan format data untuk chart
        $dates = $data->pluck('date')->toArray();
        $applyJobData = $data->pluck('count')->toArray();

        return response()->json([
            'dates' => $dates,
            'apply_job_data' => $applyJobData
        ]);
    }

    // 
    public function showProfile()
    {
        // Ambil perusahaan berdasarkan user_id dari pengguna yang sedang login
        $company = Company::where('user_id', Auth::id())->first();
        $user = User::where('id', Auth::id())->firstOrFail();
        $industries = Industry::all();
        // Kirim data perusahaan ke tampilan 'company.profile'
        return view('company.profile', compact('company', 'user', 'industries'));
    }

    public function updateProfile(Request $request)
    {
        $company = Company::where('user_id', Auth::id())->first();
        $user = User::where('id', Auth::id())->firstOrFail();
        // Validasi input Comapny
        $validatedData = $request->validate([
            'company_name' => 'required|max:255',
            'company_website' => 'nullable',
            'company_address' => 'nullable',
            'company_phone' => 'nullable',
            'company_description' => 'nullable',
            'industry_id' => 'nullable|int',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);
        // Jika ada file logo yang di-upload, simpan dan update path logo
        if ($request->hasFile('company_logo')) {
            // Hapus logo lama jika ada
            if ($company->company_logo) {
                Storage::delete('public/company_logo/' . $company->company_logo);
            }
            $file = $request->file('company_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/company_logo', $filename);
            $validatedData['company_logo'] = $filename;
        } else {
            // Jangan ubah logo jika tidak ada file yang diunggah
            unset($validatedData['company_logo']);
        }

        $company->update($validatedData);

        // Validasi Email
        $validateEmail = $request->validate([
            'email' => 'required|email',
        ]);
        // update Email
        $user->update([
            'email' => $validateEmail['email'],
        ]);
        // Redirect ke halaman tertentu setelah berhasil memperbarui data

        return redirect()->route('company.profile')->with('success', 'Company Updated successfully.');
    }

    public function deleteLogo()
    {
        // Ambil data perusahaan yang akan diperbarui
        $company = Company::where('user_id', Auth::id())->first();


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
}
