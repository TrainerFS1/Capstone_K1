@extends('admin.layouts.app')

@section('main')
    <!-- Page body -->
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>Daftar Company</h2>
                        <div class="col-auto ms-auto d-print-none">
                            <form class="d-flex" action="{{ route('admin.companylist') }}" method="GET">
                                <input class="form-control me-2" type="search" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama, alamat atau telepon">
                                <button class="btn btn-outline-primary" type="submit">Cari</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
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
                                            <th class="w-1">No.</th>
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
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex py-1 align-items-center">
                                                        <img src="{{ asset('/storage/company_logo/'. $companyList->company_logo ) }}" class="avatar me-2" alt="">
                                                    </div>
                                                </td>
                                                <td>{{ $companyList->company_name }}</td>
                                                <td>{{ $companyList->industry->industry_name }}</td>
                                                <td>
                                                    @if($companyList->trashed())
                                                    <span class="btn btn-sm btn-danger">Hapus</span>
                                                    @else
                                                        <span class="btn btn-sm btn-success">Aktif</span>
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
                                                                Pulihkan
                                                            </button>
                                                        </form>
                                                    @else
                                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.companyedit', $companyList->id) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-edit">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" />
                                                            </svg>
                                                            Edit
                                                        </a>
                                                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-hapus-{{ $companyList->id }}">Hapus</a>
                                                        @include('admin.layouts.modaldeletelist', ['companylistId' => $companyList->id])

                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-secondary">
                            Menampilkan <span>{{ $company->firstItem() }}</span> hingga <span>{{ $company->lastItem() }}</span> dari <span>{{ $company->total() }}</span> baris
                        </p>
                        <ul class="pagination m-0 ms-auto">
                            <!-- Previous Page Link -->
                            <li class="page-item {{ $company->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $company->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $company->onFirstPage() }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                                    Prev
                                </a>
                            </li>

                            <!-- Pagination Elements -->
                            @foreach ($company->getUrlRange(1, $company->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $company->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            <!-- Next Page Link -->
                            <li class="page-item {{ $company->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $company->nextPageUrl() }}" aria-disabled="{{ !$company->hasMorePages() }}">
                                    Next
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customjs')
    <script>
        // Your custom JavaScript goes here
    </script>
@endsection
