<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    use HasFactory;
    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    } 
}
