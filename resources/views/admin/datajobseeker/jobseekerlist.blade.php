@extends('admin.layouts.app')

@section('main')
    <div class="card">
        <div class="card-header">
            <h4>Daftar Jobseeker</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-outline">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Foto Profile</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>No.Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobseekers as $jobseeker)
                            <tr>
                                <td><span class="text-secondary">{{ $loop->iteration }}</span></td>
                                <td>
                                    <div class="d-flex py-1 align-items-center">
                                        <span class="avatar me-2" style="background-image: url('{{ asset('storage/profile_pictures/' . $jobseeker->profile_picture) }}')"></span>
                                    </div>
                                </td>
                                <td>{{ $jobseeker->job_seeker_name }}</td>
                                <td>{{ $jobseeker->user->email }}</td>
                                <td>{{ $jobseeker->job_seeker_address }}</td>
                                <td>{{ $jobseeker->job_seeker_phone }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#jobseekerModal_{{ $jobseeker->id }}">Detail</button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="jobseekerModal_{{ $jobseeker->id }}" tabindex="-1" role="dialog" aria-labelledby="jobseekerModalLabel_{{ $jobseeker->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="jobseekerModalLabel_{{ $jobseeker->id }}">Detail Jobseeker</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @include('admin.datajobseeker.partials.jobseekerdetails', ['jobseeker' => $jobseeker])
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $jobseekers->links() }}
            </div>
        </div>
    </div>
@endsection


@push('scripts')
<script>
    $(document).ready(function(){
        $('body').on('click', '.btn-primary', function(event) {
            event.preventDefault();
            var jobseekerId = $(this).data('id');
            var modalSelector = "#jobseekerModal_" + jobseekerId;
            var modal = $(modalSelector);
            modal.find('.modal-body').html('Loading...');
            $.ajax({
                url: "{{ route('admin.jobseekers.details', ':id') }}".replace(':id', jobseekerId),
                method: 'GET',
                success: function(response) {
                    modal.find('.modal-body').html(response.html);
                },
                error: function() {
                    modal.find('.modal-body').html('Error loading details.');
                }
            });
        });
    });
</script>
@endpush
