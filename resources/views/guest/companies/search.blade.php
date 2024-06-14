@extends('layouts.app')

@section('main')
<div class="container">
    <h1>Cari Perusahaan</h1>

    <form action="{{ route('guest.companies.searchCompany') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="keyword" class="form-control" placeholder="Cari perusahaan disini..." aria-label="Search for companies..." aria-describedby="button-search">
            <button class="btn btn-primary" type="submit" id="button-search">Cari</button>
        </div>
    </form>

    <div class="card border-1 shadow p-5">
        <h1>Semua Perusahaan</h1>
        @if($companies->isEmpty())
            <p>Tidak ada perusahaan ditemukan.</p>
        @else
            <div class="row">
                @foreach($companies as $company)
                    <div class="col-md-4 mb-4">
                        <div class="card border-1 p-1 shadow">
                            <a href="{{ route('guest.companies.show', $company) }}" class="card-body d-flex align-items-center text-decoration-none">
                                <div class="avatar avatar-xl me-4 rounded">
                                    @if (!empty($company->company_logo))
                                        <img src="{{ asset('storage/company_logo/' . $company->company_logo) }}" class="img-fluid" alt="Company Logo">
                                    @else
                                        <img src="{{ asset('images/default-logo-company.png') }}" class="img-fluid" alt="Company Logo">
                                    @endif
                                </div>
                                <div>
                                    <h5 class="card-title border-0 pb-2 mb-0">{{ $company->company_name }}</h5>
                                    <p class="mb-1">
                                        <span class="fw-bolder"><i class="fas fa-map-marker-alt"></i></span>
                                        <span class="ps-1">{{ $company->company_address }}</span>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <ul class="pagination m-0 ms-auto">
                                <li class="page-item {{ $companies->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $companies->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $companies->onFirstPage() }}">prev</a>
                                </li>
                                @foreach ($companies->getUrlRange(1, $companies->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page == $companies->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li class="page-item {{ $companies->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $companies->nextPageUrl() }}" aria-disabled="{{ !$companies->hasMorePages() }}">next</a>
                                </li>
                            </ul>
        @endif
    </div>
</div>
@endsection
