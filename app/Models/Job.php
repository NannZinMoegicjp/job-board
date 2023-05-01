<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function employmentType(){
        return $this->belongsTo(EmploymentType::class);
    }
    public function experienceLevel(){
        return $this->belongsTo(ExperienceLevel::class);
    }
    public function jobCategory(){
        return $this->belongsTo(JobCategory::class);
    }
    public function descriptions(){
        return $this->hasMany(Description::class);
    }
    public function requirements(){ 
        return $this->hasMany(Requirement::class);
    }
    public function benefits(){
        return $this->hasMany(Benefit::class);
    }
}
