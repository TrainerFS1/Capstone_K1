@extends('admin.layouts.app')

@section('main')
<div class="container-xl">
<div class="row g-2 align-items-center">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Daftar Jobseeker</h2>
            <form class="d-flex" action="{{ route('admin.jobseekers.index') }}" method="GET">
                <input class="form-control me-2" type="search" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama atau email">
                <button class="btn btn-outline-primary" type="submit">Cari</button>
            </form>
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
                        @forelse ($jobseekers as $jobseeker)
                            <tr>
                                <td><span class="text-secondary">{{ $loop->iteration + ($jobseekers->currentPage() - 1) * $jobseekers->perPage() }}</span></td>
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
                        @empty
                            <tr>
                                <td colspan="7">Tidak ada jobseeker ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">
                    Menampilkan<span>{{ $jobseekers->firstItem() }}</span> hingga <span>{{ $jobseekers->lastItem() }}</span> dari <span>{{ $jobseekers->total() }}</span> baris
                </p>
                <ul class="pagination m-0 ms-auto">
                    <li class="page-item {{ $jobseekers->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $jobseekers->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $jobseekers->onFirstPage() }}">prev</a>
                    </li>
                    @foreach ($jobseekers->getUrlRange(1, $jobseekers->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $jobseekers->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item {{ $jobseekers->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $jobseekers->nextPageUrl() }}" aria-disabled="{{ !$jobseekers->hasMorePages() }}">next</a>
                    </li>
                </ul>
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
