<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_seeker_id',
        'job_id',
        'status',
        'file_jobseeker_id',
    ];

    public function JobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    public function fileJobSeeker()
    {
        return $this->belongsTo(FileJobSeeker::class);
    }
}
