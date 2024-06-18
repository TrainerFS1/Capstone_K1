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
                            <h3 class="form-label">Nama Lowongan</h3>
                            <p>{{ $job->job_title }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <h3 class="form-label">Kategori Lowongan</h3>
                            <p>{{ $job->category->category_name }}</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h3 class="form-label">Tipe Pekerjaan</h3>
                            <p>{{ $job->jobType->job_type_name }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <h3 class="form-label">Lokasi</h3>
                            <p>{{ $job->job_location }}</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h3 class="form-label">Gaji</h3>
                            <p>{{ $job->job_salary }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="form-label">Skil yang dibutuhkan</h3>
                            <p>{{ $job->job_skills }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="form-label">Deskripsi Pekerjaan</h3>
                            <p>{{ $job->job_description }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="form-label">Status</h3>
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
