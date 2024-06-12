@extends('layouts.app')

@section('main')
    <section class="section-4 bg-2">
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col">
                    <h2>Pekerjaan yang Disimpan</h2>
                </div>
            </div>
        </div>

        <div class="container-xl">
            <div class="row">
                @foreach ($savedJobs as $savedJob)
                    @if (!empty($savedJob->job->company->company_logo))
                        <div class="col-md-6">
                            <div class="card shadow border-0 p-3 mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="company_logo mb-3">
                                                <img src="{{ asset('storage/company_logo/' . $savedJob->job->company->company_logo) }}" class="img-fluid" alt="Company Logo">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <h5 class="card-title">{{ $savedJob->job->job_title }}</h5>
                                            <p class="card-text">{{ Str::limit($savedJob->job->job_description, 150) }}</p>
                                            <a href="{{ route('jobDetail', $savedJob->job->id) }}" class="btn btn-primary">Lihat Detail</a>
                                            <form action="{{ route('deleteSavedJob', $savedJob->id) }}" method="POST" class="d-inline delete-job-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-delete" data-id="{{ $savedJob->id }}">
                                                    <i class="fa fa-trash"></i>&nbsp; Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('form');
                    const jobId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda tidak akan dapat mengembalikan ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })
                });
            });
        });
    </script>
@endsection
