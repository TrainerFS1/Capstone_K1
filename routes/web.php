<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\JobSeeker\JobSeekerController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\JobListingController;
use App\Http\Controllers\Company\ApplyJobController;
use App\Http\Controllers\Job\JobController;
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


Route::middleware('guest')->group(function () {
    Route::get('/admin', [LoginController::class, 'showLoginFormAdmin'])->name('loginAdmin');
    Route::get('/company', [LoginController::class, 'showLoginFormCompany'])->name('loginCompany');
    Route::get('/jobseeker', [LoginController::class, 'showLoginFormJobSeeker'])->name('loginJobSeeker');
    Route::post('/admin', [LoginController::class, 'authenticate'])->name('cekloginadmin');
    Route::post('/company', [LoginController::class, 'authenticate'])->name('ceklogincompany');
    Route::post('/jobseeker', [LoginController::class, 'authenticate'])->name('cekloginjobseeker');
    
    Route::get('/company/register', [CompanyController::class, 'showRegistrationForm'])->name('company.register');
    Route::post('/company/register', [CompanyController::class, 'register'])->name('company.register.submit');

// Route untuk menampilkan form registrasi job seeker
    Route::get('/jobseeker/register', [JobSeekerController::class, 'showRegistrationForm'])->name('jobseeker.register');
    
    // Route untuk menyimpan data job seeker
    Route::post('/jobseeker/register', [JobSeekerController::class, 'register'])->name('jobseeker.register.submit');

    Route::get('/jobs', [JobController::class, 'index'])->name('jobs');

});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



// Rute untuk dashboard masing-masing peran
Route::middleware(['auth', 'admin'])->group(function () {
});

Route::middleware(['auth', 'company'])->group(function () {
    Route::get('/company/dashboard', [CompanyController::class, 'showDashboard'])->name('company.dashboard');
    Route::get('/company/setting', [CompanyController::class, 'showSetting'])->name('company.setting');
    Route::get('/company/profile', [CompanyController::class, 'showProfile'])->name('company.profile');
    Route::post('/company/updateprofile', [CompanyController::class, 'updateProfile'])->name('company.updateprofile');
    // 
    // 
    //halaman list lowongan kerja
    Route::get('/company/jobs', [JobListingController::class, 'showJobs'])->name('company.jobs');
    // tambah lowongan
    Route::get('/company/addjob', [JobListingController::class, 'showAddJob'])->name('company.showaddjob');
    Route::post('/company/addjob', [JobListingController::class, 'addJob'])->name('company.addjob');
    // edit lowongan kerja
    Route::get('/company/{id}/edit', [JobListingController::class, 'showEditJob'])->name('company.showeditjob');
    Route::post('/company/{id}/edit', [JobListingController::class, 'updateJob'])->name('company.editjob');
    Route::put('/company/{id}/ubahstatus', [JobListingController::class, 'updateStatus'])->name('company.editstatus');
    // pencarian
    // Route::get('/company/jobs/search', [CompanyController::class, 'ajaxSearch'])->name('company.searchjob');
    Route::get('/company/jobs/search', [JobListingController::class, 'showJobs'])->name('jobs.search');

    // delete lowongan kerja
    Route::delete('/company/{id}/delete', [JobListingController::class, 'deleteJob'])->name('company.deletejob');
    // 
    // 
    // halaman lamaran masuk
    Route::get('/company/lamaranmasuk', [ApplyJobController::class, 'showLamaranMasuk'])->name('company.lamaranmasuk');
});


Route::middleware(['auth', 'job_seeker'])->group(function () {
    Route::get('/jobseeker/profile', [JobSeekerController::class, 'showProfile'])->name('jobseeker.profile');
    Route::post('/jobseeker/profile', [JobSeekerController::class, 'updateProfile'])->name('jobseeker.profile.update');

    Route::get('/jobseeker/setting', function () {
        return view('jobseeker.setting');
    })->name('jobseeker.setting');
    // Route::get('/jobseeker/profile', function () {
    //     return view('jobseeker.profile');
    // })->name('jobseeker.profile');
});



Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
