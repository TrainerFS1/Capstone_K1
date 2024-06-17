{{-- modal Tambah Lowongan kerja --}}
<div class="modal" id="exampleModal" tabindex="-1">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Tambah Lowongan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="card" method="POST" action="{{ route('company.addjob') }}">
              @csrf
              <div class="card-body row">
                  <div class="col-12 mb-3">
                      <label class="form-label required">Nama Lowongan</label>
                      <input type="text" name="job_title" class="form-control" placeholder="Fullstack Laravel Developer" autofocus required>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3">
                      <label class="form-label required">Kategori Lowongan</label>
                      <select name="category_id" class="form-select" required>
                          @foreach($jobCategories as $category)
                          <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3">
                      <label class="form-label required">Tipe Pekerjaan</label>
                      <select name="job_type_id" class="form-select" required>
                          @foreach($jobTypes as $type)
                          <option value="{{ $type->id }}">{{ $type->job_type_name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3">
                      <label class="form-label required">Lokasi Kerja</label>
                      <input type="text" name="job_location" class="form-control" placeholder="Lamongan" required>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3">
                      <label class="form-label required">Gaji</label>
                      <input type="text" name="job_salary" class="form-control" placeholder="4.000.000 - 5.000.000" required>
                  </div>
                  <div class="col-12 mb-3">
                      <label class="form-label required">Skill Yang dibutuhkan</label>
                      <input type="text" name="job_skills" class="form-control" placeholder="HTML,CSS,PHP,Laravel" required>
                  </div>
                  <div class="col-12 mb-3">
                      <label class="form-label required">Deskripsi Pekerjaan</label>
                      <textarea name="job_description" class="form-control" rows="5" required></textarea>
                  </div>
              </div>
              <div class="card-footer text-end">
                  <button type="submit" class="btn btn-primary">Buat Lowongan</button>
              </div>
          </form>
      </div>
  </div>
</div>
@include('sweetalert::alert')