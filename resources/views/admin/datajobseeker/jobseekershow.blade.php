@extends('admin.layouts.app')

@section('main')
    <div class="card">
        <div class="card-header">
            <h4>Detail Jobseeker</h4>
        </div>
        <div class="card-body">
        <span class="avatar avatar-xl mb-3 rounded" style="background-image: url('{{ asset('storage/profile_pictures/' . $jobseeker->profile_picture) }}')"></span>

            <div class="form-group">
                <label for="name">Nama:</label>
                <p>{{ $jobseeker->job_seeker_name }}</p>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <p>{{ $jobseeker->user->email }}</p>
            </div>
            <div class="form-group">
                <label for="address">Alamat:</label>
                <p>{{ $jobseeker->job_seeker_address ?: '-' }}</p>
            </div>
            <div class="form-group">
                <label for="phone">Telepon:</label>
                <p>{{ $jobseeker->job_seeker_phone ?: '-' }}</p>
            </div>
            <div class="form-group mb-5">
                <label for="resume">Resume:</label>
                <p>{{ $jobseeker->job_seeker_resume ?: '-' }}</p>
            </div>
            <div class="col-12 text-end">
            <a href="{{ route('admin.jobseekers.index') }}" class="btn btn-primary">Kembali</a>
        </div>
</div>
    </div>
@endsection
