@extends('layouts.app')

@section('main')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Profil Perusahaan</h2>
                </div>
                <div class="col-auto">
                    <a href="{{ route('company.editprofile') }}" class="btn btn-primary">Edit Profil</a>
                    <a href="{{ route('password.change') }}" class="btn btn-warning">Ubah Kata Sandi</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title">Nama Perusahaan</h3>
                            <p class="card-text">{{ $company->company_name ?? '' }}</p>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title">Telepon Perusahaan</h3>
                            <p class="card-text">{{ $company->company_phone ?? '' }}</p>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title">Alamat Email</h3>
                            <p class="card-text">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title">Alamat Perusahaan</h3>
                            <p class="card-text">{{ $company->company_address ?? '' }}</p>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title">Website Perusahaan</h3>
                            <p class="card-text">{{ $company->company_website ?? '' }}</p>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title">Tentang Perusahaan</h3>
                            <p class="card-text">{{ $company->company_description ?? '' }}</p>
                        </div>
                    </div>
                    @if ($company && $company->company_logo)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h3 class="card-title">Logo Perusahaan</h3>
                                <img src="{{ asset('storage/' . $company->company_logo) }}" alt="Logo Perusahaan" class="img-fluid" style="max-height: 150px;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customjs')
    <script>
        // Tambahkan kode JavaScript khusus jika diperlukan
    </script>
@endsection
