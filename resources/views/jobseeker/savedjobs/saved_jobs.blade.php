@extends('layouts.app')

@section('main')
    <section class="section-4 bg-2">
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col">
                    <h2 class="mb-4">Pekerjaan yang Disimpan</h2>
                </div>
            </div>

            <div class="row">
                @foreach ($savedJobs as $savedJob)
                    <div class="col-md-6">
                        <div class="card shadow border-0 p-3 mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="company_logo mb-3">
                                            @if (!empty($savedJob->job->company->company_logo))
                                                <img src="{{ asset('storage/' . $savedJob->job->company->company_logo) }}" class="img-fluid" alt="Company Logo">
                                            @else
                                                <img src="{{ asset('images/default-logo.png') }}" class="img-fluid" alt="Company Logo">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <h5 class="card-title">{{ $savedJob->job->job_title }}</h5>
                                        <p class="card-text">{{ Str::limit($savedJob->job->job_description, 150) }}</p>
                                        <a href="{{ route('showSavedJob', $savedJob->id) }}" class="btn btn-primary">Lihat Detail</a>
                                        <form action="{{ route('deleteSavedJob', $savedJob->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger " onclick="return confirm('Apakah Anda yakin ingin menghapus pekerjaan ini dari simpanan?')">
                                                <i class="fa fa-trash"></i>&nbsp; Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
