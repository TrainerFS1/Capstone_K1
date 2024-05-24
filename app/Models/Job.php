<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'job_title',
        'category_id',
        'job_description',
        'job_location',
        'job_skills',
        'job_type_id',
        'job_status',
        'job_salary',
    ];
    protected $dates = ['deleted_at'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function applyJobs()
    {
        return $this->hasMany(ApplyJob::class);
    }

    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class);
    }
}
