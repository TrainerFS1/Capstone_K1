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
                                @case('accept')
                                    <span class="badge rounded-pill text-bg-success">{{ $appliedJob->status }}</span>
                                    @break
                                @default
                                    <span class="badge badge-secondary">{{ $appliedJob->status }}</span>
                            @endswitch
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary">View Job</a>
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
@endsection
