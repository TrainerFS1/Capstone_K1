@extends('admin.layouts.app')

@section('main')
        <!-- Page header -->
        <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Detail Lowongan Kerja
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('company.jobs') }}" class="btn btn-primary d-none d-sm-inline-block">
                            Kembali ke Daftar Lowongan Kerja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="form-label">Job Title</h3>
                            <p>{{ $job->job_title }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <h3 class="form-label">Job Category</h3>
                            <p>{{ $job->category->category_name }}</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h3 class="form-label">Job Type</h3>
                            <p>{{ $job->jobType->job_type_name }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <h3 class="form-label">Job Location</h3>
                            <p>{{ $job->job_location }}</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h3 class="form-label">Salary Range</h3>
                            <p>{{ $job->job_salary }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="form-label">Job Skills</h3>
                            <p>{{ $job->job_skills }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="form-label">Job Description</h3>
                            <p>{{ $job->job_description }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="form-label">Job Status</h3>
                            <p>{{ $job->job_status }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end">
                            <a href="{{ route('admin.joblisting') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
