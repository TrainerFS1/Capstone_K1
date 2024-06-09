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
          {{-- <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <a href="" class="btn btn-primary d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Tambah Company
              </a>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="col-lg-12">
            <div class="card">
              @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
              @endif
              @if($company->isEmpty())
                  <p>Belum ada Data Company.</p>
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
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($company as $companyList)
                                  <tr>
                                      <td><span class="text-secondary">{{ $loop->iteration }}</span></td>
                                      <td>
                                        <div class="d-flex py-1 align-items-center">
                                          <img src="{{ asset('/storage/company_logo/'. $companyList->company_logo ) }}" class="avatar me-2" alt="">
                                        </div>
                                      </td>
                                      <td>{{ $companyList->company_name }}</td>
                                      <td>{{ $companyList->industry->industry_name }}</td>
                                      <td>
                                        @if($companyList->trashed())
                                        <span class="btn btn-sm btn-danger">Deleted</span>
                                    @else
                                        <span class="btn btn-sm btn-success">Active</span>
                                    @endif
                                </td>
                                <td>
                                    @if($companyList->trashed())
                                        <form action="{{ route('admin.restorecompany', $companyList->id) }}" method="POST" style="display: inline">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-success btn-sm" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-rotate-ccw">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -5v5h5" /><path d="M12 12a8.1 8.1 0 0 0 4.2 7.3" /><path d="M12 12v1" /><path d="M12 3v9" />
                                                </svg>
                                                Restore
                                            </button>
                                        </form>
                                    @else
                                      {{-- <a class="btn btn-sm btn-warning" href="{{ route('admin.company.detail',$companyList->id) }}">Detail</a> --}}
                                        {{-- / --}}
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.companyedit', $companyList->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-outline icon-tabler-edit">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" />
                                            </svg>
                                            Edit
                                        </a> /
                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-hapus">Delete</a>
                                        @include('admin.layouts.modaldeletelist')
                                    @endif
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
