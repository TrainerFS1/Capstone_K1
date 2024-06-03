<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\JobSeeker\JobSeekerController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\JobListingController;
use App\Http\Controllers\Company\ApplyJobController;
use App\Http\Controllers\JobSeeker\JobSeekerApplyJobController;
use App\Http\Controllers\Job\JobController;
use App\Http\Controllers\Admin\KelCompanyController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->name('front');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs');
Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');
Route::get('/job/{id}', [JobController::class, 'jobDetail'])->name('jobDetail');


Route::get('/login-jobseeker', [LoginController::class, 'showLoginFormJobSeeker'])->name('loginJobseeker');
Route::post('/login-jobseeker', [LoginController::class, 'authenticate'])->name('cekloginjobseeker');

Route::get('/about-us', [AboutUsController::class, 'index'])->name('aboutUs');

Route::middleware('guest')->group(function () {
    Route::get('/admin', [LoginController::class, 'showLoginFormAdmin'])->name('loginAdmin');
    Route::get('/company', [LoginController::class, 'showLoginFormCompany'])->name('loginCompany');
    Route::get('/jobseeker', [LoginController::class, 'showLoginFormJobSeeker'])->name('loginJobSeeker');
    Route::post('/admin', [LoginController::class, 'authenticate'])->name('cekloginadmin');
    Route::post('/company', [LoginController::class, 'authenticate'])->name('ceklogincompany');
    Route::post('/jobseeker', [LoginController::class, 'authenticate'])->name('cekloginjobseeker');

    Route::get('/company/register', [CompanyController::class, 'showRegistrationForm'])->name('company.register');
    Route::post('/company/register', [CompanyController::class, 'register'])->name('company.register.submit');

    Route::get('/jobseeker/register', [JobSeekerController::class, 'showRegistrationForm'])->name('jobseeker.register');
    Route::post('/jobseeker/register', [JobSeekerController::class, 'register'])->name('jobseeker.register.submit');


    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});




Route::middleware(['auth', 'admin'])->group(function () {
    // Routes for admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/datacompany', [KelCompanyController::class, 'showKelCompany'])->name('admin.companylist');
    Route::get('/admin/datacompany/{id}/edit', [KelCompanyController::class, 'showEditCompany'])->name('admin.companyedit');
    Route::post('/admin/datacompany/{id}/edit', [KelCompanyController::class, 'updateCompany'])->name('admin.editcompany');
    Route::delete('/admin/{id}/delete', [KelCompanyController::class, 'deleteCompany'])->name('admin.deletecompany');
});

Route::middleware(['auth', 'company'])->group(function () {
    Route::get('/company/dashboard', [CompanyController::class, 'showDashboard'])->name('company.dashboard');
    Route::get('/company/setting', [CompanyController::class, 'showSetting'])->name('company.setting');
    Route::get('/company/profile', [CompanyController::class, 'showProfile'])->name('company.profile');
    Route::get('/api/apply-job-data', [CompanyController::class, 'getApplyJobData']);
    Route::post('/company/updateprofile', [CompanyController::class, 'updateProfile'])->name('company.updateprofile');

    // Routes for managing jobs
    Route::get('/company/jobs', [JobListingController::class, 'showJobs'])->name('company.jobs');
    // Route::get('/company/addjob', [JobListingController::class, 'showAddJob'])->name('company.showaddjob');
    Route::post('/company/addjob', [JobListingController::class, 'addJob'])->name('company.addjob');
    Route::get('/company/{id}/edit', [JobListingController::class, 'showEditJob'])->name('company.showeditjob');
    // routes/web.php
    Route::get('/company/{id}/detail', [JobListingController::class, 'showJobDetail'])->name('company.showjobdetail');
    Route::post('/company/{id}/edit', [JobListingController::class, 'updateJob'])->name('company.editjob');
    Route::put('/company/{id}/updatestatus', [JobListingController::class, 'updateStatus'])->name('company.editstatus');
    Route::get('/company/jobs/search', [JobListingController::class, 'ajaxSearch'])->name('company.jobs.search');
    Route::delete('/company/{id}/delete', [JobListingController::class, 'deleteJob'])->name('company.deletejob');

    // Route for managing job applications
    Route::get('/company/lamaranmasuk', [ApplyJobController::class, 'showLamaranMasuk'])->name('company.lamaranmasuk');
    Route::post('/company/lamaranmasuk/{id}/reject', [ApplyJobController::class, 'rejectLamaran'])->name('company.lamaranmasuk.reject');
    Route::post('/company/lamaranmasuk/{id}/accept', [ApplyJobController::class, 'acceptLamaran'])->name('company.lamaranmasuk.accept');

    Route::get('/company/job-seeker/{id}', [JobSeekerController::class, 'show'])->name('company.jobseeker.detail');
});


Route::middleware(['auth', 'job_seeker'])->group(function () {
    Route::get('/jobseeker/profile', [JobSeekerController::class, 'showProfile'])->name('jobseeker.profile');
    Route::post('/jobseeker/profile', [JobSeekerController::class, 'updateProfile'])->name('jobseeker.profile.update');

    Route::get('/jobseeker/setting', function () {
        return view('jobseeker.setting');
    })->name('jobseeker.setting');

    // Route::get('/jobs', [JobController::class, 'index'])->name('jobs');
    // Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');
    // Route::get('/job/{id}', [JobController::class, 'jobDetail'])->name('jobDetail');

    //ini tambahan
    Route::post('/job/{id}/apply', [JobSeekerApplyJobController::class, 'applyJob'])->name('applyJob');
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
