@extends('company.layouts.app')
@section('main')
    <!-- Page header -->
    <div class="page-header d-print-none">

      <div class="container-xl">
      <div class="col mb-2">
            <h2 class="page-title">
              Lamaran Masuk
            </h2>
          </div>
        <div class="row g-2 align-items-center">

          <!-- Page title actions -->
          <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="icon"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                </svg>
                Tambah Lowongan Kerja
            </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="col-lg-12">
              <div id="faq-1" class="accordion" role="tablist" aria-multiselectable="true">
                @foreach ($company->jobs as $job)
                <div class="accordion-item ">
                  <div class="bg-success accordion-header rounded" role="tab">
                    <button class="accordion-button collapsed  dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#faq-1-{{ $loop->iteration }}">{{ $job->job_title }}</button>
                  </div>
                  <div id="faq-1-{{ $loop->iteration }}" class="accordion-collapse collapse" role="tabpanel" data-bs-parent="#faq-{{ $loop->iteration }}">
                    <div class="accordion-body pt-0">
                      <div>
                        @if ($job->applyJobs->isEmpty())
                          <p>Belum ada yang melamar pekerjaan ini.</p>
                          @else
                          <div class="row row-cards pt-4">
                        @foreach ($job->applyJobs as $applyJob)
                              <div class="col-md-6 col-lg-3">
                                <div class="card col-12">
                                  <div class="card-body p-4 text-center">
                                    <span class="avatar avatar-xl mb-3 rounded" style="background-image: url('{{ asset('storage/profile_pictures/' . $applyJob->jobSeeker->profile_picture) }}')"></span>
                                    <h3 class="m-0 mb-1">{{ $applyJob->jobSeeker->job_seeker_name}} </h3>
                                    <div class="text-secondary">Phone: {{ $applyJob->jobSeeker->job_seeker_phone }}</div>
                                    <div class="mt-3">
                                    <!-- Tombol untuk memunculkan modal -->
                                    {{-- <span class="badge bg-purple-lt"><a href="{{ route('company.lamaranmasuk.detail', $applyJob->jobSeeker->id) }}">Detail</a></span> --}}
                                    <span class="">
                                      <button type="button" class="btn btn-md btn-cyan" data-bs-toggle="modal" data-bs-target="#detailModal" data-job-id="{{ $job->id }}" data-seeker-id="{{ $applyJob->jobSeeker->id }}">
                                        Detail
                                      </button>
                                    </span>
                                    </div>
                                  </div>
                                  @if ($applyJob->status == 'inprogress')
                                    <div class="d-flex" id="apply-job-{{ $applyJob->id }}">
                                      <button class="btn btn-danger btn-square col-6 btn-reject"  data-id="{{ $applyJob->id }}">
                                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-ban"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M5.7 5.7l12.6 12.6" /></svg>
                                        Tolak</button>
                                      <button class="btn btn-success btn-square col-6 btn-accept"  data-id="{{ $applyJob->id }}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
                                        Terima</button>
                                    </div>
                                  @elseif($applyJob->status == 'rejected')
                                  <div class="" >
                                    <button class="btn btn-danger btn-square col-12" data-id="{{ $applyJob->id }}" disabled>
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-ban"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M5.7 5.7l12.6 12.6" /></svg>
                                      Ditolak</button>
                                  </div>
                                  @elseif($applyJob->status == 'accepted')
                                  <div class="">
                                    <button class="btn btn-success btn-square col-12" data-id="{{ $applyJob->id }}" disabled>
                                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
                                      Diterima</button>
                                  </div>
                                  @endif
                                  <div class="d-none" id="rejected-job-{{ $applyJob->id }}">
                                    <button class="btn btn-danger btn-square col-12" data-id="{{ $applyJob->id }}" disabled>
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-ban"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M5.7 5.7l12.6 12.6" /></svg>
                                      Ditolak</button>
                                  </div>
                                  <div class="d-none" id="accepted-job-{{ $applyJob->id }}">
                                    <button class="btn btn-success btn-square col-12" data-id="{{ $applyJob->id }}" disabled>
                                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
                                      Diterima</button>
                                  </div>
                                </div>
                              </div>
                              @endforeach
                            </div>
                            @endif
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
          </div>
        </div>
      </div>
    </div>

