<!-- jobseekerdetails.blade.php -->
<span class="avatar avatar-xl mb-3 rounded" style="background-image: url('{{ asset('storage/profile_pictures/' . $jobseeker->profile_picture) }}')"></span>

<div class="form-group">
    <label for="name">Nama:</label>
    <p>{{ $jobseeker->job_seeker_name }}</p>
</div>
<div class="form-group">
    <label for="email">Email:</label>
    <p>{{ $jobseeker->user->email }}</p>
</div>
<div class="form-group">
    <label for="birthdate">Tanggal Lahir:</label>
    <p>{{ $jobseeker->job_seeker_birthdate ?: '-' }}</p>
</div>
<div class="form-group">
    <label for="gender">Jenis Kelamin:</label>
    <p>{{ ucfirst($jobseeker->job_seeker_gender) ?: '-' }}</p>
</div>
<div class="form-group">
    <label for="address">Alamat:</label>
    <p>{{ $jobseeker->job_seeker_address ?: '-' }}</p>
</div>
<div class="form-group">
    <label for="phone">Telepon:</label>
    <p>{{ $jobseeker->job_seeker_phone ?: '-' }}</p>
</div>
<div class="form-group mb-5">
    <label for="resume">Resume:</label>
    <p>{{ $jobseeker->job_seeker_resume ?: '-' }}</p>
</div>
