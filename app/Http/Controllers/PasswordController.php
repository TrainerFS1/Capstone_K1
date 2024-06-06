<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\JobSeeker;
class PasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        // Mengambil JobSeeker berdasarkan user_id yang sedang login
        $jobSeeker = JobSeeker::where('user_id', Auth::id())->first();

        return view('auth.change-password',['jobSeeker' => $jobSeeker]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak sesuai']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('company.profile')->with('status', 'Kata sandi berhasil diubah');
    }
}
