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
use App\Http\Controllers\Admin\KelJobController;
use App\Http\Controllers\JobSeeker\SaveJobsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\Admin\KelJobSeekerController;

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
Route::get('/jobs/search/ajax', [JobController::class, 'searchJobsAjax'])->name('jobs.search.ajax');
Route::get('/job/{id}', [JobController::class, 'jobDetail'])->name('jobDetail');




Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');



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

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



Route::middleware(['auth', 'admin'])->group(function () {
    // Routes untuk dashboard admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/datacompany', [KelCompanyController::class, 'showKelCompany'])->name('admin.companylist');
    Route::get('/admin/datacompany/{id}/edit', [KelCompanyController::class, 'showEditCompany'])->name('admin.companyedit');
    Route::post('/admin/datacompany/{id}/edit', [KelCompanyController::class, 'updateCompany'])->name('admin.editcompany');
    Route::delete('/admin/datacompany/{id}/delete', [KelCompanyController::class, 'deleteCompany'])->name('admin.deletecompany');

    Route::get('/admin/datajob', [KelJobController::class, 'index'])->name('admin.joblisting');
    Route::get('/admin/datajob/{id}/detail', [KelJobController::class, 'ShowdetailJobAdmin'])->name('admin.jobdetail');
    Route::delete('/admin/datajob/{id}/delete', [KelJobController::class, 'destroy'])->name('admin.deletejob');
    Route::put('/admin/datajob/{id}/updatestatus', [KelJobController::class, 'updateStatus'])->name('admin.updatestatus');

    Route::get('jobseekers', [KelJobSeekerController::class, 'index'])->name('admin.jobseekers.index');
    Route::get('jobseekers/{jobseeker}', [KelJobSeekerController::class, 'show'])->name('admin.jobseekers.show');
});


Route::middleware(['auth', 'company'])->group(function () {
    Route::get('/company/dashboard', [CompanyController::class, 'showDashboard'])->name('company.dashboard');
    Route::get('/company/setting', [CompanyController::class, 'showSetting'])->name('company.setting');
    Route::get('/api/apply-job-data', [CompanyController::class, 'getApplyJobData']); //chart
    Route::get('/api/notification', [CompanyController::class, 'getNotifications'])->name('notifications');; //chart
    
    //profile
    Route::get('/company/profile', [CompanyController::class, 'showProfile'])->name('company.profile');
    Route::post('/company/profile', [CompanyController::class, 'updateProfile'])->name('company.updateprofile');
    Route::get('/company/editprofile', [CompanyController::class, 'editProfile'])->name('company.editprofile');
    // Halaman list lowongan kerja
    Route::get('/company/jobs', [CompanyController::class, 'showJobs'])->name('company.jobs');
    // Tambah lowongan
    Route::get('/company/addjob', [CompanyController::class, 'showAddJob'])->name('company.showaddjob');
    Route::post('/company/addjob', [CompanyController::class, 'addJob'])->name('company.addjob');
    // Edit lowongan kerja
    Route::get('/company/{id}/edit', [CompanyController::class, 'showEditJob'])->name('company.showeditjob');
    Route::post('/company/{id}/edit', [CompanyController::class, 'updateJob'])->name('company.editjob');
    // Hapus lowongan kerja
    Route::delete('/company/{id}/delete', [CompanyController::class, 'deleteJob'])->name('company.deletejob');

    Route::post('/company/updateprofile', [CompanyController::class, 'updateProfile'])->name('company.updateprofile');
    Route::delete('/company/deletelogo', [CompanyController::class, 'deleteLogo'])->name('company.deleteLogo');
    Route::post('/company/updatepassword', [CompanyController::class, 'setNewPassword'])->name('company.setNewPassword');

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
    // Route::get('/company/lamaranmasuk/{id}/detail', [ApplyJobController::class, 'showDetail'])->name('company.lamaranmasuk.detail');
    Route::get('/company/lamaranmasuk/detail/{id}/{job_id}', [ApplyJobController::class, 'showDetailModal'])->name('company.lamaranmasuk.detail');
    Route::get('/company/lamaranmasuk/preview/cv/{id}', [ApplyJobController::class, 'showCv'])->name('company.lamaranmasuk.cv');
    Route::get('/company/lamaranmasuk/preview/certificate/{id}', [ApplyJobController::class, 'showCertificate'])->name('company.lamaranmasuk.certificate');
});

Route::middleware(['auth', 'job_seeker'])->group(function () {
    Route::get('/jobseeker/profile', [JobSeekerController::class, 'showProfile'])->name('jobseeker.profile');
    Route::post('/jobseeker/profile', [JobSeekerController::class, 'updateProfile'])->name('jobseeker.profile.update');

    Route::get('/jobseeker/setting', function () {
        return view('jobseeker.setting');
    })->name('jobseeker.setting');

    //ini tambahan
    Route::post('/job/{id}/apply', [JobSeekerApplyJobController::class, 'applyJob'])->name('applyJob');
    Route::post('/saveJob/{id}', [SaveJobsController::class, 'saveJob'])->name('saveJob');
    Route::get('/job/{id}/check-saved', [SaveJobsController::class, 'checkSavedJob'])->name('checkSavedJob');
    Route::get('/saved-jobs', [SaveJobsController::class, 'savedJobs'])->name('savedJobs');
    Route::get('/saved-jobs/{id}', [SaveJobsController::class, 'showSavedJob'])->name('showSavedJob');
    Route::delete('/saved-jobs/{savedJob}', [SaveJobsController::class, 'deleteSavedJob'])->name('deleteSavedJob');

    Route::get('/jobseeker/history', [JobSeekerApplyJobController::class, 'history'])->name('jobseeker.history');


});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk menampilkan formulir perubahan kata sandi
Route::get('password/change', [PasswordController::class, 'showChangePasswordForm'])->name('password.change');

// Rute untuk menangani permintaan perubahan kata sandi
Route::post('password/change', [PasswordController::class, 'changePassword'])->name('password.update');
