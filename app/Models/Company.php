<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'company_name',
        'company_address',
        'company_website',
        'company_phone',
        'company_description',
        'industry_id',
        'company_logo',
    ];

    /**
     * Get the user that owns the company.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the industry associated with the company.
     */
    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    /**
     * Get the jobs for the company.
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
