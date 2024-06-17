<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\JobSeeker;
use Illuminate\Support\Facades\Auth;

class GuestCompanyController extends Controller
{
    public function search(Company $company)
    {
        $companies = Company::paginate(9);  // Paginate with 9 items per page
        $jobSeeker = JobSeeker::where('user_id', Auth::id())->first();
    
        return view('guest.companies.search', compact('companies', 'jobSeeker'));
    }
    
    public function show(Company $company)
    {
        $jobs = Job::where('company_id', $company->id)->get();
        $jobSeeker = JobSeeker::where('user_id', Auth::id())->first();
    
        return view('guest.companies.show', compact('company', 'jobs', 'jobSeeker'));
    }
    
    public function searchCompany(Request $request)
    {
        $keyword = $request->input('keyword');
        $companies = Company::where('company_name', 'like', "%$keyword%")
                            ->orWhere('company_description', 'like', "%$keyword%")
                            ->paginate(9);  // Paginate with 9 items per page
        $jobSeeker = JobSeeker::where('user_id', Auth::id())->first();
    
        return view('guest.companies.results', compact('companies', 'keyword', 'jobSeeker'));
    }
}

