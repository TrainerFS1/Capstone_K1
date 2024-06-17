@extends('admin.layouts.app')

@section('main')
<div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>Daftar Lowongan</h2>
                <form class="d-flex" action="{{ route('admin.joblisting') }}" method="GET">
                    <input class="form-control me-2" type="search" name="search" value="{{ $search ?? '' }}" placeholder="Cari pekerjaan atau perusahaan">
                    <button class="btn btn-outline-primary" type="submit">Cari</button>
                </form>
            </div>
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
                        @forelse($jobs as $job)
                        <tr>
                            <td><span class="text-secondary">{{ $loop->iteration + ($jobs->currentPage() - 1) * $jobs->perPage() }}</span></td>
                            <td>{{ $job->job_title }}</td>
                            <td>{{ $job->company->company_name }}</td>
                            <td>{{ $job->category->category_name }}</td>
                            <td>
                                <span class="badge rounded-pill text-bg-{{ $job->job_status == 'active' ? 'success' : 'danger' }}">
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
                        @empty
                        <tr>
                            <td colspan="6">Tidak ada pekerjaan ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-secondary">
                        Menampilkan <span>{{ $jobs->firstItem() }}</span> hingga <span>{{ $jobs->lastItem() }}</span> dari <span>{{ $jobs->total() }}</span> baris
                    </p>
                    <ul class="pagination m-0 ms-auto">
                        <li class="page-item {{ $jobs->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $jobs->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $jobs->onFirstPage() }}">prev</a>
                        </li>
                        @foreach ($jobs->getUrlRange(1, $jobs->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $jobs->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                        <li class="page-item {{ $jobs->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $jobs->nextPageUrl() }}" aria-disabled="{{ !$jobs->hasMorePages() }}">next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
