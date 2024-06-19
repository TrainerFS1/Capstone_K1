<!-- resources/views/guest/companies/show.blade.php -->

@extends('layouts.app')

@section('main')
<div class="container">
    <section class="section-4 bg-2">
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);" onclick="goBack()">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Kembali
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <h2>Profil Perusahaan:</h2>
        <div class="container mb-5">
            <div class="row">
                <div class="card border-1 p-4 shadow">
                <h3>{{ $company->company_name }}</h3>
                <p>{{ $company->company_description }}</p>
                <p><strong>Address:</strong> {{ $company->company_address }}</p>
                <p><strong>Website:</strong> {{ $company->company_website }}</p>
                <p><strong>Phone:</strong> {{ $company->company_phone }}</p>
        </div>
        </div>
        </div>

        <h2>Tawaran Pekerjaan:</h2>
        <div class="row">
            @foreach ($jobs as $job)
                <div class="col-md-4 mb-4">
                    <div class="card border-1 p-1 shadow">
                        <a href="{{ route('jobDetail', $job->id) }}" class="card-body d-flex align-items-center text-decoration-none">
                            <div class="avatar avatar-xl me-4 rounded">
                                @if (!empty($job->company->company_logo))
                                    <img src="{{ asset('storage/company_logo/' . $job->company->company_logo) }}" class="img-fluid" alt="Company Logo">
                                @else
                                    <img src="{{ asset('images/default-logo-company.png') }}" class="img-fluid" alt="Company Logo">
                                @endif
                            </div>
                            <div>
                                <h5 class="border-0 pb-2 mb-0">{{ $job->job_title }}</h5>
                                <p class="mb-1">
                                    <span class="fw-bolder"><i class="fas fa-dollar-sign"></i></span>
                                    <span class="ps-1">{{ $job->job_salary }}</span>
                                </p>
                                <p class="mb-1">
                                    <span class="fw-bolder"><i class="fas fa-map-marker"></i></span>
                                    <span class="ps-1">{{ $job->job_location }}</span>
                                </p>
                                <p class="mb-1">
                                    <span class="fw-bolder"><i class="fas fa-clock"></i></span>
                                    <span class="ps-1">{{ $job->jobType->job_type_name }}</span>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>
@endsection
