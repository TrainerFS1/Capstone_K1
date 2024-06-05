@extends('company.layouts.app') @section('main')
<!-- Page header -->
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          Account Settings
        </h2>
      </div>
    </div>
  </div>
</div>
<!-- Page body -->
<div class="page-body">
  <div class="container-xl">
    <div class="card">
      <div class="row g-0">
        <div class="col-12 col-md-12 d-flex flex-column">
          <form action="{{ route('company.updateprofile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <h2 class="mb-4">My Account</h2>
              <h3 class="card-title">Profile Details</h3>
              <div class="row align-items-center">
                <div class="col-auto">
                  <img class="avatar avatar-xl" id="company-logo-preview" 
                    src="{{ $company->company_logo ? asset('storage/company_logo/' . $company->company_logo) : '' }}" >
                </div>
                <div class="col-auto">
                    <input type="file" name="company_logo" id="company-logo-input" class="btn">
                </div>
                <div class="col-auto">
                    <a href="#" class="btn btn-outline-danger" onclick="document.getElementById('delete-company-logo').submit();">Delete company logo</a>
                </div>
              </div>
              <h3 class="card-title mt-4">Company Profile</h3>
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-label">Company Name</div>
                  <input type="text" name="company_name" class="form-control" value="{{ $company->company_name }}">
                </div>
                <div class="col-md-6">
                  <div class="form-label">Company Website</div>
                  <input type="text" name="company_website" class="form-control" value="{{ $company->company_website }}">
                </div>
                <div class="col-md-6">
                  <div class="form-label">Location</div>
                  <input type="text" name="company_address" class="form-control" value="{{ $company->company_address }}">
                </div>
                <div class="col-md-6">
                  <div class="form-label">Phone</div>
                  <input type="text" name="company_phone" class="form-control" value="{{ $company->company_phone }}">
                </div>
                <div class="col-md-12">
                  <div class="form-label">Email</div>
                  <input type="email" name="email" class="form-control" value="{{ $user->email}}">
                </div>
                <div class="col-md-12">
                  <div class="form-label">About Company</div>
                  <textarea class="form-control" name="company_description" data-bs-toggle="autosize" placeholder="About Company">{{ $company->company_description}}</textarea>
                </div>
              </div>
              <h3 class="card-title mt-4">Password</h3>
              <p class="card-subtitle">You can set a permanent password if you don't want to use temporary login codes.</p>
              <div>
                <a href="#" class="btn">
                  Set new password
                </a>
              </div>
            </div>
            <div class="card-footer bg-transparent mt-auto">
              <div class="btn-list justify-content-end">
                <a href="#" class="btn">
                  Cancel
                </a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
          <form id="delete-company-logo" action="{{ route('company.deleteLogo') }}" method="POST" style="display: none;">
              @csrf
              @method('DELETE')
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection @section('customjs')
<script>
document.getElementById('company-logo-input').onchange = function (evt) {
    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;

    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
          document.getElementById('company-logo-preview').src = fr.result;
        }
        fr.readAsDataURL(files[0]);
    } else {
        // Reset to the original logo from the database if no file is selected
        document.getElementById('company-logo-preview').src = '{{ asset('storage/company_logo/' . $company->company_logo) }}';
    }
};
</script>
@endsection
