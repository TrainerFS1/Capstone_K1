<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
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
            'password' => 'required|string|min:5|confirmed',
        ]);

        // Simpan data user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'company',
        ]);

        // Simpan data perusahaan
        // $company = Company::create([
        //     'user_id' => $user->id,
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     // Kolom lain yang ingin Anda tambahkan
        // ]);

        // Redirect ke halaman login perusahaan dengan pesan sukses
        return redirect()->route('loginCompany')->with('success', 'Company registered successfully. Please login.');
    }
}
