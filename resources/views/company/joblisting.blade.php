
@extends('company.layouts.app')
@section('main')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        List Lowongan Kerja
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('company.showaddjob') }}" class="btn btn-primary d-none d-sm-inline-block">
                            Tambah Lowongan Kerja
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="col-4 card-body border-bottom ms-auto text-secondary">
                            <form action="{{ route('jobs.search') }}" method="GET" class="d-flex justify-content-end">
                                <div class="input-group input-group-smo">
                                    <input type="text" name="search" value="{{ request('search') }}" class="form-control p-2" aria-label="Search jobs" placeholder="search...">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if($jobs->isEmpty())
                            <p>Belum ada lowongan yang dibuat.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">No.</th>
                                            <th>Job Title</th>
                                            <th>Job Category</th>
                                            <th>Job Type</th>
                                            <th>Salary Range</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jobs as $jobListing)
                                            <tr>
                                                <td><span class="text-secondary">{{ $loop->iteration }}</span></td>
                                                <td>{{ $jobListing->job_title }}</td>
                                                <td>{{ $jobListing->category->category_name }}</td>
                                                <td>{{ $jobListing->jobType->job_type_name }}</td>
                                                <td>{{ $jobListing->job_salary }}</td>
                                                <td>
                                                    <form action="{{  route('company.editstatus', $jobListing->id) }}" method="POST" style="display: inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-{{ $jobListing->job_status == 'active' ? 'success' : 'danger' }} btn-sm" type="submit">
                                                            {{ $jobListing->job_status == 'active' ? 'Active' : 'Inactive' }}
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a class="btn btn-warning btn-sm" href="{{ route('company.showjobdetail', $jobListing->id) }}">Detail</a> /
                                                    <a class="btn btn-primary btn-sm" href="{{ route('company.showeditjob', $jobListing->id) }}">Edit</a> /
                                                    <form action="{{  route('company.deletejob', $jobListing->id) }}" method="POST" style="display: inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-secondary">
                                Showing <span>{{ $jobs->firstItem() }}</span> to <span>{{ $jobs->lastItem() }}</span> of <span>{{ $jobs->total() }}</span> entries
                            </p>
                            <ul class="pagination m-0 ms-auto">
                                <li class="page-item {{ $jobs->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $jobs->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $jobs->onFirstPage() }}">prev</a>
                                </li>
                                @foreach ($jobs->getUrlRange(1, $jobs->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page == $jobs->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li class="page-item {{ $jobs->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $jobs->nextPageUrl() }}" aria-disabled="{{ !$jobs->hasMorePages() }}">next</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
