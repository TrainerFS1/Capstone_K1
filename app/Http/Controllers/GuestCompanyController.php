<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;

class GuestCompanyController extends Controller
{
    public function search()
    {
        return view('guest.companies.search');
    }

    public function show(Company $company)
    {
        $jobs = Job::where('company_id', $company->id)->get();

        return view('guest.companies.show', compact('company', 'jobs'));
    }

    public function searchCompany(Request $request)
    {
        $keyword = $request->input('keyword');
        $companies = Company::where('company_name', 'like', "%$keyword%")
                            ->orWhere('company_description', 'like', "%$keyword%")
                            ->get();

        return view('guest.companies.results', compact('companies', 'keyword'));
    }
}

