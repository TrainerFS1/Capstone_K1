<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Category;
use App\Models\JobSeeker;
use App\Models\JobType;
use Illuminate\Support\Facades\Auth;


class JobController extends Controller
{
    /**
     * Show the jobs listing page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get jobs query with filters
        $jobsQuery = Job::where('job_status', 'active');
    
        // Apply keyword filter
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $jobsQuery->where(function ($query) use ($keyword) {
                $query->where('job_title', 'like', "%{$keyword}%")
                    ->orWhere('job_description', 'like', "%{$keyword}%")
                    ->orWhere('job_skills', 'like', "%{$keyword}%")
                    ->orWhere('job_location', 'like', "%{$keyword}%");
            });
        }
    
        // Apply location filter
        if ($request->has('location')) {
            $jobsQuery->where('job_location', 'like', '%' . $request->input('location') . '%');
        }
    
        // Apply category filter
        if ($request->has('category')) {
            $jobsQuery->where('category_id', $request->input('category'));
        }
    
        // Apply job type filter
        if ($request->has('job_type')) {
            $jobsQuery->whereIn('job_type_id', $request->input('job_type'));
        }
    
        // Apply sort order
        if ($request->has('sort')) {
            $sortOrder = $request->input('sort') == '1' ? 'desc' : 'asc';
            $jobsQuery->orderBy('created_at', $sortOrder);
        } else {
            // Default sort order
            $jobsQuery->orderBy('created_at', 'desc');
        }
    
        // Get jobs paginated
        $jobs = $jobsQuery->paginate(10)->withQueryString();
    
        // Get job categories
        $categories = Category::all();
    
        // Get job types
        $jobTypes = JobType::all();
    
        // Get job type array for checkbox
        $jobTypeArray = $request->input('job_type', []);
    
        // Get job seeker details
        $jobSeeker = JobSeeker::where('user_id', Auth::id())->first();
    
        return view('jobseeker.jobs', compact('jobSeeker', 'jobs', 'categories', 'jobTypes', 'jobTypeArray'));
    }
    


    /**
     * Search jobs based on form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // Build the URL with the query parameters
        $url = route('jobs');

        // Add the query parameters to the URL
        $queryParameters = http_build_query($request->all());

        // Redirect to the jobs page with the query string
        return redirect($url . '?' . $queryParameters);
    }
    public function jobDetail($id)
    {
        // Find the job by ID
        $job = Job::with(['jobType', 'category', 'company'])->findOrFail($id);
        $jobSeeker = JobSeeker::where('user_id', Auth::id())->first();

        return view('jobseeker.job_detail', compact('jobSeeker','job'));
    }

    
}
