<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Admin  extends model
{
    use  HasFactory;
    public function orderConfirmations(){
        return $this->hasMany(OrderConfirmation::class);
    }
}
