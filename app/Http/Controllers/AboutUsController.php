<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobSeeker; // Sesuaikan dengan namespace model JobSeeker
use Illuminate\Support\Facades\Auth;

class AboutUsController extends Controller
{
    public function index()
    {
        // Mengambil JobSeeker berdasarkan user_id yang sedang login
        $jobSeeker = JobSeeker::where('user_id', Auth::id())->first();

        // Mengirim data $jobSeeker ke view 'aboutUs'
        return view('aboutUs', ['jobSeeker' => $jobSeeker]);
    }
}
