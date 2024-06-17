@extends('layouts.app')

@section('main')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Registrasi Calon Karyawan</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="row row-cards">
                        <div class="col-12">
                            <form action="{{ route('jobseeker.register.submit') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">
                                        Nama Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama Lengkap" required autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Alamat Email" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        Password <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        Konfirmasi Password <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customjs')
    <script>
        // Set focus to the Full Name input field
        document.getElementsByName("name")[0].focus();
    </script>
@endsection
