<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\JobSeeker;
use App\Models\FileJobSeeker;

class JobSeekerController extends Controller
{
    // Menampilkan form registrasi job seeker
    public function showRegistrationForm()
    {
        return view('jobseeker.register');
    }

    // Menyimpan data job seeker
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:5',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            'job_seeker_gender' => 'nullable|string|max:255',
            'job_seeker_birthdate' => 'nullable|date',
        ], [
            'password.min' => 'Password harus minimal 5 karakter.',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf besar, satu huruf kecil, dan satu angka.',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'job_seeker',
        ]);

        // Create job seeker
        $jobSeeker = JobSeeker::create([
            'user_id' => $user->id,
            'job_seeker_name' => $request->name,
            'job_seeker_gender' => $request->job_seeker_gender,
            'job_seeker_birthdate' => $request->job_seeker_birthdate,
        ]);

        // Redirect to login with success message
        return redirect()->route('loginJobSeeker')->with('success', 'Registrasi berhasil, silakan login.');
    }

    // Menampilkan halaman profil job seeker
    public function showProfile()
    {
        // Ambil data job seeker berdasarkan user_id
        $jobSeeker = JobSeeker::where('user_id', Auth::id())->first();

        // Ambil file job seeker terkait
        $fileJobSeeker = $jobSeeker->fileJobSeekers()->where('file_type', 'primary')->first();

        // Kirim data ke view
        return view('jobseeker.profile', compact('jobSeeker', 'fileJobSeeker'));
    }

    // Mengupdate profil job seeker
    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'job_seeker_name' => 'required|string|max:255',
            'job_seeker_phone' => 'nullable|string|max:255',
            'job_seeker_address' => 'nullable|string|max:255',
            'job_seeker_resume' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'certificate' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'job_seeker_gender' => 'nullable|string|max:255',
            'job_seeker_birthdate' => 'nullable|date',
        ]);

        // Ambil data job seeker berdasarkan user_id
        $jobSeeker = JobSeeker::where('user_id', Auth::id())->first();

        // Perbarui data job seeker
        $jobSeeker->job_seeker_name = $request->job_seeker_name;
        $jobSeeker->job_seeker_phone = $request->job_seeker_phone;
        $jobSeeker->job_seeker_address = $request->job_seeker_address;
        $jobSeeker->job_seeker_resume = $request->job_seeker_resume;
        $jobSeeker->job_seeker_gender = $request->job_seeker_gender;
        $jobSeeker->job_seeker_birthdate = $request->job_seeker_birthdate;

        // Handle unggah gambar profil
        if ($request->hasFile('profile_picture')) {
            // Hapus gambar profil sebelumnya jika ada
            if ($jobSeeker->profile_picture) {
                Storage::delete('public/profile_pictures/' . $jobSeeker->profile_picture);
            }

            // Simpan gambar profil yang baru
            $profilePictureName = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
            $request->file('profile_picture')->storeAs('public/profile_pictures', $profilePictureName);
            $jobSeeker->profile_picture = $profilePictureName;
        }

        // Handle unggah CV
        if ($request->hasFile('cv')) {
            // Ambil atau buat entri FileJobSeeker
            $fileJobSeeker = $jobSeeker->fileJobSeekers()->firstOrNew(['file_type' => 'primary']);

            // Hapus CV sebelumnya jika ada
            if ($fileJobSeeker->cv) {
                Storage::delete($fileJobSeeker->cv);
            }

            // Simpan CV yang baru
            $cvFile = $request->file('cv');
            $cvName = 'cv_' . time() . '.' . $cvFile->getClientOriginalExtension();
            $cvPath = $cvFile->storeAs('cv', $cvName, 'public');

            // Assign path CV ke FileJobSeeker
            $fileJobSeeker->cv = $cvPath;

            // Simpan relasi FileJobSeeker
            $jobSeeker->fileJobSeekers()->save($fileJobSeeker);
        }

        // Handle unggah sertifikat
        if ($request->hasFile('certificate')) {
            // Ambil atau buat entri FileJobSeeker
            $fileJobSeeker = $jobSeeker->fileJobSeekers()->firstOrNew(['file_type' => 'primary']);

            // Hapus sertifikat sebelumnya jika ada
            if ($fileJobSeeker->certificate) {
                Storage::delete($fileJobSeeker->certificate);
            }

            // Simpan sertifikat yang baru
            $certificateFile = $request->file('certificate');
            $certificateName = 'certificate_' . time() . '.' . $certificateFile->getClientOriginalExtension();
            $certificatePath = $certificateFile->storeAs('certificates', $certificateName, 'public');

            // Assign path sertifikat ke FileJobSeeker
            $fileJobSeeker->certificate = $certificatePath;

            // Simpan relasi FileJobSeeker
            $jobSeeker->fileJobSeekers()->save($fileJobSeeker);
        }

        // Simpan job seeker
        $jobSeeker->save();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('jobseeker.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
