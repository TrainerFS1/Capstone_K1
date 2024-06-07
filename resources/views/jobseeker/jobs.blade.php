@extends('layouts.app')

@section('main')
    <section class="section-0 lazy d-flex bg-image-style dark align-items-center" data-bg="{{ asset('images/bg.jpg') }}">
        <div class="container">
            <div class="col-12 col-xl-8 mt-4">
                <h1>Temukan Pekerjaan Impian Anda</h1>
            </div>
        </div>
    </section>

    <section class="section-1 py-5">
        <div class="container">
            <div class="card border-0 shadow p-5">
                <form id="searchForm" action="#" method="GET">
                    <div class="card border-0 shadow p-4 mt-1">
                        <div class="row">
                            <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                                <input value="{{ Request::get('keyword') }}" type="text" name="keyword" id="keyword" placeholder="Cari pekerjaan..." class="form-control">
                            </div>
                            <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                                <input value="{{ Request::get('location') }}" type="text" name="location" id="location" placeholder="Lokasi" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                                <select name="category" id="category" class="form-control">
                                    <option value="">Semua kategori</option>
                                    @foreach ($categories as $category)
                                        <option {{ (Request::get('category') == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="section-2 py-5">
        <div class="container">
            <div class="row" id="jobResults">
                @if ($jobs->isNotEmpty())
                    @foreach ($jobs as $job)
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 p-1 shadow">
                                <a href="{{ route('jobDetail', $job->id) }}" class="card-body d-flex align-items-center text-decoration-none">
                                    <div class="avatar avatar-xl me-4 rounded">
                                        @if (!empty($job->company->company_logo))
                                            <img src="{{ asset('storage/company_logo/' . $job->company->company_logo) }}" class="img-fluid" alt="Company Logo">
                                        @else
                                            <img src="{{ asset('images/default-logo.png') }}" class="img-fluid" alt="Company Logo">
                                        @endif
                                    </div>
                                    <div>
                                        <h2 class="border-0 pb-2 mb-0">{{ $job->job_title }}</h2>
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
                    
                    <div class="col-md-12">
                        {{ $jobs->withQueryString()->links() }}
                    </div>
                @else
                    <div class="col-md-12">
                        <p>Pekerjaan tidak ditemukan</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
    $(document).ready(function() {
        $("#searchForm").submit(function(e) {
            e.preventDefault();

            var keyword = $("#keyword").val();
            var location = $("#location").val();
            var category = $("#category").val();

            $.ajax({
                url: '{{ route("jobs.search.ajax") }}',
                method: 'GET',
                data: {
                    keyword: keyword,
                    location: location,
                    category: category,
                },
                success: function(response) {
                    $('#jobResults').empty();

                    if(response.jobs.length > 0) {
                        response.jobs.forEach(function(job) {
                            var jobCard = `
                                <div class="col-md-12 mb-4">
                                    <div class="card border-0 p-3 shadow">
                                        <a href="/jobDetail/${job.id}" class="card-body d-flex align-items-center text-decoration-none">
                                            <div class="company_logo me-4">
                                                <img src="${job.company.company_logo ? '/storage/company_logo/' + job.company.company_logo : '{{ asset('images/default-logo.png') }}'}" class="img-fluid" alt="Company Logo">
                                            </div>
                                            <div>
                                                <h2 class="border-0 pb-2 mb-0">${job.job_title}</h2>
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fas fa-dollar-sign"></i></span>
                                                    <span class="ps-1">${job.job_salary}</span>
                                                </p>
                                                <p>
                                                    <span class="fw-bolder"><i class="fas fa-map-marker"></i></span>
                                                    <span class="ps-1">${job.job_location}</span>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            `;
                            $('#jobResults').append(jobCard);
                        });
                    } else {
                        $('#jobResults').append('<div class="col-md-12"><p>Pekerjaan tidak ditemukan</p></div>');
                    }
                }
            });
        });
    });
    </script>
@endsection
