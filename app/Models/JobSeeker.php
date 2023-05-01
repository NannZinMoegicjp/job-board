<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class JobSeeker extends Model
{
    use HasFactory;
    public function age()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }
}