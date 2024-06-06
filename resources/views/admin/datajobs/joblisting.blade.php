@extends('admin.layouts.app')

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Daftar Pekerjaan</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Perusahaan</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)
                                <tr>
                                    <td><span class="text-secondary">{{ $loop->iteration }}</span></td>
                                    <td>{{ $job->job_title }}</td>
                                    <td>{{ $job->company->company_name }}</td>
                                    <td>{{ $job->category->category_name }}</td>
                                    <td>
                                        <span class="badge badge-{{ $job->job_status == 'active' ? 'success' : 'danger' }}">
                                            {{ $job->job_status }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.updatestatus', ['id' => $job->id]) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="job_status" value="{{ $job->job_status === 'active' ? 'inactive' : 'active' }}">
                                            <button type="submit" class="btn btn-sm btn-{{ $job->job_status === 'active' ? 'warning' : 'success' }}">
                                                {{ $job->job_status === 'active' ? 'Inactive' : 'Active' }}
                                            </button> /
                                        </form>
                                        
                                        <a href="{{ route('admin.jobdetail', ['id' => $job->id]) }}" class="btn btn-sm btn-info">Detail</a> /
                                        
                                        <form action="{{ route('admin.deletejob', ['id' => $job->id]) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pekerjaan ini?')">Hapus</button>
                                        </form>
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
@endsection
