@extends('company.layouts.app') @section('main')
<!-- Page header -->
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          Pengaturan Akun
        </h2>
      </div>
    </div>
  </div>
</div>
<!-- Page body -->
<div class="page-body">
  <div class="container-xl">
    @include('layouts.message')
    <div class="card">
      <div class="row g-0">
        <div class="col-12 col-md-12 d-flex flex-column">
          <form action="{{ route('company.updateprofile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <h2 class="mb-4">Akun Saya</h2>
              <h3 class="card-title">Detail Profil</h3>
              <div class="row align-items-center">
                <div class="col-auto">
                  <img class="avatar avatar-xl" id="company-logo-preview" 
                    src="{{ $company->company_logo ? asset('storage/company_logo/' . $company->company_logo) : asset('images/default-logo-company.png') }}" >
                </div>
                <div class="col-auto">
                    <input type="file" name="company_logo" id="company-logo-input" class="btn">
                </div>
                <div class="col-auto">
                    <a href="#" class="btn btn-outline-danger" onclick="document.getElementById('delete-company-logo').submit();">Hapus Logo Perusahaan</a>
                </div>
              </div>
              <h3 class="card-title mt-4">Profil Perusahaan</h3>
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-label required">Nama Perusahaan</div>
                  <input type="text" name="company_name" class="form-control" value="{{ $company->company_name }}">
                </div>
                <div class="col-md-6">
                  <label class="form-label required">
                    Industri
                  </label>
                  <select name="industry_id" class="form-select @error('industry_id') is-invalid @enderror">
                    <option value="">Pilih Industri</option>
                      @foreach($industries as $industry)
                      <option value="{{ $industry->id }}" {{ $company->industry_id == $industry->id ? 'selected' : '' }}>
                        {{ $industry->industry_name }}
                      </option>
                      @endforeach
                  </select>
                  @error('industry_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <div class="form-label">Website Perusahaan</div>
                  <input type="text" name="company_website" class="form-control" value="{{ $company->company_website }}">
                </div>
                <div class="col-md-6">
                  <div class="form-label">Lokasi</div>
                  <input type="text" name="company_address" class="form-control" value="{{ $company->company_address }}">
                </div>
                <div class="col-md-6">
                  <div class="form-label">Telepon</div>
                  <input type="text" name="company_phone" class="form-control" value="{{ $company->company_phone }}">
                </div>
                <div class="col-md-12">
                  <div class="form-label required">Email</div>
                  <input type="email" name="email" class="form-control" value="{{ $user->email}}">
                </div>
                <div class="col-md-12">
                  <div class="form-label">Tentang Perusahaan</div>
                  <textarea class="form-control" name="company_description" data-bs-toggle="autosize" placeholder="Isian tentang perusahaan">{{ $company->company_description}}</textarea>
                </div>
              </div>
              <h3 class="card-title mt-4">Kata Sandi</h3>
              <div>
                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#setNewPassword" data-id="{{ $company->id }}">
                  Atur Kata Sandi Baru
                </button>
              </div>
            </div>
            <div class="card-footer bg-transparent mt-auto">
              <div class="btn-list justify-content-end">
                <a href="{{ route('company.dashboard') }}" class="btn">
                  Batal
                </a>
                <button type="submit" class="btn btn-primary">Simpan</button>
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
@include('company.layouts.modalSetPassword')
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

// show hide password
function togglePasswordVisibility(inputId, button) {
    var input = document.getElementById(inputId);
    if (input.type === "password") {
        input.type = "text";
        button.innerText = "Hide";
    } else {
        input.type = "password";
        button.innerText = "Show";
    }
}

// cek confirm password
function validatePassword() {
        var newPassword = document.getElementById("new-password").value;
        var confirmPassword = document.getElementById("confirm-new-password").value;

        if (newPassword !== confirmPassword) {
            alert("New password and confirm password do not match.");
            return false;
        }
        return true;
    }
</script>
@include('sweetalert::alert')
@endsection
