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

                            <form class="card" action="{{ route('jobseeker.profile.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row row-cards">
                                        <div class="col-md-8">
                                            <span class="avatar avatar-xl mb-3 rounded" style="background-image: url('{{ asset('storage/profile_pictures/' . $jobSeeker->profile_picture) }}')"></span>

                                            <div class="mb-3">
                                                <label class="form-label">Profile Picture</label>
                                                <input type="file" class="form-control" name="profile_picture">
                                                @if ($jobSeeker->profile_picture)
                                                    <div class="form-text">
                                                        Current Profile Picture: <a href="{{ asset('storage/profile_pictures/' . $jobSeeker->profile_picture) }}" target="_blank">{{ $jobSeeker->profile_picture }}</a>
                                                    </div>
                                                @else
                                                    <div class="form-text">
                                                        Upload your profile picture (max size: 2MB)
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="job_seeker_name" placeholder="Job Seeker" value="{{ $jobSeeker->job_seeker_name ?? '' }}" autofocus required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="job_seeker_phone" placeholder="Phone" value="{{ $jobSeeker->job_seeker_phone ?? '' }}" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Email address</label>
                                                <input type="email" class="form-control" value="{{ $jobSeeker->user->email }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="job_seeker_address" placeholder="Home Address" value="{{ $jobSeeker->job_seeker_address ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Gender</label><br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="job_seeker_gender" id="male" value="laki-laki" {{ $jobSeeker->job_seeker_gender == 'Laki-laki' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="female">Laki-laki</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="job_seeker_gender" id="female" value="perempuan" {{ $jobSeeker->job_seeker_gender == 'Perempuan' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="female">Perempuan</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Birthdate</label>
                                                <input type="date" class="form-control" name="job_seeker_birthdate" value="{{ $jobSeeker->job_seeker_birthdate ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3 mb-0">
                                                <label class="form-label">About Me</label>
                                                <textarea rows="5" class="form-control" name="job_seeker_resume" placeholder="Here can be your description">{{ $jobSeeker->job_seeker_resume ?? '' }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">CV</label>
                                                <input type="file" class="form-control" name="cv">
                                                @if ($fileJobSeeker && $fileJobSeeker->cv)
                                                    <div class="form-text">
                                                        Current CV: <a href="{{ asset('storage/' . $fileJobSeeker->cv) }}" target="_blank">{{ basename($fileJobSeeker->cv) }}</a>
                                                    </div>
                                                @else
                                                    <div class="form-text">
                                                        Upload your CV (max size: 5MB)
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Certificate</label>
                                                <input type="file" class="form-control" name="certificate">
                                                @if ($fileJobSeeker && $fileJobSeeker->certificate)
                                                    <div class="form-text">
                                                        Current Certificate: <a href="{{ asset('storage/' . $fileJobSeeker->certificate) }}" target="_blank">{{ basename($fileJobSeeker->certificate) }}</a>
                                                    </div>
                                                @else
                                                    <div class="form-text">
                                                        Upload your certificate (max size: 5MB)
                                                    </div>
                                                @endif
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
