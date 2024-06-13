@extends('company.layouts.app')
@section('main')
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Edit Lowongan Kerja
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
            <form class="card" method="POST" action="{{ route('company.editjob', $job->id) }}">
              @csrf
              <div class="card-body row">
                <div class="col-12 mb-3">
                  <label class="form-label required">Nama Lowongan</label>
                  <input type="text" name="job_title" class="form-control" placeholder="Fullstack Laravel Developer" value="{{ $job->job_title }}" autofocus required>
                </div>
                <div class="col-md-6 col-sm-12 mb-3 row">
                  <label class="col-md-3 col-sm-12 col-form-label required">Kategori Lowongan</label>
                  <div class="col-md-9 col-sm-12">
                    <select name="category_id" class="form-select" required>
                        @foreach($jobCategories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $job->category_id ? 'selected' : '' }}>
                          {{ $category->category_name }}
                      </option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-3 row">
                  <label class="col-md-3 col-form-label required">Tipe Pekerjaan</label>
                  <div class="col-md-9 col-sm-12">
                    <select name="job_type_id" class="form-select" required>
                        @foreach($jobTypes as $type)
                        <option value="{{ $type->id }}" {{ $type->id == $job->job_type_id ? 'selected' : '' }}>
                          {{ $type->job_type_name }}
                      </option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                  <label class="form-label required">Lokasi Kerja</label>
                  <input type="text" name="job_location" class="form-control" placeholder="Lamongan" value="{{ $job->job_location }}" required>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                  <label class="form-label required">Gaji</label>
                  <input type="text" name="job_salary" class="form-control" placeholder="4.000.000 - 5.000.000" value="{{ $job->job_salary }}" required>
                </div>
                <div class="col-12 mb-3">
                  <label class="form-label required">Skill Yang Dibutuhkan</label>
                  <input type="text" name="job_skills" class="form-control" placeholder="HTML,CSS,PHP,Laravel" value="{{ $job->job_skills }}" required>
                </div>
                <div class="col-12 mb-3">
                  <label class="form-label required">Deskripsi Pekerjaan</label>
                  <textarea name="job_description" class="form-control" rows="5" required>{{ $job->job_description }}</textarea>
                </div>
              </div>
              <div class="card-footer text-end">
                <a href="{{ route('company.jobs') }}" class="btn btn-primary">Kembali</a>
                <button type="submit" class="btn btn-success">Simpan</button>
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