@include('company.layouts.modaladdjob')
@include('company.layouts.modaldetailjobseeker')
@endsection
@section('customjs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-reject').on('click', function() {
            var applyJobId = $(this).data('id');
            var url = '{{ route("company.lamaranmasuk.reject", ":id") }}';
            url = url.replace(':id', applyJobId);

            if (confirm('Apakah Anda yakin akan menolak lamaran ini?')) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message);
                        // Optionally remove the rejected application from the DOM
                        $('#apply-job-' + applyJobId).remove();
                        $('#rejected-job-' + applyJobId).removeClass('d-none').show();
                    },
                    error: function(xhr) {
                        alert('Gagal menolak lamaran');
                    }
                });
            }
        });
    });
    $(document).ready(function() {
        $('.btn-accept').on('click', function() {
            var applyJobId = $(this).data('id');
            var url = '{{ route("company.lamaranmasuk.accept", ":id") }}';
            url = url.replace(':id', applyJobId);

            if (confirm('Apakah Anda yakin akan menerima lamaran ini?')) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message);
                        // Optionally remove the rejected application from the DOM
                        $('#apply-job-' + applyJobId).remove();
                        $('#accepted-job-' + applyJobId).removeClass('d-none').show();
                    },
                    error: function(xhr) {
                        alert('Gagal menerima lamaran');
                    }
                });
            }
        });
    });
    // modal detail job
    $(document).ready(function() {
      function showLoadingIndicator() {
        $('.progress').show(); // Reset dan tampilkan indikator kemajuan
      }
      function hideLoadingIndicator() {
        $('.progress').hide();
      }
      function hideText() {
          $('#profile_picture').attr('src', '');
        $('#job_seeker_name').text('');
          $('#job_seeker_address').text('');
          $('#job_seeker_phone').text('');
          $('#job_seeker_resume').text('');
      }

      $('#detailModal').on('show.bs.modal', function (event) {
        hideText();
      showLoadingIndicator();
      var button = $(event.relatedTarget); // Tombol yang memicu modal
      var jobSeekerId = button.data('seeker-id');
      var jobId = button.data('job-id');

      // Lakukan permintaan AJAX untuk mengambil detail job seeker
      $.ajax({
        url: '/company/lamaranmasuk/detail/' + jobSeekerId + '/' + jobId,
        method: 'GET',
        success: function(response) {
          // Asumsi respons adalah objek JSON dengan atribut yang diperlukan
          var profilePictureUrl = "{{ asset('storage/profile_pictures') }}" + '/' + response.profile_picture;
          // var cvUrl = '{{ route('company.lamaranmasuk.cv', ':id') }}'.replace(':id', response.id_file);
          // var certificateUrl = '{{ route('company.lamaranmasuk.certificate', ':id') }}'.replace(':id', response.id_file);
          var cvUrl = '{{ asset('storage/' . ':cv') }}'.replace(':cv', response.job_seeker_cv);
          var certificateUrl = '{{ asset('storage/' . ':certificate') }}'.replace(':certificate', response.job_seeker_certificate);

          $('#profile_picture').attr('src', profilePictureUrl);
          $('#job_seeker_name').text(response.job_seeker_name);
          $('#job_seeker_address').text(response.job_seeker_address);
          $('#job_seeker_phone').text(response.job_seeker_phone);
          $('#job_seeker_resume').text(response.job_seeker_resume);
          $('#job_seeker_cv').attr('href', cvUrl);
          $('#job_seeker_certificate').attr('href', certificateUrl);
          hideLoadingIndicator();
        },
        error: function() {
          $('#profile_picture').attr('src', '');
          $('#job_seeker_name').text('Unable to load details.');
          $('#job_seeker_address').text('Unable to load details.');
          $('#job_seeker_phone').text('Unable to load details.');
          $('#job_seeker_resume').text('Unable to load details.');
        }
      });
    });
  });
</script>

@endsection
