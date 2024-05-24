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
          <!-- Page title actions -->
          <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <a href="{{ route('company.showaddjob') }}" class="btn btn-primary d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
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
              {{-- <div class="card-header">
                <h3 class="card-title"></h3>
              </div> --}}
              <div class="card-body border-bottom py-3">
                <div class="d-flex">
                  <div class="text-secondary">
                    Show
                    <div class="mx-2 d-inline-block">
                      <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
                    </div>
                    entries
                  </div>
                  <div class="ms-auto text-secondary">
                    Search:
                    <div class="ms-2 d-inline-block">
                      <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                    </div>
                  </div>
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
                                  <th class="w-1">No.
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
                                  </th>
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
                                              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                              {{ $jobListing->job_status == 'active' ? 'Active' : 'Inactive' }}
                                          </button>
                                          </form>
                                        </td>
                                      <td>
                                        <a class="btn btn-warning btn-sm" href="{{ route('company.showeditjob', $jobListing->id) }}">
                                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-details"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.999 3l.001 17" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /></svg>
                                          Detail</a> /
                                        <a class="btn btn-primary btn-sm" href="{{ route('company.showeditjob', $jobListing->id) }}">
                                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                          Edit</a> /
                                        <form action="{{  route('company.deletejob', $jobListing->id) }}" method="POST" style="display: inline">
                                          @csrf
                                          @method('DELETE')
                                          <button class="btn btn-danger btn-sm" type="submit">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                            Delete</button>
                                        </form>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              @endif
              <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">Showing <span>1</span> to <span>8</span> of <span>16</span> entries</p>
                <ul class="pagination m-0 ms-auto">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                      <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                      prev
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item active"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">4</a></li>
                  <li class="page-item"><a class="page-link" href="#">5</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('customjs')
    <script>

    </script>
@endsection
