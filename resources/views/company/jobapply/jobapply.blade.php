@extends('company.layouts.app')
@section('main')
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Lamaran Masuk
            </h2>
          </div>
          <!-- Page title actions -->
          <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <a href="{{ route('company.showaddjob') }}" class="btn btn-primary d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Tambah Lowongan Kerja
              </a>
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
                <div class="accordion-item">
                  <div class="accordion-header" role="tab">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-1-{{ $loop->iteration }}">{{ $job->job_title }}</button>
                  </div>
                  <div id="faq-1-{{ $loop->iteration }}" class="accordion-collapse collapse" role="tabpanel" data-bs-parent="#faq-{{ $loop->iteration }}">
                    <div class="accordion-body pt-0">
                      <div>
                        @if ($job->applyJobs->isEmpty())
                          <p>No applications found for this job.</p>
                          @else
                          <div class="row row-cards">
                        @foreach ($job->applyJobs as $applyJob)
                              <div class="col-md-6 col-lg-3">
                                <div class="card col-12">
                                  <div class="card-body p-4 text-center">
                                    <span class="avatar avatar-xl mb-3 rounded" style="background-image: url('{{ asset('storage/profile_pictures/' . $applyJob->jobSeeker->profile_picture) }}')"></span>
                                    <h3 class="m-0 mb-1"><a href="#">{{ $applyJob->jobSeeker->job_seeker_name }}</a></h3>
                                    <div class="text-secondary">Phone: {{ $applyJob->jobSeeker->job_seeker_phone }}</div>
                                    {{-- <div class="mt-3">
                                      <span class="badge bg-purple-lt">{{ $applyJob->jobSeeker->user->user_type  == 'job_seeker' ? 'Job Seeker' : ''}}</span>
                                    </div> --}}
                                    <div class="mt-3">
                                    <span class="badge bg-purple-lt"><a href="{{ route('company.jobseeker.detail', $applyJob->jobSeeker->id) }}">Detail</a></span>
                                    </div>
                                  </div>
                                  @if ($applyJob->status == 'inprogress')
                                    <div class="d-flex" id="apply-job-{{ $applyJob->id }}">
                                      <button class="btn btn-danger btn-square col-6 btn-reject"  data-id="{{ $applyJob->id }}">
                                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-ban"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M5.7 5.7l12.6 12.6" /></svg>
                                        Reject</button>
                                      <button class="btn btn-success btn-square col-6 btn-accept"  data-id="{{ $applyJob->id }}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
                                        Accept</button>
                                    </div>
                                  @elseif($applyJob->status == 'rejected')
                                  <div class="" >
                                    <button class="btn btn-danger btn-square col-12" data-id="{{ $applyJob->id }}" disabled>
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-ban"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M5.7 5.7l12.6 12.6" /></svg>
                                      Rejected</button>
                                  </div>
                                  @elseif($applyJob->status == 'accepted')
                                  <div class="">
                                    <button class="btn btn-success btn-square col-12" data-id="{{ $applyJob->id }}" disabled>
                                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
                                      Accepted</button>
                                  </div>
                                  @endif
                                  <div class="d-none" id="rejected-job-{{ $applyJob->id }}">
                                    <button class="btn btn-danger btn-square col-12" data-id="{{ $applyJob->id }}" disabled>
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-ban"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M5.7 5.7l12.6 12.6" /></svg>
                                      Rejected</button>
                                  </div>
                                  <div class="d-none" id="accepted-job-{{ $applyJob->id }}">
                                    <button class="btn btn-success btn-square col-12" data-id="{{ $applyJob->id }}" disabled>
                                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
                                      Accepted</button>
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
@endsection
@section('customjs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-reject').on('click', function() {
            var applyJobId = $(this).data('id');
            var url = '{{ route("company.lamaranmasuk.reject", ":id") }}';
            url = url.replace(':id', applyJobId);

            if (confirm('Are you sure you want to reject this application?')) {
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
                        alert('Error rejecting application');
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

            if (confirm('Are you sure you want to reject this application?')) {
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
                        alert('Error accepting application');
                    }
                });
            }
        });
    });
</script>
@endsection
