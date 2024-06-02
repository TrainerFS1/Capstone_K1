@extends('company.layouts.app') @section('main')

<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">Overview</div>
                <h2 class="page-title">Dashboard</h2>
            </div>
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
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="row row-cards">
                  <div class="col-sm-6 col-lg-3">
                      <div class="card card-sm">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-auto">
                                      <span
                                          class="bg-primary text-white avatar"
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
                                          class="bg-warning text-white avatar"
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
                                        {{ $activeJobs }} Active
                                    </div>
                                    <div class="text-secondary">
                                        Lowongan Active
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
                                        {{ $inactiveJobs }} Inactive
                                    </div>
                                    <div class="text-secondary">
                                        Lowongan Inactive
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
                                <th>Job Seeker Name</th>
                                <th>Job Title</th>
                                <th>Status</th>
                                <th>Applied At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentApplyJobs as $applyJob)
                            <tr>
                              <td><span class="text-secondary">{{ $loop->iteration }}</span></td>
                                <td>
                                    <img
                                        src="{{ asset('storage/profile_pictures/' . $applyJob->JobSeeker->profile_picture) }}"
                                        alt="Profile Picture"
                                        width="50"
                                        height="50"
                                        class="rounded"
                                    />
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
                                    <a class="btn btn-sm btn-warning" href="#">Detail</a>
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
@endsection @section('customjs')
<script></script>
@endsection
