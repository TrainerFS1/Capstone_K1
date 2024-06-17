@extends('layouts.app')

@section('main')
<div class="container container-xl">
<div class="col-12 col-xl-8 mt-4">
    <h2>Riwayat Lamaran</h2>
</div>
    @if($appliedJobs->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Lowongan</th>
                    <th>Perusahaan</th>
                    <th>Tanggal Melamar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appliedJobs as $appliedJob)
                    <tr>
                        <td><span class="text-secondary">{{ $loop->iteration }}</span></td>
                        <td>{{ optional($appliedJob->job)->job_title }}</td>
                        <td>{{ optional(optional($appliedJob->job)->company)->company_name }}</td>
                        <td>{{ $appliedJob->created_at->format('d M Y') }}</td>
                        <td>
                            @php
                                $status = strtolower(trim($appliedJob->status));
                            @endphp
                            @switch($status)
                                @case('rejected')
                                    <span class="badge rounded-pill text-bg-danger">Ditolak</span>
                                    @break
                                @case('inprogress')
                                    <span class="badge rounded-pill text-bg-info">Dalam Proses</span>
                                    @break
                                @case('accepted')
                                    <span class="badge rounded-pill text-bg-success">Diterima</span>
                                    @break
                                @default
                                    <span class="badge badge-secondary">{{ $appliedJob->status }}</span>
                            @endswitch
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jobDetailModal" data-job-id="{{ $appliedJob->job->id }}">Detail</button>
                            @include('jobseeker.jobs.modalhistory')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $appliedJobs->links() }}
    @else
    <p>Anda belum melamar apapun.</p>
    @endif
</div>



@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var jobDetailModal = document.getElementById('jobDetailModal');

    jobDetailModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var jobId = button.getAttribute('data-job-id');

        var modalBody = jobDetailModal.querySelector('.modal-body');
        modalBody.innerHTML = 'Loading...';

        fetch(`/jobs/${jobId}`)
            .then(response => response.text())
            .then(data => {
                modalBody.innerHTML = data;
            })
            .catch(error => {
                modalBody.innerHTML = 'Error loading job details';
            });
    });
});
</script>
@endpush
