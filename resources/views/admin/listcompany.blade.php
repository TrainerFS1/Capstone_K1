@extends('admin.layouts.app')
@section('main')
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Data Company
            </h2>
          </div>
          <!-- Page title actions -->
          <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <a href="{{ route('company.showaddjob') }}" class="btn btn-primary d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Tambah Company
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
              <div class="col-4 card-body border-bottom ms-auto text-secondary">
                <form action="{{ route('jobs.search') }}" method="GET" class="d-flex justify-content-end">
                    <div class="input-group input-group-smo">
                        {{-- <span class="input-group-text text-secondary">Search:</span> --}}
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
              @if($company->isEmpty())
                  <p>Belum ada lowongan yang dibuat.</p>
              @else
                  <div class="table-responsive">
                      <table class="table card-table table-vcenter text-nowrap datatable">
                          <thead>
                              <tr>
                                  <th class="w-1">No.
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
                                  </th>
                                  <th>Logo</th>
                                  <th>Nama Company</th>
                                  <th>Industry</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($company as $companyList)
                                  <tr>
                                      <td><span class="text-secondary">{{ $loop->iteration }}</span></td>
                                      <td>
                                        <div class="d-flex py-1 align-items-center">
                                          <span class="avatar me-2" style="background-image: url(./static/avatars/{{ $companyList->company_logo ?? '' }})"></span>
                                        </div>
                                      </td>
                                      <td>{{ $companyList->company_name }}</td>
                                      <td>{{ $companyList->industry->industry_name }}</td>
                                      <td>
                                        <a class="btn btn-warning btn-sm" href="{{ route('company.showeditjob', $companyList->id) }}">
                                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-details"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.999 3l.001 17" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /></svg>
                                          Detail</a> /
                                        <a class="btn btn-primary btn-sm" href="{{ route('company.showeditjob', $companyList->id) }}">
                                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                          Edit</a> /
                                        <form action="{{  route('company.deletejob', $companyList->id) }}" method="POST" style="display: inline">
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
                <p class="m-0 text-secondary">
                    Showing <span>{{ $company->firstItem() }}</span> to <span>{{ $company->lastItem() }}</span> of <span>{{ $company->total() }}</span> entries
                </p>
                <ul class="pagination m-0 ms-auto">
                    <!-- Tambahkan kustomisasi untuk tombol previous -->
                    <li class="page-item {{ $company->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $company->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $company->onFirstPage() }}">
                            <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                            prev
                        </a>
                    </li>
                    
                    <!-- Tampilkan nomor halaman -->
                    @foreach ($company->getUrlRange(1, $company->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $company->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    
                    <!-- Tambahkan kustomisasi untuk tombol next -->
                    <li class="page-item {{ $company->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $company->nextPageUrl() }}" aria-disabled="{{ !$company->hasMorePages() }}">
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
