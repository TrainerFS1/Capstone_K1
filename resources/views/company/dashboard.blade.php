@extends('company.layouts.app') @section('main')

<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                
                <h2 class="page-title">Dashboard</h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <button type="button" class="btn btn-primary d-none d-sm-none d-md-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="row row-cards">
                  <div class="col-sm-6 col-lg-3">
                      <div class="card card-sm">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-auto">
                                      <span
                                          class="bg-indigo text-white avatar"
                                          ><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                          <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              width="24"
                                              height="24"
                                              viewBox="0 0 24 24"
                                              fill="none"
                                              stroke="currentColor"
                                              stroke-width="2"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-building-factory-2"
                                          >
                                              <path
                                                  stroke="none"
                                                  d="M0 0h24v24H0z"
                                                  fill="none"
                                              />
                                              <path d="M3 21h18" />
                                              <path
                                                  d="M5 21v-12l5 4v-4l5 4h4"
                                              />
                                              <path
                                                  d="M19 21v-8l-1.436 -9.574a.5 .5 0 0 0 -.495 -.426h-1.145a.5 .5 0 0 0 -.494 .418l-1.43 8.582"
                                              />
                                              <path d="M9 17h1" />
                                              <path d="M14 17h1" />
                                          </svg>
                                      </span>
                                  </div>
                                  <div class="col">
                                      <div class="font-weight-medium">
                                          {{ $company->jobs->count() }}
                                          Lowongan
                                      </div>
                                      <div class="text-secondary">
                                          Lowongan Di Terbitkan
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-success text-white avatar"
                                        ><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              width="24"
                                              height="24"
                                              viewBox="0 0 24 24"
                                              fill="none"
                                              stroke="currentColor"
                                              stroke-width="2"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-building-factory-2"
                                          >
                                              <path
                                                  stroke="none"
                                                  d="M0 0h24v24H0z"
                                                  fill="none"
                                              />
                                              <path d="M3 21h18" />
                                              <path
                                                  d="M5 21v-12l5 4v-4l5 4h4"
                                              />
                                              <path
                                                  d="M19 21v-8l-1.436 -9.574a.5 .5 0 0 0 -.495 -.426h-1.145a.5 .5 0 0 0 -.494 .418l-1.43 8.582"
                                              />
                                              <path d="M9 17h1" />
                                              <path d="M14 17h1" />
                                          </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $activeJobs }} Aktif
                                    </div>
                                    <div class="text-secondary">
                                        Lowongan Aktif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-danger text-white avatar"
                                        ><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              width="24"
                                              height="24"
                                              viewBox="0 0 24 24"
                                              fill="none"
                                              stroke="currentColor"
                                              stroke-width="2"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-building-factory-2"
                                          >
                                              <path
                                                  stroke="none"
                                                  d="M0 0h24v24H0z"
                                                  fill="none"
                                              />
                                              <path d="M3 21h18" />
                                              <path
                                                  d="M5 21v-12l5 4v-4l5 4h4"
                                              />
                                              <path
                                                  d="M19 21v-8l-1.436 -9.574a.5 .5 0 0 0 -.495 -.426h-1.145a.5 .5 0 0 0 -.494 .418l-1.43 8.582"
                                              />
                                              <path d="M9 17h1" />
                                              <path d="M14 17h1" />
                                          </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $inactiveJobs }} Tidak Aktif
                                    </div>
                                    <div class="text-secondary">
                                        Lowongan Tidak Aktif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                      <div class="card card-sm">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-auto">
                                      <span
                                          class="bg-cyan text-white avatar"
                                          ><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                          <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              width="24"
                                              height="24"
                                              viewBox="0 0 24 24"
                                              fill="none"
                                              stroke="currentColor"
                                              stroke-width="2"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-file-analytics"
                                          >
                                              <path
                                                  stroke="none"
                                                  d="M0 0h24v24H0z"
                                                  fill="none"
                                              />
                                              <path
                                                  d="M14 3v4a1 1 0 0 0 1 1h4"
                                              />
                                              <path
                                                  d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"
                                              />
                                              <path d="M9 17l0 -5" />
                                              <path d="M12 17l0 -1" />
                                              <path d="M15 17l0 -3" />
                                          </svg>
                                      </span>
                                  </div>
                                  <div class="col">
                                      <div class="font-weight-medium">
                                          {{ $totalApplyJobs }} Masuk
                                      </div>
                                      <div class="text-secondary">
                                          Lamaran Masuk
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
            <div class="col-12">
              <div class="row row-cards">
                <div class="col-md-12 col-lg-9">
                  <div class="card">
                    <div class="card-body">
                      <div id="chart-demo-line" class="chart-lg"></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 col-lg-3">
                  <div class="col-sm-12 col-lg-12">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span
                                        class="bg-orange text-white avatar"
                                        ><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-info"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M11 14h1v4h1" /><path d="M12 11h.01" /></svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $inprogressApplyJobs }} Dalam Proses
                                    </div>
                                    <div class="text-secondary">
                                        Belum Di Proses
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-sm-12 col-lg-12 pt-2">
                      <div class="card card-sm">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-auto">
                                      <span
                                          class="bg-success text-white avatar"
                                          ><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                          <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              width="24"
                                              height="24"
                                              viewBox="0 0 24 24"
                                              fill="none"
                                              stroke="currentColor"
                                              stroke-width="2"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-checklist"
                                          >
                                              <path
                                                  stroke="none"
                                                  d="M0 0h24v24H0z"
                                                  fill="none"
                                              />
                                              <path
                                                  d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8"
                                              />
                                              <path d="M14 19l2 2l4 -4" />
                                              <path d="M9 8h4" />
                                              <path d="M9 12h2" />
                                          </svg>
                                      </span>
                                  </div>
                                  <div class="col">
                                      <div class="font-weight-medium">
                                          {{ $acceptedApplyJobs }} Diterima
                                      </div>
                                      <div class="text-secondary">
                                          Lamaran Diterima
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-12 col-lg-12 pt-2">
                      <div class="card card-sm">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-auto">
                                      <span
                                          class="bg-danger text-white avatar"
                                          ><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                          <svg
                                              xmlns="http://www.w3.org/2000/svg"
                                              width="24"
                                              height="24"
                                              viewBox="0 0 24 24"
                                              fill="none"
                                              stroke="currentColor"
                                              stroke-width="2"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"
                                              class="icon icon-tabler icons-tabler-outline icon-tabler-file-broken"
                                          >
                                              <path
                                                  stroke="none"
                                                  d="M0 0h24v24H0z"
                                                  fill="none"
                                              />
                                              <path
                                                  d="M14 3v4a1 1 0 0 0 1 1h4"
                                              />
                                              <path
                                                  d="M5 7v-2a2 2 0 0 1 2 -2h7l5 5v2"
                                              />
                                              <path
                                                  d="M19 19a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2"
                                              />
                                              <path d="M5 16h.01" />
                                              <path d="M5 13h.01" />
                                              <path d="M5 10h.01" />
                                              <path d="M19 13h.01" />
                                              <path d="M19 16h.01" />
                                          </svg>
                                      </span>
                                  </div>
                                  <div class="col">
                                      <div class="font-weight-medium">
                                          {{ $rejectedApplyJobs }} Ditolak
                                      </div>
                                      <div class="text-secondary">
                                          Lamaran Di Tolak
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="pt-4">
          <div class="card">
              <h3 class="p-3 pb-0">Update Lamaran Masuk</h3>
                <div class="table-responsive">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Foto</th>
                                <th>Nama Kandidat</th>
                                <th>Nama Lowongan</th>
                                <th>Status</th>
                                <th>Tanggal Melamar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentApplyJobs as $applyJob)
                            <tr>
                              <td><span class="text-secondary">{{ $loop->iteration }}</span></td>
                                <td>
                                  @if ($applyJob->JobSeeker->profile_picture)
                                    <img
                                        src="{{ asset('storage/profile_pictures/' . $applyJob->JobSeeker->profile_picture) }}"
                                        alt="Profile Picture"
                                        width="50"
                                        height="50"
                                        class="rounded"
                                    />
                                  @elseif (!$applyJob->JobSeeker->profile_picture)
                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="50"  height="50"  viewBox="0 0 20 20"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                  @endif
                                </td>
                                <td>
                                    {{ $applyJob->JobSeeker->job_seeker_name }}
                                </td>
                                <td class="text-secondary">
                                    {{ $applyJob->job->job_title }}
                                </td>
                                <td class="text-secondary">
                                    {{ ucfirst($applyJob->status) }}
                                </td>
                                <td class="text-secondary">
                                    {{ $applyJob->created_at->format('d M Y') }}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-orange" data-bs-toggle="modal" data-bs-target="#detailModal" data-job-id="{{ $applyJob->job->id }}" data-seeker-id="{{ $applyJob->jobSeeker->id }}">
                                        Detail
                                      </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('company.layouts.modaladdjob')
