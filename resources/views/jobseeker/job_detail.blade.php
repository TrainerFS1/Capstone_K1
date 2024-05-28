@extends('layouts.app')

@section('main')
    <section class="section-4 bg-2">
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('jobs') }}">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to Jobs
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="container job_details_area">
            <div class="row">
                <div class="col-md-8">
                    @include('jobseeker.message')

                    <div class="card shadow border-0 p-3">
                        <div class="job_details_header">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    <div class="company_logo me-3">
                                        @if (!empty($job->company->company_logo))
                                            <img src="{{ asset('storage/' . $job->company->logo) }}" alt="Company Logo">
                                        @else
                                            <img src="{{ asset('images/default-logo.png') }}" alt="Company Logo">
                                        @endif
                                    </div>

                                    <div class="jobs_conetent">
                                        <a href="#">
                                            <h3>{{ $job->job_title }}</h3>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location me-3">
                                                <p><i class="fa fa-map-marker"></i> {{ $job->job_location }}</p>
                                            </div>
                                            <div class="location">
                                                <p><i class="fa fa-clock-o"></i> {{ $job->jobType->job_type_name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="descript_wrap white-bg p-3">
                            <div class="single_wrap">
                                <h4>Company Name</h4>
                                {!! nl2br($job->company->company_name) !!}
                            </div>

                            <div class="single_wrap">
                                <h4>Job Description</h4>
                                {!! nl2br($job->job_description) !!}
                            </div>
                            @if (!empty($job->job_salary))
                                <div class="single_wrap">
                                    <h4>Salary Range</h4>
                                    <p>{{ $job->job_salary }}</p>
                                </div>
                            @endif
                            @if (!empty($job->job_skills))
                                <div class="single_wrap">
                                    <h4>Job Skills</h4>
                                    <p>{{ $job->job_skills }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card shadow border-0 p-3 mt-4">
                        @auth
                            <div class="apply_job_area">
                                <h3>Apply for this Job</h3>
                                <form action="{{ route('applyJob', $job->id) }}" method="POST" enctype="multipart/form-data" id="applyJobForm">
                                    @csrf

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="useExistingFiles" name="use_existing_files">
                                        <label class="form-check-label" for="useExistingFiles">Use Existing Files</label>
                                    </div>

                                    <div class="mb-3">
                                        <label for="cv" class="form-label">CV (PDF only)</label>
                                        <input type="file" class="form-control" id="cv" name="cv" @if(old('use_existing_files')) disabled @endif>
                                        @error('cv')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="certificate" class="form-label">Certificate (PDF only)</label>
                                        <input type="file" class="form-control" id="certificate" name="certificate" @if(old('use_existing_files')) disabled @endif>
                                        @error('certificate')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Apply Now</button>
                                </form>
                            </div>
                        @else
                            <div class="alert alert-info" role="alert">
                                Please <a href="{{ route('loginJobSeeker') }}">login</a> to apply for this job.
                            </div>
                        @endauth
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow border-0 p-3">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Job Summary</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul class="list-unstyled">
                                    <li>Category: <span>{{ $job->category->category_name }}</span></li>
                                    <li>Job Type: <span>{{ $job->jobType->job_type_name }}</span></li>
                                    <li>Location: <span>{{ $job->job_location }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const useExistingFiles = document.getElementById('useExistingFiles');
            const cvInput = document.getElementById('cv');
            const certificateInput = document.getElementById('certificate');

            useExistingFiles.addEventListener('change', function () {
                const isChecked = useExistingFiles.checked;

                cvInput.disabled = isChecked;
                certificateInput.disabled = isChecked;
            });

            // Set initial state based on existing file selection
            const initialChecked = useExistingFiles.checked;
            cvInput.disabled = initialChecked;
            certificateInput.disabled = initialChecked;
        });
    </script>
@endpush
