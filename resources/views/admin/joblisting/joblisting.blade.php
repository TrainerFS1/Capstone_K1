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
                                    <th>ID</th>
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
                                    <td>{{ $job->id }}</td>
                                    <td>{{ $job->job_title }}</td>
                                    <td>{{ $job->company->company_name }}</td>
                                    <td>{{ $job->category->category_name }}</td>
                                    <td>{{ $job->job_status }}</td>
                                    <td>
                                        <a href="{{ route('admin.jobedit', ['id' => $job->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.deletejob', ['id' => $job->id]) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
