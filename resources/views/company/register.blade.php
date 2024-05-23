@extends('layouts.app')

@section('main')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Company Registration</h2>
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
                            <form action="{{ route('company.register.submit') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">
                                        Company Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Company Name" required autofocus>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        Email address <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email address" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        Password <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        Confirm Password <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Register</button>
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
        // Set focus to the Company Name input field
        document.getElementsByName("name")[0].focus();
    </script>
@endsection
