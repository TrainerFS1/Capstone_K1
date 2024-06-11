<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileJobSeeker extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'job_seeker_id',
        'cv',
        'certificate',
        'file_type'
    ];
    protected $dates = ['deleted_at'];


    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

    public function ApplyJob()
    {
        return $this->belongsTo(ApplyJob::class);
    }
}
