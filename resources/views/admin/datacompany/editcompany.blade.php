@extends('admin.layouts.app')
@section('main')
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Edit Company
            </h2>
          </div>
          <!-- Page title actions -->
        </div>
      </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="col-md-12">
            @include('admin.layouts.message')
            <form class="card" method="post" action="{{ route('admin.editcompany', $company->id)}}">
              @csrf
              <div class="card-body row">
                  <div class="col-12 mb-3">
                      <label class="form-label required">Nama Company</label>
                      <input type="text" name="company_name" class="form-control" placeholder="Fullstack Laravel Developer" value="{{ $company->company_name }}" autofocus required>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3 row">
                      <label class="col-md-3 col-sm-12 col-form-label required">Industry</label>
                      <div class="col-md-9 col-sm-12">
                          <select name="industry_id" class="form-select" required>
                              @foreach($industries as $industry)
                                  <option value="{{ $industry->id }}" {{ $industry->id == $company->industry_id ? 'selected' : '' }}>
                                      {{ $industry->industry_name }}
                                  </option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3 row">
                      <label class="col-md-3 col-form-label required">Website</label>
                      <div class="col-md-9 col-sm-12">
                          <input type="text" name="company_website" class="form-control" placeholder="https://example.com" value="{{ $company->company_website }}" required>
                      </div>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3">
                      <label class="form-label required">Alamat Company</label>
                      <input type="text" name="company_address" class="form-control" placeholder="Lamongan" value="{{ $company->company_address }}" required>
                  </div>
                  <div class="col-12 mb-3">
                      <label class="form-label required">Company Phone</label>
                      <input type="text" name="company_phone" class="form-control" placeholder="+628123456789" value="{{ $company->company_phone }}" required>
                  </div>
                  <div class="col-12 mb-3">
                      <label class="form-label required">Company Description</label>
                      <textarea name="company_description" class="form-control" rows="5" required>{{ $company->company_description }}</textarea>
                  </div>
              </div>
              <div class="card-footer text-end">
                  <a href="{{ route('admin.companylist') }}" class="btn btn-primary">Back</a>
                  <button type="submit" class="btn btn-success">Save</button>
              </div>
          </form>          
          </div>
        </div>
      </div>
    </div>
@endsection
@section('customjs')
    <script>

    </script>
@endsection
