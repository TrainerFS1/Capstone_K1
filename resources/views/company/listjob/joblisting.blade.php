
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
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-bottom text-secondary d-flex flex-wrap justify-content-between align-items-center">
                            <div class="col-12 col-sm-6 col-md-4 mb-2 mb-sm-0">
                              <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  class="icon"
                                  width="24"
                                  height="24"
                                  viewBox="0 0 24 24"
                                  stroke-width="2"
                                  stroke="currentColor"
                                  fill="none"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                >
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                  <path d="M12 5l0 14" />
                                  <path d="M5 12l14 0" />
                                </svg>
                                Tambah Lowongan Kerja
                              </button>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                              <form action="{{ route('company.jobs.search') }}" method="GET" class="d-flex">
                                <div class="input-group">
                                  <input type="text" name="search" value="{{ request('search') }}" class="form-control" aria-label="Search jobs" placeholder="search...">
                                  <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                              </form>
                            </div>
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
                                                    <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-hapus">Delete</a>
                                                    @include('company.layouts.modaldeletelist')

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

    @include('company.layouts.modaladdjob')
@endsection
@section('customjs')

@endsection
