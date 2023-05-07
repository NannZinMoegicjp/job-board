<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    use HasFactory;
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function employmentType()
    {
        return $this->belongsTo(EmploymentType::class);
    }
    public function experienceLevel()
    {
        return $this->belongsTo(ExperienceLevel::class);
    }
    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
