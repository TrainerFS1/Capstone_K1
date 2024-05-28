<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileJobSeeker extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_seeker_id',
        'cv',
        'certificate',
    ];

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

    public function ApplyJob()
    {
        return $this->belongsTo(ApplyJob::class);
    }
}
