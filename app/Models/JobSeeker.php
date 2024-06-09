<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobSeeker extends Model
{
    use HasFactory;
    use SoftDeletes;

    
    protected $fillable = [
        'user_id',
        'job_seeker_name',
        'job_seeker_address',
        'job_seeker_phone',
        'job_seeker_resume',
        'profile_picture',
        'job_seeker_gender',
        'job_seeker_birthdate',
    ];
    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applyJobs()
    {
        return $this->hasMany(ApplyJob::class);
    }

    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class);
    }

    public function fileJobSeekers()
    {
        return $this->hasMany(FileJobSeeker::class);
    }
}
