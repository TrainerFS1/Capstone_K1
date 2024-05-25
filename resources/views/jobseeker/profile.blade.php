@extends('layouts.app')

@section('main')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Profile</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="col-lg-12">
                    <div class="row row-cards">
                        <div class="col-12">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form class="card" action="{{ route('jobseeker.profile.update') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row row-cards">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Job Seeker <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" name="job_seeker_name" placeholder="Job Seeker" value="{{ $jobSeeker->job_seeker_name ?? '' }}" autofocus required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Phone <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" name="job_seeker_phone" placeholder="Phone" value="{{ $jobSeeker->job_seeker_phone ?? '' }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Email address</label>
                                                <input type="email" class="form-control" value="{{ $jobSeeker->user->email }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="job_seeker_address" placeholder="Home Address" value="{{ $jobSeeker->job_seeker_address ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3 mb-0">
                                                <label class="form-label">About Me</label>
                                                <textarea rows="5" class="form-control" name="job_seeker_resume" placeholder="Here can be your description">{{ $jobSeeker->job_seeker_resume ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('customjs')
    <script>
        // Tambahkan kode JavaScript khusus jika diperlukan
    </script>
@endsection
