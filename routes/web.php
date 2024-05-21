<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\JobSeeker\JobSeekerController;

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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [FrontController::class, 'index'])->name('front');


Route::middleware('guest')->group(function () {
    Route::get('/admin', [LoginController::class, 'showLoginFormAdmin'])->name('loginAdmin');
    Route::get('/company', [LoginController::class, 'showLoginFormCompany'])->name('loginCompany');
    Route::get('/jobseeker', [LoginController::class, 'showLoginFormJobSeeker'])->name('loginJobSeeker');
    Route::post('/admin', [LoginController::class, 'authenticate'])->name('cekloginadmin');
    Route::post('/company', [LoginController::class, 'authenticate'])->name('ceklogincompany');
    Route::post('/jobseeker', [LoginController::class, 'authenticate'])->name('cekloginjobseeker');
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



// Rute untuk dashboard masing-masing peran
Route::middleware(['auth', 'admin'])->group(function () {
});

Route::middleware(['auth', 'company'])->group(function () {
});

Route::middleware(['auth', 'job_seeker'])->group(function () {
    Route::get('/jobseeker/profile', [JobSeekerController::class, 'showProfile'])->name('jobseekerProfile');


    Route::get('/jobseeker/setting', function () {
        return view('jobseeker.setting');
    })->name('jobseeker.setting');
    // Route::get('/jobseeker/profile', function () {
    //     return view('jobseeker.profile');
    // })->name('jobseeker.profile');
});
