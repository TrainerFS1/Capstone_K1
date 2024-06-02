<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Industry;
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
        return view('admin.datacompany.listcompany', compact('company', 'user'));
    }

    public function showEditCompany($id)
    {
        // Mencari company berdasarkan id
        $company = Company::find($id);

        // Validasi jika company tidak ditemukan
        if (!$company) {
            return redirect()->back()->with('error', 'Company not found');
        }
        // Mendapatkan user yang sedang login
        $user = Auth::user();
        $industries = Industry::all();
        // Tampilkan halaman edit dengan data yang diperlukan
        return view('admin.datacompany.editcompany', compact('company', 'user', 'industries'));
    }
    public function updateCompany(Request $request, $id)
    {
        $company = Company::where('id', $id)->first();
        // Validasi data input
        // dd($request->all());

        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'company_website' => 'nullable|string|max:255',
            'company_phone' => 'required|string|max:20',
            'company_description' => 'required|string',
            'industry_id' => 'required|integer',
        ]);

        // Update data company
        $company->update([
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_website' => $request->company_website,
            'company_phone' => $request->company_phone,
            'company_description' => $request->company_description,
            'industry_id' => $request->industry_id,
        ]);

        // dd($company);

        return redirect()->route('admin.companylist')->with('success', 'Company updated successfully');
    }

    public function deleteCompany($id)
    {
        // Cari company berdasarkan ID
        $company = Company::findOrFail($id);

        // Ambil user_id yang terkait dengan company ini
        $userId = $company->user_id;

        // Hapus company
        $company->delete();

        // Hapus user yang terkait
        User::findOrFail($userId)->delete();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('admin.companylist')->with('success', 'Company and associated user deleted successfully');
    }
}