@include('company.layouts.modaldetailjobseeker')
@endsection @section('customjs')
<script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/libs/apexcharts/dist/apexcharts.min.js" defer></script> --}}
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Fetch data from the server
    $.ajax({
      url: '/api/apply-job-data', // URL endpoint yang sesuai
      method: 'GET',
      success: function(response) {
        // Extract data
        const dates = response.dates;
        const applyJobData = response.apply_job_data;

        // Create chart
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-demo-line'), {
          chart: {
            type: "line",
            fontFamily: 'inherit',
            height: 240,
            parentHeightOffset: 0,
            toolbar: {
              show: false,
            },
            animations: {
              enabled: false
            },
          },
          fill: {
            opacity: 1,
          },
          stroke: {
            width: 2,
            lineCap: "round",
            curve: "straight",
          },
          series: [{
            name: "Apply Job",
            data: applyJobData
          }],
          tooltip: {
            theme: 'dark'
          },
          grid: {
            padding: {
              top: -20,
              right: 0,
              left: -4,
              bottom: -4
            },
            strokeDashArray: 4,
          },
          xaxis: {
            labels: {
              padding: 0,
            },
            tooltip: {
              enabled: false
            },
            type: 'datetime',
          },
          yaxis: {
            labels: {
              padding: 4
            },
          },
          labels: dates,
          colors: [tabler.getColor("primary")],
          legend: {
            show: true,
            position: 'bottom',
            offsetY: 12,
            markers: {
              width: 10,
              height: 10,
              radius: 100,
            },
            itemMargin: {
              horizontal: 8,
              vertical: 8
            },
          },
        })).render();
      },
      error: function(error) {
        console.error('Error fetching data', error);
      }
    });
  });


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
</script>
@endsection
