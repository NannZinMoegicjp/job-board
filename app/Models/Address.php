<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function job(){
        return $this->hasOne(Job::class);
    }
}
