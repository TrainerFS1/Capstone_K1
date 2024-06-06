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
                                    <a href="{{ route('admin.jobseekers.show', $jobseeker->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                </td>
                            </tr>
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
