@extends('company.layouts.app')

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
                            <h3 class="form-label" style="font-size: 1.25em;">Judul Lowongan Pekerjaan</h3>
                            <p>{{ $job->job_title }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <h3 class="form-label" style="font-size: 1.25em;">Kategori Pekerjaan</h3>
                            <p>{{ $job->category->category_name }}</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h3 class="form-label" style="font-size: 1.25em;">Tipe Pekerjaan</h3>
                            <p>{{ $job->jobType->job_type_name }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <h3 class="form-label" style="font-size: 1.25em;">Lokasi Pekerjaan</h3>
                            <p>{{ $job->job_location }}</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h3 class="form-label" style="font-size: 1.25em;">Kisaran Gaji</h3>
                            <p>{{ $job->job_salary }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="form-label" style="font-size: 1.25em;">Keahlian Yang Dibutuhkan</h3>
                            <p>{{ $job->job_skills }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="form-label" style="font-size: 1.25em;">Deskripsi Pekerjaan</h3>
                            <p>{{ $job->job_description }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h3 class="form-label" style="font-size: 1.25em;">Status Pekerjaan</h3>
                            <button class="btn btn-{{ $job->job_status == 'active' ? 'success' : 'danger' }} btn-sm" type="submit">
                                {{ $job->job_status == 'active' ? 'Active' : 'Inactive' }}
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end">
                            <a href="{{ route('company.jobs') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
