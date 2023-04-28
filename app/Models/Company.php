<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    public function city(){
        return $this->belongsTo(City::class);
    } 
    public function industries(){
        return $this->belongsToMany(Industry::class);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    } 
}
