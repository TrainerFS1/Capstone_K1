@extends('company.layouts.app')
@section('main')
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Tambah Lowongan Kerja
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
            <form class="card" method="POST" action="{{ route('company.tambahlowongan') }}">
              @csrf
              <div class="card-body row">
                <div class="col-12 mb-3">
                  <label class="form-label">Job Title</label>
                  <input type="text" name="job_title" class="form-control">
                </div>
                <div class="col-6 mb-3 row">
                  <label class="col-3 col-form-label">Job Category</label>
                  <div class="col">
                    <select name="job_category_id" class="form-select">
                        @foreach($jobCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->job_category_name }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                <div class="col-6 mb-3 row">
                  <label class="col-3 col-form-label">Job Type</label>
                  <div class="col">
                    <select name="job_type_id" class="form-select">
                        @foreach($jobTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->job_type_name }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                <div class="col-12 mb-3">
                  <label class="form-label">Salary Range</label>
                  <input type="text" name="salary_range" class="form-control">
                </div>
                <div class="mb-3">
                  <label class="form-label">Job Benefit</label>
                  <textarea  name="job_benefit" class="form-control"
                  rows="5"></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Job Requirement</label>
                  <textarea name="job_requirement" class="form-control"
                  rows="5"></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Job Description</label>
                  <textarea name="job_description" class="form-control"
                  rows="5"></textarea>
                </div>
              </div>
              <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
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
