<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SavedJob extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'job_seeker_id',
        'job_id',
    ];
    protected $dates = ['deleted_at'];


    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    
}
