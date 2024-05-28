<?php

namespace App\Http\Controllers\Admin;

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

class KelCompanyController extends Controller
{
    //
    public function showKelCompany(Request $request)
    {
        // Ambil perusahaan berdasarkan user_id dari pengguna yang sedang login
        $user = Auth::user(); // Dapatkan user yang sedang login
        $company = Company::paginate(10);

        // Kirim data perusahaan ke tampilan 'admin.listcompany'
        return view('admin.listcompany', compact('company', 'user'));
    }
}
