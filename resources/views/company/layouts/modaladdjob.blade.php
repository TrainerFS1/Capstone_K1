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
                      <label class="form-label required">Job Title</label>
                      <input type="text" name="job_title" class="form-control" placeholder="Fullstack Laravel Developer" autofocus required>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3">
                      <label class="form-label required">Job Category</label>
                      <select name="category_id" class="form-select" required>
                          @foreach($jobCategories as $category)
                          <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-6 col-sm-12 mb-3">
                      <label class="form-label required">Job Type</label>
                      <select name="job_type_id" class="form-select" required>
                          @foreach($jobTypes as $type)
                          <option value="{{ $type->id }}">{{ $type->job_type_name }}</option>
                          @endforeach
                      </select>
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
