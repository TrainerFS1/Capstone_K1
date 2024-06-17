<div class="card mb-4">
        <div class="card-header">
            <h3>{{ $job->job_title }}</h3>
        </div>
        <div class="card-body">
        <div class="row mb-3">
            <h4 class="mb-1">Perusahaan</h4>
            <p>{{ $job->company->company_name }}</p>
        </div>
        <div class="row mb-3">
            <h4 class="mb-1">Deskripsi:</h4>
            <p>{{ $job->job_description }}</p>
        </div>  
        <div class="row mb-3">
            <h4 class="mb-1">Skill yang dibutuhkan:</h>
            <p>{{ $job->job_skills }}</p>
            </div>  
        <div class="row mb-3">
            <h4 class="mb-1">Lokasi:</h4>
            <p>{{ $job->job_location }}</p>
            </div>  
        <div class="row mb-3">
            <h4 class="mb-1">Jenis Pekerjaan:</h4>
            <p>{{ $job->jobType->job_type_name }}</p>
            </div>  
        <div class="row mb-3">
            <h4 class="mb-1">Kategori:</h4>
            <p>{{ $job->category->category_name }}</p>
        </div>
        </div>
    </div>

<div class="card mb-4">
    <div class="card-header">
        <h3>Status Melamar</h3>
    </div>
    <div class="card-body">
        <p>Terkirim pada: {{ $appliedJob->created_at->format('d M Y') }}</p>
        <p>Status: 
            @switch($appliedJob->status)
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
        </p>
    </div>
</div>
