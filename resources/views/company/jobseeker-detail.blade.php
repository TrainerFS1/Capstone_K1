@extends('company.layouts.app')

@section('main')
<div class="container-xl">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Detail Pelamar Pekerjaan</h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/profile_pictures/' . $jobSeeker->profile_picture) }}" class="avatar avatar-xl mb-3 rounded" alt="Profile Picture">
                    </div>
                    <h4 class="text-center">{{ $jobSeeker->job_seeker_name }}</h4>
                    <p class="text-center text-secondary">{{ $jobSeeker->job_seeker_address }}</p>
                    <hr>
                    <div class="mb-3">
                        <h5>Telepon</h5>
                        <p>{{ $jobSeeker->job_seeker_phone }}</p>
                    </div>
                    <div class="mb-3">
                        <h5>Resume</h5>
                        <p>{{ $jobSeeker->job_seeker_resume }}</p>
                    </div>

                    @if($jobSeeker->file_job_seekers->isNotEmpty())
                        @foreach($jobSeeker->file_job_seekers as $file)
                            <div class="mb-3">
                                <h5>CV</h5>
                                <a href="{{ asset('storage/cv/' . $file->cv) }}" download>{{ $file->cv }}</a>
                            </div>

                            <div class="mb-3">
                                <h5>Certificate</h5>
                                <a href="{{ asset('storage/certificate/' . $file->certificate) }}" download>{{ $file->certificate }}</a>
                            </div>
                        @endforeach
                    @else
                        <p>File CV dan Certificate tidak tersedia.</p>
                    @endif
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('company.lamaranmasuk') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
