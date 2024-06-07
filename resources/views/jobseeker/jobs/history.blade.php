@extends('layouts.app')

@section('main')
<div class="container container-xl">
<div class="col-12 col-xl-8 mt-4">
    <h2>History Apply Job</h2>
</div>
    @if($appliedJobs->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Applied At</th>
                    <th>Status</th>
                    <th>Action</th>
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
                                    <span class="badge rounded-pill text-bg-danger">{{ $appliedJob->status }}</span>
                                    @break
                                @case('inprogress')
                                    <span class="badge rounded-pill text-bg-info">{{ $appliedJob->status }}</span>
                                    @break
                                @case('accepted')
                                    <span class="badge rounded-pill text-bg-success">{{ $appliedJob->status }}</span>
                                    @break
                                @default
                                    <span class="badge badge-secondary">{{ $appliedJob->status }}</span>
                            @endswitch
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jobDetailModal" data-job-id="{{ $appliedJob->job->id }}">Detail</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $appliedJobs->links() }}
    @else
    <p>No jobs applied yet.</p>
    @endif
</div>

<!-- Modal -->
<div class="modal fade" id="jobDetailModal" tabindex="-1" aria-labelledby="jobDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="jobDetailModalLabel">Job Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Job details will be loaded here via AJAX -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
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
