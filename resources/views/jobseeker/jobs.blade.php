@extends('layouts.app')

@section('main')
    <section class="section-3 py-5 bg-2"">
        <div class="container">
        <img src="{{ asset('images/bg.png') }}" class="d-block w-100" alt="...">


            <div class="row pt-5">

                <div class="col-md-4 col-lg-3 sidebar mb-4">
                <form action="{{ route('jobs.search') }}" name="searchForm" id="searchForm" method="GET">
                <div class="card border-0 shadow p-4" style="background-color:#fdc344; color:white;">
                    <h2>Find Jobs</h2>
            </div>
                        <div class="card border-0 shadow p-4" style="background-color:#042445; color:white;">
                            <div class="mb-4">
                                <h3 class="mb-1">Cari Pekerjaan</h3>
                                <input value="{{ Request::get('keyword') }}" type="text" name="keyword" id="keyword" placeholder="Cari pekerjaan..." class="form-control">
                            </div>

                            <div class="mb-4">
                                <h3 class="mb-1">Location</h3>
                                <input value="{{ Request::get('location') }}" type="text" name="location" id="location" placeholder="Location" class="form-control">
                            </div>

                            <div class="mb-4">
                                <h3 class="mb-1">Category</h3>
                                <select name="category" id="category" class="form-control">
                                    <option value="">all categories</option>
                                    @foreach ($categories as $category)
                                        <option {{ (Request::get('category') == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <h3 class="mb-1">Job Type</h3>
                                @foreach ($jobTypes as $jobType)
                                    <div class="form-check mb-2">
                                        <input {{ (in_array($jobType->id, $jobTypeArray)) ? 'checked' : '' }} class="form-check-input" name="job_type[]" type="checkbox" value="{{ $jobType->id }}" id="job-type-{{ $jobType->id }}">
                                        <label class="form-check-label" for="job-type-{{ $jobType->id }}">{{ $jobType->job_type_name }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('jobs') }}" class="btn btn-secondary mt-3">Reset</a>
                        </div>
                    </form>

                </div>

                <div class="col-md-8 col-lg-9">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">
                                @if ($jobs->isNotEmpty())
                                    @foreach ($jobs as $job)
                                        <div class="col-md-4">
                                            <div class="card border-0 p-3 shadow mb-4">
                                                <div class="card-body">
                                                    <h2 class="border-0  pb-2 mb-0">{{ $job->job_title }}</h2>

                                                    <p>{{ Str::words(strip_tags($job->job_description), $words=10, '...') }}</p>

                                                    <div class="bg-light p-3 border">
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i
                                                                    class="fas fa-map-marker"></i></span>
                                                            <span class="ps-1">{{ $job->job_location }}</span>
                                                        </p><br>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i
                                                                    class="fas fa-clock"></i></span>
                                                            <span
                                                                class="ps-1">{{ $job->jobType->job_type_name }}</span>
                                                        </p>
                                                        <br>

                                                        @if (!is_null($job->job_salary))
                                                            <p class="mb-0">
                                                                <span class="fw-bolder"><i
                                                                        class="fas fa-dollar-sign"></i></span>
                                                                <span class="ps-1">{{ $job->job_salary }}</span>
                                                            </p>
                                                        @endif
                                                    </div>

                                                    <div class="d-grid mt-3">
                                                        <a href="{{ route('jobDetail', $job->id) }}"
                                                            class="btn btn-primary btn-lg">Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12">
                                        {{ $jobs->withQueryString()->links() }}
                                    </div>
                                @else
                                    <div class="col-md-12">Jobs not found</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('customJs')
<script>
    $(document).ready(function() {
        $("#searchForm").submit(function(e) {
            e.preventDefault();

            var url = '{{ route("jobs.search") }}?';

            var keyword = $("#keyword").val();
            var location = $("#location").val();
            var category = $("#category").val();
            var sort = $("#sort").val();

            var checkedJobTypes = $("input:checkbox[name='job_type[]']:checked").map(function() {
                return $(this).val();
            }).get();

            // If keyword has a value
            if (keyword) {
                url += 'keyword=' + keyword + '&';
            }

            // If location has a value
            if (location) {
                url += 'location=' + location + '&';
            }

            // If category has a value
            if (category) {
                url += 'category=' + category + '&';
            }

            // If user has checked job types
            if (checkedJobTypes.length > 0) {
                url += 'jobType=' + checkedJobTypes.join(',') + '&';
            }

            url += 'sort=' + sort;

            // Remove trailing '&' if present
            if (url.slice(-1) === '&') {
                url = url.slice(0, -1);
            }

            // Navigate to the constructed URL
            window.location.href = url;
        });
    });
</script>

@endsection
