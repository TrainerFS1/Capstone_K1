<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\JobSeeker\JobSeekerController;
use App\Http\Controllers\Company\CompanyController;
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

    Route::get('/jobs', [JobController::class, 'index'])->name('jobs');

});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



// Rute untuk dashboard masing-masing peran
Route::middleware(['auth', 'admin'])->group(function () {
});

Route::middleware(['auth', 'company'])->group(function () {
    Route::get('/company/setting', [CompanyController::class, 'showSetting'])->name('company.setting');
    Route::get('/company/lamaranmasuk', [CompanyController::class, 'showLamaranMasuk'])->name('company.lamaranmasuk');
    Route::get('/company/dashboard', [CompanyController::class, 'showDashboard'])->name('company.dashboard');
    Route::get('/company/profile', [CompanyController::class, 'showProfile'])->name('company.profile');
    //halaman list lowongan kerja
    Route::get('/company/jobs', [CompanyController::class, 'showJobs'])->name('company.jobs');
    // tambah lowongan
    Route::get('/company/addjob', [CompanyController::class, 'showAddJob'])->name('company.showaddjob');
    Route::post('/company/addjob', [CompanyController::class, 'addJob'])->name('company.addjob');
    // edit lowongan kerja
    Route::get('/company/{id}/edit', [CompanyController::class, 'showEditJob'])->name('company.showeditjob');
    Route::post('/company/{id}/edit', [CompanyController::class, 'updateJob'])->name('company.editjob');
    // delete
    Route::delete('/company/{id}/delete', [CompanyController::class, 'deleteJob'])->name('company.deletejob');

    Route::post('/company/updateprofile', [CompanyController::class, 'updateProfile'])->name('company.updateprofile');
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
