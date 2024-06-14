{{-- modal Tambah Lowongan kerja --}}
<div class="modal" id="setNewPassword" tabindex="-1">
  <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Ubah Kata Sandi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="card" method="POST" action="{{ route('company.setNewPassword') }}" onsubmit="return validatePassword()">
              @csrf
              <div class="card-body row">
                <div class="col-12 mb-3">
                    <label class="form-label required">Kata Sandi Saat Ini</label>
                    <div class="input-group">
                        <input type="password" name="password" id="old-password" class="form-control" placeholder="" autofocus required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('old-password', this)">
                            Show
                        </button>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label required">Kata Sandi Baru</label>
                    <div class="input-group">
                        <input type="password" name="new_password" id="new-password" class="form-control" placeholder="" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('new-password', this)">
                            Show
                        </button>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label required">Konfirmasi Kata Sandi Baru</label>
                    <div class="input-group">
                        <input type="password" name="new_password_confirmation" id="confirm-new-password" class="form-control" placeholder="" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('confirm-new-password', this)">
                            Show
                        </button>
                    </div>
                </div>
              </div>
              <div class="card-footer text-end">
                  <button type="submit" class="btn btn-primary">Ubah</button>
              </div>
          </form>
      </div>
  </div>
</div>
