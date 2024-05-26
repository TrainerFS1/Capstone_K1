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
            <form class="card" method="POST" action="{{ route('company.addjob') }}">
              @csrf
              <div class="card-body row">
                <div class="col-12 mb-3">
                  <label class="form-label required">Job Title</label>
                  <input type="text" name="job_title" class="form-control" placeholder="Fullstack Laravel Developer" autofocus required>
                </div>
                <div class="col-md-6 col-sm-12 mb-3 row">
                  <label class="col-md-3 col-sm-12 col-form-label required">Job Category</label>
                  <div class="col-md-9 col-sm-12">
                    <select name="category_id" class="form-select" required>
                        @foreach($jobCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-3 row">
                  <label class="col-md-3 col-form-label required">Job Type</label>
                  <div class="col-md-9 col-sm-12">
                    <select name="job_type_id" class="form-select" required>
                        @foreach($jobTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->job_type_name }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                  <label class="form-label required">Job Location</label>
                  <input type="text" name="job_location" class="form-control" placeholder="Lamongan" required>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                  <label class="form-label required">Salary Range</label>
                  <input type="text" name="job_salary" class="form-control" placeholder="4.000.000 - 5.000.000" required>
                </div>
                <div class="col-12 mb-3">
                  <label class="form-label required">Job Skills</label>
                  <input type="text" name="job_skills" class="form-control" placeholder="HTML,CSS,PHP,Laravel" required>
                </div>
                <div class="col-12 mb-3">
                  <label class="form-label required">Job Description</label>
                  <textarea name="job_description" class="form-control" rows="5" required></textarea>
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
